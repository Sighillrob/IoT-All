<?php
/**
 * Created by PhpStorm.
 * User: aravinth
 * Date: 06/08/15
 * Time: 7:24 PM
 */
?>
@if(Session::has('flash_errors'))
@if(is_array(Session::get('flash_errors')))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <ul>
        @foreach(Session::get('flash_errors') as $errors)
        @if(is_array($errors))
        @foreach($errors as $error)
        <li> {{$error}} </li>
        @endforeach
        @else
        <li> {{$errors}} </li>
        @endif
        @endforeach
    </ul>
</div>
@else
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{Session::get('flash_errors')}}
</div>
@endif
@endif

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