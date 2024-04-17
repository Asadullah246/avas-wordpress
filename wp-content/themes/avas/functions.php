<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
*   This is main functions file you may add your custom functions here. 
* ======================================================================
*/
update_option( 'enable_full_version', '1' );
update_option( 'Avas_lic_Key', 'activated' );
update_option( 'Avas_lic_email', 'email@email.com' );
if( ! class_exists( 'TX_Update_Base' ) ) {
class TX_Update_Base {
    public static function CheckWPPlugin( $purchase_key, $email, &$error = "", &$responseObj = null, $plugin_base_file="" ) {
        $responseObj = (object) [
            'is_valid'      => '1',
            'expire_date'   => 'no expiry',
            'support_end'   => date('M d, Y', strtotime('+1 years')),
            'license_title' => 'Regular License',
            'license_key'   => '**********',
            'msg'           => 'msg'
        ];
        return true;
    }
}
}
if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
global $tx;
$theme = wp_get_theme();
if ( ! defined( 'TX_THEME_VERSION' ) ) {
  define('TX_THEME_VERSION', $theme->get('Version'));
}
if ( ! defined( 'TX_THEME_DIR' ) ) {
  define( 'TX_THEME_DIR', trailingslashit( get_template_directory() ) );
}
if ( ! defined( 'TX_THEME_URL' ) ) {
  define( 'TX_THEME_URL', trailingslashit( get_template_directory_uri() ) );
}
if ( ! defined( 'TX_STYLESHEET_DIR' ) ) {
  define( 'TX_STYLESHEET_DIR', trailingslashit( get_stylesheet_directory() ) );
}
if ( ! defined( 'TX_STYLESHEET_URL' ) ) {
  define( 'TX_STYLESHEET_URL', trailingslashit( get_stylesheet_directory_uri() ) );
}
if ( ! defined( 'TX_CSS' ) ) {
  define( 'TX_CSS', TX_THEME_URL . 'assets/css/' );
}
if ( ! defined( 'TX_JS' ) ) {
  define( 'TX_JS', TX_THEME_URL . 'assets/js/' );
}
if ( ! defined( 'TX_IMAGES' ) ) {
  define( 'TX_IMAGES', TX_THEME_URL . 'assets/images/' );
}
if ( ! defined( 'TX_IMPORT_URL' ) ) {
  define( 'TX_IMPORT_URL', 'https://avas.live/demo-data/' );
}
if ( ! defined( 'TX_DEMO_URL' ) ) {
  define( 'TX_DEMO_URL', 'https://avas.live/' );
}


// Welcome Screen
if( is_admin() ) :
  require_once TX_THEME_DIR . 'inc/welcome.php';
endif;

// Functions for header, footer, logo, favicon, etc
require_once TX_THEME_DIR . 'inc/functions.php';

// Theme options
  require_once TX_THEME_DIR . 'inc/theme-options.php';

// Dynamic Styles
require_once TX_THEME_DIR . 'inc/dynamic-style.php';

// Post Meta Categories, Tags etc
require_once TX_THEME_DIR . 'inc/post-meta.php';

// Pagination
require_once TX_THEME_DIR . 'inc/pagination.php';

// Comments callback
require_once TX_THEME_DIR . 'inc/comments-callback.php';

// Theme Updates
require_once TX_THEME_DIR . 'inc/updates.php';

// Enqueue
require_once TX_THEME_DIR . 'inc/enqueue.php';

// Mega Menu
require_once TX_THEME_DIR . 'inc/mega-menu.php';

// Login
require_once TX_THEME_DIR . 'inc/login.php';

// LearnPress plugin's functions for Education course
if ( class_exists( 'LearnPress' ) ) {
  require_once TX_THEME_DIR . 'learnpress/lp-functions.php'; 
}

// Woocommerece plugin's functions for eCommerce Shop
if ( class_exists( 'WooCommerce' ) ) {
  require_once TX_THEME_DIR . 'woocommerce/woo-functions.php'; 
}

// Estatik plugin's functions for Real Estate
if ( class_exists( 'Estatik' ) ) {
  require_once TX_THEME_DIR . 'estatik/estatik-functions.php'; 
}

// bbPress plugin's functions for Forum
if ( class_exists( 'bbpress' ) ) {
  require_once TX_THEME_DIR . 'bbpress/bbp-functions.php'; 
}


/* ---------------------------------------------------------
  Theme Setup
------------------------------------------------------------ */

