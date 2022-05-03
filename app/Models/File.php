<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * Class File
 *
 * @property int $id
 * @property string $name
 * @property string $original_name
 * @property string $description
 * @property string $mime_type
 * @property string|null $extension
 * @property int $size
 * @property string $disk
 * @property string $path
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 *
 * @package App\Models
 */
class File extends Model
{
    protected $fillable = [
        'model_type','model_id' ,  'name', 'file_name', 'description', 'collection_name', 'mime_type', 'extension', 'size', 'disk', 'path'
    ];

    public function fullPath(): string
    {
        return Storage::disk($this->disk)->path($this->path);
    }
}
