<div class="header py-2">
  <div class="container-fluid">
    <div class="d-flex">
      <button type="button" id="sidebarCollapse" class="btn btn-primary btn-sidebar mr-1">
        <i class="fa fa-bars"></i>
    </button>      
    <div class="d-flex order-lg-2 ml-auto">
        <!-- Notification -->
        @if($error=='error')
        <div class="dropdown d-none d-md-flex">
          <a class="nav-link icon" data-toggle="dropdown">
            <i class="fe fe-bell"></i>
            <span class="nav-unread"></span>
          </a>
        
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
         
         
              <a href="{{route('gtkc')}}" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                <div>
                  <strong>Cập nhật khoản chi bắt buộc trong tháng này!!!</strong>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              {{-- <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a> --}}
            </div>
           
         
        </div>
        @endif
        <!-- end: Notification -->
        <!-- User -->
        <div class="dropdown">
            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
              @if(Auth::guard('user')->user()->avatar!='')
                <span class="avatar" style="background-image: url({{asset('/avatar/'.Auth::guard('user')->user()->avatar)}}"></span>
              @else
                <span class="avatar" style="background-image: url({!!asset('/avatar/photo.jpg') !!}"></span>
              @endif  
                <span class="ml-2 d-none d-lg-block">
                  <span class="text-default">{{Auth::guard('user')->user()->hoten}}</span>
                  @if(Auth::guard('user')->user()->level==0)
                  <small class="text-muted d-block mt-1">Administrator</small>
                  @else
                  <small class="text-muted d-block mt-1">User</small>
                  @endif
                </span>
              </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="{{route('edit')}}">
               Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('changepassword')}}">
               Change password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('logout')}}">
               Sign out
            </a>
          </div>
        </div>
        <!-- end: User -->
      </div>
    </div>
  </div>
</div>