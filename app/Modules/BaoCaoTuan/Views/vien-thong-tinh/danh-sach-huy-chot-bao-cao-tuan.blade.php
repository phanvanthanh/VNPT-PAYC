@php
  $week=\Helper::layTuanHienTai();
  $year=date('Y');
@endphp
<form class="forms-sample frm-chot-so-lieu-bao-cao-tuan" id="frm-chot-so-lieu-bao-cao-tuan" name="frm-chot-so-lieu-bao-cao-tuan">
    {{ csrf_field() }}
</form>
<table id="order-listing" class="table table-hover table-striped">
    <thead>
        <tr class="background-vnpt text-center">
            <th class="text-center">STT #</th>
            <th class="text-center">Đơn vị</th>
            <th class="text-center">Tuần</th>      
            <th class="text-center">Thời gian chốt số liệu</th>        
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Hủy chốt</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($dsChotSoLieu as $chotSoLieu)
            <?php $stt++; ?>
            <tr class="tr-hover tr-small">
                <td class="text-center">{{$stt}}</td>
                <td class='text-primary btn-sua' data="{{$chotSoLieu['id']}}">
                  {{$chotSoLieu['ma_dinh_danh']}} / {{$chotSoLieu['ma_don_vi']}}
                </td>
                <td>                    
                    {{$chotSoLieu['tuan']}}/{{$chotSoLieu['nam']}}
                </td>
                <td class="text-center"> 
                @php
                  $ngayGioChot = strtotime($chotSoLieu['thoi_gian_chot_so_lieu']);
                  $namChot=date('Y',$ngayGioChot);
                  $ngayGioChot = date('d/m/Y H:i:s',$ngayGioChot);
                  if($namChot>=2021){
                    echo $ngayGioChot;
                  }
                    
                @endphp 

                </td>
                <td>
                    <label class=" @if($chotSoLieu['trang_thai']>0) {{'text-primary'}} @else {{'text-danger'}} @endif">@if($chotSoLieu['trang_thai']>0) {{'Đã chốt số liệu'}} @else {{'Chưa chốt số liệu'}} @endif</label>
                </td>
                <td class="text-center cusor btn-xoa"  data="{{$chotSoLieu['id']}}">
                  @if ($chotSoLieu['trang_thai']>0)
                    <i class="fa fa-window-close-o text-danger cusor" data="{{$chotSoLieu['id']}}"></i>
                  @endif
                    
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>             






<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('.table').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });


        
        var table = jQuery('#order-listing').DataTable({
            lengthChange: true
        });

        huyChotSoLieu=function(id){  
          var _token=jQuery('#frm-chot-so-lieu-bao-cao-tuan').find("input[name='_token']").val();
          var xhr1;  
          if(xhr1 && xhr1.readyState != 4){
              xhr1.abort(); //huy lenh ajax truoc do
          }
          xhr1 = jQuery.ajax({
            url: "{{ route('vien-thong-tinh-btn-huy-chot-bao-cao-tuan') }}",
            type:'POST',
            dataType:'json',
            cache: false,
            data:{
                "_token":_token,
                'id':id,
            },
            complete: function(xhr, textStatus) {
              //called when complete
            },
            success: function(data, textStatus, xhr) {
              $(".error-mode").empty();
              if(data.error==""){
                var idTuan=jQuery('#id_tuan').val();
                loadTableById2(_token, idTuan, "{{ route('vien-thong-tinh-danh-sach-huy-chot-bao-cao-tuan') }}", '.load-danh-sach-bao-cao-tong-hop',false);  
                errorLoader(".error-mode",'');          
              }else{
                errorLoader(".error-mode",data.error);
              }
            },
            error: function(xhr, textStatus, errorThrown) {
              //called when there is an error
            }
          });
        }

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){          
          var result = confirm("Bạn thật sự đã hoàn tất báo cáo và muốn gửi báo cáo lên cấp trên?  Nếu đồng ý bạn sẽ không thể chỉnh sửa được nữa.");
          if (result) {
            var id=jQuery(this).attr("data"); // lấy id
            huyChotSoLieu(id);
          }
        });
        
    });
</script>


