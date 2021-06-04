@extends('layouts.index')
@section('title', 'Quản trị nhóm quyền')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">BÁO CÁO TUẦN - TRUNG TÂM VIỄN THÔNG</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               

                @php
                  $week=\Helper::layTuanHienTai();
                  $year=date('Y');
                  $daVuotThoiGianBaoCao=0;
                @endphp
                
                <div class="row user-profile">
                  
                  <div class="col-lg-12 side-right stretch-card">
                    <div class="card">
                      <div class="card-body" style="min-height: 500px;">
                        <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                          <h4 class="card-title mb-0">
                            <form class="forms-sample frm-bao-cao-tuan" id="frm-bao-cao-tuan" name="frm-bao-cao-tuan">
                              {{ csrf_field() }}
                              <select class="form-control id_tuan" id="id_tuan" name="id_tuan" aria-describedby="tuan_helper" style="width: 100%;">
                                @foreach($bcDmTuan as $dmTuan)
                                  <option value="{{$dmTuan['id']}}" @if ($week==$dmTuan['tuan']) {{"selected='selected'"}} @endif>Báo cáo tuần @if ($dmTuan['tuan']<10) {{"0"}}@endif{{$dmTuan['tuan']}} - Năm {{$dmTuan['nam']}}</option>
                                @endforeach
                              </select>
                            </form>
                          </h4>
                          <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            
                            <li class="nav-item">
                              <a class="nav-link active" id="bao-cao-tuan-hien-tai-tab" data-toggle="tab" href="#bao-cao-tuan-hien-tai" role="tab" aria-controls="bao-cao-tuan-hien-tai">Báo cáo tuần này</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="bao-cao-ke-hoach-tuan-tab" data-toggle="tab" href="#bao-cao-ke-hoach-tuan" role="tab" aria-controls="bao-cao-ke-hoach-tuan">Kế hoạch tuần kế</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="dhsxkd-tab" data-toggle="tab" href="#dhsxkd" role="tab" aria-controls="dhsxkd">Tổng hợp từ các Viễn Thông huyện/thành phố</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="chot-va-gui-bao-cao-tab" data-toggle="tab" href="#chot-va-gui-bao-cao" role="tab" aria-controls="tong-hop-va-gui-bao-cao">Chốt & Gửi báo cáo tổng hợp</a>
                            </li>
                          </ul>
                        </div>
                        <div class="wrapper">
                          <hr>
                          <div class="tab-content" id="myTabContent"  style="min-height: 100%;">
                            
                              
                            <div class="tab-pane fade show active" id="bao-cao-tuan-hien-tai" role="tabpanel" aria-labelledby="bao-cao-tuan-hien-tai-tab">
                              <form class="forms-sample frm-bao-cao-tuan-hien-tai" id="frm-bao-cao-tuan-hien-tai" name="frm-bao-cao-tuan-hien-tai">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                    <div class="form-group">
                                      <input type="Text" class="form-control noi-dung-bao-cao-tuan-hien-tai" placeholder="Nội dung báo cáo tuần này" name="noi_dung">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 text-right">
                                    <button type="button" class="btn btn-vnpt mr-2 btn-bao-cao-tuan-hien-tai"><i class="fa fa-plus"></i> Thêm</button>
                                  </div>
                                  <div class=".d-none .d-md-block col-md-4 col-lg-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="table-responsive load-danh-sach-bao-cao-tuan-hien-tai">
                                         
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade" id="bao-cao-ke-hoach-tuan" role="tabpanel" aria-labelledby="bao-cao-ke-hoach-tuan-tab">
                              <form class="forms-sample frm-bao-cao-ke-hoach-tuan" id="frm-bao-cao-ke-hoach-tuan" name="frm-bao-cao-ke-hoach-tuan">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_tuan" class="input-id-tuan" value="0">
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                    <div class="form-group">
                                      <input type="Text" class="form-control noi-dung-bao-cao-ke-hoach-tuan" name="noi_dung" placeholder="Nội dung kế hoạch tuần kế tiếp">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 text-right">
                                    <button type="button" class="btn btn-vnpt mr-2 btn-bao-cao-ke-hoach-tuan"><i class="fa fa-plus"></i> Thêm</button>
                                  </div>
                                  <div class=".d-none .d-md-block col-md-4 col-lg-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="table-responsive load-danh-sach-bao-cao-ke-hoach-tuan">
                                           
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade" id="dhsxkd" role="tabpanel" aria-labelledby="dhsxkd-tab">
                              <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                  <div class="load-danh-sach-dhsxkd">                                     
                                  </div>
                                </div>
                              </div>                                  
                            </div>
                            <div class="tab-pane fade" id="chot-va-gui-bao-cao" role="tabpanel" aria-labelledby="chot-va-gui-bao-cao-tab">
                              <div class="row">
                                <div class="col-12">
                                  <div class="load-danh-sach-bao-cao-tong-hop">
                                         
                                  </div>
                                </div>
                              </div>                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>


  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      $.fn.dataTable.ext.errMode = 'none';
  
      // THÔNG TIN CHUNG
      // onload
      var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
      var idTuan=jQuery('.id_tuan').val();
      jQuery('.input-id-tuan').val(idTuan);
      loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);


      // Onchange selectbox tuần
      jQuery('.id_tuan').on('change',function(){
        var idTuan=jQuery(this).val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);

        // Load kế hoạch tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);

        // Load dữ liệu điều hành sản xuất kinh doanh dhsxkd
        // Load dữ liệu điều hành sản xuất kinh doanh dhsxkd
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);

        // Load báo cáo tổng hợp
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });













      // MODULE BÁO CÁO TUẦN HIỆN TẠI
      jQuery('.noi-dung-bao-cao-tuan-hien-tai').on("keypress", function(e) {
        if (e.keyCode == 13) {
          var idTuan=jQuery('#id_tuan').val();
          themMoiVaRefreshDuLieuTheoId2(_token, $("form#frm-bao-cao-tuan-hien-tai"), "{{ route('trung-tam-vien-thong-them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai', false);
        }
      });

      jQuery('.btn-bao-cao-tuan-hien-tai').on("click", function(e) {
        var idTuan=jQuery('#id_tuan').val();
        themMoiVaRefreshDuLieuTheoId2(_token, $("form#frm-bao-cao-tuan-hien-tai"), "{{ route('trung-tam-vien-thong-them-bao-cao-tuan-hien-tai') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai', false);
      });

      jQuery('#bao-cao-tuan-hien-tai-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai') }}", '.load-danh-sach-bao-cao-tuan-hien-tai',false);
      });


      // MODULE BÁO CÁO KẾ HOẠCH TUẦN
      jQuery('.noi-dung-bao-cao-ke-hoach-tuan').on("keypress", function(e) {
        if (e.keyCode == 13) {
          var idTuan=jQuery('#id_tuan').val();
          themMoiVaRefreshDuLieuTheoId2(_token, $("form#frm-bao-cao-ke-hoach-tuan"), "{{ route('trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan', false);
        }
      });

      jQuery('.btn-bao-cao-ke-hoach-tuan').on("click", function(e) {
        var idTuan=jQuery('#id_tuan').val();
        themMoiVaRefreshDuLieuTheoId2(_token, $("form#frm-bao-cao-ke-hoach-tuan"), "{{ route('trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan') }}", idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan', false);
      });

      jQuery('#bao-cao-ke-hoach-tuan-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan') }}", '.load-danh-sach-bao-cao-ke-hoach-tuan',false);
      });

      // ĐHSXKD
      jQuery('#dhsxkd-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load kế hoạch tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd') }}", '.load-danh-sach-dhsxkd',false);
      });

      // MODULE BÁO CÁO TỔNG HỢP
      jQuery('#chot-va-gui-bao-cao-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });


     
      

      
    });
  </script>
@endsection

