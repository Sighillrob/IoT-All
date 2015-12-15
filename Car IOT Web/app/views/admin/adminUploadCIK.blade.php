@extends('admin.adminlayout')

@include('flash_msg')

@section('content')

@if(Session::has('flash_cust_error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{Session::get('flash_cust_error')}}
    </div>
@endif
@if(Session::has('flash_cust_success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{Session::get('flash_cust_success')}}
    </div>
@endif
<form enctype="multipart/form-data" action="{{route('exosite_create')}}" method="post">
    <button class="btn btn-primary btn-flat btn-block" id="edit" type="submit">Create New CIK</button>
</form>

<div class="box box-success">
 <div align="left" id="paglink"> </div>
 <a class="btn btn-success pull-right" style="margin:1%;" href="{{route('cikdownload')}}">Download Sample File</a>
 
<form enctype="multipart/form-data" action="{{route('uploadText')}}" method="post">
       <div class="box-body">
           <div class="form-group">
               <label>CIK Name</label>
               <input type="text" placeholder="Type Your CIK Name"   name="cik_name" class="form-control">
           </div>
           <div class="form-group">
               <label>CIK Device Rid</label>
               <input type="text" placeholder="Type Your CIK Device Rid"   name="cik_device_rid" class="form-control">
           </div>
           <div class="form-group">
               <label>CIK Dashboard Id</label>
               <input type="text" placeholder="Type Your CIK Dashboard Id"   name="cik_dashboard_id" class="form-control">
           </div>

           <div class="box-footer">
           <div class="col-md-4">
           </div>
           <div class="col-md-4">
               <button class="btn btn-primary btn-flat btn-block" id="edit" type="submit">CIK New</button>
            </div>
           <div class="col-md-4">
           </div>
           </div>
       </div>
</form>


		 
 
 <form enctype="multipart/form-data" action="{{route('uploadFile')}}" method="post" enctype="multipart/form-data" files="true">
       <div class="box-body" style="margin-top: 3%;">
           <div class="form-group">
               <label>File Name</label>
               <input type="file" placeholder="Type Your CIK Name"   name="upload_ex_cik" class="form-control">
           </div>
            

           

           <div class="box-footer" style="margin-bottom: 4%;">
           <div class="col-md-4">
           </div>
           <div class="col-md-4">
               <button class="btn btn-primary btn-flat btn-block" id="edit" type="submit">Upload File</button>
           </div>
           </div>
           <div class="col-md-4">
           </div>
       </div>
</form>
 
 
		 
 
</div>
@stop