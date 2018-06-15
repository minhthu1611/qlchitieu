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
                                            <?php $time=time()?>
                                            @for($i=0;$i<13;$i++)
                                                {{ $time=strtotime("-".$i."Months") }}
                                                <option @if($day==date('Y-m',$time)) selected @endif value="{{ date('Y-m',$time) }}">{{date('Y-m', $time)}}</option>
                                            @endfor
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
                                          
                                            <th>Khoản bắt buộc</th>
                                            <th>Khoản phát sinh</th>
                                            <th>Tổng chi tiêu</th>
                                            <th>Thu nhập thêm</th>
                                            <th >Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($chihangthang as $key=>$val)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$val['ngaythang']}}</td>
                                           
                                            <td>{{ isset($val['batbuoc'])? number_format($val['batbuoc']).' đ':'0 đ' }}</td>
                                            <td>{{ isset($val['phatsinh'])? number_format($val['phatsinh']).' đ': '0 đ' }}</td>
                                            <td>{{ isset($val['tongchi'])? number_format($val['tongchi']).' đ': '0 đ' }}</td>
                                            <td>{{ isset($val['thunhapps'])? number_format($val['thunhapps']).' đ': '0 đ' }}</td>
                                            <td><a href='{{ route('tong-chi-tieu-theo-thang').'?query='.$val['ngaythang'] }}' class="btn btn-default"> <i class='fe fe-info'></i> Xem chi tiết</a></td>
                                        </tr>
                                        <?php ?>
                                        @endforeach
                                        <tr>
                                            <td colspan="6">
                                                    <button class="btn btn-success report"> <i class="fe fe-file-text"></i> Xuất excel</button>
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
        $('.report').click(function (e) { 
            location.href="{{ route('report') }}"
            
        });
    </script>
@endsection