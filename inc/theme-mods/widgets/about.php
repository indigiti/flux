<?php
/**
 * About Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'theme_widget_about',
	array(
		'title' => esc_html__( 'About', 'flux' ),
		'panel' => 'theme_widgets',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'theme_widget_about_collapsible_settings',
		'section'     => 'theme_widget_about',
		'label'       => esc_html__( 'Widget Settings', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'theme_widget_about_display',
		'label'    => esc_html__( 'Display Location', 'flux' ),
		'section'  => 'theme_widget_about',
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
		'settings'        => 'theme_widget_about_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'theme_widget_about',
		'default'         => 1000,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_about_title',
		'label'           => esc_html__( 'Widget title', 'flux' ),
		'section'         => 'theme_widget_about',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_about_collapsible_common',
		'section'         => 'theme_widget_about',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_about_avatar',
		'label'           => esc_html__( 'Avatar', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your avatar via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 120px (240px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_about',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_about_avatar_url',
		'label'           => esc_html__( 'Avatar Link', 'flux' ),
		'section'         => 'theme_widget_about',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_about_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_about_avatar_url_target',
		'section'         => 'theme_widget_about',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_about_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_about_subheading',
		'label'             => esc_html__( 'Subheading', 'flux' ),
		'section'           => 'theme_widget_about',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_about_heading',
		'label'             => esc_html__( 'Heading', 'flux' ),
		'section'           => 'theme_widget_about',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'theme_widget_about_description',
		'label'             => esc_html__( 'Description', 'flux' ),
		'section'           => 'theme_widget_about',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_about_collapsible_visibility',
		'section'         => 'theme_widget_about',
		'label'           => esc_html__( 'Visibility', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'theme_widget_about_visibility',
		'section'         => 'theme_widget_about',
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
				'setting'  => 'theme_widget_about_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
