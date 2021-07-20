<table id="order-listing" class="table table-hover table-striped">
    <thead>
        <tr class="background-vnpt text-center">
            <th>STT #</th>
            <th>Link/Chức năng</th>
            <th>Mô tả</th>
            <th>Người tạo</th>
            <th>Xử lý</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
            $idUser= Auth::id() ? Auth::id() : 0;
        ?>
        @foreach($dichVus as $dichVu)
            @php 
                $dsLinkQuanTri=Helper::layDmLinkQuanTriTheoIdDichVu($dichVu['id']);
            @endphp
            <tr class="tr-hover tr-small active">
                <td></td>
                <td class="font-weight-bold">&nbsp;{{$dichVu['ten_dich_vu']}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($dsLinkQuanTri as $linkQuanTri)
                @php
                    $stt++;
                @endphp
                <tr class="tr-hover tr-small">
                    <td class="text-center">{{$stt}}</td>
                    <td class='btn-sua text-primary' data="{{$linkQuanTri['id']}}">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-link text-primary"></i>&nbsp;&nbsp;<u>{{$linkQuanTri['link_chuc_nang']}}</u>
                    </td>
                    <td>
                        @php echo nl2br($linkQuanTri['mo_ta']); @endphp
                    </td>
                    <td class="text-success">
                        {{$linkQuanTri['name']}}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                            <i class="icon-list"></i>                          
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <a class="dropdown-item preview-item">
                                    <p class="mb-0 font-weight-normal float-left text-primary btn-sua" data="{{$linkQuanTri['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                    </p>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <p class="mb-0 font-weight-normal float-left text-danger btn-xoa" data="{{$linkQuanTri['id']}}"><b><i class="icon-basket "></i> Xóa</b>
                                    </p>
                                </a>                                 
                            </div>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">CẬP NHẬT DANH MỤC</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body card">
                <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
                    {{ csrf_field() }}
                </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-vnpt btn-cap-nhat"><i class="icon-check"></i> Cập nhật</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
           </div>
        </div>
     </div>
</div>




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


        var _token=jQuery('#modal-cap-nhat').find("input[name='_token']").val();
        var table = jQuery('#order-listing').DataTable({
            lengthChange: true
        });


        /*Sự kiện bấm vào dòng cần sửa*/
        jQuery('.btn-sua').on('click',function(){            
            var id=jQuery(this).attr("data"); // lấy id
            getById(_token, id, "{{ route('dm-link-quan-tri-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-dm-link-quan-tri') }}", "{{ route('danh-sach-dm-link-quan-tri') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-dm-link-quan-tri') }}", "{{ route('danh-sach-dm-link-quan-tri') }}", '.load-danh-sach');  
            }
        });
        
    });
</script>


