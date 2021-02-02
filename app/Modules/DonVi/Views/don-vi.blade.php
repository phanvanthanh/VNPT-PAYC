@extends('layouts.index')
@section('title', 'Danh mục đơn vị')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">DANH MỤC ĐƠN VỊ</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               

                <div class="text-right table-responsive">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm đơn vị</button>
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
                  <h5 class="modal-title">TẠO MỚI ĐƠN VỊ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
                    {{ csrf_field() }}
                     <div class="form-group row">
                        <label for="ten_don_vi" class="col-sm-4 col-form-label ">Tên đơn vị</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control ten_don_vi" name="ten_don_vi" placeholder="Vui lòng nhập tên đơn vị cần tạo">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="dia_chi" class="col-sm-4 col-form-label ">Địa chỉ</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control dia_chi" name="dia_chi" placeholder="Vui lòng nhập địa chỉ">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label ">Email</label>
                        <div class="col-sm-8">
                           <input type="email" class="form-control email" name="email" placeholder="Vui lòng nhập Email">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="di_dong" class="col-sm-4 col-form-label ">Số điện thoại di động</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control di_dong" name="di_dong" placeholder="Vui lòng nhập Số điện thoại di động">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="co_dinh" class="col-sm-4 col-form-label ">Số điện thoại cố định</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control co_dinh" name="co_dinh" placeholder="Vui lòng nhập Số điện thoại cố định">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="fax" class="col-sm-4 col-form-label ">Số fax</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control fax" name="fax" placeholder="Vui lòng nhập số fax">
                        </div>
                     </div>


                     
                     <div class="form-group row">
                        <label for="parent_id" class="col-sm-4 col-form-label">Đơn vị cấp trên</label>
                        <div class="col-sm-8">
                           <select class="form-control parent_id" name="parent_id">
                            @foreach($donVis as $donVi)
                                <option value="{{$donVi['id']}}">
                                  @if($donVi['level']>0)
                                    @for ($i = 0; $i < $donVi['level']; $i++)
                                        {{"____ "}}
                                    @endfor
                                  @endif {{$donVi['ten_don_vi']}}
                                </option>
                            @endforeach
                          </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="state" class="col-sm-4 col-form-label">Trạng thái</label>
                        <div class="col-sm-8">
                           <select class="form-control state" name="state">
                            <option value="1">Hoạt động</option>
                            <option value="0">Ngừng hoạt động</option>
                          </select>
                        </div>
                     </div>
                     
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i>Tạo đơn vị</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Không tạo</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-don-vi') }}", '.load-danh-sach');

      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-don-vi') }}", "{{ route('danh-sach-don-vi') }}", '.load-danh-sach');
          jQuery("#modal-them-moi").modal('hide');
      });
      

      
    });
  </script>
@endsection

