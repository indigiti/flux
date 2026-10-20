<?php
/**
 * Banner Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'theme_widget_banner',
	array(
		'title' => esc_html__( 'Banner', 'flux' ),
		'panel' => 'theme_widgets',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'theme_widget_banner_collapsible_settings',
		'section'     => 'theme_widget_banner',
		'label'       => esc_html__( 'Widget Settings', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'theme_widget_banner_display',
		'label'    => esc_html__( 'Display Location', 'flux' ),
		'section'  => 'theme_widget_banner',
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
		'settings'        => 'theme_widget_banner_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'theme_widget_banner',
		'default'         => 1000,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_banner_title',
		'label'           => esc_html__( 'Widget title', 'flux' ),
		'section'         => 'theme_widget_banner',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_banner_collapsible_common',
		'section'         => 'theme_widget_banner',
		'label'           => esc_html__( 'Common', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'theme_widget_banner_html',
		'label'             => esc_html__( 'HTML Code', 'flux' ),
		'section'           => 'theme_widget_banner',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'theme_widget_banner_html_divider' ),
		'section'         => 'theme_widget_banner',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'theme_widget_banner_label',
		'label'           => esc_html__( 'Display label', 'flux' ),
		'section'         => 'theme_widget_banner',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_banner_label_text',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'theme_widget_banner',
		'default'         => esc_html__( 'Advertisement', 'flux' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'theme_widget_banner_display',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
			array(
				array(
					'setting'  => 'theme_widget_banner_label',
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
		'settings'        => 'theme_widget_banner_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'flux' ),
		'section'         => 'theme_widget_banner',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'flux' ),
			'center' => esc_html__( 'Center', 'flux' ),
			'right'  => esc_html__( 'Right', 'flux' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-widget-banner .cs-banner',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'theme_widget_banner_display',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
			array(
				array(
					'setting'  => 'theme_widget_banner_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_banner_collapsible_visibility',
		'section'         => 'theme_widget_banner',
		'label'           => esc_html__( 'Visibility', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'theme_widget_banner_visibility',
		'section'         => 'theme_widget_banner',
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
				'setting'  => 'theme_widget_banner_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
