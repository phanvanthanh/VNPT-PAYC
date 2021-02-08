@extends('layouts.index')
@section('title', 'Danh mục to do')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-danger">DANH MỤC TO DO</h4>
                </div>
                <div class="col-6">
                    <div class="error-mode float-right"></div> 
                </div>
            </div>

            <div class="text-right table-responsive">
                <div class="btn-group mr-2">
                    <button class="btn btn-sm btn-vnpt btn-load-form-them-moi" data-toggle="modal" data-target="#modal-them-moi"><i class="mdi mdi-plus-circle-outline"></i> Thêm đơn vị</button>
                </div>
            </div>
            <br>
            <div class="table-responsive load-danh-sach">
                <table id="order-listing" class="table table-hover">
                    <thead>
                        <tr class="background-vnpt">
                            <th>STT</th>
                            <th>Nội dung</th>
                            <th>Ngày tạo</th>
                            <th>Ngày giao</th>
                            <th>Hạn xử lý</th>
                            <th>Trạng thái</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>                       

                        <?php 
                        $stt=0;
                        ?>
                        @foreach($toDos as $toDo)
                        <?php $stt++; ?>
                        <tr class="tr-hover">
                            <td class="text-center">{{$stt}}</td>
                            <td class='text-primary'>
                                {{$toDo['noi_dung']}}
                            </td>
                            <td>
                                {{$toDo['ngay_tao']}}
                            </td>
                            <td>
                                {{$toDo['ngay_giao']}}
                            </td>
                            <td>                    
                                {{$toDo['han_xu_ly']}}
                            </td>
                            <td>
                                <label class=" @if($toDo['trang_thai']==1) {{'text-primary'}} @else {{'text-danger'}} @endif">@if($toDo['trang_thai']==1) {{'Đang hoạt động'}} @else {{'Ngừng hoạt động'}} @endif</label>
                            </td>
                            <td>
                                <button class="btn btn-vnpt" href="#" data-toggle="dropdown">
                                    <i class="icon-list"></i>                          
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                        <a class="dropdown-item preview-item btn-sua" data="{{$toDo['id']}}">
                                            <p class="mb-0 font-weight-normal float-left text-primary"><b><i class="icon-wrench"></i> Sửa</b>
                                            </p>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item preview-item btn-xoa" data="{{$toDo['id']}}">
                                            <p class="mb-0 font-weight-normal float-left text-danger"><b><i class="icon-basket "></i> Xóa</b>
                                            </p>
                                        </a>                                 
                                    </div>
                                </button>
                            </td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
           
<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">SỬA TO DO</h5>
              {{ csrf_field() }}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body card">
                <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
                    {{ csrf_field() }}
                </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-vnpt btn-cap-nhat"><i class="icon-check"></i> Cập nhật</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
           </div>
        </div>
     </div>
</div>


<script type="text/javascript">
</script>
@endsection