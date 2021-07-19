@extends('layouts.script-layout')
<div class="row">
    <div class="col-12 text-right">
        <div class="badge badge-primary badge-fw">Chưa xử lý - Trong hạn</div>
        <div class="badge badge-danger badge-fw">Chưa xử lý - Quá hạn</div>
        <div class="badge badge-success badge-fw">Đã xử lý - Đúng hạn</div>
        <div class="badge badge-warning badge-fw">Đã xử lý - Quá hạn</div>
    </div>
</div>

<table class="table table-bordered" style="width:100%;">
    <thead>
    <tr class="text-center background-vnpt">
            <th style="width: 20%;">Thứ</th>
            <th style="width: 40%;">Buổi sáng</th>
            <th style="width: 40%;">Buổi chiều</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 40%;"></td>
            <td style="width: 40%;"></td>
        </tr>
    @php
        $stt=0;
        $arrThu=array(
            0=>'Thứ 2',
            1=>'Thứ 3',
            2=>'Thứ 4',
            3=>'Thứ 5',
            4=>'Thứ 6',
            5=>'Thứ 7',
            6=>'Chủ nhật'
        );
    @endphp
    @foreach ($dateOfWeek as $i => $date)
    @php
        $toDoList=\Helper::layToDoListTheoNgay($userId, $date);
    @endphp
        <tr style="width: 100%;">
            <td class="text-center" style="width: 20%;">
                <div class="font-weight-bold">{{$arrThu[$i]}} </div>
                {{$date}}
            </td>
            <td style="max-width:40%;">
                @if (isset($toDoList['sang']))
                    @php $stt=0; @endphp
                    @foreach ($toDoList['sang'] as $toDo)
                        @php 
                            $stt++; 
                            $trangThai=Helper::kiemTraTrangThaiXuLy($toDo['han_xu_ly'], $toDo['ngay_hoan_thanh']);
                        @endphp
                        <div class="text-left badge badge-{{$trangThai}} badge-fw" style="white-space: nowrap; max-width: 500px; overflow: hidden; text-overflow: ellipsis;">ToDo - {{$toDo['noi_dung']}}</div>
                        
                        @if ($stt<count($toDoList['chieu']))
                            <br>
                        @endif
                    @endforeach
                @endif
                    
            </td>
            <td style="max-width: 40%;">
                @if (isset($toDoList['chieu']))
                    @php $stt=0; @endphp
                    @foreach ($toDoList['chieu'] as $toDo)
                        @php 
                            $stt++; 
                            $trangThai=Helper::kiemTraTrangThaiXuLy($toDo['han_xu_ly'], $toDo['ngay_hoan_thanh']);
                        @endphp
                        <div class="text-left badge badge-{{$trangThai}} badge-fw" style="white-space: nowrap; max-width: 500px; overflow: hidden; text-overflow: ellipsis;">ToDo - {{$toDo['noi_dung']}}</div>
                        @if ($stt<count($toDoList['chieu']))
                            <br>
                        @endif
                    @endforeach
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


<script type="text/javascript">
    jQuery(document).ready(function() {
        
    });

</script>


