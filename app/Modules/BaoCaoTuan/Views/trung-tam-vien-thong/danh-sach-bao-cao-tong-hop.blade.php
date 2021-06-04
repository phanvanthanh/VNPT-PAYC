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
@endphp
<div class="noi-dung-bao-cao-tong-hop">
  {{-- Báo cáo tuần này --}}
  <div class="row">
    <div class="col-12">
      <h6 class="text-center">
        KẾ HOẠCH TUẦN {{$dmTuan['tuan']}}_{{$dmTuan['nam']}} VNPT. TVH <br>
        (Từ ngày {{$tuNgay}} đến {{$denNgay}})
      </h6>
      <h6 class="text-danger">* {{$donVi['ten_don_vi']}}</h6>
      <div class="font-weight-bold" style="margin-left: 20px;">1. Báo cáo tuần</div>
      <ul class="">
        @foreach ($baoCaoTuanHienTais as $baoCaoTuanHienTai)
          <li  @if ($baoCaoTuanHienTai['is_group']==1) class='font-weight-bold' style='margin-left: 30px;' @else style='margin-left: 40px;' @endif >
            @if ($baoCaoTuanHienTai['is_group']==1) <i class="fa fa-minus" style="font-size: 10px;"></i> @else <i class="fa fa-plus" style="font-size: 10px;"></i> 
            @endif{{$baoCaoTuanHienTai['noi_dung']}}
          </li>
        @endforeach
      </ul>
      <div class="font-weight-bold" style="margin-left: 20px;">2. Báo cáo số liệu ĐHSXKD</div>
        <div class="font-weight-bold" style="margin-left: 30px;">* Xử lý PAKN</div>
          @if (count($baoCaoPakns)>0)
            <div style="margin-left: 40px; margin-bottom: 30px;">
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



      <div class="font-weight-bold" style="margin-left: 20px;">3. Kế hoạch tuần tiếp theo</div>
      <ul class="">
        @foreach ($baoCaoKeHoachTuans as $baoCaoKeHoachTuan)
          <li  @if ($baoCaoKeHoachTuan['is_group']==1) class='font-weight-bold' style='margin-left: 30px;' @else style='margin-left: 40px;' @endif >
            @if ($baoCaoKeHoachTuan['is_group']==1) <i class="fa fa-minus" style="font-size: 10px;"></i> @else <i class="fa fa-plus" style="font-size: 10px;"></i> 
            @endif{{$baoCaoKeHoachTuan['noi_dung']}}
          </li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <br>
      <div class="form-group mt-5 text-right" style="margin-bottom: 0px;">
        <button type="button" class="btn btn-vnpt mr-2"><i class="fa fa-file-word-o"></i> Xuất báo cáo</button>
        <button type="button" class="btn btn-vnpt mr-2"  data-toggle="tooltip" data-placement="bottom" title="Basic tooltip"><i class="fa fa-print"></i> In báo cáo</button>
        <button type="button" class="btn btn-danger mr-2 btn-chot-va-gui-bao-cao @if ($daChotSoLieu==1) disabled @endif" @if ($daChotSoLieu==1) disabled="disabled" @endif><i class="fa fa-send"></i> Chốt & Gửi báo cáo</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.btn-chot-va-gui-bao-cao').on('click',function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val(); 
        var idTuan=jQuery('#id_tuan').val();
        //postAndNotRefreshById(_token, idTuan, "{{ route('trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu') }}", true);
        postAndRefreshById(_token, idTuan, "{{ route('trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',true);
      });
    });
</script>



