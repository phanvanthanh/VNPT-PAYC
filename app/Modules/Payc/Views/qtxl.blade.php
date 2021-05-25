@if($error=="")
    {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            <div class="timeline">
                <?php $stt=0; ?>
                @foreach($data as $d)
                <?php $stt++; ?>
                <div class="timeline-wrapper timeline-wrapper-primary @if($stt%2==0){{'timeline-inverted'}}@endif">
                    <div class="timeline-badge"></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h6 class="timeline-title">{{$d['ten_trang_thai_xu_ly']}}</h6>
                            <small class="form-text text-muted">Bởi: <b>{{$d['name']}}</b>. Ngày <b>{{$d['ngay_xu_ly']}}</b></small>
                        </div>
                        <div class="timeline-body">
                            <small class="form-text">
                            @php
                                if ($d['ma_trang_thai']=='DUYET_CHUYEN_XU_LY'){
                                    $dsCanBoXuLys=\Helper::layDanhSachCanBoXuLyPakn($d['id_payc']);
                                    $stt2=0;
                                    foreach ($dsCanBoXuLys as $key => $canBoXuLy) {
                                        $stt2++;
                                        $vaiTro=\Helper::getVaiTroXuLy($canBoXuLy['vai_tro']);
                                        $trangThai=\Helper::getTrangThaiXuLy($canBoXuLy['trang_thai']);
                                        $style='text-danger';
                                        if($canBoXuLy['trang_thai']>0){
                                            $style='text-primary';
                                        }
                                        echo '<b>'.$stt2.'. '.$canBoXuLy['name'].'</b> - '.$vaiTro.' - <b class="'.$style.'">'.$trangThai.'</b><br>';
                                    }
                                }
                            @endphp
                        </small>
                        <small class="form-text">
                            <?php
                                if($d['noi_dung_xu_ly']){ 
                                    echo "<b>Nội dung: </b>".$d['noi_dung_xu_ly'];
                                } 
                            ?>
                            </small>
                        </div>
                        <div class="timeline-body">
                            <?php
                                $files=explode(';', $d['file_xu_ly']);
                                foreach ($files as $key => $file) {
                                    echo '<a href="/file/download/'.$file.'" class="a-file"><div class="show-file">'.$file.'</div></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                @endforeach
           </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery('.show-file').each(function( index ) {
            var name=jQuery(this).text();
            if(name){
                var arr=name.split(".");
                if(arr[arr.length-1]=='xls' || arr[arr.length-1]=='xlsx'){
                    jQuery(this).html('<i style="color:green;" class="mdi mdi-file-excel"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='doc' || arr[arr.length-1]=='docx'){
                    jQuery(this).html('<i style="color:blue;" class="mdi mdi-file-word"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='ppt' || arr[arr.length-1]=='pptx'){
                    jQuery(this).html('<i style="color:red;" class="mdi mdi-file-powerpoint"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='pdf'){
                    jQuery(this).html('<i style="color:red;" class="mdi mdi-file-pdf-box"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='php' || arr[arr.length-1]=='prc' || arr[arr.length-1]=='html' || arr[arr.length-1]=='js' || arr[arr.length-1]=='java' || arr[arr.length-1]=='css' || arr[arr.length-1]=='asp' || arr[arr.length-1]=='aspx' || arr[arr.length-1]=='sql' || arr[arr.length-1]=='pbix'){
                    jQuery(this).html('<i style="color:grey;" class="mdi mdi-code-not-equal-variant"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='txt'){
                    jQuery(this).html('<i  style="color:grey;" class="mdi mdi-note-text"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='zip' || arr[arr.length-1]=='rar'){
                    jQuery(this).html('<i style="color:grey;" class="mdi mdi-zip-box"></i> '+name+'<br>');
                }
                else if(arr[arr.length-1]=='png' || arr[arr.length-1]=='jpg' || arr[arr.length-1]=='jpeg'){
                    jQuery(this).html('<i grey class="mdi mdi-file-image"></i> '+name+'<br>');
                }else{
                    jQuery(this).html('<i grey class="mdi mdi-file"></i> '+name+'<br>');
                }
            }
                
        }); 
    </script>
@else
    {{ csrf_field() }}
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




