<?php
/**
 * Hero Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'home_hero_section',
	array(
		'title' => esc_html__( 'Section: Hero', 'flux' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_hero_collapsible_common',
		'section'         => 'home_hero_section',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => true,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'home_hero_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'home_hero_section',
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
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_hero_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_hero_image_lazyload',
		'label'           => esc_html__( 'Image loading', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => 'lazy',
		'choices'         => array(
			'lazy'  => esc_html__( 'Lazy', 'flux' ),
			'eager' => esc_html__( 'Eager', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_hero_collapsible_query',
		'section'         => 'home_hero_section',
		'label'           => esc_html__( 'Query', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs (max. 1). For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_hero_filter_categories',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_tags',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_hero_filter_tags',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_hero_filter_categories',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_hero_filter_categories',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_hero_avoid_duplicates',
		'label'           => esc_html__( 'Avoid duplicate posts', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_hero_exclude_posts',
		'label'           => esc_html__( 'Exclude posts from the main archive', 'flux' ),
		'section'         => 'home_hero_section',
		'default'         => false,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
