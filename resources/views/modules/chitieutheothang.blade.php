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
                                                {{$time=strtotime("-".$i."Months")}}
                                                <option @if($day==date('Y-m',$time)) selected @endif value="{{ date('Y-m',$time) }}">{{date('Y-m', $time)}}</option>
                                            @endfor
                                        </select>
                                    </div>
                            </form>
                        </div>
                        @if($qq==1)
                        <div style="text-align:center; color:red; font-size:20px;">
                                <b>THỜI ĐIỂM NÀY BẠN CHƯA THAM GIA ỨNG DỤNG</b>
                        </div>
                        @endif
                        <div @if($qq==1) hidden @endif>
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="bg-white">
                                                    <td colspan="3" style="text-align:center; color:red; font-size:20px;">
                                                        <b>DANH SÁCH TẤT CẢ KHOẢN CHI BẮT BUỘC TRONG THÁNG</b>
                                                    </td>
                                                </tr>
                                                <tr class="bg-red">
                                                    <th>Stt</th>
                                                    <th>Tên khoản chi</th>
                                                    <th>Số tiền</th>
                                                    <th>Ngày chi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kc as $key=>$val)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$val->tenkhoanchi}}</td>
                                                    <td>{{number_format($val->giatri)}}</td>
                                                    <td>{{substr($val->created_at,0,strpos($val->created_at,' ')) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
        
                                <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr class="bg-white">
                                                        <td colspan="5" style="text-align:center; color:red; font-size:20px;">
                                                            <b>DANH SÁCH TẤT CẢ CHI TIÊU HẰNG NGÀY TRONG THÁNG</b>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-red">
                                                        <th>Stt</th>
                                                        <th>Tên khoản chi</th>
                                                        <th>Số tiền</th>
                                                        <th>Ngày chi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($ctn as $key=>$val)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$val->chitieu}}</td>
                                                        <td>{{number_format($val->giatri)}}</td>
                                                        <td>{{ substr($val->created_at,0,strpos($val->created_at,' ')) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr class="bg-white">
                                                        <td colspan="4" style="text-align:center; color:red; font-size:20px;">
                                                            <b>DANH SÁCH TẤT CẢ KHOẢN THU NHẬP PHÁT SINH TRONG THÁNG</b>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-red">
                                                        <th>Stt</th>
                                                        <th>Tên khoản chi</th>
                                                        <th>Số tiền</th>
                                                        <th>Ngày thu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tnps as $key=>$val)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$val->tenthunhap}}</td>
                                                        <td>{{number_format($val->giatri)}}</td>
                                                        <td>{{ substr($val->created_at,0,strpos($val->created_at,' ')) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="text-align:center;">
                                            <button class="btn btn-success report"> <i class="fe fe-file-text"></i> Xuất excel</button>
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
        $('#query').change(function () { 
                var qq=$(this).val()
                location.href='{{route("tong-chi-tieu-theo-thang")}}?query='+qq
              
            });
        $('.report').click(function (e) { 
            var qq=$('#query').val()
            if(qq==''){
                location.href="{{ route('report2') }}"
            }else{
                location.href="{{ route('report2') }}?query="+qq
            }
            
        });
    </script>
@endsection