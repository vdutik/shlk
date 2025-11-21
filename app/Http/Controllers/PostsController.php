<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(6);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'sort' => 'required|int|min:1',
            'cover_image' => 'sometimes|mimes:jpeg,bmp,jpg,png|between:1, 6000',
            'tags.*' => 'integer',
            'post_images.*' => 'nullable|mimes:jpeg,bmp,jpg,png|between:1, 6000'
        ]);


        $cover_image = $request->file('cover_image');
        if ($cover_image){
            $filename = $cover_image->getClientOriginalName();

            // Get just filename
            $filename = time() . '_' . pathinfo($filename, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . '.' . $extension;

            // Upload the Image
            $request->file('cover_image')->storeAs('cover_images', $fileNameToStore, 'public');
        }
        // Get the filename with the extension

        if(auth()->user()->hasRole('moderator') || auth()->user()->hasRole('admin')) {
            $status = 'Published';
        } else {
            $status = 'Pending';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->sort = $request->sort;
        $post->user_id = auth()->user()->id;

        $post->cover_image = $fileNameToStore??"";
        $post->status = $status;
        $post->save();

        if ($request->has('tags')){
            $tags = [];
            foreach ($request->tags as $tagId){
                $tags[] = (int) $tagId;
            }
            $post->tags()->sync($tags);
        }

        if(auth()->user()->hasRole('moderator') || auth()->user()->hasRole('admin')) {
            return redirect('/posts')->with('success', 'Post Published');
        }

        return redirect('/posts/' . $post->post_id)->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/posts')->with('error', 'Post not found');
        }

        // Check for correct user
        if($post->status == 'Pending') {

            $hasPermission = auth()->user()->id == $post->user_id;
            $isModerator = auth()->user()->hasRole('moderator') || auth()->user()->hasRole('admin');

            if(!($hasPermission || $isModerator)) {
                return redirect('/dashboard')->with('error', 'Unauthorized Page');
            }
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/posts')->with('error', 'Post not found');
        }

        $tags = Tag::all();
        $statuses = Post::STATUSES;

        // Check for correct user
        if(!auth()->user()->hasPermissionTo('edit posts') &&
            auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with([
            'post' => $post,
            'tags' => $tags,
            'statuses' => $statuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'title_en' => 'nullable|string',
            'body' => 'required',
            'body_en' => 'nullable|string',
            'cover_image_name' => 'sometimes|string',
            'sort' => 'required|int|min:1',
            'cover_image' => 'nullable|mimes:jpeg,bmp,jpg,png|between:1, 6000',
            'tags.*' => 'integer',
            'post_images.*' => 'nullable|mimes:jpeg,bmp,jpg,png|between:1, 6000',
            'status' => 'in:Published,Pending,Hidden',
        ]);
        $post = Post::find($id);

        // Handle File Upload
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->file('cover_image');

            // Get the filename with the extension
            $filename = $cover_image->getClientOriginalName();

            // Get just filename
            $filename = time() . '_' . pathinfo($filename, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . '.' . $extension;

            // Upload the Image
            $request->file('cover_image')->storeAs('cover_images', $fileNameToStore, 'public');

        }
        if (!$request->has('cover_image_name')){
            // Якщо cover_image_name не передано, очищаємо cover_image
            // Але не видаляємо медіа файли, оскільки вони можуть бути використані в post_images
            $post->cover_image = '';
        }


        if ($request->has('post_images')){
            foreach ($request->post_images as $postImage){
                $name = $postImage->getClientOriginalName();
                $post->addMedia($postImage)
                    ->usingName($name)
                    ->toMediaCollection();
            }
        }
        if ($request->has('tags')){
            $tags = [];
            foreach ($request->tags as $tagId){
                $tags[] = (int) $tagId;
            }
            $post->tags()->sync($tags);
        }

        // Update Post
        $post->title = $request->input('title');
        $post->title_en = $request->input('title_en') ?? null;
        $post->body = $request->input('body');
        $post->body_en = $request->input('body_en') ?? null;
        $post->updated_at = now();
        $post->sort = $request->sort;
        $post->status = $request->input('status');

        if($request->hasFile('cover_image')) {
            Storage::disk('public')->delete('cover_images/'. $post->cover_image);
            $post->cover_image = $fileNameToStore;
        }

        $post->save();
        $tags = Tag::all();

        return redirect('/posts/' . $post->post_id)->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect('/posts')->with('error', 'Post not found');
        }

        // Check for correct user
        if(!auth()->user()->hasPermissionTo('delete posts') &&
            auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        $coverImage = $post->cover_image;
        
        DB::transaction(function () use ($post){
            $post->tags()->sync([]);
            $post->delete();
        });

        if ($coverImage) {
            Storage::disk('public')->delete('cover_images/'. $coverImage);
        }

        if(auth()->user()->hasRole('moderator') || auth()->user()->hasRole('admin')) {
            return redirect('/posts/mod/published')->with('success', 'Post Removed');
        }

        return redirect('/posts')->with('success', 'Post Removed');
    }

    public function published() {
        $posts = Post::where('status', 'LIKE', 'Published')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('posts.published')->with('posts', $posts);
    }

    public function publish($id) {
        $post = Post::find($id);
        
        if (!$post) {
            return redirect('/posts/mod/approval')->with('error', 'Post not found');
        }
        
        $post->status = 'Published';
        $post->save();

        return redirect('/posts/mod/approval')->with('success', 'Post Published');
    }

    public function approval() {
        $posts = Post::where('status', 'LIKE', 'Pending')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('posts.approval')->with('posts', $posts);
    }
}
