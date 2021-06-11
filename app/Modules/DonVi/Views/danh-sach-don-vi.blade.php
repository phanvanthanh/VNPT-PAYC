<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <!-- <th></th> -->
            <th>STT #</th>
            <th>Tên đơn vị</th>
            <th>Di động</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Xử lý</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($donVis as $donVi)
            <?php $stt++; ?>
            <tr class="tr-hover tr-small @if($donVi['level']>2) {{'d-none'}} @endif">
                <!-- <td></td> -->
                <td class="text-center">                    
                    {{$stt}}
                </td>
                <td class="t-tree cusor" data-id="{{$donVi['id']}}" data-parent="{{$donVi['parent_id']}}" data-show="1">      
                    @if($donVi['level']>0)
                        @for ($i = 0; $i < $donVi['level']; $i++)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @endfor
                    @endif              
                    @if($donVi['has_child'])
                        <span class="text-primary"><i class="tree-icon fa fa-minus-square-o text-primary"></i>&nbsp;&nbsp;{{$donVi['ten_don_vi']}}</span>
                    @else
                        @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                            <i>{{$donVi['ten_don_vi']}}</i>
                        @else
                            <span class="text-primary">{{$donVi['ten_don_vi']}}</span>
                        @endif

                    @endif
                    
                </td>
                <td>
                    {{$donVi['di_dong']}}
                </td>
                <td>                
                </td>
                <td>
                    <label class="">@if($donVi['state']==1) {{'Đang hoạt động'}} @else {{'Ngừng hoạt động'}} @endif</label>
                </td>
                <td class="text-center">
                    <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                        <i class="icon-list"></i>                          
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-primary btn-sua" data="{{$donVi['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                </p>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-danger btn-xoa" data="{{$donVi['id']}}"><b><i class="icon-basket "></i> Xóa</b>
                                </p>
                            </a>                                 
                        </div>
                    </button>
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">SỬA ĐƠN VỊ</h5>
              {{ csrf_field() }}
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
              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
           </div>
        </div>
     </div>
</div>


<script type="text/javascript" src="{{ asset('public/js/t-tree.js') }}"></script>

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
            getById(_token, id, "{{ route('don-vi-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-don-vi') }}", "{{ route('danh-sach-don-vi') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-don-vi') }}", "{{ route('danh-sach-don-vi') }}", '.load-danh-sach');  
            }
        });
        
    });
</script>


