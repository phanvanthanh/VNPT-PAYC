@if($error=="")    
    <link rel="stylesheet" href="{{ secure_asset('public/css/tree.css') }}">
    <div class="row">
        <div class="col-12">
            <small class="form-text text-muted">Nội dung xử lý</small>
            <textarea class="form-control"  name="noi_dung_xu_ly" id="noi_dung_xu_ly" rows="5"></textarea>
        </div>
        <div class="col-12">
            <small class="form-text text-muted">File xử lý đính kèm</small>
            <div class="input-group col-xs-12">
                <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
                <div class="input-group-append">
                  <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn file cần upload</button>         
                  <input type="file" class="input-file" show-file=".giz-upload-01" name="file_xu_ly[]" multiple hidden="true">
                </div>
              </div>
            <span class="show-file giz-upload-01"></span>
        </div>
        <div class="col-12">
            <br>
            <table id="order-listing" class="table table-hover table-striped">
                <thead>
                    <tr class="background-vnpt">
                        <th class="text-center" scope="col">STT</th>
                        <th scope="col"><input type="checkbox" name="id_user[]" class="check-all" check-all-on=".check-all-child" id="check-all-child">&nbsp;&nbsp;<label for="check-all-child">Tên đơn vị/Cán bộ</label></th>
                        <td class="text-center">Chức vụ</td>
                    </tr>
                </thead>
                <tbody>
                    

                    @php $stt=0; @endphp
                    @foreach($data as $d)
                    @php $stt++; @endphp
                        <tr class="tr-hover tr-small t-tree cusor" data-id="{{$d['id']}}" data-parent="{{$d['parent_id']}}" data-show="1">
                            <td class="text-center">{{$stt}}</td>
                            <td>      
                                @if($d['level']>0)
                                    @for ($i = 0; $i < $d['level']; $i++)
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endfor
                                @endif              
                                @if($d['has_child'])
                                    <span class="text-primary"><i class="tree-icon fa fa-minus-square-o text-primary"></i>&nbsp;&nbsp;{{$d['ten_don_vi']}}</span>
                                @else
                                    @if($d['ma_cap']==null || $d['ma_cap']=='')
                                        <i class="text-primary">{{$d['ten_don_vi']}}</i>
                                    @else
                                        <i class="text-primary">{{$d['ten_don_vi']}}</i>
                                    @endif

                                @endif
                                
                            </td>
                            <td></td>
                        </tr>
                        @php $d['level']=$d['level']+2; @endphp
                        @foreach($d['ds_can_bo'] as $canBo)
                            @php $stt++; @endphp
                            <tr class="tr-hover tr-small t-tree cusor" data-id="" data-parent="{{$canBo['id_don_vi']}}" data-show="1">
                                <td class="text-center">{{$stt}}</td>
                                <td>
                                    @for ($i = 0; $i < $d['level']; $i++)
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endfor
                                    <input type="checkbox" name="id_user" value="{{$canBo['id']}}" data-id="{{$canBo['id']}}" class="check-all-child id-child-user" id="user-{{$canBo['id']}}"> &nbsp; <label for="user-{{$canBo['id']}}">{{$canBo['name']}}</label>
                                </td>
                                <td>{{$canBo['ten_nhom_chuc_vu']}}</td>
                            </tr>
                                    
                        @endforeach
                    @endforeach
                </tbody>
                    
                    
            </table>
        </div>
        
    </div>
    <script type="text/javascript" src="{{ secure_asset('public/js/checkAll.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('public/js/tree.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('public/js/uploadFile.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('public/js/t-tree.js') }}"></script>

@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

