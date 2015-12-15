<?php

class AdminController extends \BaseController {


    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Auth::check()) {

                return Redirect::to('/user/login');
            }

        });
    }

	public function uploadCik()
	{
		return View::make('admin.adminUploadCIK');

	}
	public function cikdownload()
	{
		 $file= public_path(). "/sample_excel/sample_cik.xlsx";
        $headers = array(
              'Content-Type: application/xlsx',
            );
        return Response::download($file, 'sample_cik.xlsx', $headers);
 
	}

	public function uploadText()
	{
        $validator = Validator::make(
                        Input::all(),
                        array(
                            'cik_name' => 'required|max:225',
                            'cik_device_rid' => 'required|max:225',
                            'cik_dashboard_id' => 'required|max:225'
                        ),array(
                            'cik_name' => 'CIK Name is required',
                            'cik_device_rid' => 'CIK Device Rid is required',
                            'cik_dashboard_id' => 'CIK Dashboard Id is required',
                        )
                    );
        if($validator->fails()) {
            $error_messages = $validator->messages()->all();
            return Redirect::back()->with('flash_error', implode('<br>',$error_messages) );
        } else {
            $cki = Input::get('cik_name');
            $cik_device_rid = Input::get('cik_device_rid');
            $cik_dashboard_id = Input::get('cik_dashboard_id');

            $cki_details = Cik::where('name', $cki)->first();
            if ($cki_details) {
                return Redirect::back()->with('flash_error', "Please enter unique code");
            } else {
                $cki_details = new Cik;
                $cki_details->name = $cki;
                $cki_details->device_rid = $cik_device_rid;
                $cki_details->dashboard_id = $cik_dashboard_id;
                $cki_details->status = 0;
                $cki_details->save();
                return Redirect::back()->with('flash_success', "Uploaded successfully");
            }
        }
	}

	
	public function uploadFile() 
		{ 
		$importfile = Input::file('upload_ex_cik'); 
		//$cik_no_change = array();

		Excel::load($importfile, function($reader) 
		{ 
		$result = $reader->all();
		$cik_no_change = array();
		//$i=0;
	 
		foreach ($result as $in) 
		{
			if(($in['cik'] != ""))
			{ 
				$ckj = $in['cik'];


				$ckj_details = Cik::where('name',$ckj)->first();
				if($ckj_details)
				{
					
					array_push($cik_no_change,$ckj);
					//$cik_no_change[$i]=$ckj;
					//$i=$i+1;
					
					 
				}else
				{

				$ckj_details = new Cik;
			    $ckj_details->name = $ckj;
				$ckj_details->status = 0;
				$ckj_details->save();
				}
			} 
	 	} 

		 //print_r($cik_no_change);
	 	});

	 	//$response = Response::json($cik_no_change);
		  //  return $response;
		$allUser = User::where('role_id',1)->get();
		return View::make('admin.adminDashboard')->withUser($allUser);   

	 	 
	}

	public function userMangement()
	{
		$allUser = User::where('role_id',1)->get();
		return View::make('admin.adminDashboard')->withUser($allUser);	
	}
	
	public function deleteUser($id)
	{

		 
		$user = User::where('id',$id)->first();
		
		 
		$cki_change = Cik::where('name',$user->cik)->first();
        		$cki_change->status = 0;
       			$cki_change->save();
		$user=User::where('id',$id)->delete();
		$allUser = User::where('role_id',1)->get();
		return View::make('admin.adminDashboard')->withUser($allUser);
	}

	public function editUser($id)
	{
		$user = User::where('id',$id)->first();
		return View::make('admin.adminEditUser')->withUser($user);
	}


	public function updateUser($id)
	{
		$input=Input::all();
		 


		$user = User::where('id',$id)->first();

        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->phone = $input['phone'];
       	$user->save();

       	return Redirect::Route('userMangement');
	}

	public function CIKFree()
	{
		$cik = Cik::where('status',0)->get();
		return View::make('admin.cikfree')->withCiklist($cik);
	}

	public function CIKAssign()
	{
		$cik = Cik::where('status',1)->get();
		return View::make('admin.cikavailable')->withCiklist($cik);
	}

	public function CIKFull()
	{
		$cik = Cik::get();
		return View::make('admin.cikfull')->withCiklist($cik);
	}

	public function deletecik($id)
	{
		$cik=Cik::where('id',$id)->delete();
		return Redirect::Route('cikFree');
	}

    /*Create new user view*/
    public function newUser(){
        return View::make('admin.newUser');
    }

    /*Save new user*/
    public function saveNewUser()
    {
        $first_name = Input::get('first_name');
        $last_name = Input::get('last_name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $password = Input::get('password');
        $device_token = Input::get('device_token');
        $device_type = Input::get('device_type');
        $fc = 'flash_error';
        $fm = 'Error in creating user';

        $validator = Validator::make(
            array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'device_token' => $device_token,
                'device_type' => $device_type,
            ),
            array(
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required',
                'phone' => 'required|max:15',
                'device_type' => 'required|in:android,ios',
                'device_token' => ''
            )
        );

        $image = Input::file('photo');

        if($image) {

            $filename = $image->getClientOriginalName();

            $filename = pathinfo($filename, PATHINFO_FILENAME);

            $fullname = Str::slug(Str::random(8) . $filename) . '.' .$image->getClientOriginalExtension();

            $upload = $image->move(public_path().'/uploads/photo', $fullname);

        } else {
            $fullname = "";
        }

        if ($validator->fails()) {
            $error_messages = $validator->messages()->all();
            Log::info('Error during registration by admin = '.print_r($error_messages, true));
            $fc = 'flash_error';
            $fm = implode('<br>',$error_messages);
        }
        else {

            if (User::where('email', '=', $email)->first())
            {
                $fm = 'Email ID is already registered.';
            } else {
                $owner = new User;
                $owner->first_name = $first_name;
                $owner->last_name = $last_name;
                $owner->email = $email;
                $owner->phone = $phone;
                if ($password != "") {
                    $owner->password = Hash::make($password);
                }
                $owner->token = generate_token();
                $owner->token_expiry = generate_expiry();


                $owner->device_token = $device_token;
                $owner->device_type = $device_type;

                //$ckj_assign = Cik::where('status',0)->first();
                $ckj_assign = Cik::first();
                if($ckj_assign == Null)
                {
                    $fm = 'Unassigned Cik is not available.';
                }
                else
                {
                    $owner->cik = $ckj_assign->name;
                    $ckj_change = Cik::find($ckj_assign->id);
                    $ckj_change->status = 1;
                    $ckj_change->save();
                    $owner->role_id = 1;
                    $owner->photo=$fullname;
                    $owner->save();

                    // Link device to user by passing $email, $owner->$cik
                    $ExositeController = new ExositeController();
                    $dashboard_link = $ExositeController->link_device_to_user($email, $owner->cik);
                    $owner->dashboard_link = $dashboard_link;
                    $owner->save();

                    $data = array('name' => $owner->first_name." ".$owner->last_name,'email'=>$owner->email,'password'=>$password,'cik' => $owner->cik,'dashboard_link'=>$owner->dashboard_link);

                    Mail::queue('emails.auth.registermail',$data, function($message) use($owner)
                    {
                        $message->to($owner->email,$owner->first_name." ".$owner->last_name)->subject('Welcome to CarIO');
                    });
                    $fc = 'flash_success';
                    $fm = 'New User created successfully.';
                }
            }
        }

        return Redirect::back()->with($fc, $fm);

    }
}
?>