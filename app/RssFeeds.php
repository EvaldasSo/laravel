<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssFeeds extends Model
{

    protected $fillable = [
        'title',
        'link',
        'description',
        'img',
        'pubDate',
    ];

    public function feed()
    {
        return $this->belongsTo(\App\Feed::class, 'id');
    }
}
