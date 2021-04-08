@if($error=="")    
    @php
        $payc=$data['payc'];
    @endphp
    <div class="row pakn-detail">
        <div class="col-12">
            <div class="main-title">Phản ánh, yêu cầu về việc: {{$payc['tieu_de']}} - <b>[{{$payc['so_phieu']}}]</b></div>
            <div class="post-info">{{$payc['name']}} - {{$payc['ngay_tao']}}</div><br>
        </div>
        <div class="divider-gray"></div>
        <div class="col-2 text-center">
            <div class="avatar text-center" style="background-image: url('{{ asset('public/images/mess.svg') }}'); margin-left: 25%;"></div>
        </div>
        <div class="col-10 ques-item -question">
            <div class="title" style="font-size: 20px; font-weight: 500; margin-bottom: 10px;">Nội dung phản ánh, yêu cầu:</div>
            <div class="article">
                <div style="width: 100%; border: none; resize: none; margin-bottom: 20px; overflow: hidden; overflow-wrap: break-word;"><?php echo $payc['noi_dung']; ?></div>
            </div>
            <div class="col-10">
                <?php
                    $files=explode(';', $payc['file_payc']);
                    foreach ($files as $key => $file) {
                        if($file){
                            //echo '<a href="/file/download/'.$file.'" class="a-file"><div class="show-file">'.$file.'</div></a><br>';
                            echo '<div class="file">
                                    <span class="-ap icon-paper-clip icon"></span>
                                    <div class="content">
                                        <span class="text">File đính kèm:</span>
                                        <a target="_blank" href="/file/download/'.$file.'" class="link">'.$file.'</a>                
                                    </div>
                                </div> <br>';
                        }
                    }
                ?>
                
            </div>
        </div>
    </div>
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

