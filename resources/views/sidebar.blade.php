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
        @else
        <li>
        <a href="{{route('trangchu')}}"> Home</a>
        </li>
        @endif
        <li @if(Request::segment(1)=='khoan-chi-bat-buoc') class='active' @endif>
            <a href="#khoanchibatbuoc" data-toggle="collapse" aria-expanded="false"><i class="fe fe-eye"></i> Khoản chi bắt buộc<i class="dropdown-toggle float-right"></i></a>
                    <ul @if(Request::segment(2)=='themkhoanchi'||Request::segment(2)=='danh-sach-khoan-chi') class="collapsed list-unstyled" @endif  id="khoanchibatbuoc" class="collapse list-unstyled">
                            <li @if(Request::segment(2)=='themkhoanchi') class='active' @endif >
                                    <a  href="{{route('gtkc')}}"><i class="fe fe-airplay"></i> Thêm khoản chi</a>
                            </li>
                            <li @if(Request::segment(2)=='danh-sach-khoan-chi') class='active' @endif>
                                    <a href="{{route('dskc')}}"><i class="fe fe-globe"></i> Danh sách khoản chi</a>
                            </li>
                    </ul>
                </li>
        <li>
        <li @if(Request::segment(1)=='chi-tieu') class='active' @endif>
                <a href="#chitieu" data-toggle="collapse" aria-expanded="false"><i class="fe fe-eye"></i> Chi tiêu trong ngày<i class="dropdown-toggle float-right"></i></a>
                <ul @if(Request::segment(2)=='them-chi-tieu-ngay'||Request::segment(2)=='thong-ke-chi-tieu') class="collapsed list-unstyled" @endif  id="chitieu" class="collapse list-unstyled" >

                    <li @if(Request::segment(2)=='them-chi-tieu-ngay') class='active' @endif>
                        <a href="{{route('ctn')}}">Thêm chi tiêu</a>
                    </li>
                    <li @if(Request::segment(2)=='thong-ke-chi-tieu') class='active' @endif>
                    <a href="{{route('tkct')}}">Thống kê chi tiêu</a>
                    </li>
                </ul>
            </li>
        <li>
            <a href="#quanly" data-toggle="collapse" aria-expanded="false"><i class="fe fe-eye"></i> Thống kê<i class="dropdown-toggle float-right"></i></a>
            <ul class="collapse list-unstyled" id="quanly">
                <li><a href="#">Số tiền còn được sử dụng trong tháng</a></li>
                <li><a href="#"></a></li>
                <li><a href="#">Quản lý 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fe fe-power"></i> Sửa buổi vắng</a>
        </li>
    </ul>
</nav>