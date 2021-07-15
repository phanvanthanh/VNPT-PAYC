@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
<style type="text/css">
	.table-calendar-t tr{
			height: 40px;
	}
</style>
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
               <div class="row">
	               	<div class="col-sm-12">
	               		<table class="table table-bordered table-calendar-t">
	               			@php
	               					$stt=0;
	               			@endphp
	               			@for (	$i = 1; 	$i <=5 ; 	$i++)
		               			<tr>
		               				@for (	$j = 1; 	$j <= 7; 	$j++)
		               					<td>
		               						@php
		               								$stt++;
		               								if($stt<=31){
		               										echo $stt;
		               								}
		               						@endphp
		               					</td>
		               				@endfor
		               			</tr>
		               		@endfor
	               		</table>
	               		
		               			
	               	</div>
               </div>
	        </div>
	    </div>
    </div>



										

    <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

    var windowH = $(window).height()-150;
    var wrapperH = $('.table-calendar-t').height();
    $('.table-calendar-t').css({'height':windowH+'px'});                                                                             
    $(window).resize(function(){
        var windowH = $(window).height()-150;
		    var wrapperH = $('.table-calendar-t').height();
		    $('.table-calendar-t').css({'height':windowH+'px'});
    })          

	  
	});
	</script>
@endsection


