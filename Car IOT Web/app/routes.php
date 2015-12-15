<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('userlogin');
});

Route::get('user/login',array('as'=>'login','uses'=>'UserController@login'));

Route::post('user/login',array('as'=>'loginProcess','uses'=>'UserController@loginProcess'));

Route::post('api/signup',array('as'=>'signup','uses'=>'ApiController@register'));


Route::post('api/login',array('as'=>'signup','uses'=>'ApiController@login'));

Route::post('api/personal_setting',array('as'=>'personal_setting','uses'=>'ApiController@personal_setting'));

Route::post('api/get_personal_setting',array('as'=>'get_personal_setting','uses'=>'ApiController@get_personal_setting'));

Route::post('api/security_setting',array('as'=>'security_setting','uses'=>'ApiController@security_setting'));

Route::get('api/get_code_details',array('as'=>'get_code_details','uses'=>'ApiController@get_code_details'));

Route::post('api/get_security_setting',array('as'=>'get_security_setting','uses'=>'ApiController@get_security_setting'));


Route::post('api/add_car_details',array('as'=>'addcar_details','uses'=>'ApiController@add_car_details'));

Route::post('api/get_car_details',array('as'=>'get_car_details','uses'=>'ApiController@get_car_details'));

Route::post('api/edit_car_details',array('as'=>'edit_car_details','uses'=>'ApiController@edit_car_details'));

Route::post('api/forgot_password',array('as'=>'forgot_password','uses'=>'RemindersController@postRemind'));

Route::get('password/reset/{token}',array('as'=>'forgot_password_form','uses'=>'RemindersController@getReset'));

Route::post('password/reset',array('as'=>'forgot_password_reset','uses'=>'RemindersController@postReset'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));







Route::get('admin/user/mangement',array('as'=>'userMangement','uses'=>'AdminController@userMangement'));

Route::get('admin/new/user',array('as'=>'newUser','uses'=>'AdminController@newUser'));

Route::post('admin/new/user',array('as'=>'saveNewUser','uses'=>'AdminController@saveNewUser'));

Route::get('admin/uploadCik',array('as'=>'adminUploadcik','uses'=>'AdminController@uploadCik'));

Route::post('admin/uploadCik/uploadText',array('as'=>'uploadText','uses'=>'AdminController@uploadText'));

Route::post('admin/uploadCik',array('as'=>'uploadFile','uses'=>'AdminController@uploadFile'));

Route::get('admin/delete/user/{id}',array('as'=>'deleteUser','uses'=>'AdminController@deleteUser'));

Route::get('admin/edit/user/{id}',array('as'=>'editUser','uses'=>'AdminController@editUser'));

Route::post('admin/edit/user/{id}',array('as'=>'updateUser','uses'=>'AdminController@updateUser'));

Route::get('admin/user/cik/free',array('as'=>'cikFree','uses'=>'AdminController@CIKFree'));

Route::get('admin/user/cik/assign',array('as'=>'cikAssign','uses'=>'AdminController@CIKAssign'));

Route::get('admin/user/cik/full',array('as'=>'cikFull','uses'=>'AdminController@cikFull'));

Route::get('admin/cik/sample/downlad',array('as'=>'cikdownload','uses'=>'AdminController@cikdownload'));

Route::get('admin/delete/cik/{id}',array('as'=>'deletecik','uses'=>'AdminController@deletecik'));


/* ***Exosite APIs*** */
Route::post('api/exosite/create',array('as'=>'exosite_create','uses'=>'ExositeController@start'));
Route::post('api/exosite/test',array('as'=>'exosite_test','uses'=>'ExositeController@test'));



?>