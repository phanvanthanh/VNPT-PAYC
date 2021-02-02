@extends('layouts.index')
@section('title', 'Quản trị nhóm quyền')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">QUẢN TRỊ NHÓM QUYỀN</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               

                <div class="text-right table-responsive">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm nhóm quyền</button>
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
                  <h5 class="modal-title">TẠO MỚI NHÓM QUYỀN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
                    {{ csrf_field() }}
                     <div class="form-group row">
                        <label for="role_name" class="col-sm-4 col-form-label ">Tên nhóm quyền</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control role_name" name="role_name" placeholder="Vui lòng nhập tên nhóm quyền cần tạo">
                        </div>
                     </div>
                     
                     <div class="form-group row">
                        <label for="id_don_vi" class="col-sm-4 col-form-label">Đơn vị</label>
                        <div class="col-sm-8">
                           <select class="form-control id_don_vi" name="id_don_vi">
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
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i> Tạo nhóm quyền</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Không tạo</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('danh-sach-nhom-quyen') }}", '.load-danh-sach');

      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-nhom-quyen') }}", "{{ route('danh-sach-nhom-quyen') }}", '.load-danh-sach');
          jQuery("#modal-them-moi").modal('hide');
      });
      

      
    });
  </script>
@endsection

