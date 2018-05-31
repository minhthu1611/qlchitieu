@extends('masterlayout')
@section('content')
<div id="content" class="page-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-status bg-red"></div>
                        <div class="card-header">
                            <form action="" method="get" id="myform">
                                    <div class="input-group justify-content-end">
                                     
                                        <input type="text" name="query" class="form-control" placeholder="Tìm kiếm...">
                                       
                                        <span class="input-group-append">
                                            <button class="btn btn-danger sub" type="submit"><i class="fe fe-search"></i></button>
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
                                            <th>Tên khoản chi</th>
                                            <th>Số tiền</th>
                                            <th>Tháng năm</th>
                                            <th>Bắt buộc</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tien=0; ?>
                                        @foreach($data as $key=>$val)
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox" style="margin-left:-10px;">
                                                    <input type="checkbox" class="custom-control-input" name="qq" value="{{$val->id}}" >
                                                    <span class="custom-control-label">&nbsp</span>
                                                </label>
                                            </td>
                                            <td>{{$key+1}}</td>
                                            <td>{{$val->tenkhoanchi}}</td>
                                            <td>{{number_format($val->giatri)}}</td>
                                            <td>{{$val->ngaythang}}</td>
                                            <td>{{$val->batbuoc}}</td>
                                            <td><button class="btn btn-danger delete"><i class="fe fe-trash"></i></button></td>
                                        </tr>
                                        <?php $tien+=$val->giatri;?>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" style="text-align:center;">
                                                Tổng các khoản chi bắt buộc: {{number_format($tien)}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
    <script>
        mess('success',"{{Session::get('message')}}")
    </script>
    @endif
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
                                url: "{{route('delete_kc')}}",
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
                                url: "{{route('delete_nkc')}}",
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
        // $('.sub').click(function (e) { 
        //   $('#myform').submit()
            
        // });
    </script>
@endsection