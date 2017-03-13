<?php

namespace project2;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->hasMany('project2\User', 'role_id', 'id');
    }
}
