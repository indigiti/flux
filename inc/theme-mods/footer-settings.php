<?php
/**
 * Footer Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'footer',
	array(
		'title' => esc_html__( 'Footer Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'footer_follow',
		'label'       => esc_html__( 'Display follow section', 'flux' ),
		'description' => esc_html__( 'Enabling this option will display Social Links which can be configured in the Customizing -> Miscellaneous Settings.', 'flux' ),
		'section'     => 'footer',
		'default'     => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'footer_follow_heading',
		'label'             => esc_html__( 'Follow widget heading', 'flux' ),
		'section'           => 'footer',
		'default'           => esc_html__( 'Follow', 'flux' ),
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				array(
					'setting'  => 'footer_follow',
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
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'footer',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'footer_text',
		'label'             => esc_html__( 'Footer text', 'flux' ),
		'section'           => 'footer',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'footer_copyright',
		'label'             => esc_html__( 'Footer copyright', 'flux' ),
		'section'           => 'footer',
		'default'           => esc_html__( '© 2025 Flux. All Rights Reserved.', 'flux' ),
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'footer_marquee_collapsible',
		'section'     => 'footer',
		'label'       => esc_html__( 'Marquee', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'footer_marquee',
		'label'    => esc_html__( 'Enable marquee', 'flux' ),
		'section'  => 'footer',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'footer_marquee_text',
		'label'           => esc_html__( 'Text', 'flux' ),
		'section'         => 'footer',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'footer_marquee',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'footer_marquee_speed',
		'label'           => esc_html__( 'Speed (ms)', 'flux' ),
		'section'         => 'footer',
		'default'         => 40000,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 99999,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-footer-marquee',
				'property' => '--cs-marquee-speed',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'footer_marquee',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'footer_marquee_gap',
		'label'           => esc_html__( 'Spacing', 'flux' ),
		'section'         => 'footer',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'  => '.cs-footer-marquee',
				'property' => '--cs-marquee-text-gap',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'footer_marquee',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
