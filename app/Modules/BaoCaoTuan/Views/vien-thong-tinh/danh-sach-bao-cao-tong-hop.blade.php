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
        @if ($trangThaiChotBaoCao==0)
          @php echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-danger font-weight-bold'>Chưa gửi báo cáo</span>"; @endphp
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
        @if ($trangThaiChotBaoCao==0)
          @php echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-danger font-weight-bold'>Chưa gửi báo cáo</span>"; @endphp
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
      $sttHuyen=2;
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
          @if ($huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']==0)
            @php echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-danger font-weight-bold'>Chưa gửi báo cáo</span>"; @endphp
          @elseif($trangThaiChotBaoCao>0 && $huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']<2)
            @php 
              $thoiGianChotSoLieuDonViCon = strtotime($huyen['thong_tin_don_vi']['thoi_gian_chot_so_lieu']);
              $thoiGianChotSoLieuDonViCon = date('d/m/Y H:i:s',$thoiGianChotSoLieuDonViCon);
              echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-danger font-weight-bold'>".$thoiGianChotSoLieuDonViCon."</span>"; @endphp
          @else
            @php 
              $thoiGianChotSoLieuDonViCon = strtotime($huyen['thong_tin_don_vi']['thoi_gian_chot_so_lieu']);
              $thoiGianChotSoLieuDonViCon = date('d/m/Y H:i:s',$thoiGianChotSoLieuDonViCon);
              echo "<span class='label-danger font-weight-bold' style='margin-left:30px;'>* Trạng thái: </span> <span class='text-success font-weight-bold'>".$thoiGianChotSoLieuDonViCon."</span>"; @endphp
          @endif
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

            @if (isset($huyen['phat_trien_moi']) && count($huyen['phat_trien_moi'])>0)  
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


            @if (isset($huyen['xu_ly_suy_hao']) && count($huyen['xu_ly_suy_hao'])>0)
              <div class="font-weight-bold" style="margin-left: 40px; font-size: 14px;"><i class='fa fa-minus' style="margin-right: 10px;"></i> Xử lý sự cố</div>
                
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
        <button type="button" class="btn btn-vnpt mr-2"><i class="fa fa-file-word-o"></i> Xuất báo cáo</button>
        <button type="button" class="btn btn-vnpt mr-2"  data-toggle="tooltip" data-placement="bottom" title="Basic tooltip"><i class="fa fa-print"></i> In báo cáo</button>
        <button type="button" class="btn btn-danger mr-2 btn-gui-nhac-nho-qua-telegram"><i class="fa fa-send"></i> Gửi thông báo nhắc nhở (Qua Telegram)</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
    var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
    jQuery('.btn-gui-nhac-nho-qua-telegram').on('click',function(){
      var idTuan=jQuery('#id_tuan').val();
      postAndNotRefreshById(_token, idTuan, "{{ route('vien-thong-tinh-gui-thong-bao-nhac-nho-qua-telegram') }}", true);
      return false;
    });
  });
</script>