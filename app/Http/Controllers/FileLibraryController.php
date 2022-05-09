<?php


namespace App\Http\Controllers;

use App\Http\Requests\FileLibraryRequest;
use App\Models\File;
use App\Services\Stateless\FileService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\PdfToImage\Pdf;

class FileLibraryController extends Controller
{
    /**
     * Return the file library.
     */
    public function index(Request $request): View
    {
        $files = File::query()->get()?:[];

        return view('admin.file.index', [
            'files' =>$files
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file): File
    {
        return $file;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('admin.file.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileLibraryRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        if ($request->filled('name')) {
            $name = $request->input('name');
        }

        $file = app("FileService")->saveUploadedFile($file, $name);

        return redirect()->route('file.index')->withSuccess(__('file.created'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file): RedirectResponse
    {
        $file->delete();

        return redirect()->route('file.index')->withSuccess(__('file.deleted'));
    }
}
