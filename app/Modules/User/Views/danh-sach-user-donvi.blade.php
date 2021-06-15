@php
use App\UsersDonVi;
use App\DonVi;
use App\ChucDanh;
use App\ChucVu;
$userDV = UsersDonVi::where('id_user','=',$idUser)->get()->toArray();
@endphp
<table id="tblUserDonVi" class="table table-hover table-striped">
    <thead>
        <tr class="background-vnpt text-center">
            <th>STT</th>
            <th>Đơn vị</th>
            <th>Chức danh</th>
            <th>Chức vụ</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Trạng thái</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>          
        <?php 
        $stt=0;
        ?>
        @foreach($userDV as $userdv)
        @php 
        $stt++; 
        $tenDonVi = DonVi::where('id','=',$userdv['id_don_vi'])->first()->ten_don_vi;
        $tenChucDanh = ChucDanh::where('id','=',$userdv['id_chuc_danh'])->first()->ten_chuc_danh;
        $tenChucVu = ChucVu::where('id','=',$userdv['id_chuc_vu'])->first()->ten_chuc_vu;
        $ngayBatDau = null;
        $ngayKetThuc = null;
        if($userdv['ngay_bat_dau_cong_tac'] != null)
            $ngayBatDau = date('d/m/Y',strtotime($userdv['ngay_bat_dau_cong_tac']));
        if($userdv['ngay_ket_thuc_cong_tac'] != null)
            $ngayKetThuc = date('d/m/Y',strtotime($userdv['ngay_ket_thuc_cong_tac']));
        if($userdv['state']==1) $trangThai='Hoạt động';
        else $trangThai='Ngừng hoạt động';
        @endphp
        <tr class="tr-hover tr-small">
            <td class="text-center">{{$stt}}</td>
            <td class='text-primary'>{{$tenDonVi}}</td>
            <td>{{$tenChucDanh}}</td>
            <td>{{$tenChucVu}}</td>
            <td class="text-center">{{$ngayBatDau}}</td>
            <td class="text-center">{{$ngayKetThuc}}</td>
            <td class="text-center">{{$trangThai}}</td>
            <td class="text-center"><p class="mb-0 font-weight-normal text-danger btn-xoa" data-id="{{$userdv['id']}}"><b><i class="icon-trash"></i></b></p></td>                   
        </tr>
        @endforeach    
    </tbody>
</table>
<script type="text/javascript">
    var _token = $("input[name='_token']").val();
     $('.table').dataTable({
            aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
    $(".btn-xoa").on('click', function(event){
        if (!confirm('Bạn muốn xóa?')) return false;
        var idUserDonVi = $(this).attr("data-id");
        var idUser = $('.id').val();
        $.post('{{route('xoa-user-donvi')}}',
        {
            "_token":_token,
            idUserDonVi:idUserDonVi
        },
        function(data){
            if(data!=1){
                alert('Lỗi! Không thể xóa');
            }
            else{
                $.post('{{route('load-danh-sach-user-donvi')}}',
                {
                    "_token":_token,
                    idUser:idUser
                },
                function(data2){
                    $('#divTblUserDonVi').empty();
                    $('#divTblUserDonVi').html(data2);
                });
            }
        });
    });
</script>