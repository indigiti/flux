<?php
/**
 * Slider Posts Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'home_post_slider_section',
	array(
		'title' => esc_html__( 'Section: Post Slider', 'flux' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_slider_collapsible_common',
		'section'         => 'home_post_slider_section',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => true,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_slider_autoplay',
		'label'           => esc_html__( 'Slider Autoplay', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => 'yes',
		'priority'        => 10,
		'choices'         => array(
			'yes' => esc_html__( 'Enabled', 'flux' ),
			'no'  => esc_html__( 'Disabled', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_slider_delay',
		'label'           => esc_html__( 'Autoplay Delay (ms)', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => '5000',
		'input_attrs'     => array(
			'min'  => 3000,
			'max'  => 10000,
			'step' => 500,
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-slider-delay-ms',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_autoplay',
				'operator' => '==',
				'value'    => 'yes',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_slider_parallax',
		'label'           => esc_html__( 'Slider Parallax Effect', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => 'yes',
		'priority'        => 10,
		'choices'         => array(
			'yes' => esc_html__( 'Enabled', 'flux' ),
			'no'  => esc_html__( 'Disabled', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'home_slider_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => array( 'category', 'reading_time', 'author', 'date', 'comments' ),
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
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_slider_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_slider_image_lazyload',
		'label'           => esc_html__( 'Image loading', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => 'lazy',
		'choices'         => array(
			'lazy'  => esc_html__( 'Lazy', 'flux' ),
			'eager' => esc_html__( 'Eager', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_slider_collapsible_query',
		'section'         => 'home_post_slider_section',
		'label'           => esc_html__( 'Query', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_slider_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs (max. 5). For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_slider_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_slider_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_slider_filter_offset',
		'label'           => esc_html__( 'Offset', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_slider_filter_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'home_post_slider_section',
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
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_slider_filter_time_frame',
		'label'           => esc_html__( 'Filter by Time Frame', 'flux' ),
		'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => '',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_filter_sort_orderby',
				'operator' => '==',
				'value'    => 'views',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_slider_filter_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => 'DESC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_slider_filter_sort_orderby',
				'operator' => '!=',
				'value'    => 'post__in',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_slider_number_items',
		'label'           => esc_html__( 'Maximum Posts', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => '3',
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 100,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_slider_avoid_duplicates',
		'label'           => esc_html__( 'Avoid duplicate posts', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_slider_exclude_posts',
		'label'           => esc_html__( 'Exclude posts from the main archive', 'flux' ),
		'section'         => 'home_post_slider_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
