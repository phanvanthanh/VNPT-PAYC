@if($error=="")
    <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        <div class="form-group row">
            <label for="noi_dung" class="col-sm-4 col-form-label ">Nội dung</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control noi_dung" name="noi_dung" placeholder="Vui lòng nhập nội dung cần tạo" value="{{$data['noi_dung']}}">
            </div>
         </div>
         <div class="form-group row">
            <label for="han_xu_ly" class="col-sm-4 col-form-label ">Hạn xử lý</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control han_xu_ly" name="han_xu_ly" placeholder="Vui lòng nhập nội dung cần tạo">
            </div>
         </div>
      
         <div class="form-group row">
            <label for="trang_thai" class="col-sm-4 col-form-label">Trạng thái</label>
            <div class="col-sm-8">
               <select class="form-control trang_thai" name="trang_thai">
                <option value="1">Hoạt động</option>
                <option value="0">Ngừng hoạt động</option>
              </select>
            </div>
         </div>  
    </form>
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




