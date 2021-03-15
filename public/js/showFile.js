(function($) {
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
})(jQuery);
