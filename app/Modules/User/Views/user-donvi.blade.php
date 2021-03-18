@php
use App\DonVi;
@endphp
@if($error=="")    
@php $checkData=0; @endphp
@php if($data){$checkData=1;} @endphp
{{ csrf_field() }}
@if($checkData==1)
<input type="hidden" name="id" class="id" value="{{$data['id']}}">
@endif
@php
$donVis=DonVi::orderBy('ma_cap','asc')->get()->toArray();
$donVis=\Helper::paycTreeResource($donVis,null);
@endphp
<table id="order-listing" class="table table-hover" data-ordering="false">
    <thead>
        <tr class="background-vnpt text-center">
            <th>Tên đơn vị</th>
            <th>Chức danh</th>
            <th>Chức vụ</th>
            <th>Cấp</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>                       

        <?php 
        $stt=0;
        ?>
        @foreach($donVis as $donVi)
        <?php $stt++; ?>
        <tr class="tr-hover tr-small t-tree cusor" data-id="{{$donVi['id']}}" data-parent="{{$donVi['parent_id']}}" data-show="1">
            <td>      
                @if($donVi['level']>0)
                @for ($i = 0; $i < $donVi['level']; $i++)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @endfor
                @endif              
                @if($donVi['has_child'])
                <span class="text-primary"><i class="tree-icon fa fa-minus-square-o text-primary"></i>&nbsp;&nbsp;{{$donVi['ten_don_vi']}}</span>
                @else
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <input type="checkbox" id="{{$donVi['id']}}">
                <i>{{$donVi['ten_don_vi']}}</i>
                @else
                <span class="text-primary">{{$donVi['ten_don_vi']}}</span>
                @endif

                @endif

            </td>
            <td>
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <input type="text" class="form-control" id="">
                @endif
            </td>
            <td>
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <input type="text" class="form-control" id="">
                @endif
            </td>
            <td>
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <input type="text" class="form-control" id="">
                @endif
            </td>
            <td>
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <input type="date" class="form-control" id="">
                @endif
            </td>
            <td>
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                <input type="date" class="form-control" id="">
                @endif
            </td>
            <td>
                @if($donVi['ma_cap']==null || $donVi['ma_cap']=='')
                    <select class="form-control state" name="state">
                        <option value="1" @if($checkData==1)  @if($data['state']==1){{'selected="selected"'}}@endif @endif>Hoạt động</option>
                        <option value="0" @if($checkData==1)  @if($data['state']==0){{'selected="selected"'}}@endif @endif>Ngừng hoạt động</option>
                    </select>
                @endif
            </td>
        </tr>
        @endforeach    
    </tbody>
</table> 

@else
{{ csrf_field() }}
<div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif
<script type="text/javascript" src="{{ asset('public/js/t-tree.js') }}"></script>



