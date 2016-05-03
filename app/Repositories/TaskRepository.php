<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
  /*
  | Get all tasks for a given user
  */
  public function forUser(User $user)
  {
    return $user->tasks()
                ->orderBy('created_at', 'asc')
                ->get();
  }
}

?>
