<style type="text/css">
  ul {
    list-style: none; /* Remove HTML bullets */
    padding: 0;
    margin: 0;
  }
</style>
@php
  $tuNgay = strtotime($dmTuan['tu_ngay']);
  $tuNgay = date('d/m/Y',$tuNgay);
  $denNgay = strtotime($dmTuan['den_ngay']);
  $denNgay = date('d/m/Y',$denNgay);
  $laTaiKhoanLanhDao=\Helper::kiemTraTaiKhoanThuocNhomChucVu($userId, 'LANH_DAO');
  $checkQuyenXuatBaoCao=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XUAT_BAO_CAO');
@endphp
<div class="noi-dung-bao-cao-tong-hop">
  <div class="row">
    <div class="col-12">
      <h6 class="text-center">
        KẾ HOẠCH TUẦN {{$dmTuan['tuan']}}_{{$dmTuan['nam']}} VNPT. TVH <br>
        (Từ ngày {{$tuNgay}} đến {{$denNgay}})
      </h6>
    </div>
  </div>
  @foreach ($dataPhongBanTrungTams as $dataPhongBanTrungTam)    
    @php
        $donVi=$dataPhongBanTrungTam['donVi'];
        $baoCaoPakns=$dataPhongBanTrungTam['baoCaoPakns'];
        $baoCaoTuanHienTais=$dataPhongBanTrungTam['baoCaoTuanHienTais'];
        $baoCaoKeHoachTuans=$dataPhongBanTrungTam['baoCaoKeHoachTuans'];
        $trangThaiChotBaoCao=$dataPhongBanTrungTam['trangThaiChotBaoCao'];
        $sttPhanMem=0;
    @endphp

    <div class="row">
      <div class="col-12">      
        <h6 class="text-primary">* {{$donVi['ten_don_vi']}}</h6>
        @php
          $trangThai=Helper::trangThaiBaoCao($dmTuan['id'], $donVi['ma_don_vi'], $donVi['ma_dinh_danh']);
          echo $trangThai;
        @endphp
        @if ($trangThaiChotBaoCao==0) 
        @else
        <div class="font-weight-bold" style="margin-left: 20px;">I. Báo cáo kết quả công tác tuần qua:</div>
        <ul class="">
          @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
            <li  class=' 
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
            </li>          
          @endforeach
        </ul>

          
            
            @if (count($baoCaoPakns)>0)
              <div class="font-weight-bold" style="margin-left: 35px; font-size: 14px;"><i class="fa fa-minus" style="margin-right: 10px;"></i> Xử lý PAKN
              </div>
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



        <div class="font-weight-bold" style="margin-left: 20px; font-size: 14px;">II. Đăng ký công tác tuần tiếp theo:
        </div>
        @php
          $sttPhanMem=0;
        @endphp
        <ul class="">
          @foreach ($baoCaoKeHoachTuans as $baoCaoKeHoachTuan)
            <li  class='
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
            </li>         
          @endforeach
        </ul>
        @endif
      </div>
    </div>
  @endforeach
  @foreach ($dataTtvts as $ttvt)    
    @php
        $donVi=$ttvt['donVi'];
        $baoCaoPakns=$ttvt['baoCaoPakns'];
        $baoCaoTuanHienTais=$ttvt['baoCaoTuanHienTais'];
        $baoCaoKeHoachTuans=$ttvt['baoCaoKeHoachTuans'];
        $tongHopBaoCaoCapHuyens=$ttvt['tongHopBaoCaoCapHuyens'];
        $trangThaiChotBaoCao=$ttvt['trangThaiChotBaoCao'];
        
    @endphp

    <div class="row">
      <div class="col-12">      
        <h6 class="text-primary">* {{$donVi['ten_don_vi']}}</h6>
        @php
          $trangThai=Helper::trangThaiBaoCao($dmTuan['id'], $donVi['ma_don_vi'], $donVi['ma_dinh_danh']);
          echo $trangThai;
        @endphp
        @if ($trangThaiChotBaoCao==0)          
        @else
        <div class="font-weight-bold" style="margin-left: 20px;">I. Báo cáo kết quả công tác tuần qua:</div>        
        @php
          $sttPhanMem=0;
        @endphp
        <ul class="">
          @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
            <li  class=' 
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
          @endforeach
        </ul>

          
            
            @if (count($baoCaoPakns)>0)
              <div class="font-weight-bold" style="margin-left: 35px; font-size: 14px;"><i class="fa fa-minus" style="margin-right: 10px;"></i> Xử lý PAKN</div>
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



        <div class="font-weight-bold" style="margin-left: 20px; font-size: 14px;">II. Đăng ký công tác tuần tiếp theo:
        </div>
        @php
          $sttPhanMem=0;
        @endphp
        <ul class="">
          @foreach ($baoCaoKeHoachTuans as $baoCaoKeHoachTuan)
            <li  class='
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
            </li>         
          @endforeach
        </ul>
        @endif
      </div>
    </div>




    @php
      $sttHuyen=0;
    @endphp
    @foreach ($tongHopBaoCaoCapHuyens as $huyen)
      @php
        $sttHuyen++;
      @endphp
      <div class="row">
        <div class="col-12">
          <div class="font-weight-bold text-primary" style="margin-left: 20px;  font-size: 14px;">
            {{$sttHuyen}}. {{$huyen['thong_tin_don_vi']['ten_don_vi']}}
            
          </div>
          @php
            $trangThai=Helper::trangThaiBaoCao($dmTuan['id'], $huyen['thong_tin_don_vi']['ma_don_vi'], $huyen['thong_tin_don_vi']['ma_dinh_danh']);
            echo $trangThai;
          @endphp
          @if ($huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']>1 && $trangThaiChotBaoCao>0)
            @if (isset($huyen['tuan_hien_tai']))
              <div class="font-weight-bold" style="margin-left: 20px;">I. Báo cáo kết quả công tác tuần qua:</div>        
              @php
                $sttPhanMem=0;
              @endphp
              <ul class=""> 
                @foreach ($huyen['tuan_hien_tai'] as $baoCaoTuanHienTai)
                  <li  class=' 
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
                </li>
                @endforeach              
              </ul>
            @endif

            @if((isset($huyen['phat_trien_moi']) && count($huyen['phat_trien_moi'])>0) || (isset($huyen['goi_home']) && count($huyen['goi_home'])>0))
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
                    @if($huyen['phat_trien_moi'] && count($huyen['phat_trien_moi'])>0)
                      <tr class="active font-weight-bold tr-small">
                        <td colspan="4">&nbsp;Phát triển mới</td>
                      </tr>
                      @php $stt=0; @endphp
                      @foreach ($huyen['phat_trien_moi'] as $ptm)
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

                    @if($huyen['goi_home'] && count($huyen['goi_home'])>0)
                      <tr class="active font-weight-bold tr-small">
                        <td colspan="4">&nbsp;Gói home</td>
                      </tr>
                      @php $stt=0; @endphp
                      @foreach ($huyen['goi_home'] as $ptm)
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

        @if(isset($huyen['xu_ly_dung_han']) && count($huyen['xu_ly_dung_han'])>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Lắp đặt sửa chữa xử lý đúng hạn</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($huyen['xu_ly_dung_han'] as $ptm)
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
                  @foreach ($huyen['xu_ly_dung_han'] as $ptm)
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

        @if(isset($huyen['mll']) && count($huyen['mll'])>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Mất liên lạc</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($huyen['mll'] as $ptm)
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
                  @foreach ($huyen['mll'] as $ptm)
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

        @if(isset($huyen['b2a']) && count($huyen['b2a'])>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Số liệu B2A</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($huyen['b2a'] as $ptm)
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
                  @foreach ($huyen['b2a'] as $ptm)
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

        
        @if(isset($huyen['hai_long']) && count($huyen['hai_long'])>0)
          <div class="font-weight-bold" style="margin-left: 30px;">* Đánh giá độ hài lòng</div>
          <div style="margin-left: 40px; margin-bottom: 30px;">
            <table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-bordered table-dhsxkd-phat-trien-moi">
              <thead>
                <tr class="background-vnpt tr-small">
                  @foreach ($huyen['hai_long'] as $ptm)
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
                  @foreach ($huyen['hai_long'] as $ptm)
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




























          @if(isset($huyen['xu_ly_suy_hao']) && count($huyen['xu_ly_suy_hao'])>0)
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

              @if (isset($huyen['ke_hoach_tuan']))
                <div class="font-weight-bold" style="margin-left: 20px; font-size: 14px;">II. Đăng ký công tác tuần tiếp theo:
                </div>
                @php
                  $sttPhanMem=0;
                @endphp
                <ul class="">
                  @foreach ($huyen['ke_hoach_tuan'] as $baoCaoKeHoachTuan)
                    <li  class='
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
                    </li>
                  @endforeach                  
                </ul>
              @endif
          @endif
        </div>
      </div>
    @endforeach

  @endforeach

  <div class="row">
    <div class="col-12">
      <br>
      <div class="form-group mt-5 text-right" style="margin-bottom: 0px;  font-size: 14px;">
        @if ($checkQuyenXuatBaoCao==1)
          <button type="button" class="btn btn-vnpt mr-2 btn-xuat-bao-cao"><i class="fa fa-upload"></i> Xuất báo cáo</button>
        @endif
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
    $('.btn-xuat-bao-cao').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        var url="{{ route('vien-thong-tinh-xuat-bao-cao') }}"+"?tuan="+idTuan;
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