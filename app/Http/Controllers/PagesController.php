<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Setting;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $tot_posts = count(Post::all());
        /** @var Post $posts */
        $posts = Post::where('status', 'Published')
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
        if (app()->getLocale() != 'uk' ) {
            $posts->each(function ($post) {
                $lang = app()->getLocale();
                $post->title = !empty($post->{'title_' . $lang}) ? $post->{'title_' . $lang} : $post->title;
                $post->body = !empty($post->{'body_' . $lang}) ? $post->{'body_' . $lang} : $post->body;
            });
        }

        $events = Event::where('start_date', '>=', date('Y-m-d'))
                        ->orWhere('end_date', '<=', date('Y-m-d'))
                        ->limit(4)
                        ->orderBy('start_date')
                        ->get();

        $annoucement = Setting::where('name', 'LIKE', 'Annoucement')->get();

        if(count($annoucement) > 0)
            $annoucement = $annoucement[0]->value;
        else
            $annoucement = null;

        return view('pages.index')->with(compact('posts', 'events', 'tot_posts', 'annoucement'));
    }

    public function about()
    {
        $tot_posts = count(Post::all());

        return view('pages.about')->with('tot_posts', $tot_posts);
    }

    public function news(?string $tag = 'news')
    {

        $tot_posts = count(Post::all());

        $latest_post = Post::where('status', 'LIKE', 'Published')
                            ->whereHas('tags',function (Builder $builder) use ($tag){
                                $builder->where('slug', $tag);
                            })
                            ->orderBy('sort', 'desc')
                            ->orderBy('created_at', 'desc')                            ->limit(1)
                            ->get();

        $posts = Post::where('status', 'LIKE', 'Published')
                        ->whereHas('tags',function (Builder $builder)use ($tag){
                            $builder->where('slug', $tag);
                        })
                        ->orderBy('sort', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        if (app()->getLocale() != 'uk' ) {
            $posts->each(function ($post) {
                $lang = app()->getLocale();
                $post->title = !empty($post->{'title_' . $lang}) ? $post->{'title_' . $lang} : $post->title;
                $post->body = !empty($post->{'body_' . $lang}) ? $post->{'body_' . $lang} : $post->body;
            });
        }

        $title = __('pages.title_'.$tag);

        return view('pages.news')->with(compact('latest_post', 'posts', 'tot_posts','title'));
    }

    public function posts(?string $tag = 'news')
    {

        $tot_posts = count(Post::all());

        $latest_post = Post::where('status', 'Published')
            ->whereHas('tags',function (Builder $builder) use ($tag){
                $builder->where('slug', $tag);
            })
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->get();

        $posts = Post::where('status', 'Published')
            ->whereHas('tags',function (Builder $builder)use ($tag){
                $builder->where('slug', $tag);
            })
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        if (app()->getLocale() != 'uk' ) {
            $posts->each(function ($post) {
                $lang = app()->getLocale();
                $post->title = !empty($post->{'title_' . $lang}) ? $post->{'title_' . $lang} : $post->title;
                $post->body = !empty($post->{'body_' . $lang}) ? $post->{'body_' . $lang} : $post->body;
            });
        }

        $title = __('pages.title_'.$tag);

        return view('pages.posts')->with(compact('latest_post', 'posts', 'tot_posts','title'));
    }

    public function articles($id)
    {
        $tot_posts = count(Post::all());

        $post = Post::find($id);
        if (app()->getLocale() != 'uk' ) {
            $lang = app()->getLocale();
            $post->title = !empty($post->{'title_' . $lang}) ? $post->{'title_' . $lang} : $post->title;
            $post->body = !empty($post->{'body_' . $lang}) ? $post->{'body_' . $lang} : $post->body;
        }
        return view('pages.article')->with(compact('post', 'tot_posts'));
    }

    public function admission()
    {
        $tot_posts = count(Post::all());

        return view('pages.admission')->with('tot_posts', $tot_posts);
    }

    public function structure()
    {
        $title = 'Адміністрація';
        return view('pages.structure',compact('title'));
    }

    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }
}
