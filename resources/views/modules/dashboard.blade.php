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
                                            <input type="text" name="query" class="form-control" placeholder="Tìm kiếm...">           
                                            <span class="input-group-append">
                                                <button class="btn btn-danger sub" type="submit"><i class="fe fe-search"></i></button>
                                            </span>                         
                                        </div>
                                </form>
                        </div>
                    </div>
                </div>
                @for($i=0; $i<20 ; $i++)
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-image mb-4 text-center">
                                <img src="/avatar/rau.jpg" alt="">
                            </div>
                            <h3 class="card-title"><a href="#">Sản phẩm</a></h3>

                            <div class="d-flex mt-5 align-items-center flex-row">
                                <div class="product-price">
                                    <strong>690000đ</strong>
                                </div>
                                <div class="ml-auto">
                                    <a href="#" class="btn btn-danger"><i class="fe fe-shopping-cart"></i> Đặt hàng</a>
                                </div>
                            </div>
                            <p class="mt-3" style="color:#ccc; font-size:13px;">Product from nongsancairang.com</p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
@endsection