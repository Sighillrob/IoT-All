@extends('admin.adminlayout')

@section('content')

 
<div class="box box-success">
 <div align="left" id="paglink"> </div>
 

 <form enctype="multipart/form-data" action="{{ URL::Route('updateUser',array('id'=>$user->id)) }}" method="post">
       <div class="box-body">
           <div class="form-group">
               <label>First Name</label>
               <input type="text"   name="first_name" class="form-control" value="{{$user->first_name}}"></input>
           </div>
            <div class="form-group">
               <label>Last Name</label>
               <input type="text"   name="last_name" class="form-control" value="{{$user->last_name}}"></input>
           </div>

            <div class="form-group">
               <label>Phone</label>
               <input type="text"   name="phone" class="form-control" value="{{$user->phone}}"></input>
           </div>

           

           <div class="box-footer">
               <button class="btn btn-primary btn-flat btn-block" id="edit" type="submit">Save</button>
           </div>
       </div>
</form>

		 
 
</br>
 
</div>
@stop