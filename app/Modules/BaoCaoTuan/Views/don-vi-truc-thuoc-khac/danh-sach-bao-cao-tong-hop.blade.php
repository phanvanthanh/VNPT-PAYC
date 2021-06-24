@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
  $daVuotThoiGianBaoCao=Helper::kiemTraVuotNgayChotSoLieu($idTuan);

  $tuNgay = strtotime($dmTuan['tu_ngay']);
  $tuNgay = date('d/m/Y',$tuNgay);
  $denNgay = strtotime($dmTuan['den_ngay']);
  $denNgay = date('d/m/Y',$denNgay);

  $weekFix=$dmTuan['tuan']-1;
  $yearFix=date('Y');
  $dmTuanFix=Helper::getStartAndEndDateOfWeek($yearFix, $weekFix);
  $tuNgay=DateTime::createFromFormat('Y-m-d', $dmTuanFix[0])->format('d/m/Y');
  $denNgay=DateTime::createFromFormat('Y-m-d', $dmTuanFix[1])->format('d/m/Y');
  $checkQuyenDuyetVaGuiBaoCao=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'DUYET_VA_GUI_BAO_CAO');
  $checkQuyenXuatBaoCao=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XUAT_BAO_CAO');
   
@endphp
<input type="hidden" name="da_chot_so_lieu" class="da-chot-so-lieu" value="{{$daChotSoLieu}}">
<div class="noi-dung-bao-cao-tong-hop">
  {{-- Báo cáo tuần này --}}
  <div class="row">
    <div class="col-12">
      <h6 class="text-center">
        KẾ HOẠCH TUẦN {{$dmTuan['tuan']}}_{{$dmTuan['nam']}} VNPT. TVH <br>
        (Từ ngày {{$tuNgay}} đến {{$denNgay}})
      </h6>
      <h6 class="text-danger">* {{$donVi['ten_don_vi']}}</h6>
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">I. Báo cáo kết quả công tác tuần qua:
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-plus-circle text-primary cusor click-view-form" data-click-view-form="#frm-bao-cao-tuan-hien-tai-2"></i>
          </i>
        @endif
      </div>
      <form class="forms-sample frm-bao-cao-tuan-hien-tai-2 d-none" id="frm-bao-cao-tuan-hien-tai-2" name="frm-bao-cao-tuan-hien-tai-2">
        {{ csrf_field() }}
        <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <input type="hidden" name="id_dich_vu" class="input-id-dich-vu" value="">
              <input type="Text" class="form-control noi-dung-bao-cao-tuan-hien-tai" placeholder="Nội dung báo cáo tuần này" name="noi_dung" style="margin-left: 20px;">
            </div>
          </div>
        </div>
      </form>
      @php
        $sttPhanMem=0;
      @endphp
      <ul class="">
        @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
          <li  class='hover-view-form dbclick-view-form cusor 
            @if ($baoCaoTuanHienTai['is_group']==3) {{"li-is-group-3"}} @elseif ($baoCaoTuanHienTai['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoTuanHienTai['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
            ' data-hover-view-form=".list-menu-nhanh" data-dbclick-view-form="#frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}">

            @php
              if($baoCaoTuanHienTai['is_group']==3){
                $sttPhanMem++;
                echo "<div class='th-is-group-3'>".$sttPhanMem.'. '.$baoCaoTuanHienTai['noi_dung']."</div>";
              }
              elseif($baoCaoTuanHienTai['is_group']==2){
                echo "<div class='th-is-group-2'><i class='fa fa-minus'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
              elseif($baoCaoTuanHienTai['is_group']==1){
                echo "<div class='th-is-group-1'><i class='plus-sign'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
              else{
                echo "<div class='th-is-group-0'><i class='white-circle'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
            @endphp


            @if ($daChotSoLieu==0 && $baoCaoTuanHienTai['is_group']<3)
                <i class="list-menu-nhanh d-none">
                  <i class="is-group fa fa-th-list cusor i-hover @if($baoCaoTuanHienTai['is_group']==2) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoTuanHienTai['id']}}_2"></i> &nbsp;&nbsp;&nbsp;                
                  <i class="is-group fa fa-list-ul cusor i-hover @if($baoCaoTuanHienTai['is_group']==1) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoTuanHienTai['id']}}_1"></i> &nbsp;&nbsp;&nbsp;
                  <i class="is-group fa fa fa-indent cusor i-hover @if($baoCaoTuanHienTai['is_group']==0) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoTuanHienTai['id']}}_0"></i> &nbsp;&nbsp;&nbsp;
                  <i class="fa fa-times-rectangle-o text-danger cusor btn-xoa-bao-cao-tuan-hien-tai" data="{{$baoCaoTuanHienTai['id']}}"></i>
                </i>
            @endif

          </li>
          <form class="forms-sample frm-cap-nhat-bao-cao-tuan-hien-tai d-none" id="frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}" name="frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$baoCaoTuanHienTai['id']}}">
            <input @if ($baoCaoTuanHienTai['is_group']==1) style='margin-left: 20px;' @else style='margin-left: 20px;' @endif type="text" name="noi_dung" class="form-control cap-nhat-bao-cao-tuan-hien-tai" data="{{$baoCaoTuanHienTai['id']}}" value="{{$baoCaoTuanHienTai['noi_dung']}}" id="cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}">
          </form>
        @endforeach
      </ul>
          {{-- Sau này a sa quang cung cấp số liệu thì mở lại nha --}}
          {{-- <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 35px;"><i class='fa fa-minus' style="margin-right:10px;"></i>Báo cáo số liệu PAKN
            @if ($daChotSoLieu==0)
              <i class="list-menu-nhanh d-none">
                <i class="fa fa-refresh text-primary cusor btn-lay-so-lieu-bao-cao-dhsxkd"></i>
              </i>
            @endif
          </div> --}}
        
          @if (count($baoCaoPakns)>0)
            {{-- <div class="font-weight-bold" style="margin-left: 30px;">* Xử lý PAKN</div> --}}
            <div style="margin-left: 40px; margin-bottom: 35px;">
              <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
                <thead>
                    <tr class="background-vnpt text-center">
                        <th style="width: 10%;">STT #</th>
                        <th style="width: 40;">Dịch vụ</th>
                        <th style="width: 35%;">Số lượng</th>
                        <th style="width: 15%;">
                          Ghi chú
                        </th>
                    </tr>
                </thead>
                <tbody>    
                    @php $stt=0; @endphp
                      @foreach ($baoCaoPakns as $pakn)
                        @php $stt++; @endphp
                        <tr class="tr-hover tr-small">
                          <td class="text-center">{{$stt}}</td>
                          <td class='text-primary @if($pakn['is_group']==1) {{" font-weight-bold"}} @endif'>
                            @if ($pakn['mo_ta'])
                              {{$pakn['mo_ta']}}
                            @else
                              {{$pakn['chi_so']}}
                            @endif
                          </td>
                          <td>
                            {{$pakn['gia_tri']}}
                          </td>
                        <td class="text-center">
                          {{$pakn['ghi_chu']}}
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          @endif



      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">II. Đăng ký công tác tuần tiếp theo:
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-plus-circle text-primary cusor click-view-form" data-click-view-form="#frm-bao-cao-ke-hoach-tuan-2"></i>
          </i>
        @endif
      </div>
      <form class="forms-sample frm-bao-cao-ke-hoach-tuan-2 d-none" id="frm-bao-cao-ke-hoach-tuan-2" name="frm-bao-cao-ke-hoach-tuan-2">
        {{ csrf_field() }}
        <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
        <input type="hidden" name="id_dich_vu" class="input-id-dich-vu" value="">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <input type="Text" class="form-control noi-dung-bao-cao-ke-hoach-tuan" name="noi_dung" placeholder="Nội dung kế hoạch tuần kế tiếp">
            </div>
          </div>
        </div>
      </form>
      @php
        $sttPhanMem=0;
      @endphp
      <ul class="">
        @foreach ($baoCaoKeHoachTuans as $baoCaoKeHoachTuan)
            <li  class='hover-view-form dbclick-view-form cusor
              @if ($baoCaoKeHoachTuan['is_group']==3) {{"li-is-group-3"}} @elseif ($baoCaoKeHoachTuan['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoKeHoachTuan['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
              ' data-hover-view-form=".list-menu-nhanh" data-dbclick-view-form="#frm-cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}">
            @php
              if($baoCaoKeHoachTuan['is_group']==3){
                $sttPhanMem++;
                echo "<div class='th-is-group-3'>".$sttPhanMem.'. '.$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
              elseif($baoCaoKeHoachTuan['is_group']==2){
                echo "<div class='th-is-group-2'><i class='fa fa-minus'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
              elseif($baoCaoKeHoachTuan['is_group']==1){
                echo "<div class='th-is-group-1'><i class='plus-sign'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
              else{
                echo "<div class='th-is-group-0'><i class='white-circle'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
            @endphp


            @if ($daChotSoLieu==0 && $baoCaoKeHoachTuan['is_group']<3)
                <i class="list-menu-nhanh d-none">
                  <i class="is-group-ke-hoach-tuan fa fa-th-list cusor i-hover @if($baoCaoKeHoachTuan['is_group']==2) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoKeHoachTuan['id']}}_2"></i> &nbsp;&nbsp;&nbsp;                
                  <i class="is-group-ke-hoach-tuan fa fa-list-ul cusor i-hover @if($baoCaoKeHoachTuan['is_group']==1) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoKeHoachTuan['id']}}_1"></i> &nbsp;&nbsp;&nbsp;
                  <i class="is-group-ke-hoach-tuan fa fa fa-indent cusor i-hover @if($baoCaoKeHoachTuan['is_group']==0) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoKeHoachTuan['id']}}_0"></i> &nbsp;&nbsp;&nbsp;
                  <i class="fa fa-times-rectangle-o text-danger cusor btn-xoa-bao-cao-ke-hoach-tuan" data="{{$baoCaoKeHoachTuan['id']}}"></i>
                </i>
            @endif
          </li>
          <form class="forms-sample frm-cap-nhat-bao-cao-ke-hoach-tuan d-none" id="frm-cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}" name="cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$baoCaoKeHoachTuan['id']}}">
            <input @if ($baoCaoKeHoachTuan['is_group']==1) style='margin-left: 20px;' @else style='margin-left: 20px;' @endif type="text" name="noi_dung" class="form-control cap-nhat-bao-cao-ke-hoach-tuan" data="{{$baoCaoKeHoachTuan['id']}}" value="{{$baoCaoKeHoachTuan['noi_dung']}}" id="cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}">
          </form>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <br>
      <div class="form-group mt-5 text-right" style="margin-bottom: 0px;">
         @if ($checkQuyenXuatBaoCao==1)
          <button type="button" class="btn btn-vnpt mr-2 btn-xuat-bao-cao"><i class="fa fa-upload"></i> Xuất báo cáo</button>
        @endif
        @if ($checkQuyenDuyetVaGuiBaoCao==1)
          <button type="button" class="btn btn-danger mr-2 btn-chot-va-gui-bao-cao @if ($daChotSoLieu>0) disabled @endif" @if ($daChotSoLieu>0) disabled="disabled" @endif><i class="fa fa-send"></i> Duyệt & Gửi báo cáo</button>
        @endif
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="{{ asset('public/js/view-form.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/export-word/FileSaver.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/export-word/jquery.wordexport.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.btn-chot-va-gui-bao-cao').on('click',function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val(); 
        var idTuan=jQuery('#id_tuan').val();
        //postAndNotRefreshById(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu') }}", true);
        postAndRefreshById(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',true);
      });


      $(".cap-nhat-bao-cao-tuan-hien-tai").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var daChotSoLieu={{$daChotSoLieu}};
            if(daChotSoLieu>0){
              errorLoader(".error-mode","Đã chốt số liệu không thể chỉnh sửa");
              return false;
            }
            var form=jQuery(this).parents('form');
            var _token=form.find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();
            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('don-vi-truc-thuoc-khac-cap-nhat-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            return false;
          }
      });

      jQuery('.btn-xoa-bao-cao-tuan-hien-tai').on('click',function(){  
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var id=jQuery(this).attr("data"); // lấy id
        var idTuan=jQuery('#id_tuan').val(); 
        xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      jQuery('.is-group').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


      $(".noi-dung-bao-cao-tuan-hien-tai").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();
            var form=jQuery(this).parents('form');
            form.find('.input-id-tuan').val(idTuan);

            var idDichVu=jQuery('#id-dich-vu').val();
            jQuery('.input-id-dich-vu').val(idDichVu);
            themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            jQuery('#frm-bao-cao-tuan-hien-tai-2').addClass('d-none');
            e.preventDefault();
            return false;
          }
      });




      jQuery('.btn-lay-so-lieu-bao-cao-dhsxkd').on('click', function() {
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


      // Kế hoạch tuần

      $(".cap-nhat-bao-cao-ke-hoach-tuan").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var daChotSoLieu={{$daChotSoLieu}};
            if(daChotSoLieu>0){
              errorLoader(".error-mode","Đã chốt số liệu không thể chỉnh sửa");
              return false;
            }
            var form=jQuery(this).parents('form');
            var _token=form.find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();

            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('don-vi-truc-thuoc-khac-cap-nhat-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            return false;
          }
      });

      jQuery('.btn-xoa-bao-cao-ke-hoach-tuan').on('click',function(){  
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
          var id=jQuery(this).attr("data"); // lấy id
          var idTuan=jQuery('#id_tuan').val(); 
          xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop');
        });

      jQuery('.is-group-ke-hoach-tuan').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      

      $(".noi-dung-bao-cao-ke-hoach-tuan").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();
            var form=jQuery(this).parents('form');
            form.find('.input-id-tuan').val(idTuan);
            var idDichVu=jQuery('#id-dich-vu').val();
            jQuery('.input-id-dich-vu').val(idDichVu);
            
            themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            e.preventDefault();
            return false;
          }
      });

      $('.btn-xuat-bao-cao').on('click',function(){
          var idTuan=jQuery('#id_tuan').val();
          var url="{{ route('don-vi-truc-thuoc-khac-xuat-bao-cao') }}"+"?tuan="+idTuan;
          var popup = window.open(url, 'Xuất báo cáo', '_blank ');
          if (popup == null)
             alert('Vui lòng cài đặt đồng ý cho tôi mở Popup.');
          else  {
            popup.moveTo(0, 0);
            popup.resizeTo(screen.width, screen.height);
          }
          return false;
      });





    });
</script>



