<?php
/**
 * Template part for displaying Featured Archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maag
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$options = csco_get_archive_options();

$query = new \WP_Query( csco_get_archive_featured_query_args( array( 'location' => $options['location'] ) ) );
?>

<section class="cs-featured-archive cs-posts-area__archive">
	<div class="cs-featured-archive__grid">
		<?php
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$csco_avoid_duplicate_post_ids[] = get_the_ID();
				?>
				<article <?php post_class(); ?>>

					<div class="cs-entry__outer">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-<?php echo esc_attr( get_theme_mod( 'featured_archive_image_orientation', 'landscape-16-9' ) ); ?>">

								<div class="cs-entry__meta cs-entry__meta-overlay">
									<?php csco_get_post_meta( array( 'category' ), true, get_theme_mod( 'featured_archive_post_meta', array( 'category', 'author', 'date', 'comments' ) ) ); ?>
								</div>

								<div class="cs-overlay-background">
									<?php
									the_post_thumbnail( 'csco-medium' );
									if ( 'archive' === $options['location'] || 'home' === $options['location'] ) {
										csco_get_video_background( $options['location'], null, 'default', true, false );
									}
									csco_the_post_format_icon();
									?>
								</div>

								<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
							</div>
						<?php } ?>

						<div class="cs-entry__inner cs-entry__content">
							<div class="cs-entry__info">
								<?php
								the_title( '<h2 class="cs-entry__title cs-entry__title-line"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

								if ( get_theme_mod( 'featured_archive_excerpt', true ) ) {
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
							<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments' ), true, get_theme_mod( 'featured_archive_post_meta', array( 'category', 'author', 'date', 'comments' ) ) ); ?>
						</div>
					</div>
				</article>
				<?php

			}
		}
		wp_reset_postdata();
		?>
	</div>
</section>
