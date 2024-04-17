<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
* functions for header, footer, etc.
* ======================================================================
*/

/* ---------------------------------------------------------
  Mobile version enable / disable
------------------------------------------------------------ */
if(class_exists('ReduxFramework') ) :
add_action( 'wp_head', 'tx_mob_desk_switch', 0 );
function tx_mob_desk_switch() {
  global $tx;
  if($tx['mob_version']) : ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">       
<?php endif;
}
endif;
/* ---------------------------------------------------------
  Welcome
------------------------------------------------------------ */
function tx_welcome_js() { ?>
        <script>
          jQuery(document).ready(function($){'use strict';      
            $('.tx-wel-wrap').css('opacity', '1');
          });
        </script>
<?php }

/* ---------------------------------------------------------
  Layout
------------------------------------------------------------ */
// page layout
if (!function_exists('tx_page_layout')) :
  function tx_page_layout() {
  global $tx;
  if ($tx['page-layout'] == 'full-width') {
    echo '-fluid';
  }
  elseif ($tx['page-layout'] == 'boxed') {
    echo '';
  }else{
    echo '-fluid';
  }
}
endif;

// header layout
if (!function_exists('tx_header_layout')) :
  function tx_header_layout() {
  global $tx;
  if ($tx['header-layout'] == 'width') {
    echo '-fluid';
  }
  if ($tx['header-layout'] == 'boxed') {
    echo '';
  }
}
endif;

/* ---------------------------------------------------------
  Header Style
------------------------------------------------------------ */
if(!function_exists('tx_header_style')):
    
  function tx_header_style() {
    global $tx;
    if ($tx['header_on_off']) :
      if($tx['header-select'] == 'header1') {
        get_template_part( 'template-parts/header/style/style', '1' ); 
      }
      elseif($tx['header-select'] == 'header2') {
        get_template_part( 'template-parts/header/style/style', '2' );
      }            
      elseif($tx['header-select'] == 'header3') {
        get_template_part( 'template-parts/header/style/style', '3' );
      }
      elseif($tx['header-select'] == 'header4') {
        get_template_part( 'template-parts/header/style/style', '4' );
      }  
      elseif($tx['header-select'] == 'header5') {
        get_template_part( 'template-parts/header/style/style', '5' );
      }                     
      elseif($tx['header-select'] == 'header6') {
        get_template_part( 'template-parts/header/style/style', '6' );
      }
      elseif($tx['header-select'] == 'header7') {
        get_template_part( 'template-parts/header/style/style', '7' );
      }    
      elseif($tx['header-select'] == 'header8') {
        get_template_part( 'template-parts/header/style/style', '8' );
      }
      elseif($tx['header-select'] == 'header9') {
        get_template_part( 'template-parts/header/style/style', '9' );
      }
      elseif($tx['header-select'] == 'header10') {
        get_template_part( 'template-parts/header/style/style', '10' );
      }
      elseif($tx['header-select'] == 'header11') {
        get_template_part( 'template-parts/header/style/style', '11' );
      }
    endif;                                 
  }
endif;

/* ---------------------------------------------------------
   Add header style 10 class on body
------------------------------------------------------------ */
add_filter( 'body_class', 'tx_header_style_ten_class' );
function tx_header_style_ten_class( $classes ) {
  global $tx;
    if ( $tx['header-select'] == 'header10' ) {
        $classes[] = 'tx_header_style_10';
    }
    return $classes;
}

/* ---------------------------------------------------------
   Favicon
------------------------------------------------------------ */
if( class_exists('ReduxFramework') ) :
    add_action('wp_head', 'tx_favicon');
    function tx_favicon() {
      global $tx;
        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
         if($tx['favicon'] != '') {     
          echo '<link rel="shortcut icon" type="image/x-icon" href="' . wp_kses_post($tx['favicon']['url']) . '"/>';
        } else {
          echo '<link rel="shortcut icon" type="image/x-icon" href="' . TX_IMAGES . 'icon.png"/>';
        }
      }
    }
endif;

