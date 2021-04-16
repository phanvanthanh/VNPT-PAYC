    <table id="order-listing" class="table table-hover">
        <thead>
            <tr class="background-vnpt text-center">
                <th>STT #</th>
                <th>Họ tên</th>
                <th>Tên đăng nhập</th>
                <th>Di động</th>
                <th>Nhóm xử lý</th>
                <th>Đơn vị</th>
                <th>Dịch vụ</th>
                <th>Nhóm quyền</th>
                <th>Trạng thái</th>
                <th>Xử lý</th>
            </tr>
        </thead>
        <tbody>          
            <?php 
            $stt=0;
            ?>
            @foreach($users as $user)
            <?php $stt++; ?>
            <tr class="tr-hover tr-small">
                <td class="text-center">{{$stt}}</td>
                <td class='text-primary'>
                    {{$user['name']}}
                </td>
                <td>                    
                    {{$user['email']}}
                </td>
                <td class="text-center">                    
                    {{$user['di_dong']}}
                </td>
                <td>
                    @php
                        $donVis=Helper::layDanhSachDonViTheoUserId($user['id']);
                        foreach($donVis as $donVi){
                            echo $donVi['ten_nhom_chuc_vu'].'<br>';
                        }
                    @endphp
                </td>
                <td>
                    @php
                        foreach($donVis as $donVi){
                            echo $donVi['ten_don_vi'].' - '.$donVi['ten_don_vi_cha'].'<br>';
                        }
                    @endphp
                </td>
                <td>
                    @php
                        $dichVus=Helper::layDanhSachDichVuTheoUserId($user['id']);
                        foreach($dichVus as $dichVu){
                            echo $dichVu['ten_dich_vu'].'; ';
                        }
                    @endphp
                </td>
                <td>
                    @php
                        $roles=Helper::layDanhSachNhomQuyenTheoUserId($user['id']);
                        foreach($roles as $role){
                            echo $role['role_name'].'<br>';
                        }
                    @endphp
                </td>
                <td class="text-center">
                    <label class=" @if($user['state']==1) {{'text-primary'}} @else {{'text-danger'}} @endif">@if($user['state']==1) {{'Đang hoạt động'}} @else {{'Ngừng hoạt động'}} @endif</label>
                </td>
                <td class="text-center">
                    <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                        <i class="icon-list"></i>                          
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-primary btn-cau-hinh-don-vi" data="{{$user['id']}}"><b><i class="fa fa-gear"></i> Cấu hình đơn vị</b>
                                </p>
                            </a>
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-primary btn-cau-hinh-dich-vu" data="{{$user['id']}}"><b><i class="fa fa-gear"></i> Cấu hình dịch vụ</b>
                                </p>
                            </a>
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-primary btn-phan-quyen-can-bo" data="{{$user['id']}}"><b><i class="fa fa-cogs"></i> Phân quyền</b>
                                </p>
                            </a>
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-primary btn-sua" data="{{$user['id']}}"><b><i class="icon-wrench"></i> Sửa</b>
                                </p>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <p class="mb-0 font-weight-normal float-left text-danger btn-xoa" data="{{$user['id']}}"><b><i class="icon-basket "></i> Xóa</b>
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
                  <h5 class="modal-title">SỬA NHÓM QUYỀN</h5>
                  
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
              <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cau-hinh-don-vi" tabindex="-1" role="dialog" aria-labelledby="modal-cau-hinh-don-vi" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header background-vnpt">
                <h5 class="modal-title">CẤU HÌNH ĐƠN VỊ CHO CÁN BỘ</h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body card">
            <form class="forms-sample frm-cau-hinh-don-vi" id="frm-cau-hinh-don-vi" name="frm-cau-hinh-don-vi">
                {{ csrf_field() }}
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-phan-quyen-can-bo" tabindex="-1" role="dialog" aria-labelledby="modal-phan-quyen-can-bo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header background-vnpt">
                <h5 class="modal-title">PHÂN NHÓM QUYỀN TÀI KHOẢN</h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body card">
            <form class="forms-sample frm-phan-quyen-can-bo" id="frm-phan-quyen-can-bo" name="frm-phan-quyen-can-bo">
                {{ csrf_field() }}
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cau-hinh-dich-vu" tabindex="-1" role="dialog" aria-labelledby="modal-cau-hinh-dich-vu" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header background-vnpt">
                <h5 class="modal-title">CẤU HÌNH DỊCH VỤ CHO TÀI KHOẢN</h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body card">
            <form class="forms-sample frm-cau-hinh-dich-vu" id="frm-cau-hinh-dich-vu" name="frm-cau-hinh-dich-vu">
                {{ csrf_field() }}
            </form>
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
            getById(_token, id, "{{ route('user-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-user') }}", "{{ route('danh-sach-user') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút xóa*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-user') }}", "{{ route('danh-sach-user') }}", '.load-danh-sach');  
            }
        });
        
        jQuery('.btn-cau-hinh-don-vi').on('click',function(){ 
            var id=jQuery(this).attr("data");
            getById(_token, id, "{{ route('user-don-vi-single') }}", ".frm-cau-hinh-don-vi");
            $('#modal-cau-hinh-don-vi').modal('show');
        });

        jQuery('.btn-phan-quyen-can-bo').on('click',function(){ 
            var id=jQuery(this).attr("data");
            getById(_token, id, "{{ route('user-role-single') }}", ".frm-phan-quyen-can-bo");
            $('#modal-phan-quyen-can-bo').modal('show');
        });

        $('#modal-phan-quyen-can-bo').on('hide.bs.modal', function () {
            location.reload();
        });
        $('#modal-cau-hinh-don-vi').on('hide.bs.modal', function () {
            location.reload();
        });

        jQuery('.btn-cau-hinh-dich-vu').on('click',function(){ 
            var id=jQuery(this).attr("data");
            getById(_token, id, "{{ route('user-dich-vu-single') }}", ".frm-cau-hinh-dich-vu");
            $('#modal-cau-hinh-dich-vu').modal('show');
        });

        $('#modal-cau-hinh-dich-vu').on('hide.bs.modal', function () {
            location.reload();
        });
    });
</script>


