<?php
/**
 * Author Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'author_settings',
	array(
		'title' => esc_html__( 'Author Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'author_collapsible_common',
		'section'     => 'author_settings',
		'label'       => esc_html__( 'Common', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'author_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'flux' ),
		'section'  => 'author_settings',
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
		'settings' => 'author_layout',
		'label'    => esc_html__( 'Layout', 'flux' ),
		'section'  => 'author_settings',
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
		'settings'        => 'author_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'author_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'author_layout',
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
		'settings' => 'author_borders',
		'label'    => esc_html__( 'Display borders', 'flux' ),
		'section'  => 'author_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'author_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'author_settings',
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
					'setting'  => 'author_layout',
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
		'settings'        => 'author_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'author_layout',
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
		'settings'        => 'author_media_preview',
		'label'           => esc_html__( 'Post Preview Image Size', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'flux' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'author_layout',
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
		'settings'        => 'author_summary',
		'label'           => esc_html__( 'Full Post Summary', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 'summary',
		'choices'         => array(
			'summary' => esc_html__( 'Use Excerpts', 'flux' ),
			'content' => esc_html__( 'Use Read More Tag', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'author_layout',
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
		'settings' => 'author_pagination_type',
		'label'    => esc_html__( 'Pagination', 'flux' ),
		'section'  => 'author_settings',
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
		'settings'    => 'author_collapsible_post_meta',
		'section'     => 'author_settings',
		'label'       => esc_html__( 'Post Meta', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'author_post_meta',
		'label'    => esc_html__( 'Post Meta', 'flux' ),
		'section'  => 'author_settings',
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
		'settings'        => 'author_collapsible_number_of_columns',
		'section'         => 'author_settings',
		'label'           => esc_html__( 'Number of Columns', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'author_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 2,
			'max'  => 4,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__author.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-columns',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'author_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__author.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'author_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__author.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'author_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 1,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__author.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'author_collapsible_gap_between_columns',
		'section'         => 'author_settings',
		'label'           => esc_html__( 'Gap between Columns', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_gap_between_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__author.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-column-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_gap_between_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__author.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_gap_between_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__author.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_gap_between_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '0px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__author.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'author_collapsible_gap_between_rows',
		'section'     => 'author_settings',
		'label'       => esc_html__( 'Gap between Rows', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_gap_between_rows_desktop',
		'label'    => esc_html__( 'Desktop', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__author',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_gap_between_rows_laptop',
		'label'    => esc_html__( 'Laptop', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__author',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_gap_between_rows_tablet',
		'label'    => esc_html__( 'Tablet', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__author',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_gap_between_rows_mobile',
		'label'    => esc_html__( 'Mobile', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__author',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'author_collapsible_title_size',
		'section'     => 'author_settings',
		'label'       => esc_html__( 'Title Font Size', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_title_size_desktop',
		'label'    => esc_html__( 'Desktop', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__author',
				'property' => '--cs-entry-title-font-size',
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_title_size_laptop',
		'label'    => esc_html__( 'Laptop', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__author',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_title_size_tablet',
		'label'    => esc_html__( 'Tablet', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '1.25rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__author',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'author_title_size_mobile',
		'label'    => esc_html__( 'Mobile', 'flux' ),
		'section'  => 'author_settings',
		'default'  => '1.125rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__author',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

// ----------------------------------------------
// Banner after the Author Grid.
// ----------------------------------------------
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'author_banner_after_section',
		'label'       => esc_html__( 'Banner', 'flux' ),
		'section'     => 'author_settings',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'author_banner_after',
		'label'    => esc_html__( 'Enable banner after post grid', 'flux' ),
		'section'  => 'author_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'author_banner_after_html',
		'label'             => esc_html__( 'HTML Code', 'flux' ),
		'section'           => 'author_settings',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'author_banner_after_width_divider' ),
		'section'         => 'author_settings',
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'settings'        => 'author_banner_after_width_section_heading',
		'label'           => esc_html__( 'Banner Width', 'flux' ),
		'section'         => 'author_settings',
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_banner_after_width_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-author-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 1320px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_banner_after_width_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-author-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 1200px) and (max-width: 1319.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_banner_after_width_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-author-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 768px) and (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'author_banner_after_width_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'author_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-author-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'author_banner_after_label_divider' ),
		'section'         => 'author_settings',
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'author_banner_after_label',
		'label'           => esc_html__( 'Display label', 'flux' ),
		'section'         => 'author_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'author_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'author_banner_after_label_text',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'author_settings',
		'default'         => esc_html__( 'Advertisement', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'author_banner_after',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'author_banner_after_label',
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
		'settings'        => 'author_banner_after_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'flux' ),
		'section'         => 'author_settings',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'flux' ),
			'center' => esc_html__( 'Center', 'flux' ),
			'right'  => esc_html__( 'Right', 'flux' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-author-after',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'author_banner_after',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'author_banner_after_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
