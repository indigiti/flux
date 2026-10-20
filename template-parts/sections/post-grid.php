<?php
/**
 * The template for displaying the grid posts layout
 *
 * @package Flux
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$layout_type  = get_theme_mod( 'home_post_grid_layout', 'type-1' );
$post_heading = get_theme_mod( 'home_post_grid_heading', esc_html__( 'Most Popular', 'flux' ) );

$post_args = array(
	'meta'              => get_theme_mod( 'home_post_grid_meta', array( 'category', 'author', 'date', 'comments' ) ),
	'image_orientation' => get_theme_mod( 'home_post_grid_image_orientation', 'landscape-16-9' ),
	'image_size'        => get_theme_mod( 'home_post_grid_image_size', 'csco-thumbnail' ),
	'image_lazyload'    => get_theme_mod( 'home_post_grid_image_lazyload', 'lazy' ),
	'excerpt'           => get_theme_mod( 'home_post_grid_excerpt', false ),
);

$query_args = array(
	'filter_posts'      => get_theme_mod( 'home_post_grid_filter_posts' ),
	'filter_categories' => get_theme_mod( 'home_post_grid_filter_categories' ),
	'filter_tags'       => get_theme_mod( 'home_post_grid_filter_tags' ),
	'filter_offset'     => get_theme_mod( 'home_post_grid_filter_offset', 0 ),
	'orderby'           => get_theme_mod( 'home_post_grid_sort_orderby', 'date' ),
	'time_frame'        => get_theme_mod( 'home_post_grid_time_frame' ),
	'order'             => get_theme_mod( 'home_post_grid_sort_order', 'DESC' ),
	'number_items'      => ( 'type-3' === $layout_type ) ? 4 : 3,
);

$query = new WP_Query( csco_build_custom_query_args( $query_args, get_theme_mod( 'home_post_grid_avoid_duplicates', false ) ) );

?>
<section class="cs-home-post-grid <?php echo esc_attr( sprintf( 'cs-home-post-grid__%s', $layout_type ) ); ?>">
	<div class="cs-container">
		<div class="cs-home-post-grid__wrapper">
			<?php if ( $post_heading ) { ?>
				<div class="cs-home-post-grid__heading">
					<?php echo wp_kses( $post_heading, 'content' ); ?>
				</div>
			<?php } ?>
			<div class="cs-home-post-grid__area cs-posts-area__grid cs-posts-area__main">
				<?php
				$current = 1;
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();

						$args['current_post'] = $current;
						$args['layout_type']  = $layout_type;

						$csco_avoid_duplicate_post_ids[] = get_the_ID();

						if ( 'type-1' === $layout_type || 'type-3' === $layout_type ) {
							get_template_part( 'template-parts/post-area/card', 'standard', $post_args );
						} else {
							get_template_part( 'template-parts/post-area/card', 'overlay', $post_args );
						}

						++$current;
					}
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
