<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'password_confirmation'];
    /*
    | Get user that owns the task
    */
    public function tasks()
    {
      return $this->hasMany(Task::class);
    }
}