/* ---------------------------------------------------------
   Logo
------------------------------------------------------------ */
if(!function_exists('tx_logo')) :
  add_action( 'tx_logo', 'tx_logo' );
  function tx_logo() {
    global $tx; 
    if ( class_exists( 'ReduxFramework' ) ) {
    ?>

        <?php if ( isset($tx['tx_logo']['url']) && ($tx['tx_logo']['url'] != "" ) && !wp_is_mobile() ) : ?>
          <a class="navbar-brand tx_logo " href="<?php if($tx['logo_link_url']!= "") : echo esc_url($tx['logo_link_url']); else: echo esc_url(get_site_url()); endif; ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_url($tx['tx_logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a> 
        <?php endif; ?>

        <!-- mobile logo -->
        <?php if ( isset($tx['tx_logo_mobile']['url']) && ($tx['tx_logo_mobile']['url'] != "" ) && wp_is_mobile() ) : ?>
          <a class="navbar-brand tx_logo " href="<?php if($tx['logo_link_url']!= "") : echo esc_url($tx['logo_link_url']); else: echo esc_url(get_site_url()); endif; ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_url($tx['tx_logo_mobile']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a> 
        <?php endif; ?>

        <!-- sticky logo -->
        <?php if ($tx['sticky_header'] == '1') : ?>
        <?php if ( isset($tx['tx_logo_sticky']['url']) && ($tx['tx_logo_sticky']['url'] != "" ) && !wp_is_mobile() ) : ?>
          <a class="navbar-brand tx_logo tx_sticky_logo" href="<?php if($tx['logo_link_url']!= "") : echo esc_url($tx['logo_link_url']); else: echo esc_url(get_site_url()); endif; ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_url($tx['tx_logo_sticky']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
        <?php endif; ?>
        <?php if ( isset($tx['tx_logo_mobile_sticky']['url']) && ($tx['tx_logo_mobile_sticky']['url'] != "" ) && wp_is_mobile() ) : ?>
          <a class="navbar-brand tx_logo tx_sticky_logo" href="<?php if($tx['logo_link_url']!= "") : echo esc_url($tx['logo_link_url']); else: echo esc_url(get_site_url()); endif; ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_url($tx['tx_logo_mobile_sticky']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
        <?php endif; ?>
        <?php endif; ?>



<?php
// custom logo
} elseif (has_custom_logo()) {
  $custom_logo_id = get_theme_mod( 'custom_logo' );
              $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
            echo '<a class="navbar-brand tx_logo" href="'.esc_url(get_site_url()).'"><img src="' . esc_url( $custom_logo_url ) . '" alt="' . esc_attr(get_bloginfo('name')) . '"></a>';
} else {
  echo '<a class="navbar-brand tx_logo" href="'.esc_url(get_site_url()).'"><h1>'. esc_attr(get_bloginfo('name')) .'</h1></a>';
}


  }
endif;

/* ---------------------------------------------------------
  Search popup
------------------------------------------------------------ */
if (!function_exists('tx_search')) :
  add_action( 'tx_search', 'tx_search' );
  function tx_search() { ?>
    <div id="search" class="search-form">
      <form role="search" id="search-form" class="search-box" action="<?php echo esc_url(home_url('/')); ?>" method="get">
          <input type="search" required="" aria-required="true" name="s" placeholder="<?php esc_html_e('Search here ...','avas'); ?>" value="<?php echo get_search_query(); ?>">
          <span class="search-close"><i class="bi bi-x-lg"></i></span>
      </form>
    </div>
<?php
  }
endif;  
                      

/* ---------------------------------------------------------
  Menu Button
------------------------------------------------------------ */
if (!function_exists('tx_menu_btn')) :
  add_action( 'tx_menu_btn', 'tx_menu_btn' );
  function tx_menu_btn() {
    global $tx;
    if($tx['menu_btn_switch']) {
    ?>
    <div class="tx-menu-btn-wrap">
      <a href="<?php if($tx['menu_btn_url']){echo esc_url($tx['menu_btn_url']);} ?>" <?php tx_menu_btn_link_new_window(); ?> class="tx-menu-btn"><?php if($tx['menu_btn_txt']){printf(esc_html__('%s','avas'),$tx['menu_btn_txt']);} ?></a>
    </div>
<?php }
}
endif;

