@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	          	<div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">THÔNG TIN PHẢN ÁNH YÊU CẦU</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
	          	<form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
                    {{ csrf_field() }}
                    <h5 class="text-primary">1. Thông tin bắt buộc phải nhập <b class="text-danger">(*)</b></h5>
			          <small class="form-text text-muted"><b class="text-danger">*</b> <b>Mô tả</b></small>
			          <!-- <label for="summernote_mo_ta" class="text-title-input-size"><b class="text-danger">*</b> Mô tả</label> -->
			          <div id="summernote_mo_ta" class="summernote"></div>
			          <textarea class="form-control" id="noi_dung" name="noi_dung" rows="3" hidden="true"></textarea>

			          
			          <h5 class="text-primary">2. Thông tin không bắt buộc</h5>
			          <div class="row">
			          	<div class="col-6">
			          		<small class="form-text text-muted"><b>* Tiêu đề</b></small>
			          		<!-- <label for="tieu_de" class="text-title-input-size">* Tiêu đề</label> -->
			          		<input type="Text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề là thông tin rút gọn của nội dung yêu cầu.">
			          	</div>
			          	<div class="col-6">
			          		<small class="form-text text-muted"><b>* Upload file</b></small>
			          		<!-- <label for="tieu_de" class="text-title-input-size">* Upload file</label> -->			          
				            <div class="input-group col-xs-12">
				                <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
				                <div class="input-group-append">
				                  <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn file cần upload</button>         
				                  <input type="file" class="input-file" show-file=".giz-upload-01" name="file_payc[]" multiple hidden="true">
				                </div>
				              </div>
				            <span class="show-file giz-upload-01"></span>
			          	</div>
			          	
			          </div>
					          

			          
		    		  
		    		  <div class="row">
		    		  	<div class="col-6">
		    		  		<div class="row">
		    		  			<div class="col-8">
		    		  				<small class="form-text text-muted"><b>* Hạn xử lý</b></small>
		    		  				<!-- <label for="datepicker-popup" class="text-title-input-size">* Hạn xử lý</label> -->		
		    		  				<div id="datepicker-popup" class="input-group date datepicker">
				                        <input type="text" id="ngay" name="ngay" class="form-control" aria-describedby="ngay_helper" value="{{date('m/d/Y')}}">
				                        <div class="input-group-addon input-group-text">
				                          <span class="mdi mdi-calendar"></span>
				                        </div>
				                      </div>
				                      <small id="ngay_helper" class="form-text text-muted">Hạn xử lý mà bạn mong muốn, để chúng tôi sắp xếp xử lý.</small>
		    		  			</div>
		    		  			<div class="col-4">
		    		  				<small class="form-text text-muted"><b>* Giờ</b></small>
		    		  				<!-- <label for="datepicker-popup" class="text-title-input-size">* Giờ</label> -->
		    		  				<div class="input-group clockpicker">
				                        <input type="text" class="form-control" id="gio" name="gio" value="17:00" aria-describedby="gio_helper">
				                        <span class="input-group-addon input-group-text">
				                          <i class="mdi mdi-clock"></i>
				                        </span>
				                    </div>
				                    <small id="gio_helper" class="form-text text-muted">Giờ mong muốn</small>
		    		  			</div>
		    		  		</div>
				    		  
			    		  </div>
				    	  <div class="col-6">
				    	  	<small class="form-text text-muted"><b>* Dịch vụ</b></small>
				    	  	<!-- <label for="id_dich_vu" class="text-title-input-size">* Dịch vụ</label> -->
					          <select class="form-control" id="id_dich_vu" name="id_dich_vu" aria-describedby="dich_vu_helper">
					          		@foreach($dichVus as $dichVu)
				                              <option value="{{$dichVu['id']}}">{{$dichVu['ten_dich_vu']}}</option>
				                    @endforeach
				                </select>
				    		  <small id="dich_vu_helper" class="form-text text-muted">Bạn muốn chúng tôi hỗ trợ bạn về sản phẩm, dịch vụ (phần mềm) nào?</small>
				    	  </div>
		    		  </div>
                </form>
    		  <div class="row">
    		  	<div class="col-12 text-right">
    		  		<div class="btn-group mr-2">
                        <button class="btn btn-vnpt btn-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Gửi yêu cầu</button>
                    </div>
    		  	</div>
    		  </div>
	        </div>
	    </div>
    </div>


    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	  var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();

	  $('.btn-them-moi').on('click',function(){
	  	var moTa=jQuery('.note-editable').html();
	  	jQuery('#noi_dung').val(moTa);
	      themMoiKhongRefreshDuLieu(_token, $("form#frm-them-moi"), "{{ route('them-payc') }}");
	  });

	  

	  
	});
	</script>
@endsection


