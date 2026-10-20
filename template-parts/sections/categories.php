<?php
/**
 * The template for displaying the categories.
 *
 * @package Flux
 */

$layout_type = get_theme_mod( 'home_category_layout', 'type-1' );
$heading     = get_theme_mod( 'home_category_heading', esc_html__( 'Trending Topics', 'flux' ) );
?>
	<section class="cs-home-categories <?php echo esc_attr( sprintf( ' cs-home-categories__%s', $layout_type ) ); ?>">
		<div class="cs-container">
			<div class="cs-home-categories__wrapper">
				<?php if ( $heading ) { ?>
					<div class="cs-home-categories__heading">
						<?php echo wp_kses( $heading, 'content' ); ?>
					</div>
				<?php } ?>
				<?php
				$taxonomy_slugs   = get_theme_mod( 'home_categories_filter_slugs' );
				$taxonomy_orderby = get_theme_mod( 'home_categories_sort_orderby', 'name' );
				$taxonomy_order   = get_theme_mod( 'home_categories_sort_order', 'ASC' );
				$taxonomy_limit   = get_theme_mod( 'home_categories_limit', 5 );

				$taxonomy_type = 'category';
				if ( 'type-1' !== $layout_type ) {
					$taxonomy_type = get_theme_mod( 'home_category_taxonomy_type', 'category' );
				}

				$args = array(
					'taxonomy'   => $taxonomy_type,
					'hide_empty' => true,
					'orderby'    => $taxonomy_orderby,
					'order'      => $taxonomy_order,
					'number'     => $taxonomy_limit,
				);

				$filter_slug = ! empty( $taxonomy_slugs ) ? explode( ',', $taxonomy_slugs ) : array();

				if ( ! empty( $filter_slug ) ) {
					$args['slug']   = $filter_slug;
					$args['number'] = 0;
				}

				$terms = get_terms( $args );

				if ( $terms ) {
					?>
					<div class="cs-home-categories__list">
						<div class="cs-home-categories__grid">
							<?php
							foreach ( $terms as $term_item ) {
								$csco_category_thumbnail_id = get_term_meta( $term_item->term_id, 'csco_category_thumbnail', true );
								?>
								<div class="cs-home-categories__item">
									<?php if ( $csco_category_thumbnail_id && 'type-1' === $layout_type ) { ?>
										<div class="cs-home-categories__thumbnail">
											<?php
											csco_get_retina_image(
												$csco_category_thumbnail_id,
												array(
													'alt' => esc_attr( $term_item->name ),
													'title' => esc_attr( $term_item->name ),
													'loading' => 'lazy',
												)
											);
											?>
											<a href="<?php echo esc_url( get_category_link( $term_item->term_id ) ); ?>" rel="category tag" class="cs-home-categories__link" title="<?php echo esc_attr( $term_item->name ); ?>"></a>
										</div>
									<?php } ?>
									<div class="cs-home-categories__title">
										<a href="<?php echo esc_url( get_category_link( $term_item->term_id ) ); ?>" rel="category tag" class="cs-home-categories__link">
											<?php echo esc_attr( $term_item->name ); ?>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
