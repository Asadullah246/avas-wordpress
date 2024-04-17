<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

/* ---------------------------------------------------------
   Enqueue Styles and Scripts
------------------------------------------------------------ */ 

if(!function_exists('tx_enqueue')):
  add_action('wp_enqueue_scripts', 'tx_enqueue');
  function tx_enqueue() {
    global $tx;
    $elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

    wp_enqueue_style( 'bootstrap', TX_CSS . 'bootstrap.min.css' );
    wp_enqueue_style( 'tx-main', TX_CSS . 'main.min.css' );
    wp_enqueue_style( 'bootstrap-icons', TX_CSS . 'bootstrap-icons.min.css' );
    wp_enqueue_style( 'font-awesome-4', TX_CSS . 'font-awesome.min.css' ); // v4.7.0

    if( !class_exists('Elementor\Plugin') || !$elementor_page ):
      wp_enqueue_style( 'fontawesome', TX_CSS . 'fontawesome.min.css' ); // v5+
      wp_enqueue_style( 'fontawesome-brands', TX_CSS . 'brands.min.css' ); // v5+
    endif;

    // LearnPress
    if ( class_exists( 'LearnPress' ) ) :
      wp_enqueue_style( 'tx-learnpress', TX_CSS . 'learnpress.min.css' );
    endif;

    // WooCommerce
    if ( class_exists( 'WooCommerce' ) ) :
      wp_enqueue_style( 'tx-woocommerce', TX_CSS . 'woocommerce.min.css' );
    endif;

    // WPC Smart plugins
    if ( class_exists('WPCleverWoosq') || class_exists('WPCleverWoosw') || class_exists('WPCleverWoosc') ) :
      wp_enqueue_style( 'tx-wpc-smart', TX_CSS . 'wpc-smart.min.css' );
    endif;

    // Estatik
    if ( class_exists( 'Estatik' ) ) :
      wp_enqueue_style( 'tx-estatik', TX_CSS . 'estatik.min.css' );
    endif;

    // bbPress
    if ( class_exists( 'bbpress' ) ) :
      wp_enqueue_style( 'tx-bbpress', TX_CSS . 'bbpress.min.css' );
    endif;

    // The Events Calendar
    if ( class_exists( 'Tribe__Events__Main' ) ) :
      wp_enqueue_style( 'tx-event', TX_CSS . 'event.min.css' );
    endif;

    // Contact Form 7
    if ( function_exists('wpcf7') ) :
      wp_enqueue_style( 'tx-cf7', TX_CSS . 'cf7.min.css' );
    endif;

    // Services
    if( $tx['service_post_type'] ) :
      wp_enqueue_style( 'tx-services', TX_CSS . 'services.min.css' );
    endif;

    // Portfolio
    if( $tx['portfolio_post_type'] ) :
      wp_enqueue_style( 'tx-portfolio', TX_CSS . 'portfolio.min.css' );
    endif;

    // Team
    if( $tx['team_post_type'] ) :
      wp_enqueue_style( 'tx-team', TX_CSS . 'team.min.css' );
    endif;

    // Login
    if( $tx['login_reg'] ) :
      wp_enqueue_style( 'tx-login', TX_CSS . 'login.min.css' );
    endif;
    

    if( is_page_template( 'templates/portfolio.php' ) || is_archive('portfolio') ) :
      wp_enqueue_style( 'tx-magnific-popup', TX_CSS . 'magnific-popup.min.css' );
      wp_enqueue_script( 'tx-magnific-popup', TX_JS . 'jquery.magnific-popup.min.js', array('jquery'), false, true );
      wp_enqueue_script( 'tx-imagesloaded', TX_JS . 'imagesloaded.pkgd.min.js', array('jquery'), false, true );
      wp_enqueue_script( 'tx-isotope', TX_JS . 'isotope.pkgd.min.js', array('jquery'), false, true );    
    endif;

    if ( is_singular('team') || is_singular('lp_course') || (is_singular('post') && $tx['related-posts'] == 1) || $tx['news_ticker'] == 1 ) :
      wp_enqueue_style( 'tx-owl-carousel', TX_CSS . 'owl.carousel.min.css' );
      wp_enqueue_script( 'tx-owl-carousel', TX_JS . 'owl.carousel.min.js', array('jquery'), false, true );
    endif;

   if ( 'gallery' == get_post_format() || is_singular('portfolio') || is_singular('lp_course') || is_page_template( 'templates/blog.php' ) || is_page_template( 'templates/blog-two-columns.php' ) || is_page_template( 'templates/blog-three-columns.php' ) || is_archive('post') ) :
      wp_enqueue_style( 'tx-lightslider', TX_CSS . 'lightslider.min.css' );
      wp_enqueue_script( 'tx-lightslider', TX_JS . 'lightslider.min.js', array('jquery'), false, true );
   endif;

   if ( is_page_template( 'templates/single-post-full-width.php' ) || is_singular('portfolio') ) :
      wp_enqueue_style( 'tx-flexslider', TX_CSS . 'flexslider.min.css' );
      wp_enqueue_script( 'tx-flexslider', TX_JS . 'jquery.flexslider.min.js', array('jquery'), false, true );
   endif;

    // Dark Mode
    if( $tx['tx_dark_mode'] ) :
      wp_enqueue_style( 'darkmode', TX_CSS . 'darkmode.min.css' );
    endif;

    // RTL support
    if(is_rtl()):
      wp_enqueue_style( 'tx-rtl', TX_CSS . 'rtl.min.css');
    endif;

    wp_enqueue_script( 'tx-main-scripts', TX_JS . 'main.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'bootstrap', TX_JS . 'bootstrap.min.js', array('jquery'), false, true );

    // One page nav
    if( $tx['one_page_nav'] ) :
      wp_enqueue_script( 'one-page-nav', TX_JS . 'jquery.one-page-nav.min.js', array('jquery'), false, true );
    endif;
    // Scroll Progress-bar
    if($tx['scroll-progress-bar']) :
      wp_enqueue_script( 'tx-scroll-progress-bar', TX_JS . 'scroll-progress-bar.min.js', array('jquery'), false, true );
    endif;
    // Preloader
    if ($tx['preloader']) :
      wp_enqueue_script( 'sPreloader', TX_JS . 'sPreloader.min.js', array('jquery'), false, true );
    endif;

    // Cookie notice bar
    if( $tx['cookie_notice'] ) :
      wp_enqueue_script( 'cookieconsent', TX_JS . 'cookieconsent.min.js', array('jquery'), false, true );
    endif;

    // Dark mode
    if( $tx['tx_dark_mode'] ) :
      wp_enqueue_script( 'darkmode', TX_JS . 'darkmode.min.js', array('jquery'), false, true );
    endif;
    
    // Load WP Comment Reply JS
    if( is_singular() && comments_open() ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }

endif;

/* ---------------------------------------------------------
   Enqueue Styles & Scripts for Admin
------------------------------------------------------------ */
if( !function_exists('tx_admin_enqueue') ):
  add_action('admin_enqueue_scripts', 'tx_admin_enqueue');
  function tx_admin_enqueue() {
    wp_enqueue_style( 'font-awesome-admin', TX_CSS . 'font-awesome.min.css' ); // v4.7.0
    wp_enqueue_style( 'tx-admin-style', TX_CSS . 'admin.min.css' );
    wp_enqueue_style( 'bootstrap-icons-admin', TX_CSS . 'bootstrap-icons.min.css' );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );

    wp_enqueue_script( 'tx-admin-script', TX_JS . 'admin.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'jquery-ui-dialog', array('jquery') );
  }
endif;

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */