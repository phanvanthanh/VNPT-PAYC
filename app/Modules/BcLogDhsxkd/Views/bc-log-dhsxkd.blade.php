@extends('layouts.index')
@section('title', 'Log liên thông ĐHSXKD')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">LOG LIÊN THÔNG DHSXKD</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
                <br>
               <div class="load-danh-sach">
                                  
               </div>
            </div>
        </div>
    </div>

    <form class="forms-sample frm-them-moi d-none" id="frm-them-moi" name="frm-them-moi">
        {{ csrf_field() }}
      </form>


  <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/jquery.min.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-bc-log-dhsxkd') }}", '.load-danh-sach');
      
    });
  </script>
@endsection

