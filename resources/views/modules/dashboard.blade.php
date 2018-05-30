@extends('masterlayout')
@section('content')
    <div id="content" class="page-main">        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-end">
                                <form action="" method="get" id="myform">
                                        <div class="input-group justify-content-end">
                                            <input type="number" name="query" class="form-control" placeholder="Tìm kiếm...">           
                                            <span class="input-group-append">
                                                <button class="btn btn-danger sub" type="submit"><i class="fe fe-search"></i></button>
                                            </span>                         
                                        </div>
                                </form>
                        </div>
                    </div>
                </div>
               @foreach($data as $value)
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-image mb-4 text-center">
                                <img src="https://nongsancairang.com/upload/sanpham/{{$value->images}}" alt="">
                            </div>
                            <h3 class="card-title"><a href="https://nongsancairang.com/san-pham/{{$value->id}}">{{$value->tensanpham}}</a></h3>

                            <div class="d-flex mt-5 align-items-center flex-row">
                                <div class="product-price">
                                    <strong>{{number_format($value->gia)}} đ</strong>
                                </div>
                                <div class="ml-auto">
                                    <a href="https://nongsancairang.com/san-pham/{{$value->id}}" class="btn btn-danger"><i class="fe fe-shopping-cart"></i> Đặt hàng</a>
                                </div>
                            </div>
                            <p class="mt-3" style="color:green; font-size:13px; font-weight:bold;">Product from nongsancairang.com</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection