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

        <!-- Task description -->
        <div class="form-group">
          <label for="task-description" class="col-sm-3 control-label">Description</label>
          <div class="col-sm-6">
            <input type="text" name="description" id="task-description" class="form-control" />
          </div>
        </div>

        <!-- Due Date -->
        <div class="form-group">
          <label for="task-due" class="col-sm-3 control-label">Due Date</label>
          <div class="col-sm-6">
            <input type="date" name="due_date" id="task-due" class="form-control" />
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
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Current Tasks</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped task-table">
        @if (count($tasks) > 0)
        <!-- Table headings -->
        <thead>
          <th>Task</th>
          <th>Completion Date</th>
          <th>Description</th>
          <th></th>
          <th></th>
          <th></th>
          <th>Completed</th>
        </thead>
        <!-- Table body -->
        <tbody>
          @foreach ($tasks as $task)
          <tr>
            <!-- Task name -->
            <td class="table-text">
              <div>{{ $task->name }}</div>
            </td>
            <!-- Date created -->
            <td>
              <div>{{ date('F d, Y', strtotime($task->due_date)) }}</div>
            </td>
            <!-- Task description -->
            <td class="table-text">
              <div>{{ $task->description }}</div>
            </td>
            <!-- Edit task -->
            <td>
              <a href="#" class="btn btn-default"><i class="fa fa-btn fa-edit"></i>Edit</a>
            </td>
            <!-- Delete button -->
            <td>
              <form action="{{ url('task/'.$task->id) }}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                  <i class="fa fa-btn fa-trash"></i>Delete
                </button>
              </form>
            </td>
            <!-- Archive task -->
            <td>

            </td>
            <!-- Complete task -->
            <td>
              <input type="checkbox" id="complete" name="complete" />
            </td>
          </tr>
          @endforeach
        </tbody>
        @else
          <td colspan=7>
            <span>No tasks found.</span>
          </td>
        @endif
      </table>
    </div>
  </div>
  @endsection
