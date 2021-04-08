@if($error=="")    
    @php
        foreach($data as $d){
    @endphp
        <div class="row pakn-detail">
            <div class="col-2 text-center">
                @if($d['ma_loai']=='TRA_LOI')
                    <div class="avatar text-center" style="background-image: url('{{ asset('public/images/icon-answer.svg') }}'); margin-left: 50%;"></div>
                @else
                    <div class="avatar text-center" style="background-image: url('{{ asset('public/images/mess.svg') }}'); margin-left: 50%;"></div>
                @endif
            </div>
            <div class="col-10 ques-item -question">
                <div class="title" style="font-size: 20px; font-weight: 500; margin-bottom: 10px;">
                    @if($d['ma_loai']=='TRA_LOI')
                        Trả lời phản ánh, yêu cầu:
                    @else
                        Góp ý phản ánh, yêu cầu:
                    @endif
                    <div class="post-info">{{$d['ho_ten']}} - {{$d['ngay_binh_luan']}}</div>
                </div>
                <div class="article">
                    <div style="width: 100%; border: none; resize: none; margin-bottom: 20px; overflow: hidden; overflow-wrap: break-word;"><?php echo nl2br($d['noi_dung']); ?></div> <br>
                    
                </div>
                 <?php
                    $files=explode(';', $d['file']);
                    foreach ($files as $key => $file) {
                        if($file){
                            //echo '<a href="/file/download/'.$file.'" class="a-file"><div class="show-file">'.$file.'</div></a><br>';
                            echo '<div class="file" id="list-file-attach">
                                    <span class="-ap icon-paper-clip icon" style="background: #7C964C;"></span>
                                         <div class="content" style="background: rgba(124, 150, 76, 0.1);">
                                            <span class="text">File đính kèm:</span>
                                            <a target="_blank" href="/file/download/'.$file.'" class="link">'.$file.'</a>                
                                        </div>
                                    </div> <br>';
                        }
                    }
                ?>
            </div>
        </div>      
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-outline-primary btn-hai-long" data="{{$d['id']}}"><i class="fa fa-thumbs-o-up"></i> &nbsp; Hài lòng (<b class="so-luong-hai-long">{{$d['hai_long']}}</b>)</button> 
                &nbsp;
                <button class="btn btn-outline-warning btn-khong-hai-long" data="{{$d['id']}}"><i class="fa fa-thumbs-o-down"></i> &nbsp; Không hài lòng (<b class="so-luong-khong-hai-long">{{$d['khong_hai_long']}}</b>)</button>
            </div>
            <div class="col-12">&nbsp;</div>
        </div>            
    @php } @endphp


    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        var _token=jQuery('form[name="frm-danh-gia"]').find("input[name='_token']").val();
        jQuery('.btn-hai-long').on('click',function(){
            var id=jQuery(this).attr('data');
            getById(_token, id, "{{ route('hai-long') }}", "");
            var soLuongHaiLong=jQuery(this).find('.so-luong-hai-long').text();
            soLuongHaiLong++;
            jQuery(this).find('.so-luong-hai-long').text(soLuongHaiLong);


        });

        jQuery('.btn-khong-hai-long').on('click',function(){
            var id=jQuery(this).attr('data');
            getById(_token, id, "{{ route('khong-hai-long') }}", "");
            var soLuongKhongHaiLong=jQuery(this).find('.so-luong-khong-hai-long').text();
            soLuongKhongHaiLong++;
            jQuery(this).find('.so-luong-khong-hai-long').text(soLuongKhongHaiLong);


        });
      
    });
    </script>
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

