      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
      <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/custom.js') }}"></script>
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
              height: 150,                 // set editor height
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

            
         })                
      </script>