<?php


namespace App\Services;


use App\Exceptions\Services\FileServiceException;
use App\Exceptions\Services\UploadServiceException;
use Illuminate\Http\File as StorageFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class UploadService
{
    /**
     * Путь к папке в хранилище
     *
     * @var mixed
     */
    private $uploadFolderPath;

    /**
     * Экземпляр Storage для работы с файлами
     *
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    private $storage;

    /**
     * Название хранилища с которым будет работать сервис
     *
     * @var string
     */
    private $storageName;

    /**
     * Флаг управлящий возможностью использовать автоматическую
     * раскладку файлов по подпапкам
     *
     * @var boolean
     */
    private $useSubFolders;
    private $availableExtensions;

    public function __construct($options = [])
    {
        $this->uploadFolderPath = $options['upload_folder_path'];
        $this->storageName = $options['storage_name'];
        $this->storage = Storage::disk($this->storageName);
        $this->useSubFolders = isset($options['use_sub_folders']) ? (bool)$options['use_sub_folders'] : false;
        $this->availableExtensions = $options['available_extensions'] ?? [];
    }

    public function getUploadFolderPath()
    {
        return $this->uploadFolderPath;
    }

    public function getStorageName()
    {
        return $this->storageName;
    }

    public function cleanUploadDir(string $path = '')
    {
        $path = $this->uploadFolderPath.'/'.ltrim($path, '/');

        $this->storage->deleteDirectory($path);
        $this->storage->makeDirectory($path);
    }

    public function deleteFile(string $path, $withDir = false)
    {
        $filePath = $this->getInStoragePath($path);
        $deleted = $this->storage->delete($filePath);
        if($deleted && $withDir){
            $dir = dirname($filePath);
            if(!($files = $this->storage->files($dir))){
                $this->storage->deleteDirectory($dir);
            }
        }

        return $deleted;
    }

    public function getInStoragePath(string $path): string
    {
        return str_replace($this->storage->path(''), '', $path);
    }

    public function storeUploadedFile(UploadedFile $uploadedFile, $fileName = null)
    {
        $this->checkExtension($uploadedFile);

        $fileName = $fileName ?? $uploadedFile->hashName();
        $subFolder = $this->useSubFolders
            ? "/" . strtolower(substr($fileName, 0, 3))
            : '';

        $path = $this->storage->putFileAs($this->uploadFolderPath . $subFolder, $uploadedFile, $fileName);

        if (empty($path)) {
            dd("ExceptiontthrowUploadFileNotStoredException($uploadedFile);");
//            ExceptiontthrowUploadFileNotStoredException($uploadedFile);
        }

        $file = new \Symfony\Component\HttpFoundation\File\File($this->storage->path($path));

        return $file;
    }

    private function checkExtension(UploadedFile $file)
    {
        if($this->availableExtensions && !in_array($file->getExtension(), $this->availableExtensions)){
            dd("ExceptiontthrowUploadFileNotStoredException();");
            //            UploadServiceException::throwExtensionIsNotAvailableException($file);
        }
    }

    public function getSrcByPath($filePath)
    {
        $filePath = $this->getInStoragePath($filePath);
        $src = str_replace(URL::to('/'), '', $this->storage->url($filePath));

        return $src;
    }

    public function createUploadedFileByFile(string $absFilePath, string $name = null)
    {
        return $this->createUploadedFile(file_get_contents($absFilePath), $name);
    }

    public function createUploadedFile(string $data = '', string $name = null)
    {
        $path = tempnam(sys_get_temp_dir(), 'mpTMP');
        if(strlen($data)){
            file_put_contents($path, $data);
        }
        $name = $name ?? pathinfo($path, PATHINFO_BASENAME);

        return new \Symfony\Component\HttpFoundation\File\UploadedFile($path, $name, null, null, true);
    }
}
