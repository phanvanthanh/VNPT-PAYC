@extends('layouts.index')
@section('title', 'Đăng ký')
@section('content')
	<div class="col-12 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-3">&nbsp;</div>
					<div class="col-6 text-center">
						<h3 class="card-title"><b class="color-vnpt"><br><br><br>ĐĂNG KÝ TÀI KHOẢN<br></b></h3>
						<form class="forms-sample" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
							<div class="form-group row">
							  	<label for="ten-dang-nhap" class="col-sm-3 col-form-label">Tên đăng nhập</label>
							  	<div class="col-sm-9">
							    	<input type="Text" class="form-control" id="ten-dang-nhap" name="email" required="" placeholder="Nhập tên đăng nhập" value="{{ old('email')}}">
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="mat-khau" class="col-sm-3 col-form-label">Mật khẩu</label>
							  	<div class="col-sm-9">
							    	<input type="password" name="password" class="form-control" id="mat-khau" placeholder="Mật khẩu">
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="password-confirm" class="col-sm-3 col-form-label">Xác nhận lại mật khẩu</label>
							  	<div class="col-sm-9">
							    	<input type="password" name="password-confirm" class="form-control" id="password-confirm" placeholder="Xác nhận lại mật khẩu">
							  	</div>
							</div>
							<button type="submit" class="btn btn-vnpt mr-2"> <i class="icon-check"></i> Tạo tài khoản</button>
							<a href= "{{ route('login') }}" class="btn btn-default">Quay lại</a>
						</form>
					</div>
				</div>
						
			</div>
		</div>
	</div>
@endsection

