<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email'), function($message){$message->subject('CarIO Password Reset');} ))
		{
			case Password::INVALID_USER:
                $response_array = array( 'success' => false, 'message' => Lang::get($response) );
				//return Redirect::back()->with('error', Lang::get($response));
				return Response::json($response_array, 200);

			case Password::REMINDER_SENT:
                $response_array = array( 'success' => true, 'message' => Lang::get($response) );
				//return Redirect::back()->with('status', Lang::get($response));
                return Response::json($response_array, 200);
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('flash_error', Lang::get($response));

			case Password::PASSWORD_RESET:
                return Redirect::back()->with('flash_success', 'Your password has been reset successfully.');
		}
	}

}