/* ---------------------------------------------------------
  menu button link open in new window target = _blank
------------------------------------------------------------ */
if(!function_exists('tx_menu_btn_link_new_window')) :
  function tx_menu_btn_link_new_window() {
    global $tx;

    if ($tx['menu_btn_link_new_window'] == '1') {
      echo 'target="_blank"';
    }
     if ($tx['menu_btn_link_new_window'] == '0') {
      echo '';
    }
  }
endif;

/* ---------------------------------------------------------
  Search Icon
------------------------------------------------------------ */
if(!function_exists('tx_search_icon')) :
  add_action( 'tx_search_icon', 'tx_search_icon' );
  function tx_search_icon() {
      global $tx;
      if($tx['search']) {  
        echo '<a class="search-icon" href="#search"><i class="bi bi-search"></i></a>';
      }
  }
endif;

/* ---------------------------------------------------------
    Side Menu / Hamburger Icon
------------------------------------------------------------ */
add_action('tx_sidemenu_icon', 'tx_sidemenu_icon');
function tx_sidemenu_icon() {
  global $tx;
  if($tx['side_menu']) : ?>
    <a id="side-menu-icon" class="side_menu_icon" data-toggle="collapse" href="#side-menu-wrapper" role="button" aria-expanded="false" aria-controls="side-menu-wrapper"><i class="bi bi-list"></i></a>
<?php endif;
}


/* ---------------------------------------------------------
  Header Banner Ads
------------------------------------------------------------ */
if (!function_exists('tx_head_ads')) :
  function tx_head_ads() {
    global $tx;
      if($tx['banner-bussiness-switch'] =='1')  : ?>
      <div class="tx_h_a">
        <?php if ($tx['h_ads_switch'] == '1') : 
        if (isset($tx['head_ad_banner']['url']) && ($tx['head_ad_banner']['url'] != "" ) && isset($tx['head_ad_banner_link'])) { ?>
        <a href="<?php echo esc_attr( $tx['head_ad_banner_link'] ); ?>" <?php tx_head_ad_banner_link_new_window(); ?>><img src="<?php echo esc_url($tx['head_ad_banner']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
        <?php } 
        endif;
        ?> 
        <?php 
        if ($tx['h_ads_switch'] == '2') :
            echo wp_sprintf( $tx['head_ad_js'] );
        endif; ?> 
      </div>
      <?php endif; 
  }
endif;