if( !function_exists('tx_theme_setup') ) :
  
  function tx_theme_setup() {

    // menu setup
    register_nav_menus (array(
      'top_menu'    => esc_html__('Top Menu','avas'),
      'main_menu'   => esc_html__('Main Menu','avas'),
      'left_menu'   => esc_html__('Left Menu(For Header Style 9 only)','avas'),
      'right_menu'  => esc_html__('Right Menu(For Header Style 9 only)','avas'),
      'side_menu'   => esc_html__('Side Header Menu','avas'),
      'footer_menu' => esc_html__('Footer Menu','avas'),
      'mobile_menu' => esc_html__('Mobile Menu','avas'),
    ));

    // Makes theme available for translation.
    load_theme_textdomain( 'avas', TX_THEME_DIR . '/languages' );

    // Supported posts formats
    add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

    // Add RSS Links to head section
    add_theme_support( 'automatic-feed-links' );

    // Title tag support
    add_theme_support( 'title-tag' );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
      'height'      => 100,
      'width'       => 400,
      'flex-height' => true,
      'flex-width'  => true,
      'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Custom header support
    $args = array(
        'width'              => 1920,
        'height'             => 100,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );

    // Custom backgrounds support
    add_theme_support( 'custom-background', array() );

  // WooCommerce support
  if ( class_exists( 'WooCommerce' ) ) {

    add_theme_support('woocommerce');

    // WooCommerce product gallery zoom support
    add_theme_support( 'wc-product-gallery-zoom' );

    // WooCommerce product gallery lightbox support
    add_theme_support( 'wc-product-gallery-lightbox' );

    // WooCommerce product gallery slider support
    add_theme_support( 'wc-product-gallery-slider' );
  }
    // Enable WP Responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Enable WP Gutenberg Align Wide
    add_theme_support( 'align-wide' );

    // Enable WP Gutenberg Block Style
    add_theme_support( 'wp-block-styles' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Partial refresh support in the Customize
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Enable support for custom Editor Style.
    add_editor_style( 'custom-editor-style.css' );

    // Enable Custom Color Scheme For Block Style
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'deep cerise', 'avas' ),
            'slug' => 'deep-cerise',
            'color' => '#e51681',
        ),    
        array(
            'name' => esc_html__( 'strong magenta', 'avas' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => esc_html__( 'light grayish magenta', 'avas' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'avas' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => esc_html__( 'very dark gray', 'avas' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
        array(
            'name'  =>  esc_html__( 'strong blue', 'avas' ),
            'slug'  => 'strong-blue',
            'color' => '#0073aa',
        ),
        array(
            'name'  =>  esc_html__( 'lighter blue', 'avas' ),
            'slug'  => 'lighter-blue',
            'color' => '#229fd8',
        ),
    ) );

    // Block Font Sizes
    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => esc_html__( 'Small', 'avas' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__( 'Regular', 'avas' ),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_html__( 'Large', 'avas' ),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__( 'Huge', 'avas' ),
            'size' => 50,
            'slug' => 'larger'
        )
    ) );

    // Content Width
    if ( ! isset( $content_width ) ) {
      $content_width = 1140;
    }
  }
endif;

