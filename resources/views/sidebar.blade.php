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
        <li @if(Request::segment(1)=='trangchu') class='active' @endif>
        <a href="{{route('trangchu')}}"><i class="fe fe-home"></i> Hôm nay ăn gì?</a>
        </li>
        @endif
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
                <a href="#chitieu" data-toggle="collapse" aria-expanded="false"><i class="fe fe-file"></i> Chi tiêu trong ngày<i class="dropdown-toggle float-right"></i></a>
                <ul @if(Request::segment(2)=='them-chi-tieu-ngay'||Request::segment(2)=='thong-ke-chi-tieu') class="collapsed list-unstyled" @endif  id="chitieu" class="collapse list-unstyled" >

                    <li @if(Request::segment(2)=='them-chi-tieu-ngay') class='active' @endif>
                        <a href="{{route('ctn')}}">Thêm chi tiêu</a>
                    </li>
                    <li @if(Request::segment(2)=='thong-ke-chi-tieu') class='active' @endif>
                    <a href="{{route('tkct')}}">Thống kê chi tiêu</a>
                    </li>
                </ul>
            </li>
        <li @if(Request::segment(1)=='edit'||Request::segment(1)=='changepassword') class='active' @endif>
            <a href="#taikhoan" data-toggle="collapse" aria-expanded="false"><i class="fe fe-eye"></i>Tài khoản<i class="dropdown-toggle float-right"></i></a>
            <ul @if(Request::segment(1)=='edit' ||Request::segment(1)=='changepassword') class="collapsed list-unstyled" @endif class="collapse list-unstyled" id="taikhoan">
                <li @if(Request::segment(1)=='edit' ) class='active' @endif ><a href="{{route('edit')}}">Cập nhật thông tin</a></li>
                <li @if(Request::segment(1)=='changepassword') class='active' @endif ><a href="{{route('changepassword')}}">Đổi mật khẩu</a></li>
            </ul>
        </li>
        <li>
        <a href="{{route('logout')}}"><i class="fe fe-power"></i> Đăng xuất</a>
        </li>
    </ul>
</nav>