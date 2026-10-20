<?php
/**
 * The template for displaying search form.
 *
 * @package Flux
 */

$placeholder = get_theme_mod( 'header_search_placeholder', esc_html__( 'Search...', 'flux' ) );
?>

<form role="search" method="get" class="cs-search__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="cs-form-group cs-search__form-group">
		<input required class="cs-search__input" type="search" value="<?php the_search_query(); ?>" name="s" placeholder="<?php echo esc_attr( $placeholder ); ?>" role="searchbox">
        <i class="cs-icon cs-icon-search"></i>
		<button class="cs-button cs-button-large cs-button-animated cs-search__submit" aria-label="<?php echo esc_attr( esc_html__( 'Search', 'flux' ) ); ?>" type="submit">
			<span>
				<span><?php echo esc_html__( 'Search', 'flux' ); ?></span>
				<span><?php echo esc_html__( 'Search', 'flux' ); ?></span>
			</span>
		</button>
	</div>
</form>
