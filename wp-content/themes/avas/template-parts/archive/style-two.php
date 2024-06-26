<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Posts archive template style two
**/
global $tx;
?>

	<?php if($tx['sidebar-select'] == 'sidebar-left') : get_sidebar(); endif; ?>
    <div id="primary" class="col-md-<?php echo tx_sidebar_no_sidebar(); ?>">
	<div class="row">
	<?php
	// Check if there are any posts to display
	if ( have_posts() ) : ?>
	  
		<!-- the loop -->
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-md-6 col-sm-12 blog-cols">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
					<?php if ( has_post_format('video') ) { ?>
					<?php 
			            $post_video_link = get_post_meta( $post->ID, 'post_link', true );
        				if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
			            <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
			        <?php } else {
			            if (has_post_thumbnail()) : ?>
			                <div class="zoom-thumb featured-thumb">
			                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                    <?php the_post_thumbnail('tx-bc-thumb'); ?>
			                    </a>
			                </div>
			        <?php endif; 
			            } ?>

        		<?php } elseif ( has_post_format('gallery') ) {
 					$images = get_post_meta($post->ID, 'tx_gallery_id', true); 
			        if(function_exists('tx_add_gallery_metabox') && $images) { ?>
			            <div class="gallery-slider"><!-- slider start -->         
			                <ul class="posts-gallery-slider cS-hidden">
			                <?php         
			                $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
			                if($images) :
			                foreach ($images as $image) {

			                $image_thumb_url = wp_get_attachment_image_src($image, 'tx-s-thumb'); 
			                $thumbs = $image_thumb_url[0];
			                $gallery = wp_get_attachment_link($image, 'tx-bc-thumb');

			                    echo '<li data-thumb = "'.$thumbs.'">';                
			                    echo  wp_kses_post($gallery);
			                    echo '</li>';  
			                }
			                  endif;
			                ?>
			                </ul>
			            </div><!-- slider end --> 
			        <?php } else { ?> 
			        <?php if (has_post_thumbnail()) : ?>
			            <div class="zoom-thumb featured-thumb">
			                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                <?php the_post_thumbnail('tx-bc-thumb'); ?>
			                </a>
			            </div>
			        <?php endif; }
        		} else { 

				if (has_post_thumbnail()) : ?>
			            <div class="zoom-thumb featured-thumb">
			                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                <?php the_post_thumbnail('tx-bc-thumb'); ?>
			                </a>
			            </div>
			        <?php endif;

        		} ?>
				<div class="details-box">
                    <?php tx_date(); ?>
                        <h4 class="post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                        <?php the_title(); ?>
                        </a></h4>
                        <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                    <?php tx_category(); ?>
                    <?php tx_comments(); ?>
                    <?php if ($tx['post-views']) : echo tx_getPostViews(get_the_ID()); endif; ?>
                    </div>
                    <?php endif; ?><!-- .entry-meta -->
                    <?php echo tx_excerpt(35); ?>

                <div class="clear"></div>
  
                </div>
			</article>
		</div>
		<?php endwhile; ?><!-- end of the loop -->
		<?php wp_reset_postdata(); ?>
		<?php else:  ?>
    	<?php get_template_part('template-parts/content/content', 'none'); ?>
  		<?php endif; ?>
  		<div class="tx-clear"></div>
		<?php tx_pagination_number(); ?>
	</div> <!-- end .row -->
		</div> <!-- end #primary -->

	<?php if (class_exists('ReduxFramework')) {
			if($tx['sidebar-select'] == 'sidebar-right') : 
				get_sidebar(); 
			endif; 
		} else {
			get_sidebar();
		} ?>