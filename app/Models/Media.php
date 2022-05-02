<?php


namespace App\Models;

use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $fillable = [ 'posted_at'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'posted_at'
    ];
}
