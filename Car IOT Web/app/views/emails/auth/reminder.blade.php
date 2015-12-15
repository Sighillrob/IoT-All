<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>CarIO Password Reset</h2>

		<div>
            To reset your password, please <a href="{{ URL::route('forgot_password_form', array($token)) }}">Click here</a> <br/>
            OR <br/>

            Paste the following URL into your browser {{ URL::route('forgot_password_form', array($token)) }}.<br/>

			This link is valid for the next {{ Config::get('auth.reminder.expire')/60 }} hours.
		</div>
	</body>
</html>
