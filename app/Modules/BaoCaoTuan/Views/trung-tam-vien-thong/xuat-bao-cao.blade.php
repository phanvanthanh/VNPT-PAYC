@extends('layouts.script-layout')
@section('title', 'Tổ kỹ thuật')
<link rel="shortcut icon" href="{{ secure_asset('public/images/favicon.ico') }}">

@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
  $daVuotThoiGianBaoCao=Helper::kiemTraVuotNgayChotSoLieu($idTuan);

  $tuNgay = strtotime($dmTuan['tu_ngay']);
  $tuNgay = date('d/m/Y',$tuNgay);
  $denNgay = strtotime($dmTuan['den_ngay']);
  $denNgay = date('d/m/Y',$denNgay);
  $laTaiKhoanLanhDao=\Helper::kiemTraTaiKhoanThuocNhomChucVu($userId, 'LANH_DAO');
  $tatCaTaiKhoanDuocXemTrangThaiBaoCao=Helper::getValueThamSoTheoMa('SHOW_TRANG_THAI_BAO_CAO_CHO_TAT_CA_TK');
    $checkQuyenXuatWord=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XUAT_BAO_CAO_SANG_WORD');
  $checkQuyenInBaoCao=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'IN_BAO_CAO');
@endphp
<style type="text/css">
  *{
    font-family: "Times New Roman", Times, serif;    
  }
  div{
    margin-top: 10px;
  }
