@if($error=="")    
    <link rel="stylesheet" href="https://baocaotuan.vnpttravinh.vn/public/css/tree.css">
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
                                        <input type="checkbox" name="id_user" value="{{$d['id']}}" data-id="{{$d['id']}}" class="check-all-child id-child-user" id="don-vi-{{$d['id']}}"> &nbsp; <label for="don-vi-{{$d['id']}}"><i>{{$d['ten_don_vi']}}</i></label>
                                    @else
                                        <input type="checkbox" name="id_user" value="{{$d['id']}}" data-id="{{$d['id']}}" class="check-all-child id-child-user" id="don-vi-{{$d['id']}}"> &nbsp; <label for="don-vi-{{$d['id']}}">{{$d['ten_don_vi']}}</label>
                                    @endif

                                @endif
                                
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
                    
                    
            </table>
        </div>
        
    </div>
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/checkAll.js"></script>
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/tree.js"></script>
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/uploadFile.js"></script>
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/t-tree.js"></script>
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

