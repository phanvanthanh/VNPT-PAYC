@if($error=="")
    <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" value="{{$data->id}}">
         <div class="form-group row">
            <label for="ten_hien_thi" class="col-sm-4 col-form-label ">Tên menu</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control ten_hien_thi" name="ten_hien_thi" placeholder="Vui lòng nhập tên menu cần tạo"  value="{{$data->ten_hien_thi}}">
            </div>
         </div>
         <div class="form-group row">
            <label for="resource" class="col-sm-4 col-form-label ">Resource</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control resource" name="resource" placeholder="Vui lòng nhập tài nguyên"  value="{{$data->resource}}">
            </div>
         </div>
         <div class="form-group row">
            <label for="method" class="col-sm-4 col-form-label ">Phương thức</label>
            <div class="col-sm-8">
               <select class="form-control method" name="method">
                <option value="GET" @if($data->method=="GET"){{'selected="selected"'}}@endif>GET</option>
                <option value="POST" @if($data->method=="POST"){{'selected="selected"'}}@endif>POST</option>
                <option value="PUSH" @if($data->method=="PUSH"){{'selected="selected"'}}@endif>PUSH</option>
                <option value="DELETE" @if($data->method=="DELETE"){{'selected="selected"'}}@endif>DELETE</option>
              </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="action" class="col-sm-4 col-form-label ">Action</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control" name="action" placeholder="Vui lòng nhập Controller của chức năng" value="{{$data->action}}">
            </div>
         </div>
         <div class="form-group row">
            <label for="parent_id" class="col-sm-4 col-form-label">Menu cha</label>
            <div class="col-sm-8">
               <select class="form-control parent_id" name="parent_id"  value="{{$data->parent_id}}">
                <option value="1" >Menu trái</option>
                @foreach($resources as $resource)
                  @if($resource->parent_id==1)
                    <option @if($data->parent_id==$resource->id){{'selected="selected"'}}@endif value="{{$resource->id}}">{{$resource->ten_hien_thi}}</option>
                  @endif
                @endforeach
              </select>
            </div>
         </div>

         <div class="form-group row">
            <label for="uri" class="col-sm-4 col-form-label ">URI</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control" name="uri" placeholder="Vui lòng nhập URI của chức năng" value="{{$data->uri}}">
            </div>
         </div>

         <div class="form-group row">
            <label for="show_menu" class="col-sm-4 col-form-label">Loại hiển thị menu</label>
            <div class="col-sm-8">
               <select class="form-control show_menu" name="show_menu">
                
                <option @if($data->show_menu==1){{'selected=selected'}}@endif value="1">Hiển thị trên menu trái</option>
                <option @if($data->show_menu==2){{'selected=selected'}}@endif value="2">Ẩn trên menu</option>
                <option @if($data->show_menu==3){{'selected=selected'}}@endif value="3">Không hiển thị trên tất cả các chức năng</option>
              </select>
            </div>
         </div>

         <div class="form-group row">
            <label for="icon" class="col-sm-4 col-form-label ">ICON</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control" name="icon" placeholder="Vui lòng nhập ICON của chức năng" value="{{$data->icon}}">
            </div>
         </div>

         <div class="form-group row">
            <label for="order" class="col-sm-4 col-form-label">Sắp xếp</label>
            <div class="col-sm-8">
               <input type="Number" class="form-control" name="order" placeholder="Vui lòng nhập vị trí hiển thị của chức năng" value="{{$data->order}}">
            </div>
         </div>
    </form>
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




