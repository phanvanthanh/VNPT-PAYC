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
        
        
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/checkAll.js"></script>
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/tree.js"></script>
    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/uploadFile.js"></script>


@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

