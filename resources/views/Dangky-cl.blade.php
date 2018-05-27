<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{!! asset('/assets/css/dashboard.css') !!}" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/custom.css">
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
                        <form action="#">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control">
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