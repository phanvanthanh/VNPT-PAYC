@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif
    <div class="form-group row">
        <label for="role_name" class="col-sm-4 col-form-label ">Tên nhóm quyền</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control role_name" name="role_name" placeholder="Vui lòng nhập tên nhóm quyền cần sửa" @if($checkData==1)  value="{{$data['role_name']}}" @endif>
        </div>
     </div>
     
     <div class="form-group row">
        <label for="id_don_vi" class="col-sm-4 col-form-label">Đơn vị</label>
        <div class="col-sm-8">
           <select class="form-control id_don_vi" name="id_don_vi">
            @foreach($donVis as $donVi)
                <option value="{{$donVi['id']}}" @if($checkData==1) @if($data['id_don_vi']==$donVi['id']){{'selected="selected"'}}@endif @endif>
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
            <option value="1" @if($checkData==1)  @if($data['state']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
            <option value="0" @if($checkData==1)  @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
          </select>
        </div>
     </div>         
@else
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




