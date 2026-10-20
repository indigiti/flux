<?php
/**
 * The template part for displaying site section.
 *
 * @package Flux
 */

$search_heading = get_theme_mod( 'header_search_heading', esc_html__( 'What Are You Looking For?', 'flux' ) );
?>

<div class="cs-search">
	<div class="cs-container">
		<div class="cs-search__inner">
			<div class="cs-search__form-container">
				<?php if ( $search_heading ) { ?>
					<div class="cs-search__form-header">
						<?php echo wp_kses( $search_heading, 'content' ); ?>
					</div>
				<?php } ?>
				<?php get_template_part( 'searchform' ); ?>
				<?php csco_component( 'search_categories' ); ?>
			</div>
			<?php csco_component( 'header_search_post' ); ?>
		</div>
	</div>
</div>
