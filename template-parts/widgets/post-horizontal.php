<?php
/**
 * The template for displaying the widget post horizontal.
 *
 * @package Flux
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$widget_title = get_theme_mod( 'theme_widget_post_horizontal_title' );

$query_args = array(
	'filter_posts'      => get_theme_mod( 'theme_widget_post_horizontal_filter_posts' ),
	'filter_categories' => get_theme_mod( 'theme_widget_post_horizontal_filter_categories' ),
	'filter_tags'       => get_theme_mod( 'theme_widget_post_horizontal_filter_tags' ),
	'filter_offset'     => get_theme_mod( 'theme_widget_post_horizontal_filter_offset', 0 ),
	'orderby'           => get_theme_mod( 'theme_widget_post_horizontal_sort_orderby', 'date' ),
	'time_frame'        => get_theme_mod( 'theme_widget_post_horizontal_time_frame' ),
	'order'             => get_theme_mod( 'theme_widget_post_horizontal_sort_order', 'DESC' ),
	'number_items'      => get_theme_mod( 'theme_widget_post_horizontal_number_items', 3 ),
);

$query = new WP_Query( csco_build_custom_query_args( $query_args, get_theme_mod( 'theme_widget_post_horizontal_avoid_duplicates', false ) ) );

?>

<div class="widget cs-widget cs-widget-post-horizontal">

	<?php if ( $widget_title ) { ?>
		<h2 class="cs-widget__heading"><?php echo esc_html( $widget_title ); ?></h2>
	<?php } ?>

	<div class="cs-widget__content">
		<div class="cs-widget-post-horizontal__wrapper">
			<?php
			$counter = 1;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$csco_avoid_duplicate_post_ids[] = get_the_ID();
					?>
					<article <?php post_class(); ?>>
						<div class="cs-entry__outer">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-square">

									<div class="cs-entry__meta cs-entry__meta-overlay">
										<?php csco_get_post_meta( array( 'category' ), true, get_theme_mod( 'theme_widget_post_horizontal_meta', array() ) ); ?>
									</div>

									<div class="cs-overlay-background">
										<?php the_post_thumbnail( 'csco-small', array( 'loading' => get_theme_mod( 'theme_widget_post_horizontal_lazyload', 'lazy' ) ) ); ?>
									</div>

									<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
								</div>
							<?php } ?>

							<div class="cs-entry__inner cs-entry__content">
								<div class="cs-entry__info">
									<?php if ( get_theme_mod( 'theme_widget_post_horizontal_numbers', true ) ) { ?>
										<span class="cs-entry__number">
											<?php echo esc_html( $counter ); ?>
										</span>
									<?php } ?>

									<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
								</div>
								<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, get_theme_mod( 'theme_widget_post_horizontal_meta', array() ) ); ?>
							</div>
						</div>
					</article>

					<?php
					++$counter;
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>

</div>
