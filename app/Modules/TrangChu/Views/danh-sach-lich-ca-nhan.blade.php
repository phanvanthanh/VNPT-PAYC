@extends('layouts.script-layout')
<table class="table table-bordered table-calendar-t">
    <tr class="text-center">
        <th>Thứ 2</th>
        <th>Thứ 3</th>
        <th>Thứ 4</th>
        <th>Thứ 5</th>
        <th>Thứ 6</th>
        <th>Thứ 7</th>
        <th>Chủ nhật</th>
    </tr>
    @php
        $stt=0;
        echo $day;
    @endphp
    @for (  $i = 1;     $i <=5 ;    $i++)
        <tr>
            @for (  $j = 1;     $j <= 7;    $j++)
                <td style="padding:0rem;">
                    <div class="text-right text-muted" style="width: 100%; height:20%;">
                        @php
                            $stt++;
                            if($stt<=31){
                                    echo $stt;
                            }
                        @endphp
                    </div>
                    <div style="width: 90%;height:80%; text-align: center; margin-left: 5%;">
                        <div class="progress progress-lg mt-2">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">60%</div>
                        </div>
                        <div class="progress progress-lg mt-2">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                        </div>
                        <div class="progress progress-lg mt-2">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">60%</div>
                        </div>
                        <div class="progress progress-lg mt-2">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                        </div>
                    </div>
                </td>
            @endfor
        </tr>
    @endfor
</table>

<script type="text/javascript">
    jQuery(document).ready(function() {
        var windowH = $(window).height()-250;
        var wrapperH = $('.table-calendar-t').height();
        $('.table-calendar-t').css({'height':windowH+'px'});                                                                             
        $(window).resize(function(){
            var windowH = $(window).height()-250;
                var wrapperH = $('.table-calendar-t').height();
                $('.table-calendar-t').css({'height':windowH+'px'});
        })   
    });

</script>


