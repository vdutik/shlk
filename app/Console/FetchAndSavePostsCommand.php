<?php

namespace App\Console;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use DateTimeInterface;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FetchAndSavePostsCommand extends Command
{
    protected $signature = 'fetch:facebook-posts';
    protected $description = 'Fetch latest posts from Facebook page and save them to the database';

    protected $facebook;
    protected $accessToken;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $this->initializeFacebook();

            $accountData = $this->getFacebookAccountData();
            if (empty($accountData)) {
                Log::error('No Facebook accounts found.');
                return;
            }

            $daysBack = (int)env('FACEBOOK_SINCE_DATE', 30);
            $since = Carbon::now()->subDays($daysBack)->startOfDay()->timestamp;
            $this->info("Fetching posts from last {$daysBack} days (since: " . Carbon::createFromTimestamp($since)->format('Y-m-d H:i:s') . ')');
            
            $posts = $this->getFacebookPosts($accountData['id'], $since, $accountData['access_token']);
            $this->info('Found ' . count($posts) . ' posts from Facebook');

            $newPostsCount = 0;
            $existingPostsCount = 0;
            
            foreach (array_reverse($posts) as $post) {
                $postData = $this->getPostDetails($post['id'], $accountData['access_token']);
                if ($postData) {
                    if (!$this->postExists($postData['id'])) {
                        $photos = $this->getPhotosFromPost($postData);
                        $coverImage = count($photos) > 0 ? $photos[0] : null;
                        $this->createPost($postData, $photos, $coverImage);
                        $newPostsCount++;
                        $this->info('New post saved: ' . substr($postData['message'] ?? 'No message', 0, 50));
                    } else {
                        $existingPostsCount++;
                    }
                }
            }

            $this->info("Posts fetched and saved successfully! New: {$newPostsCount}, Existing: {$existingPostsCount}");
        } catch (FacebookResponseException $e) {
            $errorMsg = 'Graph returned an error: ' . $e->getMessage();
            Log::error($errorMsg);
            $this->error($errorMsg);
        } catch (FacebookSDKException $e) {
            $errorMsg = 'Facebook SDK returned an error: ' . $e->getMessage();
            Log::error($errorMsg);
            $this->error($errorMsg);
        } catch (\Exception $exception) {
            $errorMsg = 'Exception: ' . $exception->getMessage();
            Log::error($errorMsg);
            $this->error($errorMsg);
            $this->error('Stack trace: ' . $exception->getTraceAsString());
        }
    }

    private function initializeFacebook()
    {
        $this->facebook = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID', ''),
            'app_secret' => env('FACEBOOK_APP_SECRET', ''),
            'default_graph_version' => 'v20.0',
        ]);

        $this->accessToken = env('FACEBOOK_APP_ACCESS_TOKEN', '');
    }

    private function getFacebookAccountData()
    {
        $accounts = $this->facebook->get('me/accounts', $this->accessToken);
        return $accounts->getDecodedBody()['data'][0] ?? null;
    }

    private function getFacebookPosts($pageId, $since, $pageAccessToken)
    {
        $response = $this->facebook->get("/$pageId/posts?since=$since", $pageAccessToken);
        return $response->getDecodedBody()['data'] ?? [];
    }

    private function getPostDetails($postId, $pageAccessToken)
    {
        $response = $this->facebook->get("$postId?fields=attachments{subattachments.limit(50)},message,created_time", $pageAccessToken);
        return $response->getDecodedBody();
    }

    private function postExists($postId)
    {
        return Post::query()->where('facebook_post_id', $postId)->exists();
    }

    private function createPost($postData, $photos, $coverImage = null)
    {
        if (!isset($postData['message'])) {
            Log::warning('Post does not contain a message. Post ID: ' . $postData['id']);
            return;
        }

        $message = $postData['message'];
        $paragraphs = explode("\n", $message);
        $firstParagraph = trim($paragraphs[0]);
        $allParagraph = str_replace("\n", "<br>", $message);
        $createdAt = Carbon::createFromFormat(DateTimeInterface::ISO8601, $postData['created_time'])
            ->setTimezone('Europe/Kiev');

        $user = User::query()->where('username', '=', 'spccadmin')->first();
        if (!$user) {
            $this->error('User "spccadmin" not found. Cannot create post.');
            return;
        }

        $post = new Post;
        $post->title = $firstParagraph;
        $post->body = "<p>$allParagraph</p>";
        $post->user_id = $user->id;
        $post->status = 'Published';
        $post->facebook_post_id = $postData['id'];
        $post->created_at = $createdAt->format('Y-m-d H:i:s');
        $post->updated_at = $createdAt->format('Y-m-d H:i:s');

        if ($coverImage) {
            $fileNameToStore = $this->saveCoverImage($coverImage);
            $post->cover_image = $fileNameToStore;
        } else {
            $post->cover_image = '';
        }

        $post->save();

        $tag = Tag::query()->where('slug', '=', 'news')->first();
        if ($tag) {
            $post->tags()->sync($tag->id);
        } else {
            $this->warn('Tag "news" not found. Post saved without tag.');
        }

        $this->savePhotos($post, $photos);
    }

    private function getPhotosFromPost($postData)
    {
        $attachments = $postData['attachments']['data'] ?? [];
        $photos = [];

        foreach ($attachments as $attachment) {
            if (isset($attachment['media']['image']['src'])) {
                $photos[] = $attachment['media']['image']['src'];
            }

            if (isset($attachment['subattachments'])) {
                $subattachments = $attachment['subattachments']['data'];
                foreach ($subattachments as $subattachment) {
                    if (isset($subattachment['media']['image']['src'])) {
                        $photos[] = $subattachment['media']['image']['src'];
                    }
                }
            }
        }

        return $photos;
    }

    private function savePhotos($post, $photos)
    {
        foreach ($photos as $photoUrl) {
            $post->addMediaFromUrl($photoUrl)
                ->toMediaCollection();
        }
    }

    private function saveCoverImage($imageUrl)
    {
        $imageContents = file_get_contents($imageUrl);
        $parsedUrl = parse_url($imageUrl);
        $basename = basename($parsedUrl['path']);
        $fileName = $basename;
        $filePath = 'cover_images/' . $fileName;
        Storage::disk('public')->put($filePath, $imageContents);

        return $fileName;
    }
}