/* ---------------------------------------------------------
  News Ticker
------------------------------------------------------------ */
if (!function_exists('tx_news_ticker')) :
  add_action( 'tx_news_ticker', 'tx_news_ticker' );
  function tx_news_ticker() {
    global $tx;
    if(isset($tx['news_ticker_categories'])) {
      $query = array(
      'posts_per_page' => $tx['newsticker-posts-per-page'],
      'cat' => $tx['news_ticker_categories'],
      'order' => $tx['news_ticker_order'],
      'nopaging' => 0,
      'meta_key' => 'post_views_count',
      'orderby' => $tx['news_ticker_orderby'],
      'post_status' => 'publish',
      );
    } else {
      $query = array(
      'posts_per_page' => $tx['newsticker-posts-per-page'],
      'order' => $tx['news_ticker_order'],
      'nopaging' => 0,
      'meta_key' => 'post_views_count',
      'orderby' => $tx['news_ticker_orderby'],
      'post_status' => 'publish',
      );
    }
    $args = new WP_Query($query);
    if ($args->have_posts()) {
    ?>
<div class="news-ticker-wrap d-flex align-items-center">
    <div class="tx_news_ticker_main">
      <div class="tx_news_ticker_bar">
        <?php echo esc_html__($tx['news_ticker_bar_text'],'avas'); ?>
      </div><!-- /.tx_news_ticker_bar -->
    </div><!-- /.tx_news_ticker_main -->

    <div id="news-ticker" class="news-ticker owl-carousel d-flex align-items-center">
        <?php
       
        while ($args->have_posts()) : $args->the_post();?>
          <div class="news-inner">
            <?php the_title(sprintf('<h6 class="news-ticker-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h6>'); ?>
          </div>
<?php 
        endwhile;
        wp_reset_postdata(); ?>
    </div>
</div><!-- /.news-ticker-wrap -->
<?php        
    } 
  }
endif;

/* ---------------------------------------------------------
  ads link open in new window target = _blank
------------------------------------------------------------ */
if(!function_exists('tx_head_ad_banner_link_new_window')) :

  function tx_head_ad_banner_link_new_window() {
    global $tx;

    if ($tx['head_ad_banner_link_new_window'] == '1') {
      echo 'target="_blank"';
    }
    if ($tx['head_ad_banner_link_new_window'] == '0') {
      echo '';
    }
  }

endif;

/* ---------------------------------------------------------
  Insert ads after paragraph of single post content.
------------------------------------------------------------ */
add_filter( 'the_content', 'tx_insert_post_ads' );
function tx_insert_post_ads( $content ) {
    global $tx;
    $s_ad_banner_link = (!empty($tx['s_ad_banner_link'])) ? $tx['s_ad_banner_link'] : '';
    $img_code = '<div class="ad_300_250"><a href="'.$s_ad_banner_link.'"><img src="'.$tx['s_ad_banner']['url'].'" alt="ads" ></a></div>';
    if(isset($tx['s_ad_js'])) {
    $js_code = '<div class="ad_300_250">'.$tx['s_ad_js'].'</div>';
   }
    if($tx['post_ads']) :
    if ( is_singular('post') && ! is_admin() ) {
      global $tx;
      if (!empty($tx['s_ad_banner']['url'] && $tx['s_ads_switch'])) {
        if(isset($tx['s_ads_after_p'])) {
        return tx_insert_after_paragraph( $img_code, $tx['s_ads_after_p'], $content );
        }
      }
      else{
        return tx_insert_after_paragraph( $js_code, $tx['s_ads_after_p'], $content );
      }
    }
    endif;
    return $content;
}
  
// Parent Function that makes the magic happen
function tx_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {
 
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }
 
        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }
     
    return implode( '', $paragraphs );
}

/* ---------------------------------------------------------
  Sticky Header
------------------------------------------------------------ */
if(!function_exists('tx_sticky_header')) :

  function tx_sticky_header() {
    global $tx;

    if ($tx['sticky_header'] == '1') {
      echo 'float-panel';
    }

    if ($tx['sticky_header'] == '0') {
      echo 'no-sticky';
    }
    

  }

endif;

/* ---------------------------------------------------------
  Footer layout
------------------------------------------------------------ */
if(!function_exists('tx_footer_width')) :
function tx_footer_width() {
  global $tx;
  if ($tx['footer_layout'] == 'boxed') {
    echo '';
  }
   if ($tx['footer_layout'] == 'width') {
    echo '-fluid';
  }
}
endif;

/* ---------------------------------------------------------
  Footer Style
------------------------------------------------------------ */
if(!function_exists('tx_footer_style')):
  add_action( 'footer-style', 'tx_footer_style' );  
  function tx_footer_style() {
    global $tx;
    if($tx['footer-select'] == 'footer1') {
      get_template_part( 'template-parts/footer/style/style', '1' ); 
    }
    elseif($tx['footer-select'] == 'footer2') {
      get_template_part( 'template-parts/footer/style/style', '2' );
    }        
    elseif($tx['footer-select'] == 'footer3') {
      get_template_part( 'template-parts/footer/style/style', '3' );
    }                                      
  }
endif;

/* ---------------------------------------------------------
  Cookie Notice Bar
------------------------------------------------------------ */

add_action( 'wp_footer', 'tx_cookieconsent', 900 );

