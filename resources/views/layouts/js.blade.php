      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
      <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/custom.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/checkAll.js') }}"></script>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script type="text/javascript" src="{{ secure_asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script type="text/javascript" src="{{ secure_asset('public/vendors/lightgallery/js/lightgallery-all.min.js') }}"></script>
      <!-- End plugin js for this page-->

      <!-- Sumerynote -->
      <script type="text/javascript" src="{{ secure_asset('public/vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/tinymce/tinymce.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/quill/quill.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/simplemde/simplemde.min.js') }}"></script>
      
      <!-- inject:js -->
      <script type="text/javascript" src="{{ secure_asset('public/js/off-canvas.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/hoverable-collapse.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/misc.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/settings.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/todolist.js') }}"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script type="text/javascript" src="{{ secure_asset('public/js/light-gallery.js') }}"></script>




      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/progressbar.js/progressbar.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/inputmask/jquery.inputmask.bundle.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/inputmask/phone.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/inputmask/phone-be.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/inputmask/phone-ru.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/inputmask/inputmask.binding.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/dropify/dropify.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/dropzone/dropzone.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery-file-upload/jquery.uploadfile.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery-asColor/jquery-asColor.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/moment/moment.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/x-editable/bootstrap-editable.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/clockpicker/jquery-clockpicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/jquery.repeater/jquery.repeater.min.js') }}"></script>
      <!-- Custom js for this page-->
      <script type="text/javascript" src="{{ secure_asset('public/js/formpickers.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/form-addons.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/x-editable.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/dropify.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/dropzone.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/jquery-file-upload.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/formpickers.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/form-repeater.js') }}"></script>

      <!-- Plugin js for this page-->
      <script type="text/javascript" src="{{ secure_asset('public/vendors/datatables.net/jquery.dataTables.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/data-table.js') }}"></script>
      <!-- End plugin js for this page-->
      
      <!-- End custom js for this page-->
      <script type="text/javascript" src="{{ secure_asset('public/js/tooltips.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/popover.js') }}"></script>

      <script src="{{ secure_asset('public/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
      <script src="{{ secure_asset('public/js/toastDemo.js') }}"></script>

      <script src="{{ secure_asset('public/js/export-word/FileSaver.js') }}"></script>
      <script src="{{ secure_asset('public/js/export-word/jquery.wordexport.js') }}"></script>

      <script type="text/javascript">
         jQuery(document).ready(function(){     
          
          function checkSlidebarIconOnly(){
            if(jQuery('body').hasClass('sidebar-icon-only')){
              jQuery('.navbar-brand').text('BRS');
            }else{
              jQuery('.navbar-brand').text('VNPT - BRS');
            }
            jQuery('.icon-menu').on('click',function(){
              if(jQuery('body').hasClass('sidebar-icon-only')){
                jQuery('.navbar-brand').text('VNPT - BRS');
              }else{
                jQuery('.navbar-brand').text('BRS');
              }
            });
          }
          checkSlidebarIconOnly();
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

            jQuery('.dang-ky').on('click',function(){
                  window.location.href = "{{ route('register') }}";
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

            var pathname = "/"+window.location.pathname.substring(1);
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

            btnDisabled=function(){
              jQuery('.btn-disabled').addClass('disabled').attr('disabled', true);
              var checkLoaiVaiTro=''; var coCheckLoaiVaiTro=0;
              
              jQuery("input[type='checkbox'].id_payc").each(function( index ){
                if(jQuery(this).is(":checked")){
                  
                  var tr=jQuery(this).parent('th').parent('tr');
                  var vaiTro=tr.find('.vai-tro').attr('data');
                  if(checkLoaiVaiTro==''){
                    checkLoaiVaiTro=vaiTro;
                    coCheckLoaiVaiTro++;
                  }
                  if(checkLoaiVaiTro!='' && checkLoaiVaiTro!=vaiTro){
                    coCheckLoaiVaiTro++;
                  }
                  if(vaiTro==0){ // xem để biết
                    jQuery('.btn-hoan-tat-da-xem').removeClass('disabled').attr('disabled', false);
                  }else{
                    if (vaiTro==1) { // xử lý chính
                      jQuery('.btn-xu-ly-va-chuyen-lanh-dao').removeClass('disabled').attr('disabled', false);
                    } else { // phối hợp xử lý
                      jQuery('.btn-hoan-tat-phoi-hop').removeClass('disabled').attr('disabled', false);
                    }
                  }
                  if(coCheckLoaiVaiTro>1){
                    jQuery('.btn-disabled').addClass('disabled').attr('disabled', true);
                  }
                }
              });              
            }

            onOffButtonChucNang=function(){
              var coCheckDanhSachChoTiepNhan=0;
              jQuery("input[type='checkbox'].id_payc").each(function( index ){
                if(jQuery(this).is(":checked")){
                  coCheckDanhSachChoTiepNhan++;
                }
              });
              if(coCheckDanhSachChoTiepNhan>0){
                jQuery('.btn-chuc-nang').removeClass('disabled').attr('disabled', false);
              }else{
                jQuery('.btn-chuc-nang').addClass('disabled').attr('disabled', true);
              }
            }
            onOffButtonChucNang();


            jQuery('.check-id-payc').on('click', function(){
                if(jQuery(this).find('input:checkbox').is(":checked")){
                  jQuery(this).find('input:checkbox').prop('checked', false);
                  
                }else{
                  jQuery(this).find('input:checkbox').prop('checked', true);
                }
                btnDisabled();
                onOffButtonChucNang();
            });


            jQuery("input[type='checkbox'].id_payc").on('click',function(){
              jQuery(this).parent('.check-id-payc').click();

            });

            jQuery('.check-one-id-payc').on('click', function(){
              if(jQuery(this).find('input:checkbox').is(":checked")){
                jQuery(this).find('input:checkbox').prop('checked', false);
              }else{
                jQuery('.check-one-id-payc').find('input:checkbox').prop('checked', false);
                jQuery(this).find('input:checkbox').prop('checked', true);
              }
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


        // Duyệt và chuyển xử lý payc
        $('.btn-duyet-va-chuyen-xu-ly-payc').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-duyet-va-chuyen-xu-ly-payc"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_duyet_va_chuyen_xu_ly_payc').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-duyet-va-chuyen-xu-ly-payc') }}", ".frm-duyet-va-chuyen-xu-ly-payc");  
            $('.btn-duyet-va-chuyen-xu-ly-payc-2').attr("disabled",false);
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-duyet-va-chuyen-xu-ly-payc-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
            // Kiểm tra đã chọn hạn xử lý chưa
            var hanXuLyAll=jQuery('.check_han_xu_ly_all_pakn').val();
            var coCheck=0;           
            var soCanBoDaCheckChon=0;
            
            jQuery(".check_han_xu_ly_pakn").each(function(){
                if(jQuery(this).is(":checked")){
                    soCanBoDaCheckChon++;
                    var id=jQuery(this).val();
                    var hanXuLy=jQuery('.han_xu_ly_'+id).val();
                    if(hanXuLy!=''){
                        coCheck++;
                    }
                }
                    
            });
            if(coCheck!=0 && (coCheck==soCanBoDaCheckChon)){
                coCheck=1;
            }else{
                coCheck=0;
            }
            
            if(hanXuLyAll!=''){
                coCheck=1;
            }
            if(coCheck==0){
                alert("Vui lòng chọn hạn xử lý");
                return false;
            }
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_duyet_va_chuyen_xu_ly_payc').val(dsIdUser);
          xuLy($("form#frm-duyet-va-chuyen-xu-ly-payc"), "{{ route('duyet-va-chuyen-xu-ly-payc') }}", "");
          jQuery("#modal-duyet-va-chuyen-xu-ly-payc").modal('hide');
          
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

        // Xử lý và chuyển lãnh đạo
        $('.btn-xu-ly-va-chuyen-lanh-dao').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-xu-ly-va-chuyen-lanh-dao"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_xu_ly_va_chuyen_lanh_dao').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-xu-ly-va-chuyen-lanh-dao') }}", ".frm-xu-ly-va-chuyen-lanh-dao");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-xu-ly-va-chuyen-lanh-dao-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_user_xu_ly_va_chuyen_lanh_dao').val(dsIdUser);

          xuLy($("form#frm-xu-ly-va-chuyen-lanh-dao"), "{{ route('xu-ly-va-chuyen-lanh-dao') }}", "");
          jQuery("#modal-xu-ly-va-chuyen-lanh-dao").modal('hide');
          
        });

        // Hoàn tất các task xem để biết
        $('.btn-hoan-tat-da-xem').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-hoan-tat-da-xem"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            //jQuery('.ds_id_payc_hoan_tat_da_xem').val(dsId); // Không cần lưu vì gửi thẳng qua route luôn
            // tạo form chuyển
            getById(_token, dsId, "{{ route('hoan-tat-da-xem') }}", "");
            location.reload();
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        // Hoàn tất phối hợp xử lý
        $('.btn-hoan-tat-phoi-hop').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-hoan-tat-phoi-hop"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            //jQuery('.ds_id_payc_hoan_tat_da_xem').val(dsId); // Không cần lưu vì gửi thẳng qua route luôn
            // tạo form chuyển
            getById(_token, dsId, "{{ route('hoan-tat-phoi-hop') }}", "");
            location.reload();
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        // Chuyển cấp trên
        $('.btn-chuyen-cap-tren').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-chuyen-cap-tren"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_chuyen_cap_tren').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-chuyen-cap-tren') }}", ".frm-chuyen-cap-tren");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-chuyen-cap-tren-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          var dsIdUser=getDsIdUserCheckbox(); // lấy tất cả id user được check chọn trong modal
          jQuery('.ds_id_don_vi_cap_tren').val(dsIdUser);

          xuLy($("form#frm-chuyen-cap-tren"), "{{ route('chuyen-cap-tren') }}", "");
          jQuery("#modal-chuyen-cap-tren").modal('hide');
          
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

        // Duyệt và Hoàn tất
        $('.btn-duyet-va-hoan-tat-xu-ly').on('click',function(){ // Bấm nút chuyển trên các danh sách payc
          var _token=jQuery('form[name="frm-duyet-va-hoan-tat-xu-ly"]').find("input[name='_token']").val();
          var dsId=getDsIdPaycCheckbox(); // Lấy danh sách id pay đã check chọn trong danh sách chờ tiếp nhận
          if(dsId){
            jQuery('.ds_id_payc_duyet_va_hoan_tat_xu_ly').val(dsId);
            // tạo form chuyển
            getById(_token, dsId, "{{ route('frm-duyet-va-hoan-tat-xu-ly') }}", ".frm-duyet-va-hoan-tat-xu-ly");  
          }else{
            alert("Vui lòng chọn các yêu cầu cần xử lý!");
            return false;
          }
          
        });

        $('.btn-duyet-va-hoan-tat-xu-ly-2').on('click',function(){ // Sự kiện bấm nút chuyển trên modal
          xuLy($("form#frm-duyet-va-hoan-tat-xu-ly"), "{{ route('duyet-va-hoan-tat-xu-ly') }}", "");
          jQuery("#modal-duyet-va-hoan-tat-xu-ly").modal('hide');
          
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
            var _token=jQuery('form[name="frm-danh-gia-sao"]').find("input[name='_token']").val();
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
            var _token=jQuery('form[name="frm-danh-gia-sao"]').find("input[name='_token']").val();
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
          console.log($("form#frm-danh-gia-sao"));
          xuLy($("form#frm-danh-gia-sao"), "{{ route('danh-gia') }}", "");
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

        // MỚI LOAD TRANG
      var selectedQuanHuyen=jQuery('.ma_quan_huyen').val();
      showPhuongXa=function(loai){ // loại =1 là mới load trang, ngước lại là do người dùng onchange
        var co=0;
        jQuery('.ma_phuong_xa option').each(function( index ) {
              var maQuanHuyen=jQuery(this).attr('ma-quan-huyen');
              if(loai!=1){
          jQuery(this).removeAttr('selected');
              }
                
              if(maQuanHuyen!=selectedQuanHuyen){
                jQuery(this).css('display','none');
              }else{
                jQuery(this).css('display','block');
                if(co==0 && loai!=1){
                  jQuery(this).attr('selected','selected');
                  co=1;
                }
              }
          });
      }
      
      showPhuongXa(1);
      jQuery('.ma_quan_huyen').on('change',function(){
        selectedQuanHuyen=jQuery(this).val();
        showPhuongXa(2);
      });
        




        /*Kỹ thuật t-tree là kỹ thuật Thanh-Tree do Thanh tự làm đó mà*/
        jQuery('.t-tree').on('click',function(){
            var id=jQuery(this).attr('data-id');
            var dataShow=jQuery(this).attr('data-show');
            if(dataShow==1){
                jQuery(this).attr('data-show',0);
                jQuery(this).find('.tree-icon').removeClass('fa-minus-square-o');
                jQuery(this).find('.tree-icon').addClass('fa-plus-square-o');
            }else{
                jQuery(this).attr('data-show',1);
                jQuery(this).find('.tree-icon').removeClass('fa-plus-square-o');
                jQuery(this).find('.tree-icon').addClass('fa-minus-square-o');
            }
            tTree(id, dataShow);
        });
        tTree=function(id, dataShow){            
            jQuery('.t-tree').each(function(){
                if(jQuery(this).attr('data-parent')==id){
                    if(dataShow==1){
                        jQuery(this).hide();
                        jQuery(this).find('.tree-icon').removeClass('fa-minus-square-o');
                        jQuery(this).find('.tree-icon').addClass('fa-plus-square-o');
                    }else{
                        jQuery(this).show();
                        jQuery(this).find('.tree-icon').removeClass('fa-plus-square-o');
                        jQuery(this).find('.tree-icon').addClass('fa-minus-square-o');
                    }
                    tTree(jQuery(this).attr('data-id'), dataShow);
                }
            });
        }

        jQuery('.xem-chi-tiet-payc').on('click',function(){
          var id=jQuery(this).attr('value');
          //location.href = "{{ route('chi-tiet-payc') }}?id="+id;
          var win = window.open("{{ route('chi-tiet-payc') }}?id="+id, '_blank');
          if (win) {
              win.focus();
          } else {
              alert('Please allow popups for this website');
          }
        });

        jQuery('.btn-danh-dau-da-xem-binh-luan').on('click',function(){
          var _token="{{ csrf_token() }}";
            var idBinhLuan=jQuery(this).attr('data');
            var idPayc=jQuery(this).attr('data2');
            getById(_token, idBinhLuan, "{{ route('danh-dau-da-xem-binh-luan') }}", "");
            //location.href = "{{ route('chi-tiet-payc') }}?id="+idPayc;
            var win = window.open("{{ route('chi-tiet-payc') }}?id="+idPayc, '_blank');
            if (win) {
                win.focus();
            } else {
                alert('Please allow popups for this website');
            }
        });

        jQuery('.btn-danh-dau-da-xem-pakn').on('click',function(){
          var _token="{{ csrf_token() }}";
            var idNhanPakn=jQuery(this).attr('data');
            var idPayc=jQuery(this).attr('data2');
            getById(_token, idNhanPakn, "{{ route('danh-dau-da-xem-pakn') }}", "");
            //location.href = "{{ route('chi-tiet-payc') }}?id="+idPayc;
            var win = window.open("{{ route('chi-tiet-payc') }}?id="+idPayc, '_blank');
            if (win) {
                win.focus();
            } else {
                alert('Please allow popups for this website');
            }
        });


        daXemThongBao=function(){
            var _token="{{ csrf_token() }}";
            var xhr1;  
            if(xhr1 && xhr1.readyState != 4){
                xhr1.abort(); //huy lenh ajax truoc do
            }
            xhr1 = jQuery.ajax({
              url: "{{ route('da-xem-thong-bao') }}",
              type:'POST',
              dataType:'json',
              cache: false,
              data:{
                  "_token":_token
              },
              complete: function(xhr, textStatus) {
                //called when complete
              },
              success: function(data, textStatus, xhr) {
                $(".error-mode").empty();
                if(data.error==""){
                  if(data.so_tb_con_lai==0){
                    jQuery('.count').addClass('count-success').removeClass('count');
                  }
                }else{
                  errorLoader(".error-mode",data.error);
                }
              },
              error: function(xhr, textStatus, errorThrown) {
                //called when there is an error
              }
            });
          }

        jQuery('.btn-danh-dau-da-xem-thong-bao').on('click',function(){
            console.log("vo roi");
            var _token="{{ csrf_token() }}";
            daXemThongBao();
            
        });

        jQuery('#id_dich_vu').on('change',function(){
          var value=jQuery(this).val();
          if(value==1){
            jQuery('.dia_chi').removeClass('d-none');
          }else{
            jQuery('.dia_chi').addClass('d-none');
          }
        });
        

        
        
            
    })                
</script>

@php
    use Illuminate\Support\Facades\Auth;        
    if(Auth::id()){
        $coBatThongBao=Helper::getValueThamSoTheoMa('THONG_BAO_BAT_TAT');
        if($coBatThongBao==1 && (!Session::has('da_bat_thong_bao') || Session::get('da_bat_thong_bao')==0)){ // Nếu chưa bật
            Session::put('da_bat_thong_bao',1);
            echo '<script type="text/javascript">
                    $(window).on("load", function() {
                        $("#modal-thong-bao").modal("show");
                    });
                </script>';
        }
    }
        

@endphp

