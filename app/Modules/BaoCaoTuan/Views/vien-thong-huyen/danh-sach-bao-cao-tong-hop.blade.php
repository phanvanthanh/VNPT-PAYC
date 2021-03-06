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
  $tatCaTaiKhoanDuocXemTrangThaiBaoCao=Helper::getValueThamSoTheoMa('SHOW_TRANG_THAI_BAO_CAO_CHO_TAT_CA_TK');
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
      @php
        $trangThai=Helper::trangThaiBaoCao($dmTuan['id'], $donVi['ma_don_vi'], $donVi['ma_dinh_danh']);
        if($tatCaTaiKhoanDuocXemTrangThaiBaoCao==1 || $laTaiKhoanLanhDao==1){
          echo $trangThai;
        }
      @endphp
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">I. Báo cáo kết quả công tác tuần qua:
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-plus-circle text-primary cusor click-view-form" data-click-view-form="#frm-bao-cao-tuan-hien-tai-2"></i>
          </i>
        @endif
      </div>
      <form class="forms-sample frm-bao-cao-tuan-hien-tai d-none" id="frm-bao-cao-tuan-hien-tai-2" name="frm-bao-cao-tuan-hien-tai-2"  action="javascript:void(0)">
        {{ csrf_field() }}
        <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <input type="Text" class="form-control noi-dung-bao-cao-tuan-hien-tai-2" placeholder="Nội dung báo cáo tuần này" name="noi_dung" style="margin-left: 30px;">
            </div>
          </div>
        </div>
      </form>
      <ul class="">
        @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
          <li  class='hover-view-form dbclick-view-form cusor 
            @if ($baoCaoTuanHienTai['is_group']==3) {{"li-is-group-3"}} @elseif ($baoCaoTuanHienTai['is_group']==2) {{"li-is-group-2"}} @elseif($baoCaoTuanHienTai['is_group']==1) {{"li-is-group-1"}} @else {{"li-is-group-0"}} @endif
            '
             data-hover-view-form=".list-menu-nhanh" data-dbclick-view-form="#frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}">
            @php
              if($baoCaoTuanHienTai['is_group']==3){
                $checkCoNhapBaoCaoTuanHienTai=Helper::kiemTraCoNhapBaoCaoTuanHienTai($baoCaoTuanHienTai['id_tuan'], $baoCaoTuanHienTai['id_dich_vu']);
                if($checkCoNhapBaoCaoTuanHienTai===1){
                  $sttPhanMem++;
                  echo "<div class='th-is-group-3'>".$sttPhanMem.'. '.$baoCaoTuanHienTai['noi_dung']."</div>";
                }
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


            @if ($daChotSoLieu==0)
                <i class="list-menu-nhanh d-none">
                  &nbsp;&nbsp;&nbsp;
                  <i class="fa fa-long-arrow-up text-success cusor btn-tuan-hien-tai-di-chuyen-len-2" data="{{$baoCaoTuanHienTai['id']}}" data-toggle="tooltip" data-placement="bottom" title="Di chuyển lên"></i>&nbsp;
                  <i class="fa fa-long-arrow-down text-danger cusor btn-tuan-hien-tai-di-chuyen-xuong-2" data="{{$baoCaoTuanHienTai['id']}}" data-toggle="tooltip" data-placement="bottom" title="Di chuyển xuống"></i> &nbsp;&nbsp;&nbsp;
                  <i class="is-group fa fa-th-list cusor i-hover @if($baoCaoTuanHienTai['is_group']==2) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoTuanHienTai['id']}}_2"></i> &nbsp;&nbsp;&nbsp;                
                  <i class="is-group fa fa-list-ul cusor i-hover @if($baoCaoTuanHienTai['is_group']==1) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoTuanHienTai['id']}}_1"></i> &nbsp;&nbsp;&nbsp;
                  <i class="is-group fa fa fa-indent cusor i-hover @if($baoCaoTuanHienTai['is_group']==0) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoTuanHienTai['id']}}_0"></i> &nbsp;&nbsp;&nbsp;
                  <i class="fa fa-times-rectangle-o text-danger cusor btn-xoa-bao-cao-tuan-hien-tai" data="{{$baoCaoTuanHienTai['id']}}"></i>
                </i>
            @endif

          </li>
          <form class="forms-sample frm-cap-nhat-bao-cao-tuan-hien-tai d-none" id="frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}" name="frm-cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}" action="javascript:void(0)">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$baoCaoTuanHienTai['id']}}">
            <input @if ($baoCaoTuanHienTai['is_group']==1) style='margin-left: 20px;' @else style='margin-left: 20px;' @endif type="text" name="noi_dung" class="form-control cap-nhat-bao-cao-tuan-hien-tai" data="{{$baoCaoTuanHienTai['id']}}" value="{{$baoCaoTuanHienTai['noi_dung']}}" id="cap-nhat-bao-cao-tuan-hien-tai-{{$baoCaoTuanHienTai['id']}}">
          </form>
        @endforeach
      </ul>
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">Báo cáo số liệu ĐHSXKD
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-refresh text-primary cusor btn-lay-so-lieu-bao-cao-dhsxkd"></i>
          </i>
        @endif
      </div>

      @if(($baoCaoPhatTrienMois && count($baoCaoPhatTrienMois)>0) || ($baoCaoGoiHomes && count($baoCaoGoiHomes)>0))
        <div style="margin-left: 40px; margin-bottom: 30px;">
          <div class="font-weight-bold" style="margin-left: -10px;">* Phát triển mới</div>
          <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-dhsxkd-phat-trien-moi table-bordered">
            <thead>
                <tr class="background-vnpt text-center">
                    <th style="width: 5%;">STT</th>
                    <th style="width: 20;">Tên dịch vụ</th>
                    <th style="width: 10%;">Số lượng</th>
                    <th style="width: 65%;">
                      Ghi chú
                    </th>
                </tr>
            </thead>
            <tbody>    
                @if($baoCaoPhatTrienMois && count($baoCaoPhatTrienMois)>0)
                  <tr class="active font-weight-bold tr-small">
                    <td colspan="4">&nbsp;Phát triển mới</td>
                  </tr>
                  @php $stt=0; @endphp
                  @foreach ($baoCaoPhatTrienMois as $ptm)
                    @php $stt++; @endphp
                    <tr class="tr-hover tr-small">
                      <td class="text-center">{{$stt}}</td>
                      <td class='text-primary @if($ptm['is_group']==1) {{" font-weight-bold"}} @endif'>
                        @if ($ptm['mo_ta'])
                          {{$ptm['mo_ta']}}
                        @else
                          {{$ptm['chi_so']}}
                        @endif
                      </td>
                      <td class="text-center">
                        {{$ptm['gia_tri']}}
                      </td>
                      <td class="text-center">
                        {{$ptm['ghi_chu']}}
                      </td>
                    </tr>
                  @endforeach
                @endif

                @if($baoCaoGoiHomes && count($baoCaoGoiHomes)>0)
                  <tr class="active font-weight-bold tr-small">
                    <td colspan="4">&nbsp;Gói home</td>
                  </tr>
                  @php $stt=0; @endphp
                  @foreach ($baoCaoGoiHomes as $ptm)
                    @php $stt++; @endphp
                    <tr class="tr-hover tr-small">
                      <td class="text-center">{{$stt}}</td>
                      <td class='text-primary @if($ptm['is_group']==1) {{" font-weight-bold"}} @endif'>
                        @if ($ptm['mo_ta'])
                          {{$ptm['mo_ta']}}
                        @else
                          {{$ptm['chi_so']}}
                        @endif
                      </td>
                      <td class="text-center">
                        {{$ptm['gia_tri']}}
                      </td>
                      <td class="text-center">
                        {{$ptm['ghi_chu']}}
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        @endif

        {{-- @if($baoCaoPhatTrienMois && count($baoCaoPhatTrienMois)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Phát triển mới</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($baoCaoPhatTrienMois as $ptm)
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
                <tr class="tr-small">
                  @foreach ($baoCaoPhatTrienMois as $ptm)
                    <th class="text-center cusor xem-ghi-chu" data-toggle="modal" data-target="#modal-xem-ghi-chu" title="{{$ptm['ghi_chu']}}">
                      {{$ptm['gia_tri']}}
                      @if ($ptm['ghi_chu'])
                        &nbsp;<i class="fa fa-eye text-danger cusor" data-toggle="tooltip" data-placement="bottom" title="{{$ptm['ghi_chu']}}"></i>
                      @endif
                    </th>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        @endif

        @if($baoCaoGoiHomes && count($baoCaoGoiHomes)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Gói home</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($baoCaoGoiHomes as $ptm)
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
                <tr class="tr-small">
                  @foreach ($baoCaoGoiHomes as $ptm)
                    <th class="text-center cusor xem-ghi-chu" data-toggle="modal" data-target="#modal-xem-ghi-chu" title="{{$ptm['ghi_chu']}}">
                      {{$ptm['gia_tri']}}
                      @if ($ptm['ghi_chu'])
                        &nbsp;<i class="fa fa-eye text-danger cusor" data-toggle="tooltip" data-placement="bottom" title="{{$ptm['ghi_chu']}}"></i>
                      @endif
                    </th>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        @endif --}}

        @if($baoCaoXuLyDungHans && count($baoCaoXuLyDungHans)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Lắp đặt sửa chữa xử lý đúng hạn</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($baoCaoXuLyDungHans as $ptm)
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
                <tr class="tr-small">
                  @foreach ($baoCaoXuLyDungHans as $ptm)
                    <th class="text-center cusor xem-ghi-chu" data-toggle="modal" data-target="#modal-xem-ghi-chu" title="{{$ptm['ghi_chu']}}">
                      {{$ptm['gia_tri']}}
                      @if ($ptm['ghi_chu'])
                        &nbsp;<i class="fa fa-eye text-danger cusor" data-toggle="tooltip" data-placement="bottom" title="{{$ptm['ghi_chu']}}"></i>
                      @endif
                    </th>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        @endif

        @if($baoCaoMLLs && count($baoCaoMLLs)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Mất liên lạc</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($baoCaoMLLs as $ptm)
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
                <tr class="tr-small">
                  @foreach ($baoCaoMLLs as $ptm)
                    <th class="text-center cusor xem-ghi-chu" data-toggle="modal" data-target="#modal-xem-ghi-chu" title="{{$ptm['ghi_chu']}}">
                      {{$ptm['gia_tri']}}
                      @if ($ptm['ghi_chu'])
                        &nbsp;<i class="fa fa-eye text-danger cusor" data-toggle="tooltip" data-placement="bottom" title="{{$ptm['ghi_chu']}}"></i>
                      @endif
                    </th>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        @endif

        @if($baoCaoB2As && count($baoCaoB2As)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Số liệu B2A</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($baoCaoB2As as $ptm)
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
                <tr class="tr-small">
                  @foreach ($baoCaoB2As as $ptm)
                    <th class="text-center cusor xem-ghi-chu" data-toggle="modal" data-target="#modal-xem-ghi-chu" title="{{$ptm['ghi_chu']}}">
                      {{$ptm['gia_tri']}}
                      @if ($ptm['ghi_chu'])
                        &nbsp;<i class="fa fa-eye text-danger cusor" data-toggle="tooltip" data-placement="bottom" title="{{$ptm['ghi_chu']}}"></i>
                      @endif
                    </th>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        @endif

        
        @if($baoCaoDoHaiLongs && count($baoCaoDoHaiLongs)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Đánh giá độ hài lòng</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($baoCaoDoHaiLongs as $ptm)
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
                <tr class="tr-small">
                  @foreach ($baoCaoDoHaiLongs as $ptm)
                    <th class="text-center cusor xem-ghi-chu" data-toggle="modal" data-target="#modal-xem-ghi-chu" title="{{$ptm['ghi_chu']}}">
                      {{$ptm['gia_tri']}}
                      @if ($ptm['ghi_chu'])
                        &nbsp;<i class="fa fa-eye text-danger cusor" data-toggle="tooltip" data-placement="bottom" title="{{$ptm['ghi_chu']}}"></i>
                      @endif
                    </th>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        @endif

        
        @if($baoCaoXuLySuyHaos && count($baoCaoXuLySuyHaos)>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Xử lý sự cố</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                  <tr class="background-vnpt text-center">
                    <th style="width: 5%;">STT #</th>
                    <th style="width: 15;">Cán bộ xử lý</th>
                    <th style="width: 10%;">Suy hao</th>
                    <th style="width: 10%;">Xử lý</th>
                    <th style="width: 10%;">Còn lại</th>
                    <th style="width: 10%;">(+)/(-)</th>
                    <th style="width: 40%;">
                      Nguyên nhân
                    </th>
                  </tr>
              </thead>
              <tbody>    
                  @php $stt=0; @endphp
                  @foreach ($baoCaoXuLySuyHaos as $xlsc)
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
                      <td class="text-center">
                        {{$xlsc['suy_hao']}}
                      </td>
                      <td class="text-center">
                        {{$xlsc['gia_tri']}}
                      </td>
                      <td class="text-center">
                        {{$xlsc['suy_hao_con_lai']}}
                      </td>
                      <td class="text-center">
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
          
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">II. Đăng ký công tác tuần tiếp theo:
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-plus-circle text-primary cusor click-view-form" data-click-view-form="#frm-bao-cao-ke-hoach-tuan-2"></i>
          </i>
        @endif
      </div>
      <form class="forms-sample frm-bao-cao-ke-hoach-tuan-2 d-none" id="frm-bao-cao-ke-hoach-tuan-2" name="frm-bao-cao-ke-hoach-tuan-2" action="javascript:void(0)">
        {{ csrf_field() }}
        <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
              <input type="Text" class="form-control noi-dung-bao-cao-ke-hoach-tuan-2" name="noi_dung" placeholder="Nội dung kế hoạch tuần kế tiếp">
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
                  $checkCoNhapKeHoachTuan=Helper::kiemTraCoNhapKeHoachTuan($baoCaoKeHoachTuan['id_tuan'], $baoCaoKeHoachTuan['id_dich_vu']);
                  if($checkCoNhapKeHoachTuan===1){
                    $sttPhanMem++;
                    echo "<div class='th-is-group-3'>".$sttPhanMem.'. '.$baoCaoKeHoachTuan['noi_dung']."</div>";
                  }
                    
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


            @if ($daChotSoLieu==0)
                <i class="list-menu-nhanh d-none">
                   &nbsp;&nbsp;&nbsp;
                  <i class="fa fa-long-arrow-up text-success cusor btn-ke-hoach-tuan-di-chuyen-len-2" data="{{$baoCaoKeHoachTuan['id']}}" data-toggle="tooltip" data-placement="bottom" title="Di chuyển lên"></i>&nbsp;
                  <i class="fa fa-long-arrow-down text-danger cusor btn-ke-hoach-tuan-di-chuyen-xuong-2" data="{{$baoCaoKeHoachTuan['id']}}" data-toggle="tooltip" data-placement="bottom" title="Di chuyển xuống"></i> &nbsp;&nbsp;&nbsp;
                  <i class="is-group-ke-hoach-tuan fa fa-th-list cusor i-hover @if($baoCaoKeHoachTuan['is_group']==2) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoKeHoachTuan['id']}}_2"></i> &nbsp;&nbsp;&nbsp;                
                  <i class="is-group-ke-hoach-tuan fa fa-list-ul cusor i-hover @if($baoCaoKeHoachTuan['is_group']==1) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoKeHoachTuan['id']}}_1"></i> &nbsp;&nbsp;&nbsp;
                  <i class="is-group-ke-hoach-tuan fa fa fa-indent cusor i-hover @if($baoCaoKeHoachTuan['is_group']==0) {{"text-primary font-weight-bold"}} @endif"  data="{{$baoCaoKeHoachTuan['id']}}_0"></i> &nbsp;&nbsp;&nbsp;
                  <i class="fa fa-times-rectangle-o text-danger cusor btn-xoa-bao-cao-ke-hoach-tuan" data="{{$baoCaoKeHoachTuan['id']}}"></i>
                </i>
            @endif
          </li>
          <form class="forms-sample frm-cap-nhat-bao-cao-ke-hoach-tuan d-none" id="frm-cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}" name="cap-nhat-bao-cao-ke-hoach-tuan-{{$baoCaoKeHoachTuan['id']}}" action="javascript:void(0)">
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
        @if ($laTaiKhoanLanhDao==1)
          <button type="button" class="btn btn-danger mr-2 btn-chot-va-gui-bao-cao @if ($daChotSoLieu>0) disabled @endif" @if ($daChotSoLieu>0) disabled="disabled" @endif><i class="fa fa-send"></i> Gửi báo cáo</button>
        @endif
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-xem-ghi-chu" tabindex="-1" role="dialog" aria-labelledby="modal-xem-ghi-chu" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-xem-ghi-chu">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">GHI CHÚ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <div class="show-ghi-chu"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal">Đóng</button>
         </div>
      </div>
   </div>
</div>


@if ($daChotSoLieu==0)
  <script type="text/javascript" src="{{ secure_asset('public/js/view-form.js') }}"></script>
@endif
<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.btn-chot-va-gui-bao-cao').on('click',function(){
        var result = confirm("Bạn thật sự đã hoàn tất báo cáo và muốn gửi báo cáo lên cấp trên?  Nếu đồng ý bạn sẽ không thể chỉnh sửa được nữa.");
        if (result) {
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val(); 
          var idTuan=jQuery('#id_tuan').val();
          postAndRefreshById(_token, idTuan, "{{ route('bao-cao-tuan-vien-thong-huyen-chot-so-lieu') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop', true);
        }
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
            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('cap-nhat-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            return false;
          }
      });

      jQuery('.btn-xoa-bao-cao-tuan-hien-tai').on('click',function(){  
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var id=jQuery(this).attr("data"); // lấy id
        var idTuan=jQuery('#id_tuan').val(); 
        xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('xoa-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      jQuery('.is-group').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('bc-is-group-tuan-hien-tai') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


      $(".noi-dung-bao-cao-tuan-hien-tai-2").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();
            var form=jQuery(this).parents('form');
            form.find('.input-id-tuan').val(idTuan);
            themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            jQuery('#frm-bao-cao-tuan-hien-tai-2').addClass('d-none');
            e.preventDefault();
            return false;
          }
      });

      jQuery('.btn-lay-so-lieu-bao-cao-dhsxkd').on('click', function() {
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, idTuan, "{{ route('vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
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
            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('cap-nhat-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            return false;
          }
      });

      jQuery('.btn-xoa-bao-cao-ke-hoach-tuan').on('click',function(){  
          var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
          var id=jQuery(this).attr("data"); // lấy id
          var idTuan=jQuery('#id_tuan').val(); 
          xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('xoa-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop');
        });

      jQuery('.is-group-ke-hoach-tuan').on("click",function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();   
        var id=jQuery(this).attr('data');
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, id, "{{ route('bc-is-group-ke-hoach-tuan') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


      $(".noi-dung-bao-cao-ke-hoach-tuan-2").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
            var idTuan=jQuery('#id_tuan').val();
            var form=jQuery(this).parents('form');
            form.find('.input-id-tuan').val(idTuan);
            themMoiVaRefreshDuLieuTheoId2(_token, form, "{{ route('them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
            e.preventDefault();
            return false;
          }
      });


      jQuery('.xem-ghi-chu').on('click', function() {
        var title=jQuery(this).attr('title');
        jQuery('.show-ghi-chu').text(title);
      });


      jQuery('.btn-tuan-hien-tai-di-chuyen-len-2').on('click',function(){    
        var id=jQuery(this).attr("data");
        baoCaoTuanHienTaiDiChuyenLen(id);
        return false;
      });

      jQuery('.btn-tuan-hien-tai-di-chuyen-xuong-2').on('click',function(){    
        var id=jQuery(this).attr("data");
        baoCaoTuanHienTaiDiChuyenXuong(id);
        return false;
      });


      jQuery('.btn-ke-hoach-tuan-di-chuyen-len-2').on('click',function(){    
        var id=jQuery(this).attr("data");
        keHoachTuanDiChuyenLen(id);
        return false;
      });

      jQuery('.btn-ke-hoach-tuan-di-chuyen-xuong-2').on('click',function(){    
        var id=jQuery(this).attr("data");
        keHoachTuanDiChuyenXuong(id);
        return false;
      });

      $('.btn-xuat-bao-cao').on('click',function(){
          var idTuan=jQuery('#id_tuan').val();
          var url="{{ route('vien-thong-huyen-xuat-bao-cao') }}"+"?tuan="+idTuan;
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



