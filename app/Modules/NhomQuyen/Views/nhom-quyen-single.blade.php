@if($error=="")
    <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
        {{ csrf_field() }}
        <input type="hidden" name="id" class="id" value="{{$data['id']}}">
        <div class="form-group row">
            <label for="role_name" class="col-sm-4 col-form-label ">Tên nhóm quyền</label>
            <div class="col-sm-8">
               <input type="Text" class="form-control role_name" name="role_name" placeholder="Vui lòng nhập tên nhóm quyền cần sửa" value="{{$data['role_name']}}">
            </div>
         </div>
         
         <div class="form-group row">
            <label for="id_don_vi" class="col-sm-4 col-form-label">Đơn vị</label>
            <div class="col-sm-8">
               <select class="form-control id_don_vi" name="id_don_vi">
                @foreach($donVis as $donVi)
                    <option value="{{$donVi['id']}}" @if($data['id_don_vi']==$donVi['id']){{'selected="selected"'}}@endif>
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




