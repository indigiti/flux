<?php
/**
 * Post Slider Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'theme_widget_post_slider',
	array(
		'title' => esc_html__( 'Post Slider', 'flux' ),
		'panel' => 'theme_widgets',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'theme_widget_post_slider_collapsible_settings',
		'section'     => 'theme_widget_post_slider',
		'label'       => esc_html__( 'Widget Settings', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'theme_widget_post_slider_display',
		'label'    => esc_html__( 'Display Location', 'flux' ),
		'section'  => 'theme_widget_post_slider',
		'default'  => 'none',
		'choices'  => array(
			'sidebar-main'      => esc_html__( 'Sidebar', 'flux' ),
			'sidebar-offcanvas' => esc_html__( 'Off-canvas', 'flux' ),
			'none'              => esc_html__( 'None', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'theme_widget_post_slider_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => 1000,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_post_slider_title',
		'label'           => esc_html__( 'Widget title', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_post_slider_collapsible_common',
		'section'         => 'theme_widget_post_slider',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'theme_widget_post_slider_autoplay',
		'label'           => esc_html__( 'Slider Autoplay', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => 'yes',
		'priority'        => 10,
		'choices'         => array(
			'yes' => esc_html__( 'Enabled', 'flux' ),
			'no'  => esc_html__( 'Disabled', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'theme_widget_post_slider_delay',
		'label'           => esc_html__( 'Autoplay Delay (ms)', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => '5000',
		'input_attrs'     => array(
			'min'  => 3000,
			'max'  => 10000,
			'step' => 500,
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-post-slider-delay-ms',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_autoplay',
				'operator' => '==',
				'value'    => 'yes',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'theme_widget_post_slider_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'theme_widget_post_slider',
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
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'theme_widget_post_slider_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_post_slider_lazyload',
		'label'           => esc_html__( 'Image loading', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => 'lazy',
		'choices'         => array(
			'lazy'  => esc_html__( 'Lazy', 'flux' ),
			'eager' => esc_html__( 'Eager', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_post_slider_collapsible_query',
		'section'         => 'theme_widget_post_slider',
		'label'           => esc_html__( 'Query', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_post_slider_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs (max. 5). For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_post_slider_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_post_slider_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'theme_widget_post_slider_filter_offset',
		'label'           => esc_html__( 'Offset', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_post_slider_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'theme_widget_post_slider',
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
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_post_slider_time_frame',
		'label'           => esc_html__( 'Filter by Time Frame', 'flux' ),
		'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_sort_orderby',
				'operator' => '==',
				'value'    => 'views',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_post_slider_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => 'DESC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_sort_orderby',
				'operator' => '!=',
				'value'    => 'post__in',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'theme_widget_post_slider_number_items',
		'label'           => esc_html__( 'Maximum Posts', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => 3,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 25,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_post_slider_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'theme_widget_post_slider_avoid_duplicates',
		'label'           => esc_html__( 'Avoid duplicate posts', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'theme_widget_post_slider_exclude',
		'label'           => esc_html__( 'Exclude hero posts from the main archive', 'flux' ),
		'section'         => 'theme_widget_post_slider',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_post_slider_collapsible_visibility',
		'section'         => 'theme_widget_post_slider',
		'label'           => esc_html__( 'Visibility', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'theme_widget_post_slider_visibility',
		'section'         => 'theme_widget_post_slider',
		'default'         => array(),
		/**
		 * Widget visibility choices.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_widget_visibility_choices',
			array(
				'frontpage' => esc_html__( 'Hide On Frontpage', 'flux' ),
				'homepage'  => esc_html__( 'Hide On Homepage', 'flux' ),
				'category'  => esc_html__( 'Hide On Categories', 'flux' ),
				'post'      => esc_html__( 'Hide On Posts', 'flux' ),
				'page'      => esc_html__( 'Hide On Pages', 'flux' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_post_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
