<?php
/**
 * Grid Posts Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'home_post_grid_section',
	array(
		'title' => esc_html__( 'Section: Post Grid', 'flux' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_post_grid_collapsible_common',
		'section'         => 'home_post_grid_section',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => true,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_post_grid_heading',
		'label'           => esc_html__( 'Section heading', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => esc_html__( 'Most Popular', 'flux' ),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_post_grid_layout',
		'label'           => esc_html__( 'Layout', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => 'type-1',
		'priority'        => 10,
		'choices'         => array(
			'type-1' => esc_html__( 'Type 1', 'flux' ),
			'type-2' => esc_html__( 'Type 2', 'flux' ),
			'type-3' => esc_html__( 'Type 3', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'home_post_grid_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => array( 'category', 'author', 'date', 'comments' ),
		'priority'        => 10,
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
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_post_grid_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_post_grid_layout',
				'operator' => '!=',
				'value'    => 'type-1',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_grid_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'home_post_grid_section',
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
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_grid_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_grid_image_lazyload',
		'label'           => esc_html__( 'Image loading', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => 'lazy',
		'choices'         => array(
			'lazy'  => esc_html__( 'Lazy', 'flux' ),
			'eager' => esc_html__( 'Eager', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_post_grid_collapsible_query',
		'section'         => 'home_post_grid_section',
		'label'           => esc_html__( 'Query', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_post_grid_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs (max. 5). For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_post_grid_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_post_grid_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_post_grid_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_post_grid_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_post_grid_filter_offset',
		'label'           => esc_html__( 'Offset', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_post_grid_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_grid_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'home_post_grid_section',
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
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_post_grid_time_frame',
		'label'           => esc_html__( 'Filter by Time Frame', 'flux' ),
		'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => '',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_post_grid_sort_orderby',
				'operator' => '==',
				'value'    => 'views',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_grid_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => 'DESC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_post_grid_sort_orderby',
				'operator' => '!=',
				'value'    => 'post__in',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_post_grid_avoid_duplicates',
		'label'           => esc_html__( 'Avoid duplicate posts', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_post_grid_exclude_posts',
		'label'           => esc_html__( 'Exclude posts from the main archive', 'flux' ),
		'section'         => 'home_post_grid_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
