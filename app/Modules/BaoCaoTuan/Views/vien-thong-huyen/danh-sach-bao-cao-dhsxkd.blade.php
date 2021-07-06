@php
  $daChotSoLieu=Helper::kiemTraDaChotSoLieu($idTuan, $ma);
@endphp
<div class="wrapper mb-3 mt-4">
  <div class="row">
    <div class="col-md-8">
      <span class="badge badge-warning text-white">Lưu ý: </span>
      <p class="d-inline ml-3 text-dark">Số liệu báo cáo ĐHSXKD được tổng hợp từ <b class="text-danger">{{$ngayLayDuLieuTuanTruoc}}</b> - <b class="text-primary">{{$thoiGianLaySoLieu}}</b>.</p>
    </div>
    <div class="col-md-4 text-right">
      <button type="button" class="btn btn-danger mr-2 btn-vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd @if ($daChotSoLieu>0) disabled @endif" @if ($daChotSoLieu>0) disabled="disabled" @endif><i class="fa fa-refresh"></i> Lấy dữ liệu</button>
    </div>
  </div>
    
      
</div>
<h6 class="text-danger">Số liệu từ hệ thống ĐHSXKD</h6>
<table id="table-dhsxkd-phat-trien-moi" class="table table-hover table-dhsxkd-phat-trien-moi">
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$ptm['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$ptm['id']}}">
            </form>
          </td>
        </tr>
      @endforeach



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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$ptm['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$ptm['id']}}">
            </form>
          </td>
        </tr>
      @endforeach


      <tr class="active font-weight-bold tr-small">
        <td colspan="4">&nbsp;Lắp đặt sửa chữa Xử lý đúng hạn</td>
      </tr>
      @php $stt=0; @endphp
      @foreach ($baoCaoXuLyDungHans as $ptm)
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$ptm['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$ptm['id']}}">
            </form>
          </td>
        </tr>
      @endforeach


      <tr class="active font-weight-bold tr-small">
        <td colspan="4">&nbsp;Mất liên lạc</td>
      </tr>
      @php $stt=0; @endphp
      @foreach ($baoCaoMLLs as $ptm)
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$ptm['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$ptm['id']}}">
            </form>
          </td>
        </tr>
      @endforeach


      <tr class="active font-weight-bold tr-small">
        <td colspan="4">&nbsp;Số liệu B2A</td>
      </tr>
      @php $stt=0; @endphp
      @foreach ($baoCaoB2As as $ptm)
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$ptm['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$ptm['id']}}">
            </form>
          </td>
        </tr>
      @endforeach


      <tr class="active font-weight-bold tr-small">
        <td colspan="4">&nbsp;Đánh giá độ hài lòng</td>
      </tr>
      @php $stt=0; @endphp
      @foreach ($baoCaoDoHaiLongs as $ptm)
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$ptm['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$ptm['id']}}">
            </form>
          </td>
        </tr>
      @endforeach

  </tbody>
</table>    



<div class="wrapper mb-3 mt-4">
  <h6 class="text-danger">Xử lý sự cố</h6>
</div>
<table id="table-dhsxkd-xu-ly-su-co" class="table table-hover table-dhsxkd-xu-ly-su-co">
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
            <form class="forms-sample frm-cap-nhat-ghi-chu" name="frm-cap-nhat-ghi-chu">
              {{ csrf_field() }}
              <input type="Text" class="form-control @if ($daChotSoLieu>0) disabled @endif ghi_chu" placeholder="" @if ($daChotSoLieu>0) disabled="disabled" @endif value="{{$xlsc['ghi_chu']}}" name="ghi_chu">
              <input type="hidden" name="id" value="{{$xlsc['id']}}">
            </form>
            
          </td>
        </tr>
      @endforeach
  </tbody>
</table>   

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group mt-5 text-right" style="margin-bottom: 0px;">
      <button type="button" class="btn btn-danger mr-2 btn-vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd @if ($daChotSoLieu>0) disabled @endif" @if ($daChotSoLieu>0) disabled="disabled" @endif><i class="fa fa-refresh"></i> Lấy dữ liệu</button>
    </div>
  </div>
</div>





<script type="text/javascript">
    jQuery(document).ready(function() {
       

       $('#table-dhsxkd-xu-ly-su-co').dataTable({
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
            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd') }}", idTuan, "{{ route('danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-bao-cao-dhsxkd', false);
            return false;
          }
      });

      jQuery('.btn-vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd').on('click', function() {
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
        var idTuan=jQuery('#id_tuan').val(); 
        postAndRefreshById(_token, idTuan, "{{ route('vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd') }}", idTuan, "{{ route('danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
      });



        
    });
</script>


