@extends('admin.adminlayout')

@section('content')


    <!--Login Form Container-->
    <div class="container" style="max-width: 600px; float:left;">
        <!--Errors display-->
        @if(Session::has('flash_error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{Session::get('flash_error')}}
            </div>
        @endif
        @if(Session::has('flash_success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {{Session::get('flash_success')}}
            </div>
        @endif
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Create New User</h3>
            </div>
                <form action="{{route('saveNewUser')}}" method="post">
                    <div class="panel-body">
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1">First Name</span>
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1">Email</span>
                            <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1">Password</span>
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1">Phone Number</span>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="form-group  input-group">
                            <span class="input-group-addon" id="basic-addon1">Device Type</span>
                            <select name="device_type" class="form-control" id="sel1" required>
                                <option value="">--Select Device Type--</option>
                                <option value="android">Android</option>
                                <option value="ios">Apple</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1">Device Token</span>
                            <input type="text" name="device_token" class="form-control" placeholder="Device Token" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Create User</button>
                    </div>
                </form>
        </div>
    </div>
@stop