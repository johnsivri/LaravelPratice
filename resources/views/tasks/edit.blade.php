<!-- resources/views/tasks/edit.blade.php -->

@extends('layouts.app')

@section('content')
  <div class="panel-body">
    <!-- Display errors -->
    @include('errors.error')
    <!-- Edit task form -->
    <form action="{{ url('task/edit/'.$tasks->id) }}" method="POST" class="form-horizontal">
    {!! csrf_field() !!}
    {!! method_field('PATCH') !!}
      <!-- Edit task name -->
      <div class="form-group">
        <label for="edit-name" class="col-sm-3 control-label">Task</label>
        <div class="col-sm-6">
          <input type="text" name="eName" id="edit-name" class="form-control" value="{{ $tasks->name }}" />
        </div>
      </div>

      <!-- Edit task description -->
      <div class="form-group">
        <label for="edit-description" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-6">
          <input type="text" name="eDescription" id="edit-description" class="form-control" value="{{ $tasks->description }}" />
        </div>
      </div>

      <!-- Edit due Date -->
      <div class="form-group">
        <label for="edit-due" class="col-sm-3 control-label">Due Date</label>
        <div class="col-sm-6">
          <input type="date" name="eDue_date" id="edit-due" class="form-control" value="{{ date('Y-m-d', strtotime($tasks->due_date)) }}" />
        </div>
      </div>

      <!-- Edit task button -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-defualt">
            <i class="fa fa-plus"></i> Edit Task
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection
