<?php
/**
 * Template part for displaying full posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flux
 */

// Thumbnail size.
$thumbnail_size = 'csco-large';

if ( 'uncropped' === csco_get_page_preview() ) {
	$thumbnail_size = sprintf( '%s-uncropped', $thumbnail_size );
}
?>

<article <?php post_class(); ?>>
	<div class="cs-entry__outer">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php if ( get_post_meta( $args['current_post_id'], 'csco_post_video_url', true ) ) { ?>
				<figure class="cs-entry__inner cs-entry__thumbnail">
					<div class="cs-entry__meta cs-entry__meta-overlay">
						<?php csco_get_post_meta( array( 'category' ), true, $args['meta'] ); ?>
					</div>

					<div class="cs-overlay-background cs-overlay-transparent">
						<?php

						the_post_thumbnail( $thumbnail_size );

						csco_get_video_background( $args['location'] );

						csco_the_post_format_icon();

						?>
					</div>

					<a class="cs-overlay-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title() ); ?>"></a>
				</figure>
			<?php } else { ?>

				<figure class="cs-entry__thumbnail">
					<div class="cs-entry__meta cs-entry__meta-overlay">
						<?php csco_get_post_meta( array( 'category' ), true, $args['meta'] ); ?>
					</div>

					<?php
					the_post_thumbnail( $thumbnail_size );
					csco_the_post_format_icon();
					?>
				</figure>
			<?php } ?>
		<?php } ?>

		<div class="cs-entry__inner cs-entry__content">
			<div class="cs-entry__info">
				<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '"><span>', '</span></a></h2>' ); ?>

				<div class="cs-entry__content-wrap">
					<div class="cs-entry-type-<?php echo esc_attr( $args['summary_type'] ); ?> ">
						<?php
						if ( 'summary' === $args['summary_type'] ) {
							the_excerpt();
						} else {
							$more_link_text = false;

							$more_link_text = sprintf(
								// translators: %s: Name of current post.
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flux' ),
								get_the_title()
							);

							the_content( $more_link_text );
						}
						?>
					</div>
				</div>
			</div>

			<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, $args['meta'] ); ?>
		</div>
	</div>
</article>
