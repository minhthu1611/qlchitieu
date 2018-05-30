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
                                            <button class="btn btn-danger delete-all" type="button"><i class="fe fe-search"></i></button>
                                        </span>
                                    </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="bg-red">
                                            <th><button class="btn btn-danger delete-all"><i class="fe fe-trash"></i></button></th>
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
                                                    <input type="checkbox" class="custom-control-input" name="qq" value="{{$val->id}}" >
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
                                            <td><button class="btn btn-danger delete"><i class="fe fe-trash"></i></button></td>
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
    <script>
        $('.delete').click(function () { 
                var t=$(this).closest('tr').find('input:checkbox').val()
                bootbox.confirm({ 
                    size: "small",
                    message: "Are you sure?", 
                    callback: function(result){ 
                        if(result)
                        {
                            $.ajax({
                                type: "post",
                                url: "{{route('delete_user')}}",
                                data: {
                                    "_token":"{{csrf_token()}}",
                                    'id':t
                                },
                                success: function (response) {
                                    if(response=='ok')
                                        location.reload()
                                }
                            });   
                        }    
                    }   
                })    
            });

            $('.delete-all').click(function (e) { 
            var id=[]
            $('input[name="qq"]:checked').each(function() {
                id.push(this.value)
            });
            bootbox.confirm({ 
                    size: "small",
                    message: "Are you sure?", 
                    callback: function(result){ 
                        if(result)
                        {
                            $.ajax({
                                type: "post",
                                url: "{{route('delete_nuser')}}",
                                data: {
                                    '_token':'{{csrf_token()}}',
                                    'id':id
                                },
                                success: function (response) {
                                    if(response=='ok')
                                        location.reload()
                                }
                            });
                        }
                        else
                        {
                            $('input[name="qq"]:checked').each(function() {
                               $(this).prop('checked',false)
                            });
                        }   
                    }   
                })     
        });    
    </script>
@endsection