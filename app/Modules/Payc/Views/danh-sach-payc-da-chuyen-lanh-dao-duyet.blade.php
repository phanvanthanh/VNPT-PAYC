@extends('layouts.index')
@section('title', 'Danh sách PAYC của tôi')
@section('content')
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	          	<div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">DANH SÁCH PAYC ĐÃ CHUYỂN LÃNH ĐẠO DUYỆT</h4>
                    <small id="danh-muc-nhom-quyen-helper" class="form-text text-muted">Chức năng sẽ hiển thị danh sách những PAYC đã chuyển lãnh đạo duyệt</small>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>	          	
    		  	
    		  	<div class="row">
    		  		<div class="col-12">
    		  			<table id="order-listing" class="table table-hover table-striped">
						    <thead>
						        <tr class="text-center background-vnpt">
						            <th scope="col" style="width: 10%;">STT #</th>
						            <th scope="col" style="width: 50%;">Nội dung</th>
						            <th scope="col" style="width: 10%;">File</th>
						            <th scope="col" style="width: 10%;">Ngày gửi</th>
						            <th scope="col" style="width: 10%;">Trạng thái</th>
						            <th scope="col" style="width: 10%;">QT xử lý</th>
						        </tr>
						    </thead>
						    <tbody>                       
						                     
						        <?php 
						            $stt=0;
						        ?>
						        @foreach($paycs as $payc)
						            <?php $stt++; ?>
						            <tr class="tr-hover">
						                <th class="text-center" scope="row">{{$stt}}</th>
						                <td>
						                    <b><?php echo $payc['tieu_de']; ?></b><br>
						                    <?php echo $payc['noi_dung']; ?>
						                </td>
						                <td>
						                <?php
						                    $files=explode(';', $payc['file_payc']);
						                    foreach ($files as $key => $file) {
						                        echo '<div class="show-file">'.$file.'</div><br>';
						                    }
						                ?>
						                </td>
						                <td>
						                	{{$payc['ngay_tao']}}
						                </td>
						                <td>
						                    Đã chuyển lãnh đạo duyệt
						                </td>
						                <td class="text-center">
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


    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
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

	  
	});
	</script>
@endsection


