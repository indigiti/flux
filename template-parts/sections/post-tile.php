<?php
/**
 * The template for displaying the post tile.
 *
 * @package Flux
 */

switch ( get_theme_mod( 'home_tiles_layout', 'type-1' ) ) {
	case 'type-1':
		get_template_part( 'template-parts/post-tile/type-1' );
		break;
	case 'type-2':
		get_template_part( 'template-parts/post-tile/type-2' );
		break;
	case 'type-3':
		get_template_part( 'template-parts/post-tile/type-3' );
		break;
}
