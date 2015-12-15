<?php

class UserController extends BaseController {

 

	public function login()
	{
		return View::make('userlogin');
	}

	public function loginProcess()
	{
        $email = Input::get('email');
        $password = Input::get('password');
        $validator = Validator::make(
            array(
                'password' => $password,
                'email' => $email
            ),
            array(
                'password' => 'required',
                'email' => 'required|email'
            )
        );

        if ($validator->fails())
        {
            $error_messages = $validator->messages()->all();
            Log::error('Validation error during manual login for owner = '.print_r($error_messages, true));
            return Redirect::back()->with('flash_errors',$error_messages);
        }
        else
        {
            if(Auth::attempt(array('email' => $email, 'password' => $password, 'role_id' => 2)))
            {
                return Redirect::route('userMangement')->with('flash_success',"Login successful");
            }
            else
            {
                return Redirect::back()->with('flash_error',"Incorrect email and  password combination.");
            }
        }
	}

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }

 
	
	
}
