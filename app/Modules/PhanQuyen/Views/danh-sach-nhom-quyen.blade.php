<table id="table-danh-sach-nhom-quyen" class="table table-hover table-danh-sach-nhom-quyen">
    <thead>
        <tr class="background-vnpt text-center">
            <th>STT #</th>
            <th>Tên nhóm quyền</th>
            <th>Thuộc đơn vị</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($roles as $role)
            <?php $stt++; ?>
            <tr class="cusor tr-small" data="{{$role['id']}}">
                <td class="text-center">{{$stt}}</td>
                <td class='text-primary'>
                    {{$role['role_name']}}
                </td>
                <td>                    
                    {{$role['ten_don_vi']}}
                </td>                
            </tr>
        @endforeach    
    </tbody>
</table>    


<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('.table-danh-sach-nhom-quyen').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });


        var table = jQuery('.table-danh-sach-nhom-quyen').DataTable({
            lengthChange: true
        });
        var _token=jQuery('form[name="frm-phan-quyen"]').find("input[name='_token']").val();

        jQuery('#table-danh-sach-nhom-quyen tbody tr').on('click',function(){
          jQuery('.table tbody tr').removeClass('active');
          jQuery(this).addClass('active');
          var id=jQuery(this).attr('data');
          jQuery('.role_id').val(id);
          getById(_token, id, "{{ route('phan-quyen/danh-sach-quyen-theo-nhom-quyen-id') }}", ".load-danh-sach-quyen"); // gọi sự kiện lấy dữ liệu theo id
        });
        
    });
</script>


