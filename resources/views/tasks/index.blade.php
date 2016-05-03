<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')

  <div class="panel-body">
    <!-- Display validation errors -->
    @include('errors.error')
    <!-- New task form -->
      <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {!! csrf_field() !!}

        <!-- Task name -->
        <div class="form-group">
          <label for="task-name" class="col-sm-3 control-label">Task</label>
          <div class="col-sm-6">
            <input type="text" name="name" id="task-name" class="form-control" />
          </div>
        </div>
        <!-- Add task button -->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-defualt">
              <i class="fa fa-plus"></i> Add Task
            </button>
          </div>
        </div>
      </form>
  </div>

  <!-- Current tasks -->
  @if (count($tasks) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Current Tasks</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped task-table">
          <!-- Table headings -->
          <thead>
            <th>Task</th>
            <th>&nbsp;</th>
          </thead>
          <!-- Table body -->
          <tbody>
            @foreach ($tasks as $task)
              <tr>
                <!-- Task name -->
                <td class="table-text">
                  <div>{{ $task->name }}</div>
                </td>
                <td>
                  <!-- Delete button -->
                  <form action="{{ url('tasks/'.$task->id) }}" method="POST">
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}

                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                      <i class="fa fa-btn fa-trash"></i>Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection
