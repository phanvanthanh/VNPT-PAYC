@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
        {{ csrf_field() }}
        @if($checkData==1)
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        @endif
        <div class="form-group row">
          <label for="ten_don_vi" class="col-sm-4 col-form-label ">Tên đơn vị</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ten_don_vi" name="ten_don_vi" placeholder="Vui lòng nhập tên đơn vị cần tạo" @if($checkData==1) value="{{$data['ten_don_vi']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="dia_chi" class="col-sm-4 col-form-label ">Địa chỉ</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control dia_chi" name="dia_chi" placeholder="Vui lòng nhập địa chỉ" @if($checkData==1) value="{{$data['dia_chi']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label ">Email</label>
          <div class="col-sm-8">
             <input type="email" class="form-control email" name="email" placeholder="Vui lòng nhập Email" @if($checkData==1) value="{{$data['email']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="di_dong" class="col-sm-4 col-form-label ">Số điện thoại di động</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control di_dong" name="di_dong" placeholder="Vui lòng nhập Số điện thoại di động" @if($checkData==1) value="{{$data['di_dong']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="co_dinh" class="col-sm-4 col-form-label ">Số điện thoại cố định</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control co_dinh" name="co_dinh" placeholder="Vui lòng nhập Số điện thoại cố định" @if($checkData==1) value="{{$data['co_dinh']}}" @endif>
          </div>
       </div>

       <div class="form-group row">
          <label for="fax" class="col-sm-4 col-form-label ">Số fax</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control fax" name="fax" placeholder="Vui lòng nhập số fax" @if($checkData==1) value="{{$data['fax']}}" @endif>
          </div>
       </div>


       
       <div class="form-group row">
          <label for="parent_id" class="col-sm-4 col-form-label">Đơn vị cấp trên</label>
          <div class="col-sm-8">
             <select class="form-control parent_id" name="parent_id">
              @foreach($donVis as $donVi)
                  <option value="{{$donVi['id']}}" @if($checkData==1) @if($data['parent_id']==$donVi['id']){{'selected="selected"'}}@endif @endif>
                    @if($donVi['level']>0)
                      @for ($i = 0; $i < $donVi['level']; $i++)
                          {{"____ "}}
                      @endfor
                    @endif {{$donVi['ten_don_vi']}}
                  </option>
              @endforeach
            </select>
          </div>
       </div>

       <div class="form-group row">
          <label for="state" class="col-sm-4 col-form-label">Trạng thái</label>
          <div class="col-sm-8">
             <select class="form-control state" name="state">
              <option value="1" @if($checkData==1) @if($data['state']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
              <option value="0" @if($checkData==1) @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
            </select>
          </div>
       </div>   
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




