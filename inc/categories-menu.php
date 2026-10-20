<?php
/**
 * Categories Menu.
 *
 * @package Flux
 */

?>

	<div class="sub-menu sub-menu-categories">
		<div class="cs-container">
			<div class="cs-featured-categories">
				<?php
				$taxonomy_slugs = get_query_var( 'featured_categories' );
				$args           = array(
					'taxonomy'   => 'category',
					'hide_empty' => true,
					'orderby'    => 'count',
					'order'      => 'DESC',
					'number'     => 5,
				);

				$filter_ids = ! empty( $taxonomy_slugs ) ? explode( ',', $taxonomy_slugs ) : array();

				if ( ! empty( $filter_ids ) ) {
					$args['include'] = $filter_ids;
					$args['orderby'] = 'include';
					$args['order']   = 'ASC';
					$args['number']  = 0;
				}

				$terms = get_terms( $args );

				if ( $terms ) {
					?>
					<div class="cs-featured-categories__grid">
						<?php
						foreach ( $terms as $term_item ) {
							$csco_category_thumbnail_id = get_term_meta( $term_item->term_id, 'csco_category_thumbnail', true );
							?>
							<div class="cs-featured-categories__item">
								<?php if ( $csco_category_thumbnail_id ) { ?>
									<div class="cs-featured-categories__item-thumbnail">
										<?php
										csco_get_retina_image(
											$csco_category_thumbnail_id,
											array(
												'alt'     => esc_attr( $term_item->name ),
												'title'   => esc_attr( $term_item->name ),
												'loading' => 'lazy',
											)
										);
										?>
										<a href="<?php echo esc_url( get_category_link( $term_item->term_id ) ); ?>" rel="category tag" class="cs-featured-categories__item-link"></a>
									</div>
								<?php } ?>
								<div class="cs-featured-categories__item-title">
									<a href="<?php echo esc_url( get_category_link( $term_item->term_id ) ); ?>" rel="category tag" class="cs-categories__item-link">
										<?php echo esc_attr( $term_item->name ); ?>
									</a>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
