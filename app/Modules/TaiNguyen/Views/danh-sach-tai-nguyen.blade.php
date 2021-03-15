<table id="order-listing" class="table table-hover">
    <thead>
        <tr class="background-vnpt text-center">
            <th>STT</th>
            <th>Tên chức năng</th>
            <th>URL</th>
            <th>Phương thức</th>
            <th>Icon</th>
            <th>Sắp xếp</th>
            <th>State</th>
            <th>Xử lý</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($resources as $resource)
            @if($resource['show_menu']<3)
                <?php $stt++; ?>
                <tr class="tr-hover tr-small t-tree cusor" data-id="{{$resource['id']}}" data-parent="{{$resource['parent_id']}}" data-show="1">
                    <td class="text-center">{{$stt}}</td>
                    <td>
                        <!-- @if($resource['level']>1)
                            {{"|"}}
                            @for ($i = 1; $i < $resource['level']; $i++)
                                {{"____ "}}
                            @endfor
                        @endif {{$resource['ten_hien_thi']}} -->



                        @if($resource['level']>0)
                            @for ($i = 0; $i < $resource['level']; $i++)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endfor
                        @endif              
                        @if($resource['has_child'])
                            <span class="text-primary"><i class="tree-icon fa fa-minus-square-o text-primary"></i>&nbsp;&nbsp;{{$resource['ten_hien_thi']}}</span>
                        @else
                            <i>{{$resource['ten_hien_thi']}}</i>
                        @endif
                    </td>
                    <td>{{$resource['uri']}}</td>
                    <td>{{$resource['method']}}</td>
                    <td class="text-center"><?php echo $resource['icon']; ?></td>
                    <td class="text-center">{{$resource['order']}}</td>
                    <td class="text-center">
                        <label class=" @if($resource['show_menu']==1) {{'text-primary'}} @else {{'text-danger'}} @endif">@if($resource['show_menu']==1) {{'Show'}} @else {{'Hide'}} @endif</label>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                            <i class="icon-list"></i>                          
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <a class="dropdown-item preview-item">
                                    <p class="mb-0 font-weight-normal float-left text-primary sua-tai-nguyen" data="{{$resource['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                    </p>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <p class="mb-0 font-weight-normal float-left text-danger btn-xoa-tai-nguyen" data="{{$resource['id']}}"><b><i class="icon-basket "></i> Xóa</b>
                                    </p>
                                </a>                                 
                            </div>
                        </button>
                    </td>
                </tr>
            @endif
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">SỬA TÀI NGUYÊN</h5>
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
        jQuery('.sua-tai-nguyen').on('click',function(){            
            var id=jQuery(this).attr("data"); // lấy id
            getById(_token, id, "{{ route('tai-nguyen-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-tai-nguyen') }}", "{{ route('danh-sach-tai-nguyen') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa-tai-nguyen').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-tai-nguyen') }}", "{{ route('danh-sach-tai-nguyen') }}", '.load-danh-sach');  
            }
        });
        
    });
</script>


