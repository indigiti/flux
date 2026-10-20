<?php
/**
 * Follow Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'theme_widget_follow',
	array(
		'title' => esc_html__( 'Follow', 'flux' ),
		'panel' => 'theme_widgets',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'theme_widget_follow_collapsible_settings',
		'section'     => 'theme_widget_follow',
		'label'       => esc_html__( 'Widget Settings', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'theme_widget_follow_display',
		'label'    => esc_html__( 'Display Location', 'flux' ),
		'section'  => 'theme_widget_follow',
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
		'settings'        => 'theme_widget_follow_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => 1000,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_follow_title',
		'label'           => esc_html__( 'Widget title', 'flux' ),
		'section'         => 'theme_widget_follow',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'theme_widget_follow_divider' ),
		'section'         => 'theme_widget_follow',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_follow_item_1_collapsible',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Item 1', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_follow_item_1_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 28px (56px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_follow_item_1_avatar',
		'label'           => esc_html__( 'Avatar', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your avatar via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 64px (128px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_follow_item_1_heading',
		'label'             => esc_html__( 'Heading', 'flux' ),
		'section'           => 'theme_widget_follow',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_follow_item_1_subheading',
		'label'             => esc_html__( 'Subheading', 'flux' ),
		'section'           => 'theme_widget_follow',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_follow_item_1_url',
		'label'           => esc_html__( 'Link', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_follow_item_1_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_follow_item_1_target',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_follow_item_1_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_follow_item_2_collapsible',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Item 2', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_follow_item_2_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 28px (56px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_follow_item_2_avatar',
		'label'           => esc_html__( 'Avatar', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your avatar via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 64px (128px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_follow_item_2_heading',
		'label'             => esc_html__( 'Heading', 'flux' ),
		'section'           => 'theme_widget_follow',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_follow_item_2_subheading',
		'label'             => esc_html__( 'Subheading', 'flux' ),
		'section'           => 'theme_widget_follow',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_follow_item_2_url',
		'label'           => esc_html__( 'Link', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_follow_item_2_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_follow_item_2_target',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_follow_item_2_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_follow_item_3_collapsible',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Item 3', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_follow_item_3_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 28px (56px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'theme_widget_follow_item_3_avatar',
		'label'           => esc_html__( 'Avatar', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your avatar via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>avatar@2x.png</code>' . esc_html__( '. Recommended width and height is 64px (128px for Retina version).', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_follow_item_3_heading',
		'label'             => esc_html__( 'Heading', 'flux' ),
		'section'           => 'theme_widget_follow',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'theme_widget_follow_item_3_subheading',
		'label'             => esc_html__( 'Subheading', 'flux' ),
		'section'           => 'theme_widget_follow',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	),
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'theme_widget_follow_item_3_url',
		'label'           => esc_html__( 'Link', 'flux' ),
		'section'         => 'theme_widget_follow',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_follow_item_3_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'theme_widget_follow_item_3_target',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'theme_widget_follow_item_3_avatar',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'theme_widget_follow_collapsible_visibility',
		'section'         => 'theme_widget_follow',
		'label'           => esc_html__( 'Visibility', 'flux' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'theme_widget_follow_visibility',
		'section'         => 'theme_widget_follow',
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
				'setting'  => 'theme_widget_follow_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);
