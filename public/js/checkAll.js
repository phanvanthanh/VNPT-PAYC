(function($) {
  jQuery('.check-all').on('click',function(){
    var cl=jQuery(this).attr('check-all-on');
    var isCheck=jQuery(this).is(":checked");
    jQuery(cl).each(function( index ){
      if(isCheck){
        jQuery(this).prop('checked', true);
      }else{
        jQuery(this).prop('checked', false);
      }
    });
  });
})(jQuery);
