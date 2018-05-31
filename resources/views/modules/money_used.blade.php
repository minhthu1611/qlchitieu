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
                                            <td>{{$val['tongchi']}}</td>
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
    </script>
@endsection