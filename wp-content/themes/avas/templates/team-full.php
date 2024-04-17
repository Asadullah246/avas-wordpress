<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Team Full Width (Publish & Reload page)
*
*/
global $tx;
get_header();
$item_per_page = get_post_meta( $post->ID, 'item_per_page', true );
$display = get_post_meta( $post->ID, 'display', true );
$title = get_post_meta( $post->ID, 'title', true );
$desc = get_post_meta( $post->ID, 'desc', true );
$social_profiles = get_post_meta( $post->ID, 'social_profiles', true );
$team_category = get_post_meta( $post->ID, 'team_category', true );
?>

<div class="container-fluid">
	<div class="row">
		<?php
		global $tx;
		if ( get_query_var('paged') ) :
			  $paged = get_query_var('paged');
		elseif ( get_query_var('page') ) :
		      $paged = get_query_var('page');
		else :
		      $paged = 1;
		endif;
		
		$args = array(
	      'post_type' => 'team',
	      'posts_per_page' => $item_per_page,
	      'paged' => $paged
	    );

		$query = new WP_Query( $args ); ?>
  		<?php if ( $query->have_posts() ) : ?>
  	 	
  		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="col-lg-2 col-xs-12 col-sm-6">
				<div class="team <?php echo esc_attr($display); ?>">
				<figure>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail('tx-tf-thumb'); ?>		
					<?php if($display == 'grid_t'): ?>
					<figcaption>
						<?php if($title == 'show') : ?>
							<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<?php endif; ?>
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
						?>
						<?php if(!empty($cat_name) && $team_category == 'show') : ?>
						<p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
						<?php endif; ?>
						<?php if($desc == 'show') : ?>
						<div class="team-bio"><?php echo tx_excerpt_limit(15); ?></div>
						<?php endif; ?>
						<?php if($social_profiles == 'show'): do_action('tx_single_team_social_icons'); endif; ?>
					</figcaption>
					<?php endif; ?>
					</a>
					<?php if( $display == 'card_t' ) : 
						if($team_category == 'show' || $title == 'show' || $desc == 'show' || $social_profiles == 'show'):
					?>
					<div class="tx-team-card">
							
							<?php if($title == 'show') : ?>
							<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							<?php endif; ?>

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
							?>
						
						<?php if(!empty($cat_name) && $team_category == 'show') : ?>
						<p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
						<?php endif; ?>

						<?php if($desc == 'show') : ?>
							<div class="team-bio"><?php echo tx_excerpt_limit(15); ?></div>
						<?php endif; ?>
						
						<?php if($social_profiles == 'show') : do_action('tx_single_team_social_icons'); endif; ?>
					</div>
					<?php endif; 
					 endif; ?>
				</figure>
				</div><!-- team -->
			</div>	<!-- col-md-3 col-xs-12 col-sm-6 -->
		<?php endwhile; ?>
 		
	    
		<?php wp_reset_postdata(); ?>

		<?php else:  ?>
	    <?php get_template_part('template-parts/content/content', 'none'); ?>
	  	<?php endif; ?>
	  	<div class="tx-clear"></div>
	  	<!-- pagination -->
		<?php tx_pagination_number($query->max_num_pages,"",$paged); ?>
		
</div>
</div>
<?php get_footer(); ?>
