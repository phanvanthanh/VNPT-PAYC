@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
  /*echo '<pre>';

  print_r($baoCaos);*/
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
      @php $stt=0; $sttPhanMem=0; @endphp
      @foreach ($baoCaos as $baoCao)
        @php $stt++; @endphp
        <tr class="tr-hover tr-small">
          <td class="text-center"></td>
          <td class="cusor">
            @php
              if($baoCao['is_group']==3){
                $sttPhanMem++;
                echo "<div class='is-group-3 dbclick-view-form' data-dbclick-view-form='.frm-cap-nhat-bao-cao-tuan-".$baoCao['id']."'>".$sttPhanMem.". ".$baoCao['noi_dung']."</div>";
              }
              elseif($baoCao['is_group']==2){
                echo "<div class='is-group-2 dbclick-view-form' data-dbclick-view-form='.frm-cap-nhat-bao-cao-tuan-".$baoCao['id']."'><i class='fa fa-minus'></i>".$baoCao['noi_dung']."</div>";
              }
              elseif($baoCao['is_group']==1){
                echo "<div class='is-group-1 dbclick-view-form' data-dbclick-view-form='.frm-cap-nhat-bao-cao-tuan-".$baoCao['id']."'><i class='plus-sign'></i>".$baoCao['noi_dung']."</div>";
              }
              else{
                echo "<div class='is-group-0 dbclick-view-form' data-dbclick-view-form='.frm-cap-nhat-bao-cao-tuan-".$baoCao['id']."'><i class='white-circle'></i>".$baoCao['noi_dung']."</div>";
              }
            @endphp
            @if ($daChotSoLieu==0)
              <form class="forms-sample frm-cap-nhat-bao-cao-tuan d-none frm-cap-nhat-bao-cao-tuan-{{$baoCao['id']}}" name="#frm-cap-nhat-bao-cao-tuan-{{$baoCao['id']}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$baoCao['id']}}">
                <textarea name="noi_dung" class="form-control noi-dung" data="{{$baoCao['id']}}">@php echo nl2br($baoCao['noi_dung']);@endphp</textarea>
              </form>
            @endif
          </td>
          <td class="text-center">
            @if ($daChotSoLieu==0)
              @if ($baoCao['is_group']<3)
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

<script type="text/javascript" src="{{ asset('public/js/view-form.js') }}"></script>
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

      isGroup=function(id){     
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        console.log(_token);
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
        console.log(_token);
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


      jQuery('.noi-dung').on("keypress", function(e) {
        if (e.keyCode == 13) {
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



        
    });
</script>


