@extends('layouts.front-end')
@section('title', 'Đăng nhập')
@section('content')
	<div class="col-12 stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-xs-0 col-sm-0 col-md-2 col-lg-3">&nbsp;</div>
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
						<h3 class="card-title text-center"><b class="color-vnpt text-center"><br><br><br>ĐĂNG NHẬP<br></b></h3>
						@if(session()->has('notification-error'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <div class="notification">
                                            {!! session('notification-error') !!}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
						<form class="forms-sample" id="frm-dang-nhap" method="POST">
                            {{ csrf_field() }}
							<div class="form-group row">
							  	<label for="ten-dang-nhap" class="col-sm-4 col-form-label d-none d-sm-block">Tên đăng nhập</label>
							  	<div class="col-sm-8">
							    	<input type="Text" class="form-control" id="ten-dang-nhap" name="email" required="" placeholder="Nhập tên đăng nhập" value="{{ old('email')}}">
							  	</div>
							</div>
							<div class="form-group row">
							  	<label for="mat-khau" class="col-sm-4 col-form-label d-none d-sm-block">Mật khẩu</label>
							  	<div class="col-sm-8">
							    	<input type="password" name="password" class="form-control" id="mat-khau" placeholder="Mật khẩu">
							  	</div>
							</div>
							<div class="form-group row">
								<label for="mat-khau" class="col-sm-4 col-form-label d-none d-sm-block">&nbsp;</label>
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    &nbsp; Ghi nhớ lần đăng nhập sau
                                </label>
							</div>
							<div class="row">
								<div class="col-12 text-center">
									<button type="button" class="btn btn-success btn-dang-nhap" style="width: 156.43px;"><i class="icon-check"></i> Đăng nhập</button>
									<button type="button" class="btn btn-vnpt btn-dang-nhap-sso" style="width: 170.43px;"><i class="icon-check"></i> Đăng nhập SSO</button>
									<a href= "{{ route('register') }}" class="btn btn-danger">Đăng ký tài khoản</a>
								</div>
							</div>
						</form>
					</div>
				</div>
						
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){ 
			jQuery('.btn-dang-nhap').on('click', function() {
				jQuery('#frm-dang-nhap').attr('action',"{{ route('login') }}");
				jQuery('#frm-dang-nhap').submit();
			});

			jQuery('.btn-dang-nhap-sso').on('click', function() {
				jQuery('#frm-dang-nhap').attr('action',"{{ route('sso-dang-nhap') }}");
				jQuery('#frm-dang-nhap').submit();
			});

			jQuery('#mat-khau').on("keypress", function(e) {
	            if (e.keyCode == 13) {
	            	jQuery('#frm-dang-nhap').attr('action',"{{ route('login') }}");
					jQuery('#frm-dang-nhap').submit();
					e.preventDefault();
          			return false;
				}
			});
		});
	</script>
@endsection

