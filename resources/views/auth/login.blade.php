@extends('layouts.index')
@section('title', 'Đăng nhập')
@section('content')
	<div class="col-12 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-3">&nbsp;</div>
					<div class="col-6 text-center">
						<h3 class="card-title"><b class="color-vnpt"><br><br><br>ĐĂNG NHẬP<br></b></h3>
						<form class="forms-sample" method="POST" action="{{ route('login') }}">
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
								<label for="mat-khau" class="col-sm-3 col-form-label">&nbsp;</label>
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    &nbsp; Ghi nhớ lần đăng nhập sau
                                </label>
							</div>
							<button type="submit" class="btn btn-vnpt mr-2"> <i class="icon-check"></i>  Đăng nhập</button>
							<a href= "{{ route('register') }}" class="btn btn-danger">Đăng ký tài khoản</a>
						</form>
					</div>
				</div>
						
			</div>
		</div>
	</div>
@endsection

