<?php

namespace project2;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['title', 'author', 'intro', 'full', 'image', 'status', 'category_id', 'user_id'];

    public function category()
    {
        return $this->hasOne('project2\Category', 'id', 'category_id');
    }

    public function user()
    {
        return $this->hasOne('project2\User', 'id', 'user_id');
    }
}
