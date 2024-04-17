jQuery(document).ready(function($){'use strict';
    
/* ---------------------------------------------------------
    Search
------------------------------------------------------------ */ 
    var $srcicon = $('.search-icon'),
        $srcfield = $('#search'),
        $window     = $(window);
    $srcicon.on('click', function(event){
        event.preventDefault();
        $srcfield.toggleClass('visible');
        event.stopPropagation();
    });
    $('.search-close').on('click', function(e){
        $srcfield.removeClass('visible');
    });
    $srcfield.on('click', function(event){
        event.stopPropagation();
    });
    $window.on('click', function(e){
        $srcfield.removeClass('visible');
    });

/* ---------------------------------------------------------
    mobile menu icon
------------------------------------------------------------ */       
        function tx_mob_menu_icon() {
            // Mobile Menu Dropdown Icon
            var hasChildren = $('.tx-res-menu li.menu-item-has-children');

            hasChildren.each( function() {
                var $btnToggle = $('<a class="mb-dropdown-icon" href="#"></a>');
                $( this ).append($btnToggle);
                $btnToggle.on( 'click', function(e) {
                    e.preventDefault();
                    $( this ).toggleClass('open');
                    $( this ).parent().children('ul').toggle('slow');
                } );
            } );

            $('.mobile-nav-toggle').on('click', function(e) {
                $('.tx-mobile-menu').toggleClass('tx-res-menu-toggle');
                $(this).find($(".bi")).toggleClass('bi-list bi-x');
                $('#top_head').toggleClass('d-none');
                $('.mobile-nav-toggle').toggleClass('tx-mob-sticky');
                $('#wpadminbar').toggleClass('position-fixed');
            });

            $('.tx-top-res-menu').on('click', function(){
                $(this).find($(".bi")).toggleClass('bi-list bi-x');
            });

        }
        tx_mob_menu_icon();

/* ---------------------------------------------------------
    Mobile menu item click to hide menu for one page menu
------------------------------------------------------------ */ 
        $(document).on('click','.tx-mobile-menu',function(e) {
            if( $(e.target).is('a:not(".mb-dropdown-icon")') ) {
                $(this).toggleClass('tx-res-menu-toggle');
                $(".mobile-nav-toggle").find($(".bi")).toggleClass('bi-list bi-x');
            }
        });


/* ---------------------------------------------------------
    Back to top / Scroll to top
------------------------------------------------------------ */ 
        function tx_back_top() {
            $('#back_top').on('click', function() {
                $('html,body').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });

            if ($(window).scrollTop() > 300) {
                $('#back_top').addClass('back_top');
            } else {
                $('#back_top').removeClass('back_top');
            }

            $(window).on('scroll', function() {

                if ($(window).scrollTop() > 300) {
                    $('#back_top').addClass('back_top');
                } else {
                    $('#back_top').removeClass('back_top');
                }
            });
        }
        tx_back_top();

/* ---------------------------------------------------------
    Woocommerce wishlist count on header
------------------------------------------------------------ */ 

        $( document ).on( 'woosw_change_count', function( event, count ) {

            if ($('.tx-count').length) {
                $('.tx-count').attr('data-count', count);
            } 

        } );



}); // End of jquery    

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */

