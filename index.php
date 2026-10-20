<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flux
 */

get_header(); ?>

<div id="primary" class="cs-content-area">

	<?php
	/**
	 * The csco_main_before hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_main_before' );
	?>

	<?php
	if ( have_posts() ) {
		// Set options.
		$args = csco_get_archive_options();

		// Location.
		$main_classes = ' cs-posts-area__' . $args['location'];

		// Layout.
		$main_classes .= ' cs-posts-area__' . $args['layout'];

		if ( 'grid' === $args['layout'] || 'full' === $args['layout'] ) {
			$location = 'archive';

			if ( 'home' === $args['location'] ) {
				$location = 'home';
			}

			if ( 'grid' === $args['layout'] ) {
				$columns_dk = get_theme_mod( $location . '_columns_desktop', 2 );
				$columns_lp = get_theme_mod( $location . '_columns_laptop', 2 );
				$columns_tb = get_theme_mod( $location . '_columns_tablet', 2 );
				$columns_mb = get_theme_mod( $location . '_columns_mobile', 1 );
			}
		}

		if ( get_theme_mod( $args['location'] . '_borders', true ) ) {
			$main_classes .= ' borders-enabled';
		}

		// Featured Archive.
		$featured_archive        = false;
		$featured_archive_global = get_theme_mod( 'featured_archive', 'disabled' );
		$category_id             = get_queried_object_id();
		$featured_archive_local  = get_term_meta( $category_id, 'csco_featured_category', 'default' );


		if ( 'enabled' === $featured_archive_local || ( 'enabled' === $featured_archive_global && 'disabled' !== $featured_archive_local ) ) {
			$featured_archive = true;
		}

		// Archives Banner.
		if ( 'archive' === $args['location'] ) {
			$archive_columns_desktop = (int) get_theme_mod( 'archive_columns_desktop', 2 );
		}

		$home_heading = get_theme_mod( 'home_heading', esc_html__( 'Latest Posts', 'flux' ) );

		?>

		<div class="cs-posts-area cs-posts-area-posts">
			<div class="cs-posts-area__outer">

				<?php if ( is_front_page() && $home_heading ) { ?>
					<div class="cs-posts-area__header">
						<?php echo do_shortcode( $home_heading ); ?>
					</div>
				<?php } ?>

				<?php if ( is_author() ) { ?>
					<div class="cs-posts-area__header">
						<?php echo esc_html__( 'Author posts', 'flux' ); ?>
					</div>
				<?php } ?>

				<div
				class="cs-posts-area__main cs-archive-<?php echo esc_attr( $args['layout'] ); ?> <?php echo esc_attr( $main_classes ); ?>"
				<?php if ( 'grid' === $args['layout'] ) { ?>
					data-pc="<?php echo esc_attr( $columns_dk ); ?>"
					data-lp="<?php echo esc_attr( $columns_lp ); ?>"
					data-tb="<?php echo esc_attr( $columns_tb ); ?>"
					data-mb="<?php echo esc_attr( $columns_mb ); ?>"
				<?php } ?>
				>
					<?php
					$counter = 1;
					// Start the Loop.
					while ( have_posts() ) {
						the_post();

						$args['current_post_id'] = get_the_ID();

						if ( 'full' === $args['layout'] ) {
							get_template_part( 'template-parts/post-area/post', 'full', $args );
						} else {
							get_template_part( 'template-parts/post-area/post', 'entry', $args );
						}

						++$counter;
					}
					?>
				</div>
			</div>

			<?php
			/* Posts Pagination */
			if ( 'standard' === get_theme_mod( csco_get_archive_option( 'pagination_type' ), 'load-more' ) ) {
				?>
				<div class="cs-posts-area__pagination">
					<?php
						the_posts_pagination(
							array(
								'prev_text' => __( 'Prev', 'flux' ),
								'next_text' => __( 'Next', 'flux' ),
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} elseif ( ! get_query_var( 'csco_have_search' ) ) {
		?>
		<div class="entry-content cs-content-not-found">
			<?php if ( is_search() ) { ?>
				<div class="cs-content-not-found-content">
					<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M25.8333 8.33333C22.6117 8.33333 20 10.945 20 14.1667C20 17.3883 22.6117 20 25.8333 20C29.055 20 31.6667 17.3883 31.6667 14.1667C31.6667 10.945 29.055 8.33333 25.8333 8.33333ZM16.6667 14.1667C16.6667 9.10405 20.7707 5 25.8333 5C30.896 5 35 9.10405 35 14.1667C35 16.0958 34.404 17.8858 33.3862 19.3625L37.8452 23.8215L35.4882 26.1785L31.0292 21.7195C29.5525 22.7373 27.7625 23.3333 25.8333 23.3333C20.7707 23.3333 16.6667 19.2293 16.6667 14.1667ZM5 6.66667H13.3333V10H5V6.66667ZM5 18.3333H13.3333V21.6667H5V18.3333ZM35 30V33.3333H5V30H35Z" fill="#6A6A6A"/>
					</svg>
					<p><?php echo esc_html__( 'It seems we cannot find what you are looking for.', 'flux' ); ?></p>
					<p><?php echo esc_html__( 'Please check the spelling or rephrase.', 'flux' ); ?></p>
				</div>
			<?php } elseif ( is_404() ) { ?>
				<div class="cs-content-not-found-content">
					<?php echo esc_html__( "Oops! The page you're looking for couldn't be found. It may have been moved, renamed, or no longer exists. Try searching to find what you're looking for.", 'flux' ); ?>
				</div>
				<?php get_template_part( 'searchform' ); ?>
			<?php } ?>
		</div>
		<?php
	}
	?>

	<?php
	/**
	 * The csco_main_after hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_main_after' );
	?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
