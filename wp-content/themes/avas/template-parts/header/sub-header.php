<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*  Sub Header
*/
global $tx;

if(class_exists('WooCommerce')) :
  $product_cat = is_product_category();
else:
$product_cat = is_category();
endif;

if(class_exists('Estatik')) :
  $estatik = Es_Property::get_post_type_name();
else:
  $estatik = 'post';
endif;

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

$sh_banner_id = get_post_meta(get_the_ID(), 'tx_subheader_bg', true);
$sh_banner_img_url = wp_get_attachment_image_src( $sh_banner_id, 'full' );
$sh_banner_image = isset($sh_banner_img_url[0]) ? $sh_banner_img_url[0] : '';


$tx_page_title = is_page() && $tx['sub_h_post_title']['page'] == '1';
$tx_page_breadcrumbs = is_page() && $tx['sub_h_post_breadcrumbs']['page'] == '1';

$tx_post_title = (is_singular('post') && $tx['sub_h_post_title']['post'] == '1') || (is_post_type_archive('post') && $tx['sub_h_post_title']['post'] == '1') || (is_tag() && $tx['sub_h_post_title']['post'] == '1') || (is_category() && $tx['sub_h_post_title']['post'] == '1') || (is_author() && $tx['sub_h_post_title']['post'] == '1');
$tx_post_breadcrumbs = (is_singular('post') && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_tag() && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_category() && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_author() && $tx['sub_h_post_breadcrumbs']['post'] == '1' ) || (is_post_type_archive('post') && $tx['sub_h_post_breadcrumbs']['post'] == '1' );

