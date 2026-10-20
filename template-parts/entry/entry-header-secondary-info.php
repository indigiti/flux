<?php
/**
 * The template part for displaying header secondary info.
 *
 * @package Flux
 */

?>

<?php
	// Post Meta.
if ( is_singular( 'post' ) ) {

	$settings = array(
		'author_avatar' => true,
	);

	if ( get_theme_mod( 'post_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ) ) {
		$display_post_meta = __return_true();
	}

	if ( isset( $display_post_meta ) ) {

		global $post;

		setup_postdata( $post );

		csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, 'post_meta', $settings );

		wp_reset_postdata();

	}
}
