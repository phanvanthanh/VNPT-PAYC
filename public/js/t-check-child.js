(function($) {
  jQuery('.check-child').on('click', function(){
        if(jQuery(this).find('input:checkbox').is(":checked")){
          jQuery(this).find('input:checkbox').prop('checked', false);
        }else{
          jQuery(this).find('input:checkbox').prop('checked', true);
        }
    });


    jQuery("input[type='checkbox'].check-input").on('click',function(){
      jQuery(this).parent('.check-child').click();
    });
})(jQuery);