/* ------------------------------------------------------------------------
  Enable support for Post Thumbnails on posts, pages and custom post type.
--------------------------------------------------------------------------- */ 
function tx_add_image_size() {

    if (class_exists('ReduxFramework')) :
      global $tx;

      if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );

        if($tx['tx-1920x600-thumb_switch']) :
          add_image_size('tx-1920x600-thumb', $tx['tx-1920x600-thumb']['width'], $tx['tx-1920x600-thumb']['height'], true); // full width 1920x600px
        endif;

        if($tx['tx-xl-thumb_switch']) :
          add_image_size('tx-xl-thumb', $tx['tx-xl-thumb']['width'], $tx['tx-xl-thumb']['height'], true); // Extra large thumbnail 1140x500
        endif;

        if($tx['tx-l-thumb_switch']) :
          add_image_size('tx-l-thumb', $tx['tx-l-thumb']['width'], $tx['tx-l-thumb']['height'], true); // large thumbnail 750x420
        endif;

        if($tx['tx-ts-thumb_switch']) :
          add_image_size('tx-ts-thumb', $tx['tx-ts-thumb']['width'], $tx['tx-ts-thumb']['height'], true); // team single thumbnail
        endif;

        if($tx['tx-t-thumb_switch']) :
          add_image_size('tx-t-thumb', $tx['tx-t-thumb']['width'], $tx['tx-t-thumb']['height'], true); // team template thumbnail
        endif;

        if($tx['tx-tf-thumb_switch']) :
          add_image_size('tx-tf-thumb', $tx['tx-tf-thumb']['width'], $tx['tx-tf-thumb']['height'], true); // team full width template
        endif;

        if($tx['tx-m-thumb_switch']) :
          add_image_size('tx-m-thumb', $tx['tx-m-thumb']['width'], $tx['tx-m-thumb']['height'], true ); // medium thumbnail
        endif;

        if($tx['tx-alter-thumb_switch']) :
          add_image_size('tx-alter-thumb', $tx['tx-alter-thumb']['width'], $tx['tx-alter-thumb']['height'], true ); // alter thumbnail
        endif;

        if($tx['tx-team-alter-thumb_switch']) :
          add_image_size('tx-team-alter-thumb', $tx['tx-team-alter-thumb']['width'], $tx['tx-team-alter-thumb']['height'], true ); // team alter thumbnail
        endif;

        if($tx['tx-serv-thumb_switch']) :
          add_image_size('tx-serv-thumb', $tx['tx-serv-thumb']['width'], $tx['tx-serv-thumb']['height'], true ); // services thumbnail
        endif;

        if($tx['tx-serv-overlay-thumb_switch']) :
          add_image_size('tx-serv-overlay-thumb', $tx['tx-serv-overlay-thumb']['width'], $tx['tx-serv-overlay-thumb']['height'], true ); // services overlay thumbnail
        endif;

        if($tx['tx-c-thumb_switch']) :
          add_image_size('tx-c-thumb', $tx['tx-c-thumb']['width'], $tx['tx-c-thumb']['height'], true); // Posts carousel widget thumbnail
        endif;

        if($tx['tx-port-grid-h-thumb_switch']) :
          add_image_size('tx-port-grid-h-thumb', $tx['tx-port-grid-h-thumb']['width'], $tx['tx-port-grid-h-thumb']['height'], true); // Portfolio grid horizontal thumbnail
        endif;

        if($tx['tx-port-grid-v-thumb_switch']) :
          add_image_size('tx-port-grid-v-thumb', $tx['tx-port-grid-v-thumb']['width'], $tx['tx-port-grid-v-thumb']['height'], true); // Portfolio grid vertical thumbnail
        endif;

        if($tx['tx-timeline-thumb_switch']) :
          add_image_size('tx-timeline-thumb', $tx['tx-timeline-thumb']['width'], $tx['tx-timeline-thumb']['height'], true); // Timeline widget thumbnail
        endif;

        if($tx['tx-lp-thumb_switch']) :
          add_image_size('tx-lp-thumb', $tx['tx-lp-thumb']['width'], $tx['tx-lp-thumb']['height'], true); // Single course post thumbnail for LearnPress plugin
        endif;

        if($tx['tx-ms-size_switch']) :
          add_image_size('tx-ms-size', $tx['tx-ms-size']['width'], $tx['tx-ms-size']['height'], true ); // medium small
        endif;

        if($tx['tx-r-thumb_switch']) :
          add_image_size('tx-r-thumb', $tx['tx-r-thumb']['width'], $tx['tx-r-thumb']['height'], true); // related post thumbnail
        endif;

        if($tx['tx-s-thumb_switch']) :
          add_image_size('tx-s-thumb', $tx['tx-s-thumb']['width'], $tx['tx-s-thumb']['height'], true); // small thumbnail
        endif;

        if($tx['tx-pe-thumb_switch']) :
          add_image_size('tx-pe-thumb', $tx['tx-pe-thumb']['width'], $tx['tx-pe-thumb']['height'], true); // project experience thumbnail
        endif;

        if($tx['tx-admin-post-thumb_switch']) :
          add_image_size('tx-admin-post-thumb', $tx['tx-admin-post-thumb']['width'], $tx['tx-admin-post-thumb']['height'], false); // thumbail on all posts type in backend
        endif;

        if($tx['tx-bc-thumb_switch']) :
          add_image_size('tx-bc-thumb', $tx['tx-bc-thumb']['width']); // blog three cols, two cols
        endif;

        if($tx['tx-gall-grid-cols-3_switch']) :
          add_image_size('tx-gall-grid-cols-3', $tx['tx-gall-grid-cols-3']['width']); // Avas Gallery Widget for 3 columns
        endif;

        if($tx['tx-masonry-cols-3_switch']) :
          add_image_size('tx-masonry-cols-3', $tx['tx-masonry-cols-3']['width']); // Post masonry widget thumbnail for 3 columns post full width
        endif;

        if($tx['tx-masonry-cols-4_switch']) :
          add_image_size('tx-masonry-cols-4', $tx['tx-masonry-cols-4']['width']); // Post masonry widget thumbnail for 4 columns post full width

        endif;

        if($tx['tx-masonry-cols-5_switch']) :
          add_image_size('tx-masonry-cols-5', $tx['tx-masonry-cols-5']['width']); // Post masonry widget thumbnail for 5 columns post full width
        endif;

        if($tx['tx-masonry-cols-6_switch']) :
          add_image_size('tx-masonry-cols-6', $tx['tx-masonry-cols-6']['width']); // Post masonry widget thumbnail for 6 columns post full width
        endif;

    endif;

  }
