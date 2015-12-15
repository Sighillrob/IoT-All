<?php

class ApiController extends \BaseController {








	public function register()
	{
		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');
		$email = Input::get('email');
		$phone = Input::get('phone');
		$password = Input::get('password');
		$device_token = Input::get('device_token');
		$device_type = Input::get('device_type');

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
					'phone' => 'required',
					'password' => 'required',
					'email' => 'required|email',
					'first_name' => 'required',
					'last_name' => 'required',
					'device_token' => 'required',
					'device_type' => 'required|in:android,ios'
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

			Log::info('Error while during owner registration = '.print_r($error_messages, true));
			$response_array = array('success' => false, 'error' => 'Invalid Input', 'error_code' => 401, 'error_messages' => $error_messages );
			$response_code = 200;
		}
		else {

			if (User::where('email', '=', $email)->first()) {
				$response_array = array('success' => false, 'error' => 'Email ID already Registred', 'error_code' => 402);
				$response_code = 200;
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
				 
 				$ckj_assign = Cik::where('status',0)->first(); /*New Unassigned cik will be assigned to every newly registered user*/
 				//$ckj_assign = Cik::first(); /*The first cik will be assigned to every newly registered user*/
 				if($ckj_assign == Null)
 				{
 					//$owner->cik = 'Not Available';
 					  $response_array = array(
								'success' => false,
								'error' => 'Cik Not Available',
                                'error_code' => 405
							);

					$response_code = 200;
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

				    $response_array = array(
								'success' => true,
								'id' => $owner->id,
								'first_name' => $owner->first_name,
								'last_name' => $owner->last_name,
								'phone' => $owner->phone,
								'email' => $owner->email,
								'device_token' => $owner->device_token,
								'device_type' => $owner->device_type,
								'token' => $owner->token,
								'photo'=>  $owner->photo,
								'cik' => $owner->cik,
								'dashboard_link' =>  $owner->dashboard_link
							);

					$response_code = 200;

            $data = array('name' => $owner->first_name." ".$owner->last_name,'email'=>$owner->email,'password'=>$password,'cik' => $owner->cik,'dashboard_link'=>$owner->dashboard_link);

            Mail::queue('emails.auth.registermail',$data, function($message) use($owner)
            {
                $message->to($owner->email,$owner->first_name." ".$owner->last_name)->subject('Welcome to CarIO');
            });
 				}
				
			

			}
		}

		response:
		$response = Response::json($response_array, $response_code);
		return $response;

	}

	public function get_personal_setting()
	{
		 $user_id = Input::get('user_id');
		 $get_personal=User::where('id',$user_id)->first();
		 if($get_personal != Null)
		 {
		 	$response_array = array(
								'success' => true,
								'first_name' => $get_personal->first_name,
								'last_name' => $get_personal->last_name,
								'country' => $get_personal->country,
								'address' => $get_personal->address,
								'gender' => $get_personal->gender,
								'dob' => $get_personal->dob,
								'photo' => $get_personal->photo

							);

					$response_code = 200;

		 }else
		 {
		 	$response_array = array(
								'success' => false,
								'message' => 'Enter vaild User Id'
							);

					$response_code = 200;

		 }

		 $response = Response::json($response_array, $response_code);
		return $response;
	}

	public function personal_setting()
	{
		$user_id = Input::get('user_id');
		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');
		$country = Input::get('country');
		$address = Input::get('address');
		$gender = Input::get('gender');
		$dob = Input::get('dob');
		$image = Input::file('photo');
		 
		if($user_id != Null)
		{
			 

		 if($image) {

	        $filename = $image->getClientOriginalName();

	        $filename = pathinfo($filename, PATHINFO_FILENAME);

	        $fullname = Str::slug(Str::random(8) . $filename) . '.' .$image->getClientOriginalExtension();

	        $upload = $image->move(public_path().'/uploads/photo', $fullname);

		 } else {
		 	$fullname = "";
		 }
		
			 $user = User::find($user_id);
        	$user->first_name = $first_name;
        	$user->last_name = $last_name;
        	$user->country = $country;
        	$user->address = $address;
        	$user->gender = $gender;
        	$user->dob = $dob;
        	$user->photo = $fullname;
        	$user->save();
        	$get_personal=User::where('id',$user_id)->first();
        	$response_array = array(
								'success' => true,
								'first_name' => $get_personal->first_name,
								'last_name' => $get_personal->last_name,
								'country' => $get_personal->country,
								'address' => $get_personal->address,
								'gender' => $get_personal->gender,
								'dob' => $get_personal->dob,
								'photo' => $get_personal->photo

							);

					$response_code = 200;
			

		}
		else
		{
			$response_array = array(
								'success' => false,
								'message' => 'Enter vaild User Id'
							);

					$response_code = 200;
		}

		$response = Response::json($response_array, $response_code);
		return $response;
	}


