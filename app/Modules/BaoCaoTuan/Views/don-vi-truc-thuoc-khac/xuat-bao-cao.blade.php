@extends('layouts.script-layout')
@section('title', 'Phòng ban, Trung tâm')
<link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
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

  
  $checkQuyenDuyetVaGuiBaoCao=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'DUYET_VA_GUI_BAO_CAO');
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
  {{-- Báo cáo tuần này --}}
  <div class="row">
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
      {{-- <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 35px;"><i class='fa fa-minus' style="margin-right:10px;"></i>Báo cáo số liệu PAKN
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-refresh text-primary cusor btn-lay-so-lieu-bao-cao-dhsxkd"></i>
          </i>
        @endif
      </div> --}}
    
      @if (count($baoCaoPakns)>0)
        {{-- <div class="font-weight-bold" style="margin-left: 30px;">* Xử lý PAKN</div> --}}
        {{-- <div style="margin-left: 40px; margin-bottom: 35px;">
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
        </div> --}}
      @endif

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
    </div>
  </div>

  
</div>
  <div class="row">
    <div class="col-12">
      <br>
      <div class="form-group mt-5 text-right" style="margin-bottom: 0px;">
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
<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/export-word/FileSaver.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/export-word/jquery.wordexport.js') }}"></script>
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
        var url="{{ route('don-vi-truc-thuoc-khac-bao-cao-tuan') }}";
        location.href = url;
      });
    });
</script>