</style>
<div class="noi-dung-bao-cao-tong-hop">
  <div class="col-12">
      <div style="text-align: center; font-size: 18.5px; font-weight: bold; margin-top:2; line-height: 2;">
        KẾ HOẠCH TUẦN {{$dmTuan['tuan']}}_{{$dmTuan['nam']}} VNPT. TVH <br>
        (Từ ngày {{$tuNgay}} đến {{$denNgay}})
      </div>
      <div style="font-size:17px; color: red; font-weight: bold; margin-top:2; line-height: 2;">* {{$donVi['ten_don_vi']}}</div>
      <div style="margin-left: 20px; font-weight: bold; margin-top:2; line-height: 2;">I. Báo cáo kết quả công tác tuần qua:        
      </div>
      @php
        $soThuTuPhanMem=0;
      @endphp
      @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
          @php
            if($baoCaoTuanHienTai['is_group']==3){
              $soThuTuPhanMem++;
              echo "<div style='margin-left:30px; margin-top:2; line-height: 2; font-weight:bold;'>".$soThuTuPhanMem.". ".$baoCaoTuanHienTai['noi_dung']."</div>";
            }
            elseif($baoCaoTuanHienTai['is_group']==2){
              echo "<div style='margin-left:50px; margin-top:2; line-height: 2;'>&minus; ".$baoCaoTuanHienTai['noi_dung']."</div>";
            }
            elseif($baoCaoTuanHienTai['is_group']==1){
              echo "<div style='margin-left:65px; margin-top:2; line-height: 2;'>&plus; ".$baoCaoTuanHienTai['noi_dung']."</div>";
            }
            else{
              echo "<div style='margin-left:85px; margin-top:2; line-height: 2;'>○ ".$baoCaoTuanHienTai['noi_dung']."</div>";
            }
          @endphp
      @endforeach  

      <div style="margin-left: 20px; font-weight: bold; margin-top:2; line-height: 2;">II. Đăng ký công tác tuần tiếp theo:        
      </div>
      @php
        $soThuTuPhanMem=0;
      @endphp
      @foreach ($baoCaoKeHoachTuans as $baoCaoKeHoachTuan)
          @php
            if($baoCaoKeHoachTuan['is_group']==3){
              $soThuTuPhanMem++;
              echo "<div style='margin-left:30px; margin-top:2; line-height: 2; font-weight:bold;'>".$soThuTuPhanMem.". ".$baoCaoKeHoachTuan['noi_dung']."</div>";
            }
            elseif($baoCaoKeHoachTuan['is_group']==2){
              echo "<div style='margin-left:50px; margin-top:2; line-height: 2;'>&minus; ".$baoCaoKeHoachTuan['noi_dung']."</div>";
            }
            elseif($baoCaoKeHoachTuan['is_group']==1){
              echo "<div style='margin-left:65px;margin-top:2; line-height: 2;'>&plus; ".$baoCaoKeHoachTuan['noi_dung']."</div>";
            }
            else{
              echo "<div style='margin-left:85px;margin-top:2; line-height: 2;'>○ ".$baoCaoKeHoachTuan['noi_dung']."</div>";
            }
          @endphp
      @endforeach
      <div style="margin-left: 20px; font-weight: bold; line-height: 2;">III. Tổ kỹ thuật:        
      </div>
      <div style="margin-left: 20px; margin-top:2;">
        @php
          $sttHuyen=0;
        @endphp
        @foreach ($tongHopBaoCaoCapHuyens as $huyen)
          @php
            $sttHuyen++;
          @endphp
          <div style="font-size:17px; color: red; font-weight: bold; margin-top:2; line-height: 2;">
            {{$sttHuyen}}. {{$huyen['thong_tin_don_vi']['ten_don_vi']}}                
          </div>              
          @if ($trangThaiChotBaoCao==0 || ($huyen['thong_tin_don_vi']['trang_thai_chot_bao_cao']>1 && $trangThaiChotBaoCao>0))
            @if (isset($huyen['tuan_hien_tai']))            
              <div style="margin-left: 20px; font-weight: bold; margin-top:2; line-height: 2;">I. Báo cáo kết quả công tác tuần qua:</div>
              @php
                $sttPhanMem=0;
              @endphp
                @foreach ($huyen['tuan_hien_tai'] as $baoCaoTuanHienTai)
                  @php          
                    if($baoCaoTuanHienTai['is_group']==3){
                      $soThuTuPhanMem++;
                      echo "<div style='margin-left:10px; margin-top:2; line-height: 2; font-weight:bold;'>".$soThuTuPhanMem.". ".$baoCaoTuanHienTai['noi_dung']."</div>";
                    }
                    elseif($baoCaoTuanHienTai['is_group']==2){
                      echo "<div style='margin-left:30px; margin-top:2; line-height: 2;'>&minus; ".$baoCaoTuanHienTai['noi_dung']."</div>";
                    }
                    elseif($baoCaoTuanHienTai['is_group']==1){
                      echo "<div style='margin-left:55px; margin-top:2; line-height: 2;'>&plus; ".$baoCaoTuanHienTai['noi_dung']."</div>";
                    }
                    else{
                      echo "<div style='margin-left:75px; margin-top:2; line-height: 2;'>○ ".$baoCaoTuanHienTai['noi_dung']."</div>";
                    }
                  @endphp
                @endforeach
            
            <div style="margin-left: 30px; font-weight: bold; color: black; margin-top:2;">Báo cáo số liệu ĐHSXKD
            </div>

            <div style="margin-left: 40px; margin-top: 20px; line-height: 2;">
              <div style="font-weight: bold; line-height: 2;">* Phát triển mới</div>
              <div>
                <table style="width: 100%;">
                      <tr style="width: 100%; height:39.5px; text-align:center;">
                          <td style="width: 5%; font-weight: bold;text-align:center; border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray;">STT</td>
                          <td style="width: 30%; font-weight: bold;border-right: 1px solid gray;border-top: 1px solid gray;">Tên dịch vụ</td>
                          <td style="width: 20%; font-weight: bold;border-right: 1px solid gray;border-top: 1px solid gray;">Số lượng</td>
                          <td style="width: 45%; font-weight: bold;border-right: 1px solid gray;border-top: 1px solid gray;">
                            Ghi chú
                          </td>
                      </tr>
                      @if(isset($huyen['phat_trien_moi']) && count($huyen['phat_trien_moi'])>0)
                        <tr style="font-weight: bold; color: black; height:31px;">
                          <td colspan="4" style="color: black; !important; border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray;">&nbsp;Phát triển mới</td>
                        </tr>
                        @php $stt=0; @endphp
                        @foreach ($huyen['phat_trien_moi'] as $ptm)
                          @php $stt++; @endphp
                          <tr style="height: 31px;">
                            <td style="text-align:center; border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray;">{{$stt}}</td>
                            <td style="color: black !important; border-right: 1px solid gray;border-top: 1px solid gray;">
                              @if ($ptm['mo_ta'])
                                {{$ptm['mo_ta']}}
                              @else
                                {{$ptm['chi_so']}}
                              @endif
                            </td>
                            <td style="text-align:center;border-right: 1px solid gray;border-top: 1px solid gray;">
                              {{$ptm['gia_tri']}}
                            </td>
                            <td style="font-weight: bold;border-right: 1px solid gray;border-top: 1px solid gray;">
                              {{$ptm['ghi_chu']}}
                            </td>
                          </tr>
                        @endforeach
                      @endif
                      @if(isset($huyen['goi_home']) && count($huyen['goi_home'])>0)
                        <tr style="font-weight: bold; color: black; height:31px;">
                          <td colspan="4" style="color: black; !important; border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray;">&nbsp;Gói home</td>
                        </tr>
                        @php $stt=0; @endphp
                        @foreach ($huyen['goi_home'] as $ptm)
                          @php 
                            $stt++; 
                            $lastItemStyle='';
                            if($stt==count($huyen['goi_home'])){
                              $lastItemStyle='border-bottom: 1px solid gray;';
                            }
                          @endphp
                          <tr style="height: 31px;">
                            <td style="text-align:center; border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray;{{$lastItemStyle}}">{{$stt}}</td>
                            <td style="color: black !important; border-right: 1px solid gray;border-top: 1px solid gray;{{$lastItemStyle}}">
                              @if ($ptm['mo_ta'])
                                {{$ptm['mo_ta']}}
                              @else
                                {{$ptm['chi_so']}}
                              @endif
                            </td>
                            <td style="text-align:center;border-right: 1px solid gray;border-top: 1px solid gray;{{$lastItemStyle}}">
                              {{$ptm['gia_tri']}}
                            </td>
                            <td style="font-weight: bold;border-right: 1px solid gray;border-top: 1px solid gray;{{$lastItemStyle}}">
                              {{$ptm['ghi_chu']}}
                            </td>
                          </tr>
                        @endforeach
                      @endif
                      
                    </tbody>
                  </table>


                  @if(isset($huyen['xu_ly_dung_han']) && count($huyen['xu_ly_dung_han'])>0)
                    <div style="font-weight: bold; margin-top: 30px; line-height: 2;">* Lắp đặt sửa chữa xử lý đúng hạn</div>
                    <div>
                      <table style="width: 100%;">
                        <thead>
                          <tr style="width: 100%; height:39.5px; text-align:center;">
                            @php
                              $stt=0; 
                            @endphp
                            @foreach ($huyen['xu_ly_dung_han'] as $ptm)
                              @php
                                $stt++; $firstItemStyle=''; $lastItemStyle='';
                                if($stt==1){
                                  $firstItemStyle='border-left: 1px solid gray;';
                                }
                              @endphp
                              <td style="font-weight: bold;{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">
                                @if ($ptm['mo_ta'])
                                  {{$ptm['mo_ta']}}
                                @else
                                  {{$ptm['chi_so']}}
                                @endif
                              </td>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody>
                          <tr style="height: 31px;">
                            @php
                              $stt=0; 
                            @endphp
                            @foreach ($huyen['xu_ly_dung_han'] as $ptm)
                              @php
                                $stt++; $firstItemStyle=''; $lastItemStyle='';
                                if($stt==1){
                                  $firstItemStyle='border-left: 1px solid gray;';
                                }
                              @endphp
                              <td style="{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray; border-bottom: 1px solid gray;">
                                {{$ptm['gia_tri']}}
                                @if ($ptm['ghi_chu'])
                                  <br>&nbsp;({{$ptm['ghi_chu']}})
                                @endif
                              </td>
                            @endforeach
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                @endif


                @if(isset($huyen['mll']) && count($huyen['mll'])>0)
                  <div style="font-weight: bold; margin-top: 30px; line-height: 2;">* Mất liên lạc</div>
                  <div>
                    <table style="width: 100%;">
                      <thead>
                        <tr style="width: 100%; height:39.5px; text-align:center;">
                          @php
                            $stt=0; 
                          @endphp
                          @foreach ($huyen['mll'] as $ptm)
                            @php
                              $stt++; $firstItemStyle=''; $lastItemStyle='';
                              if($stt==1){
                                $firstItemStyle='border-left: 1px solid gray;';
                              }
                            @endphp
                            <td style="font-weight: bold;{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">
                              @if ($ptm['mo_ta'])
                                {{$ptm['mo_ta']}}
                              @else
                                {{$ptm['chi_so']}}
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="height: 31px;">
                          @php
                            $stt=0; 
                          @endphp
                          @foreach ($huyen['mll'] as $ptm)
                            @php
                              $stt++; $firstItemStyle=''; $lastItemStyle='';
                              if($stt==1){
                                $firstItemStyle='border-left: 1px solid gray;';
                              }
                            @endphp
                            <td style="{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray; border-bottom: 1px solid gray;">
                              {{$ptm['gia_tri']}}
                              @if ($ptm['ghi_chu'])
                                &nbsp;({{$ptm['ghi_chu']}})
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                @endif


                @if(isset($huyen['b2a']) && count($huyen['b2a'])>0)
                  <div style="font-weight: bold; margin-top: 30px; line-height: 2;">* Số liệu B2A</div>
                  <div>
                    <table style="width: 100%;">
                      <thead>
                        <tr style="width: 100%; height:39.5px; text-align:center;">
                          @php
                            $stt=0; 
                          @endphp
                          @foreach ($huyen['b2a'] as $ptm)
                            @php
                              $stt++; $firstItemStyle=''; $lastItemStyle='';
                              if($stt==1){
                                $firstItemStyle='border-left: 1px solid gray;';
                              }
                            @endphp
                            <td style="font-weight: bold;{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">
                              @if ($ptm['mo_ta'])
                                {{$ptm['mo_ta']}}
                              @else
                                {{$ptm['chi_so']}}
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="height: 31px;">
                          @php
                            $stt=0; 
                          @endphp
                          @foreach ($huyen['b2a'] as $ptm)
                            @php
                              $stt++; $firstItemStyle=''; $lastItemStyle='';
                              if($stt==1){
                                $firstItemStyle='border-left: 1px solid gray;';
                              }
                            @endphp
                            <td style="{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray; border-bottom: 1px solid gray;">
                              {{$ptm['gia_tri']}}
                              @if ($ptm['ghi_chu'])
                                &nbsp;({{$ptm['ghi_chu']}})
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                @endif


                @if(isset($huyen['hai_long']) && count($huyen['hai_long'])>0)
                  <div style="font-weight: bold; margin-top: 30px; line-height: 2;">* Đánh giá độ hài lòng</div>
                  <div>
                    <table style="width: 100%;">
                      <thead>
                        <tr style="width: 100%; height:39.5px; text-align:center;">
                          @php
                            $stt=0; 
                          @endphp
                          @foreach ($huyen['hai_long'] as $ptm)
                            @php
                              $stt++; $firstItemStyle=''; $lastItemStyle='';
                              if($stt==1){
                                $firstItemStyle='border-left: 1px solid gray;';
                              }
                            @endphp
                            <td style="font-weight: bold;{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">
                              @if ($ptm['mo_ta'])
                                {{$ptm['mo_ta']}}
                              @else
                                {{$ptm['chi_so']}}
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="height: 31px;">
                          @php
                            $stt=0; 
                          @endphp
                          @foreach ($huyen['hai_long'] as $ptm)
                            @php
                              $stt++; $firstItemStyle=''; $lastItemStyle='';
                              if($stt==1){
                                $firstItemStyle='border-left: 1px solid gray;';
                              }
                            @endphp
                            <td style="{{$firstItemStyle}} text-align:center; border-right: 1px solid gray;border-top: 1px solid gray; border-bottom: 1px solid gray;">
                              {{$ptm['gia_tri']}}
                              @if ($ptm['ghi_chu'])
                                &nbsp;({{$ptm['ghi_chu']}})
                              @endif
                            </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                @endif


                @if(isset($huyen['xu_ly_suy_hao']) && count($huyen['xu_ly_suy_hao'])>0)
                  <div style="font-weight: bold; margin-top: 30px; line-height: 2;">* Xử lý sự cố</div>
                  <div>
                    <table style="width: 100%;">
                      <thead>
                          <tr style="height:39.5px;">
                            <th style="width: 5%; font-weight: bold;text-align:center; border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray;">STT</th>
                            <th style="width: 25; font-weight: bold;text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">Cán bộ xử lý</th>
                            <th style="width: 10%; font-weight: bold;text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">Suy hao</th>
                            <th style="width: 10%; font-weight: bold;text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">Xử lý</th>
                            <th style="width: 10%; font-weight: bold;text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">Còn lại</th>
                            <th style="width: 10%; font-weight: bold;text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">(+)/(-)</th>
                            <th style="width: 30%; font-weight: bold;text-align:center; border-right: 1px solid gray;border-top: 1px solid gray;">
                              Nguyên nhân
                            </th>
                          </tr>
                      </thead>
                      <tbody>    
                          @php $stt=0; @endphp
                          @foreach ($huyen['xu_ly_suy_hao'] as $xlsc)
                            @php 
                              $stt++; 
                              $lastItemStyle='';
                              if($stt==count($huyen['xu_ly_suy_hao'])){
                                $lastItemStyle='border-bottom: 1px solid gray;';
                              }
                            @endphp
                            <tr style="height:31px;">
                              <td style="{{$lastItemStyle}} border-left: 1px solid gray; border-right: 1px solid gray;border-top: 1px solid gray; text-align: center;">{{$stt}}</td>
                              <td style="{{$lastItemStyle}} border-right: 1px solid gray;border-top: 1px solid gray;">
                                @if ($xlsc['mo_ta'])
                                  {{$xlsc['mo_ta']}}
                                @else
                                  {{$xlsc['chi_so']}}
                                @endif
                              </td>
                              <td style="{{$lastItemStyle}} border-right: 1px solid gray;border-top: 1px solid gray; text-align: center;">
                                {{$xlsc['suy_hao']}}
                              </td>
                              <td style="{{$lastItemStyle}} border-right: 1px solid gray;border-top: 1px solid gray; text-align: center;">
                                {{$xlsc['gia_tri']}}
                              </td>
                              <td style="{{$lastItemStyle}} border-right: 1px solid gray;border-top: 1px solid gray; text-align: center;">
                                {{$xlsc['suy_hao_con_lai']}}
                              </td>
                              <td style="{{$lastItemStyle}} border-right: 1px solid gray;border-top: 1px solid gray; text-align: center;">
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
                              <td style="{{$lastItemStyle}} border-right: 1px solid gray;border-top: 1px solid gray; text-align: center;">
                                {{$xlsc['ghi_chu']}}
                              </td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                @endif

              @endif
            </div>



              @if (isset($huyen['ke_hoach_tuan']))
                <div style="margin-left: 20px; font-weight: bold; margin-top:30px; line-height: 2;">II. Đăng ký công tác tuần tiếp theo:</div>
                @foreach ($huyen['ke_hoach_tuan'] as $baoCaoKeHoachTuan)
                  @php
                    if($baoCaoKeHoachTuan['is_group']==3){
                      $soThuTuPhanMem++;
                      echo "<div style='margin-left:30px; margin-top:2; line-height: 2; font-weight:bold;'>".$soThuTuPhanMem.". ".$baoCaoKeHoachTuan['noi_dung']."</div>";
                    }
                    elseif($baoCaoKeHoachTuan['is_group']==2){
                      echo "<div style='margin-left:50px; margin-top:2; line-height: 2;'>&minus; ".$baoCaoKeHoachTuan['noi_dung']."</div>";
                    }
                    elseif($baoCaoKeHoachTuan['is_group']==1){
                      echo "<div style='margin-left:65px;margin-top:2; line-height: 2;'>&plus; ".$baoCaoKeHoachTuan['noi_dung']."</div>";
                    }
                    else{
                      echo "<div style='margin-left:85px;margin-top:2; line-height: 2;'>○ ".$baoCaoKeHoachTuan['noi_dung']."</div>";
                    }
                  @endphp
                @endforeach
              @endif
          @endif
        @endforeach
      </div>
    </div>
  </div>


