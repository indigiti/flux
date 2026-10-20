<?php
/**
 * Template part for displaying post standard.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flux
 */

?>

<article <?php post_class( ( isset( $args['entry_class'] ) && ! empty( $args['entry_class'] ) ) ? $args['entry_class'] : '' ); ?>>
	<div class="cs-entry__outer">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-<?php echo esc_attr( $args['image_orientation'] ); ?>">
				<div class="cs-entry__meta cs-entry__meta-overlay">
					<?php csco_get_post_meta( array( 'category' ), true, $args['meta'] ); ?>
				</div>

				<div class="cs-overlay-background">
					<?php
					the_post_thumbnail( $args['image_size'], array( 'loading' => $args['image_lazyload'] ) );

					if ( isset( $args['layout_type'] ) && 'type-1' !== $args['layout_type'] ) {
						csco_the_post_format_icon();
					}
					?>
				</div>

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
			</div>
		<?php } ?>

		<div class="cs-entry__inner cs-entry__content">
			<div class="cs-entry__info">
				<?php
				the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

				if ( $args['excerpt'] ) {
					$content = csco_get_the_excerpt( 200 );

					if ( $content ) {
						?>
						<div class="cs-entry__excerpt">
							<?php echo esc_html( $content ); ?>
						</div>
						<?php
					}
				}
				?>
			</div>
			<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, $args['meta'] ); ?>
		</div>
	</div>
</article>
