@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
  $userId=0; 
  if(Auth::id()){
      $userId=Auth::id();
  }
  $checkQuyenChinhSuaBaoCaoCuaNhom=Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'CHINH_SUA_BAO_CAO_NHOM');
@endphp
<table id="table-bao-cao-tuan-hien-tai" class="table table-hover table-bao-cao-tuan-hien-tai">
  <thead>
      <tr class="background-vnpt text-center">
          <th style="width: 1%;"></th>
          <th style="width: 84%;">Nội dung báo cáo tuần này</th>
          <th style="width: 15%;">
              @if ($daChotSoLieu>0)
                  Trạng thái
              @else
                Xử lý
              @endif
          </th>
      </tr>
  </thead>
  <tbody>    
      @php $stt=0; $sttPhanMem=0; $checkChotBaoCaoTheoUser=0; @endphp
      @foreach ($baoCaos as $baoCao)
        @php 
          $stt++; 
          if ($baoCao['id_user_bao_cao']==$userId && $baoCao['trang_thai']>0){
            $checkChotBaoCaoTheoUser=1;
          }          
        @endphp
          
        <tr class="tr-hover tr-small">
          <td class="text-center"></td>
          <td class="cusor">
            @php
              $icon="<i class='white-circle'></i>";
              $class='';
              $attr='';
              if (($daChotSoLieu==0 && $baoCao['trang_thai']==0) || ($baoCao['trang_thai']<2 && $checkQuyenChinhSuaBaoCaoCuaNhom==1)){
                $class='dbclick-view-form hover-view-form';
                $attr="data-hover-view-form='.chen-noi-dung' data-dbclick-view-form='.frm-cap-nhat-bao-cao-tuan-".$baoCao['id']."'";
              }
              if($baoCao['is_group']==3){
                $sttPhanMem++;                
                $icon=$sttPhanMem.". ";
              }
              elseif($baoCao['is_group']==2){
                $icon="<i class='fa fa-minus'></i>";
              }
              elseif($baoCao['is_group']==1){
                $icon="<i class='plus-sign'></i>";
              }
              else{
                $icon="<i class='white-circle'></i>";
              }

              echo "<div class='is-group-".$baoCao['is_group']." ".$class."' ".$attr.">".$icon.$baoCao['noi_dung']."
                  <i class='chen-noi-dung d-none'>
                    <i class='fa fa-plus-circle text-primary cusor click-view-form' data-click-view-form='#frm-chen-bao-cao-tuan-hien-tai-".$baoCao['id']."'></i>
                  </i>
                </div>";
            @endphp
            @if (($daChotSoLieu==0 && $baoCao['trang_thai']==0) || ($baoCao['trang_thai']<2 && $checkQuyenChinhSuaBaoCaoCuaNhom==1))
              <form class="forms-sample frm-chen-bao-cao-tuan-hien-tai-{{$baoCao['id']}} d-none" id="frm-chen-bao-cao-tuan-hien-tai-{{$baoCao['id']}}" name="frm-chen-bao-cao-tuan-hien-tai-{{$baoCao['id']}}" action="javascript:void(0)">
                {{ csrf_field() }}
                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                <input type="hidden" name="id_bao_cao_truoc" class="id-bao-cao" value="{{$baoCao['id']}}">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                      <input type="hidden" name="id_dich_vu" class="input-id-dich-vu" value="">
                      <textarea name="noi_dung" class="form-control chen-noi-dung-bao-cao-tuan-hien-tai-3" data="{{$baoCao['id']}}" placeholder="Lưu ý: chỉ chèn một dòng dữ liệu"></textarea>
                    </div>
                  </div>
                </div>
              </form>
              <form class="forms-sample frm-cap-nhat-bao-cao-tuan d-none frm-cap-nhat-bao-cao-tuan-{{$baoCao['id']}}" name="#frm-cap-nhat-bao-cao-tuan-{{$baoCao['id']}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$baoCao['id']}}">
                <textarea name="noi_dung" class="form-control noi-dung" data="{{$baoCao['id']}}">@php
                    $noiDung=trim(nl2br($baoCao['noi_dung']));
                    $noiDung=str_replace("<br />", "", $noiDung);
                    $noiDung=str_replace("<br/>", "", $noiDung);
                    $noiDung=str_replace("<br>", "", $noiDung);
                    echo $noiDung;@endphp</textarea>
              </form>
            @endif
          </td>
          <td class="text-center">
            @if (($daChotSoLieu==0 && $baoCao['trang_thai']==0) || ($baoCao['trang_thai']<2 && $checkQuyenChinhSuaBaoCaoCuaNhom==1))
              @if ($baoCao['is_group']<3)
                <i class="fa fa-long-arrow-up text-success cusor btn-tuan-hien-tai-di-chuyen-len" data="{{$baoCao['id']}}" data-toggle="tooltip" data-placement="bottom" title="Di chuyển lên"></i>&nbsp;
                <i class="fa fa-long-arrow-down text-danger cusor btn-tuan-hien-tai-di-chuyen-xuong" data="{{$baoCao['id']}}" data-toggle="tooltip" data-placement="bottom" title="Di chuyển xuống"></i> &nbsp;&nbsp;&nbsp;
                <i class="is-group fa fa-th-list cusor i-hover @if($baoCao['is_group']==2) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCao['id']}}_2" data-toggle="tooltip" data-placement="bottom" title="Canh dòng &minus;"></i> &nbsp;&nbsp;&nbsp;                
                <i class="is-group fa fa-list-ul cusor i-hover @if($baoCao['is_group']==1) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCao['id']}}_1" data-toggle="tooltip" data-placement="bottom" title="Canh dòng &plus;"></i> &nbsp;&nbsp;&nbsp;
                <i class="is-group fa fa fa-indent cusor i-hover @if($baoCao['is_group']==0) {{"text-primary font-weight-bold"}} @endif" data="{{$baoCao['id']}}_0"  data-toggle="tooltip" data-placement="bottom" title="Canh dòng ○"></i> &nbsp;&nbsp;&nbsp;
                <i class="fa fa-times-rectangle-o text-danger cusor btn-xoa-bao-cao-tuan-hien-tai" data="{{$baoCao['id']}}" data-toggle="tooltip" data-placement="bottom" title="Xóa dòng"></i>
              @endif
            @else
                <div class="text-success">Đã chốt số liệu</div>
            @endif
              
          </td>
        </tr>
      @endforeach
  </tbody>
