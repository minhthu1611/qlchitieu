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
                                            <th>Tiền dành dụm</th>
                                            <th>***</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        {{-- @foreach($data as $key=>$val) --}}
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php ?>
                                        {{-- @endforeach --}}
                                        <tr>
                                        <td colspan="5" style="text-align:center">Số tiền bạn đã chắt chiu dành dụm được:{{number_format(($money_saved))}}
                                            {{-- @if($money_can_use-$tien<0)
                                                <p ><h1 class='text-danger'>Bạn đã bị viêm màng túi!<h1></p>
                                            @endif --}}
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
    </script>
@endsection