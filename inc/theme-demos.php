<?php
/**
 * Theme Demos
 *
 * @package Flux
 */

/**
 * Register Demos of Theme
 */
function csco_demos_list() {

	$plugins = array(
		array(
			'name'     => 'Regenerate Thumbnails',
			'slug'     => 'regenerate-thumbnails',
			'path'     => 'regenerate-thumbnails/regenerate-thumbnails.php',
			'required' => false,
			'desc'     => esc_html__( 'Regenerate the thumbnails for one or more of your image uploads. Useful when changing their sizes or your theme.', 'flux' ),
		),
		array(
			'name'     => 'Supercharger',
			'slug'     => 'supercharger',
			'path'     => 'supercharger/supercharger.php',
			'required' => false,
			'desc'     => esc_html__( 'AI-powered engagement toolkit: paragraph highlights, pull quotes, and semantic recommendations that increase reader engagement and time on site.', 'flux' ),
		),
		array(
			'name'     => 'Supercharger PRO',
			'slug'     => 'https://wpsupercharger.com/downloads/supercharger-pro.zip',
			'path'     => 'supercharger-pro/supercharger-pro.php',
			'required' => false,
			'desc'     => esc_html__( 'Unlocks all premium Supercharger features: extra AI modules, real-time interactive preview, dark-mode styling, and per-module analytics. Requires a Supercharger license.', 'flux' ),
		),
	);

	$demos = array(
		'extended-grid'     => array(
			'name'      => esc_html__( 'Extended Grid', 'flux' ),
			'preview'   => 'https://flux.codesupply.co/flux/',
			'thumbnail' => get_template_directory_uri() . '/import/extended-grid-thumbnail.webp',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/flux/extended-grid-customizer.dat',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'flux' ),
						'url'   => 'https://cloud.codesupply.co/import/flux/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'flux' ),
					),
				),
			),
		),
		'overlay'           => array(
			'name'      => esc_html__( 'Overlay', 'flux' ),
			'preview'   => 'https://flux.codesupply.co/flux/?homepage=2',
			'thumbnail' => get_template_directory_uri() . '/import/overlay-thumbnail.webp',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/flux/overlay-customizer.dat',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'flux' ),
						'url'   => 'https://cloud.codesupply.co/import/flux/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'flux' ),
					),
				),
			),
		),
		'overlapped'        => array(
			'name'      => esc_html__( 'Overlapped', 'flux' ),
			'preview'   => 'https://flux.codesupply.co/flux/?homepage=3',
			'thumbnail' => get_template_directory_uri() . '/import/overlapped-thumbnail.webp',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/flux/overlapped-customizer.dat',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'flux' ),
						'url'   => 'https://cloud.codesupply.co/import/flux/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'flux' ),
					),
				),
			),
		),
		'small-grid'        => array(
			'name'      => esc_html__( 'Small Grid', 'flux' ),
			'preview'   => 'https://flux.codesupply.co/flux/?homepage=4',
			'thumbnail' => get_template_directory_uri() . '/import/small-grid-thumbnail.webp',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/flux/small-grid-customizer.dat',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'flux' ),
						'url'   => 'https://cloud.codesupply.co/import/flux/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'flux' ),
					),
				),
			),
		),
		'three-column-grid' => array(
			'name'      => esc_html__( '3-Column Grid', 'flux' ),
			'preview'   => 'https://flux.codesupply.co/flux/?homepage=5',
			'thumbnail' => get_template_directory_uri() . '/import/three-column-grid-thumbnail.webp',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/flux/three-column-grid-customizer.dat',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'flux' ),
						'url'   => 'https://cloud.codesupply.co/import/flux/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'flux' ),
					),
				),
			),
		),
	);

	return $demos;
}
add_filter( 'csco_register_demos_list', 'csco_demos_list' );

/**
 * Import Homepage
 *
 * @param int   $post_id New post ID.
 * @param array $data    Raw data imported for the post.
 */
function csco_hook_import_homepage( $post_id, $data ) {
	if ( isset( $data['post_title'] ) && 'Homepage' === $data['post_title'] ) {
		// Set show_on_front.
		update_option( 'show_on_front', 'page' );

		// Set page_on_front.
		update_option( 'page_on_front', (int) $post_id );
	}
}
add_action( 'wxr_importer.db.post', 'csco_hook_import_homepage', 10, 2 );

/**
 * Set terms and import associated images for each category.
 *
 * This function loops through all categories, checks for associated images (logos and icons),
 * and imports and assigns them to the corresponding taxonomy meta fields.
 */
function csco_import_terms_images_for_categories() {

	$categories = get_terms( array(
		'taxonomy'   => 'category',
		'hide_empty' => false,
	) );

	$fields = array(
		'csco_category_thumbnail' => '_csco_category_thumbnail',
	);

	foreach ( $categories as $category ) {

		foreach ( $fields as $meta_key_id => $meta_key_url ) {

			$meta_val = get_term_meta( $category->term_id, $meta_key_url, true );

			if ( $meta_val && CSCO_Manager_Import::is_image_url( $meta_val ) ) {
				$data = CSCO_Manager_Import::import_custom_image( $meta_val );

				if ( ! is_wp_error( $data ) ) {
					update_term_meta( $category->term_id, $meta_key_id, $data->attachment_id );
					update_term_meta( $category->term_id, $meta_key_url, $data->url );
				}
			}
		}
	}
}

/**
 * Finish Import
 */
function csco_hook_finish_import() {

	/* Set menu locations. */
	$nav_menu_locations = array();

	$primary_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	if ( $primary_menu ) {
		$nav_menu_locations['primary'] = $primary_menu->term_id;
	}

	$mobile_menu = get_term_by( 'name', 'Mobile', 'nav_menu' );
	if ( $mobile_menu ) {
		$nav_menu_locations['mobile'] = $mobile_menu->term_id;
	}

	$burger_menu = get_term_by( 'name', 'Burger', 'nav_menu' );
	if ( $burger_menu ) {
		$nav_menu_locations['burger'] = $burger_menu->term_id;
	}

	$footer_columns_menu = get_term_by( 'name', 'Footer Columns', 'nav_menu' );
	if ( $footer_columns_menu ) {
		$nav_menu_locations['footer_columns'] = $footer_columns_menu->term_id;
	}

	$additional_menu = get_term_by( 'name', 'Additional', 'nav_menu' );
	if ( $additional_menu ) {
		$nav_menu_locations['additional_menu'] = $additional_menu->term_id;
	}

	if ( $nav_menu_locations ) {
		set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
	}

	// Call the function directly wherever needed.
	if ( ! get_option( 'once_finished_import' ) ) {
		csco_import_terms_images_for_categories();
	}

	/* Add items to main menu */
	update_option( 'once_finished_import', true );
}
add_action( 'csco_finish_import', 'csco_hook_finish_import' );
