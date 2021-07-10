@php
use App\DonVi;
use App\ChucDanh;
use App\ChucVu;
use App\UsersDonVi;
@endphp
@if($error=="")    
@php $checkData=0; @endphp
@php if($data){$checkData=1;} @endphp

@if($checkData==1)
<input type="hidden" name="id" class="id" value="{{$data['id']}}">
@endif
@php
$donVis=DonVi::orderBy('ma_cap','asc')->get()->toArray();
$donVis=\Helper::paycTreeResource($donVis,null);

$chucDanhs=ChucDanh::all()->toArray();
$chucVus=ChucVu::all()->toArray();
@endphp
<form action="javascript:void(0);">
    <div class="row">
        <div class="col-4">
            <label for="donVi">Đơn vị</label>
            <select class="form-control donVi" id="donVi" required>
                <option value="0" selected disabled>---Chọn đơn vị--</option>
                <!-- @foreach($donVis as $donVi)
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <option value="{{$donVi['id']}}">{{$donVi['ten_don_vi']}}</option>
                @endif
                @endforeach -->
                @foreach($donVis as $donVi)
                  @if($donVi['id']!=1)
                    <option @if($checkData==1) @if($data->parent_id==$donVi['id']){{'selected="selected"'}}@endif @endif value="{{$donVi['id']}}" @if($donVi['has_child']) disabled @else class="text-primary" @endif>
                      @if($donVi['level']>0)
                          @for ($i = 0; $i < $donVi['level']; $i++)
                              __ 
                          @endfor
                      @endif  
                      {{$donVi['ten_don_vi']}}
                    </option>
                  @endif
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <label for="chucDanh">Chức danh</label>
            <select class="form-control chucDanh" id="chucDanh" required>
                <option value="0" selected disabled>---Chọn chức danh--</option>
                @foreach($chucDanhs as $chucDanh)
                <option value="{{$chucDanh['id']}}">{{$chucDanh['ten_chuc_danh']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <label for="chucVu">Chức vụ</label>
            <select class="form-control chucVu" id="chucVu" required>
                <option value="0" selected disabled>---Chọn chức vụ--</option>
                @foreach($chucVus as $chucVu)
                <option value="{{$chucVu['id']}}">{{$chucVu['ten_chuc_vu']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" style="padding-top: 5px; padding-bottom: 10px">
        <div class="col-4">
            <label for="ngayBatDau">Ngày bắt đầu</label>
            <input class="form-control ngayBatDau" type="date" id="ngayBatDau" required>
        </div>
        <div class="col-4">
            <label for="ngayKetThuc">Ngày kết thúc</label>
            <input class="form-control ngayKetThuc" type="date" id="ngayKetThuc">
        </div>
        <div class="col-4">
            <label for="state">Trạng thái</label>
            <select class="form-control state" id="state">
                <option value="1" @if($checkData==1)  @if($data['state']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
                <option value="0" @if($checkData==1)  @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
            </select>
        </div>
    </div>
</form>
<div class="text-right" style="padding-bottom: 5px">
    <button type="button" class="btn btn-vnpt btn-luu-cau-hinh-don-vi"><i class="icon-check"></i> Thêm</button>
</div>
<div id="divTblUserDonVi">
</div>

@else
{{ csrf_field() }}
<div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif
<script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/t-tree.js"></script>
<script type="text/javascript">
    var _token = $("input[name='_token']").val();
    jQuery(document).ready(function() { 
        $.post('{{route('load-danh-sach-user-donvi')}}',
        {
            "_token":_token,
            idUser:'{{$data['id']}}'
        },
        function(data){
            $('#divTblUserDonVi').empty();
            $('#divTblUserDonVi').html(data);
        });
    });
    $('.btn-luu-cau-hinh-don-vi').click(function() {
            var idDonVi = $('.donVi').val();
            var idUser = $('.id').val();
            var chucDanh = $('.chucDanh').val();
            var chucVu = $('.chucVu').val();
            var ngayBatDau = $('.ngayBatDau').val();
            var ngayKetThuc = $('.ngayKetThuc').val();
            var state = $('.state').val();
            $.post('{{route('luu-user-dv')}}',
            {
                "_token":_token,
                idDonVi:idDonVi,
                idUser:idUser,
                chucDanh:chucDanh,
                chucVu:chucVu,
                ngayBatDau:ngayBatDau,
                ngayKetThuc:ngayKetThuc,
                state:state
            },
            function(data){
                if(data==1){
                    $.post('{{route('load-danh-sach-user-donvi')}}',
                    {
                        "_token":_token,
                        idUser:'{{$data['id']}}'
                    },
                    function(data){
                        $('#divTblUserDonVi').empty();
                        $('#divTblUserDonVi').html(data);
                    });
                }
            });
        });
</script>