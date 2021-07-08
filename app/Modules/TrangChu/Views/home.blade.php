@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
@php
	use Firebase\JWT\JWT;
	$key = "vnpt-dntt";
	$payload = array(
	    "iat" => 1625729963,
	    "nbf" => 1625731163,
	  	"nhanvien_id" => "MTg1MQ==",
	    "ttl" => 15,
	    "key"	=> "vnpt-qlam"
	);

	/**
	 * IMPORTANT:
	 * You must specify supported algorithms for your application. See
	 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
	 * for a list of spec-compliant algorithms.
	 */
	$jwt = JWT::encode($payload, $key);
	$jwt="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MjU3Mjk5NjMsImV4cCI6MTYyNTczMTE2MywibmhhbnZpZW5faWQiOiJNVGcxTVE9PSIsIm1hX25kIjoiYWRtaW5fdHZoIiwidGVuX25kIjoiYWRtaW5fVFZIIiwidHRsIjoiMTUiLCJyZWZyZXNoX3Rva2VuIjoiIiwia2V5Ijoidm5wdC1xbGFtIn0.o_QE2laPU1LwfZ1sUBE_uUSnV8Z0519QmsTK5fr7X78";
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
               <div class="row">
	               	<div class="col-sm-12">
	               		<form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi" method="POST" action="https://portal.vnpttravinh.vn:6789/sso/login-2">
										  <div class="form-group row text-right">
										  	{{ csrf_field() }}
										  	@csrf
										    <label for="token" class="col-sm-1 col-form-label ">Token</label>
										    <div class="col-sm-11">
										       <input type="Text" class="form-control token" name="token" value="{{$jwt}}">
										    </div>
										  </div>
										  <button type="submit" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i>Đăng nhập SSO 2</button>
										</form>
	               	</div>
               </div>
	        </div>
	    </div>
    </div>



										

    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	  

	  
	});
	</script>
@endsection


