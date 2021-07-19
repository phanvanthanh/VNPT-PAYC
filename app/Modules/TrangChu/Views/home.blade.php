@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
@php
	use Illuminate\Support\Facades\Auth;
@endphp
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	          	<div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">TRANG CHỦ</h4>
                  </div>
                  <div class="col-6">
                     <div class="error-mode float-right"></div> 
                  </div>
               </div>
               	<form class="forms-sample frm-search" id="frm-search" name="frm-search" action="javascript:void(0)">
               		{{ csrf_field() }} 
	               	<div class="row">	               		
		                  	<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
			                	<select class="form-control form-control-sm nam" name="nam">
			                		@for ($i = 2021; $i <= 2025; $i++)
			                			<option value="{{$i}}">Năm {{$i}}</option>
			                		@endfor
			                	</select>
			                </div>
			                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 d-none">
			                	<select class="form-control form-control-sm thang" name="thang">
			                		@for ($i = 1; $i <= 12; $i++)
			                			<option value="{{$i}}">Tháng @if($i<10) {{"0"}} @endif{{$i}}</option>
			                		@endfor
			                	</select>
			                </div>
			                <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
			                	<div class="input-group text-center">
                          <div class="input-group-prepend tuan_giam cusor">
                            <span class="input-group-text bg-primary text-white text-center"><</span>                            
                          </div>
                          <input type="Number" class="form-control text-center " id="tuan" aria-label="" name="tuan" value="{{$tuanHienTai}}" style="width:20px;">
                          <div class="input-group-append tuan_tang cusor">
                            <span class="input-group-text bg-primary border-primary text-white ">></span>                            
                          </div>
                        </div>
			                </div>

	               	</div>
	            </form>
	            <br>
               <div class="row">
	               	<div class="col-sm-12">
	               		<div class=" load-danh-sach">
	               		</div>
	               		
	               		
		               			
	               	</div>
               </div>
	        </div>
	    </div>
    </div>



										

    <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	    loadLichCaNhanTuan=function(){
	        loading('.error-mode');
	        var _token=jQuery('meta[name="csrf-token"]').val();
	        var form = jQuery('form[name="frm-search"]');
	        var formData = new FormData(form[0]);
	        var xhr1;  
	        if(xhr1 && xhr1.readyState != 4){
	            xhr1.abort(); //huy lenh ajax truoc do
	        }
	        xhr1 = jQuery.ajax({
	          url: "{{ route('danh-sach-lich-ca-nhan-tuan') }}",
	          type: 'POST',
	          data: formData,
	          contentType: false,
	          processData: false,
	          complete: function(xhr, textStatus) {
	            //called when complete
	          },
	          success: function(data, textStatus, xhr) {
	            $(".error-mode").empty();
	            if(data.error==""){
	              jQuery('.load-danh-sach').html(data.html);
	            }else{
	              errorLoader(".error-mode",data.error);
	            }
	          },
	          error: function(xhr, textStatus, errorThrown) {
	            //called when there is an error
	          }
	        });
	    } 

	    loadLichCaNhanThang=function(){
	        loading('.error-mode');
	        var nam=jQuery('#nam').val();
	        var thang=jQuery('#thang').val();

	        var _token=jQuery('meta[name="csrf-token"]').val();
	        var form = jQuery('form[name="frm-search"]');
	        var formData = new FormData(form[0]);
	        var xhr1;  
	        if(xhr1 && xhr1.readyState != 4){
	            xhr1.abort(); //huy lenh ajax truoc do
	        }
	        xhr1 = jQuery.ajax({
	          url: "{{ route('danh-sach-lich-ca-nhan-thang') }}",
	          type: 'POST',
	          data: formData,
	          contentType: false,
	          processData: false,
	          complete: function(xhr, textStatus) {
	            //called when complete
	          },
	          success: function(data, textStatus, xhr) {
	            $(".error-mode").empty();
	            if(data.error==""){
	              jQuery('.load-danh-sach').html(data.html);
	            }else{
	              errorLoader(".error-mode",data.error);
	            }
	          },
	          error: function(xhr, textStatus, errorThrown) {
	            //called when there is an error
	          }
	        });
	    } 
	    jQuery('.tuan_tang').on('click', function() {
	    	var tuan=parseInt(jQuery('#tuan').val());
	    	tuan=tuan+1;
	    	jQuery('#tuan').val(tuan);
	    	@if (Auth::id())
		    	loadLichCaNhanTuan();	
		    @endif
	    });
	    jQuery('.tuan_giam').on('click', function() {
	    	var tuan=parseInt(jQuery('#tuan').val());
	    	tuan=tuan-1;
	    	jQuery('#tuan').val(tuan);
	    	@if (Auth::id())
		    	loadLichCaNhanTuan();	
		    @endif
	    });
	    jQuery('#tuan').on('change', function() {
	    	@if (Auth::id())
		    	loadLichCaNhanTuan();	
		    @endif
	    });
	    @if (Auth::id())
	    	loadLichCaNhanTuan();	
	    @endif
	    
	  
	});
	</script>
@endsection


