@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="link_chuc_nang" class="col-sm-4 col-form-label ">Chức năng hoặc link</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control link_chuc_nang" name="link_chuc_nang" placeholder="Vui lòng nhập tên chức năng hoặc liên kết" @if($checkData==1)  value="{{$data['link_chuc_nang']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="mo_ta" class="col-sm-4 col-form-label ">Mô tả</label>
        <div class="col-sm-8">
           <textarea class="form-control mo_ta" name="mo_ta" rows="5">@if($checkData==1){{$data['mo_ta']}}@endif</textarea>
        </div>
     </div>
     <div class="form-group row">
        <label for="id_dich_vu" class="col-sm-4 col-form-label">Dịch vụ</label>
        <div class="col-sm-8">
           <select class="form-control id_dich_vu" name="id_dich_vu">
            @foreach($dichVus as $dichVu)
                <option value="{{$dichVu['id']}}" @if($checkData==1) @if($data['id_dich_vu']==$dichVu['id']){{'selected="selected"'}}@endif @endif>
                  {{$dichVu['ten_dich_vu']}}
                </option>
            @endforeach
          </select>
        </div>
     </div>

     <div class="form-group row">
        <label for="sap_xep" class="col-sm-4 col-form-label ">Sắp xếp</label>
        <div class="col-sm-8">
           <input type="Number" class="form-control sap_xep" name="sap_xep" placeholder="Vui lòng nhập số thứ tự" @if($checkData==1)  value="{{$data['sap_xep']}}" @endif>
        </div>
     </div>
     
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




