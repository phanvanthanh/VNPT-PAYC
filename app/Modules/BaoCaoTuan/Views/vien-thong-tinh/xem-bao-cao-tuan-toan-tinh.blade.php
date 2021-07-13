@extends('layouts.index')
@section('title', 'Báo cáo tuần toàn tỉnh')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">XEM BÁO CÁO TUẦN TOÀN TỈNH</h4>
                  </div>
                    <div class="col-6 text-right">
                       <div class="error-mode float-right"></div> 
                       <b>Hạn báo cáo: <span id="thoi-gian-con-lai" class="text-primary"></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
               

                @php
                  
                  $week=\Helper::layTuanHienTai();
                  $year=date('Y');
                  $daVuotThoiGianBaoCao=0;
                  $maxThoiGianBaoCao='';

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
                                  <option value="{{$dmTuan['id']}}" 
                                    @if ($week==$dmTuan['tuan']) 
                                      {{"selected='selected'"}} 
                                      @php
                                        $maxThoiGianBaoCao=Helper::layMaxThoiGianBaoCao($dmTuan['id']);
                                      @endphp
                                    @endif 
                                    @if ($dmTuan['tuan']==25 && $dmTuan['nam']==2021) 
                                      {{'disabled'}}  
                                    @endif>
                                    Báo cáo tuần @if ($dmTuan['tuan']<10) {{"0"}}@endif{{$dmTuan['tuan']}} - Năm {{$dmTuan['nam']}}
                                  </option>
                                @endforeach
                              </select>
                            </form>
                          </h4>
                          <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="chot-va-gui-bao-cao-tab" data-toggle="tab" href="#chot-va-gui-bao-cao" role="tab" aria-controls="tong-hop-va-gui-bao-cao">Tổng hợp báo cáo</a>
                            </li>
                          </ul>
                        </div>
                        <div class="wrapper">
                          <hr>
                          <div class="tab-content" id="myTabContent"  style="min-height: 100%;">
                            <div class="tab-pane fade active show" id="chot-va-gui-bao-cao" role="tabpanel" aria-labelledby="chot-va-gui-bao-cao-tab">
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


  <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      $.fn.dataTable.ext.errMode = 'none';
  
      // THÔNG TIN CHUNG
      // onload
      var _token=jQuery('form[name="frm-bao-cao-tuan"]').find("input[name='_token']").val();
      var idTuan=jQuery('.id_tuan').val();
      jQuery('.input-id-tuan').val(idTuan);
      // Load báo cáo tổng hợp
      loadTableById2(_token, idTuan, "{{ route('vien-thong-tinh-xem-danh-sach-bao-cao-tong-hop-toan-tinh') }}", '.load-danh-sach-bao-cao-tong-hop',false);


      // Onchange selectbox tuần
      jQuery('.id_tuan').on('change',function(){
        var idTuan=jQuery(this).val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tổng hợp
        loadTableById2(_token, idTuan, "{{ route('vien-thong-tinh-xem-danh-sach-bao-cao-tong-hop-toan-tinh') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });

      // MODULE BÁO CÁO TỔNG HỢP
      jQuery('#chot-va-gui-bao-cao-tab').on('click',function(){
        var idTuan=jQuery('#id_tuan').val();
        jQuery('.input-id-tuan').val(idTuan);
        // Load báo cáo tuần
        loadTableById2(_token, idTuan, "{{ route('vien-thong-tinh-xem-danh-sach-bao-cao-tong-hop-toan-tinh') }}", '.load-danh-sach-bao-cao-tong-hop',false);
      });



     function secondsToHms(d) {
          d = Number(d);
          var h = Math.floor(d / 3600);
          var m = Math.floor(d % 3600 / 60);
          var s = Math.floor(d % 3600 % 60);

          var hDisplay = h > 0 ? h + (h == 1 ? "" : "") : "0";
          var mDisplay = m > 0 ? m + (m == 1 ? "" : "") : "0";
          var sDisplay = s > 0 ? s + (s == 1 ? "" : "") : "0";
          if(hDisplay<10){hDisplay="0"+hDisplay}
          if(mDisplay<10){mDisplay="0"+mDisplay}
          if(sDisplay<10){sDisplay="0"+sDisplay}
          return hDisplay + " : " + mDisplay + " : " + sDisplay; 
      }

      var startDate = new Date();
      // Do your operations
      var endDate   = new Date("{{$maxThoiGianBaoCao}}");
      var seconds = (endDate.getTime() - startDate.getTime()) / 1000;
      seconds=Math.ceil(seconds);
      
      function countdown() {
        jQuery('#thoi-gian-con-lai').parents('b').html('Hạn báo cáo: <span id="thoi-gian-con-lai" class="text-primary"></span>');
        var i = document.getElementById("thoi-gian-con-lai");
        seconds=seconds-1;
        if(seconds<=0){
          jQuery('#thoi-gian-con-lai').addClass("text-danger").removeClass('text-primary').text("Đã quán hạn báo cáo");
        }else{
          i.innerHTML = secondsToHms(seconds);  
        }
              
      }
      if(seconds>0){
        setInterval(function(){ countdown(); },1000);
      }else{
        jQuery('#thoi-gian-con-lai').addClass("text-danger").removeClass('text-primary').text("Đã quán hạn báo cáo");
      }

     
      

      
    });
  </script>
@endsection

