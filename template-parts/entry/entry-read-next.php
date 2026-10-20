<?php
/**
 * The template part for displaying post read next section.
 *
 * @package Flux
 */

$options = array(
	'image_orientation' => get_theme_mod( 'post_read_next_image_orientation', 'landscape-16-9' ),
	'image_size'        => get_theme_mod( 'post_read_next_image_size', 'csco-thumbnail' ),
);

$read_next_post_heading = get_theme_mod( 'post_read_next_heading', esc_html__( 'You may be interested', 'flux' ) );
$post_read_next_loop    = get_theme_mod( 'post_read_next_loop', true );
$read_next_posts        = get_theme_mod( 'post_read_next_posts', 'after' );
$read_next_post_meta    = get_theme_mod( 'post_read_next_meta', array( 'category', 'author', 'date', 'comments' ) );
$read_next_layout       = get_theme_mod( 'read_next_layout', 'grid' );
$post_read_next_excerpt = get_theme_mod( 'read_next_excerpt', false );
$limit                  = get_theme_mod( 'post_read_next_number', 4 );


$read_next_post_ids = csco_get_read_next_post_ids( $limit, $read_next_posts );

if ( ! empty( $read_next_post_ids ) ) {
	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => $limit,
		'post__in'            => $read_next_post_ids,
		'orderby'             => 'post__in',
		'ignore_sticky_posts' => true,
	);

	$next_posts_query = new WP_Query( $args );

	if ( $next_posts_query->have_posts() ) {
		?>
		<section class="cs-read-next">
			<?php if ( $read_next_post_heading ) { ?>
			<div class="cs-read-next__headline">
				<div class="cs-read-next__headline-container">
					<?php if ( $read_next_post_heading ) { ?>
						<h2 class="cs-read-next__heading">
							<?php echo do_shortcode( $read_next_post_heading ); ?>
						</h2>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<div class="cs-posts-area__read-next cs-posts-area__grid cs-posts-area__main cs-read-next__grid">
				<?php
				while ( $next_posts_query->have_posts() ) {
					$next_posts_query->the_post();
					?>
					<article <?php post_class(); ?>>

						<div class="cs-entry__outer">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-<?php echo esc_attr( $options['image_orientation'] ); ?>">

									<div class="cs-entry__meta cs-entry__meta-overlay">
										<?php csco_get_post_meta( array( 'category' ), true, $read_next_post_meta ); ?>
									</div>

									<div class="cs-overlay-background">
										<?php the_post_thumbnail( $options['image_size'] ); ?>
										<?php csco_the_post_format_icon(); ?>
									</div>

									<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
								</div>
							<?php } ?>

							<div class="cs-entry__inner cs-entry__content">
								<div class="cs-entry__info">
									<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
									<?php
									if ( $post_read_next_excerpt ) {
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
								<?php csco_get_post_meta( array( 'reading_time', 'author', 'date', 'comments', 'views' ), true, $read_next_post_meta ); ?>
							</div>
						</div>
					</article>
					<?php
				}
				?>
			</div>
		</section>

		<?php
	}
	wp_reset_postdata();
}
