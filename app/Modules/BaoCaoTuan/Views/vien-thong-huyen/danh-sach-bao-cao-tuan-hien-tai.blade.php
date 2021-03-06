@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
@endphp
<table id="table-bao-cao-tuan-hien-tai" class="table table-hover table-bao-cao-tuan-hien-tai">
  <thead>
      <tr class="background-vnpt text-center">
          <th style="width: 10%;">STT #</th>
          <th style="width: 75%;">Nội dung báo cáo tuần này</th>
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
          <td class="text-center">{{$stt}}</td>
          <td class='cusor'>
            @php
              $icon="<i class='white-circle'></i>";
              $class='';
              $attr='';
              if ($daChotSoLieu==0 && $baoCao['trang_thai']==0){
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
            @if ($daChotSoLieu==0 && $baoCao['trang_thai']==0)
              <form class="forms-sample frm-chen-bao-cao-tuan-hien-tai-{{$baoCao['id']}} d-none" id="frm-chen-bao-cao-tuan-hien-tai-{{$baoCao['id']}}" name="frm-chen-bao-cao-tuan-hien-tai-{{$baoCao['id']}}" action="javascript:void(0)">
                {{ csrf_field() }}
                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                <input type="hidden" name="id_bao_cao_truoc" class="id-bao-cao" value="{{$baoCao['id']}}">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
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
            @if ($daChotSoLieu==0 && $baoCao['trang_thai']==0)
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


@if ($daChotSoLieu==0)
  <script type="text/javascript" src="{{ secure_asset('public/js/view-form.js') }}"></script>
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

        jQuery('.btn-xoa-bao-cao-tuan-hien-tai').on('click',function(){  
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();    
          var id=jQuery(this).attr("data"); // lấy id
          var idTuan=jQuery('#id_tuan').val(); 
          xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('xoa-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai');
          return false;
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
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('bc-is-group-tuan-hien-tai') }}", idTuan, "{{ route('danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai', false);
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


