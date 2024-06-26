<?php
/**
 * Template for displaying top-bar in archive course page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.1
 */

defined( 'ABSPATH' ) || exit;
$layouts = learn_press_courses_layouts();
$active  = learn_press_get_courses_layout();
$s       = LP_Request::get( 'c_search' );
global $tx;
if($tx['lp_search'] || $tx['lp_layout']) :
?>


<div class="lp-courses-bar <?php echo esc_attr( $active ); ?>">
	<form class="search-courses" method="get" action="<?php echo esc_url( learn_press_get_page_link( 'courses' ) ); ?>">
		<input type="hidden" name="post_type" value="<?php echo esc_attr( LP_COURSE_CPT ); ?>">
		<input type="hidden" name="taxonomy" value="<?php echo esc_attr( get_queried_object()->taxonomy ?? $_GET['taxonomy'] ?? '' ); ?>">
		<input type="hidden" name="term_id" value="<?php echo esc_attr( get_queried_object()->term_id ?? $_GET['term_id'] ?? '' ); ?>">
		<input type="hidden" name="term" value="<?php echo esc_attr( get_queried_object()->slug ?? $_GET['term'] ?? '' ); ?>">
		<input type="text" placeholder="<?php esc_attr_e( 'Search courses...', 'avas' ); ?>" name="c_search" value="<?php echo esc_attr( $s ); ?>">
		<button type="submit"><i class="fas fa-search"></i></button>
	</form>

	<div class="switch-layout">
		<?php foreach ( $layouts as $layout => $value ) : ?>
			<input type="radio" name="lp-switch-layout-btn" value="<?php echo esc_attr( $layout ); ?>" id="lp-switch-layout-btn-<?php echo esc_attr( $layout ); ?>" <?php checked( $layout, $active ); ?>>
			<label class="switch-btn <?php echo $layout; ?>" title="<?php echo sprintf( esc_attr__( 'Switch to %s', 'avas' ), $layout ); ?>" for="lp-switch-layout-btn-<?php echo esc_attr( $layout ); ?>"></label>
		<?php endforeach; ?>
	</div>
</div>

<?php endif;