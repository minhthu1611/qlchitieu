@extends('masterlayout')
@section('content')
<div id="content" class="page-main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-status bg-red"></div>
					<div class="card-header">
						<h3 class="card-title">Thao tác</h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						</div>
					</div>
					<div class="card-body">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Gõ vô</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<div class="custom-file">
										<input type="file" class="custom-file-input"  id="imgInp" name="img	">
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
				<div class="card">
					<div class="card-status bg-red"></div>
					<div class="card-header">
						<h3 class="card-title">Preview hình ảnh</h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div class="img-detection">
							<img class="rounded"  id='img-upload' width="100%" src="{!!asset('assets/images/faces.png') !!}" alt="">
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection