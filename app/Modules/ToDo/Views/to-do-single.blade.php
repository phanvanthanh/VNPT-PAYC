@if($error=="")
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif    
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" @if($checkData==1) value="{{$data['id']}}" @endif>
        <div class="form-group row">
            <label for="noi_dung" class="col-sm-4 col-form-label ">Nội dung</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung cần tạo" @if($checkData==1) value="{{$data['noi_dung']}}" @endif>
            </div>
         </div>
         <div class="form-group row">
            <label for="han_xu_ly" class="col-sm-4 col-form-label ">Hạn xử lý</label>
            <div class="col-sm-8">
                @php
                if($checkData==1){
                    $hxl = strtotime($data['han_xu_ly']);
                    $hxl2 = date('Y-m-d',$hxl).'T'. date('H:i:s',$hxl);
                }
                @endphp
               <input type="datetime-local" class="form-control han_xu_ly" name="han_xu_ly" placeholder="Vui lòng nhập nội dung cần tạo" @if($checkData==1) value="{{$hxl2}}" @endif>
            </div>
         </div>
      
         <div class="form-group row">
            <label for="trang_thai" class="col-sm-4 col-form-label">Trạng thái</label>
            <div class="col-sm-8">
               <select class="form-control trang_thai" name="trang_thai">
                <option value="1"  @if($checkData==1)  @if($data['trang_thai']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
                <option value="0"  @if($checkData==1)  @if($data['trang_thai']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
              </select>
            </div>
         </div>  
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




