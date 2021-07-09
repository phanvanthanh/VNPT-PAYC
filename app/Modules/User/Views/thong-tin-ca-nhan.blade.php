@extends('layouts.index')
@section('title', 'Thông tin cá nhân')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        &nbsp;
                    </div>
                    <div class="col-xs-12 col-sm-8">
                       <h4 class="text-danger text-center ">CẬP NHẬT THÔNG TIN CÁ NHÂN</h4>
                       @php
                            $checkError=0;
                            if(session()->has('notification-error')){
                                $checkError=1;
                            }

                            if(session()->has('notification-success')){
                                $checkError=1;
                            }
                            if(count($errors)>0){
                                $checkError=1;
                            }
                       @endphp
                       @if (session()->has('notification-success'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        <div class="notification">
                                            {!! session('notification-success') !!}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif(session()->has('notification-error'))
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

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        @if ($data['hinh_anh'])
                            <img src="{{ secure_asset('storage/app/public/file/payc/'.$data['hinh_anh']) }}" class="img-thumbnail" alt="Ảnh đại diện" style="width:100%">
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-8 xem-thong-tin-ca-nhan @if($checkError) {{'d-none'}} @endif">
                        <br><br>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Tiêu chí</th>
                                  <th scope="col">Thông tin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Họ và tên</td>
                                  <th>{{$data['name']}}</th>
                                </tr>

                                <tr>
                                  <th scope="row">2</th>
                                  <td>Email đăng nhập</td>
                                  <td>{{$data['email']}}</td>
                                </tr>

                                <tr>
                                  <th scope="row">3</th>
                                  <td>Di động</td>
                                  <td>{{$data['di_dong']}}</td>
                                </tr>

                                <tr>
                                  <th scope="row">4</th>
                                  <td>Loại tài khoản</td>
                                  <td>
                                    @if ($data['loai_tai_khoan']=='KHACH_HANG')
                                        {{'Cá nhân'}}
                                    @else
                                        {{'Cán bộ'}}
                                    @endif
                                  </td>
                                </tr>

                                <tr>
                                  <th scope="row">5</th>
                                  <td>Trạng thái</td>
                                  <td>
                                    @if ($data['state']==1)
                                        {{'Đang hoạt động'}}
                                    @else
                                        {{'Ngừng hoạt động'}}
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                    <td scope="row">#</td>
                                    <td scope="row" colspan="2"></td>
                                </tr>
                                <tr class="text-center">
                                  <td scope="row" colspan="3" class="text-center">
                                      <button type="button" class="btn btn-vnpt btn-orther mr-2 btn-chinh-sua-thong-tin-ca-nhan"> <i class="icon-check"></i> Chỉnh sửa thông tin cá nhân</button>
                                  </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-8 @if(!$checkError) {{'d-none'}} @endif show-frm-cap-nhat-thong-tin-ca-nhan">
                        <br><br>
                        <form class="forms-sample" method="POST" action="{{ route('cap-nhat-thong-tin-ca-nhan') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Họ và tên <b class="text-danger">(*)</b></label>
                                <div class="col-sm-9 text-left">
                                    <input type="Text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} name" name="name" placeholder="Nhập họ và tên người tạo" @if(old('name')) value="{{ old('name')}}" @else value="{{ $data['name']}}" @endif required="required">
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
                                    <input type="Email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="emailshow" placeholder="Nhập địa chỉ email (sử dụng làm tên đăng nhập)" @if(old('email')) value="{{ old('email')}}" @else value="{{ $data['email']}}" @endif required="required" disabled>
                                    <input type="Email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} d-none" name="email" placeholder="Nhập địa chỉ email (sử dụng làm tên đăng nhập)" @if(old('email')) value="{{ old('email')}}" @else value="{{ $data['email']}}" @endif required="required">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="di_dong" class="col-sm-3 col-form-label">Di động <b class="text-danger">(*)</b></label>
                                <div class="col-sm-9 text-left">
                                    <input type="Text" class="form-control di_dong {{ $errors->has('di_dong') ? ' is-invalid' : '' }}" name="di_dong" placeholder="Nhập số điện thoại di động" @if(old('di_dong')) value="{{ old('di_dong')}}" @else value="{{ $data['di_dong']}}" @endif required="required">
                                    @if ($errors->has('di_dong'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('di_dong') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mat-khau" class="col-sm-3 col-form-label">Mật khẩu cũ <b class="text-danger"></b></label>
                                <div class="col-sm-9 text-left">
                                    <input type="password" name="old_password" class="form-control {{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="Nhập lại mật khẩu cũ (Nếu muốn cập nhật lại mật khẩu)">
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mat-khau" class="col-sm-3 col-form-label">Mật khẩu mới <b class="text-danger"></b></label>
                                <div class="col-sm-9 text-left">
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Nhập mật khẩu mới (Nếu muốn thay đổi mật khẩu)">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-sm-3 col-form-label">Xác nhận mật khẩu <b class="text-danger"></b></label>
                                <div class="col-sm-9 text-left">
                                    <input type="password" name="password_confirm" class="form-control {{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" placeholder="Xác nhận lại mật khẩu mới (nếu muốn thay đổi mật khẩu)">
                                    @if ($errors->has('password-confirm'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password-confirm') }}</strong>
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
                                <button type="submit" class="btn btn-vnpt mr-2" style="width:200px;"> <i class="icon-check"></i> Lưu thay đổi</button>
                                <button type="submit" class="btn btn-danger mr-2 btn-khong-luu"> <i class="icon-check"></i> Quay lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.btn-chinh-sua-thong-tin-ca-nhan').on('click', function() {
            jQuery('.show-frm-cap-nhat-thong-tin-ca-nhan').removeClass('d-none');
            jQuery('.xem-thong-tin-ca-nhan').addClass('d-none');
        });
        jQuery('.btn-khong-luu').on('click', function() {
            jQuery('.show-frm-cap-nhat-thong-tin-ca-nhan').addClass('d-none');
            jQuery('.xem-thong-tin-ca-nhan').removeClass('d-none');
            return false;
        });
    });
  </script>
@endsection

