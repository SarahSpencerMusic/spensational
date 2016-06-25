(function($){
	"use strict";	
    $(document).ready(function() {
        
        var $icon = $('.social-footer a');
        $icon.css({
            'width' : parseFloat( ( 100 / $('.social-footer a').length ) ).toFixed(4) + '%'
        });
            
        if ( $('.post').length ) { $('.post').fitVids(); }
            
        if ( $('select').length ) { $('select').chosen(); }
        
        if ( $('.slider').length )
        {
            $('.slider').owlCarousel({
        		items:1,
        		nav:false,
        		dots:true            
        	});
        }
        
        var $instagram_items = $('.instagram-footer .instagram-pics li');
        if ( $instagram_items.length ) {
            var $item_width = parseFloat( 100 / $instagram_items.length ).toFixed(4);
            $instagram_items.css({
                'width': $item_width + '%'
            })
        }
        
        
        if ( $('.togole-mainmenu').length ) {
            $('.togole-mainmenu').click( function(){
                $('#nav-wrapper .azmenu').toggle();
            } );
        }
        
        $('.azmenu .caret').click( function() {
            var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu');
            
            $submenu.toggle();
            
            return false;
        });
        $(window).resize( function() {
            $icon.css({
                'width' : parseFloat( ( 100 / $('.social-footer a').length ) ).toFixed(4) + '%'
            });
        });
        
    });
})(jQuery);