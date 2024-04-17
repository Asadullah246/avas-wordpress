<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* ============================
*        404 Error page
* ============================
*
*/

get_header(); 
global $tx;

?>

<div class="container">
	<div class="row">
		<div class="error-404">
			<h1><?php echo esc_attr( $tx['404_numb'] ); ?></h1>	
			<h4><?php echo esc_attr( $tx['404_heading'] ); ?></h4>
			<p><?php echo esc_attr( $tx['404_desc'] ); ?></p>
			<a class="tx_404_btn" href="<?php echo esc_url(home_url()); ?>"><?php echo esc_attr( $tx['404_btn'] ); ?></a>
		</div><!-- /.error-404 -->
	</div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer();