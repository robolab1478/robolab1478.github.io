 // Back to top button animation
jQuery(function() {
    jQuery(window).scroll(function() {
        var x=jQuery(this).scrollTop();
         var ver = getInternetExplorerVersion();
        // no fade animation (transparency) if IE8 or below
        if ( ver > -1 && ver <= 8 ) {
            if(x != 0) {
                    jQuery('#toTop').show();
                    } else {
                    jQuery('#toTop').hide();
                        }
        }
        // fade animation if not IE8 or below
        else {
        if(x != 0) {
                jQuery('#toTop').fadeIn(3000);
            } else {
                jQuery('#toTop').fadeOut();
            }
    }
    });
    jQuery('#toTop').click(function() { jQuery('body,html').animate({scrollTop:0},800); });
});
