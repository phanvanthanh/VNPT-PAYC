@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
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
               {{-- <div class="row">
	               	<div class="col-sm-12">
	               		<form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi" method="POST" action="{{ route('sso-dang-nhap-2') }}">
										  {{ csrf_field() }}
										  <div class="form-group row text-right">
										    <label for="token" class="col-sm-1 col-form-label ">Token</label>
										    <div class="col-sm-11">
										       <input type="Text" class="form-control token" name="token" value="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MjU3MTM5NTgsImV4cCI6MTYyNTcxNTE1OCwibmhhbnZpZW5faWQiOiJNVGcxTVE9PSIsIm1hX25kIjoiYWRtaW5fdHZoIiwidGVuX25kIjoiYWRtaW5fVFZIIiwidHRsIjoiMTUiLCJyZWZyZXNoX3Rva2VuIjoiIiwia2V5Ijoidm5wdC1xbGFtIn0.CKvFwNynesGhCvKZxlsiEvPyB_-oCmgx6Bagsz_kSFQ">
										    </div>
										  </div>
										  <button type="submit" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i>Đăng nhập SSO 2</button>
										</form>
	               	</div>
               </div> --}}
	        </div>
	    </div>
    </div>



										

    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	  

	  
	});
	</script>
@endsection


