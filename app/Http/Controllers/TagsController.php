<?php


namespace App\Http\Controllers;

use App\Http\Requests\FileLibraryRequest;
use App\Http\Requests\TagRequest;
use App\Models\File;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagsController extends Controller
{
    /**
     * Return the file library.
     */
    public function index(Request $request): View
    {
        $tags = Tag::query()->get()?:[];

        return view('admin.tag.index', [
            'tags' =>$tags
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): Tag
    {
        return $tag;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): RedirectResponse
    {
        $slug = $request->slug;
        if (Tag::query()->where('slug',$slug)->exists()){
            return redirect()->route('tags.index')->withErrors(__('tag.slug_is_duplicate'));
        }
        Tag::query()->create(['slug'=>$slug]);
        return redirect()->route('tags.index')->withSuccess(__('tag.created'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        if ($tag->posts()->exists()){
            return redirect()->route('tags.index')->withErrors(__('tag.this_tag_is_in_post'));
        }else{
            $tag->delete();
            return redirect()->route('tags.index')->withSuccess(__('tag.deleted'));
        }
    }
}
