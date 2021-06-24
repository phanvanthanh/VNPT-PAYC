@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
@endphp
<div class="wrapper mb-3 mt-4">
  <span class="badge badge-warning text-white">Lưu ý: </span>
  <p class="d-inline ml-3 text-dark">Số liệu báo cáo ĐHSXKD được tổng hợp từ <b class="text-danger">{{$ngayLayDuLieuTuanTruoc}}</b> - <b class="text-primary">{{$thoiGianLaySoLieu}}</b>.</p>
</div>
<h6 class="text-danger">1. Xử lý PAKN</h6>
<table id="table-dhsxkd-pakn" class="table table-hover table-dhsxkd-pakn">
  <thead>
      <tr class="background-vnpt text-center">
          <th style="width: 10%;">STT</th>
          <th style="width: 40;">Tên dịch vụ</th>
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$pakn['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$pakn['id']}}">
            </form>
          </td>
        </tr>
      @endforeach
  </tbody>
</table>   

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group mt-5 text-right" style="margin-bottom: 0px;">
      <button type="button" class="btn btn-danger mr-2 btn-don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd 
      @if ($daChotSoLieu>0) disabled @endif" 
      @if ($daChotSoLieu>0) disabled="disabled" @endif 
      ><i class="fa fa-refresh"></i> Lấy dữ liệu</button>
    </div>
  </div>
</div>





<script type="text/javascript">
    jQuery(document).ready(function() {
       $('#table-dhsxkd-pakn').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
      

      $(".ghi_chu").keyup(function(e){
          if((e.keyCode || e.which) == 13) { //Enter keycode
            var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
            var form=jQuery(this).parents('form');
            var idTuan=jQuery('#id_tuan').val(); 
            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-bao-cao-dhsxkd', false);
            return false;
          }
      });

      jQuery('.btn-don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd').on('click', function() {
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, idTuan, "{{ route('don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd') }}", idTuan, "{{ route('don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
        return false;
      });



        
    });
</script>


