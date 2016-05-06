<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /*
    | Task repository instance
    */
    protected $tasks;

    /*
    | Requires authenticated users for all actions in controller
    */
    public function __construct(TaskRepository $tasks)
    {
      $this->middleware('auth');
      $this->tasks = $tasks;
    }

    /*
    | Display a list of all user's tasks
    */
    public function index(Request $request)
    {
      return view('tasks.index', [
        'tasks' =>  $this->tasks->forUser($request->user())
      ]);
    }

    /*
    | Create a new task
    */
    public function store(Request $request)
    {
      $this->validate($request, [
        'name'        =>  'required|max:255',
        'description' =>  'required|max:255',
        'due_date'    =>  'required|date'
      ]);

      $request->user()->tasks()->create([
        'name'        =>  $request->name,
        'description' =>  $request->description,
        'due_date'    =>  $request->due_date,
        'completed'   =>  'NULL'
      ]);

      return redirect('/tasks');
    }

    /*
    | Destroy the given task
    */
    public function destroy(Request $request, Task $task)
    {
      $this->authorize('destroy', $task);

      $task->delete();

      return redirect('/tasks');
    }
    /*
    | Edit a given task
    */
    public function edit(Request $request, Task $task)
    {
      return view('tasks.edit', [
        'tasks' =>  $task
      ]);
    }

    /*
    | Update a given task
    */
    public function update(Request $request, $id)
    {
      $date = $request->input('eDue_date');
      $due_date = date('Y-m-d', strtotime($date));

      $dbTask = Task::find($id);
      $dbTask->name = $request->input('eName');
      $dbTask->description = $request->input('eDescription');
      $dbTask->due_date = $request->input('eDue_date');

      $dbTask->save();

      return redirect('/tasks');
    }

    /*
    | Sets task completed field to true, ajax response
    */
    public function complete(Request $request, $id)
    {
      try {
        $dbTask = Task::find($id);
        $dbTask->completed = true;
        $dbTask->save();

        return "true";
      }
      catch (Exception $err)
      {
        return "false";
      }
    }
}
