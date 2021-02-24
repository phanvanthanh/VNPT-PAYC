@if($error=="")
  @php $checkData=0; @endphp
  @php if($data){$checkData=1;} @endphp
                <div class="row">
                  <div class="col-12">
                    <small class="form-text text-muted">Tiêu đề</small>
                    <!-- <label for="tieu_de" class="text- title-input-size">* Tiêu đề</label> -->
                    <input type="Text" class="form-control tieu_de" name="tieu_de" placeholder="Tiêu đề là thông tin rút gọn của nội dung yêu cầu." @if($checkData==1) value="{{$data['tieu_de']}}" @endif>
                  </div>
                  <div class="col-12">
                    <small class="form-text text-muted">Số phiếu</small>
                    <!-- <label for="tieu_de" class="text- title-input-size">* Tiêu đề</label> -->
                    <input type="Text" class="form-control so_phieu" name="so_phieu" placeholder="Số phiếu yêu cầu" @if($checkData==1) value="{{$data['so_phieu']}}" @endif>
                  </div>
                  <div class="col-12">
                    <small class="form-text text-muted"><b class="text-danger">*</b> Mô tả</small>
                    <div class="summernote"><?php if($checkData==1) echo $data['noi_dung']; ?></div>
                    <textarea class="form-control noi_dung" name="noi_dung" rows="3" hidden="true"></textarea>
                  </div>
                  <div class="col-12">
                    <small class="form-text text-muted">Upload file</small>
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
                        <div class="input-group-append">
                          <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn file cần upload</button>         
                          <input type="file" class="input-file" show-file=".giz-upload-01" name="file_payc[]" multiple hidden="true">
                        </div>
                      </div>
                    <span class="show-file giz-upload-01"></span>
                    <?php
                        if($checkData==1){
                          $files=explode(';', $data['file_payc']);
                          foreach ($files as $key => $file) {
                            if($file){
                              echo '<a href="/file/download/'.$file.'" class="a-file"><div class="show-file">'.$file.'</div></a>';
                            }
                          }
                        }
                      ?>
                  </div>
                  
                </div>
                    

                
              
              <div class="row">
                <div class="col-12">
                  <small class="form-text text-muted">Dịch vụ</small>
                  <!-- <label for="id_dich_vu" class="text-title-input-size">* Dịch vụ</label> -->
                    <select class="form-control" id="id_dich_vu" name="id_dich_vu" aria-describedby="dich_vu_helper">
                        @foreach($dichVus as $dichVu)
                          <option @if($checkData==1) @if($dichVu['id']==$data['id_dich_vu']) {{'selected="selected"'}} @endif @endif value="{{$dichVu['id']}}">{{$dichVu['ten_dich_vu']}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <script type="text/javascript" src="{{ asset('public/js/uploadFile.js') }}"></script>
              <script type="text/javascript">
                $('.summernote').summernote({
                  height: 150,                 // set editor height
                  minHeight: null,             // set minimum height of editor
                  maxHeight: null,             // set maximum height of editor
                  focus: false                 // set focus to editable area after initializing summernote
                });


                jQuery('.show-file').each(function( index ) {
                  var name=jQuery(this).text();
                  if(name){
                      var arr=name.split(".");
                      if(arr[arr.length-1]=='xls' || arr[arr.length-1]=='xlsx'){
                          jQuery(this).html('<i style="color:green;" class="mdi mdi-file-excel"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='doc' || arr[arr.length-1]=='docx'){
                          jQuery(this).html('<i style="color:blue;" class="mdi mdi-file-word"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='ppt' || arr[arr.length-1]=='pptx'){
                          jQuery(this).html('<i style="color:red;" class="mdi mdi-file-powerpoint"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='pdf'){
                          jQuery(this).html('<i style="color:red;" class="mdi mdi-file-pdf-box"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='php' || arr[arr.length-1]=='prc' || arr[arr.length-1]=='html' || arr[arr.length-1]=='js' || arr[arr.length-1]=='java' || arr[arr.length-1]=='css' || arr[arr.length-1]=='asp' || arr[arr.length-1]=='aspx' || arr[arr.length-1]=='sql' || arr[arr.length-1]=='pbix'){
                          jQuery(this).html('<i style="color:grey;" class="mdi mdi-code-not-equal-variant"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='txt'){
                          jQuery(this).html('<i  style="color:grey;" class="mdi mdi-note-text"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='zip' || arr[arr.length-1]=='rar'){
                          jQuery(this).html('<i style="color:grey;" class="mdi mdi-zip-box"></i> '+name+'<br>');
                      }
                      else if(arr[arr.length-1]=='png' || arr[arr.length-1]=='jpg' || arr[arr.length-1]=='jpeg'){
                          jQuery(this).html('<i grey class="mdi mdi-file-image"></i> '+name+'<br>');
                      }else{
                          jQuery(this).html('<i grey class="mdi mdi-file"></i> '+name+'<br>');
                      }
                  }
                      
              });
              </script>
@else
  {{ csrf_field() }}
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif




