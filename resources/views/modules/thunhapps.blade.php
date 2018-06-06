@extends('masterlayout')
@section('content')
<div id="content" class="page-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-status bg-red"></div>
                        <div class="card-header">
                            <h3 class="card-title">Thu nhập phát sinh</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên nguồn thu nhập</label>
                                    <input type="text" class="form-control" name="tenthunhap" value="{{old('tenthunhap')}}">
                                    <p class="text-danger">{{$errors->first('tenthunhap')}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Giá trị</label>
                                    <input type="number" class="form-control" name="giatri" value="{{old('giatri')}}">
                                    <p class="text-danger">{{$errors->first('giatri')}}</p>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-danger">Thêm</button>
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