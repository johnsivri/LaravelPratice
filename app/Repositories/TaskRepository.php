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

  public function forUserWithoutArchive(User $user)
  {
    return $user->tasks()
                ->whereNull('archived_at')
                ->orderBy('created_at', 'asc')
                ->get();
  }

  public function sessionSet($session)
  {
    if (empty($session))
    {
      return "expired";
    }
    else
    {
      return "active";
    }
  }
}

?>