</table>   
@if (($daChotSoLieu==0 && $checkChotBaoCaoTheoUser==0) || ($checkChotBaoCaoTheoUser==1 && $checkQuyenChinhSuaBaoCaoCuaNhom==1))
  <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/view-form.js"></script>
@endif
<script type="text/javascript">
    jQuery(document).ready(function() {
       $('#table-bao-cao-tuan-hien-tai').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
       

        

      var daChotSoLieu={{$daChotSoLieu}};
      if(daChotSoLieu>0){
        jQuery('.noi-dung-bao-cao-tuan-hien-tai').addClass('disabled').attr('disabled', true);
        jQuery('.btn-bao-cao-tuan-hien-tai').addClass('disabled').attr('disabled', true);
        jQuery('.btn-lay-ke-hoach-tuan-truoc').addClass('disabled').attr('disabled', true);
      }else{
        jQuery('.noi-dung-bao-cao-tuan-hien-tai').removeClass('disabled').attr('disabled', false);
        jQuery('.btn-bao-cao-tuan-hien-tai').removeClass('disabled').attr('disabled', false);
        jQuery('.btn-lay-ke-hoach-tuan-truoc').removeClass('disabled').attr('disabled', false);
      }

      jQuery('.is-group').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        isGroup(id);
        return false;
      });

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

      chenBaoCaoTuanHienTai=function(form){
        loading('.error-mode');
        var formData = new FormData(form[0]);
        var xhr1;  
        if(xhr1 && xhr1.readyState != 4){
            xhr1.abort(); //huy lenh ajax truoc do
        }
        xhr1 = jQuery.ajax({
          url: "{{ route('don-vi-truc-thuoc-khac-chen-bao-cao-tuan-hien-tai') }}",
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

      isGroup=function(id){     
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
          url: "{{ route('don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai') }}",
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
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      xoaBaoCaoTuanHienTai=function(id){     
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
          url: "{{ route('don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai') }}",
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
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      capNhatBaoCaoTuanHienTai=function(form){
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
          url: "{{ route('don-vi-truc-thuoc-khac-cap-nhat-bao-cao-tuan-hien-tai') }}",
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

      

      
      jQuery('.btn-xoa-bao-cao-tuan-hien-tai').on('click',function(){    
        var id=jQuery(this).attr("data");
        xoaBaoCaoTuanHienTai(id);
        return false;
      });


      $(".noi-dung").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var daChotSoLieu={{$daChotSoLieu}};
            if(daChotSoLieu>0){
              errorLoader(".error-mode","Đã chốt số liệu không thể chỉnh sửa");
              return false;
            }
            var form=jQuery(this).parents('form');
            var _token=form.find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();
            capNhatBaoCaoTuanHienTai(form);
            return false;
          }
      });

      $(".chen-noi-dung-bao-cao-tuan-hien-tai-3").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var form = jQuery(this).parents('form');
            var idTuan=jQuery('#id_tuan').val();
            jQuery('.input-id-tuan').val(idTuan);
            var idDichVu=jQuery('#id-dich-vu').val();
            jQuery('.input-id-dich-vu').val(idDichVu);
            chenBaoCaoTuanHienTai(form); 
            return false;
          }
      });

      jQuery('.btn-tuan-hien-tai-di-chuyen-len').on('click',function(){    
        var id=jQuery(this).attr("data");
        baoCaoTuanHienTaiDiChuyenLen(id);
        return false;
      });

      jQuery('.btn-tuan-hien-tai-di-chuyen-xuong').on('click',function(){    
        var id=jQuery(this).attr("data");
        baoCaoTuanHienTaiDiChuyenXuong(id);
        return false;
      });



        
    });
</script>


