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
          <label for="ma_don_vi" class="col-sm-4 col-form-label ">Mã đơn vị</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ma_don_vi" name="ma_don_vi" placeholder="Vui lòng nhập mã đơn vị" @if($checkData==1) value="{{$data['ma_don_vi']}}" @endif>
          </div>
        </div>

        <div class="form-group row">
          <label for="ma_dinh_danh" class="col-sm-4 col-form-label ">Mã định danh</label>
          <div class="col-sm-8">
             <input type="Text" class="form-control ma_dinh_danh" name="ma_dinh_danh" placeholder="Vui lòng nhập mã định danh đơn vị" @if($checkData==1) value="{{$data['ma_dinh_danh']}}" @endif>
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
          <label for="ma_cap" class="col-sm-4 col-form-label">Loại cấp đơn vị</label>
          <div class="col-sm-8">
             <select class="form-control ma_cap" name="ma_cap">
              <option value="">Chọn cấp đơn vị</option>
              @foreach($capDonVis as $capDonVi)
                  <option value="{{$capDonVi['ma_cap']}}" @if($checkData==1) @if($data['ma_cap']==$capDonVi['ma_cap']){{'selected="selected"'}}@endif @endif>
                    {{$capDonVi['ten_cap']}}
                  </option>
              @endforeach
            </select>
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
          
            <label for="ma_quan_huyen" class="col-sm-4 col-form-label">Quận huyện</label>
            <div class="col-8">
              <select class="form-control ma_quan_huyen" name="ma_quan_huyen" aria-describedby="ma_quan_huyen_helper">
                @foreach($dmQuanHuyens as $dmQuanHuyen)
                  <option value="{{$dmQuanHuyen['ma_quan_huyen']}}">{{$dmQuanHuyen['ten_quan_huyen']}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="form-group row">
          
            <label for="ma_phuong_xa" class="col-sm-4 col-form-label">Phường xã</label>
            <div class="col-8">
              <select class="form-control ma_phuong_xa" name="ma_phuong_xa" aria-describedby="ma_phuong_xa_helper" >
                @foreach($dmPhuongXas as $dmPhuongXa)
                  <option ma-quan-huyen="{{$dmPhuongXa['ma_quan_huyen']}}" value="{{$dmPhuongXa['ma_phuong_xa']}}" 
                    @if($checkData==1) @if($dmPhuongXa['ma_phuong_xa']==$data['ma_phuong_xa']) {{'selected="selected"'}} @endif @endif
                  > 
                    {{$dmPhuongXa['ten_phuong_xa']}}
                  </option>
                @endforeach
              </select>
            </div>
        </div>

        <div class="form-group row">
          
            <label for="la_don_vi_xu_ly" class="col-sm-4 col-form-label">Là đơn vị xử lý PAKN</label>
            <div class="col-8">
              <div class="icheck-square">
                  <input name="la_don_vi_xu_ly" type="checkbox" id="la_don_vi_xu_ly" value="1" @if($checkData==1) @if($data['la_don_vi_xu_ly']==1){{'checked="checked"'}}@endif @endif>
                  <label for="la_don_vi_xu_ly"></label>
              </div>
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
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif
<script type="text/javascript">
  // MỚI LOAD TRANG
      var selectedQuanHuyen=jQuery('.ma_quan_huyen').val();
      showPhuongXa=function(loai){ // loại =1 là mới load trang, ngước lại là do người dùng onchange
        var co=0;
        jQuery('.ma_phuong_xa option').each(function( index ) {
              var maQuanHuyen=jQuery(this).attr('ma-quan-huyen');
              if(loai!=1){
          jQuery(this).removeAttr('selected');
              }
                
              if(maQuanHuyen!=selectedQuanHuyen){
                jQuery(this).css('display','none');
              }else{
                jQuery(this).css('display','block');
                if(co==0 && loai!=1){
                  jQuery(this).attr('selected','selected');
                  co=1;
                }
              }
          });
      }
      
      showPhuongXa(1);
      jQuery('.ma_quan_huyen').on('change',function(){
        selectedQuanHuyen=jQuery(this).val();
        showPhuongXa(2);
      });
</script>



