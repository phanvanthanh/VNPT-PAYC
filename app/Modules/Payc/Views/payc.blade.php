@php
	use Illuminate\Support\Facades\Auth;
	$userId=Auth::id();
@endphp
@if(!Auth()->id() || Auth::user()->loai_tai_khoan=='KHACH_HANG')
  @php $layout='layouts.front-end'; @endphp
@else
  @php $layout='layouts.index'; @endphp
@endif
@extends($layout)	
@section('title', 'Gửi PAKN')
@section('content')

	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	        	
	          	<div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">THÔNG TIN PAKN hoặc Yêu cầu hỗ trợ</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"> --}}
	        		<form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
	                    {{ csrf_field() }}
	                    @if(Auth::id())
	                    <div class="row">
	                    	<div class="col-12">
		                    	
		                    </div>
	                    </div>
		                @endif
	                    <div class="row">
	                    	<div class="col-12">
	                    		<div class="row">
	                    			<div class="col-6">
		                    			<small class="form-text text-muted">Tiêu đề <b class="text-danger">(*)</b></small>
		                    		</div>
				                    <div class="col-6 text-right">
		                    			<div class="icheck-square font-weight-bold">
					                        <input name="is_an_danh" type="checkbox" id="is_an_danh" value="1" @if(!$userId) {{"checked='checked'"}} @endif>
					                        <label for="is_an_danh">Phản ánh ẩn danh</label>
					                    </div>
		                    		</div>
	                    		</div>
		                    		
				          		<!-- <label for="tieu_de" class="text-title-input-size">* Tiêu đề</label> -->
				          		<input type="Text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề là thông tin rút gọn của nội dung yêu cầu." required="required">
				          		<small class="form-text text-muted"> <div class="error error-tieu-de"></div></small>
				          	</div>
				        </div>

				          
				          <!-- <h5 class="text-primary">2. Thông tin không bắt buộc</h5> -->
				          <div class="row">
				          	<div class="col-12">
				          		<small class="form-text text-muted">Mô tả</small>
					          	<div id="summernote_mo_ta" class="summernote"></div>
					          	<textarea class="form-control" id="noi_dung" name="noi_dung" rows="3" hidden="true"></textarea>
				          	</div>
				          	<div class="col-12">
				          		<small class="form-text text-muted">Upload file</small>
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
			    		  	<div class="col-12">
			    		  		<div class="row">
			    		  			<div class="col-12">
			    		  				<small class="form-text text-muted">Hạn xử lý mong muốn</small>
			    		  				<!-- <label for="datepicker-popup" class="text-title-input-size">* Hạn xử lý</label> -->		
			    		  				<div id="datepicker-popup" class="input-group date datepicker">
					                        <input type="text" id="ngay" name="ngay" class="form-control" aria-describedby="ngay_helper" value="{{date('m/d/Y')}}">
					                        <div class="input-group-addon input-group-text">
					                          <span class="mdi mdi-calendar"></span>
					                        </div>
					                    </div>
					                    <!-- <small id="ngay_helper" class="form-text text-muted">Hạn xử lý mà bạn mong muốn, để chúng tôi sắp xếp xử lý.</small> -->
			    		  			</div>
			    		  			<div class="col-12 d-none">
			    		  				<small class="form-text text-muted">Giờ</small>
			    		  				<!-- <label for="datepicker-popup" class="text-title-input-size">* Giờ</label> -->
			    		  				<div class="input-group clockpicker">
					                        <input type="text" class="form-control" id="gio" name="gio" value="17:00" aria-describedby="gio_helper">
					                        <span class="input-group-addon input-group-text">
					                          <i class="mdi mdi-clock"></i>
					                        </span>
					                    </div>
					                    <!-- <small id="gio_helper" class="form-text text-muted">Giờ mong muốn</small> -->
			    		  			</div>
			    		  		</div>
					    		  
				    		  </div>
					    	  <div class="col-12">
					    	  	<small class="form-text text-muted">Dịch vụ cần được hỗ trợ</small>
					    	  	<!-- <label for="id_dich_vu" class="text-title-input-size">* Dịch vụ</label> -->
						          <select class="form-control" id="id_dich_vu" name="id_dich_vu" aria-describedby="dich_vu_helper">
						          		@foreach($dichVus as $dichVu)
					                              <option value="{{$dichVu['id']}}" @if ($dichVu['id']==2) {{'selected="selected"'}} @endif>{{$dichVu['ten_dich_vu']}}</option>
					                    @endforeach
					                </select>
					    		  <!-- <small id="dich_vu_helper" class="form-text text-muted">Bạn muốn chúng tôi hỗ trợ bạn về sản phẩm, dịch vụ (phần mềm) nào?</small> -->
					    	  </div>
					    	  	<div class="col-6 dia_chi d-none">
						    	  	<small class="form-text text-muted">Địa chỉ yêu cầu</small>
						    	  	<!-- <label for="ma_quan_huyen" class="text-title-input-size">* Dịch vụ</label> -->
							          <select class="form-control ma_quan_huyen" name="ma_quan_huyen" aria-describedby="ma_quan_huyen_helper">
							          		@foreach($dmQuanHuyens as $dmQuanHuyen)
						                              <option @if($donViMacDinh && isset($donViMacDinh[0]['ma_quan_huyen']) && $donViMacDinh[0]['ma_quan_huyen']==$dmQuanHuyen['ma_quan_huyen']) {{"selected='selected'"}} @endif value="{{$dmQuanHuyen['ma_quan_huyen']}}">{{$dmQuanHuyen['ten_quan_huyen']}}</option>
						                    @endforeach
						                </select>
						    	</div>
						    	<div class="col-6 dia_chi d-none">
						    	  	<small class="form-text text-muted"><b>&nbsp;</b></small>
							          <select class="form-control ma_phuong_xa" name="ma_phuong_xa" aria-describedby="ma_phuong_xa_helper" >
							          		@foreach($dmPhuongXas as $dmPhuongXa)
						                              <option @if($donViMacDinh && isset($donViMacDinh[0]['ma_phuong_xa']) && $donViMacDinh[0]['ma_phuong_xa']==$dmPhuongXa['ma_phuong_xa']) {{"selected='selected'"}} @endif ma-quan-huyen="{{$dmPhuongXa['ma_quan_huyen']}}" value="{{$dmPhuongXa['ma_phuong_xa']}}">{{$dmPhuongXa['ten_phuong_xa']}}</option>
						                    @endforeach
						                </select>
						    	</div>						    	  
			    		  	</div>
	                </form>
		    		<div class="row">
		    		  	<div class="col-12 text-right" style="margin-top: 5px;">
		    		  		<div class="btn-group mr-2">
		                        <button class="btn btn-vnpt btn-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Gửi yêu cầu</button>
		                    </div>
		    		  	</div>
		    		</div>
	        	{{-- </div> --}}
		          	
	        </div>
	    </div>
    </div>


    <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	  var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();

	  $('.btn-them-moi').on('click',function(){
	  	jQuery('.error-tieu-de').text("");
	  	if(!jQuery('#tieu_de').val()){
	  		jQuery('.error-tieu-de').text("Tiêu đề không được để trống");
	  		return false;
	  	}
	  	var moTa=jQuery('.note-editable').html();
	  	jQuery('#noi_dung').val(moTa);
	      themMoiKhongRefreshDuLieu(_token, $("form#frm-them-moi"), "{{ route('them-payc') }}",true);
	  });

	  	

	  	

	  

	  
	});
	</script>
@endsection


