<?php

namespace App\Models;

use App\Models\Setting;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    public $timestamps = false;
    protected $fillable = ['slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags','tag_id', 'post_id');
    }
}
