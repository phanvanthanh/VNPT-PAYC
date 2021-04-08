@extends('layouts.front-end')
@section('title', 'Đăng ký')
@section('content')
	<div class="col-12 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 text-center">
						<h3 class="card-title"><b class="color-vnpt"><br><br><br>ĐĂNG KÝ TÀI KHOẢN<br></b></h3>
					</div>
					<div class="col-3">&nbsp;</div>
					<div class="col-6">
						{{-- <h3 class="card-title"><b class="color-vnpt"><br><br><br>ĐĂNG KÝ TÀI KHOẢN<br></b></h3> --}}
						@if (session()->has('notification'))
							<div class="row">
								<div class="col-12">
									<div class="alert alert-success">
									    <div class="notification">
									        {!! session('notification') !!}
									    </div>
									</div>
								</div>
							</div>
						@endif
						<form class="forms-sample" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
							  	<label for="name" class="col-sm-3 col-form-label">Họ và tên <b class="text-danger">(*)</b></label>
							  	<div class="col-sm-9 text-left">
							    	<input type="Text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} name" name="name" placeholder="Nhập họ và tên người tạo" value="{{ old('name')}}" required="required">
							  	</div>
							  	@if ($errors->has('name'))
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $errors->first('name') }}</strong>
						            </span>
						        @endif
							</div>
							<div class="form-group row">
							  	<label for="ten-dang-nhap" class="col-sm-3 col-form-label">Email đăng nhập <b class="text-danger">(*)</b></label>
							  	<div class="col-sm-9 text-left">
							    	<input type="Email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Nhập địa chỉ email (sử dụng làm tên đăng nhập)" value="{{ old('email')}}" required="required">
							    	@if ($errors->has('email'))
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $errors->first('email') }}</strong>
							            </span>
							        @endif
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="mat-khau" class="col-sm-3 col-form-label">Mật khẩu <b class="text-danger">(*)</b></label>
							  	<div class="col-sm-9 text-left">
							    	<input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Mật khẩu" required="required">
							    	@if ($errors->has('password'))
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $errors->first('password') }}</strong>
							            </span>
							        @endif
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="password-confirm" class="col-sm-3 col-form-label">Xác nhận lại mật khẩu <b class="text-danger">(*)</b></label>
							  	<div class="col-sm-9 text-left">
							    	<input type="password" name="password_confirm" class="form-control {{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" placeholder="Xác nhận lại mật khẩu" required="required">
							    	@if ($errors->has('password-confirm'))
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $errors->first('password-confirm') }}</strong>
							            </span>
							        @endif
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="di_dong" class="col-sm-3 col-form-label">Số điện thoại di động <b class="text-danger">(*)</b></label>
							  	<div class="col-sm-9 text-left">
							    	<input type="Text" class="form-control di_dong {{ $errors->has('di_dong') ? ' is-invalid' : '' }}" name="di_dong" placeholder="Nhập số điện thoại di động" value="{{ old('di_dong')}}" required="required">
							    	@if ($errors->has('di_dong'))
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $errors->first('di_dong') }}</strong>
							            </span>
							        @endif
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="hinh_anh" class="col-sm-3 col-form-label">Ảnh đại diện</label>
							  	<div class="col-sm-9 text-left">
							  		<div class="input-group col-xs-12">
								    	<input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
						                <div class="input-group-append">
						                  <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn ảnh đại diện</button>         
						                  <input type="file" class="input-file" show-file=".giz-upload-01" name="hinh_anh[]" multiple hidden="true">
						                </div>
						            </div>
							  	</div>
							</div>
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-vnpt mr-2" style="width:200px;"> <i class="icon-check"></i> Đăng ký tài khoản</button>
								<a href= "{{ route('login') }}" class="btn btn-danger" style="width:200px;">Quay lại đăng nhập</a>
							</div>
						</form>
					</div>
				</div>
						
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery
		});
	</script>
@endsection

