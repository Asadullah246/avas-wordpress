<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://theme-x.org/
 *
 * ====================================
 *         Single Post
 * ====================================
 */
global $tx;
get_header();
if(class_exists('Estatik')) :
  $estatik = Es_Property::get_post_type_name();
endif;
?>

<div class="container space-content">
<div class="row">
    <?php 
        if( is_singular('post') ) :
            if($tx['sidebar-single'] == 'sidebar-left') : get_sidebar('single'); endif;
        else: 
            if(class_exists('Estatik')):
                if( is_singular( $estatik ) && $tx['estatik-single-sidebar-select'] == 'estatik-single-sidebar-left' ) : get_sidebar('estatik-single'); endif;
            endif;
        endif;
    ?>
    <div id="primary" class="col-lg-<?php if(is_singular('post')) : echo tx_single_sidebar(); endif; if(class_exists('Estatik')) :if(is_singular($estatik)) : echo tx_estatik_single_sidebar_no_sidebar(); endif;endif; ?> col-md-8 col-sm-12">
        <main id="main" class="site-main">
            <?php while (have_posts()) : the_post(); ?>
                <?php tx_setPostViews(get_the_ID()); ?>
                <?php get_template_part( 'template-parts/content/content', get_post_format() ); ?>
                <?php
                    if( is_singular('post') ) :
                        do_action('tx_social_share');
                    endif;
                ?>                    
                <?php

                        if ($tx['related-posts'] && is_singular( 'post' ) ) :
                            get_template_part( 'template-parts/content/related', 'posts' );
                        endif;

                ?><!-- related posts -->
                <?php
                if( is_singular('post') ) :
                    if (class_exists('ReduxFramework')) :
                        if ($tx['prev-next-posts']) :
                            do_action('tx_pagination'); 

                        endif;
                    endif;
                endif;
                ?>
                <?php 
                    if( is_singular('post') ) :
                        if (!post_password_required()) :
                            if ($tx['author-bio-posts']) :
                                do_action('tx_author_bio'); 
                            endif;
                        endif;
                    endif;
                ?><!-- author bio -->
                <?php
                if (class_exists('ReduxFramework')) {
                    if ($tx['comments-posts']) :
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    endif;
                }else{
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                }
                ?> <!-- comments -->
            <?php endwhile; // end of the loop.  ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php 
        if( is_singular('post') ) :
            if($tx['sidebar-single'] == 'sidebar-right') : get_sidebar('single');endif;
        else:
            if(class_exists('Estatik')):
                if( is_singular( $estatik ) && $tx['estatik-single-sidebar-select'] == 'estatik-single-sidebar-right' ) :  get_sidebar('estatik-single'); endif;
            endif;
        endif;
?>

</div></div>
<?php
get_footer();