function tx_cookieconsent() {
  global $tx;
  if( $tx['cookie_notice'] ) {
  ?>
  <script>
      'use strict';
      const cc = new CookieConsent({
        type: 'opt-out',
        content: {
            header: '<?php echo esc_html__( 'Cookies used on the website!', 'avas' ); ?>',
            message: '<?php echo wp_kses_post( $tx['cookie_notice_text'] ); ?>',
            dismiss: '<?php echo esc_attr( $tx['cookie_notice_accept'] ); ?>',
            link: '<?php echo esc_attr( $tx['cookie_notice_learnmore_text'] ); ?>',
            href: '<?php echo esc_url( $tx['cookie_notice_learnmore_link'] ); ?>',
            target: '_blank',
            policy: '' // Cookie Policy
        },
        elements: {
            deny: '',
        },
        cookie: {
            expiryDays: '<?php echo esc_attr( $tx['cookie_expiry'] ); ?>',
            domain: '',
        },
        position: '<?php echo esc_attr( $tx['cookie_notice_position'] ); ?>',
        
      });
    </script>
<?php
    }
 }

 /* ---------------------------------------------------------
  Dark Mode
------------------------------------------------------------ */
add_action( 'wp_footer', 'tx_dark_mode' );
function tx_dark_mode() {
  global $tx;
  if( $tx['tx_dark_mode'] ) : ?>
    <script>
      jQuery(document).ready(function($){'use strict';

          var options = {
            bottom: '45px', // default: '32px'
            right: '90px', // default: '32px'
            left: 'unset', // default: 'unset'
            time: '0.5s', // default: '0.3s'
            mixColor: '<?php echo esc_attr( $tx["darkmode_mixcolor"] ); ?>', // default: '#fff'
            backgroundColor: '<?php echo esc_attr( $tx["darkmode_bgcolor"] ); ?>',  // default: '#fff'
            buttonColorDark: '<?php echo esc_attr( $tx["darkmode_btncolordark"] ); ?>',  // default: '#100f2c'
            buttonColorLight: '<?php echo esc_attr( $tx["darkmode_btncolorlight"] ); ?>', // default: '#fff'
            saveInCookies: <?php echo esc_attr( $tx["darkmode_saveInCookies"] ); ?>, // default: true,
            label: '🌓', // default: ''
            autoMatchOsTheme: <?php echo esc_attr( $tx["darkmode_autoMatchOsTheme"] ); ?> // default: true
          }

          const darkmode = new Darkmode(options);
          
        <?php if($tx['tx_dark_mode_toggle'] ):?>
          darkmode.toggle(); // enable dark mode onload
        <?php endif; ?>
        <?php if($tx['tx_dark_mode_btn'] ):?>
          darkmode.showWidget(); // display button
        <?php endif; ?>

      });
    </script>
  <?php endif;
}

/* ---------------------------------------------------------
  Active Modal
------------------------------------------------------------ */

function tx_active_modal() {

 if( isset($_GET["page"]) && $_GET["page"] == "Welcome") { 
    return;
  } elseif(is_admin()) {

    ?>
  <div id="tx_register_notice" class="tx_active_modal_register">
      <p class="tx_active_modal_register"><?php echo esc_html_e('Please register the Avas theme to unlock all the features.','avas'); ?></p>
      <a href="<?php echo esc_url(admin_url('admin.php?page=Welcome')); ?>" class="button button-primary"><?php echo esc_html_e('Register','avas');?> </a>
      
  </div>
<?php }

}

/* ---------------------------------------------------------
    Theme Updates
------------------------------------------------------------ */

add_filter ( 'pre_set_site_transient_update_themes', 'tx_update_theme' );
  function tx_update_theme ( $transient ) {
 if( empty( $transient->checked['avas'] ) )
    return $transient;

  $ch = curl_init();
 
  curl_setopt($ch, CURLOPT_URL, TX_DEMO_URL.'avas.json' );
 
 // 3 second timeout to avoid issue on the server
 curl_setopt($ch, CURLOPT_TIMEOUT, 3 ); 
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

 $result = curl_exec($ch);
 curl_close($ch);

 // make sure that we received the data in the response is not empty
 if( empty( $result ) )
   return $transient;

 //check server version against current installed version
 if( $data = json_decode( $result ) ){
   if( version_compare( $transient->checked['avas'], $data->new_version, '<' ) )
 $transient->response['avas'] = (array) $data;
 }
 
 return $transient;

}

