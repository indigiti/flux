<?php
/**
 * The template for displaying the widget banner.
 *
 * @package Flux
 */

$widget_title = get_theme_mod( 'theme_widget_banner_title' );

$banner_html       = get_theme_mod( 'theme_widget_banner_html' );
$banner_label      = get_theme_mod( 'theme_widget_banner_label', true );
$banner_label_text = get_theme_mod( 'theme_widget_banner_label_text', esc_html__( 'Advertisement', 'flux' ) );

?>

<div class="widget cs-widget cs-widget-banner">

	<?php if ( $widget_title ) { ?>
		<h2 class="cs-widget__heading"><?php echo esc_html( $widget_title ); ?></h2>
	<?php } ?>

	<?php if ( $banner_html ) { ?>
		<div class="cs-widget__content">
			<div class="cs-banner">
				<div class="cs-banner__container">
					<div class="cs-banner__content">
						<?php echo do_shortcode( $banner_html ); ?>
					</div>

					<?php if ( true === $banner_label && $banner_label_text ) { ?>
						<div class="cs-banner__label">
							<?php echo esc_html( $banner_label_text ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>

</div>
