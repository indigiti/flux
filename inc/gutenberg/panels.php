<?php
/**
 * Adding New Panels.
 *
 * @package Flux
 */

/**
 * Register meta fields for gutenberg panels
 */
function csco_gutenberg_panels_register_meta() {

	$post_types = array( 'post', 'page' );

	// Loop Post Types.
	foreach ( $post_types as $post_type ) {

		/**
		 * ==================================
		 * Layout Options
		 * ==================================
		 */

		register_post_meta(
			$post_type,
			'csco_singular_sidebar',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_page_header_type',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_page_load_nextpost',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * ==================================
		 * Video Background
		 * ==================================
		 */

		register_post_meta(
			$post_type,
			'csco_post_video_location',
			array(
				'show_in_rest'  => array(
					'schema' => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'string',
						),
					),
				),
				'type'          => 'array',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_post_video_location_hash',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_post_video_url',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_post_video_bg_start_time',
			array(
				'show_in_rest'  => true,
				'type'          => 'number',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_post_video_bg_end_time',
			array(
				'show_in_rest'  => true,
				'type'          => 'number',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_post_video_bg_volume',
			array(
				'show_in_rest'  => true,
				'type'          => 'boolean',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

	}
}
add_action( 'init', 'csco_gutenberg_panels_register_meta' );

/**
 * Filters whether a meta key is considered protected.
 *
 * @param bool   $protected Whether the key is considered protected.
 * @param string $meta_key  Metadata key.
 * @param string $meta_type Type of object metadata is for.
 */
function csco_is_protected_meta( $protected, $meta_key, $meta_type ) {
	$hide_meta_keys = array(
		'csco_singular_sidebar',
		'csco_page_header_type',
		'csco_page_load_nextpost',
		'csco_post_video_location',
		'csco_post_video_location_hash',
		'csco_post_video_url',
		'csco_post_video_bg_start_time',
		'csco_post_video_bg_end_time',
		'csco_post_video_bg_volume',
	);

	if ( in_array( $meta_key, $hide_meta_keys, true ) ) {
		$protected = true;
	}

	return $protected;
}
add_filter( 'is_protected_meta', 'csco_is_protected_meta', 10, 3 );

/**
 * Enqueue assets  for gutenberg panels
 */
function csco_gutenberg_panels_assets() {

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	$post = get_post( $post_id );

	$page_static = array();

	// Add pages static.
	$page_static[] = get_option( 'page_on_front' );
	$page_static[] = get_option( 'page_for_posts' );

	// Set options.
	$singular_sidebar = array(
		array(
			'value' => 'default',
			'label' => esc_html__( 'Default', 'flux' ),
		),
		array(
			'value' => 'right',
			'label' => esc_html__( 'Right Sidebar', 'flux' ),
		),
		array(
			'value' => 'left',
			'label' => esc_html__( 'Left Sidebar', 'flux' ),
		),
		array(
			'value' => 'disabled',
			'label' => esc_html__( 'No Sidebar', 'flux' ),
		),
	);

	$page_header_type   = array();
	$page_load_nextpost = array();

	if ( 'post' === $post->post_type || 'page' === $post->post_type ) {
		$page_header_type = array(
			array(
				'value' => 'default',
				'label' => esc_html__( 'Default', 'flux' ),
			),
			array(
				'value' => 'standard',
				'label' => esc_html__( 'Standard', 'flux' ),
			),
			array(
				'value' => 'featured',
				'label' => esc_html__( 'Featured', 'flux' ),
			),
			array(
				'value' => 'featured_overlap',
				'label' => esc_html__( 'Featured Overlap', 'flux' ),
			),
			array(
				'value' => 'overlay',
				'label' => esc_html__( 'Overlay', 'flux' ),
			),
			array(
				'value' => 'title',
				'label' => esc_html__( 'Page Title Only', 'flux' ),
			),
			array(
				'value' => 'none',
				'label' => esc_html__( 'None', 'flux' ),
			),
		);

		if ( 'post' === $post->post_type ) {
			$page_load_nextpost = array(
				array(
					'value' => 'default',
					'label' => esc_html__( 'Default', 'flux' ),
				),
				array(
					'value' => 'enabled',
					'label' => esc_html__( 'Enabled', 'flux' ),
				),
				array(
					'value' => 'disabled',
					'label' => esc_html__( 'Disabled', 'flux' ),
				),
			);
		}
	}

	// Set video location list.
	$video_location_list = array(
		array(
			'value' => 'overlay-header',
			'label' => esc_html__( 'Overlay Header', 'flux' ),
		),
	);

	if ( 'post' === $post->post_type ) {
		array_push(
			$video_location_list,
			array(
				'value' => 'archive',
				'label' => esc_html__( 'Post Archives', 'flux' ),
			)
		);
	}

	$panels_data = array(
		'postType'          => $post->post_type,
		'singularSidebar'   => $singular_sidebar,
		'pageHeaderType'    => $page_header_type,
		'videoLocationList' => apply_filters( 'csco_editor_video_location_list', $video_location_list ),
		'pageLoadNextpost'  => apply_filters( 'csco_editor_page_load_nextpost', $page_load_nextpost ),
	);

	// Enqueue scripts.
	wp_enqueue_script(
		'csco-editor-panels',
		get_template_directory_uri() . '/assets/jsx/panels.js',
		array(
			'wp-i18n',
			'wp-blocks',
			'wp-edit-post',
			'wp-element',
			'wp-editor',
			'wp-components',
			'wp-data',
			'wp-plugins',
			'wp-edit-post',
			'wp-hooks',
		),
		csco_get_theme_data( 'Version' ),
		true
	);

	// Localize scripts.
	wp_localize_script(
		'csco-editor-panels',
		'csPanelsData',
		apply_filters( 'csco_panels_data', $panels_data, $post )
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_gutenberg_panels_assets' );