/* ---------------------------------------------------------
  Single Team Social Icons
------------------------------------------------------------ */
add_action('tx_single_team_social_icons', 'tx_single_team_social_icons');
function tx_single_team_social_icons() {
  global $post;
  $team_fb = get_post_meta( $post->ID, 'team_fb', true );
  $team_tw = get_post_meta( $post->ID, 'team_tw', true );
  $team_gp = get_post_meta( $post->ID, 'team_gp', true );
  $team_ln = get_post_meta( $post->ID, 'team_ln', true );
  $team_in = get_post_meta( $post->ID, 'team_in', true );
  
  if (!empty($team_fb || $team_tw || $team_gp || $team_ln || $team_in) ) : ?>       
        <ul class="team-social">
              <?php if (!empty($team_fb)) : ?>
              <li><a href="<?php echo esc_url($team_fb); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
              <?php endif; ?>
              <?php if (!empty($team_tw)) : ?>
              <li><a href="<?php echo esc_url($team_tw); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
              <?php endif; ?>
              <?php if (!empty($team_gp)) : ?>
              <li><a href="<?php echo esc_url($team_gp); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
              <?php endif; ?>
              <?php if (!empty($team_ln)) : ?>
              <li><a href="<?php echo esc_url($team_ln); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
              <?php endif; ?>
              <?php if (!empty($team_in)) : ?>
              <li><a href="<?php echo esc_url($team_in); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
              <?php endif; ?>
        </ul>
        <?php endif;
}


/* ---------------------------------------------------------
  Single team header
------------------------------------------------------------ */
add_action('tx_single_team_header', 'tx_single_team_header');
function tx_single_team_header() { ?>
  <header class="team-title">
    <h2 class="team-name"><?php the_title(); ?></h2>
  <?php
    global $post;
    $terms = get_the_terms( $post->ID, 'team-category' );
    if ( $terms && ! is_wp_error( $terms ) ) :
      $taxonomy = array();
      foreach ( $terms as $term ) :
        $taxonomy[] = $term->name;
      endforeach;
      $cat_name = join( " ", $taxonomy);
      $cat_link = get_term_link( $term );
    else:
      $cat_name = '';
    endif;
    if(!empty($cat_name)) : ?>
      <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
    <?php endif; ?>  
  </header>
<?php
}

/* ---------------------------------------------------------
  keyboard accessible drop-down menu
------------------------------------------------------------ */
  add_action('wp_footer','tx_keyboard_accessible_drop_down_menu'); 
  function tx_keyboard_accessible_drop_down_menu() {
    global $tx;
    if($tx['keyboard_accessible_dropdown_menu']):
    ?>
    <script>
    jQuery(document).ready(function($){"use strict";$(".menu-item-has-children > a").focus(function(){$(this).siblings(".sub-menu").addClass("tx_focused")}).blur(function(){$(this).siblings(".sub-menu").removeClass("tx_focused")}),$(".sub-menu a").focus(function(){$(this).parents(".sub-menu").addClass("tx_focused")}).blur(function(){$(this).parents(".sub-menu").removeClass("tx_focused")})})
    </script>
    <?php endif;
  }

/* ---------------------------------------------------------
  Reader Progress-bar
------------------------------------------------------------ */
  add_action('wp_footer','tx_scroll_progress_bar'); 
  function tx_scroll_progress_bar() {
    global $tx;
    if($tx['scroll-progress-bar']):
    ?>
    <script>
        jQuery(document).ready(function($){'use strict';
            $(document).topProgressBar({
            });
        });
    </script>
  <?php
    endif;
  }


/* ---------------------------------------------------------
  One Page Navigation
------------------------------------------------------------ */
  add_action('wp_footer','tx_one_page_nav');
  function tx_one_page_nav() {
    global $tx;
    if($tx['one_page_nav']):
    ?>
    <script>
        jQuery(document).ready(function($){'use strict';
            $('.main-menu').onePageNav();
        });
    </script>
  <?php
    endif;
  }

/* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */