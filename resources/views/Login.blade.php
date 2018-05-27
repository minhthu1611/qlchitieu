<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<form action="" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<body>
    <div class="container-fluid">
       <div class="row justify-content-md-center">
            <div class="col-lg-5">
                <div class="pt-5">
                    <div class="card card-default pt-5">
                        <div class="card-heading">
                            <h1 class="text-center">Admin Login</h1>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username">
                                    <p class='text-danger'> {{$errors->first('username') }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="pass">
                                    <p class='text-danger'> {{$errors->first('pass') }}</p>
                                    @if(Session::has('message'))
                                        <p class='text-danger'>{{Session::get('message')}}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-danger" type="submit">Đăng nhập</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</body>
</form>
</html>