(function($) {
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
})(jQuery);
