@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="ma_tham_so" class="col-sm-4 col-form-label ">Mã tham số</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control ma_tham_so" name="ma_tham_so" placeholder="Vui lòng nhập mã tham số" @if($checkData==1)  value="{{$data['ma_tham_so']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="ten_tham_so" class="col-sm-4 col-form-label ">Tên tham số</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control ten_tham_so" name="ten_tham_so" placeholder="Vui lòng nhập tên tham số" @if($checkData==1)  value="{{$data['ten_tham_so']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="loai_tham_so" class="col-sm-4 col-form-label">Loại tham số</label>
        <div class="col-sm-8">
           <select class="form-control loai_tham_so" name="loai_tham_so">
            <option value="Nvarchar2" @if($checkData==1)  @if($data['loai_tham_so']=='Nvarchar2'){{'selected="selected"'}}@endif @endif>Nvarchar2</option>
            <option value="Array" @if($checkData==1)  @if($data['loai_tham_so']=='Array'){{'selected="selected"'}}@endif @endif>Array</option>
          </select>
        </div>
     </div>   

     <div class="form-group row">
        <label for="gia_tri_tham_so" class="col-sm-4 col-form-label ">Giá trị</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control gia_tri_tham_so" name="gia_tri_tham_so" placeholder="Vui lòng nhập giá trị tham số" @if($checkData==1)  value="{{$data['gia_tri_tham_so']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="mo_ta_tham_so" class="col-sm-4 col-form-label ">Mô tả tham số</label>
        <div class="col-sm-8">
          <TEXTAREA name="mo_ta_tham_so" class="form-control mo_ta_tham_so">@if($checkData==1) {{$data['mo_ta_tham_so']}} @endif</TEXTAREA>
        </div>
     </div>
     
             
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




