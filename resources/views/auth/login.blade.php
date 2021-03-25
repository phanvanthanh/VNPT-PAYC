@extends('layouts.index')
@section('title', 'Đăng nhập')
@section('content')
	<div class="col-12 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-3">&nbsp;</div>
					<div class="col-6">
						<h3 class="card-title text-center"><b class="color-vnpt text-center"><br><br><br>ĐĂNG NHẬP<br></b></h3>
						<form class="forms-sample" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
							<div class="form-group row">
							  	<label for="ten-dang-nhap" class="col-sm-3 col-form-label d-none d-sm-block">Tên đăng nhập</label>
							  	<div class="col-sm-9">
							    	<input type="Text" class="form-control" id="ten-dang-nhap" name="email" required="" placeholder="Nhập tên đăng nhập" value="{{ old('email')}}">
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="mat-khau" class="col-sm-3 col-form-label d-none d-sm-block">Mật khẩu</label>
							  	<div class="col-sm-9">
							    	<input type="password" name="password" class="form-control" id="mat-khau" placeholder="Mật khẩu">
							  	</div>
							</div>
							<div class="form-group row">
								<label for="mat-khau" class="col-sm-3 col-form-label d-none d-sm-block">&nbsp;</label>
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    &nbsp; Ghi nhớ lần đăng nhập sau
                                </label>
							</div>
							<div class="row">
								<div class="col-12 text-center">
									<button type="submit" class="btn btn-vnpt" style="width: 156.43px;"><i class="icon-check"></i> Đăng nhập</button>
									<a href= "{{ route('register') }}" class="btn btn-danger">Đăng ký tài khoản</a>
								</div>
							</div>
									
						</form>
					</div>
				</div>
						
			</div>
		</div>
	</div>
@endsection