add_action( 'after_setup_theme', 'tx_add_image_size' );


/* ---------------------------------------------------------
  Title limit
------------------------------------------------------------ */
  function tx_max_title_length( $title ) {
    global $tx;
      if (class_exists('ReduxFramework')) {
        if ( is_home () || is_category() || is_archive() || is_page_template( 'templates/blog.php' ) || is_page_template( 'templates/blog-three-columns.php' ) || is_page_template( 'templates/blog-two-columns.php' ) ) :
          $max = $tx['title-length']; 
          if( strlen( $title ) > $max ) {
          return substr( $title, 0, $max );
          } else {
          return $title;
          }
        else:
          return $title;
        endif;

      }else{

        $max = 85;
        if( strlen( $title ) > $max ) {
        return substr( $title, 0, $max );
        } else {
        return $title;
      }
    }
  }

  // avoid menu title
  function tx_set_title_length() {
    add_filter( 'the_title', 'tx_max_title_length', 10, 2);
  }

 // avoid menu title
 add_action( 'loop_start', 'tx_set_title_length');


/* ---------------------------------------------------------
  Excerpt word limit
------------------------------------------------------------ */
  function tx_excerpt($limit) {
    global $tx;
    if (class_exists('ReduxFramework')) {
     $limit = $tx['excerpt-word-limit'];
    }else{
      $limit = 35;
    }
      $excerpt = explode(' ', '<p class="tx-excerpt">'.get_the_excerpt().'</p>', $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      if( is_post_type_archive('post') || is_page('blog') || is_category() || is_tag() ) :
        if(class_exists('ReduxFramework')) :
          $rmt = $tx['read-more-text'];
          if($tx['read-more']) :
            $excerpt .= '<a class="tx-read-more" href="'. esc_url(get_permalink()) .'">'. esc_html($rmt) .'</a>';
          endif;
        endif;
      endif;
      return $excerpt;
  }
  add_filter('the_excerpt', 'tx_excerpt');

/* ---------------------------------------------------------
  Excerpt word limit
------------------------------------------------------------ */
function tx_excerpt_limit($limit) {

      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt);
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

      return $excerpt;
  }

/* ---------------------------------------------------------
  Content word limit
------------------------------------------------------------ */
  function tx_content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
  }

/* ---------------------------------------------------------
  Page content
------------------------------------------------------------ */
if(!function_exists('tx_content_page')) :
  add_action( 'tx_content_page', 'tx_content_page' );
  function tx_content_page() { ?>
        <!-- <div id="primary" class="col-md-12"> -->
            <div id="main" class="site-main">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'page'); ?>
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                <?php endwhile; // end of the loop.  ?>
            </div><!-- #main -->
        <!-- </div> --><!-- #primary -->

<?php }

endif;

/* ---------------------------------------------------------
  Post format
------------------------------------------------------------ */
function tx_post_format( $template ) {
    if ( is_single() && has_post_format() ) {
        $post_format_template = locate_template( 'single-' . get_post_format() . '.php' );
        if ( $post_format_template ) {
            $template = $post_format_template;
        }
    }

    return $template;
}   
add_filter( 'template_include', 'tx_post_format' );


/* ----------------------------------------------------------------
    Index, Archives, Category etc post page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_sidebar_no_sidebar')) :
  function tx_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['sidebar-select'] == null || $tx['sidebar-select'] == 'sidebar-none') {
        echo 12;
      } else {
       echo 8;
      }
    }else{
      echo 8;
    }

  }
endif;

/* ---------------------------------------------------------
    Single Post Sidebar / No Sidebar
------------------------------------------------------------ */
if(!function_exists('tx_single_sidebar')) :
  function tx_single_sidebar() {
    global $tx;
    if($tx['sidebar-single'] == null || $tx['sidebar-single'] == 'sidebar-none') {
      echo 12;
    } else {
     echo 8;
    }
  }
