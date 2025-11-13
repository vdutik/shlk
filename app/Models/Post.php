<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    const STATUS_PENDING = 'Pending';
    const STATUS_PUBLISHED = 'Published';
    const STATUS_HIDDEN  = 'Hidden';

    const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PUBLISHED,
        self::STATUS_HIDDEN
    ];

    protected $table = 'posts';
    public $primaryKey = 'post_id';
    public $timestamps = true;

    public function getDateCreated() {
        $created_at = strtotime($this->attributes['created_at']);

        return date('d m Y', $created_at);
    }

    public function user() {
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(350)
            ->height(250);
    }

    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags','post_id', 'tag_id');
    }
}
