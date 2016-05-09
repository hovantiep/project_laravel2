<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function news()
    {
        return $this->hasMany('App\News', 'category_id', 'id');
    }
}
