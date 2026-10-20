<?php
/**
 * Template part for Entry Header
 *
 * @package Flux
 */

$header_type = csco_get_page_header_type();

if ( 'overlay' === $header_type ) {
	$header_class = '';
	$orientation  = 'cs-ratio-landscape-21-9';
	$container    = true;

	if ( 'disabled' !== csco_get_page_sidebar() ) {
		$orientation = 'cs-ratio-landscape-16-9';
		$container   = false;
	}

	if ( has_post_thumbnail() ) {
		$header_class = 'cs-entry__header-has-image';
		$caption      = csco_post_thumbnail_caption();
	}
	?>

	<div class="cs-entry__header cs-entry__header-overlay">
		<?php if ( $container ) { ?>
			<div class="cs-container">
		<?php } ?>
			<div class="cs-entry__media-large cs-entry__media-overlay cs-video-wrap">
				<div class="cs-entry__media-wrap cs-entry__overlay cs-overlay-ratio <?php echo esc_attr( $orientation ); ?>" data-scheme="inverse">
					<figure class="cs-overlay-background">
						<?php the_post_thumbnail( 'csco-large' ); ?>
						<?php csco_get_video_background( 'overlay-header', null, 'large', true, true ); ?>
					</figure>

					<div class="cs-entry__header-content cs-overlay-content">
						<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
						<?php get_template_part( 'template-parts/entry/entry-header-secondary-info' ); ?>
					</div>
				</div>
				<?php if ( $caption ) { ?>
					<div class="cs-entry__thumbnail-caption">
						<?php echo wp_kses_post( $caption ); ?>
					</div>
				<?php } ?>
			</div>
		<?php if ( $container ) { ?>
			</div>
		<?php } ?>
	</div>

	<?php
}
