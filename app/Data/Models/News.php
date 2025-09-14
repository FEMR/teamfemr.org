<?php

namespace FEMR\Data\Models;

use Database\Factories\NewsFactory;
use FEMR\Data\Utilities\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected static function newFactory()
    {
        return NewsFactory::new();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'url',
        'thumbnail',
        'thumbnail_alt',
        'is_featured'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title'   => 'string',
        'slug'    => 'string',
        'url'     => 'string',
        'thumbnail' => 'string',
        'thumbnail_alt' => 'string',
        'is_featured' => 'boolean'
    ];

    /**
     * The attributes that should not be encoded to json
     *
     * @var array
     */
    protected $hidden = [

        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
