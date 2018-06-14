<nav id="sidebar">
    <div class="profile">
        <div class="d-flex justify-content-center py-4">
            @if(Auth::guard('user')->user()->avatar!='')
                <span class="avatar avatar-xxl" style="background-image: url({!!asset('/avatar/'.Auth::guard('user')->user()->avatar) !!}"></span>
            @else
                <span class="avatar avatar-xxl" style="background-image: url({!!asset('/avatar/photo.jpg') !!}"></span>
            @endif
        </div>
        <h5 class="text-center">{{Auth::guard('user')->user()->hoten}}</h5>
    </div>
    <ul class="list-unstyled components">
        @if(Auth::guard('user')->user()->level==0)
        <li @if(Request::segment(2)=='user') class='active' @endif>
            <a href="{{route('admin/user')}}"><i class="fe fe-user"></i> Người dùng</a>
        </li>
        @endif
        <li @if(Request::segment(1)=='trangchu') class='active' @endif>
        <a href="{{route('trangchu')}}"><i class="fe fe-home"></i> Hôm nay ăn gì?</a>
        </li>
        <li @if(Request::segment(1)=='khoan-chi-bat-buoc') class='active' @endif>
            <a href="#khoanchibatbuoc" data-toggle="collapse" aria-expanded="false"><i class="fe fe-lock"></i> Khoản chi bắt buộc<i class="dropdown-toggle float-right"></i></a>
                    <ul @if(Request::segment(2)=='themkhoanchi'||Request::segment(2)=='danh-sach-khoan-chi') class="collapsed list-unstyled" @endif  id="khoanchibatbuoc" class="collapse list-unstyled">
                            <li @if(Request::segment(2)=='themkhoanchi') class='active' @endif >
                                    <a  href="{{route('gtkc')}}">Thêm khoản chi</a>
                            </li>
                            <li @if(Request::segment(2)=='danh-sach-khoan-chi') class='active' @endif>
                                    <a href="{{route('dskc')}}">Danh sách khoản chi</a>
                            </li>
                    </ul>
                </li>
        <li>
        <li @if(Request::segment(1)=='chi-tieu') class='active' @endif>
                <a href="#chitieu" data-toggle="collapse" aria-expanded="false"><i class="fe fe-book-open"></i> Chi tiêu trong ngày<i class="dropdown-toggle float-right"></i></a>
                <ul @if(Request::segment(2)=='them-chi-tieu-ngay'||Request::segment(2)=='thong-ke-chi-tieu') class="collapsed list-unstyled" @endif  id="chitieu" class="collapse list-unstyled" >

                    <li @if(Request::segment(2)=='them-chi-tieu-ngay') class='active' @endif>
                        <a href="{{route('ctn')}}">Thêm chi tiêu</a>
                    </li>
                    <li @if(Request::segment(2)=='thong-ke-chi-tieu') class='active' @endif>
                    <a href="{{route('tkct')}}">Thống kê chi tiêu</a>
                    </li>
                </ul>
            </li>
        <li @if(Request::segment(1)=='thu-nhap-phat-sinh') class='active' @endif>
                <a href="#thunhapps" data-toggle="collapse" aria-expanded="false"><i class="fe fe-file"></i>Thu nhập phát sinh<i class="dropdown-toggle float-right"></i></a>
                <ul @if(Request::segment(2)=='thu-nhap-phat-sinh'||Request::segment(2)=='thong-ke-thu-nhap') class="collapsed list-unstyled" @endif  id="thunhapps" class="collapse list-unstyled" >
                    <li @if(Request::segment(2)=='thu-nhap-phat-sinh') class='active' @endif>
                        <a href="{{route('gtnps')}}"><i class=""></i> Thêm thu nhập</a>
                    </li>
                    <li @if(Request::segment(2)=='thong-ke-thu-nhap') class='active' @endif>
                        <a href="{{route('tktn')}}">Thống kê thu nhập</a>
                    </li>
                </ul>
            </li>
        <li>
        <li @if(Request::segment(1)=='money-used') class='active' @endif>
            <a href="{{route('tong-chi-tieu-theo-thang')}}"><i class="fe fe-dollar-sign"></i>Tổng chi tiêu theo tháng</a>
        </li>
        <li @if(Request::segment(1)=='money-used') class='active' @endif>
            <a href="{{route('gmoney-used')}}"><i class="fe fe-dollar-sign"></i>Tổng chi tiêu</a>
        </li>
    </ul>
</nav>