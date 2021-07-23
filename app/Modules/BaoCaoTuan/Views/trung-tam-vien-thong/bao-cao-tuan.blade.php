@extends('layouts.index')
@section('title', 'TTVT')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">&nbsp; Báo cáo tuần: {{$donVi['ten_don_vi']}}</h4>
                  </div>
                    <div class="col-6 text-right">
                       <div class="error-mode float-right"></div> 
                       <b>Hạn báo cáo: <span id="thoi-gian-con-lai" class="text-primary"></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
               

                @php
                  
                  $week=\Helper::layTuanHienTai();
                  $year=date('Y');
                  $daVuotThoiGianBaoCao=0;
                  $maxThoiGianBaoCao='';

                  $userId=Auth::id();
                  $checkQuyenBaoCaoTuanHienTai=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_TUAN_HIEN_TAI');
                  $checkQuyenBaoCaoKeHoachTuan=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_KE_HOACH_TUAN');
                  $checkQuyenBaoCaoDhsxkd=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_DHSXKD');
                  $checkQuyenXemBaoCaoTongHop=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XEM_BAO_CAO_TONG_HOP');

                @endphp
                
                <div class="row user-profile">
                  
                  <div class="col-lg-12 side-right stretch-card">
                    <div class="card">
                      <div class="card-body" style="min-height: 500px;">
                        <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                          <h4 class="card-title mb-0">
                            <form class="forms-sample frm-bao-cao-tuan" id="frm-bao-cao-tuan" name="frm-bao-cao-tuan">
                              {{ csrf_field() }}
                              <select class="form-control bao-cao-tuan-style id_tuan" id="id_tuan" name="id_tuan" aria-describedby="tuan_helper" style="width: 100%;">
                                @foreach($bcDmTuan as $dmTuan)
                                  <option value="{{$dmTuan['id']}}" 
                                    @if ($week==$dmTuan['tuan']) 
                                      {{"selected='selected'"}} 
                                      @php
                                        $maxThoiGianBaoCao=Helper::layMaxThoiGianBaoCao($dmTuan['id']);
                                      @endphp
                                    @endif 
                                    @if ($dmTuan['tuan']==25 && $dmTuan['nam']==2021) 
                                      {{'disabled'}}  
                                    @endif>
                                    Báo cáo tuần @if ($dmTuan['tuan']<10) {{"0"}}@endif{{$dmTuan['tuan']}} - Năm {{$dmTuan['nam']}}
                                  </option>
                                @endforeach
                              </select>  
                            </form>
                          </h4>

                          @php $tabActive=0; @endphp
                          <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            @if ($checkQuyenBaoCaoTuanHienTai==1)
                              @php if($tabActive==0){$tabActive=1;} @endphp
                              <li class="nav-item">
                                <a class="nav-link @if($tabActive==1) active @endif" id="bao-cao-tuan-hien-tai-tab" data-toggle="tab" href="#bao-cao-tuan-hien-tai" role="tab" aria-controls="bao-cao-tuan-hien-tai">BC tuần</a>
                              </li>
                            @endif
                            @if ($checkQuyenBaoCaoKeHoachTuan==1)
                              @php if($tabActive==0){$tabActive=2;} @endphp
                              <li class="nav-item">
                                <a class="nav-link @if($tabActive==2) active @endif" id="bao-cao-ke-hoach-tuan-tab" data-toggle="tab" href="#bao-cao-ke-hoach-tuan" role="tab" aria-controls="bao-cao-ke-hoach-tuan">KH tuần</a>
                              </li>
                            @endif
                            @if ($checkQuyenBaoCaoDhsxkd==1)
                              @php if($tabActive==0){$tabActive=3;} @endphp
                              <li class="nav-item">
                                <a class="nav-link @if($tabActive==3) active @endif" id="dhsxkd-tab" data-toggle="tab" href="#dhsxkd" role="tab" aria-controls="dhsxkd">ĐHSXKD</a>
                              </li>
                            @endif
                            @if ($checkQuyenXemBaoCaoTongHop==1)
                              @php if($tabActive==0){$tabActive=4;} @endphp
                              <li class="nav-item">
                                <a class="nav-link @if($tabActive==4) active @endif" id="chot-va-gui-bao-cao-tab" data-toggle="tab" href="#chot-va-gui-bao-cao" role="tab" aria-controls="tong-hop-va-gui-bao-cao">Xem & duyệt báo cáo</a>
                              </li>
                            @endif
                          </ul>
                        </div>
                        <div class="wrapper">
                          <hr>
                          <div class="tab-content" id="myTabContent"  style="min-height: 100%;">
                            
                            @if ($checkQuyenBaoCaoTuanHienTai==1)  
                            <div class="tab-pane fade @if($tabActive==1) show active @endif" id="bao-cao-tuan-hien-tai" role="tabpanel" aria-labelledby="bao-cao-tuan-hien-tai-tab">
                              <form class="forms-sample frm-bao-cao-tuan-hien-tai" id="frm-bao-cao-tuan-hien-tai" name="frm-bao-cao-tuan-hien-tai">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                                <div class="row justify-content-center align-items-center">
                                  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <div class="form-group">
                                      <Textarea class="form-control bao-cao-tuan-style noi-dung-bao-cao-tuan-hien-tai" placeholder="Nội dung báo cáo tuần này" name="noi_dung"></Textarea>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
                                    <button type="button" class="btn btn-vnpt mr-2 btn-bao-cao-tuan-hien-tai"><i class="fa fa-plus"></i>Thêm</button>

                                    <button type="button" class="btn btn-danger mr-2 btn-lay-ke-hoach-tuan-truoc"><i class="fa fa-download"></i></button>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-responsive load-danh-sach-bao-cao-tuan-hien-tai">
                                         
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            @endif
                            @if ($checkQuyenBaoCaoKeHoachTuan==1)
                            <div class="tab-pane fade @if($tabActive==2) show active @endif" id="bao-cao-ke-hoach-tuan" role="tabpanel" aria-labelledby="bao-cao-ke-hoach-tuan-tab">
                              <form class="forms-sample frm-bao-cao-ke-hoach-tuan" id="frm-bao-cao-ke-hoach-tuan" name="frm-bao-cao-ke-hoach-tuan">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                                <div class="row justify-content-center align-items-center">
                                  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <div class="form-group">
                                      <Textarea type="Text" class="form-control bao-cao-tuan-style noi-dung-bao-cao-ke-hoach-tuan" name="noi_dung" placeholder="Nội dung kế hoạch tuần kế tiếp"></Textarea>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
                                    <button type="button" class="btn btn-vnpt mr-2 btn-bao-cao-ke-hoach-tuan"><i class="fa fa-plus"></i> Thêm</button>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-responsive load-danh-sach-bao-cao-ke-hoach-tuan">
                                           
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            @endif
                            @if ($checkQuyenBaoCaoDhsxkd==1)
                            <div class="tab-pane fade @if($tabActive==3) show active @endif" id="dhsxkd" role="tabpanel" aria-labelledby="dhsxkd-tab">
                              <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="load-danh-sach-dhsxkd">                                     
                                  </div>
                                </div>
                              </div>                                  
                            </div>
                            @endif
                            @if ($checkQuyenXemBaoCaoTongHop==1)
                            <div class="tab-pane fade @if($tabActive==4) show active @endif" id="chot-va-gui-bao-cao" role="tabpanel" aria-labelledby="chot-va-gui-bao-cao-tab">
                              <div class="row">
                                <div class="col-12">
                                  <div class="load-danh-sach-bao-cao-tong-hop">
                                         
                                  </div>
                                </div>
                              </div>                              
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>


  <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
  
  <script type="text/javascript">
    jQuery(document).ready(function() {
      $.fn.dataTable.ext.errMode = 'none';
      
      capNhatBaoCaoTuanHienTai=function(form){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);

        
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('trung-tam-vien-thong-cap-nhat-bao-cao-tuan-hien-tai') }}",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);            
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      chenBaoCaoTuanHienTai=function(form){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('trung-tam-vien-thong-chen-bao-cao-tuan-hien-tai') }}",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);
              jQuery('.noi-dung-bao-cao-tuan-hien-tai-3').val('');
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      capNhatKeHoachTuan=function(form){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('trung-tam-vien-thong-cap-nhat-bao-cao-ke-hoach-tuan') }}",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
              jQuery('.chen-ke-hoach-tuan').val('');           
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      chenKeHoachTuan=function(form){
        loading('.error-mode');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('trung-tam-vien-thong-chen-ke-hoach-tuan') }}",
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
              
              jQuery('.chen-ke-hoach-tuan').val('');
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      baoCaoTuanHienTaiDiChuyenLen=function(id){     
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);

        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-bao-cao-tuan-hien-tai-di-chuyen-len') }}",
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      baoCaoTuanHienTaiDiChuyenXuong=function(id){     
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);

        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-bao-cao-tuan-hien-tai-di-chuyen-xuong') }}",
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);   
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      keHoachTuanDiChuyenLen=function(id){     
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);

        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-ke-hoach-tuan-di-chuyen-len') }}",
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);   
              loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      keHoachTuanDiChuyenXuong=function(id){     
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);

        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-ke-hoach-tuan-di-chuyen-xuong') }}",
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
               loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
               loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }



      // THÔNG TIN CHUNG
      // onload
      var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
      var idTuan=jQuery('.id_tuan').val();
      jQuery('.input-id-tuan').val(idTuan);
      

      @if ($tabActive==1)
        // Load báo cáo tuần          
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);
      @endif
      @if ($tabActive==2)
        // Load kế hoạch tuần          
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
      @endif
      @if ($tabActive==3)
        // Load dữ liệu điều hành sản xuất kinh doanh dhsxkd
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
      @endif
      @if ($tabActive==4)
        // Load báo cáo tổng hợp
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      @endif


      // Onchange selectbox tuần
      jQuery('.id_tuan').on('change',function(){
        var idTuan=jQuery(this).val();
        jQuery('.input-id-tuan').val(idTuan);

        @if ($checkQuyenBaoCaoTuanHienTai==1)
          // Load báo cáo tuần          
          loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);
        @endif
        @if ($checkQuyenBaoCaoKeHoachTuan==1)
          // Load kế hoạch tuần          
          loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
        @endif
        @if ($checkQuyenBaoCaoDhsxkd==1)
          // Load dữ liệu điều hành sản xuất kinh doanh dhsxkd
          loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
        @endif
        @if ($checkQuyenXemBaoCaoTongHop==1)
          // Load báo cáo tổng hợp
          loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
        @endif
      });













      // MODULE BÁO CÁO TUẦN HIỆN TẠI
      $(".noi-dung-bao-cao-tuan-hien-tai").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var idTuan=jQuery('#id_tuan').val();
            var form=jQuery(this).parents('form');
            themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('trung-tam-vien-thong-them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai', false);
            jQuery('.noi-dung-bao-cao-tuan-hien-tai').val('');
            return false;
          }
      });

      jQuery('.btn-bao-cao-tuan-hien-tai').on("click", function(e) {
        var idTuan=jQuery('#id_tuan').val();
        var form=jQuery(this).parents('form');
        themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('trung-tam-vien-thong-them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai', false);
        jQuery('.noi-dung-bao-cao-tuan-hien-tai').val('');
        return false;
      });

      jQuery('#bao-cao-tuan-hien-tai-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);
      });

      jQuery('.btn-lay-ke-hoach-tuan-truoc').on('click', function() {
        var idTuan=jQuery('#id_tuan').val();
        postAndRefreshById(_token, idTuan, "{{ route('trung-tam-vien-thong-lay-du-lieu-tu-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai', false);
      });


      // MODULE BÁO CÁO KẾ HOẠCH TUẦN
      $(".noi-dung-bao-cao-ke-hoach-tuan").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var idTuan=jQuery('#id_tuan').val();
            var form=jQuery(this).parents('form');
            themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan', false);
            jQuery('.noi-dung-bao-cao-ke-hoach-tuan').val('');
            return false;
          }
      });

      jQuery('.btn-bao-cao-ke-hoach-tuan').on("click", function(e) {
        var idTuan=jQuery('#id_tuan').val();
        var form=jQuery(this).parents('form');
        themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan', false);
        jQuery('.noi-dung-bao-cao-ke-hoach-tuan').val('');
        return false;
      });

      jQuery('#bao-cao-ke-hoach-tuan-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
      });

      // ĐHSXKD
      jQuery('#dhsxkd-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load kế hoạch tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
      });

      // MODULE BÁO CÁO TỔNG HỢP
      jQuery('#chot-va-gui-bao-cao-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


      function secondsToHms(d) {
          d = Number(d);
          var ngay = Math.floor(d / (3600*24));
          var h = Math.floor((d / 3600)-ngay*24);
          var m = Math.floor(d % 3600 / 60);
          var s = Math.floor(d % 3600 % 60);

          var dDisplay = ngay > 0 ? ngay + (ngay == 1 ? "" : "") : "0";
          var hDisplay = h > 0 ? h + (h == 1 ? "" : "") : "0";
          var mDisplay = m > 0 ? m + (m == 1 ? "" : "") : "0";
          var sDisplay = s > 0 ? s + (s == 1 ? "" : "") : "0";
          if(dDisplay<10){dDisplay="0"+dDisplay}
          if(hDisplay<10){hDisplay="0"+hDisplay}
          if(mDisplay<10){mDisplay="0"+mDisplay}
          if(sDisplay<10){sDisplay="0"+sDisplay}
          return dDisplay + " ngày " + hDisplay + " : " + mDisplay + " : " + sDisplay; 
      }

      var startDate = new Date();
      // Do your operations
      var endDate   = new Date("{{$maxThoiGianBaoCao}}");
      var seconds = (endDate.getTime() - startDate.getTime()) / 1000;
      seconds=Math.ceil(seconds);
      
      function countdown() {
        jQuery('#thoi-gian-con-lai').parents('b').html('Hạn báo cáo: <span id="thoi-gian-con-lai" class="text-primary"></span>');
        var i = document.getElementById("thoi-gian-con-lai");
        seconds=seconds-1;
        if(seconds<=0){
          jQuery('#thoi-gian-con-lai').addClass("text-danger").removeClass('text-primary').text("Đã quán hạn báo cáo");
        }else{
          i.innerHTML = secondsToHms(seconds);  
        }
              
      }
      if(seconds>0){
        setInterval(function(){ countdown(); },1000);
      }else{
        jQuery('#thoi-gian-con-lai').addClass("text-danger").removeClass('text-primary').text("Đã quán hạn báo cáo");
      }


     
      

      
    });
  </script>
@endsection

