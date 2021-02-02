@if($error=="")
    <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        <div class="form-group row">
          <label for="ten_don_vi" class="col-sm-4 col-form-label ">Tên đơn vị</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ten_don_vi" name="ten_don_vi" placeholder="Vui lòng nhập tên đơn vị cần tạo" value="{{$data['ten_don_vi']}}">
          </div>
       </div>

       <div class="form-group row">
          <label for="dia_chi" class="col-sm-4 col-form-label ">Địa chỉ</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control dia_chi" name="dia_chi" placeholder="Vui lòng nhập địa chỉ" value="{{$data['dia_chi']}}">
          </div>
       </div>

       <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label ">Email</label>
          <div class="col-sm-8">
             <input type="email" class="form-control email" name="email" placeholder="Vui lòng nhập Email" value="{{$data['email']}}">
          </div>
       </div>

       <div class="form-group row">
          <label for="di_dong" class="col-sm-4 col-form-label ">Số điện thoại di động</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control di_dong" name="di_dong" placeholder="Vui lòng nhập Số điện thoại di động" value="{{$data['di_dong']}}">
          </div>
       </div>

       <div class="form-group row">
          <label for="co_dinh" class="col-sm-4 col-form-label ">Số điện thoại cố định</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control co_dinh" name="co_dinh" placeholder="Vui lòng nhập Số điện thoại cố định" value="{{$data['co_dinh']}}">
          </div>
       </div>

       <div class="form-group row">
          <label for="fax" class="col-sm-4 col-form-label ">Số fax</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control fax" name="fax" placeholder="Vui lòng nhập số fax" value="{{$data['fax']}}">
          </div>
       </div>


       
       <div class="form-group row">
          <label for="parent_id" class="col-sm-4 col-form-label">Đơn vị cấp trên</label>
          <div class="col-sm-8">
             <select class="form-control parent_id" name="parent_id">
              @foreach($donVis as $donVi)
                  <option value="{{$donVi['id']}}" @if($data['parent_id']==$donVi['id']){{'selected="selected"'}}@endif>
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
              <option value="1" @if($data['state']==1){{'selected="selected"'}}@endif>Hoạt động</option>
              <option value="0" @if($data['state']==0){{'selected="selected"'}}@endif>Ngừng hoạt động</option>
            </select>
          </div>
       </div>   
    </form>
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




