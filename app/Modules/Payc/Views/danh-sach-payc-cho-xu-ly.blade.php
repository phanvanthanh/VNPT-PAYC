@extends('layouts.index')
@section('title', 'PAKN chờ xử lý')
@section('content')
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	          	<div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">DANH SÁCH PAKN CHỜ XỬ LÝ</h4>
                    <small id="danh-muc-nhom-quyen-helper" class="form-text text-muted"><!-- Chức năng sẽ hiển thị danh sách những PAYC của khách hàng tạo và chưa được tiếp nhận, xử lý --></small>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
                <div class="text-right">
                    <!-- <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-xu-ly" data-toggle="modal" data-target="#modal-xu-ly"><i class="fa fa-mail-forward"></i> Xử lý</button>
                    </div>
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-chuyen-lanh-dao" data-toggle="modal" data-target="#modal-chuyen-lanh-dao"><i class="fa fa-group"></i> Chuyển lãnh đạo</button>
                    </div> -->
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt disabled btn-disabled btn-xu-ly-va-chuyen-lanh-dao" disabled="disabled" data-toggle="modal" data-target="#modal-xu-ly-va-chuyen-lanh-dao"><i class="fa fa-group"></i> Hoàn tất & chuyển lãnh đạo duyệt</button>
                    </div>
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt disabled btn-disabled btn-hoan-tat-phoi-hop" disabled="disabled"><i class="fa fa-group"></i> Đã hoàn tất phối hợp</button>
                    </div>
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt disabled btn-disabled btn-hoan-tat-da-xem" disabled="disabled"><i class="fa fa-group"></i> Đã xem</button>
                    </div>
                    {{--<div class="btn-group mr-2">
                        <button class="btn btn-sm btn-success btn-hoan-tat-xu-ly" data-toggle="modal" data-target="#modal-hoan-tat-xu-ly"><i class="fa fa-check-circle"></i> Hoàn tất</button>
                    </div>
                     <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-cap-nhat-payc" data-toggle="modal" data-target="#modal-cap-nhat-payc"><i class="fa fa-pencil"></i> Cập nhật</button>
                    </div> 
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-danger btn-tra-lai-khong-xu-ly" data-toggle="modal" data-target="#modal-tra-lai-khong-xu-ly"><i class="fa fa-mail-reply"></i> Trả lại, không xử lý</button>
                    </div>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-danger btn-huy" data-toggle="modal" data-target="#modal-huy"><i class="fa fa-window-close-o"></i> Hủy</button>
                    </div> --}}
                </div>
    		  	
    		  	<div class="row">
    		  		<div class="col-12">
    		  			<table id="order-listing" class="table table-hover table-striped">
						    <thead>
						        <tr class="text-center background-vnpt">
						        	
						        	<th scope="col"><input type="checkbox" name="id_payc[]" class="id_payc"></th>
						            <th scope="col">Số phiếu</th>
						            <th scope="col">Nội dung</th>
						            <th scope="col">File</th>
						            <th scope="col">Dịch vụ</th>
						            <th scope="col">Ngày gửi</th>
						            <th scope="col">QT xử lý</th>
						        </tr>
						    </thead>
						    <tbody>                       
						                     
						        <?php 
						            $stt=0;
						        ?>
						        @foreach($paycs as $payc)
						            <?php $stt++; ?>
						            
						            <tr class="tr-hover">
						            	<th class="text-center check-id-payc" scope="row"><input type="checkbox" name="id_payc[]" class="id_payc" value="{{$payc['id_payc']}}"></th>
						                <td class="text-center text-primary xem-chi-tiet-payc" value="{{$payc['id_payc']}}" scope="row">{{$payc['so_phieu']}}</td>						                
						                <td class="noi_dung xem-chi-tiet-payc" value="{{$payc['id_payc']}}">
						                <?php 
						                	echo $payc['tieu_de'];
						                ?><br>
						                @php
						                	$vaiTro=\Helper::getVaiTroXuLy($payc['vai_tro']);
						                	echo '<b class="text-danger vai-tro" data="'.$payc['vai_tro'].'">'.$vaiTro.'</b><br>';
						                	$danhGia=\Helper::laySoLieuDanhGiaTheoIdPayc($payc['id_payc']);
						                @endphp
						                @if($danhGia)
						                	@for($i=1; $i<=5; $i++)
						                		<i class="fa fa-star @if($i<=$danhGia) t-rate-active @else t-rate-default @endif" alt="{{$i}} sao"></i>
						                	@endfor						                	
						                @endif
						                </td>
						                <td>
						                <?php
						                    $files=explode(';', $payc['file_payc']);
						                    foreach ($files as $key => $file) {
						                    	if($file){
						                        	echo '<a href="/file/download/'.$file.'" class="a-file"><div class="show-file">'.$file.'</div></a>';
						                        }
						                    }
						                ?>
						                </td>
						                <td class="font-size-default">
						                	{{$payc['ten_dich_vu']}}<br>
						                	{{$payc['name']}} 
						                </td>
						                <td class="font-size-default">
						                	@if($payc['ngay_tao'])
						                		<div class="text-default nowrap">{{$payc['ngay_tao']}}</div>
						                	@endif
						                	@if($payc['han_xu_ly_mong_muon'])
						                		<div class="text-primary nowrap">{{$payc['han_xu_ly_mong_muon']}}</div>
						                	@endif
						                	@if($payc['han_xu_ly_duoc_giao'])
						                		<div class="text-danger nowrap">{{$payc['han_xu_ly_duoc_giao']}}</div>
						                	@endif
						                </td>
						                <td class="text-center cusor qtxl" value="{{$payc['id_payc']}}" data-toggle="modal" data-target="#modal-qtxl">
						                    <i class="fa fa-sitemap text-primary"></i>
						                </td>
						            </tr>
						        @endforeach    
						    </tbody>
						</table>     
    		  		</div>
    		  </div>
	        </div>
	    </div>
    </div>


          


    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/jquery.min.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		$.fn.dataTable.ext.errMode = 'none';
        $('.table').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });


        

	  
	});
	</script>
@endsection


