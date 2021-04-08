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
                        <div class="main-title-sub">Ý kiến đánh giá khác:</div>
                    </div>
                    
                    <div class="col-2">
                        <div class="" style='    font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            Họ và tên <b class="text-danger">(*)</b>
                        </div>
                    </div>
                    <div class="col-10">
                        <input type="Text" class="form-control ho_ten" name="ho_ten" placeholder="Nhập họ và tên người bình luận" style="height: 40px; margin-bottom: 20px;">
                    </div>

                    <div class="col-2">
                        <div style='font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            Nội dung <b class="text-danger">(*)</b>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control noi_dung"  name="noi_dung" rows="5" style="resize: none;overflow: hidden;overflow-wrap: break-word;height: 65px; margin-bottom: 20px;"></textarea>
                    </div>

                    <div class="col-2">
                        <div style='font-family:"Nunito", Arial;font-size: 18px; color: #1E2F41;'>
                            &nbsp;
                        </div>
                    </div>
                    <div class="col-10 text-right">
                        <a href="#" class="btn btn-vnpt btn-gui-binh-luan"><i class="fa fa-send-o"></i> &nbsp; Gửi góp ý</a>
                    </div>
                </div>
            </form>
                
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
          var _token=jQuery('form[name="frm-binh-luan"]').find("input[name='_token']").val();
          loadTableById(_token, "{{$id}}", "{{ route('danh-sach-binh-luan') }}", '.load-danh-sach');

          $('.btn-gui-binh-luan').on('click',function(){
              themMoi(_token, $("form#frm-binh-luan"), "{{ route('gui-binh-luan') }}", "", '');
              location.reload();
          });
          

          
        });
      </script>

    
@else
  <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif

