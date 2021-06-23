@if($error=="")    
    @php $checkData=0; @endphp
    @php if($data){$checkData=1;} @endphp
    {{ csrf_field() }}
    @if($checkData==1)
    <input type="hidden" name="id" class="id" value="{{$data['id']}}">
    @endif

    <div class="form-group row">
        <label for="id_don_vi" class="col-sm-4 col-form-label">ID đơn vị</label>
        <div class="col-sm-8">
           <select class="form-control id_don_vi" name="id_don_vi">
            @foreach($donVis as $donVi)
                <option value="{{$donVi['id']}}" @if($checkData==1) @if($data['id_don_vi']==$donVi['id']){{'selected="selected"'}}@endif @endif>
                  {{$donVi['ten_don_vi']}}
                </option>
            @endforeach
          </select>
        </div>
     </div>


    <div class="form-group row">
        <label for="ten_don_vi_dhsxkd" class="col-sm-4 col-form-label ">Tên đơn vị ĐHSXKD</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control ten_don_vi_dhsxkd" name="ten_don_vi_dhsxkd" placeholder="Vui lòng nhập tên nhóm quyền cần sửa" @if($checkData==1)  value="{{$data['ten_don_vi_dhsxkd']}}" @endif>
        </div>
     </div>

     <div class="form-group row">
        <label for="id_don_vi_dhsxkd" class="col-sm-4 col-form-label ">ID ĐHSXKD</label>
        <div class="col-sm-8">
           <input type="Text" class="form-control id_don_vi_dhsxkd" name="id_don_vi_dhsxkd" placeholder="Vui lòng nhập tên nhóm quyền cần sửa" @if($checkData==1)  value="{{$data['id_don_vi_dhsxkd']}}" @endif>
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
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