public function get_security_setting()
{
$user_id = Input::get('user_id');
if (Input::has('user_id'))
		{
			$user = User::where('id',$user_id)->first();
			$response_array = array(
								'success' => true,
								'email' => $user->email,
								'phone' => $user->phone
							);

			$response_code = 200;
				
		}	
else
		{
			$response_array = array(
								'success' => false,
								'message' => 'Enter vaild User Id'
							);

					$response_code = 200;
		}

		$response = Response::json($response_array, $response_code);
		return $response;
}
	public function security_setting()
	{

		$user_id = Input::get('user_id');
		$email = Input::get('email');
		$phone = Input::get('phone');
		$password = Input::get('retype_password');


		if (Input::has('user_id') && Input::has('retype_password')) {
			$user = User::where('id',$user_id)->first();
				if (Hash::check($password, $user->password)) {
						if(Input::has('email'))
						{
							if (User::where('email', '=', $email)->first()) {
							$response_array = array('success' => false, 'error' => 'Email ID already Registred', 'error_code' => 402);
							$response_code = 200;
							}
							else
							{
								 $user = User::find($user_id);
        						 $user->email = $email;
        						 $user->phone = $phone; 
        						 $user->save();
        						 $response_array = array('success' => true, 'message' => 'User Updated Successfully');
								 $response_code = 200;

							}

						}
						 	
				}
				else
						{
							$response_array = array('success' => true,
									 'error' => 'Invalid Userid and Password',
									 'error_code' => 403
									  );
									$response_code = 200;

						}
		}
		else
		{
			$response_array = array('success' => false, 'error' => 'Enter Userid and Password', 'error_code' => 403);
						$response_code = 200;

		}


		$response = Response::json($response_array, $response_code);
		return $response;
		 

	}

	public function login()
	{
		 
		$device_token = Input::get('device_token');
		$device_type = Input::get('device_type');

		if (Input::has('email') && Input::has('password')) {
			$email = Input::get('email');
			$password = Input::get('password');
			$validator = Validator::make(
				array(
					'password' => $password,
					'email' => $email,
					'device_token' => $device_token,
					'device_type' => $device_type
					
				),
				array(
					'password' => 'required',
					'email' => 'required|email',
					'device_token' => 'required',
					'device_type' => 'required|in:android,ios'
				)
			);

			if ($validator->fails()) {
				$error_messages = $validator->messages()->all();
				$response_array = array('success' => false, 'error' => 'Invalid Input', 'error_code' => 401, 'error_messages' => $error_messages );
				$response_code = 200;
				Log::error('Validation error during manual login for owner = '.print_r($error_messages, true));
			} 
			else {
				if ($owner = User::where('email', '=', $email)->first()) {
					if (Hash::check($password, $owner->password)) {
						 
							if ($owner->device_type != $device_type) {
								$owner->device_type = $device_type;
							}
							if ($owner->device_token != $device_token) {
								$owner->device_token = $device_token;
							}
							$owner->token = generate_token();
							$owner->token_expiry = generate_expiry();
						
							$owner->save();

							

							 
			 

							$response_array = array(
								'success' => true,
								'id' => $owner->id,
								'first_name' => $owner->first_name,
								'last_name' => $owner->last_name,
								'phone' => $owner->phone,
								'email' => $owner->email,
								'device_token' => $owner->device_token,
								'device_type' => $owner->device_type,
								'cik' =>  $owner->cik,
								'dashboard_link' =>  $owner->dashboard_link
							);

							
							$response_code = 200;
						
					} else {
						$response_array = array('success' => false, 'error' => 'Invalid Username and Password', 'error_code' => 403);
						$response_code = 200;
					}
				} else {
					$response_array = array('success' => false, 'error' => 'Not a Registered User', 'error_code' => 404);
					$response_code = 200;
				}
			}
		} 
		else{
			$response_array = array('success' => false, 'error' => 'Invalid input', 'error_code' => 404);
					$response_code = 200;
		}

		$response = Response::json($response_array, $response_code);
		return $response;

	}

	public function add_car_details()
	{
		$user_id = Input::get('user_id');
		$car_make = Input::get('car_make');
		$car_model = Input::get('car_model');
		$car_year = Input::get('car_year');
		$car_engine_no = Input::get('engine_no');
		if (Input::has('user_id'))
		{

		$car = Cardetail::where('user_id',$user_id)->first();
				if($car == Null)
				{
				$car = new Cardetail;
				$car->user_id = $user_id;
				$car->car_make = $car_make;
				$car->car_model = $car_model;
				$car->car_year = $car_year;
				$car->car_engine_no = $car_engine_no;
				$car->save();
				$response_array = array('success' => true, 'message' => 'Car Details Added Successfully');
				$response_code = 200;
				}
				else
				{
					$response_array = array(
								'success' => false,
								'message' => 'Car details already exists'
							);

					$response_code = 200;

				}

		$response = Response::json($response_array, $response_code);
		return $response;

	}
	else
	{
		$response_array = array(
								'success' => false,
								'message' => 'Enter vaild User Id'
							);

					$response_code = 200;

	}

	}

	public function get_car_details()
{
$user_id = Input::get('user_id');
if (Input::has('user_id'))
		{
			$car = Cardetail::where('user_id',$user_id)->first();

			if($car == Null)
			{
					$response_array = array(
								'success' => true,
								'car_make' =>  '',
								'car_model' =>  '',
								'car_year' =>  '',
								'car_engine_no'=>'' 

							);

			$response_code = 200;

			}else
			{
			$response_array = array(
								'success' => true,
								'car_make' => $car->car_make,
								'car_model' => $car->car_model,
								'car_year' => $car->car_year,
								'car_engine_no'=>$car->car_engine_no

							);

			$response_code = 200;
		}
				
		}	
else
		{
			$response_array = array(
								'success' => false,
								'message' => 'Enter vaild User Id'
							);

					$response_code = 200;
		}

		$response = Response::json($response_array, $response_code);
		return $response;
}

