<?php


namespace App\Http\Controllers;

use App\Http\Requests\MediaLibraryRequest;
use App\Models\Media;
use App\Models\MediaLibrary;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\PdfToImage\Pdf;

class MediaLibraryController extends Controller
{
    /**
     * Return the media library.
     */
    public function index(Request $request): View
    {
//        $mediaLibrary = MediaLibrary::first();
        $media = Media::query()->get()?:[];
        return view('admin.media.index', [
            'media' =>$media
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $medium): Media
    {
        return $medium;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaLibraryRequest $request): RedirectResponse
    {
        $image = $request->file('image');
        $name = $image->getClientOriginalName();
        if ($request->filled('name')) {
            $name = $request->input('name');
        }

        MediaLibrary::first()
            ->addMedia($image)
            ->usingName($name)
            ->toMediaCollection();

        return redirect()->route('media.index')->withSuccess(__('media.created'));
    }

    protected function convertPdfToImage(string $pdfFile) : string
    {
        $imageFile = pathinfo($pdfFile, PATHINFO_DIRNAME).'/'.pathinfo($pdfFile, PATHINFO_FILENAME).'.jpg';

        (new Pdf($pdfFile))->saveImage($imageFile);

        return $imageFile;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $medium): RedirectResponse
    {
        $medium->delete();

        return redirect()->route('media.index')->withSuccess(__('media.deleted'));
    }
}
