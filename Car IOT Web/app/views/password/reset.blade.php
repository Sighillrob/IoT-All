<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);

        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
            color: #999;
        }
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<!--Heading-->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">CarIO Password Reset</h3>
    </div>
</div>

<div class="container" style="max-width: 500px;margin: 200px auto;">
    <!--Login-->
    @if(Session::has('flash_error'))
        <div class="alert alert-danger" role="alert">{{Session::get('flash_error')}}</div>
    @endif
    @if(Session::has('flash_success'))
        <div class="alert alert-success" role="alert">{{Session::get('flash_success')}}</div>
    @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Password Reset</h3>
        </div>
        <form action="{{route('forgot_password_reset')}}" method="post">
            <div class="panel-body">
                <div class="form-group input-group">
                    <span class="input-group-addon" id="basic-addon1">Email</span>
                    <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon" id="basic-addon1">Password</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon" id="basic-addon1">Confirm Password</span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1">
                </div>
                <input type="hidden" name="token" value="{{ $token }}">
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success">Reset Password</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
