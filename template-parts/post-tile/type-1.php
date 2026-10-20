<?php
/**
 * The template for displaying the tiles type 1 layout
 *
 * @package Flux
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$counter = 0;

$query_args = array(
	'filter_posts'      => get_theme_mod( 'home_post_tiles_filter_posts' ),
	'filter_categories' => get_theme_mod( 'home_post_tiles_filter_categories' ),
	'filter_tags'       => get_theme_mod( 'home_post_tiles_filter_tags' ),
	'filter_offset'     => get_theme_mod( 'home_post_tiles_filter_offset', 0 ),
	'orderby'           => get_theme_mod( 'home_post_tiles_sort_orderby', 'date' ),
	'time_frame'        => get_theme_mod( 'home_post_tiles_time_frame' ),
	'order'             => get_theme_mod( 'home_post_tiles_sort_order', 'DESC' ),
	'number_items'      => ( 'type-1' === get_theme_mod( 'home_tiles_layout', 'type-1' ) ) ? 5 : 3,
);

$query = new WP_Query( csco_build_custom_query_args( $query_args, get_theme_mod( 'home_post_tiles_avoid_duplicates', false ) ) );

?>

<section class="cs-home-post-tile cs-tile-type-1">
	<div class="cs-container">
		<div class="cs-tile-type-1__wrapper">
			<?php
			if ( $query->have_posts() ) {
				echo '<div class="cs-tile-type-1__featured">';
				while ( $query->have_posts() ) {
					$query->the_post();
					++$counter;

					$csco_avoid_duplicate_post_ids[] = get_the_ID();

					if ( 1 === $counter ) {
						?>
						<article <?php post_class( 'cs-entry__featured' ); ?>>
							<div class="cs-entry__outer">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-landscape-16-9">

										<div class="cs-entry__meta cs-entry__meta-overlay">
											<?php csco_get_post_meta( array( 'category' ), true, get_theme_mod( 'home_featured_tiles_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ) ); ?>
										</div>

										<div class="cs-overlay-background">
											<?php
											the_post_thumbnail( 'csco-medium', array( 'loading' => get_theme_mod( 'home_tiles_featured_image_lazyload', 'lazy' ) ) );
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

										if ( get_theme_mod( 'home_tiles_featured_excerpt', false ) ) {
											$home_featured_excerpt = csco_get_the_excerpt( 160 );
											if ( $home_featured_excerpt ) {
												?>
												<div class="cs-entry__excerpt">
													<?php echo esc_html( $home_featured_excerpt ); ?>
												</div>
												<?php
											}
										}
										?>
									</div>
									<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, get_theme_mod( 'home_featured_tiles_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ) ); ?>
								</div>
							</div>
						</article>
						<?php
						echo '</div><div class="cs-tile-type-1__grid cs-posts-area__main cs-posts-area__grid">';
					} else {
						?>
						<article <?php post_class( 'cs-entry__grid' ); ?>>
							<div class="cs-entry__outer">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-landscape-16-9">

										<div class="cs-entry__meta cs-entry__meta-overlay">
											<?php csco_get_post_meta( array( 'category' ), true, get_theme_mod( 'home_tiles_meta', array( 'category', 'author', 'date', 'comments' ) ) ); ?>
										</div>

										<div class="cs-overlay-background">
											<?php
											the_post_thumbnail( 'csco-thumbnail', array( 'loading' => get_theme_mod( 'home_tiles_image_lazyload', 'lazy' ) ) );
											csco_the_post_format_icon();
											?>
										</div>

										<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
									</div>
								<?php } ?>

								<div class="cs-entry__inner cs-entry__content">
									<div class="cs-entry__info">
										<?php
										the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

										if ( get_theme_mod( 'home_tiles_excerpt', false ) ) {
											$post_excerpt = csco_get_the_excerpt();
											if ( $post_excerpt ) {
												?>
												<div class="cs-entry__excerpt">
													<?php echo esc_html( $post_excerpt ); ?>
												</div>
												<?php
											}
										}
										?>
									</div>
									<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, get_theme_mod( 'home_tiles_meta', array( 'category', 'author', 'date', 'comments' ) ) ); ?>
								</div>
							</div>
						</article>
						<?php
					}
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
