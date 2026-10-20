<?php
/**
 * Theme Widgets
 *
 * @package Flux
 */

CSCO_Customizer::add_panel(
	'theme_widgets',
	array(
		'title' => esc_html__( 'Theme Widgets', 'flux' ),
	)
);

do_action( 'csco_custom_widgets_mods' );

require_once get_theme_file_path( '/inc/theme-mods/widgets/about.php' );
require_once get_theme_file_path( '/inc/theme-mods/widgets/follow.php' );
require_once get_theme_file_path( '/inc/theme-mods/widgets/post-slider.php' );
require_once get_theme_file_path( '/inc/theme-mods/widgets/post-overlay.php' );
require_once get_theme_file_path( '/inc/theme-mods/widgets/post-horizontal.php' );
require_once get_theme_file_path( '/inc/theme-mods/widgets/banner.php' );
