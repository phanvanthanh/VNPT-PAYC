@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="ten_dich_vu" class="col-sm-4 col-form-label ">Tên dịch vụ</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control ten_dich_vu" name="ten_dich_vu" placeholder="Vui lòng nhập tên nhóm quyền cần sửa" @if($checkData==1)  value="{{$data['ten_dich_vu']}}" @endif>
        </div>
     </div>
     
     <div class="form-group row">
        <label for="id_nhom_dich_vu" class="col-sm-4 col-form-label">Nhóm dịch vụ</label>
        <div class="col-sm-8">
           <select class="form-control id_nhom_dich_vu" name="id_nhom_dich_vu">
            @foreach($nhomDichVus as $nhomDichVus)
                <option value="{{$nhomDichVus['id']}}" @if($checkData==1) @if($data['id_nhom_dich_vu']==$nhomDichVus['id']){{'selected="selected"'}}@endif @endif>
                  {{$nhomDichVus['ten_nhom_dich_vu']}}
                </option>
            @endforeach
          </select>
        </div>
     </div>

     <div class="form-group row">
        <label for="sap_xep" class="col-sm-4 col-form-label ">Sắp xếp</label>
        <div class="col-sm-8">
           <input type="Number" class="form-control sap_xep" name="sap_xep" placeholder="Vui lòng nhập tên nhóm quyền cần sửa" @if($checkData==1)  value="{{$data['sap_xep']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="state" class="col-sm-4 col-form-label">Trạng thái</label>
        <div class="col-sm-8">
           <select class="form-control state" name="state">
            <option value="1" @if($checkData==1)  @if($data['state']==1){{'selected="selected"'}}@endif @endif>Cho phép gửi APKN</option>
            <option value="2" @if($checkData==1)  @if($data['state']==2){{'selected="selected"'}}@endif @endif>Chỉ sử dụng trong module báo cáo tuần (Không hiển thị trong PAKN)</option>
            <option value="0" @if($checkData==1)  @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
          </select>
        </div>
     </div>         
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




