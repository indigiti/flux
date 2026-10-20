<?php
/**
 * Header Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'header',
	array(
		'title' => esc_html__( 'Header Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'header_collapsible_common',
		'section'     => 'header',
		'label'       => esc_html__( 'Common', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'header_layout',
		'label'    => esc_html__( 'Layout', 'flux' ),
		'section'  => 'header',
		'default'  => 'cs-header-1',
		/**
		 * The csco_header hook.
		 *
		 * @since 1.0.0
		 */
		'choices'  => apply_filters(
			'csco_header_layouts',
			array(
				'cs-header-1' => esc_html__( 'Header 1', 'flux' ),
				'cs-header-2' => esc_html__( 'Header 2', 'flux' ),
			)
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_initial_height',
		'label'    => esc_html__( 'Header Initial Height', 'flux' ),
		'section'  => 'header',
		'default'  => '70px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-initial-height',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_height',
		'label'    => esc_html__( 'Header Height', 'flux' ),
		'section'  => 'header',
		'default'  => '70px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-height',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_border_width',
		'label'    => esc_html__( 'Header Border Width', 'flux' ),
		'section'  => 'header',
		'default'  => '1px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-border-width',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'navbar_sticky',
		'label'       => esc_html__( 'Make navigation bar sticky', 'flux' ),
		'description' => esc_html__( 'Enabling this option will make navigation bar visible when scrolling.', 'flux' ),
		'section'     => 'header',
		'default'     => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'navbar_smart_sticky',
		'label'           => esc_html__( 'Enable the smart sticky feature', 'flux' ),
		'description'     => esc_html__( 'Enabling this option will reveal navigation bar when scrolling up and hide it when scrolling down.', 'flux' ),
		'section'         => 'header',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'navbar_sticky',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_navigation_menu',
		'label'    => esc_html__( 'Display navigation menu', 'flux' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_search',
		'section'  => 'header',
		'label'    => esc_html__( 'Search', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_search_button',
		'label'    => esc_html__( 'Enable header search', 'flux' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_placeholder',
		'label'           => esc_html__( 'Placeholder', 'flux' ),
		'section'         => 'header',
		'default'         => esc_html__( 'Search...', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_heading',
		'label'           => esc_html__( 'Heading', 'flux' ),
		'section'         => 'header',
		'default'         => esc_html__( 'What Are You Looking For?', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_search_post_categories_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_search_post_categories',
		'label'           => esc_html__( 'Display posts categories', 'flux' ),
		'section'         => 'header',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_categories_heading',
		'label'           => esc_html__( 'Categories section heading', 'flux' ),
		'section'         => 'header',
		'default'         => esc_html__( 'Popular Searches', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_categories_filter_slugs',
		'label'           => esc_html__( 'Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_search_categories_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'header',
		'default'         => 'name',
		'choices'         => array(
			'name'     => esc_html__( 'Name', 'flux' ),
			'count'    => esc_html__( 'Posts count', 'flux' ),
			'slug__in' => esc_html__( 'Slugs', 'flux' ),
			'id'       => esc_html__( 'ID', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_search_categories_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'header',
		'default'         => 'ASC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'header_search_categories_limit',
		'label'           => esc_html__( 'Limit', 'flux' ),
		'section'         => 'header',
		'default'         => 4,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 99,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_search_post_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_search_post',
		'label'           => esc_html__( 'Display posts section', 'flux' ),
		'section'         => 'header',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_post_heading',
		'label'           => esc_html__( 'Post section heading', 'flux' ),
		'section'         => 'header',
		'default'         => esc_html__( 'Popular posts', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'header_search_post_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'header',
		'default'         => array( 'category', 'author', 'date', 'comments' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_post_meta_choices',
			array(
				'category'     => esc_html__( 'Category', 'flux' ),
				'reading_time' => esc_html__( 'Reading time', 'flux' ),
				'author'       => esc_html__( 'Author', 'flux' ),
				'date'         => esc_html__( 'Date', 'flux' ),
				'comments'     => esc_html__( 'Comments', 'flux' ),
			)
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_search_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_search_post_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'header',
		'default'         => 'landscape-16-9',
		'choices'         => array(
			'original'       => esc_html__( 'Original', 'flux' ),
			'landscape'      => esc_html__( 'Landscape 4:3', 'flux' ),
			'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'flux' ),
			'landscape-16-9' => esc_html__( 'Landscape 16:9', 'flux' ),
			'landscape-20-9' => esc_html__( 'Landscape 20:9', 'flux' ),
			'landscape-21-9' => esc_html__( 'Landscape 21:9', 'flux' ),
			'portrait'       => esc_html__( 'Portrait 3:4', 'flux' ),
			'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'flux' ),
			'square'         => esc_html__( 'Square', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_search_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_search_post_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'header',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_search_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_search_post_filter_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_search_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_search_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs. For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'header_search_filter_offset',
		'label'           => esc_html__( 'Offset', 'flux' ),
		'section'         => 'header',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_search_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'header',
		'default'         => 'date',
		'choices'         => array(
			'date'          => esc_html__( 'Published Date', 'flux' ),
			'modified'      => esc_html__( 'Modified Date', 'flux' ),
			'title'         => esc_html__( 'Title', 'flux' ),
			'rand'          => esc_html__( 'Random', 'flux' ),
			'views'         => esc_html__( 'Views', 'flux' ),
			'comment_count' => esc_html__( 'Comment Count', 'flux' ),
			'ID'            => esc_html__( 'ID', 'flux' ),
			'post__in'      => esc_html__( 'Custom', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_time_frame',
		'label'           => esc_html__( 'Filter by Time Frame', 'flux' ),
		'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_sort_orderby',
				'operator' => '==',
				'value'    => 'views',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_search_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'header',
		'default'         => 'DESC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_sort_orderby',
				'operator' => '!=',
				'value'    => 'post__in',
			),
		),
	)
);

// Header Featured Menu.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_featured_menu',
		'section'  => 'header',
		'label'    => esc_html__( 'Featured Menu', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'featured_menu_post_meta',
		'label'    => esc_html__( 'Post meta', 'flux' ),
		'section'  => 'header',
		'default'  => array( 'category', 'author', 'date', 'comments' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'  => apply_filters(
			'csco_post_meta_choices',
			array(
				'category'     => esc_html__( 'Category', 'flux' ),
				'reading_time' => esc_html__( 'Reading time', 'flux' ),
				'author'       => esc_html__( 'Author', 'flux' ),
				'date'         => esc_html__( 'Date', 'flux' ),
				'comments'     => esc_html__( 'Comments', 'flux' ),
			)
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'featured_menu_excerpt',
		'label'    => esc_html__( 'Display excerpt', 'flux' ),
		'section'  => 'header',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'featured_menu_image_orientation',
		'label'    => esc_html__( 'Image Orientation', 'flux' ),
		'section'  => 'header',
		'default'  => 'landscape-16-9',
		'choices'  => array(
			'original'       => esc_html__( 'Original', 'flux' ),
			'landscape'      => esc_html__( 'Landscape 4:3', 'flux' ),
			'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'flux' ),
			'landscape-16-9' => esc_html__( 'Landscape 16:9', 'flux' ),
			'landscape-20-9' => esc_html__( 'Landscape 20:9', 'flux' ),
			'landscape-21-9' => esc_html__( 'Landscape 21:9', 'flux' ),
			'portrait'       => esc_html__( 'Portrait 3:4', 'flux' ),
			'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'flux' ),
			'square'         => esc_html__( 'Square', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'featured_menu_image_size',
		'label'    => esc_html__( 'Image Size', 'flux' ),
		'section'  => 'header',
		'default'  => 'csco-thumbnail',
		'choices'  => csco_get_list_available_image_sizes(),
	)
);

// Header Burger Menu.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_burger',
		'section'  => 'header',
		'label'    => esc_html__( 'Burger Menu', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'header_offcanvas',
		'label'       => esc_html__( 'Enable burger menu', 'flux' ),
		'description' => esc_html__( 'Enabling this option will display navigation burger menu which can be configured using Wordpress "Appearance / Menu" section. Location - "Burger Menu".', 'flux' ),
		'section'     => 'header',
		'default'     => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_burger_follow_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'burger_menu_follow',
		'label'           => esc_html__( 'Enable follow section', 'flux' ),
		'description'     => esc_html__( 'Enabling this option will display Social Links which can be configured in the Customizing -> Miscellaneous Settings.', 'flux' ),
		'section'         => 'header',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'burger_menu_follow_heading',
		'label'           => esc_html__( 'Section heading', 'flux' ),
		'section'         => 'header',
		'default'         => esc_html__( 'Follow', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'burger_menu_follow',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'header_additional_menu_divider' ),
		'section'  => 'header',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'header_additional_menu',
		'label'       => esc_html__( 'Enable additional menu', 'flux' ),
		'description' => esc_html__( 'Enabling this option will display navigation burger menu which can be configured using Wordpress "Appearance / Menu" section. Location - "Additional menu".', 'flux' ),
		'section'     => 'header',
		'default'     => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_burger_post_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_burger_post',
		'label'           => esc_html__( 'Display posts section', 'flux' ),
		'section'         => 'header',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_burger_post_heading',
		'label'           => esc_html__( 'Section heading', 'flux' ),
		'section'         => 'header',
		'default'         => esc_html__( 'Popular Posts', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_burger_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_burger_post_heading_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_burger_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'header_burger_post_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'header',
		'default'         => array( 'category', 'author', 'date', 'comments' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_post_meta_choices',
			array(
				'category'     => esc_html__( 'Category', 'flux' ),
				'reading_time' => esc_html__( 'Reading time', 'flux' ),
				'author'       => esc_html__( 'Author', 'flux' ),
				'date'         => esc_html__( 'Date', 'flux' ),
				'comments'     => esc_html__( 'Comments', 'flux' ),
			)
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_burger_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_burger_post_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'header',
		'default'         => 'landscape-16-9',
		'choices'         => array(
			'original'       => esc_html__( 'Original', 'flux' ),
			'landscape'      => esc_html__( 'Landscape 4:3', 'flux' ),
			'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'flux' ),
			'landscape-16-9' => esc_html__( 'Landscape 16:9', 'flux' ),
			'landscape-20-9' => esc_html__( 'Landscape 20:9', 'flux' ),
			'landscape-21-9' => esc_html__( 'Landscape 21:9', 'flux' ),
			'portrait'       => esc_html__( 'Portrait 3:4', 'flux' ),
			'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'flux' ),
			'square'         => esc_html__( 'Square', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_burger_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_burger_post_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'header',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_offcanvas',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_burger_post',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'header_burger_post_query_divider' ),
		'section'         => 'header',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_burger_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs. For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_burger_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_burger_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'header_burger_filter_offset',
		'label'           => esc_html__( 'Offset', 'flux' ),
		'section'         => 'header',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_burger_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'header',
		'default'         => 'date',
		'choices'         => array(
			'date'          => esc_html__( 'Published Date', 'flux' ),
			'modified'      => esc_html__( 'Modified Date', 'flux' ),
			'title'         => esc_html__( 'Title', 'flux' ),
			'rand'          => esc_html__( 'Random', 'flux' ),
			'views'         => esc_html__( 'Views', 'flux' ),
			'comment_count' => esc_html__( 'Comment Count', 'flux' ),
			'ID'            => esc_html__( 'ID', 'flux' ),
			'post__in'      => esc_html__( 'Custom', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_burger_time_frame',
		'label'           => esc_html__( 'Filter by Time Frame', 'flux' ),
		'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_sort_orderby',
				'operator' => '==',
				'value'    => 'views',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_burger_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'header',
		'default'         => 'DESC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'header_offcanvas',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_burger_sort_orderby',
				'operator' => '!=',
				'value'    => 'post__in',
			),
		),
	)
);

// Header Custom Button.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_custom_button',
		'section'  => 'header',
		'label'    => esc_html__( 'Custom Button', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_custom_button',
		'label'    => esc_html__( 'Display custom button', 'flux' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_custom_button_label',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_custom_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_custom_button_link',
		'label'           => esc_html__( 'URL', 'flux' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_custom_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_custom_button_target',
		'section'         => 'header',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_custom_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
