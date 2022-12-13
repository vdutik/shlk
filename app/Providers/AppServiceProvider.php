<?php

namespace App\Providers;

use App\Services\Stateless\FileService;
use App\Services\UploadService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FileService', function($app){
            $uploadService =
                new UploadService([
                    'upload_folder_path' => 'upload',
                    'storage_name' => 'public',
                    'use_sub_folders' => true
                ]);

            return new FileService($uploadService);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         if(config('app.env') === 'production') {
             \URL::forceScheme('https');
         }
        Carbon::setLocale('uK');
        $this->app->setLocale('uk');

    }
}