public function edit_car_details()
{

	$user_id = Input::get('user_id');
		$car_make = Input::get('car_make');
		$car_model = Input::get('car_model');
		$car_year = Input::get('car_year');
		$car_engine_no = Input::get('engine_no');
		if (Input::has('user_id'))
		{
				$car = Cardetail::where('user_id',$user_id)->first();
				if($car == Null)
				{
					$response_array = array(
								'success' => false,
								'message' => 'First enter your car details'
							);

					$response_code = 200;

				}else
				{
				$car->user_id = $user_id;
				$car->car_make = $car_make;
				$car->car_model = $car_model;
				$car->car_year = $car_year;
				$car->car_engine_no = $car_engine_no;
				$car->save();
				$response_array = array(
								'success' => true,
								'car_make' => $car->car_make,
								'car_model' => $car->car_model,
								'car_year' => $car->car_year,
								'car_engine_no'=>$car->car_engine_no

							);

			$response_code = 200;
			}
		}

		else
		{
			$response_array = array(
								'success' => false,
								'message' => 'Enter vaild User Id'
							);

					$response_code = 200;
		}

		$response = Response::json($response_array, $response_code);
		return $response;

}

public function get_code_details()
{

	$code_id = Input::get('code_id');
		if (Input::has('code_id'))
		{
				$code = CodeDetails::where('code_id',$code_id)->first();
				if($code){
				$response_array = array(
								'success' => true,
								'code_id' => $code->code_id,
								'text' => $code->text,
								'car_year' => $code->response,
							);

			$response_code = 200;
		}else
		{
			$response_array = array(
								'success' => false,
								'message' => 'Invalid Code ID'
							);

					$response_code = 200;
		}
			
		}

		else
		{
			$response_array = array(
								'success' => false,
								'message' => 'Enter code Id'
							);

					$response_code = 200;
		}

		$response = Response::json($response_array, $response_code);
		return $response;

}

 
}
