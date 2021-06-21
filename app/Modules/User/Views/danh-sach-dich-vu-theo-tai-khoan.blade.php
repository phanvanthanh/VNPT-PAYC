<table class="table table-hover table-striped tbl-danh-sach-dich-vu-theo-tai-khoan" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <!-- <th></th> -->
            <th>STT #</th>
            <th>Tên dịch vụ</th>
            <th>Từ ngày</th>
            <th>Đến ngày</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>         
        @php $stt=0; @endphp              
        @foreach($dichVus as $dichVu)
            @php $stt++; @endphp
            <tr>
                <td class="text-center">
                    {{$stt}}
                </td>
                <td class="text-primary">
                    @if ($dichVu['ten_dich_vu']!='')
                        {{$dichVu['ten_dich_vu']}}
                    @else
                        {{'Xem báo cáo'}}
                    @endif
                </td>
                <td>
                    {{$dichVu['tu_ngay']}}
                </td>
                <td>
                    {{$dichVu['den_ngay']}}
                </td>
                <td class="text-center">
                    <p class="mb-0 font-weight-normal text-danger btn-xoa" data="{{$dichVu['id']}}"><b><i class="fa fa-times-circle-o"></i></b>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>             

<script type="text/javascript" src="{{ asset('public/js/t-tree.js') }}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('.tbl-danh-sach-dich-vu-theo-tai-khoan').dataTable({
            
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
        var table = jQuery('.tbl-danh-sach-dich-vu-theo-tai-khoan').DataTable({
            lengthChange: true
        });


        var _token="{{ csrf_token() }}";
        


        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoaVaRefreshDuLieuTheoId(_token, id, "{{ route('xoa-user-dich-vu') }}", {{$userId}}, "{{ route('danh-sach-dich-vu-theo-tai-khoan') }}", '.load-danh-sach-dich-vu-theo-user'); 
                //getById(_token, {{$userId}}, "{{ route('danh-sach-dich-vu-theo-tai-khoan') }}", '.load-danh-sach-dich-vu-theo-user'); 
            }
        });
        
    });
</script>


