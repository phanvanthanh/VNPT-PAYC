@extends('layouts.index')
@section('title', 'Map đơn vị ĐHSXKD')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">MAP ĐƠN VỊ ĐHSXKD</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               

                <div class="text-right table-responsive">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-danger btn-quet-don-vi-dhsxkd"><i class="fa fa-retweet"></i> Quét đơn vị ĐHSXKD</button>
                    </div>
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt btn-load-form-them-moi" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm đơn vị ĐHSXKD</button>
                    </div>
                </div>
                <br>
               <div class="table-responsive load-danh-sach">
                                  
               </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-them-moi" tabindex="-1" role="dialog" aria-labelledby="modal-them-moi" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">MAP ĐƠN VỊ ĐHSXKD</h5>
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
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i> Thêm mới</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-map-don-vi-dhsxkd') }}", '.load-danh-sach');

      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-map-don-vi-dhsxkd') }}", "{{ route('danh-sach-map-don-vi-dhsxkd') }}", '.load-danh-sach');
          jQuery("#modal-them-moi").modal('hide');
      });

      $('.btn-load-form-them-moi').on('click',function(){
        getById(_token, "", "{{ route('map-don-vi-dhsxkd-single') }}", ".frm-them-moi"); // gọi sự kiện lấy dữ liệu theo id
      });

      quetDonViLienThongDhsxkd=function(){     
        loading('.error-mode');
        var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
        jQuery.ajax({
          url: "{{ route('quet-don-vi-lien-thong-dhsxkd') }}",
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token
          },
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            $(".error-mode").empty();
            if(data.error==""){
              loadTable(_token, "{{ route('danh-sach-map-don-vi-dhsxkd') }}", '.load-danh-sach');              
            }else{
              errorLoader(".error-mode",data.error);
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
      }

      $('.btn-quet-don-vi-dhsxkd').on('click',function(){
        quetDonViLienThongDhsxkd();
      });
      

      
    });
  </script>
@endsection

