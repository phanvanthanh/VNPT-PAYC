@extends('layouts.index')
@section('title', 'Phòng ban/Trung tâm')
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

                  $checkQuyenBaoCaoTuanHienTai=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_TUAN_HIEN_TAI');
                  $checkQuyenBaoCaoKeHoachTuan=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_KE_HOACH_TUAN');
                  $checkQuyenBaoCaoDhsxkd=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_DHSXKD');
                  $checkQuyenXemBaoCaoTongHop=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XEM_BAO_CAO_TONG_HOP');
                @endphp
                
                <div class="row user-profile">
                  
                  <div class="col-lg-12 side-right stretch-card">
                    <div class="card">
                      <div class="card-body" style="min-height: 500px;">
                        <form class="forms-sample frm-bao-cao-tuan" id="frm-bao-cao-tuan" name="frm-bao-cao-tuan"><div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                          <h4 class="card-title mb-2" style="width: 25%;">
                            
                              {{ csrf_field() }}
                              <select class="form-control id_tuan bao-cao-tuan-style" id="id_tuan" name="id_tuan" aria-describedby="tuan_helper" style="width: 100%;">
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
                          </h4>
                          <h4 class="card-title mb-2" style="width: 25%;">
                              <select id="id-dich-vu" class="bao-cao-tuan-style form-control @if(count($dichVus)<=1) d-none @endif" name="id_dich_vu">
                                @foreach ($dichVus as $dichVu)
                                  <option value="{{$dichVu['id_dich_vu']}}">{{$dichVu['ten_dich_vu']}}</option> 
                                @endforeach                                         
                              </select>                            
                          </h4>

                          <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            @if ($checkQuyenBaoCaoTuanHienTai==1)
                              <li class="nav-item">
                                <a class="nav-link active" id="bao-cao-tuan-hien-tai-tab" data-toggle="tab" href="#bao-cao-tuan-hien-tai" role="tab" aria-controls="bao-cao-tuan-hien-tai">BC tuần</a>
                              </li>
                            @endif
                            @if ($checkQuyenBaoCaoKeHoachTuan==1)
                              <li class="nav-item">
                                <a class="nav-link" id="bao-cao-ke-hoach-tuan-tab" data-toggle="tab" href="#bao-cao-ke-hoach-tuan" role="tab" aria-controls="bao-cao-ke-hoach-tuan">KH tuần</a>
                              </li>
                            @endif
                            @if ($checkQuyenBaoCaoDhsxkd==1)
                            <li class="nav-item">
                              <a class="nav-link" id="dhsxkd-tab" data-toggle="tab" href="#dhsxkd" role="tab" aria-controls="dhsxkd">ĐHSXKD</a>
                            </li>
                            @endif
                            @if ($checkQuyenXemBaoCaoTongHop==1)
                            <li class="nav-item">
                              <a class="nav-link" id="chot-va-gui-bao-cao-tab" data-toggle="tab" href="#chot-va-gui-bao-cao" role="tab" aria-controls="tong-hop-va-gui-bao-cao">Xem & duyệt báo cáo</a>
                            </li>
                            @endif
                          </ul>
                        </div>
                        </form>
                        <div class="wrapper">
                          <hr>
                          <div class="tab-content" id="myTabContent"  style="min-height: 100%;">

                            @if ($checkQuyenBaoCaoTuanHienTai==1)                              
                            <div class="tab-pane fade show active" id="bao-cao-tuan-hien-tai" role="tabpanel" aria-labelledby="bao-cao-tuan-hien-tai-tab">
                              <form class="forms-sample frm-bao-cao-tuan-hien-tai" id="frm-bao-cao-tuan-hien-tai" name="frm-bao-cao-tuan-hien-tai">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                                <input type="hidden" name="id_dich_vu" class="input-id-dich-vu" value="">
                                <div class="row justify-content-center align-items-center">
                                  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <div class="form-group">                                      
                                      <Textarea class="form-control bao-cao-tuan-style noi-dung-bao-cao-tuan-hien-tai" placeholder="Nội dung báo cáo kết quả công tác tuần qua" name="noi_dung"></Textarea>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
                                    <button type="button" class="btn btn-vnpt mr-2 btn-bao-cao-tuan-hien-tai"><i class="fa fa-plus"></i></button>

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
                            <div class="tab-pane fade" id="bao-cao-ke-hoach-tuan" role="tabpanel" aria-labelledby="bao-cao-ke-hoach-tuan-tab">
                              <form class="forms-sample frm-bao-cao-ke-hoach-tuan" id="frm-bao-cao-ke-hoach-tuan" name="frm-bao-cao-ke-hoach-tuan">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                                <input type="hidden" name="id_dich_vu" class="input-id-dich-vu" value="">
                                <div class="row justify-content-center align-items-center">
                                  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                    <div class="form-group">
                                      <Textarea type="Text" class="form-control bao-cao-tuan-style noi-dung-bao-cao-ke-hoach-tuan" name="noi_dung" placeholder="Nội dung kế hoạch tuần tiếp theo"></Textarea>
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
                            <div class="tab-pane fade" id="dhsxkd" role="tabpanel" aria-labelledby="dhsxkd-tab">
                              <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="load-danh-sach-dhsxkd">                                     
                                  </div>
                                </div>
                              </div>                                  
                            </div>
                            @endif
                            @if ($checkQuyenXemBaoCaoTongHop==1)
                            <div class="tab-pane fade" id="chot-va-gui-bao-cao" role="tabpanel" aria-labelledby="chot-va-gui-bao-cao-tab">
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

      loadBaoCaoTuanHienTai=function(){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        var form=jQuery('form[name="frm-bao-cao-tuan"]');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai') }}",
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
              jQuery('.load-danh-sach-bao-cao-tuan-hien-tai').html(data.html);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      themBaoCaoTuanHienTai=function(){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        
        var form=jQuery('form[name="frm-bao-cao-tuan-hien-tai"]');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai') }}",
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
              loadBaoCaoTuanHienTai();
              jQuery('.noi-dung-bao-cao-tuan-hien-tai').val('');
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      layDuLieuTuKeHoachTuan=function(){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        
        var form=jQuery('form[name="frm-bao-cao-tuan"]');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-lay-du-lieu-tu-ke-hoach-tuan') }}",
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
              loadBaoCaoTuanHienTai();
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }



      loadKeHoachTuan=function(){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        var form=jQuery('form[name="frm-bao-cao-tuan"]');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan') }}",
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
              jQuery('.load-danh-sach-bao-cao-ke-hoach-tuan').html(data.html);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      themKeHoachTuan=function(){
        loading('.error-mode');
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        
        var form=jQuery('form[name="frm-bao-cao-ke-hoach-tuan"]');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan') }}",
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
              loadKeHoachTuan();
              jQuery('.noi-dung-bao-cao-ke-hoach-tuan').val('');
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
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

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
              loadBaoCaoTuanHienTai();           
              loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);   
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
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

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
              loadBaoCaoTuanHienTai();           
              loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);   
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
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

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
              loadKeHoachTuan();      
              loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);        
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
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

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
              loadKeHoachTuan();              
              loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      chotBaoCaoNhom=function(){     
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-chot-bao-cao-nhom') }}",
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id_tuan':idTuan,
              'id_dich_vu':idDichVu,
          },
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){          
              loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);   
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
      var idDichVu=jQuery('#id-dich-vu').val();
      jQuery('.input-id-dich-vu').val(idDichVu);
      var form=jQuery('form[name="frm-bao-cao-tuan"]');
      var formData = new FormData(form[0]);

      loadBaoCaoTuanHienTai();
      


      // Onchange selectbox tuần
      jQuery('.id_tuan').on('change',function(){
        var idTuan=jQuery(this).val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);

        @if ($checkQuyenBaoCaoTuanHienTai==1)
          // Load báo cáo tuần          
          loadBaoCaoTuanHienTai();
        @endif
        @if ($checkQuyenBaoCaoKeHoachTuan==1)
          // Load kế hoạch tuần          
          loadKeHoachTuan();
        @endif
        @if ($checkQuyenBaoCaoDhsxkd==1)
          // Load dữ liệu điều hành sản xuất kinh doanh dhsxkd
          loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
        @endif
        @if ($checkQuyenXemBaoCaoTongHop==1)
          // Load báo cáo tổng hợp
          loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
        @endif
      });

      jQuery('#id-dich-vu').on('change', function() {
        @if ($checkQuyenBaoCaoTuanHienTai==1)
          // Load báo cáo tuần          
          loadBaoCaoTuanHienTai();
        @endif
        @if ($checkQuyenBaoCaoKeHoachTuan==1)
          // Load kế hoạch tuần          
          loadKeHoachTuan();
        @endif
      });













      // MODULE BÁO CÁO TUẦN HIỆN TẠI

      $(".noi-dung-bao-cao-tuan-hien-tai").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            themBaoCaoTuanHienTai();            
          }
      });


      jQuery('.btn-bao-cao-tuan-hien-tai').on("click", function(e) {
        themBaoCaoTuanHienTai();
        return false;
      });

      jQuery('#bao-cao-tuan-hien-tai-tab').on('click',function(){
        // Load báo cáo tuần
        loadBaoCaoTuanHienTai();        
      });

      jQuery('.btn-lay-ke-hoach-tuan-truoc').on('click', function() {
        var idTuan=jQuery('#id_tuan').val();
        layDuLieuTuKeHoachTuan();
        return false;
      });


      // MODULE BÁO CÁO KẾ HOẠCH TUẦN
      $(".noi-dung-bao-cao-ke-hoach-tuan").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            themKeHoachTuan();
          }
      });

      jQuery('.btn-bao-cao-ke-hoach-tuan').on("click", function(e) {
        themKeHoachTuan();        
        return false;
      });

      jQuery('#bao-cao-ke-hoach-tuan-tab').on('click',function(){
        // Load báo cáo tuần
        loadKeHoachTuan();
      });

      // ĐHSXKD
      jQuery('#dhsxkd-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);
        // Load kế hoạch tuần
        loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
      });

      // MODULE BÁO CÁO TỔNG HỢP
      jQuery('#chot-va-gui-bao-cao-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        var idDichVu=jQuery('#id-dich-vu').val();
        jQuery('.input-id-dich-vu').val(idDichVu);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      



      jQuery('#id-dich-vu').on('change', function() {
        jQuery('.input-id-dich-vu').val(jQuery(this).val());
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

