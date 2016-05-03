<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /*
    | Attributes that are mass assignable
    */

    protected $fillable = ['name'];

    public function user()
    {
      /*
      | Get tasks that user owns
      */
      return $this->belongsTo(User::class);
    }
}
