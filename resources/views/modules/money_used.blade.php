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
                                        <select name="query" id="query" class="form-control">
                                            <option value="">--Thời điểm--</option>
                                            <option value="2018-01">01-2018</option>
                                            <option value="2018-02">02-2018</option>
                                            <option value="2018-03">03-2018</option>
                                            <option value="2018-04">04-2018</option>
                                            <option value="2018-05">05-2018</option>
                                            <option value="2018-06">06-2018</option>
                                        </select>
                                        {{-- <input type="text" name="query" class="form-control" placeholder="Tìm kiếm...">
                                        <span class="input-group-append">
                                            <button class="btn btn-danger sub" type="submit"><i class="fe fe-search"></i></button>
                                        </span> --}}
                                 
                                    </div>
                                </form>
                                <button id='find-all' type="" class="btn btn-danger">Hiển thị tất cả</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="bg-red">
                                            <th>Stt</th>
                                            <th>Tháng</th>
                                            <th>Tổng chi tiêu hàng tháng</th>
                                            <th>***</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($chihangthang as $key=>$val)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$val['ngaythang']}}</td>
                                            <td>{{number_format($val['tongchi'])}}</td>
                                            <td></td>
                                        </tr>
                                        <?php ?>
                                        @endforeach
                                        <tr>
                                       
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
    <script>
        $('#query').change(function () { 
                var qq=$(this).val()
                location.href='{{route("gmoney-used")}}?query='+qq
                console.log(qq)
            });
        $('#find-all').click(function () { 
            var cc=''
            location.href='{{route("gmoney-used")}}?query='+cc
            console.log(cc)
        });
    </script>
@endsection