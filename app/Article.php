<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'content',
        'status',
    ];

    /**
     * Has-many user articles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Many-to-many articles tags relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class, 'articles_tags')->withTimestamps();
    }

    /**
     * Many-to-many articles categories relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->belongsToMany(\App\Category::class, 'articles_categories')->withTimestamps();
    }
}
