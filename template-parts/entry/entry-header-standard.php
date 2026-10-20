<?php
/**
 * The template part for displaying header Standard.
 *
 * @package Flux
 */

$header_type = csco_get_page_header_type();

if ( 'standard' === $header_type ) {

	$thumbnail_size = 'csco-large';
	$orientation    = 'cs-ratio-landscape-16-9';

	if ( 'uncropped' === csco_get_page_preview() ) {
		$thumbnail_size = sprintf( '%s-uncropped', $thumbnail_size );
		$orientation    = 'cs-ratio-original';
	}

	?>
	<div class="cs-entry__header cs-entry__header-standard">

		<div class="cs-entry__header-content">
			<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
			<?php get_template_part( 'template-parts/entry/entry-header-secondary-info' ); ?>
		</div>

		<?php
		if ( has_post_thumbnail() ) {
			$caption = csco_post_thumbnail_caption();
			?>
			<div class="cs-entry__media">
				<div class="cs-entry__media-wrap cs-overlay-ratio <?php echo esc_attr( $orientation ); ?>">
					<figure class="cs-overlay-background cs-overlay-transparent">
						<?php the_post_thumbnail( $thumbnail_size ); ?>
					</figure>
				</div>
				<?php if ( $caption ) { ?>
					<div class="cs-entry__thumbnail-caption">
						<?php echo wp_kses_post( $caption ); ?>
					</div>
				<?php } ?>
			</div>
			<?php
		}
		?>

	</div>
	<?php
} elseif ( 'title' === $header_type ) {
	?>
	<div class="cs-entry__header cs-entry__header-standard cs-entry__header-title-only">

		<div class="cs-entry__header-content">
			<?php the_title( '<h1 class="cs-entry__title"><span>', '</span></h1>' ); ?>
		</div>

	</div>
	<?php
}
