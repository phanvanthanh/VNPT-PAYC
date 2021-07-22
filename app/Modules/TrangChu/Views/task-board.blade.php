@extends('layouts.task-board')
@section('title', 'Task board')
@section('content')
@php
	use Illuminate\Support\Facades\Auth;
@endphp
	{{-- <div class="col-lg-12">
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
                            <span class="input-group-text bg-primary text-white text-center"><i class="fa fa-chevron-left"></i></span>                            
                          </div>
                          <input type="Number" class="form-control text-center " id="tuan" aria-label="" name="tuan" value="" style="width:20px;">
                          <div class="input-group-append tuan_tang cusor">
                            <span class="input-group-text bg-primary border-primary text-white "><i class="fa fa-chevron-right"></i></span>                            
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
    </div> --}}



										

   <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	    
	  
	});
	</script>
@endsection


