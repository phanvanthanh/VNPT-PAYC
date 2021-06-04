@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="ten_chuc_vu" class="col-sm-4 col-form-label ">Tên chức vụ</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control ten_chuc_vu" name="ten_chuc_vu" placeholder="Vui lòng nhập chức vụ cần sửa" @if($checkData==1)  value="{{$data['ten_chuc_vu']}}" @endif>
        </div>
     </div>
     
     <div class="form-group row">
        <label for="id_nhom_chuc_vu" class="col-sm-4 col-form-label">Nhóm chức vụ</label>
        <div class="col-sm-8">
           <select class="form-control id_nhom_chuc_vu" name="id_nhom_chuc_vu">
            @foreach($nhomChucVus as $nhomChucVu)
                <option value="{{$nhomChucVu['id']}}" @if($checkData==1) @if($data['id_nhom_chuc_vu']==$nhomChucVu['id']){{'selected="selected"'}}@endif @endif>
                  {{$nhomChucVu['ten_nhom_chuc_vu']}}
                </option>
            @endforeach
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




