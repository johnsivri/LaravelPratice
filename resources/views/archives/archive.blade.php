<!-- resources/views/archives/archive.blade.php -->

@extends('layouts.app')

@section('title', 'Archives')

@section('content')
  <div class="panel panel-default">
    <!-- Include errors -->
    @include('errors.error')

    <div class="panel-heading">
      <h3>Archived Tasks</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped task-table">
        @if (count($tasks) > 0)
          <!-- Table headings -->
          <thead>
            <th>Task Name</th>
            <th>Completion Date</th>
            <th>Description</th>
            <th>Date Completed</th>
          </thead>
          <!-- Table body -->
          <tbody>
            @foreach ($tasks as $task)
              @if ($task->completed == true && $task->archived_at !== null)
                <tr>
                  <!-- Task name -->
                  <td>
                    <div>{{ $task->name }}</div>
                  </td>
                  <!-- Task due date -->
                  <td>
                    <div>{{ date('F d, Y', strtotime($task->due_date)) }}</div>
                  </td>
                  <!-- Task description -->
                  <td>
                    <div>{{ $task->description }}</div>
                  </td>
                  <!-- Task date completed -->
                  <td>{{ date('F d, Y H:i:s', strtotime($task->date_completed)) }}</td>
                </tr>
              @endif
            @endforeach
          </tbody>
        @else
          <td colspan=4>
            <span>No tasks found</span>
          </td>
        @endif
      </table>
    </div>
  </div>
@endsection
