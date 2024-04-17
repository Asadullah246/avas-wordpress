<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/

/* ---------------------------------------------------------
  Dynamic styles
------------------------------------------------------------ */
if ( !function_exists( 'tx_custom_css' ) ) :
  add_action('wp_head', 'tx_custom_css');
  function tx_custom_css() {
    global $tx;
    // cumstom header background image support for all header styles
    if ( get_header_image() ) : ?>
      <style type="text/css">
        #h-style-1,#h-style-2,#h-style-3,#h-style-4,#h-style-5,#h-style-6,#h-style-7,#h-style-8,#h-style-9,#h-style-10 {
          background-image: url(<?php header_image(); ?>) !important;
        }
      </style>
    <?php endif;

    // Main header height
    if( isset( $tx['main_header_height'] ) || isset( $tx['sticky_main_header_height'] ) ) : ?>
      <style type="text/css">
        @media (min-width: 991px){.main-header{height:<?php echo esc_attr($tx['main_header_height']); ?>px}.main-header.sticky-header{height:<?php echo esc_attr($tx['sticky_main_header_height']); ?>px}
      </style>
    <?php endif;

    // Sticky header box-shadow enable/disable
    if(isset($tx['sticky_head_box_shadow_switch'])):
      if($tx['sticky_head_box_shadow_switch']) : ?>
      <style type="text/css">
        .main-header.sticky-header{box-shadow: 0 0 10px 0 rgb(0 0 0 / 15%)}
      </style>
      <?php endif;
    endif;

    // main header banner / business disable on responsive device
    if( $tx['banner-bussiness-switch-responsive'] == 1) : ?>
      <style type="text/css">
        @media (max-device-width: 768px){.main-header-right-area{display:none;}}
      </style>
    <?php endif;

    // Top header height
    if( isset($tx['top_header_height'] )) : ?>
      <style type="text/css">
        .top-header{height:<?php echo esc_attr($tx['top_header_height']); ?>px}
      </style>
    <?php endif;

    // Top header height for mobile phones
    if( isset($tx['top_header_height_mobile'] )) : ?>
      <style type="text/css">
         @media (max-device-width: 768px){.top-header{height:<?php echo esc_attr($tx['top_header_height_mobile']); ?>px}}
      </style>
    <?php endif;

    // welcome message enable/disable option for mobile phones
    if( isset($tx['wm_switch_res']) ) :
      if($tx['wm_switch_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.welcome_msg{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // Date enable/disable option for mobile phones
    if( isset($tx['tx-date_res']) ) :
      if($tx['tx-date_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.tx-date{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // Phone number enable/disable option for mobile phones
    if( isset($tx['tx-phone_res']) ) :
      if($tx['tx-phone_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.phone-number{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // Email enable/disable option for mobile phones
    if( isset($tx['tx-email_res']) ) :
      if($tx['tx-email_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.email-address{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // News Ticker enable/disable option for mobile phones
    if( isset($tx['news_ticker_res']) ) :
      if($tx['news_ticker_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.news-ticker-wrap{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // News ticker width for responsive devices
    ?>
    <style type="text/css">
      @media(max-width: 768px) {.news-ticker-wrap{width: <?php echo esc_attr($tx['newsticker_width_res']);?>px}}
    </style>
    <?php

    // Top Menu enable/disable option for mobile phones
    if( isset($tx['top_menu_res']) ) :
      if($tx['top_menu_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {#responsive-menu-top{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // Login Register enable/disable option for mobile phones
    if( isset($tx['login_reg_res']) ) :
      if($tx['login_reg_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.login_button{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // Social icon enable/disable option for mobile phones
    if( isset($tx['social_buton_top_res']) ) :
      if($tx['social_buton_top_res'] == 0):
    ?>
    <style type="text/css">
      @media(max-width: 767px) {.top-header-right-area .social_media{display: none!important;}}
    </style>
    <?php
    endif;
    endif;

    // Subheader height
    if( isset($tx['sub_header_height']) ) : ?>
      <style type="text/css">
        .sub-header{height:<?php echo esc_attr($tx['sub_header_height']); ?>px}
      </style>
    <?php endif;

     // Subheader height for responsive devices
    if( isset($tx['sub_header_height_responsive']) ) : ?>
      <style type="text/css">
        @media(max-width:768px){.sub-header{height:<?php echo esc_attr($tx['sub_header_height_responsive']); ?>px}}
      </style>
    <?php endif;

    // header style 10 position
     if($tx['header-style-10-position'] == 'right') : ?>
      <style type="text/css">
        #h-style-10{left:auto;right:0;}
      </style>
    <?php endif; ?>

    <!-- header style 10 width, top header social icon font size, border-radius, body padding -->
    <style type="text/css">
      #h-style-10{width:<?php echo esc_attr($tx['header-style10-width']); ?>px;}
      #header .top-header-right-area .social li a i{font-size:<?php echo esc_attr($tx['social-media-icon-header-size']); ?>px;}
      #header .top-header-right-area .social li{border-radius:<?php if(isset($tx['social-media-icon-header-border-radius'])){echo esc_attr($tx['social-media-icon-header-border-radius']);} ?>px;}
      @media(min-width: 992px){.tx_header_style_10{padding-left: <?php echo esc_attr($tx['header-style10-width']); ?>px;}}
    </style>

    <!-- footer social media icon size -->
    <?php if($tx['social_icons_footer']):?>
      <style type="text/css">#footer .social_media i{font-size:<?php echo esc_attr($tx['social_icons_footer_size']); ?>px}</style>
    <?php endif; ?>

    <!-- Preloader -->
    <style type="text/css">
      .tx-main-preloader .tx-preloader-bar-outer{height:<?php echo esc_attr($tx['preloader-bar-height']); ?>px}
    </style>
    <!-- LearnPress Course min height -->
  <?php if(class_exists('LearnPress')) : ?>
    <style type="text/css">
      .avas .lp-archive-courses .learn-press-courses[data-layout="grid"] .course .course-item .course-content{min-height:<?php echo esc_attr($tx['lp_course_min_height']); ?>px}
    </style>
  <?php endif; ?>
<?php
  // Scroll Progressbar
  if($tx['scroll-progress-bar-height']):
?><style type="text/css">.tx-scroll-progress-bar{height:<?php echo esc_attr($tx['scroll-progress-bar-height']); ?>px}</style>
<?php endif;
    // Menu alignment
     if($tx['menu-alignment'] == 'left') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-1 .menu-bar .container,#h-style-2 .menu-bar .container, #h-style-4 .menu-bar .container, #h-style-6 .menu-bar .container,#h-style-7 .menu-bar .container,#h-style-8 .menu-bar .container{justify-content:left!important}
          #h-style-1 .menu-bar .container .navbar,#h-style-2 .menu-bar .container .navbar,#h-style-4 .menu-bar .container .navbar,#h-style-6 .menu-bar .container .navbar,#h-style-7 .menu-bar .container .navbar,#h-style-8 .menu-bar .container .navbar{margin-right:unset;}
        }
       
      </style>
    <?php endif; // Header style 1, 2, 4, 6, 7, 8 left alignment

    if($tx['menu-alignment'] == 'center') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-1 .menu-bar .container,#h-style-2 .menu-bar .container,#h-style-4 .menu-bar .container,#h-style-6 .menu-bar .container,#h-style-7 .menu-bar .container,#h-style-8 .menu-bar .container{justify-content:center!important}
          #h-style-1 .menu-bar .container .navbar,#h-style-2 .menu-bar .container .navbar,#h-style-4 .menu-bar .container .navbar,#h-style-6 .menu-bar .container .navbar,#h-style-7 .menu-bar .container .navbar,#h-style-8 .menu-bar .container .navbar{margin-right:unset;}
        }
       
      </style>
    <?php endif; // Header style 1, 2, 4, 6, 7, 8 center alignment

    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-1 .menu-bar .container,#h-style-2 .menu-bar .container,#h-style-4 .menu-bar .container,#h-style-6 .menu-bar .container,#h-style-7 .menu-bar .container,#h-style-8 .menu-bar .container{justify-content:end!important}
        }
       
      </style>
    <?php endif; // Header style 1, 2, 4, 6, 7, 8 right alignment
    

    if($tx['menu-alignment'] == 'left') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          .tx_logo{margin-right: 20px;}
          .navbar{margin-right: auto;}
        }
       
      </style>
    <?php endif;
if(!is_rtl()):
    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          .navbar{margin-right: unset;}
        }
      </style>
    <?php endif;
endif;
if(is_rtl()):
    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          .navbar{margin-right: 0;}
        }
      </style>
    <?php endif;
endif;
if(is_rtl()):
    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-3 .container{justify-content:right!important}
        }
      </style>
    <?php endif;
endif;
if(is_rtl()) :
   if($tx['menu-alignment'] == 'center') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          .navbar{display: contents;text-align: center;}
        }
      </style>
    <?php endif;
endif;
    
    if($tx['menu-alignment'] == 'center') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          .navbar{margin-right: inherit;}
        }
      </style>
    <?php endif;

    if($tx['menu-alignment'] == 'center') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-11 .navbar{margin-right:unset;}
        }
      </style>
    <?php endif; // style 11
    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-11 .container{justify-content:right!important}
          #h-style-11 .navbar{margin-right:unset;}
        }
      </style>
    <?php endif; // style 11

if(is_rtl()) :
    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        @media(min-width:  992px) {
          #h-style-11 .tx_logo{margin-right: auto}
        }
      </style>
    <?php endif; // style 11 rtl right
endif;


    // Menu Highlight callouts text button animation
    if($tx['menu-highlight-animation'] == 1) : ?>
      <style type="text/css">
        .tx-menu-highlight{animation:none}
      </style>
    <?php endif;

    // Menu Item animated border 
    if($tx['menu_item_border'] == 1) : ?>
      <style type="text/css">
        .main-menu>li:hover>a:hover:before{opacity:1}
      </style>
    <?php endif;
    // Top border
    if($tx['menu_item_border_select'] == 'menu_item_border_top' ) : ?>
      <style type="text/css">
        .main-menu>li a:before {top:0;border-top:2px solid}
      </style>
    <?php endif; 
    // Bottom border
    if ($tx['menu_item_border_select'] == 'menu_item_border_bottom') : ?>
      <style type="text/css">
        .main-menu>li a:before {bottom:0;border-bottom:2px solid}
      </style>
    <?php endif;

    // Menu Item Separator
    if($tx['menu-item-seprator'] == 1) : ?>
      <style type="text/css">
        .main-menu>li.menu-item-has-children>a:after {display: none}
      </style>
    <?php endif;

    // menu drop down arrow
    if($tx['menu-dropdown-icon'] == 1) : ?>
      <style type="text/css">
        .main-menu>li.menu-item-has-children>a:after {content: "\f107";top:<?php echo esc_attr($tx['menu-dropdown-icon-valign']); ?>px}
      </style>
    <?php endif;

    // Mega Menu full-width/box-width
    if($tx['megamenu-full-width'] == 0) : ?>
      <style type="text/css">
        .tx-mega-menu .mega-menu-item .depth0:before{width:auto}
      </style>
    <?php endif;

    // Mega Menu Left Position
    if(isset($tx['mega_menu_left_position'])) : ?>
      <style type="text/css">
        .tx-mega-menu .mega-menu-item .depth0{left:<?php echo esc_attr($tx['mega_menu_left_position']); ?>%}
      </style>
    <?php endif;

    // Responsive menu height
    if(isset($tx['tx-res-menu-bottom'])) : ?>
      <style type="text/css">
        #tx-res-menu{bottom:<?php //echo esc_attr($tx['tx-res-menu-bottom']); ?>%}
      </style>
    <?php endif;
    
    // Responsive menu backgroung color
     if(isset($tx['mobile-menu-bg-color'])) : ?>
      <style type="text/css">
        @media (max-width: 1024px){#tx-res-menu{background-color: <?php echo esc_attr($tx['mobile-menu-bg-color']); ?>;}}
      </style>
    <?php endif; ?>

    <!-- Main Menu Item border-radius -->
    <?php if(isset($tx['menu_item_border_radius'])) : ?>
      <style type="text/css">
        .main-menu>li>a,.header-style-eight .main-menu>li>a, .header-style-four .main-menu>li>a, .header-style-one .main-menu>li>a, .header-style-seven .main-menu>li>a, .header-style-six .main-menu>li>a, .header-style-two .main-menu>li>a, #h-style-10 .main-menu>li>a{border-radius:<?php global $tx;echo esc_attr($tx['menu_item_border_radius']); ?>px}
      </style>
    <?php endif; ?>

    <!-- Responsive Main Menu Icon Text Top -->
    <style type="text/css">
      .tx-res-menu-txt{position:relative;top:<?php global $tx;if(isset($tx['tx-res-menu-txt-top'])){echo esc_attr($tx['tx-res-menu-txt-top']);} ?>px}
    </style>

    <?php

    // Responsive menu item color
    if(isset($tx['mobile-menu-item-color'])) : ?>
      <style type="text/css">
        @media (max-width: 1024px){.navbar-collapse>ul>li>a, .navbar-collapse>ul>li>ul>li>a, .navbar-collapse>ul>li>ul>li>ul>li>a, .navbar-collapse>ul>li>ul>li>ul>li>ul>li>a, .navbar-collapse>ul>li>ul>li>ul>li>ul>li>ul>li>a,.mb-dropdown-icon:before{color: <?php echo esc_attr($tx['mobile-menu-item-color']); ?> !important}}
      </style>
    <?php endif; 

    // Menu button border radius
    if(!empty($tx['menu-btn-border-radius'])) : ?>
      <style type="text/css">
        .tx-menu-btn {border-radius: <?php echo esc_attr($tx['menu-btn-border-radius']); ?>px}
      </style>
    <?php endif;

    // Logo resize desktop
    if( !empty($tx['logo-resize']) ) : ?>
      <style type="text/css">
        .tx_logo img {height:<?php echo esc_attr($tx['logo-resize']); ?>px}
      </style>
    <?php endif;

    // Logo resize responsive
    if( !empty($tx['logo-resize-responsive']) ) : ?>
      <style type="text/css">
        @media(max-width: 1024px){.tx_logo img {height:<?php echo esc_attr($tx['logo-resize-responsive']); ?>px}}
      </style>
    <?php endif;

    // logo padding mobile

  // header overlay for home page
    if ($tx['header_overlay'] == 1) : ?>
      <style type="text/css">
        .home .tx-header{position:absolute;left:0;right:0}
      </style>
    <?php endif;

    // header overlay for inner page
    if ($tx['header_overlay_inner'] == 1) : ?>
      <style type="text/css">
        .sub-header,.sub-header-blog{position:absolute;width:100%;top:0;z-index:1}
        .page-template-no-sub .tx-header{position:absolute}
      </style>
    <?php endif;

  // sticky header enable / disable
     if($tx['sticky_header'] == 1) : 
      $scroll = $tx['sticky-scroll'];
    ?>
      <script>
        jQuery(document).ready(function(e){"use strict";e(document).on("scroll",function(){e(document).scrollTop()>=<?php echo esc_attr($scroll);?>?(e(".tx-header").addClass("tx-scrolled"),e(".main-header").addClass("sticky-header")):(e(".tx-header").removeClass("tx-scrolled"),e(".main-header").removeClass("sticky-header"))})});
      </script>
    
    <?php endif;
     if($tx['sticky_header'] == 0) : 
    ?>
      <style type="text/css">
        @media only screen and (max-width: 768px) {
        #h-style-10 {position: relative;}
        }
      </style>
    <?php endif;
    if($tx['sticky_main_header'] == 0) : ?>
      <style type="text/css">
        .sticky-header #h-style-2,.sticky-header #h-style-4,.sticky-header #h-style-6,.sticky-header #h-style-7,.sticky-header #h-style-8 {display: none !important}
        .main-header.sticky-header{height: auto;}
        @media(min-width: 992px) {
          #h-style-1.sticky-header .tx-main-head-contain,#h-style-2.sticky-header .tx-main-head-contain,#h-style-4.sticky-header .tx-main-head-contain,#h-style-6.sticky-header .tx-main-head-contain,#h-style-7.sticky-header .tx-main-head-contain,#h-style-8.sticky-header .tx-main-head-contain {
            display: none !important;
          }
        }
      </style>
    <?php endif;
    global $tx;
    if(isset($tx['sticky_header_mob'])):
     if($tx['sticky_header_mob'] == 0) : 
    ?>
      <style type="text/css">
        @media only screen and (max-width: 768px) {
        .main-header.sticky-header {display: none !important;}
        }
      </style>
    <?php endif;
  endif;

    // Portfolio style    
    global $post;
    if( !is_object($post) ) :
      return;
    endif;

    $gutter = get_post_meta($post->ID, 'gutter', true);
    $gutter_portfoio_archive = $tx['portfolio_archive_gutter'];
    if($gutter ) : ?>
      <style type="text/css">
        .page-template-portfolio .tx-portfolio-item {padding:<?php echo esc_attr($gutter); ?>px}
      </style>
    <?php endif;
    if($gutter_portfoio_archive) : ?>
      <style type="text/css">
        .post-type-archive-portfolio .tx-portfolio-item,.tax-portfolio-category .tx-portfolio-item {padding:<?php echo esc_attr($gutter_portfoio_archive); ?>px}
      </style>
    <?php endif;

    // sidebar
    if($tx['sidebar_shadow_switch'] == 1) : ?>
      <style type="text/css">
        #secondary .tribe-compatibility-container, #secondary .widget, #secondary_2 .widget{box-shadow: 0 0 8px 0 rgba(110,123,140,.2)}
      </style>
    <?php endif;
    
    // woocommerce
    if(class_exists('WooCommerce')) :
      if($tx['woo_number_result'] == '0') : ?>
        <style type="text/css">
          .woocommerce-result-count {display: none}
        </style>
      <?php endif;

      if($tx['woo_default_sorting_dropdown'] == '0') : ?>
        <style type="text/css">
          .woocommerce-ordering {display: none}
        </style>
      <?php endif;

      // product title alignment
      if($tx['prod-title-alignment'] == 'left') : ?>
        <style>.tx-woo-prod-title-wrap{text-align: left}</style>
      <?php endif;
      if($tx['prod-title-alignment'] == 'center') : ?>
        <style>.tx-woo-prod-title-wrap{text-align: center}</style>
      <?php endif;
      if($tx['prod-title-alignment'] == 'right') : ?>
        <style>.tx-woo-prod-title-wrap{text-align: right}</style>
      <?php endif;

    endif;// woocommerce class end



    // Pagination arrow size
    if( !empty($tx['pagination_num_arrow_size']) ) : ?>
      <style type="text/css">
        .tx-pagination a, .tx-pagination span, .tx-pagination a i{font-size:<?php echo esc_attr($tx['pagination_num_arrow_size']); ?>px}
      </style>
    <?php endif;

    /* Custom Font */
    global $tx;
    if( isset($tx['tx_custom_font_ttf']['url'] ) && !empty($tx['tx_custom_font_ttf']['url'] ) ):
    ?>
    <style type="text/css">
      @font-face {
        font-family: 'CustomFont';
        src:url('<?php echo esc_url($tx['tx_custom_font_ttf']['url']); ?>') format('truetype');
      }
    </style>
    <?php endif;
    
    // Custom CSS
    if(!empty($tx['custom_css'])) : ?>
      <style type="text/css">
        <?php echo $tx['custom_css']; ?>
      </style>
    <?php 
    endif;

    // Footer top widget alignment
    if($tx['footer-top-widget-alignment'] == 'left') : ?>
      <style type="text/css">
        #footer-top aside{display:block}
      </style>
    <?php endif;

    if($tx['footer-top-widget-alignment'] == 'center') : ?>
      <style type="text/css">
        #footer-top aside{display:table}
      </style>
    <?php endif; ?>

    <!-- scroll to top broder radius / back to top border radius -->
    <style type="text/css">
      #back_top{border-radius: <?php echo esc_attr($tx['back_top_radius']); ?>px}
    </style>

    <?php if($tx['back_top_position'] == '1') : ?>
      <style type="text/css">
        #back_top{left:30px;right:auto}
      </style>
    <?php endif; ?>
<?php
  } // function tx_custom_css
endif;

    // Custom JS Head
    add_action('wp_head', 'custom_js_head');
    function custom_js_head() {
      global $tx;
      if( !empty($tx['custom_js_head']) ) {
        echo ( $tx['custom_js_head'] ); 
      }
    }

    // Custom JS Footer
    add_action('wp_footer', 'custom_js_footer');
    function custom_js_footer() {
      global $tx;
      if( !empty($tx['custom_js_footer']) ) {
        echo ( $tx['custom_js_footer'] ) ; 
      }
    }


/* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */      