@extends('layouts.index')
@section('title', 'Switch user')
@section('content')
@php
	use Illuminate\Support\Facades\Auth;
@endphp
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	          	<div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">SWITCH USER</h4>
                  </div>
                  <div class="col-6">
                     <div class="error-mode float-right"></div> 
                  </div>
               </div>
               	<form class="forms-sample frm-switch-user" id="frm-switch-user" name="frm-switch-user" method="POST" action="{{ route('v2-switch-user') }}">
               		{{ csrf_field() }} 
	               	<div class="row">	               		
		                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			                	<select class="form-control form-control-sm border-primary id_user" name="id_user">
			                		@foreach ($users as $u)
			                			<option value="{{$u['id']}}">{{$u['name']}} ({{$u['email']}})</option>
			                		@endforeach
			                	</select>
			                </div>
			                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			                	<div class="input-group text-center">
                          <input type="password" class="form-control border-primary" id="token" aria-label="" name="token">
                        </div>
			                </div>
			                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			                	<button type="submit" class="btn btn-sm btn-vnpt btn-switch-user"><i class="mdi mdi-plus-circle-outline"></i> Switch user</button>
			                </div>
	               	</div>
	            </form>	          
	        </div>
	    </div>
    </div>



										

    <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	 
	  
	});
	</script>
@endsection


