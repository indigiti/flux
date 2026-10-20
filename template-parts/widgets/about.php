<?php
/**
 * The template for displaying the widget about.
 *
 * @package Flux
 */

$widget_title  = get_theme_mod( 'theme_widget_about_title' );
$avatar        = get_theme_mod( 'theme_widget_about_avatar' );
$avatar_link   = get_theme_mod( 'theme_widget_about_avatar_url' );
$avatar_target = get_theme_mod( 'theme_widget_about_avatar_url_target', '_self' );
$subheading    = get_theme_mod( 'theme_widget_about_subheading' );
$heading       = get_theme_mod( 'theme_widget_about_heading' );
$description   = get_theme_mod( 'theme_widget_about_description' );

$item_heading_open  = '<div class="cs-widget-about__avatar">';
$item_heading_close = '</div>';

if ( $avatar_link ) {
	$item_heading_open  = '<a href="' . esc_url( $avatar_link ) . '" target="' . esc_attr( $avatar_target ) . '" rel="noindex nofollow" class="cs-widget-about__avatar">';
	$item_heading_close = '</a>';
}

?>

<div class="widget cs-widget cs-widget-about">

	<?php if ( $widget_title ) { ?>
		<h2 class="cs-widget__heading"><?php echo esc_html( $widget_title ); ?></h2>
	<?php } ?>

	<?php if ( $avatar || $subheading || $heading || $description ) { ?>
		<div class="cs-widget__content">
			<?php if ( $avatar ) { ?>
				<?php echo wp_kses( $item_heading_open, 'post' ); ?>
					<?php csco_get_retina_image( attachment_url_to_postid( $avatar ), array( 'alt' => '' ) ); ?>
				<?php echo wp_kses( $item_heading_close, 'post' ); ?>
			<?php } ?>
			<?php if ( $subheading ) { ?>
				<div class="cs-widget-about__subheading">
					<?php echo do_shortcode( $subheading ); ?>
				</div>
			<?php } ?>
			<?php if ( $heading ) { ?>
				<div class="cs-widget-about__heading">
					<?php echo do_shortcode( $heading ); ?>
				</div>
			<?php } ?>
			<?php if ( $description ) { ?>
				<div class="cs-widget-about__description">
					<?php echo do_shortcode( $description ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

</div>
