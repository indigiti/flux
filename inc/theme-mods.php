<?php
/**
 * Theme mods
 *
 * @package Flux
 */

/**
 * Register Theme Mods
 */
function csco_register_theme_mods() {

	/**
	 * Site Identity.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/site-identity.php' );

	/**
	 * Theme Widgets.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/theme-widgets.php' );

	/**
	 * Colors.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/colors-settings.php' );

	/**
	 * Typography.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/typography-settings.php' );

	/**
	 * Header Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/header-settings.php' );

	/**
	 * Footer Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/footer-settings.php' );

	/**
	 * Homepage Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/homepage-settings.php' );

	/**
	 * Archive Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/archive-settings.php' );

	/**
	 * Posts Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/post-settings.php' );

	/**
	 * Pages Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/page-settings.php' );

	/**
	 * Author Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/author-settings.php' );

	/**
	 * Search Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/search-settings.php' );

	/**
	 * Miscellaneous Settings.
	 */
	require_once get_theme_file_path( '/inc/theme-mods/miscellaneous-settings.php' );
}
add_action( 'after_setup_theme', 'csco_register_theme_mods', 20 );
