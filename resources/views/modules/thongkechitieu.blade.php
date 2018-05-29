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
                                            <th>Chi tiêu ngày</th>
                                            <th>Giá trị</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tien=0 ?>
                                        @foreach($data as $key=>$val)
                                     
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox ml-3">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="{{$val->id}}" >
                                                    <span class="custom-control-label">&nbsp</span>
                                                </label>
                                            </td>
                                            <td>{{$key+1}}</td>
                                            <td>{{($val->chitieu)}}</td>
                                            <td>{{number_format($val->giatri)}}</td>
                                            <td><button class="btn btn-danger delete"><i class="fe fe-trash"></i></button></td>
                                        </tr>
                                        <?php $tien+=$val->giatri;?>
                                        @endforeach
                                        <tr>
                                        <td colspan="5" style="text-align:center">Số tiền còn lại:{{number_format(($info->thunhap)-$tien)}}</td>
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
        // $('.delete').click(function () { 
        //     var t=$(this).closest('tr').find('input:checkbox').val()
        //     $.ajax({
        //         type: "post",
        //         url: "{{route('delete_kc')}}",
        //         data: {
        //             "_token":"{{csrf_token()}}",
        //             'id':t
        //         },
        //         success: function (response) {
        //             if(response=='ok')
        //                 location.reload()
        //         }
        //     });   
        // });
        $('.delete').click(function () { 
            
            bootbox.confirm("Are you sure?", function(result) {
                // if(result)
                // {
 
                //     var t=$(this).closest('tr').find('input:checkbox').val()
                //     $.ajax({
                //         type:"post",
                //         url: "{{route('delete_ct')}}",
                //         data: {
                //             "_token":"{{csrf_token()}}",
                //             'id':t
                //         },
                //         success: function (response) {
                //             if(response=='ok')
                //                 location.reload()
                //         }

                //     })
                // }
            }); 
            
        });
    </script>
@endsection