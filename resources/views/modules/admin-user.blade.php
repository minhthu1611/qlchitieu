@extends('masterlayout')
@section('content')
    <div id="content" class="page-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-status bg-red"></div>
                        <div class="card-header">
                            <form action="#">
                                    <div class="input-group justify-content-end">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                        <span class="input-group-append">
                                            <button class="btn btn-danger" type="button"><i class="fe fe-search"></i></button>
                                        </span>
                                    </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="bg-red">
                                            <th><button class="btn btn-danger"><i class="fe fe-trash"></i></button></th>
                                            <th>Stt</th>
                                            <th>Email</th>
                                            <th>Họ và tên</th>
                                            <th>Giới tính</th>
                                            <th>Năm sinh</th>
                                            <th>Địa chỉ</th>
                                            <th>Thu nhập</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key=>$val)
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox ml-3">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="{{$val->id}}" >
                                                    <span class="custom-control-label">&nbsp</span>
                                                </label>
                                            </td>
                                            <td>{{$key+1}}</td>
                                            <td>{{$val->email}}</td>
                                            <td>{{$val->hoten}}</td>
                                            <td>{{$val->gioitinh}}</td>
                                            <td>{{$val->tuoi}}</td>
                                            <td>{{$val->diachi}}</td>
                                            <td>{{number_format($val->thunhap)}}</td>
                                            <td><button class="btn btn-danger"><i class="fe fe-trash"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection