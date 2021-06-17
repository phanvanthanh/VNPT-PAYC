<form class="frm-phan-quyen-bao-cao-tuan" id="frm-phan-quyen-bao-cao-tuan">
    {{ csrf_field() }}
    <input type="hidden" name="user_id" id="user_id" value="{{$userId}}">
    <input type="hidden" id="dich-vu" name="dich_vu">
    <input type="hidden" id="id-dm-quyen-bao-cao" name="id_dm_quyen_bao_cao">
    <input type="hidden" id="check" name="check" value="0">
</form>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th></th>
            <th class="text-center">STT #</th>
            <th>Tên quyền</th>
            <th>Dịch vụ</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($dmQuyenBaoCaos as $quyenBaoCao)
            <?php $stt++; ?>            
            <tr class="cusor tr-small">
                <td class="text-center"> 
                    <input type="checkbox" class="check-permision" id="id-dm-quyen-bao-cao-{{$quyenBaoCao['id']}}" data="{{$quyenBaoCao['id']}}" @if(isset($data[$quyenBaoCao['id']])) checked="checked" @endif>
                </td>
                <td class="text-center">{{$stt}}</td>
                <td class='text-primary'>
                    {{$quyenBaoCao['ten_nhom_quyen']}}
                </td>
                <td>
                    <input class="form-control dich-vu" id="dich-vu-{{$quyenBaoCao['id']}}" type="Text" data="{{$quyenBaoCao['id']}}" placeholder="Nhập dịch vụ báo cáo" value="@if(isset($data[$quyenBaoCao['id']])) {{$data[$quyenBaoCao['id']]['dich_vu']}} @endif">
                </td>   
            </tr>
        
        @endforeach    
    </tbody>
</table>
<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.check-permision').on('change',function(){
            if(jQuery(this).is(":checked")){
                jQuery('#check').val(1);
            }else{
                jQuery('#check').val(0);
            }
            var idDmQuyenBaoCao=jQuery(this).attr('data');
            var idDichVu='#dich-vu-'+idDmQuyenBaoCao;
            var dichVu=jQuery(idDichVu).val();
            var _token=jQuery('#frm-phan-quyen-bao-cao-tuan').find("input[name='_token']").val();
            var form=jQuery('#frm-phan-quyen-bao-cao-tuan');
            var userId=jQuery('#user_id').val();
            jQuery('#dich-vu').val(dichVu);
            jQuery('#id-dm-quyen-bao-cao').val(idDmQuyenBaoCao);
            capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('update-permision-report-user') }}", userId, "{{ route('user-permison-report-single') }}", '.frm-cau-hinh-quyen-bao-cao',false);
            return false;
        });

        jQuery('.dich-vu').on("keypress", function(e) {
            if (e.keyCode == 13) {

                var dichVu=jQuery(this).val();
                var idDmQuyenBaoCao=jQuery(this).attr('data');
                var idCheckBox='#id-dm-quyen-bao-cao-'+idDmQuyenBaoCao;
                if(jQuery(idCheckBox).is(":checked")){
                    jQuery('#check').val(1);
                }else{
                    jQuery('#check').val(0);
                }
                var _token=jQuery('#frm-phan-quyen-bao-cao-tuan').find("input[name='_token']").val();
                var form=jQuery('#frm-phan-quyen-bao-cao-tuan');
                var userId=jQuery('#user_id').val();
                jQuery('#dich-vu').val(dichVu);
                jQuery('#id-dm-quyen-bao-cao').val(idDmQuyenBaoCao);
                capNhatVaRefreshDuLieuTheoId(_token, form, "{{ route('update-permision-report-user') }}", userId, "{{ route('user-permison-report-single') }}", '.frm-cau-hinh-quyen-bao-cao',false);
                return false;
            }
        });
    });
</script>
