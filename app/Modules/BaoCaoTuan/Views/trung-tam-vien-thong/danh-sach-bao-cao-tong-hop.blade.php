<style type="text/css">
  ul {
    list-style: none; /* Remove HTML bullets */
    padding: 0;
    margin: 0;
  }
</style>
@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
  $daVuotThoiGianBaoCao=Helper::kiemTraVuotNgayChotSoLieu($idTuan);

  $tuNgay = strtotime($dmTuan['tu_ngay']);
  $tuNgay = date('d/m/Y',$tuNgay);
  $denNgay = strtotime($dmTuan['den_ngay']);
  $denNgay = date('d/m/Y',$denNgay);
  $laTaiKhoanLanhDao=\Helper::kiemTraTaiKhoanThuocNhomChucVu($userId, 'LANH_DAO');
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
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">1. Báo cáo tuần
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-plus-circle text-primary cusor click-view-form" data-click-view-form="#frm-bao-cao-tuan-hien-tai-2"></i>
          </i>
        @endif
      </div>
      <form class="forms-sample frm-bao-cao-tuan-hien-tai d-none" id="frm-bao-cao-tuan-hien-tai-2" name="frm-bao-cao-tuan-hien-tai-2">
        {{ csrf_field() }}
        <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <input type="Text" class="form-control noi-dung-bao-cao-tuan-hien-tai" placeholder="Nội dung báo cáo tuần này" name="noi_dung" style="margin-left: 20px;">
            </div>
          </div>
        </div>
      </form>
      <ul class="">
        @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
          <li  class='hover-view-form dbclick-view-form cusor 
            @if ($baoCaoTuanHienTai['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoTuanHienTai['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
            ' data-hover-view-form=".list-menu-nhanh" data-dbclick-view-form="#frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}">

            @php
              if($baoCaoTuanHienTai['is_group']==2){
                echo "<div class='th-is-group-2'><i class='fa fa-minus'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
              elseif($baoCaoTuanHienTai['is_group']==1){
                echo "<div class='th-is-group-1'><i class='plus-sign'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
              else{
                echo "<div class='th-is-group-0'><i class='white-circle'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
            @endphp


            @if ($daChotSoLieu==0)
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

        <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 35px; font-size: 14px;"><i class="fa fa-minus" style="margin-right: 10px;"></i> Xử lý PAKN
          @if ($daChotSoLieu==0)
            <i class="list-menu-nhanh d-none">
              <i class="fa fa-refresh text-primary cusor btn-lay-so-lieu-bao-cao-dhsxkd"></i>
            </i>
          @endif
        </div>
          
          @if (count($baoCaoPakns)>0)
            <div style="margin-left: 40px; margin-bottom: 30px;  font-size: 14px;">
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



      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px; font-size: 14px;">2. Kế hoạch tuần tiếp theo
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-plus-circle text-primary cusor click-view-form" data-click-view-form="#frm-bao-cao-ke-hoach-tuan-2"></i>
          </i>
        @endif
      </div>
      <form class="forms-sample frm-bao-cao-ke-hoach-tuan-2 d-none" id="frm-bao-cao-ke-hoach-tuan-2" name="frm-bao-cao-ke-hoach-tuan-2">
        {{ csrf_field() }}
        <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <input type="Text" class="form-control noi-dung-bao-cao-ke-hoach-tuan" name="noi_dung" placeholder="Nội dung kế hoạch tuần kế tiếp">
            </div>
          </div>
        </div>
      </form>
      <ul class="">
        @foreach ($baoCaoKeHoachTuans as $baoCaoKeHoachTuan)
          <li  class='hover-view-form dbclick-view-form cusor
              @if ($baoCaoKeHoachTuan['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoKeHoachTuan['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
              ' data-hover-view-form=".list-menu-nhanh" data-dbclick-view-form="#frm-cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}">
            @php
              if($baoCaoKeHoachTuan['is_group']==2){
                echo "<div class='th-is-group-2'><i class='fa fa-minus'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
              elseif($baoCaoKeHoachTuan['is_group']==1){
                echo "<div class='th-is-group-1'><i class='plus-sign'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
              else{
                echo "<div class='th-is-group-0'><i class='white-circle'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
            @endphp


            @if ($daChotSoLieu==0)
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




  @php
    $sttHuyen=2;
  @endphp
  @foreach ($tongHopBaoCaoCapHuyens as $huyen)
    @php
      $sttHuyen++;
    @endphp
    <div class="row">
      <div class="col-12">
        <div class="font-weight-bold text-danger" style="margin-left: 20px;  font-size: 14px;">
          {{$sttHuyen}}. {{$huyen['thong_tin_don_vi']['ten_don_vi']}}
          
        </div>
        @if ($huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']==0)
          @php echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-danger font-weight-bold'>Chưa gửi dữ liệu báo cáo</span>"; @endphp
        @elseif($trangThaiChotBaoCao>0 && $huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']<2)
          @php echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-danger font-weight-bold'>Gửi báo cáo sau khi đơn vị tuyến trên duyệt & chốt báo cáo</span>"; @endphp
        @else
          @php echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-success font-weight-bold'>Đã báo cáo</span>"; @endphp
        @endif
        @if ($trangThaiChotBaoCao==0 || ($huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']>1 && $trangThaiChotBaoCao>0))
          @if (isset($huyen['tuan_hien_tai']))            
            <div class="font-weight-bold" style="margin-left: 30px;  font-size: 14px;">* Báo cáo tuần</div>
            <ul class="">
              @foreach ($huyen['tuan_hien_tai'] as $baoCaoTuanHienTai)
                <li  class=' 
                @if ($baoCaoTuanHienTai['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoTuanHienTai['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
                '>

                @php
                  if($baoCaoTuanHienTai['is_group']==2){
                    echo "<div class='th-is-group-2'><i class='fa fa-minus'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
                  }
                  elseif($baoCaoTuanHienTai['is_group']==1){
                    echo "<div class='th-is-group-1'><i class='plus-sign'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
                  }
                  else{
                    echo "<div class='th-is-group-0'><i class='white-circle'></i>".$baoCaoTuanHienTai['noi_dung']."</div>";
                  }
                @endphp

              </li>
              @endforeach
            </ul>
          @endif

          @if (isset($huyen['phat_trien_moi']))          
            <div class="font-weight-bold" style="margin-left: 40px; font-size: 14px;"><i class='fa fa-minus' style=" font-size: 14px; margin-right: 10px;"></i> Phát triển mới</div>
              <div style="margin-left: 40px; font-size: 14px;">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr class="background-vnpt">
                      @foreach ($huyen['phat_trien_moi'] as $ptm)
                        <th class="text-center"  scope="col">
                          @if ($ptm['mo_ta'])
                            {{$ptm['mo_ta']}}
                          @else
                            {{$ptm['chi_so']}}
                          @endif
                        </th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @foreach ($huyen['phat_trien_moi'] as $ptm)
                        <th class="text-center">
                          {{$ptm['gia_tri']}}
                          @if ($ptm['ghi_chu'])
                            &nbsp;({{$ptm['ghi_chu']}})
                          @endif
                        </th>
                      @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
            @endif

            @if (isset($huyen['xu_ly_suy_hao']))
            <div class="font-weight-bold" style="margin-left: 40px; font-size: 14px;"><i class='fa fa-minus' style="margin-right: 10px;"></i> Xử lý sự cố</div>
              @if (count($huyen['xu_ly_suy_hao'])>0)
                <div style="margin-left: 40px; margin-bottom: 30px; font-size: 14px;">
                  <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered">
                    <thead>
                        <tr class="background-vnpt text-center">
                          <th style="width: 10%;">STT #</th>
                          <th style="width: 30;">Cán bộ xử lý</th>
                          <th style="width: 10%;">Suy hao</th>
                          <th style="width: 10%;">Xử lý</th>
                          <th style="width: 15%;">Còn lại</th>
                          <th style="width: 10%;">(+)/(-)</th>
                          <th style="width: 15%;">
                            Nguyên nhân
                          </th>
                        </tr>
                    </thead>
                    <tbody>    
                        @php $stt=0; @endphp
                        @foreach ($huyen['xu_ly_suy_hao'] as $xlsc)
                          @php $stt++; @endphp
                          <tr class="tr-hover tr-small">
                            <td class="text-center">{{$stt}}</td>
                            <td class='text-primary @if($xlsc['is_group']==1) {{" font-weight-bold"}} @endif'>
                              @if ($xlsc['mo_ta'])
                                {{$xlsc['mo_ta']}}
                              @else
                                {{$xlsc['chi_so']}}
                              @endif
                            </td>
                            <td>
                              {{$xlsc['suy_hao']}}
                            </td>
                            <td>
                              {{$xlsc['gia_tri']}}
                            </td>
                            <td>
                              {{$xlsc['suy_hao_con_lai']}}
                            </td>
                            <td>
                              @php
                                $sh=0;
                                if($xlsc['gia_tri']==0 || $xlsc['gia_tri']=='' || $xlsc['gia_tri']==null){
                                  $sh=$xlsc['suy_hao_con_lai']-$xlsc['suy_hao'];
                                }
                                if($sh>0){
                                  echo '+'.$sh;
                                }
                                if($sh<0){
                                  echo $sh;
                                }
                              @endphp
                            </td>
                            <td class="text-center">
                              {{$xlsc['ghi_chu']}}
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            @endif

            @if (isset($huyen['ke_hoach_tuan']))
              <div class="font-weight-bold" style="margin-left: 30px;  font-size: 14px;">* Kế hoạch tuần tiếp theo</div>
              <ul class="">
                @foreach ($huyen['ke_hoach_tuan'] as $baoCaoKeHoachTuan)
                  <li  class='
                      @if ($baoCaoKeHoachTuan['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoKeHoachTuan['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
                      '>
                    @php
                      if($baoCaoKeHoachTuan['is_group']==2){
                        echo "<div class='th-is-group-2'><i class='fa fa-minus'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
                      }
                      elseif($baoCaoKeHoachTuan['is_group']==1){
                        echo "<div class='th-is-group-1'><i class='plus-sign'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
                      }
                      else{
                        echo "<div class='th-is-group-0'><i class='white-circle'></i>".$baoCaoKeHoachTuan['noi_dung']."</div>";
                      }
                    @endphp
                  </li>
                @endforeach
              </ul>
            @endif
        @endif
      </div>
    </div>
  @endforeach


  <div class="row">
    <div class="col-12">
      <br>
      <div class="form-group mt-5 text-right" style="margin-bottom: 0px;  font-size: 14px;">
        <button type="button" class="btn btn-vnpt mr-2"><i class="fa fa-file-word-o"></i> Xuất báo cáo</button>
        <button type="button" class="btn btn-vnpt mr-2"  data-toggle="tooltip" data-placement="bottom" title="Basic tooltip"><i class="fa fa-print"></i> In báo cáo</button>
        @if ($laTaiKhoanLanhDao==1)
          <button type="button" class="btn btn-danger mr-2 btn-chot-va-gui-bao-cao @if ($daChotSoLieu>0) disabled @endif" @if ($daChotSoLieu>0) disabled="disabled" @endif><i class="fa fa-send"></i> Duyệt & Gửi báo cáo</button>
        @endif
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="{{ asset('public/js/view-form.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.btn-chot-va-gui-bao-cao').on('click',function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val(); 
        var idTuan=jQuery('#id_tuan').val();
        postAndRefreshById(_token, idTuan, "{{ route('trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',true);
      });

      jQuery('.cap-nhat-bao-cao-tuan-hien-tai').on("keypress", function(e) {
        if (e.keyCode == 13) {
          var daChotSoLieu={{$daChotSoLieu}};
          if(daChotSoLieu>0){
            errorLoader(".error-mode","Đã chốt số liệu không thể chỉnh sửa");
            return false;
          }
          var form=jQuery(this).parents('form');
          var _token=form.find("input[name='_token']").val();
          var idTuan=jQuery('#id_tuan').val();
          capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('trung-tam-vien-thong-cap-nhat-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
          return false;
          
        }
      });

      jQuery('.btn-xoa-bao-cao-tuan-hien-tai').on('click',function(){  
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var id=jQuery(this).attr("data"); // lấy id
        var idTuan=jQuery('#id_tuan').val(); 
        xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      jQuery('.is-group').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('trung-tam-vien-thong-bc-is-group-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      jQuery('.noi-dung-bao-cao-tuan-hien-tai').on("keypress", function(e) {
        if (e.keyCode == 13) {
          
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
          var idTuan=jQuery('#id_tuan').val();
          var form=jQuery(this).parents('form');
          form.find('.input-id-tuan').val(idTuan);
          themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('trung-tam-vien-thong-them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
          jQuery('#frm-bao-cao-tuan-hien-tai-2').addClass('d-none');
          e.preventDefault();
          return false;
        }

      });

      jQuery('.btn-lay-so-lieu-bao-cao-dhsxkd').on('click', function() {
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, idTuan, "{{ route('trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


      // Kế hoạch tuần
      jQuery('.cap-nhat-bao-cao-ke-hoach-tuan').on("keypress", function(e) {
        if (e.keyCode == 13) {
          var daChotSoLieu={{$daChotSoLieu}};
          if(daChotSoLieu>0){
            errorLoader(".error-mode","Đã chốt số liệu không thể chỉnh sửa");
            return false;
          }
          var form=jQuery(this).parents('form');
          var _token=form.find("input[name='_token']").val();
          var idTuan=jQuery('#id_tuan').val();
          capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('trung-tam-vien-thong-cap-nhat-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
          return false;
          
        }


      });

      jQuery('.btn-xoa-bao-cao-ke-hoach-tuan').on('click',function(){  
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
          var id=jQuery(this).attr("data"); // lấy id
          var idTuan=jQuery('#id_tuan').val(); 
          xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop');
        });

      jQuery('.is-group-ke-hoach-tuan').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('trung-tam-vien-thong-bc-is-group-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      jQuery('.noi-dung-bao-cao-ke-hoach-tuan').on("keypress", function(e) {
        if (e.keyCode == 13) {
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
          var idTuan=jQuery('#id_tuan').val();
          var form=jQuery(this).parents('form');
          form.find('.input-id-tuan').val(idTuan);
          themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
          e.preventDefault();
          return false;
        }
      });





    });
</script>



