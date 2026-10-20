<?php
/**
 * Editor Settings.
 *
 * @package Flux
 */

/**
 * Enqueue editor scripts
 */
function csco_block_editor_scripts() {
	wp_enqueue_script(
		'cs-editor-scripts',
		get_template_directory_uri() . '/assets/jsx/editor-scripts.js',
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_scripts' );

/**
 * Adds classes to <div class="editor-styles-wrapper"> tag
 */
function csco_block_editor_wrapper() {

	$script_handle = 'cs-editor-wrapper';
	$script_file   = 'editor-wrapper.js';

	if ( 'enqueue_block_assets' === current_filter() ) {
		if ( ! ( is_admin() && ! is_customize_preview() ) ) {
			return;
		}

		$script_handle = 'cs-editor-iframe';
		$script_file   = 'editor-iframe.js';
	}

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	// Set post type.
	$post_type = sprintf( 'post-type-%s', get_post_type( $post_id ) );

	// Set page layout.
	$default_layout = csco_get_page_sidebar( $post_id, 'default' );
	$page_layout    = csco_get_page_sidebar( $post_id, false );

	if ( 'disabled' === $default_layout ) {
		$default_layout = 'cs-sidebar-disabled';
	} else {
		$default_layout = 'cs-sidebar-enabled';
	}

	if ( 'disabled' === $page_layout ) {
		$page_layout = 'cs-sidebar-disabled';
	} else {
		$page_layout = 'cs-sidebar-enabled';
	}

	// Post Metabar.
	if ( true === get_theme_mod( 'post_metabar', false ) ) {
		$post_sidebar = 'cs-metabar-enabled';
	} else {
		$post_sidebar = 'cs-metabar-disabled';
	}

	// Set breakpoints.
	$breakpoints = array(
		'cs-breakpoint-up-576px'  => 576,
		'cs-breakpoint-up-768px'  => 768,
		'cs-breakpoint-up-992px'  => 992,
		'cs-breakpoint-up-1200px' => 1288,
	);

	wp_enqueue_script(
		$script_handle,
		get_template_directory_uri() . '/assets/jsx/' . $script_file,
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);

	wp_localize_script(
		$script_handle,
		'cscoGWrapper',
		array(
			'post_type'      => $post_type,
			'default_layout' => $default_layout,
			'page_layout'    => $page_layout,
			'post_sidebar'   => $post_sidebar,
			'breakpoints'    => $breakpoints,
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_wrapper' );
add_action( 'enqueue_block_assets', 'csco_block_editor_wrapper' );

/**
 * Change editor color palette.
 */
function csco_change_editor_color_palette() {
	// Editor Color Palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Primary', 'flux' ),
				'slug'  => 'primary',
				'color' => get_theme_mod( 'color_primary', '#000000' ),
			),
			array(
				'name'  => esc_html__( 'Secondary', 'flux' ),
				'slug'  => 'secondary',
				'color' => get_theme_mod( 'color_secondary', '#6A6A6A' ),
			),
			array(
				'name'  => esc_html__( 'Layout', 'flux' ),
				'slug'  => 'layout',
				'color' => get_theme_mod( 'color_layout_background', '#F4F4F4' ),
			),
			array(
				'name'  => esc_html__( 'Accent', 'flux' ),
				'slug'  => 'accent',
				'color' => get_theme_mod( 'color_accent', '#06845A' ),
			),
			array(
				'name'  => esc_html__( 'Border', 'flux' ),
				'slug'  => 'border',
				'color' => get_theme_mod( 'color_border', '#E0E0E0' ),
			),
			array(
				'name'  => esc_html__( 'White', 'flux' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
		)
	);
}
add_action( 'after_setup_theme', 'csco_change_editor_color_palette' );
