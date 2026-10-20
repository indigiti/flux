<?php
/**
 * Banner Two Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'home_banner_two_section',
	array(
		'title' => esc_html__( 'Section: Banner 2', 'flux' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_banner_two_after_section',
		'label'           => esc_html__( 'Banner', 'flux' ),
		'section'         => 'home_banner_two_section',
		'input_attrs'     => array(
			'collapsed' => true,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'home_banner_two_after_html',
		'label'             => esc_html__( 'HTML Code', 'flux' ),
		'section'           => 'home_banner_two_section',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'conditional'       => 'home',
		'active_callback'   => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'home_banner_two_after_width_divider' ),
		'section'         => 'home_banner_two_section',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'settings'        => 'home_banner_two_after_width_section_heading',
		'label'           => esc_html__( 'Banner Width', 'flux' ),
		'section'         => 'home_banner_two_section',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_banner_two_after_width_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-home-two',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 1320px)',
			),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_banner_two_after_width_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-home-two',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 1200px) and (max-width: 1319.98px)',
			),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_banner_two_after_width_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-home-two',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (min-width: 768px) and (max-width: 1199.98px)',
			),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_banner_two_after_width_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-home-two',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'home_banner_two_after_label_divider' ),
		'section'         => 'home_banner_two_section',
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_banner_two_after_label',
		'label'           => esc_html__( 'Display label', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => true,
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_banner_two_after_label_text',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => esc_html__( 'Advertisement', 'flux' ),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_banner_two_display',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
			array(
				array(
					'setting'  => 'home_banner_two_after_label',
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
		'settings'        => 'home_banner_two_after_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'flux' ),
		'section'         => 'home_banner_two_section',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'flux' ),
			'center' => esc_html__( 'Center', 'flux' ),
			'right'  => esc_html__( 'Right', 'flux' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-home-two',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_banner_two_display',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
			array(
				array(
					'setting'  => 'home_banner_two_after_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
