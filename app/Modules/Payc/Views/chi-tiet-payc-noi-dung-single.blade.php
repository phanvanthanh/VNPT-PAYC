@if($error=="")    
    @php
        $payc=$data['payc'];
        $danhGia=\Helper::laySoLieuDanhGiaTheoIdPayc($payc['id']);
    @endphp
    <div class="row pakn-detail">
        <div class="col-12">
            <div class="main-title">
                Phản ánh, yêu cầu về việc: {{$payc['tieu_de']}} - <b>[{{$payc['so_phieu']}}]</b>
            </div>
            <div class="post-info">{{$payc['name']}} - {{$payc['ngay_tao']}}</div>
            <div class="post-info">Đánh giá: @if(!$danhGia) chưa đánh giá
                @else
                    @for($i=1; $i<=5; $i++)
                        <i class="fa fa-star @if($i<=$danhGia) t-rate-active @else t-rate-default @endif" alt="{{$i}} sao"></i>
                    @endfor                                         
                @endif
            </div>
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
                
                
                @php
                    $files=explode(';', $payc['file_payc']);
                    foreach ($files as $key => $file) {
                        if($file){
                            echo '<div class="file">
                                    <span class="-ap icon-paper-clip icon"></span>
                                    <div class="content">
                                        <span class="text">File đính kèm:</span>
                                        <a target="_blank" href="/file/download/'.$file.'" class="link">'.$file.'</a>                
                                    </div>
                                </div> <br>';
                        }
                    }

                
                @endphp
                
                
            </div>
        </div>
    </div>
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

