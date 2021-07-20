
@if($error=="")
    @php
        $choPhepCapNhatNgayHoanThanhToDoList=Helper::getValueThamSoTheoMa('CHO_PHEP_CAP_NHAT_NGAY_HOAN_THANH_TO_DO_LIST');
    @endphp
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif    
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="noi_dung" class="col-sm-4 col-form-label ">Nội dung <i class="text-danger">*</i></label>
            <div class="col-sm-8">
               <!-- <input type="Text" class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung cần tạo" @if($checkData==1) value="{{$data['noi_dung']}}" @endif> -->
               <textarea class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung cần tạo" rows="5">@if($checkData==1) {{$data['noi_dung']}} @endif</textarea>
            </div>
         </div>
         <div class="form-group row">
            <label for="han_xu_ly" class="col-sm-4 col-form-label ">Hạn xử lý</label>
            <div class="col-sm-8">
                @php
                $today = date('m/d/Y');
                if($checkData==1){
                    $hxl = strtotime($data['han_xu_ly']);
                    $hxl2 = date('m/d/Y',$hxl);
                }
                @endphp
               <input type="Text" class="form-control han_xu_ly d-none" name="han_xu_ly">


                <div id="datepicker-popup" class="input-group date datepicker" style="padding: 0px;">
                    <input type="Text" id="ngay" name="ngay" class="form-control" aria-describedby="ngay_helper" @if($checkData==1) value="{{$hxl2}}" @else value="{{$today}}" @endif>
                    <div class="input-group-addon input-group-text">
                      <span class="mdi mdi-calendar"></span>
                    </div>
                </div>
                <div class="input-group">
                    <input type="Text" class="form-control" id="gio" name="gio" value="@if(date('H')<=11){{"11:00"}}@else{{"17:00"}}@endif" aria-describedby="gio_helper">
                    <span class="input-group-addon input-group-text">
                      <i class="mdi mdi-clock"></i>
                    </span>
                </div>
            </div>
         </div>

             

                

         @if ($choPhepCapNhatNgayHoanThanhToDoList && $checkData==1)
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
         @endif
    <script type="text/javascript" src="{{ secure_asset('public/js/formpickers.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script> --}}
    <script type="text/javascript">
        $("#gio").keypress(function(e) {
            var gio=jQuery(this).val();
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (gio.length==2 && (e.keyCode==186 || e.keyCode==16))) {
                if(gio.length>4){
                    return false;
                }else{
                    if(gio.length==2 && $.isNumeric(gio) && parseInt(gio)>=0 && parseInt(gio)<=24){
                        gio=gio+":";
                        jQuery(this).val(gio);
                        jQuery(this).removeClass('text-danger');
                    }
                    if(gio.length==2){
                        jQuery(this).addClass('text-danger');
                        return false;
                    }
                    return true;
                    
                }
            }else{
                jQuery(this).addClass('text-danger');
                return false;
            }
            e.preventDefault();
        });

    </script>
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




