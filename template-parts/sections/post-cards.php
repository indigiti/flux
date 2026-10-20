<?php
/**
 * The template for displaying the post cards layout
 *
 * @package Flux
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$post_heading = get_theme_mod( 'home_post_cards_heading', esc_html__( 'Latest Posts', 'flux' ) );

$main_classes = '';
if ( get_theme_mod( 'home_post_cards_borders', true ) ) {
	$main_classes .= ' borders-enabled';
}

$post_args = array(
	'meta'              => get_theme_mod( 'home_post_cards_meta', array( 'category', 'author', 'date', 'comments' ) ),
	'image_orientation' => get_theme_mod( 'home_post_cards_image_orientation', 'landscape-16-9' ),
	'image_size'        => get_theme_mod( 'home_post_cards_image_size', 'csco-thumbnail' ),
	'image_lazyload'    => get_theme_mod( 'home_post_cards_image_lazyload', 'lazy' ),
	'excerpt'           => get_theme_mod( 'home_post_cards_excerpt', false ),
);

$query_args = array(
	'filter_posts'      => get_theme_mod( 'home_post_cards_filter_posts' ),
	'filter_categories' => get_theme_mod( 'home_post_cards_filter_categories' ),
	'filter_tags'       => get_theme_mod( 'home_post_cards_filter_tags' ),
	'filter_offset'     => get_theme_mod( 'home_post_cards_filter_offset', 0 ),
	'orderby'           => get_theme_mod( 'home_post_cards_sort_orderby', 'date' ),
	'time_frame'        => get_theme_mod( 'home_post_cards_time_frame' ),
	'order'             => get_theme_mod( 'home_post_cards_sort_order', 'DESC' ),
	'number_items'      => get_theme_mod( 'home_post_cards_limit', 8 ),
);

$query = new WP_Query( csco_build_custom_query_args( $query_args, get_theme_mod( 'home_post_cards_avoid_duplicates', false ) ) );

?>

<section class="cs-home-post-cards">
	<div class="cs-container">
		<div class="cs-home-post-cards__wrapper">
			<?php if ( $post_heading ) { ?>
				<div class="cs-home-post-cards__heading">
					<?php echo wp_kses( $post_heading, 'content' ); ?>
				</div>
			<?php } ?>
			<div class="cs-home-post-cards__area cs-posts-area__grid cs-posts-area__main <?php echo esc_attr( $main_classes ); ?>"
				data-pc="<?php echo esc_attr( get_theme_mod( 'home_post_cards_columns_desktop', 2 ) ); ?>"
				data-lp="<?php echo esc_attr( get_theme_mod( 'home_post_cards_columns_laptop', 2 ) ); ?>"
				data-tb="<?php echo esc_attr( get_theme_mod( 'home_post_cards_columns_tablet', 2 ) ); ?>"
				data-mb="<?php echo esc_attr( get_theme_mod( 'home_post_cards_columns_mobile', 1 ) ); ?>">
				<?php
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();

						$csco_avoid_duplicate_post_ids[] = get_the_ID();

						get_template_part( 'template-parts/post-area/card', 'standard', $post_args );
					}
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
