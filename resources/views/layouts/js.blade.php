      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
      <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/custom.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/checkAll.js') }}"></script>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script type="text/javascript" src="{{ asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script type="text/javascript" src="{{ asset('public/vendors/lightgallery/js/lightgallery-all.min.js') }}"></script>
      <!-- End plugin js for this page-->

      <!-- Sumerynote -->
      <script type="text/javascript" src="{{ asset('public/vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/tinymce/tinymce.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/quill/quill.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/simplemde/simplemde.min.js') }}"></script>
      
      <!-- inject:js -->
      <script type="text/javascript" src="{{ asset('public/js/off-canvas.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/hoverable-collapse.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/misc.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/settings.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/todolist.js') }}"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script type="text/javascript" src="{{ asset('public/js/light-gallery.js') }}"></script>




      <script type="text/javascript" src="{{ asset('public/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/progressbar.js/progressbar.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/inputmask/jquery.inputmask.bundle.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/inputmask/phone.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/inputmask/phone-be.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/inputmask/phone-ru.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/inputmask/inputmask.binding.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/dropify/dropify.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/dropzone/dropzone.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/jquery-file-upload/jquery.uploadfile.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/jquery-asColor/jquery-asColor.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/moment/moment.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/x-editable/bootstrap-editable.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/clockpicker/jquery-clockpicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/jquery.repeater/jquery.repeater.min.js') }}"></script>
      <!-- Custom js for this page-->
      <script type="text/javascript" src="{{ asset('public/js/formpickers.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/form-addons.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/x-editable.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/dropify.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/dropzone.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/jquery-file-upload.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/formpickers.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/form-repeater.js') }}"></script>

      <!-- Plugin js for this page-->
      <script type="text/javascript" src="{{ asset('public/vendors/datatables.net/jquery.dataTables.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/data-table.js') }}"></script>
      <!-- End plugin js for this page-->
      
      <!-- End custom js for this page-->
      <script type="text/javascript" src="{{ asset('public/js/tooltips.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/popover.js') }}"></script>

      <script type="text/javascript">
         jQuery(document).ready(function(){
            $(".dropify").change(function() {
                  $('#myImg').html('');
                  if (this.files && this.files[0]) {
                        for (var i = 0; i < this.files.length; i++) {
                              var reader = new FileReader();
                              reader.onload = imageIsLoaded;
                              reader.readAsDataURL(this.files[i]);
                        }
                  }
            });

            $('.summernote').summernote({
              height: 100,                 // set editor height
              minHeight: null,             // set minimum height of editor
              maxHeight: null,             // set maximum height of editor
              focus: false                 // set focus to editable area after initializing summernote
            });

            function imageIsLoaded(e) {
                  
                  $('#myImg').append('<img src=' + e.target.result + ' style="max-height:200px; max-width:200px;">');
            };

            jQuery('.dang-nhap').on('click',function(){
                  window.location.href = "{{ route('login') }}";
            });


            jQuery('.btn-browse-file').on('click',function(){
                  var inputClass=jQuery(this).attr('click-on-class');
                  jQuery(inputClass).click();
            });
            
            $('input[type=file]').change(function (e) {
                  var html='';
                  var showFileIntoClass=jQuery(this).attr('show-file');
                  $.each( e.target.files, function( key, value ) {
                        var name=value.name;
                        var arr=name.split(".");
                        if(arr[arr.length-1]=='xls' || arr[arr.length-1]=='xlsx'){
                            html+='<i style="color:green;" class="mdi mdi-file-excel"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='doc' || arr[arr.length-1]=='docx'){
                            html+='<i style="color:blue;" class="mdi mdi-file-word"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='ppt' || arr[arr.length-1]=='pptx'){
                            html+='<i style="color:red;" class="mdi mdi-file-powerpoint"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='pdf'){
                            html+='<i style="color:red;" class="mdi mdi-file-pdf-box"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='php' || arr[arr.length-1]=='prc' || arr[arr.length-1]=='html' || arr[arr.length-1]=='js' || arr[arr.length-1]=='java' || arr[arr.length-1]=='css' || arr[arr.length-1]=='asp' || arr[arr.length-1]=='aspx' || arr[arr.length-1]=='sql' || arr[arr.length-1]=='pbix'){
                            html+='<i style="color:grey;" class="mdi mdi-code-not-equal-variant"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='txt'){
                            html+='<i  style="color:grey;" class="mdi mdi-note-text"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='zip' || arr[arr.length-1]=='rar'){
                            html+='<i style="color:grey;" class="mdi mdi-zip-box"></i> '+name+'<br>';
                        }
                        else if(arr[arr.length-1]=='png' || arr[arr.length-1]=='jpg' || arr[arr.length-1]=='jpeg'){
                            html+='<i grey class="mdi mdi-file-image"></i> '+name+'<br>';
                        }else{
                            html+='<i grey class="mdi mdi-file"></i> '+name+'<br>';
                        }
                  });
                  $(showFileIntoClass).html(html);
            });

            var pathname = window.location.pathname.substring(1);
            jQuery('.nav-item').removeClass('active');
            jQuery('.nav-link').each(function( index ) {
              var href=jQuery(this).attr("href");
              if(href==pathname){
                jQuery(this).parent().addClass('active');
              }
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

            jQuery('.check-id-payc').on('click', function(){
              console.log("Vo 2");
              if(jQuery(this).find('input:checkbox').is(":checked")){
                jQuery(this).find('input:checkbox').prop('checked', false);
              }else{
                jQuery(this).find('input:checkbox').prop('checked', true);
              }
            });

            jQuery('.check-one-id-payc').on('click', function(){
              if(jQuery(this).find('input:checkbox').is(":checked")){
                jQuery(this).find('input:checkbox').prop('checked', false);
              }else{
                jQuery('.check-one-id-payc').find('input:checkbox').prop('checked', false);
                jQuery(this).find('input:checkbox').prop('checked', true);
              }
            });

            jQuery("input[type='checkbox'].id_payc").on('click',function(){
              console.log("Vo 1");
            });


        
        $('.qtxl').on('click',function(){
            var _token=jQuery('form[name="frm-qtxl"]').find("input[name='_token']").val();
            var id=jQuery(this).attr('value');
            getById(_token, id, "{{ route('qtxl') }}", ".frm-qtxl"); // gọi sự kiện lấy dữ liệu theo id
        });


        // Tiếp nhận và chuyển xử lý
        $('.btn-tiep-nhan-va-chuyen-xu-ly').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-tiep-nhan-va-chuyen-xu-ly"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_tiep_nhan_va_chuyen_xu_ly').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-tiep-nhan-va-chuyen-xu-ly') }}", ".frm-tiep-nhan-va-chuyen-xu-ly");  
            $('.btn-tiep-nhan-va-chuyen-xu-ly-2').attr("disabled",false);
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-tiep-nhan-va-chuyen-xu-ly-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_tiep_nhan_va_chuyen_xu_ly').val(dsIdUser);
          xuLy($("form#frm-tiep-nhan-va-chuyen-xu-ly"), "{{ route('tiep-nhan-va-chuyen-xu-ly') }}", "");
          jQuery("#modal-tiep-nhan-va-chuyen-xu-ly").modal('hide');
          
        });

        // Xử lý
        $('.btn-xu-ly').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-xu-ly"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_xu_ly').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-xu-ly') }}", ".frm-xu-ly");  
            $('.btn-xu-ly-2').attr("disabled",false);
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-xu-ly-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_xu_ly').val(dsIdUser);
          xuLy($("form#frm-xu-ly"), "{{ route('xu-ly') }}", "");
          jQuery("#modal-xu-ly").modal('hide');
          
        });


        // Duyệt
        $('.btn-duyet').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-duyet"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_duyet').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-duyet') }}", ".frm-duyet");  
            $('.btn-duyet-2').attr("disabled",false);
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-duyet-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_duyet').val(dsIdUser);
          xuLy($("form#frm-duyet"), "{{ route('duyet') }}", "");
          jQuery("#modal-duyet").modal('hide');
          
        });


        // Chuyển bộ phận tiếp nhận và xử lý yêu cầu
        $('.btn-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc') }}", ".frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc");  
            $('.btn-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc-2').attr("disabled",false);
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc').val(dsIdUser);
          xuLy($("form#frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc"), "{{ route('chuyen-bo-phan-tiep-nhan-va-xu-ly-payc') }}", "");
          jQuery("#modal-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc").modal('hide');
          
        });

        // Chuyển lãnh đạo
        $('.btn-chuyen-lanh-dao').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-chuyen-lanh-dao"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_chuyen_lanh_dao').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-chuyen-lanh-dao') }}", ".frm-chuyen-lanh-dao");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-chuyen-lanh-dao-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_chuyen_lanh_dao').val(dsIdUser);

          xuLy($("form#frm-chuyen-lanh-dao"), "{{ route('chuyen-lanh-dao') }}", "");
          jQuery("#modal-chuyen-lanh-dao").modal('hide');
          
        });


        // Hoàn tất
        $('.btn-hoan-tat-xu-ly').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-hoan-tat"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_hoan_tat').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-hoan-tat') }}", ".frm-hoan-tat");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-hoan-tat-xu-ly-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          xuLy($("form#frm-hoan-tat"), "{{ route('hoan-tat') }}", "");
          jQuery("#modal-hoan-tat").modal('hide');
          
        });

        // Trả lại không xử lý
        $('.btn-tra-lai-khong-xu-ly').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-tra-lai-khong-xu-ly"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_tra_lai_khong_xu_ly').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-tra-lai-khong-xu-ly') }}", ".frm-tra-lai-khong-xu-ly");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-tra-lai-khong-xu-ly-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          xuLy($("form#frm-tra-lai-khong-xu-ly"), "{{ route('tra-lai-khong-xu-ly') }}", "");
          jQuery("#modal-tra-lai-khong-xu-ly").modal('hide');
          
        });

        // Hủy yêu cầu
        $('.btn-huy').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-huy"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_huy').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-huy') }}", ".frm-huy");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-huy-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          xuLy($("form#frm-huy"), "{{ route('huy') }}", "");
          jQuery("#modal-huy").modal('hide');
          
        });

        // Cập nhật Payc
        $('.btn-cap-nhat-payc').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-cap-nhat-payc"]').find("input[name='_token']").val();
          var id=getIdPaycCapNhatCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(id){
            jQuery('.id_payc_cap_nhat').val(id);
            // tạo form chuyển
            getById(_token, id, "{{ route('frm-cap-nhat-payc') }}", ".frm-cap-nhat-payc");  
          }else{
            return false;
          }
          
        });

        $('.btn-cap-nhat-payc-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var moTa=jQuery('.note-editable').html();
          jQuery('.noi_dung').val(moTa);
          xuLy($("form#frm-cap-nhat-payc"), "{{ route('cap-nhat-payc') }}", "");
          jQuery("#modal-cap-nhat-payc").modal('hide');
          
        });

        // Chuyển khách hàng đánh giá
        $('.btn-chuyen-kh-danh-gia').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          if(confirm("Bạn thật sự muốn chuyển khách hàng đánh giá những yêu cầu này?")){
            var _token=jQuery('form[name="frm-hoan-tat"]').find("input[name='_token']").val();
            var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
            if(dsId){
              // tạo form chuyển
              chuyenKHDanhGia(_token, dsId, "{{ route('chuyen-kh-danh-gia') }}");  
            }else{
              alert("Vui lòng chọn các yêu cầu cần xử lý!");
              return false;
            }
          }
          
        });

        // Đánh giá
        $('.btn-ld-danh-gia').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
            var _token=jQuery('form[name="frm-danh-gia"]').find("input[name='_token']").val();
            jQuery('.loai_danh_gia').val(1);
            var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
            if(dsId){
              // tạo form chuyển
              jQuery('.ds_id_payc_danh_gia').val(dsId);
            }else{
              alert("Vui lòng chọn các yêu cầu cần xử lý!");
              return false;
            }
          
        });
        $('.btn-kh-danh-gia').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
            var _token=jQuery('form[name="frm-danh-gia"]').find("input[name='_token']").val();
            jQuery('.loai_danh_gia').val(2);
            var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
            if(dsId){
              // tạo form chuyển
              jQuery('.ds_id_payc_danh_gia').val(dsId);
            }else{
              alert("Vui lòng chọn các yêu cầu cần xử lý!");
              return false;
            }
          
        });

        $('.btn-danh-gia-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          xuLy($("form#frm-danh-gia"), "{{ route('danh-gia') }}", "");
          jQuery("#modal-danh-gia").modal('hide');
          
        });

        getDsIdPaycCheckbox=function(){
          var dsId='';
          jQuery('.id_payc').each(function( index ){
            if(jQuery(this).is(":checked")){
              dsId+=jQuery(this).val()+';';
            }
          });
          return dsId;
        }

        getDsIdUserCheckbox=function(){
          var dsId='';
          jQuery('.id-child-user').each(function( index ){
            if(jQuery(this).is(":checked")){
              dsId+=jQuery(this).val()+';';
            }
          });
          return dsId;
        }
        getIdPaycCapNhatCheckbox=function(){
          var id=''; var stt=0;
          jQuery('.id_payc').each(function( index ){
            if(jQuery(this).is(":checked")){
              stt++;
              id=jQuery(this).val();              
            }
          });
          if(stt==1){
            return id;
          }else{
            if(stt==0){
              alert("Vui lòng chọn YC cần cập nhật");  
            }else{
              alert("Chỉ được cập nhật 1 yêu cầu.");  
            }
          }
          
        }
        

        

            

            
         })                
      </script>