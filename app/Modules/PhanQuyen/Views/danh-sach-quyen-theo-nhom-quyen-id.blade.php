<table id="table-danh-sach-tai-nguyen" class="table table-hover table-danh-sach-tai-nguyen">
    <thead>
        <tr class="background-vnpt text-center">
            <th>STT #</th>
            <th>Tên chức năng</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($resources as $resource)
                <?php $stt++; ?>
                <tr class="tr-small">
                    <td class="text-center">
                        <div class="icheck-square">
                            <input type="checkbox" name="resource[]" class="checkbox-resource" resource="{{$resource['id']}}"
                            @if(count($rules)>0 && isset($rules[$resource['id']])) checked="true" @endif
                            >
                        </div>
                    </td>
                    <td class='text-primary'>
                        @php echo $resource['icon']; @endphp &nbsp;&nbsp;{{$resource['ten_hien_thi']}}
                    </td>
                </tr>
        @endforeach    
    </tbody>
</table>             




<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('.table-danh-sach-tai-nguyen').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });


        var table = jQuery('.table-danh-sach-tai-nguyen').DataTable({
            lengthChange: true
        });

        var _token=jQuery('form[name="frm-phan-quyen"]').find("input[name='_token']").val();

        jQuery('.checkbox-resource').on('click',function(){
            var roleId=jQuery('#role_id').val();
            var resourceId=jQuery(this).attr('resource');
            phanQuyen(_token, roleId, resourceId, "{{ route('phan-quyen-post') }}", ".load-danh-sach-quyen"); // gọi sự kiện lấy dữ liệu theo id
        });


        
    });
</script>


