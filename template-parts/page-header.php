<?php
/**
 * The template part for displaying page header.
 *
 * @package Flux
 */

// Init clasfor header.
$class = null;

// If description exists.
if ( get_the_archive_description() ) {
	$class = 'cs-page__header-has-description';
}
?>

<?php
do_action( 'csco_page_header_before' );

if ( is_author() ) {
	$subtitle  = esc_html__( 'All Posts By', 'flux' );
	$author_id = get_queried_object_id();
	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<div class="cs-page__author">
			<div class="cs-page__author-photo">
				<div class="cs-page__author-thumbnail">
					<?php echo get_avatar( $author_id, 120 ); ?>
				</div>
			</div>

			<div class="cs-page__author-info">
				<div class="cs-page__author-name">
					<div class="cs-page__author-heading">
						<?php echo esc_html__( 'About Author', 'flux' ); ?>
					</div>
					<?php the_archive_title( '<h1 class="cs-page__title">', '</h1>' ); ?>
				</div>
				<?php csco_archive_post_description(); ?>
			</div>

			<?php csco_user_social_links(); ?>
		</div>

	</div>
	<?php
} elseif ( is_archive() ) {

	$featured_archive_global = get_theme_mod( 'featured_archive', 'disabled' );
	$category_id             = get_queried_object_id();
	$featured_archive_local  = get_term_meta( $category_id, 'csco_featured_category', 'default' );

	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<?php
		the_archive_title( '<h1 class="cs-page__title">', '</h1>' );
		csco_archive_post_description();
		?>
	</div>
	<?php

} elseif ( is_search() ) {
	?>
		<div class="cs-page__search-top">
			<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
				<h1 class="cs-page__title"><span><?php echo esc_html__( 'Search Results:', 'flux' ); ?> <?php echo get_search_query(); ?></span></h1>
			</div>
			<?php get_template_part( 'searchform' ); ?>
			<?php
			if ( get_theme_mod( 'search_tags_display', true ) ) {
				csco_component( 'search_tags' );
			}
			?>
			<?php csco_component( 'archive_post_count' ); ?>
		</div>
<?php } elseif ( is_404() ) { ?>
		<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
			<svg width="136" height="57" viewBox="0 0 136 57" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path opacity="0.3" d="M25.04 56V44H0.32V35.12C2.4 31.8133 4.34667 28.32 6.16 24.64C7.97333 20.96 9.65333 17.0667 11.2 12.96C12.8 8.85333 14.1333 4.58667 15.2 0.159999H26.64C26.0533 2.72 25.2267 5.41333 24.16 8.24C23.1467 11.0667 21.9733 13.8667 20.64 16.64C19.3067 19.4133 17.9467 22.0267 16.56 24.48C15.2267 26.88 13.9467 29.0133 12.72 30.88C11.4933 32.7467 10.4533 34.16 9.6 35.12H25.04V21.84C25.5733 20.8267 26.1067 19.7333 26.64 18.56C27.2267 17.3333 27.7867 16.1067 28.32 14.88C28.8533 13.6 29.3333 12.3467 29.76 11.12C30.24 9.89333 30.6133 8.74666 30.88 7.68H36V35.12H43.04V44H36V56H25.04ZM67.9744 56.96C64.6677 56.96 61.761 56.48 59.2544 55.52C56.7477 54.5067 54.641 52.9067 52.9344 50.72C51.281 48.48 50.0277 45.5467 49.1744 41.92C48.3744 38.2933 47.9744 33.84 47.9744 28.56C47.9744 23.2267 48.3744 18.7733 49.1744 15.2C50.0277 11.5733 51.281 8.64 52.9344 6.4C54.641 4.16 56.7477 2.56 59.2544 1.6C61.761 0.639999 64.6677 0.159999 67.9744 0.159999C71.3344 0.159999 74.241 0.639999 76.6944 1.6C79.1477 2.56 81.201 4.16 82.8544 6.4C84.561 8.64 85.8144 11.5733 86.6144 15.2C87.4677 18.7733 87.8944 23.2267 87.8944 28.56C87.8944 33.84 87.4677 38.2933 86.6144 41.92C85.8144 45.5467 84.561 48.48 82.8544 50.72C81.201 52.9067 79.1477 54.5067 76.6944 55.52C74.241 56.48 71.3344 56.96 67.9744 56.96ZM67.9744 48.32C70.321 48.32 72.1077 47.7067 73.3344 46.48C74.561 45.2 75.4144 43.28 75.8944 40.72C76.3744 38.16 76.6144 34.96 76.6144 31.12V26.16C76.6144 22.2667 76.3744 19.04 75.8944 16.48C75.4144 13.8667 74.561 11.92 73.3344 10.64C72.1077 9.36 70.321 8.72 67.9744 8.72C65.6277 8.72 63.8144 9.36 62.5344 10.64C61.3077 11.92 60.4544 13.84 59.9744 16.4C59.4944 18.9067 59.2544 22.1067 59.2544 26V30.96C59.2544 34.8533 59.4944 38.1067 59.9744 40.72C60.4544 43.28 61.3077 45.2 62.5344 46.48C63.8144 47.7067 65.6277 48.32 67.9744 48.32ZM117.153 56V44H92.4325V35.12C94.5125 31.8133 96.4592 28.32 98.2725 24.64C100.086 20.96 101.766 17.0667 103.313 12.96C104.913 8.85333 106.246 4.58667 107.313 0.159999H118.753C118.166 2.72 117.339 5.41333 116.273 8.24C115.259 11.0667 114.086 13.8667 112.753 16.64C111.419 19.4133 110.059 22.0267 108.673 24.48C107.339 26.88 106.059 29.0133 104.833 30.88C103.606 32.7467 102.566 34.16 101.713 35.12H117.153V21.84C117.686 20.8267 118.219 19.7333 118.753 18.56C119.339 17.3333 119.899 16.1067 120.433 14.88C120.966 13.6 121.446 12.3467 121.873 11.12C122.353 9.89333 122.726 8.74666 122.993 7.68H128.113V35.12H135.153V44H128.113V56H117.153Z" fill="black"/>
			</svg>
			<h1 class="cs-page__title"><?php echo esc_html__( 'Oops! We Lost This Page', 'flux' ); ?></h1>
		</div>
		<?php
}

	do_action( 'csco_page_header_after' );
