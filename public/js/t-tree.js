(function($) {
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
})(jQuery);
