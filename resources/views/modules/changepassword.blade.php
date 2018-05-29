@extends('masterlayout')
@section('content')
<div id="content" class="page-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-status bg-red"></div>
                        <div class="card-header">
                            <h3 class="card-title">Đổi mật khẩu</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Mật khẩu cũ</label>
                                    <input type="password" class="form-control" name="now_password">
                                    <p class="text-danger">{{$errors->first('now_password')}}</p>
                                    @if(Session::has('errorpassword'))
                                    <p class="text-danger">{{Session::get('errorpassword')}}</p>
                                   @endif
                                </div>
                                <div class="form-group">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" class="form-control" name="password" >
                                        <p class="text-danger">{{$errors->first('password')}}</p>
                                       
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu mới</label>
                                    <input type="password" class="form-control" name="password_confirmation" >
                                    <p class="text-danger">{{$errors->first('password')}}</p>
                            </div>
                    
                                <div class="text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    @if(Session::has('error'))
    <script>
        mess('error',"{{Session::get('error')}}")
    </script>
    @endif
    @if(Session::has('message'))
    <script>
        mess('error',"{{Session::get('message')}}")
    </script>
    @endif
@endsection