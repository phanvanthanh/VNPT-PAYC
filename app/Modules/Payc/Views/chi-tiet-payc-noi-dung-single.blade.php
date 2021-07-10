@if($error=="")    
    @php
        $payc=$data['payc'];
        $danhGia=\Helper::laySoLieuDanhGiaTheoIdPayc($payc['id']);

    @endphp
    <div class="row pakn-detail">
        <div class="col-12">
            <div class="main-title"> 
                <b>[{{$payc['so_phieu']}}]</b> {{$payc['tieu_de']}}
            </div>
            <div class="post-info">{{$payc['name']}} - {{$payc['ngay_tao']}}</div>
            <div class="post-info">Đánh giá: @if(!$danhGia) chưa đánh giá
                @php
                    $loaiDanhGia=\Helper::kiemTraLoaiDanhGiaTheoIdPayc($payc['id']);
                    //die(var_dump($loaiDanhGia));
                    if($loaiDanhGia && $loaiDanhGia=='KH_DANH_GIA'){
                    @endphp
                        <button class="btn text-warning btn-link btn-kh-danh-gia-2" data="{{$payc['id']}};" data-toggle="modal" data-target="#modal-danh-gia">(Bấm vào đây để thực hiện đánh giá)</button>
                    @php
                    }
                @endphp
                @else
                    @for($i=1; $i<=5; $i++)
                        <i class="fa fa-star @if($i<=$danhGia) t-rate-active @else t-rate-default @endif" alt="{{$i}} sao"></i>
                    @endfor                                         
                @endif
            </div>
        </div>
        <div class="divider-gray"></div>
        <div class="col-2 text-center">
            <div class="avatar text-center" style="background-image: url('https://baocaotuan.vnpttravinh.vn/public/images/mess.svg'); margin-left: 25%;"></div>
        </div>
        <div class="col-10 ques-item -question">
            <div class="title" style="font-size: 20px; font-weight: 500; margin-bottom: 10px;">Nội dung phản ánh, yêu cầu:</div>
            <div class="article">
                <div style="width: 100%; border: none; resize: none; margin-bottom: 20px; overflow: hidden; overflow-wrap: break-word;">
                    @if ($payc['noi_dung'] && $payc['noi_dung']!='<p><br></p>')
                        @php
                            echo $payc['noi_dung'];
                        @endphp 
                    @else
                        {{$payc['tieu_de']}} 
                    @endif
                        
                </div>
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
    <script type="text/javascript">
        $('.btn-kh-danh-gia-2').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
            var _token=jQuery('form[name="frm-danh-gia"]').find("input[name='_token']").val();
            jQuery('.loai_danh_gia').val(2);
            var dsId=jQuery(this).attr('data');
            console.log(dsId);
            if(dsId){
              // tạo form chuyển
              jQuery('.ds_id_payc_danh_gia').val(dsId);
            }else{
              alert("Vui lòng chọn các yêu cầu cần xử lý!");
              return false;
            }
          
        });
    </script>
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

