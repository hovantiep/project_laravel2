<?php

namespace project2;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function news()
    {
        return $this->hasMany('project2\News', 'category_id', 'id');
    }
}
