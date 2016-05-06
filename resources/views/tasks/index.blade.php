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
          <th>Archive</th>
          <th>Completed</th>
        </thead>
        <!-- Table body -->
        <tbody>
          @foreach ($tasks as $task)
            @if ($task->completed == true)
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
                <!-- Empty cell -->
                <td></td>
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
                <td id="archive{{ $task->id }}">
                  <a href="#" class="btn btn-info">
                    <i class="fa fa-btn fa-briefcase"></i>Archive
                  </a>
                </td>
                <!-- Task is complete -->
                <td>
                  <span class="glyphicon glyphicon-ok"></span>
                </td>
              </tr>
            @else
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
                <td id="edit{{ $task->id }}">
                  <a href="{{ URL::route('edit_task', $task->id) }}" class="btn btn-default">
                    <i class="fa fa-btn fa-edit"></i>Edit
                  </a>
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
                <!-- Empty cell -->
                <td></td>
                <!-- Complete task -->
                <form action="{{ url('tasks/'.$task->id) }}" method="POST">
                  <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                  <td>
                    <input type="checkbox" data-id="{{ $task->id }}" id="complete{{ $task->id }}" name="completed" onclick="Completed(this)" />
                  </td>
                </form>
              </tr>
            @endif
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

@if (isset($task))
  @section('scripts')
    <script type="text/javascript">

      function Completed(input) {
        var checkBoxId  = $(input).data("id");
        var checkBox    = $("#complete" + checkBoxId);
        var complete    = true;
        var editRow     = $("#edit"+checkBoxId);
        var archRow     = $("#archive"+checkBoxId);
        var url         = "{{ URL::action('TaskController@complete', ['id' => $task->id]) }}";
        var token       = $('input[id="_token"]').attr('value');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post(url, {'_token': token, 'completed': complete}, function (data) {
          console.log(data);

          if (data == "true")
          {
            checkBox.parent("td").html("<span class='glyphicon glyphicon-ok'></span>");
            editRow.html("<span></span>");
            archRow.html("<a href='#' class='btn btn-info'><i class='fa fa-btn fa-briefcase'></i>Archive</a>")
          }
          else {
            alert("Error");
          }
        });
      }
    </script>
  @endsection
@endif
