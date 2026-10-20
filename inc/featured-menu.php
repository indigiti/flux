<?php
/**
 * Featured Menu.
 *
 * @package Flux
 */

$category_id = get_query_var( 'category_id' );
?>

<div class="sub-menu sub-menu-featured">
	<div class="cs-container">
		<div class="cs-fm__content">
			<?php
			$category = get_category( $category_id );

			if ( $category && ! is_wp_error( $category ) ) {

				// Latest posts.
				$args = array(
					'ignore_sticky_posts' => true,
					'post_type'           => 'post',
					'posts_per_page'      => 4,
					'category__in'        => array( $category_id ),
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() && isset( $query->posts ) ) {
					?>
					<div class="cs-fm__content-latest">
						<div class="cs-fm__content-posts cs-posts-area__grid cs-posts-area__main">
							<?php
							$current = 1;
							while ( $query->have_posts() ) {
								$query->the_post();

								get_template_part(
									'template-parts/post-area/card',
									'featured-menu',
									array(
										'image_orientation' => get_theme_mod( 'featured_menu_image_orientation', 'landscape-16-9' ),
										'image_size'     => get_theme_mod( 'featured_menu_image_size', 'csco-thumbnail' ),
										'image_lazyload' => 'lazy',
										'meta'           => get_theme_mod( 'featured_menu_post_meta', array( 'category', 'author', 'date', 'comments' ) ),
										'excerpt'        => get_theme_mod( 'featured_menu_excerpt', false ),
										'location'       => 'header_search',
										'current_post'   => $current,
										'entry_class'    => 'featured-menu-item',
									)
								);

								++$current;
							}
							?>
						</div>
					</div>
					<?php
					wp_reset_postdata();
				}
			}
			?>
		</div>
	</div>
</div>
<?php
