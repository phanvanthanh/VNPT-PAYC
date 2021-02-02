(function($) {
  'use strict';
 
  if($("#lightgallery").length) {
    $("#lightgallery").lightGallery();
  }
  var co=0;
  $(".t-card-img-overlay").on('click',function(co=0){
      co++;
      if(co==2){
          window.location.href = "/resource";
          co=0;
      }
  });
  if($(".lightgallery-without-thumb").length) {
    
    $(".lightgallery-without-thumb").lightGallery({
      thumbnail:true,
      animateThumb: false,
      showThumbByDefault: false
    });
  }

  if($("#video-gallery").length) {
    $("#video-gallery").lightGallery();
  }
})(jQuery);
