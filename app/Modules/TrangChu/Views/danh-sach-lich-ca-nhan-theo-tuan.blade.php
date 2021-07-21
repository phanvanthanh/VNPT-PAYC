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

        $arrVaiTroPakn=array(
            0   => 'Xem',
            1   => 'XLC',
            2   => 'PHXL',
        );
    @endphp
    @foreach ($dateOfWeek as $i => $date)
    @php
        $toDoList=\Helper::layToDoListTheoNgay($userId, $date);
        $dsPakn=\Helper::getDanhSachPaycChoXuLyTheoIdUserVaNgay($userId, $date);
    @endphp
        <tr style="width: 100%;">
            <td class="text-center" style="width: 20%;">
                <div class="font-weight-bold">{{$arrThu[$i]}} </div>
                {{$date}}
            </td>
            <td style="max-width:40%;" class="width-t">
                @if (isset($dsPakn['sang']))
                    @php $stt=0; @endphp
                    @foreach ($dsPakn['sang'] as $pakn)
                        @php 
                            $stt++; 
                            $trangThai=Helper::kiemTraTrangThaiXuLy($pakn['han_xu_ly'], $pakn['ngay_hoan_tat']);
                        @endphp
                        <a href="{{route('chi-tiet-payc')}}?id={{$pakn['id']}}" target="_blank"><div class="text-left badge badge-{{$trangThai}} badge-fw badge-t" style="white-space: nowrap; max-width: 500px; overflow: hidden; text-overflow: ellipsis;">
                            {{$arrVaiTroPakn[$pakn['vai_tro']]}} - [{{$pakn['so_phieu']}}] {{$pakn['tieu_de']}}
                            </div>
                        </a>
                        
                        @if ($stt<count($dsPakn['sang']))
                            <br>
                        @endif
                    @endforeach
                @endif
                @if (isset($toDoList['sang']))
                    @php $stt=0; @endphp
                    @foreach ($toDoList['sang'] as $toDo)
                        @php 
                            $stt++; 
                            $trangThai=Helper::kiemTraTrangThaiXuLy($toDo['han_xu_ly'], $toDo['ngay_hoan_thanh']);
                        @endphp
                        <a href="{{route('to-do')}}?id={{$toDo['id']}}" target="_blank"><div class="text-left badge badge-{{$trangThai}} badge-fw badge-t" style="white-space: nowrap; max-width: 500px; overflow: hidden; text-overflow: ellipsis;">ToDo - {{$toDo['noi_dung']}}</div></a>
                        
                        @if ($stt<count($toDoList['sang']))
                            <br>
                        @endif
                    @endforeach
                @endif
                    
            </td>
            <td style="max-width: 40%;" class="width-t">
                @if (isset($dsPakn['chieu']))
                    @php $stt=0; @endphp
                    @foreach ($dsPakn['chieu'] as $pakn)
                        @php 
                            $stt++; 
                            $trangThai=Helper::kiemTraTrangThaiXuLy($pakn['han_xu_ly'], $pakn['ngay_hoan_tat']);
                        @endphp
                        <a href="{{route('chi-tiet-payc')}}?id={{$pakn['id']}}" target="_blank"><div class="text-left badge badge-{{$trangThai}} badge-fw badge-t" style="white-space: nowrap; max-width: 500px; overflow: hidden; text-overflow: ellipsis;">
                            {{$arrVaiTroPakn[$pakn['vai_tro']]}} - [{{$pakn['so_phieu']}}] {{$pakn['tieu_de']}}
                            </div>
                        </a>
                        
                        @if ($stt<count($dsPakn['chieu']))
                            <br>
                        @endif
                    @endforeach
                @endif
                @if (isset($toDoList['chieu']))
                    @php $stt=0; @endphp
                    @foreach ($toDoList['chieu'] as $toDo)
                        @php 
                            $stt++; 
                            $trangThai=Helper::kiemTraTrangThaiXuLy($toDo['han_xu_ly'], $toDo['ngay_hoan_thanh']);
                        @endphp
                        <a href="{{route('to-do')}}?id={{$toDo['id']}}" target="_blank"><div class="text-left badge badge-{{$trangThai}} badge-fw badge-t" style="white-space: nowrap; max-width: 500px; overflow: hidden; text-overflow: ellipsis;">ToDo - {{$toDo['noi_dung']}}</div></a>
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
        var windowH = $(window).width();
        var windowH2=(40*windowH)/100;
        var windowH3=(35*windowH)/100;
        $('.width-t').css({'max-width':windowH2+'px'});
        $('.badge-t').css({'max-width':windowH3+'px'});                                                                     
        
        $(window).resize(function(){
            var windowH = $(window).width();
            var windowH2=(40*windowH)/100;
            var windowH3=(35*windowH)/100;
            $('.width-t').css({'max-width':windowH2+'px'});
            $('.badge-t').css({'max-width':windowH3+'px'});
            
        })   
    });

</script>


