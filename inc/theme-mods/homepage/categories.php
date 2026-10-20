<?php
/**
 * Categories Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'home_categories_section',
	array(
		'title' => esc_html__( 'Section: Categories', 'flux' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_categories_collapsible_common',
		'section'         => 'home_categories_section',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => true,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_category_layout',
		'label'           => esc_html__( 'Layout', 'flux' ),
		'section'         => 'home_categories_section',
		'default'         => 'type-1',
		'priority'        => 10,
		'choices'         => array(
			'type-1' => esc_html__( 'Type 1', 'flux' ),
			'type-2' => esc_html__( 'Type 2', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_category_heading',
		'label'           => esc_html__( 'Section heading', 'flux' ),
		'section'         => 'home_categories_section',
		'default'         => esc_html__( 'Trending Topics', 'flux' ),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_category_taxonomy_type',
		'section'         => 'home_categories_section',
		'label'           => esc_html__( 'Taxonomy', 'flux' ),
		'default'         => 'category',
		'choices'         => array(
			'category' => esc_html__( 'Categories', 'flux' ),
			'post_tag' => esc_html__( 'Tags', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'home_category_layout',
				'operator' => '==',
				'value'    => 'type-2',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_categories_filter_slugs',
		'label'           => esc_html__( 'Categories or tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all.', 'flux' ),
		'section'         => 'home_categories_section',
		'default'         => '',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_categories_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'home_categories_section',
		'default'         => 'name',
		'choices'         => array(
			'name'     => esc_html__( 'Name', 'flux' ),
			'count'    => esc_html__( 'Posts count', 'flux' ),
			'slug__in' => esc_html__( 'Slugs', 'flux' ),
			'id'       => esc_html__( 'ID', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_categories_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'home_categories_section',
		'default'         => 'ASC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_categories_limit',
		'label'           => esc_html__( 'Limit', 'flux' ),
		'section'         => 'home_categories_section',
		'default'         => 5,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 99,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
