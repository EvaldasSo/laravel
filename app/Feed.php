<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Feed extends Model
{

    protected $fillable = [
        'feed_url',
    ];

    public function user()
    {

        return $this->belongsTo(\App\User::class);

    }

    public function category()
    {

        return $this->belongsToMany(\App\Category::class);

    }

    public function rssFeeds()
    {
        return $this->hasMany(\App\RssFeeds::class, 'feed_id');
    }


}
