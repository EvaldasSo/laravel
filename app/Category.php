<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name'
    ];

    public function feeds()
    {
        return $this->belongsToMany(\App\Feed::class);
    }


    public function getRouteKeyName()
    {
        return 'name';
    }

    public function user()
    {

        return $this->belongsTo(\App\User::class);

    }
}
