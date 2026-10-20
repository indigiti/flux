<?php
/**
 * The template for displaying the hero
 *
 * @package Flux
 */

global $csco_avoid_duplicate_post_ids;

if ( ! $csco_avoid_duplicate_post_ids ) {
	$csco_avoid_duplicate_post_ids = array();
}

$query_args = array(
	'filter_posts'      => get_theme_mod( 'home_hero_filter_posts' ),
	'filter_categories' => get_theme_mod( 'home_hero_filter_categories' ),
	'filter_tags'       => get_theme_mod( 'home_hero_filter_tags' ),
	'number_items'      => 1,
);

$query = new WP_Query( csco_build_custom_query_args( $query_args, get_theme_mod( 'home_hero_avoid_duplicates', false ) ) );
?>

<section class="cs-home-hero">
	<div class="cs-container">
		<?php
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$csco_avoid_duplicate_post_ids[] = get_the_ID();
				?>
				<article <?php post_class(); ?>>
					<div class="cs-entry__outer">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-landscape-21-9">

								<div class="cs-entry__meta cs-entry__meta-overlay">
									<?php csco_get_post_meta( array( 'category' ), true, get_theme_mod( 'home_hero_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ) ); ?>
								</div>

								<div class="cs-overlay-background">
									<?php
									the_post_thumbnail( 'csco-large', array( 'loading' => get_theme_mod( 'home_hero_image_lazyload', 'lazy' ) ) );
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

								if ( get_theme_mod( 'home_hero_excerpt', false ) ) {
									$post_excerpt = csco_get_the_excerpt( 150 );
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
							<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, get_theme_mod( 'home_hero_meta', array( 'category', 'reading_time', 'author', 'date', 'comments' ) ), array( 'author_avatar' => true ) ); ?>
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
