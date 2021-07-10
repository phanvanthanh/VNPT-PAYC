@extends('layouts.index')
@section('title', 'To do list')
@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h4 class="text-danger">TO DO LIST</h4>
        </div>
        <div class="col-6">
          <div class="error-mode float-right"></div> 
        </div>
      </div>

      <div class="text-right table-responsive">
        <div class="btn-group mr-2">
          <button class="btn btn-sm btn-vnpt btn-load-form-them-moi" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm mới</button>
        </div>
      </div>
      <br>
      <div class="load-danh-sach">
                
      </div>
    </div>
  </div>
</div>

    <div class="modal" id="modal-them-moi" tabindex="-1" role="dialog" aria-labelledby="modal-them-moi" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">THÊM CÔNG VIỆC</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
                    {{ csrf_field() }}                     
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-plus" style="margin: 0px"></i></button>
               </div>
            </div>
         </div>
      </div>
  <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-to-do') }}", '.load-danh-sach');
      


      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-to-do') }}", "{{ route('danh-sach-to-do') }}", '.load-danh-sach');
          $("#modal-them-moi").removeClass("in");
          $(".modal-backdrop").remove();
          $("#modal-them-moi").hide();
      });

      $('.btn-load-form-them-moi').on('click',function(){
        getById(_token, "", "{{ route('to-do-single') }}", ".frm-them-moi"); // gọi sự kiện lấy dữ liệu theo id
      });
      
    });
  </script>
@endsection

