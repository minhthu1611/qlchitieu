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
        <li class="active">
            <a href="{{route('admin/user')}}"><i class="fe fe-user"></i> Người dùng</a>
            {{-- <ul class="collapse list-unstyled" id="diemdanh">
                <li class="active"><a href="#">Điểm danh bằng tay</a></li>
                <li><a href="#">Điểm danh tự động</a></li>
                <i class="dropdown-toggle float-right"></i>
            </ul> --}}
        </li>
        @else
        <li class="active">
                <a href=""> Home</a>
        </li>
        @endif
        <li>
            <a  href="{{route('gtkc')}}"><i class="fe fe-airplay"></i> Thêm khoản chi</a>
        </li>
        <li>
        <a href="{{route('dskc')}}"><i class="fe fe-globe"></i> Danh sách khoản chi</a>
        </li>
        <li>
            <a href="#quanly" data-toggle="collapse" aria-expanded="false"><i class="fe fe-eye"></i> Quản lý<i class="dropdown-toggle float-right"></i></a>
            <ul class="collapse list-unstyled" id="quanly">
                <li><a href="#">Quản lý môn học</a></li>
                <li><a href="#">Thêm môn học</a></li>
                <li><a href="#">Quản lý 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fe fe-power"></i> Sửa buổi vắng</a>
        </li>
    </ul>
</nav>