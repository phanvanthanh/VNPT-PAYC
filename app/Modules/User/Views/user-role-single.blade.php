<form action="javascript:void(0);" class="frm-phan-quyen" name="frm-phan-quyen">
    {{ csrf_field() }}
    <input type="hidden" name="user_id" value="{{$idUser}}">
</form>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th></th>
            <th class="text-center">STT #</th>
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
            <tr class="cusor tr-small">
                <td class="text-center"> 
                    <input type="checkbox" name="rol_id[]" class="checkbox-role" data="{{$role['id']}}"
                            @if(isset($data[$role['id']])) checked="true" @endif
                            >
                </td>
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
<script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/js/t-check-child.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var _token=jQuery('form[name="frm-phan-quyen"]').find("input[name='_token']").val();
        console.log(_token);
        jQuery('.checkbox-role').on('click',function(){
            var userId=jQuery('form[name="frm-phan-quyen"]').find("input[name='user_id']").val();;
            var roleId=jQuery(this).attr('data');
            phanNhomQuyen(_token, roleId, userId, "{{ route('phan-quyen-user-role') }}"); // gọi sự kiện lấy dữ liệu theo id
        });
    });
</script>
