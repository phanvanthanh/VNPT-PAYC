@if($error=="")
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif    
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="noi_dung" class="col-sm-4 col-form-label ">Nội dung</label>
            <div class="col-sm-8">
               <!-- <input type="Text" class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung cần tạo" @if($checkData==1) value="{{$data['noi_dung']}}" @endif> -->
               <textarea class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung cần tạo" rows="5">@if($checkData==1) {{$data['noi_dung']}} @endif</textarea>
            </div>
         </div>
         <div class="form-group row">
            <label for="han_xu_ly" class="col-sm-4 col-form-label ">Hạn xử lý</label>
            <div class="col-sm-8">
                @php
                $today = date('Y-m-d').'T'.date('H:i:s');
                if($checkData==1){
                    $hxl = strtotime($data['han_xu_ly']);
                    $hxl2 = date('Y-m-d',$hxl).'T'. date('H:i:s',$hxl);      
                }
                @endphp
               <input type="datetime-local" class="form-control han_xu_ly" name="han_xu_ly" placeholder="Vui lòng nhập nội dung cần tạo" @if($checkData==1) value="{{$hxl2}}" @else value="{{$today}}" @endif>
            </div>
         </div>

         <div class="form-group row">
            <label for="ngay_hoan_thanh" class="col-sm-4 col-form-label ">Ngày hoàn thành</label>
            <div class="col-sm-8">
                @php
                $today = date('Y-m-d').'T'.date('H:i:s');
                if($checkData==1 && $data['ngay_hoan_thanh']!=null && $data['ngay_hoan_thanh']!=''){
                    $nht = strtotime($data['ngay_hoan_thanh']);
                    $nht2 = date('Y-m-d',$nht).'T'. date('H:i:s',$nht);      
                }
                @endphp
               <input type="datetime-local" class="form-control ngay_hoan_thanh" name="ngay_hoan_thanh" @if($checkData==1 && $data['ngay_hoan_thanh']!=null && $data['ngay_hoan_thanh']!='') value="{{$nht2}}" @endif>
            </div>
         </div>
      
         <!-- <div class="form-group row">
            <label for="trang_thai" class="col-sm-4 col-form-label">Trạng thái</label>
            <div class="col-sm-8">
               <select class="form-control trang_thai" name="trang_thai">
                <option value="1"  @if($checkData==1)  @if($data['trang_thai']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
                <option value="0"  @if($checkData==1)  @if($data['trang_thai']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
              </select>
            </div>
         </div>   -->
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