$tx_portfolio_title = (is_singular('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') || (is_post_type_archive('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') || (is_tax('portfolio-category') && $tx['sub_h_post_title']['portfolio'] == '1');
$tx_portfolio_breadcrumbs = (is_post_type_archive('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1') || (is_tax('portfolio-category') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1') || (is_singular('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1');

$tx_service_title = (is_singular('service') && $tx['sub_h_post_title']['service'] == '1') || (is_post_type_archive('service') && $tx['sub_h_post_title']['service'] == '1') || (is_tax('service-category') && $tx['sub_h_post_title']['service'] == '1');
$tx_service_breadcrumbs = (is_post_type_archive('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1') || (is_tax('service-category') && $tx['sub_h_post_breadcrumbs']['service'] == '1') || (is_singular('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1');

$tx_team_title = (is_singular('team') && $tx['sub_h_post_title']['team'] == '1') || (is_post_type_archive('team') && $tx['sub_h_post_title']['team'] == '1') || (is_tax('team-category') && $tx['sub_h_post_title']['team'] == '1');
$tx_team_breadcrumbs = (is_post_type_archive('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1') || (is_tax('team-category') && $tx['sub_h_post_breadcrumbs']['team'] == '1') || (is_singular('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1');

$tx_lp_course_title = (is_post_type_archive('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') || (is_tax('course_category') && $tx['sub_h_post_title']['lp_course'] == '1') || (is_singular('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1');
$tx_lp_course_breadcrumbs = (is_post_type_archive('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1') || (is_singular('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1');

$tx_product_title = (is_post_type_archive('product') && $tx['sub_h_post_title']['product'] == '1') || (is_singular('product') && $tx['sub_h_post_title']['product'] == '1');
$tx_product_breadcrumbs = (is_post_type_archive('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1') || (is_singular('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1') || $product_cat;

// Estatik plugin
$tx_estatik_title = (is_post_type_archive($estatik) && $tx['sub_h_post_title']['properties'] == '1') || ( is_singular($estatik) && $tx['sub_h_post_title']['properties'] == '1' ) || (is_tax('es_category') && $tx['sub_h_post_title']['properties'] == '1') || (is_tax('es_status') && $tx['sub_h_post_title']['properties'] == '1') || (is_tax('es_type') && $tx['sub_h_post_title']['properties'] == '1');
$tx_estatik_breadcrumbs = (is_post_type_archive($estatik) && $tx['sub_h_post_breadcrumbs']['properties'] == '1') || ( is_singular($estatik) && $tx['sub_h_post_breadcrumbs']['properties'] == '1' ) || (is_tax('es_category') && $tx['sub_h_post_breadcrumbs']['properties'] == '1') ||  (is_tax('es_status') && $tx['sub_h_post_breadcrumbs']['properties'] == '1') || (is_tax('es_type') && $tx['sub_h_post_breadcrumbs']['properties'] == '1');

// The Events Calendar plugin
$tx_events_title = (is_singular('tribe_events') && $tx['sub_h_post_title']['tribe_events'] == '1') || (is_post_type_archive('tribe_events') && $tx['sub_h_post_title']['tribe_events'] == '1') || (is_tax('tribe_events_cat') && $tx['sub_h_post_title']['tribe_events'] == '1');
$tx_events_breadcrumbs = (is_singular('tribe_events') && $tx['sub_h_post_breadcrumbs']['tribe_events'] == '1') || (is_post_type_archive('tribe_events') && $tx['sub_h_post_breadcrumbs']['tribe_events'] == '1');

// BBPess plugin
if (class_exists('bbPress')) :
  $tx_bbpress_title = ( is_bbpress() && $tx['sub_h_post_title']['bbpress'] == 1 );
  $tx_bbpress_breadcrumbs = ( is_bbpress() && $tx['sub_h_post_breadcrumbs']['bbpress'] == '1' );
else:
  $tx_bbpress_title = $tx_post_title;
  $tx_bbpress_breadcrumbs = $tx_post_breadcrumbs;
endif;



 if( $tx_page_title || $tx_post_title || $tx_portfolio_title || $tx_service_title || $tx_team_title || $tx_lp_course_title || $tx_product_title || $tx_estatik_title || $tx_events_title || $tx_page_breadcrumbs || $tx_post_breadcrumbs || $tx_portfolio_breadcrumbs || $tx_service_breadcrumbs || $tx_team_breadcrumbs || $tx_lp_course_breadcrumbs || $tx_product_breadcrumbs || $tx_estatik_breadcrumbs || $tx_events_breadcrumbs || $tx_bbpress_title || $tx_bbpress_breadcrumbs ) : ?>

  <div class="sub-header" <?php if (!empty($sh_banner_image)) { echo 'style="background-image:url('.esc_attr($sh_banner_image).'")'; } elseif( is_page() ) { if ( has_post_thumbnail() ) : echo 'style="background-image:url('.$featured_img_url.')"'; endif; } ?> >
    <div class="sub-header-overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <?php 
          if (class_exists('ReduxFramework')) {
            if($tx['sub_h_title']): 

              if ( (is_home()) && (get_option('show_on_front') == 'page') && (get_option('page_for_posts') != 0) ) :
                echo '<h1 class="sub-header-title entry-title">' . esc_html(get_the_title(get_option('page_for_posts'))) . '</h1>';
              endif;

              if($tx_page_title) :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // page title

              if(is_singular('post') && $tx['sub_h_post_title']['post'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // post title
              if(is_tag() && $tx['sub_h_post_title']['post'] == '1') :
                the_archive_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // tag title
              if(is_category() && $tx['sub_h_post_title']['post'] == '1') :
                the_archive_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // category title
              if(is_author() && $tx['sub_h_post_title']['post'] == '1') :
                the_archive_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // author single page
              if(is_post_type_archive('post') && $tx['sub_h_post_title']['post'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif;
              if(is_singular('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') :
                 the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // portfolio single page
              if(is_post_type_archive('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // portfolio archive page
              if(is_tax('portfolio-category') && $tx['sub_h_post_title']['portfolio'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif; // portfolio category page

              if(is_singular('service') && $tx['sub_h_post_title']['service'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // service single page
              if(is_post_type_archive('service') && $tx['sub_h_post_title']['service'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // service archive page
              if(is_tax('service-category') && $tx['sub_h_post_title']['service'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif; // service category page

              if(is_singular('team') && $tx['sub_h_post_title']['team'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // team single page
              if(is_post_type_archive('team') && $tx['sub_h_post_title']['team'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // team archive page
              if(is_tax('team-category') && $tx['sub_h_post_title']['team'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif; // team category page

            if(class_exists('LearnPress')) :
              if(is_post_type_archive('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // learnpress course archive page
              if(is_singular('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // learnpress course single page
              if(is_tax('course_category') && $tx['sub_h_post_title']['lp_course'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // learnpress course tax
            endif;

            if(class_exists('WooCommerce')) :
              if(is_post_type_archive('product') && $tx['sub_h_post_title']['product'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                woocommerce_page_title();
                echo '</h1>';
              endif; // woocommerce shop archive page
              if(is_singular('product') && $tx['sub_h_post_title']['product'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif; // woocommerce product single page
              if(is_product_category() && $tx['sub_h_post_title']['product'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif; // woocommerce product category page
              if(is_product_tag() && $tx['sub_h_post_title']['product'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif; // woocommerce product tag page
            endif; // woocommerce class

            if(class_exists('Estatik')) :
              if(is_post_type_archive($estatik) && $tx['sub_h_post_title']['properties'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                post_type_archive_title();
                echo '</h1>';
              endif;
              if(is_singular($estatik) && $tx['sub_h_post_title']['properties'] == '1') :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif;
              if(is_tax('es_category') && $tx['sub_h_post_title']['properties'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif;
              if(is_tax('es_type') && $tx['sub_h_post_title']['properties'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif;
              if(is_tax('es_status') && $tx['sub_h_post_title']['properties'] == '1') :
                echo '<h1 class="sub-header-title entry-title">';
                single_term_title();
                echo '</h1>';
              endif;
            endif; // Estatik plugin check

          if(class_exists('Tribe__Events__Main')) :
            if(is_post_type_archive('tribe_events') && $tx['sub_h_post_title']['tribe_events'] == '1') :
              echo '<h1 class="sub-header-title entry-title">';
              echo post_type_archive_title();
              echo '</h1>';
            endif; // The Events Calendar plugin

            if(is_singular('tribe_events') && $tx['sub_h_post_title']['tribe_events'] == '1') : // single event title
               the_title('<h1 class="sub-header-title entry-title">', '</h1>');
            endif; // The Events Calendar plugin
          endif; // The Events Calendar plugin check
        if (class_exists('bbPress')) :
          $tempContent = get_the_content();
          $tempCheck = '[bbp-';
          $tempVerify = strpos($tempContent,$tempCheck);
          if($tempVerify === false) {
              if($tx_bbpress_title ):
                echo '<h1 class="sub-header-title entry-title">';
                echo get_the_title();
                echo '</h1>';
              endif; // bbpress title
          } 
        endif;


            endif; // title end

          } else {
              if(is_singular('post')) :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif;
              if(is_category()) :
                single_cat_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif;
              if(is_tag()) :
                single_tag_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif;
              if(is_page()) :
                the_title('<h1 class="sub-header-title entry-title">', '</h1>');
              endif;

            }
          ?>
          
        </div> <!-- title end -->

        <div class="col-lg-12 col-md-12 col-sm-12">
          <?php  
              if($tx['breadcrumbs']) :
                if(is_page() && $tx['sub_h_post_breadcrumbs']['page'] == '1'){
                  do_action('tx_breadcrumbs');
                } // page breadcrumbs

                if(is_singular('post') && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post breadcrumbs
                if(is_tag() && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post tag breadcrumbs
                if(is_category() && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post cat breadcrumbs
                if(is_post_type_archive('post') && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post is_post_type_archive breadcrumbs

                if(is_author() && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post author breadcrumbs

                if(is_post_type_archive('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1'){
                  do_action('tx_breadcrumbs');
                } // service archive breadcrumbs
                if(is_tax('service-category') && $tx['sub_h_post_breadcrumbs']['service'] == '1'){
                  do_action('tx_breadcrumbs');
                } // service tax breadcrumbs
                if(is_singular('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1'){
                  do_action('tx_breadcrumbs');
                } // service breadcrumbs

                if(is_post_type_archive('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1'){
                  do_action('tx_breadcrumbs');
                } // portfolio archive breadcrumbs
                if(is_tax('portfolio-category') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1'){
                  do_action('tx_breadcrumbs');
                } // portfolio tax breadcrumbs
                if(is_singular('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1'){
                  do_action('tx_breadcrumbs');
                } // portfolio breadcrumbs

                if(is_post_type_archive('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1'){
                  do_action('tx_breadcrumbs');
                } // team archive breadcrumbs
                 if(is_tax('team-category') && $tx['sub_h_post_breadcrumbs']['team'] == '1'){
                  do_action('tx_breadcrumbs');
                } // team tax breadcrumbs
                if(is_singular('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1'){
                  do_action('tx_breadcrumbs');
                } // team breadcrumbs

              if(class_exists('LearnPress')) :  
                if(is_post_type_archive('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1'){
                  do_action('tx_breadcrumbs');
                } // lp_course archive breadcrumbs
                if(is_singular('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1'){
                  do_action('tx_breadcrumbs');
                } // lp_course breadcrumbs
                if(is_tax('course_category') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1') :
                do_action('tx_breadcrumbs');
              endif; // learnpress course taxonomy breadcrumbs
              endif;

              if(class_exists('WooCommerce')) :
                if(is_post_type_archive('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product archive breadcrumbs
                if(is_singular('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product breadcrumbs
                if(is_product_category() && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product cat breadcrumbs
                if(is_product_tag() && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product tag breadcrumbs
              endif; // class WooCommerce

              if(class_exists('Estatik')) :
                if(is_post_type_archive( $estatik ) && $tx['sub_h_post_breadcrumbs']['properties'] == '1' ) :
                  do_action('tx_breadcrumbs');
                endif;
                if(is_singular( $estatik ) && $tx['sub_h_post_breadcrumbs']['properties'] == '1' ) :
                  do_action('tx_breadcrumbs');
                endif;
                if(is_tax('es_category') && $tx['sub_h_post_breadcrumbs']['properties'] == '1') :
                  do_action('tx_breadcrumbs');
                endif;
                if(is_tax('es_status') && $tx['sub_h_post_breadcrumbs']['properties'] == '1') :
                  do_action('tx_breadcrumbs');
                endif;
                if(is_tax('es_type') && $tx['sub_h_post_breadcrumbs']['properties'] == '1') :
                  do_action('tx_breadcrumbs');
                endif;
              endif; // Estatik plugin check

            if ( class_exists( 'Tribe__Events__Main' ) ) :
              if(is_post_type_archive('tribe_events') && $tx['sub_h_post_breadcrumbs']['tribe_events'] == '1') :
                do_action('tx_breadcrumbs');
              endif; 
              if(is_singular( 'tribe_events' ) && $tx['sub_h_post_breadcrumbs']['tribe_events'] == '1') :
                  do_action('tx_breadcrumbs');
              endif; // the envets calendar breadcrumbs
            endif;  // the envets calendar plugin check

        if (class_exists('bbPress')) :    
          $tempContent = get_the_content();
          $tempCheck = '[bbp-';
          $tempVerify = strpos($tempContent,$tempCheck);
          if($tempVerify === false) {
              if( $tx_bbpress_breadcrumbs ):
                bbp_breadcrumb();
              endif; // bbpress breadcrumbs
          }
        endif;

          endif;
          ?>
        </div><!-- breadcrumbs end  -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.sub-header -->
 
  <?php endif;


