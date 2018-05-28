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
                                    <input type="text" class="form-control" name="tenkhoanchi" value="">
                                    <p class="text-danger">{{$errors->first('tenkhoanchi')}}</p>
                                </div>
                                <div class="form-group">
                                        <label>Số tiền</label>
                                        <input type="number" class="form-control" name="sotien" value="">
                                        <p class="text-danger">{{$errors->first('sotien')}}</p>
                                    </div>
                                <div class="form-group">
                                        <div class="custom-switches-stacked">
                                                <label class="custom-switch">
                                                    <input type="radio" name="bb" class="custom-switch-input" value="1" checked>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Băt buộc</span>
                                                </label>
                                                <label class="custom-switch">
                                                    <input type="radio" name="bb" class="custom-switch-input" value="0">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Không bắt buộc</span>
                                                </label>
                                        </div>
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
@endsection