@extends('layouts.template.index')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6"><h5>RESET MẬT KHẨU</h5></div>
                <div class="col-lg-6 float-right text-right d-add-form" style="cursor: pointer;"><i class="mdi mdi-library-plus"></i><span class="text-danger">(*)</span></div>
            </div>
                
        </div>
    </div>
        
</div>
<div class="row add-form">    
    <div class="col-lg-12">
        <div class="card-box">
            <p class="text-muted font-14 m-b-20">
            </p>

            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Nhập địa chỉ email<span class="text-danger">*</span></label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu<span class="text-danger">*</span></label>
                    <input id="password" type="password" placeholder="Nhập mật khẩu" required
                           class="form-control" name="password">
                    @if ($errors->has('password'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận lại mật khẩu<span class="text-danger">*</span></label>
                    <input id="password-confirm" type="password" placeholder="Nhập mật khẩu" required
                           class="form-control" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
                

                <div class="form-group text-right m-b-0">
                    <button type="submit" class="btn btn-gradient waves-light waves-effect w-md">Lưu Lại</button>
                    <button type="reset" class="btn btn-light waves-effect w-md">Hủy</button>
                </div>

            </form>
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
        <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                
                
            });

        </script>
@endsection
