<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
*/
global $tx;
?>

<div class="related-posts">
	<?php
        $rp_query = new WP_Query(
	    array(
			'category__in'   => wp_get_post_categories( $post->ID ),
			'posts_per_page' => $tx['related_posts_count'],
			'post__not_in'   => array( $post->ID )
		    )
	   	);
	?>
	<h3 class="related-posts-title"><?php echo wp_kses_post($tx['related-posts_text']); ?></h3>
	   	<?php if( $rp_query->have_posts() ) { ?>
	   	<div class="related-posts-loop owl-carousel"> 
	    <?php while( $rp_query->have_posts() ) {
			$rp_query->the_post(); 
			if( $tx['related_posts_style'] == 'rp_style_1' ) :
		?>
			<div class="related-posts-item">		
		    	<a rel="external" href="<?php the_permalink();?>">
		    		<?php if (has_post_thumbnail()) {
		    			the_post_thumbnail('tx-r-thumb'); 
		    		} else { ?>
		    			<img src="<?php echo TX_IMAGES.'related-posts.png'; ?>" alt="<?php the_title()?>">
		    		<?php } 
		    		?>
		    	</a>
		    	<div class="overlay">
		    		<?php the_title(sprintf('<h6 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h6>'); ?>
		    	</div>
			</div><!-- style 1 -->

		<?php
			elseif( $tx['related_posts_style'] == 'rp_style_2' ) : ?>

			<div class="related-posts-item">		
		    	<a rel="external" href="<?php the_permalink();?>">
		    		<?php if (has_post_thumbnail()) : the_post_thumbnail('tx-r-thumb'); endif; ?>
		    		<?php the_title(sprintf('<h5 class="entry-title">', esc_url(get_permalink())), '</h5>'); ?>
		    	</a>
			</div><!-- style 2 -->

		<?php		
			endif;
		}
	    	wp_reset_postdata(); ?>
	    </div><!-- related-posts-loop owl-carousel -->
   		<?php }

	?>
</div><!-- related-posts -->
    
