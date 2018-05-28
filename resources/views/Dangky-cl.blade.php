<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{!! asset('/assets/css/dashboard.css') !!}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/assets/css/custom.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center pt-5">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-status bg-red"></div>
                    <div class="card-header">
                        <h3 class="card-title">Đăng ký</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="radio" name="sex" class="custom-switch-input" value="Nam" checked>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Nam</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="radio" name="sex" class="custom-switch-input" value="Nữ">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Nữ</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Năm sinh</label>
                                <input type="number" class="form-control" name="namsinh">
                                <p class="text-danger">{{$errors->first('namsinh')}}</p>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group">
                                <label>Thu nhập</label>
                                <input type="number" class="form-control" name="thunhap">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-danger">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>