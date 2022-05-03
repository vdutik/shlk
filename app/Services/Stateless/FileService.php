<?php


namespace App\Services\Stateless;


use App\Models\File;
use App\Services\UploadService;
use Illuminate\Http\UploadedFile;

class FileService extends AbstractModelService
{
    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function setUploadService(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;

        return $this;
    }

    public function getUploadService()
    {
        return $this->uploadService;
    }

    public function getModelClass(): string
    {
        return File::class;
    }

    public function saveUploadedFile(UploadedFile $uploadedFile, $description = null, $useOriginalName = false)
    {
        $originalName = $uploadedFile->getClientOriginalName();
        $file = $this->uploadService->storeUploadedFile($uploadedFile, $useOriginalName
            ? $originalName
            : null
        );
        return $this->createFile([
            'name' => $file->getFilename(),
            'original_name' => $originalName,
            'description' => $description,
            'mime_type' => $file->getMimeType(),
            'extension' => $file->getExtension(),
            'size' => $file->getSize(),
            'disk' => $this->uploadService->getStorageName(),
            'path' => $this->uploadService->getInStoragePath($file->path())
        ]);
    }

    public function createFile(array $attributes)
    {
        $file = File::create($attributes);

        return $file;
    }

    public function updateFile($file, array $attributes)
    {
        $file = $this->findFileOrFail($file);

        $updated = $file->fill($attributes)
            ->save();

        return $updated;
    }

    public function deleteFile($file, $withDir = false)
    {
        $file = $this->findFileOrFail($file);

        $deleted = (File::destroy($file->id) > 0);
        if($deleted){
            $this->uploadService->deleteFile($file->path, $withDir);
        }

        return $deleted;
    }

    public function getFileSrc($file)
    {
        $file = $this->findOrFail($file);

        return $this->uploadService->getSrcByPath($file->path);
    }

    /**
     * @param $file
     * @return File
     * @throws \App\Exceptions\ModelServiceException
     */
    public function findFileOrFail($file)
    {
        return $this->findOrFail($file);
    }
}
