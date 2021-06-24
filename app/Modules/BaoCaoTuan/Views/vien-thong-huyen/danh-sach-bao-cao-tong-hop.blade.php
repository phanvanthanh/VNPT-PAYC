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
              <input type="Text" class="form-control noi-dung-bao-cao-tuan-hien-tai" placeholder="Nội dung báo cáo tuần này" name="noi_dung" style="margin-left: 30px;">
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
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">2. Báo cáo số liệu ĐHSXKD
        @if ($daChotSoLieu==0)
          <i class="list-menu-nhanh d-none">
            <i class="fa fa-refresh text-primary cusor btn-lay-so-lieu-bao-cao-dhsxkd"></i>
          </i>
        @endif
      </div>
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

        <div class="font-weight-bold" style="margin-left: 30px;">* Đánh giá độ hài lòng</div>
        @if($baoCaoDoHaiLongs)
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

        <div class="font-weight-bold" style="margin-left: 30px;">* Xử lý sự cố</div>
          @if (count($baoCaoXuLySuyHaos)>0)
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
          
      <div class="font-weight-bold hover-view-form" data-hover-view-form=".list-menu-nhanh" style="margin-left: 20px;">3. Kế hoạch tuần tiếp theo
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

  <div class="row">
    <div class="col-12">
      <br>
      <div class="form-group mt-5 text-right" style="margin-bottom: 0px;">
        <button type="button" class="btn btn-vnpt mr-2"><i class="fa fa-file-word-o"></i> Xuất báo cáo</button>
        <button type="button" class="btn btn-vnpt mr-2"  data-toggle="tooltip" data-placement="bottom" title="Basic tooltip"><i class="fa fa-print"></i> In báo cáo</button>
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


<script type="text/javascript" src="{{ asset('public/js/view-form.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.btn-chot-va-gui-bao-cao').on('click',function(){
        var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val(); 
        var idTuan=jQuery('#id_tuan').val();
        //postAndNotRefreshById(_token, idTuan, "{{ route('bao-cao-tuan-vien-thong-huyen-chot-so-lieu') }}", true);
        postAndRefreshById(_token, idTuan, "{{ route('bao-cao-tuan-vien-thong-huyen-chot-so-lieu') }}", idTuan, "{{ route('danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop', true);
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

      jQuery('.noi-dung-bao-cao-tuan-hien-tai').on("keypress", function(e) {
        if (e.keyCode == 13) {
          
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

      jQuery('.noi-dung-bao-cao-ke-hoach-tuan').on("keypress", function(e) {
        if (e.keyCode == 13) {
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


    });
</script>



