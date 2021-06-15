@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
      @php
         $date=date_create($data['tu_ngay']);
         $tuNgay=date_format($date,"d/m/Y");

         $date=date_create($data['den_ngay']);
         $denNgay=date_format($date,"d/m/Y");

     @endphp 
    @endif
    <div class="form-group row">
        <label for="tuan" class="col-sm-4 col-form-label ">Tuần</label>
        <div class="col-sm-8">
           <input type="Number" class="form-control tuan" name="tuan" placeholder="Vui lòng nhập tuần " @if($checkData==1)  value="{{$data['tuan']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="thang" class="col-sm-4 col-form-label ">Tháng</label>
        <div class="col-sm-8">
           <input type="Number" class="form-control thang" name="thang" placeholder="Vui lòng nhập tháng (Nếu có) " @if($checkData==1)  value="{{$data['thang']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="nam" class="col-sm-4 col-form-label ">Năm</label>
        <div class="col-sm-8">
           <input type="Number" class="form-control nam" name="nam" placeholder="Vui lòng nhập năm " @if($checkData==1)  value="{{$data['nam']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="tu_ngay" class="col-sm-4 col-form-label ">Từ ngày</label>
        <div class="col-sm-8">
           <input type="Date" class="form-control tu_ngay" name="tu_ngay" placeholder="Vui lòng nhập từ ngày " @if($checkData==1)  value="{{$data['tu_ngay']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="den_ngay" class="col-sm-4 col-form-label ">Đến ngày</label>
        <div class="col-sm-8">
           <input type="Date" class="form-control den_ngay" name="den_ngay" placeholder="Vui lòng nhập đến ngày " @if($checkData==1)  value="{{$data['den_ngay']}}" @endif>
        </div>
     </div>
     <input type="hidden" name="trang_thai" @if($checkData==1) value="{{$data['trang_thai']}}" @else value="0" @endif>        
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




