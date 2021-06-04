@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="chi_so" class="col-sm-4 col-form-label ">Chỉ số</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control chi_so" name="chi_so" placeholder="Vui lòng nhập chỉ số " @if($checkData==1)  value="{{$data['chi_so']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="mo_ta" class="col-sm-4 col-form-label ">Mô tả</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control mo_ta" name="mo_ta" placeholder="Vui lòng nhập chỉ số " @if($checkData==1)  value="{{$data['mo_ta']}}" @endif>
        </div>
     </div>
     
     <div class="form-group row">
        <label for="parent_id" class="col-sm-4 col-form-label">Thuộc nhóm</label>
        <div class="col-sm-8">
          <select class="form-control parent_id" name="parent_id">
            <option value="">Không chọn</option>
            @foreach ($dmChiSos as $chiSo)
              <option value="{{$chiSo['id']}}" @if($checkData==1)  @if($data['parent_id']==$chiSo['id']){{'selected="selected"'}} @endif @if($data['id']==$chiSo['id']){{'disabled="disabled"'}} @endif @endif>
                @if ($chiSo['parent_id']!='')
                  ____ 
                @endif
                {{$chiSo['chi_so']}} - {{$chiSo['mo_ta']}}
              </option>
            @endforeach
          </select>
        </div>
     </div>         
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




