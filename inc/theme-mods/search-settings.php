<?php
/**
 * Search Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'search_settings',
	array(
		'title' => esc_html__( 'Search Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'search_collapsible_common',
		'section'     => 'search_settings',
		'label'       => esc_html__( 'Common', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'search_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'flux' ),
		'section'  => 'search_settings',
		'default'  => 'disabled',
		'choices'  => array(
			'right'    => esc_html__( 'Right Sidebar', 'flux' ),
			'left'     => esc_html__( 'Left Sidebar', 'flux' ),
			'disabled' => esc_html__( 'No Sidebar', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'search_layout',
		'label'    => esc_html__( 'Layout', 'flux' ),
		'section'  => 'search_settings',
		'default'  => 'grid',
		'choices'  => array(
			'grid' => esc_html__( 'Grid Layout', 'flux' ),
			'list' => esc_html__( 'List Layout', 'flux' ),
			'full' => esc_html__( 'Full Post Layout', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'search_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'search_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'search_layout',
					'operator' => '!=',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'search_borders',
		'label'    => esc_html__( 'Display borders', 'flux' ),
		'section'  => 'search_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'search_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'search_settings',
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
					'setting'  => 'search_layout',
					'operator' => '!=',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'search_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'search_layout',
					'operator' => '!=',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'search_media_preview',
		'label'           => esc_html__( 'Post Preview Image Size', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'flux' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'search_layout',
					'operator' => '==',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'search_summary',
		'label'           => esc_html__( 'Full Post Summary', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 'summary',
		'choices'         => array(
			'summary' => esc_html__( 'Use Excerpts', 'flux' ),
			'content' => esc_html__( 'Use Read More Tag', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'search_layout',
					'operator' => '==',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'search_pagination_type',
		'label'    => esc_html__( 'Pagination', 'flux' ),
		'section'  => 'search_settings',
		'default'  => 'load-more',
		'choices'  => array(
			'standard'  => esc_html__( 'Standard', 'flux' ),
			'load-more' => esc_html__( 'Load More Button', 'flux' ),
			'infinite'  => esc_html__( 'Infinite Load', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'search_collapsible_post_meta',
		'section'     => 'search_settings',
		'label'       => esc_html__( 'Post Meta', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'search_post_meta',
		'label'    => esc_html__( 'Post Meta', 'flux' ),
		'section'  => 'search_settings',
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
		'type'            => 'collapsible',
		'settings'        => 'search_collapsible_number_of_columns',
		'section'         => 'search_settings',
		'label'           => esc_html__( 'Number of Columns', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'search_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 2,
			'max'  => 4,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__search.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-columns',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'search_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__search.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'search_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__search.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'search_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 1,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__search.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'search_collapsible_gap_between_columns',
		'section'         => 'search_settings',
		'label'           => esc_html__( 'Gap between Columns', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_gap_between_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__search.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-column-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_gap_between_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__search.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_gap_between_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__search.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_gap_between_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__search.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'search_collapsible_gap_between_rows',
		'section'     => 'search_settings',
		'label'       => esc_html__( 'Gap between Rows', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_gap_between_rows_desktop',
		'label'    => esc_html__( 'Desktop', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__search',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_gap_between_rows_laptop',
		'label'    => esc_html__( 'Laptop', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__search',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_gap_between_rows_tablet',
		'label'    => esc_html__( 'Tablet', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__search',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_gap_between_rows_mobile',
		'label'    => esc_html__( 'Mobile', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__search',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'search_collapsible_title_size',
		'section'     => 'search_settings',
		'label'       => esc_html__( 'Title Font Size', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_title_size_desktop',
		'label'    => esc_html__( 'Desktop', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__search',
				'property' => '--cs-entry-title-font-size',
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_title_size_laptop',
		'label'    => esc_html__( 'Laptop', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__search',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_title_size_tablet',
		'label'    => esc_html__( 'Tablet', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '1.25rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__search',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'search_title_size_mobile',
		'label'    => esc_html__( 'Mobile', 'flux' ),
		'section'  => 'search_settings',
		'default'  => '1.125rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__search',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'search_collapsible_tags',
		'section'     => 'search_settings',
		'label'       => esc_html__( 'Quick Tags', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'search_tags_display',
		'label'    => esc_html__( 'Enable tags', 'flux' ),
		'section'  => 'search_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'search_tags_heading',
		'label'           => esc_html__( 'Heading', 'flux' ),
		'section'         => 'search_settings',
		'default'         => esc_html__( 'Popular Searches', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'search_tags_display',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'search_tags_taxonomy_type',
		'section'         => 'search_settings',
		'label'           => esc_html__( 'Taxonomy', 'flux' ),
		'default'         => 'category',
		'choices'         => array(
			'category' => esc_html__( 'Categories', 'flux' ),
			'post_tag' => esc_html__( 'Tags', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_tags_display',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'search_tags_filter_slugs',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all.', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'search_tags_display',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'search_tags_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 'name',
		'choices'         => array(
			'name'     => esc_html__( 'Name', 'flux' ),
			'count'    => esc_html__( 'Posts count', 'flux' ),
			'slug__in' => esc_html__( 'Slugs', 'flux' ),
			'id'       => esc_html__( 'ID', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_tags_display',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'search_tags_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 'ASC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_tags_display',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'search_tags_limit',
		'label'           => esc_html__( 'Limit', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 99,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_tags_display',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'search_tags_filter_slugs',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

// ----------------------------------------------
// Banner after the Search Grid.
// ----------------------------------------------
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'search_banner_after_section',
		'label'       => esc_html__( 'Banner', 'flux' ),
		'section'     => 'search_settings',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'search_banner_after',
		'label'    => esc_html__( 'Enable banner after post grid', 'flux' ),
		'section'  => 'search_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'search_banner_after_html',
		'label'             => esc_html__( 'HTML Code', 'flux' ),
		'section'           => 'search_settings',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'search_banner_after_width_divider' ),
		'section'         => 'search_settings',
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'settings'        => 'search_banner_after_width_section_heading',
		'label'           => esc_html__( 'Banner Width', 'flux' ),
		'section'         => 'search_settings',
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_banner_after_width_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-search-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 1320px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_banner_after_width_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-search-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 1200px) and (max-width: 1319.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_banner_after_width_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-search-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 768px) and (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'search_banner_after_width_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'search_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-search-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'search_banner_after_label_divider' ),
		'section'         => 'search_settings',
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'search_banner_after_label',
		'label'           => esc_html__( 'Display label', 'flux' ),
		'section'         => 'search_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'search_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'search_banner_after_label_text',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'search_settings',
		'default'         => esc_html__( 'Advertisement', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'search_banner_after',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'search_banner_after_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'search_banner_after_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'flux' ),
		'section'         => 'search_settings',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'flux' ),
			'center' => esc_html__( 'Center', 'flux' ),
			'right'  => esc_html__( 'Right', 'flux' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-search-after',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'search_banner_after',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'search_banner_after_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
