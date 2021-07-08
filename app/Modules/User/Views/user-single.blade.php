@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="hoten" class="col-sm-4 col-form-label ">Họ tên</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control hoten" name="hoten" required placeholder="Vui lòng nhập họ tên cần tạo" @if($checkData==1)  value="{{$data['name']}}" @endif>
        </div>
     </div>
     
     <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Tên đăng nhập</label>
        <div class="col-sm-8">
            <input type="Text" class="form-control email" name="email" required placeholder="Vui lòng nhập email cần tạo" @if($checkData==1)  value="{{$data['email']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Mật khẩu</label>
        <div class="col-sm-8">
            <input type="password" class="form-control matkhau" name="matkhau" required placeholder="Vui lòng nhập mật khẩu cần tạo">
        </div>
     </div>

     <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Số điện thoại</label>
        <div class="col-sm-8">
            <input type="tel" class="form-control sdt" name="sdt" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required placeholder="Vui lòng nhập số điện thoại cần tạo" @if($checkData==1)  value="{{$data['di_dong']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="sso_nhanvien_id" class="col-sm-4 col-form-label">Nhân viên id SSO</label>
        <div class="col-sm-8">
            <input type="Text" class="form-control sso_nhanvien_id" name="sso_nhanvien_id" required placeholder="Vui lòng nhập sso_nhanvien_id cần tạo" @if($checkData==1)  value="{{$data['sso_nhanvien_id']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="gioi_tinh" class="col-sm-4 col-form-label">Giới tính</label>
        <div class="col-sm-8">
           <select class="form-control gioi_tinh" name="gioi_tinh">
            <option value="1" @if($checkData==1)  @if($data['gioi_tinh']==1){{'selected="selected"'}}@endif @endif>Nam</option>
            <option value="0" @if($checkData==1)  @if($data['gioi_tinh']==0){{'selected="selected"'}}@endif @endif>Nữ</option>
          </select>
        </div>
     </div> 

     <div class="form-group row">
        <label for="state" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
           <select class="form-control state" name="state">
            <option value="1" @if($checkData==1)  @if($data['state']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
            <option value="0" @if($checkData==1)  @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
          </select>
        </div>
     </div>         
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




