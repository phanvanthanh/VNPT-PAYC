@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="noi_dung_thong_bao" class="col-sm-4 col-form-label ">Nội dung</label>
        <div class="col-sm-8">
           {{-- <input type="Text" class="form-control noi_dung_thong_bao" name="noi_dung_thong_bao" placeholder="Vui lòng nhập nội dung thông báo" @if($checkData==1)  value="{{$data['noi_dung_thong_bao']}}" @endif> --}}
           <textarea class="form-control noi_dung_thong_bao" name="noi_dung_thong_bao" rows="5">@if($checkData==1){{$data['noi_dung_thong_bao']}}@endif</textarea>
        </div>
     </div>

     <div class="form-group row">
        <label for="sap_xep" class="col-sm-4 col-form-label ">Sắp xếp</label>
        <div class="col-sm-8">
           <input type="Number" class="form-control sap_xep" name="sap_xep" placeholder="Vui lòng nhập nội dung thông báo" @if($checkData==1)  value="{{$data['sap_xep']}}" @endif>
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




