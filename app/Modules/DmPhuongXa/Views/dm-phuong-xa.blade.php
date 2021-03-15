@extends('layouts.index')
@section('title', 'Danh mục Xã/Phường')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               <h4 class="text-danger">CHỨC NĂNG ĐỌC FILE EXCEL</h4>

                <div class="text-right table-responsive">
                    <form class="forms-sample text-right" method="POST" action="{{ route('dm-phuong-xa/import') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group mr-2">  
                            <div class="col-sm-12">                          
                                <input type="file" class="dropify" name="file_excel">
                            </div>
                        </div>
                        <div class="btn-group mr-2">
                            <button type="submit" class="btn btn-sm btn-vnpt"><i class="mdi mdi-plus-circle-outline"></i> ĐỌC FILE</button>
                        </div>                        
                    </form>
                </div>
                <br>
               <div class="table-responsive">
                    <table id="order-listing" class="table table-hover">
                    <thead>
                        <tr class="background-vnpt text-center">
                            <th>STT #</th>
                            <th>Tên xã phường</th>
                            <th>Mã xã phường</th>
                            
                            <th>Loại</th>
                            <th>Mã huyện</th>
                            <th>Ngày cập nhật</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=0; ?>
                        @foreach($data as $xaPhuong)
                            <?php $stt++; ?>
                            <tr class="tr-small">
                                <td>{{$stt}}</td>
                                <td class="text-primary">{{$xaPhuong->ten_phuong_xa}}</td>
                                <td class="text-center">{{$xaPhuong->ma_phuong_xa}}</td>
                                
                                <td class="text-center">{{$xaPhuong->loai}}</td>
                                <td class="text-center">{{$xaPhuong->ma_quan_huyen}}</td>
                                <td class="text-center">{{$xaPhuong->updated_at}}</td>
                                <td class="text-center">
                                    <button class="btn btn-vnpt" id="notificationDropdown" href="#" data-toggle="dropdown">
                                        <i class="icon-list"></i>
                                      
                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                            <a class="dropdown-item preview-item">
                                                <p class="mb-0 font-weight-normal float-left text-primary"><b><i class="icon-wrench"></i> Sửa</b>
                                            </p>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item preview-item">
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
@endsection


