@extends('layouts.index')
@section('title', 'Phân quyền')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">PHÂN QUYỀN</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               	<div class="row">
               		<div class="col-6">
               			<h5 class="text-primary" aria-describedby="danh-muc-nhom-quyen-helper">1. Danh mục nhóm quyền <b class="text-danger">(*)</b></h5>
                    <small id="danh-muc-nhom-quyen-helper" class="form-text text-muted">Bước 1: Chọn nhóm quyền cần phân quyền</small>
               			<div class="table-responsive load-danh-sach-nhom-quyen"></div>
                    <input type="Number" name="role_id" hidden="true" id="role_id" class="role_id" value="">
               		</div>
               		<div class="col-6">
               			<h5 class="text-primary" aria-describedby="danh-muc-chuc-nang-helper">2. Danh mục chức năng <b class="text-danger">(*)</b></h5>
                    <small id="danh-muc-chuc-nang-helper" class="form-text text-muted">Bước 2: Check vào các checkbox quyền cần phân quyền hoặc bỏ phân quyền</small>
               			<div class="table-responsive load-danh-sach-quyen"></div>
               		</div>
               		
               	</div>
            </div>
        </div>
    </div>

    <form class="forms-sample frm-phan-quyen" id="frm-phan-quyen" name="frm-phan-quyen">
       {{ csrf_field() }}
   </form>



  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-phan-quyen"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('phan-quyen/danh-sach-nhom-quyen') }}", '.load-danh-sach-nhom-quyen');
      loadTable(_token, "{{ route('phan-quyen/danh-sach-quyen-theo-nhom-quyen-id') }}", '.load-danh-sach-quyen');
    });
  </script>
@endsection

