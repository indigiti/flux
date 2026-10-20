<?php
/**
 * Page Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'page_settings',
	array(
		'title' => esc_html__( 'Page Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'page_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'flux' ),
		'section'  => 'page_settings',
		'default'  => 'right',
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
		'settings' => 'page_header_type',
		'label'    => esc_html__( 'Page Header Type', 'flux' ),
		'section'  => 'page_settings',
		'default'  => 'standard',
		'choices'  => array(
			'standard'         => esc_html__( 'Standard', 'flux' ),
			'featured'         => esc_html__( 'Featured', 'flux' ),
			'featured_overlap' => esc_html__( 'Featured Overlap', 'flux' ),
			'overlay'          => esc_html__( 'Overlay', 'flux' ),
			'title'            => esc_html__( 'Page Title Only', 'flux' ),
			'none'             => esc_html__( 'None', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'page_media_preview',
		'label'           => esc_html__( 'Standard Page Header Preview', 'flux' ),
		'section'         => 'page_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'flux' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'page_header_type',
				'operator' => '==',
				'value'    => 'standard',
			),
		),
	)
);
