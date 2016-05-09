<!-- resources/views/auth/profile.blade.php -->

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Greetings {{ $user->name }}</h3>
    </div>
    <div class="panel-body">
      <form action="{{ URL::route('/profile'.$user->id) }}" method="POST" class="form-horizontal">
        {!! csrf_field() !!}
        {!! method_field('PATCH') !!}

        <!-- User name -->
        <div class="form-group">
          <label for="user-name" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-6">
            <input type="text" name="edit-name" id="user-name" class="form-control" value="{{ $user->name }}" />
          </div>
        </div>

        <!-- User email -->
        <div class="form-group">
          <label for="user-email" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-6">
            <input type="email" name="edit-email" id="user-email" class="form-control" value="{{ $user->email }}" />
          </div>
        </div>

        <!-- Change user password -->
        <div class="form-group">
          <!-- Button trigger modal -->
          <label for="user-pass" class="col-sm-3 control-label">Change Password</label>
          <div class="col-sm-6">
            <button type="button" id="user-pass" class="btn btn-default" data-toggle="modal" data-target="#changePass">
              Change Password
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="curPass" class="col-sm-3 control-label">Current Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="currentPass" id="curPass" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reCurPass" class="col-sm-3 control-label">Re-enter Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="reCurrentPass" id="reCurPass" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="newPass" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="newPassword" id="newPass" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Submit user changes -->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <a href="{{ url('/tasks') }}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-edit"></i> Submit Changes
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
