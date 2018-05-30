@extends('masterlayout')
@section('content')
<div id="content" class="page-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-status bg-red"></div>
                        <div class="card-header">
                            <h3 class="card-title">Thông tin khoản chi</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên khoản chi</label>
                                    <input type="text" class="form-control" name="tenkhoanchi" value="{{old('tenkhoanchi')}}">
                                    <p class="text-danger">{{$errors->first('tenkhoanchi')}}</p>
                                </div>
                                <div class="form-group">
                                        <label>Số tiền</label>
                                        <input type="number" class="form-control" name="sotien" value="{{old('sotien')}}">
                                        <p class="text-danger">{{$errors->first('sotien')}}</p>
                                    </div>
                                <div class="form-group">
                                        <div class="custom-switches-stacked">
                                                <label class="custom-switch">
                                                    <input type="radio" name="bb" class="custom-switch-input"  checked>
                                                    <span class="custom-switch-indicator bg-red"></span>
                                                    <span class="custom-switch-description">Băt buộc</span>
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