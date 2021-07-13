@extends('layouts.script-layout')
@section('title', 'Phòng ban, Trung tâm')
<link rel="shortcut icon" href="{{ secure_asset('public/images/favicon.ico') }}">
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
              $checkCoNhapBaoCaoTuanHienTai=Helper::kiemTraCoNhapBaoCaoTuanHienTai($baoCaoTuanHienTai['id_tuan'], $baoCaoTuanHienTai['id_dich_vu']);
              if($checkCoNhapBaoCaoTuanHienTai===1){
                $soThuTuPhanMem++;
                echo "<div style='margin-left:30px; margin-top:2; line-height: 2; font-weight:bold;'>".$soThuTuPhanMem.". ".$baoCaoTuanHienTai['noi_dung']."</div>";
              }
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
              $checkCoNhapKeHoachTuan=Helper::kiemTraCoNhapKeHoachTuan($baoCaoKeHoachTuan['id_tuan'], $baoCaoKeHoachTuan['id_dich_vu']);
              if($checkCoNhapKeHoachTuan===1){
                $soThuTuPhanMem++;
                echo "<div style='margin-left:30px; margin-top:2; line-height: 2; font-weight:bold;'>".$soThuTuPhanMem.". ".$baoCaoKeHoachTuan['noi_dung']."</div>";
              }
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
        var url="{{ route('don-vi-truc-thuoc-khac-bao-cao-tuan') }}";
        location.href = url;
      });
    });
</script>



