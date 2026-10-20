<?php
/**
 * The template for displaying the post slider layout
 *
 * @package Flux
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$query_args = array(
	'filter_posts'      => get_theme_mod( 'home_slider_filter_posts' ),
	'filter_categories' => get_theme_mod( 'home_slider_filter_categories' ),
	'filter_tags'       => get_theme_mod( 'home_slider_filter_tags' ),
	'filter_offset'     => get_theme_mod( 'home_slider_filter_offset', 0 ),
	'orderby'           => get_theme_mod( 'home_slider_filter_sort_orderby', 'date' ),
	'time_frame'        => get_theme_mod( 'home_slider_time_frame' ),
	'order'             => get_theme_mod( 'home_slider_sort_order', 'DESC' ),
	'number_items'      => get_theme_mod( 'home_slider_number_items', 3 ),
);

$query = new WP_Query( csco_build_custom_query_args( $query_args, get_theme_mod( 'home_slider_avoid_duplicates', false ) ) );

?>

<section class="cs-home-slider">
	<div class="cs-container">
		<div
			class="cs-home-slider__slider"
			data-cs-autoplay="<?php echo esc_attr( 'yes' === get_theme_mod( 'home_slider_autoplay', 'yes' ) ? true : false ); ?>"
			data-cs-parallax="<?php echo esc_attr( 'yes' === get_theme_mod( 'home_slider_parallax', 'yes' ) ? true : false ); ?>"
			data-cs-autoplay-delay="<?php echo esc_attr( get_theme_mod( 'home_slider_delay', 5000 ) ); ?>"
		>
			<div class="cs-home-slider__wrapper">
				<?php
				$counter = 0;
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						++$counter;

						$csco_avoid_duplicate_post_ids[] = get_the_ID();
						?>
						<article <?php post_class( 'cs-entry__featured cs-home-slider__item' ); ?> data-scheme="inverse">
							<div class="cs-entry__outer cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-landscape-21-9">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="cs-entry__inner cs-entry__thumbnail">

										<div class="cs-entry__meta cs-entry__meta-overlay">
											<?php csco_get_post_meta( array( 'category' ), true, get_theme_mod( 'home_slider_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ) ); ?>
										</div>

										<div class="cs-overlay-background">
											<?php
											the_post_thumbnail( 'csco-large-uncropped', array( 'loading' => get_theme_mod( 'home_post_slider_image_lazyload', 'lazy' ) ) );
											csco_the_post_format_icon();
											?>
										</div>

										<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
									</div>
								<?php } ?>

								<div class="cs-entry__inner cs-entry__content cs-overlay-content">
									<div class="cs-entry__info">
										<?php
										the_title( '<h2 class="cs-entry__title cs-entry__title-line"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

										if ( get_theme_mod( 'home_slider_excerpt', false ) ) {
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
									<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, get_theme_mod( 'home_slider_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ), array( 'author_avatar' => true ) ); ?>
								</div>
							</div>
						</article>
						<?php
					}
				}
				wp_reset_postdata();
				?>
			</div>
			<?php if ( $counter > 1 ) { ?>
				<?php if ( $counter <= 5 ) { ?>
					<div class="cs-home-slider__pagination" data-scheme="inverse"></div>
				<?php } ?>
				<div class="cs-home-slider__button-prev"><span><span></span><span></span></span></div>
				<div class="cs-home-slider__button-next"><span><span></span><span></span></span></div>
			<?php } ?>
		</div>
	</div>
</section>
