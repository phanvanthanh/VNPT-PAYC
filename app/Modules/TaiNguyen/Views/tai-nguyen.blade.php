@extends('layouts.index')
@section('title', 'Danh mục chức năng')
@section('content')
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger">DANH SÁCH CHỨC NĂNG HỆ THỐNG</h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
                </div>
               

                <div class="text-right table-responsive">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-vnpt" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm</button>
                    </div>
                    <div class="btn-group mr-2">
                        <form class="forms-sample text-right frm-quet-tai-nguyen" name="frm-quet-tai-nguyen" method="POST" action="{{ route('quet-tai-nguyen') }}">
                        {{ csrf_field() }}
                            <button type="submit" class="btn btn-light"><i class="mdi mdi-delete-empty"></i> Quét lại thông tin</button>
                        </form>
                    </div>
                </div>
                <br>
               <div class="table-responsive load-table-all">
                                  
               </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-them-moi" tabindex="-1" role="dialog" aria-labelledby="modal-them-moi" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header background-vnpt">
                  <h5 class="modal-title">TẠO MENU MỚI</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample frm-them-moi" id="frm-them-moi" name="frm-them-moi">
                    {{ csrf_field() }}
                     <div class="form-group row">
                        <label for="ten_hien_thi" class="col-sm-4 col-form-label ">Tên menu</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control ten_hien_thi" name="ten_hien_thi" placeholder="Vui lòng nhập tên menu cần tạo">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="resource" class="col-sm-4 col-form-label ">Resource</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control resource" name="resource" placeholder="Vui lòng nhập tài nguyên">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="method" class="col-sm-4 col-form-label ">Phương thức</label>
                        <div class="col-sm-8">
                           <select class="form-control method" name="method">
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUSH">PUSH</option>
                            <option value="DELETE">DELETE</option>
                          </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="action" class="col-sm-4 col-form-label ">Action</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" name="action" placeholder="Vui lòng nhập Controller của chức năng">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="parent_id" class="col-sm-4 col-form-label">Menu cha</label>
                        <div class="col-sm-8">
                           <select class="form-control parent_id" name="parent_id">
                            <option value="1" >Menu trái</option>
                            @foreach($resources as $resource)
                              @if($resource->parent_id==1)
                                <option value="{{$resource->id}}">{{$resource->ten_hien_thi}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="uri" class="col-sm-4 col-form-label ">URI</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" name="uri" placeholder="Vui lòng nhập URI của chức năng">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="show_menu" class="col-sm-4 col-form-label">Loại hiển thị menu</label>
                        <div class="col-sm-8">
                           <select class="form-control show_menu" name="show_menu">
                            <option value="1">Hiển thị trên menu</option>
                            <option value="2">Ẩn trên menu</option>
                            <option value="3">Không hiển thị ở tất cả chức năng(Chỉ lưu trong DB)</option>
                          </select>
                        </div>
                     </div>
                     

                     <div class="form-group row">
                        <label for="order" class="col-sm-4 col-form-label ">Sắp xếp</label>
                        <div class="col-sm-8">
                           <input type="Number" class="form-control" name="order" placeholder="Vui lòng nhập vị trí hiển thị của chức năng" value="<?php echo count($resources); ?>">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="icon" class="col-sm-4 col-form-label ">ICON</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" name="icon" placeholder="Vui lòng nhập ICON của chức năng">
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-vnpt btn-them-moi"><i class="icon-check"></i> Tạo menu</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Không tạo</button>
               </div>
            </div>
         </div>
      </div>

  <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var _token=jQuery('form[name="frm-them-moi"]').find("input[name='_token']").val();
      loadTable(_token, "{{ route('tai-nguyen-all') }}", '.load-table-all');

      $('.btn-them-moi').on('click',function(){
          themMoi(_token, $("form#frm-them-moi"), "{{ route('them-tai-nguyen') }}", "{{ route('tai-nguyen-all') }}", '.load-table-all');
          jQuery("#modal-them-moi").modal('hide');
      });
      

      
    });
  </script>
@endsection

