jQuery(document).ready(function() {
  // View form
      jQuery('.hover-view-form').hover(function() {
        var formView=jQuery(this).attr('data-hover-view-form');
        jQuery(this).find(formView).removeClass('d-none');
        //jQuery(formView).removeClass('d-none');
      }, function() {
        var formView=jQuery(this).attr('data-hover-view-form');
        jQuery(this).find(formView).addClass('d-none');
      });
      
      jQuery('.click-view-form').on('click', function() {
        var form=jQuery(this).attr('data-click-view-form');
        if(jQuery(form).hasClass('d-none')) {
          jQuery(form).removeClass('d-none');
          return false;
        }else{
          jQuery(form).addClass('d-none');
          return false;
        }        
      });

      jQuery('.dbclick-view-form').dblclick(function(event) {
        var daChotSoLieu=jQuery('.da-chot-so-lieu').val();
        if(daChotSoLieu==1){
          errorLoader(".error-mode","Đã chốt số liệu không thể chỉnh sửa");
          return false;
        }
        /* Act on the event */
        jQuery(this).addClass('d-none');
        var form=jQuery(this).attr('data-dbclick-view-form');
        jQuery(form).removeClass('d-none');
      });
});