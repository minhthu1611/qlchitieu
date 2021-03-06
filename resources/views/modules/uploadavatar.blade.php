@extends('masterlayout')
@section('content')
<div id="content" class="page-main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-status bg-red"></div>
					<div class="card-header">
						<h3 class="card-title">Sửa thông tin cá nhân</h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						</div>
					</div>
					<div class="card-body">
						<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label>Họ tên</label>
								<input type="text" class="form-control" name="name" value="{{$info->hoten}}">
								<p class="text-danger">{{$errors->first('name')}}</p>
							</div>
							<div class="form-group">
									<label>Năm sinh</label>
									<input type="text" class="form-control" name="namsinh" value="{{$info->tuoi}}">
									<p class="text-danger">{{$errors->first('namsinh')}}</p>
								</div>
							<div class="form-group">
								<label>Địa chỉ</label>
								<input type="text" class="form-control" name="diachi" value="{{$info->diachi}}">
								<p class="text-danger">{{$errors->first('diachi')}}</p>
							</div>
							<div class="form-group">
								<label>Thu nhập</label>
								<input type="text" class="form-control" id='sotien' name="thunhap" value="{{$info->thunhap}}">
								<p class="text-success"></p>
								<p class="text-danger">{{$errors->first('thunhap')}}</p>
							</div>
							<div class="form-group">
								<label> Avatar</label>
								<div class="custom-file">
										<input type="file" class="custom-file-input"  id="imgInp" name="img">
										<label class="custom-file-label">Tải tệp lên</label>
								</div>
							</div>
							<div class="text-right">
								<button class="btn btn-primary">Submit</button>
							</div>
						</form>
						
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card" style="height:565px;">
					<div class="card-status bg-red"></div>
					<div class="card-header">
						<h3 class="card-title">Preview hình ảnh</h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div class="img-detection">
							@if(Auth::guard('user')->user()->avatar!='')
							<img class="rounded"  id='img-upload' width="100%" src="{{asset('/avatar/'.Auth::guard('user')->user()->avatar)}}" alt="">
							@else
							<img class="rounded"  id='img-upload' width="100%" src="{{asset('/avatar/photo.jpg')}}" alt="">
							@endif
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
	<script>
		$(document).ready(function () {
            change_money()
        });
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        $('#sotien').keyup(function (e) { 
            change_money()
        });
        function change_money(){
            var t=$('#sotien').val().replace(/[,]/g,'');
           
           var k=addCommas(t)
         
          $('.text-success').text(addCommas(k)+' VNĐ')
        }
	</script>
@endsection