endif;

/* ---------------------------------------------------------
    Add sideber class to body for index, archive etc page
------------------------------------------------------------ */
if ( !function_exists('tx_sidebar_class_body_archive')) :

    add_filter('body_class', 'tx_sidebar_class_body_archive');
    function tx_sidebar_class_body_archive($classes = '') {
        global $tx;
        if($tx['sidebar-select'] == 'sidebar-right') {
        $classes[] = 'sidebar-right';
        }

        elseif ($tx['sidebar-select'] == 'sidebar-left') {
            $classes[] = 'sidebar-left';
        }else{
            $classes[] = 'no-sidebar';
        }
    return $classes;

    }
endif;

/* ---------------------------------------------------------
    Add sideber class to body for single post
------------------------------------------------------------ */
if ( !function_exists('tx_sidebar_classes_body_single')) :

    add_filter('body_class', 'tx_sidebar_classes_body_single');
    function tx_sidebar_classes_body_single($classes = '') {
        global $tx;
        if($tx['sidebar-single'] == 'sidebar-right') {
        $classes[] = 'sidebar-right';
        }

        elseif ($tx['sidebar-single'] == 'sidebar-left') {
            $classes[] = 'sidebar-left';
        }else{
            $classes[] = 'no-sidebar';
        }
    return $classes;

    }
endif;

/* ---------------------------------------------------------
    Remove Category: and Tag: word from archive title
------------------------------------------------------------ */
if(!function_exists('tx_remove_cat_tag_word')) :
function tx_remove_cat_tag_word( $title ) {
    if ( is_category() || is_tag() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'tx_remove_cat_tag_word' );
endif;

/* ---------------------------------------------------------
    Tag limit
------------------------------------------------------------ */

//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'tx_tag_widget_limit');
//Limit number of tags inside widget
function tx_tag_widget_limit($args) {
    global $tx;
//Check if taxonomy option inside widget is set to tags
if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
$args['number'] = $tx['tag_limit']; //Limit number of tags
}
return $args;
}

/* ---------------------------------------------------------
    Display post thumbnail on posts list at backend
------------------------------------------------------------ */

function tx_admin_post_cols($cols) {
    return array_merge(
        array_splice($cols, 0, 1),
        ["tx-admin-thumb" => "Thumb"],
        $cols
    );
}

function tx_admin_post_thumb_col($col, $id) {
    if ($col == "tx-admin-thumb") {
        $link = get_edit_post_link();
        $thumb = get_the_post_thumbnail($id, "tx-admin-post-thumb");    
        echo wp_kses_post($thumb ? "<a href='$link'>$thumb</a>" : '<img src="'.TX_IMAGES.'no-image.png">');
    }
}


add_filter('manage_posts_columns','tx_admin_post_cols');

add_action('manage_posts_custom_column', 'tx_admin_post_thumb_col', 10, 2 );

/* ------------------------------------------------------------------------------------------
    Set locale for change the comma to decimal avoid brakes Elementor generated CSS style.
--------------------------------------------------------------------------------------------- */
setlocale(LC_NUMERIC, 'en_US.UTF-8');

/* -------------------------------------------------------
   Notice: WP_Scripts::localize was called incorrectly.
---------------------------------------------------------- */

add_filter('doing_it_wrong_trigger_error', function () {return false;}, 10, 0);

/* ---------------------------------------------------------
    Remove WordPress Default gallery border
------------------------------------------------------------ */
add_filter( 'use_default_gallery_style', '__return_false' );


/* ---------------------------------------------------------
    Allow user role subscriber to Upload Media
------------------------------------------------------------ */
if (!function_exists('tx_allow_subscriber_uploads')) :

add_action('admin_init', 'tx_allow_subscriber_uploads');
function tx_allow_subscriber_uploads() {
    if ( current_user_can('subscriber') && !current_user_can('upload_files') ){
        $subscriber = get_role('subscriber');
        $subscriber->add_cap('upload_files');
    }
}

endif;

/* ---------------------------------------------------------
    Custom Font Support // ttf extension support
------------------------------------------------------------ */
if( is_admin() && isset($_GET['page']) && $_GET['page'] == 'avas' ){
  add_filter('upload_mimes', 'tx_custom_font_support');
  function tx_custom_font_support( $existing_mimes = array() ){
    $existing_mimes['ttf'] = 'font/ttf';
    return $existing_mimes;
  }
}

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */