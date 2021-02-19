<div class="col-12"> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-3">
                <div class="card-body" id='xu-ly-to-do' style="padding: 0px">
                    {{ csrf_field() }}
                </div>
                <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse todo-list">
                        @foreach($toDos as $toDo)
                        <li draggable="true" @if($toDo['trang_thai']==1) class="draggable completed" @else class="draggable" @endif>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="checkbox" type="checkbox" data-id="{{$toDo['id']}}" @if($toDo['trang_thai']==1) checked="checked" @endif>
                                    {{$toDo['noi_dung']}}
                                </label>               
                            </div>
                            <div style="padding-left: 20px">
                                <small class="text-muted">Ngày tạo: {{$toDo['ngay_tao']}}<br>HXL: {{$toDo['han_xu_ly']}}</small>
                            </div>
                            <!-- <i class="remove mdi mdi-close-circle-outline"></i> -->
                            <i class="remove"></i>
                            <button class="btn btn-vnpt" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-list"></i>                          
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                    <a class="dropdown-item preview-item">
                                        <p class="mb-0 font-weight-normal float-right text-primary btn-sua" data="{{$toDo['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                        </p>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <p class="mb-0 font-weight-normal float-right text-danger btn-xoa" data="{{$toDo['id']}}"><b><i class="icon-basket "></i> Xóa</b>
                                        </p>
                                    </a>                                 
                                </div>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">SỬA TO DO</h5>
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
            getById(_token, id, "{{ route('to-do-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-to-do') }}", "{{ route('danh-sach-to-do') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-to-do') }}", "{{ route('danh-sach-to-do') }}", '.load-danh-sach');  
            }
        });
        
        $('.checkbox').click(function() {
            var _token=jQuery('#xu-ly-to-do').find("input[name='_token']").val();
            if ($(this).is(':checked')) {
                var id = $(this).attr("data-id");
                $.post('{{route('check-to-do')}}',
                {
                    "_token":_token,
                    id:id
                });
            }
            else{
                var id = $(this).attr("data-id");
                $.post('{{route('uncheck-to-do')}}',
                {
                    "_token":_token,
                    id:id
                });
            }
        });
    });
</script>


