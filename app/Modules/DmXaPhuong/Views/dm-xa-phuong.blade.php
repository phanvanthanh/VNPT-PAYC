@extends('layouts.index')
@section('title', 'Danh mục Xã/Phường')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               <h4 class="color-vnpt">CHỨC NĂNG ĐỌC FILE EXCEL</h4>

                <div class="text-right table-responsive">
                    <form class="forms-sample text-right" method="POST" action="{{ route('dm-xa-phuong/import') }}" enctype="multipart/form-data">
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
                    <table id="order-listing" class="table">
                    <thead>
                        <tr class="background-vnpt">
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
                            <tr>
                                <td>{{$stt}}</td>
                                <td class="color-vnpt"><b>{{$xaPhuong->TEN_PHUONG_XA}}</b></td>
                                <td>{{$xaPhuong->MA_PHUONG_XA}}</td>
                                
                                <td>{{$xaPhuong->LOAI}}</td>
                                <td>{{$xaPhuong->MA_QUAN_HUYEN}}</td>
                                <td>{{$xaPhuong->updated_at}}</td>
                                <td>
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


