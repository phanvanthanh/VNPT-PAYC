@if($error=="")    
    <div class="load-danh-sach">
    
    </div>
    <div class="card" style="border: 1px solid #e2e2e2;">
        <div class="card-body">
            <form class="forms-sample frm-binh-luan" id="frm-binh-luan" name="frm-binh-luan">
                {{ csrf_field() }}
                <input type="hidden" name="id_payc" class="id_payc" value="{{$id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="main-title-sub">Phản hồi ý kiến:</div>
                    </div>
                    
                    <!-- <div class="col-2">
                        <div class="" style='    font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            Họ và tên <b class="text-danger">(*)</b>
                        </div>
                    </div>
                    <div class="col-10">
                        <input type="Text" value="Pha Văn Thanh" class="form-control ho_ten" name="ho_ten" placeholder="Nhập họ và tên người bình luận" style="height: 40px; margin-bottom: 20px;">
                    </div> -->

                    <div class="col-2">
                        <div style='font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            Nội dung trả lời<b class="text-danger">(*)</b>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control noi_dung"  name="noi_dung" rows="5" style="resize: none;overflow: hidden;overflow-wrap: break-word;height: 65px; margin-bottom: 20px;"></textarea>
                    </div>
                    <div class="col-2">
                        <div style='font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            File phản hồi
                        </div>
                    </div>
                    <div class="col-10">                     
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control d-none d-sm-block" disabled="" placeholder="Có thể upload các file hình ảnh, video, word, excel, pdf.">
                            <div class="input-group-append">
                              <button class="btn btn-vnpt btn-browse-file" click-on-class=".input-file" type="button"><i class="icon-cloud-upload"></i> Chọn file cần upload</button>         
                              <input type="file" class="input-file" show-file=".giz-upload-01" name="file[]" multiple hidden="true">
                            </div>
                          </div>
                        <span class="show-file giz-upload-01"></span>
                    </div>

                    <div class="col-2">
                        <div style='font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            &nbsp;<br>
                        </div>
                    </div>
                    <div class="col-10 text-right">
                        <br>
                        <a href="#" class="btn btn-vnpt btn-tra-loi"><i class="fa fa-send-o"></i> &nbsp; Gửi trả lời</a>
                    </div>
                </div>
            </form>
                
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('public/js/uploadFile.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
          var _token=jQuery('form[name="frm-binh-luan"]').find("input[name='_token']").val();
          loadTableById(_token, "{{$id}}", "{{ route('danh-sach-binh-luan') }}", '.load-danh-sach');

          $('.btn-tra-loi').on('click',function(){
              themMoi(_token, $("form#frm-binh-luan"), "{{ route('tra-loi-binh-luan') }}", "", '');
              location.reload();
          });
          

          
        });
      </script>

    
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

