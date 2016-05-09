<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use Auth;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class UserController extends Controller
{
  protected $tasks;

  public function getProfile(Request $request)
  {
    if (Auth::check())
    {
      $user = Auth::user();

      return view('auth.profile', [
        'user'  =>  $user
      ]);
    }
    else
    {
      return view('auth.profile')->with('error', 'There has been an error');
    }
  }

  public function profile(Request $request, $id)
  {
    $dbUser = User::find($id);

    return redirect('profile/'.$id, [
      'user'  =>  $dbUser
    ]);
  }
}
