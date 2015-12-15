@extends('admin.adminlayout')

@include('flash_msg')

@section('content')
<a id="addinfo" href="{{route('newUser')}}"><input type="button" class="btn btn-info btn-flat btn-block" value="Create New User"></a>
<br >
<div class="box box-success">
 <div align="left" id="paglink"> </div>
                <table class="table table-bordered">
                 <thead>
                        <tr>
                            
                            <th>Username</th>
                            <th>emailid</th>
                            <th>CIK</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php foreach ($user as $user_all) { ?> 
                            <tr>
                                <td>{{$user_all->first_name}}</td>
                                <td>{{$user_all->email}}</td>
                                  <td>{{$user_all->cik}}</td>
                                <td>{{$user_all->phone}}</td>
                                <td>
                                    <div class="dropdown" style="display: inline-block;width: 80px;">
                                      <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::Route('editUser',array('id'=>$user_all->id)) }}">Edit User</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::Route('deleteUser',array('id'=>$user_all->id)) }}">Delete User</a></li>

                                      </ul>
                                    </div>
                                    <a class="btn btn-info" href="{{$user_all->dashboard_link}}" target="_blank" style="display: inline-block;width: 100px;">Dashboard</a>
                                </td>
                            </tr>
                          <?php } ?>  
                    </tbody>
                </table>
         


</div>

        <div align="left" id="paglink"> </div>

      </div>
@stop