<div class="row">
  <div class="col-12">
    <br>
    <div class="form-group mt-5 text-right">
      @if ($checkQuyenXuatWord==1)
        <button type="button" class="btn btn-vnpt mr-2 btn-xuat-word"><i class="fa fa-file-word-o"></i> Xuất báo cáo sang Word(.doc)</button>
      @endif
      @if ($checkQuyenInBaoCao==1)
        <button type="button" class="btn btn-vnpt mr-2 btn-in-bao-cao" ><i class="fa fa-print"></i> In báo cáo(PDF)</button>
      @endif
      <button type="button" class="btn btn-danger mr-2 btn-quay-lai"><i class="fa fa-reply-all"></i> Quay lại</button>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/js/export-word/FileSaver.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/js/export-word/jquery.wordexport.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {  
      $('.btn-xuat-word').on('click',function(){
          $(".noi-dung-bao-cao-tong-hop").wordExport('Bao_cao_tuan');
      });

      $('.btn-in-bao-cao').on('click',function(){
        jQuery('.btn').addClass('d-none');
          window.print();
          jQuery('.btn').removeClass('d-none');
      });

      $('.btn-quay-lai').on('click',function(){
        var url="{{ route('bao-cao-tuan-vien-thong-huyen') }}";
        location.href = url;
      });
    });
</script>



