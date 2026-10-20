<?php
/**
 * Colors
 *
 * @package Flux
 */

CSCO_Customizer::add_panel(
	'colors',
	array(
		'title' => esc_html__( 'Colors', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'color_scheme',
		'label'    => esc_html__( 'Site Color Scheme', 'flux' ),
		'section'  => 'colors',
		'default'  => 'system',
		'choices'  => array(
			'system' => esc_html__( 'User’s system preference', 'flux' ),
			'light'  => esc_html__( 'Light', 'flux' ),
			'dark'   => esc_html__( 'Dark', 'flux' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_scheme_toggle',
		'label'    => esc_html__( 'Enable dark/light mode toggle', 'flux' ),
		'section'  => 'colors',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background',
		'label'    => esc_html__( 'Site Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-site-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background_is_dark',
		'label'    => esc_html__( 'Site Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-site-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_background',
		'label'    => esc_html__( 'Header Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_background_is_dark',
		'label'    => esc_html__( 'Header Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_submenu_background',
		'label'    => esc_html__( 'Header Submenu Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_submenu_background_is_dark',
		'label'    => esc_html__( 'Header Submenu Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_topbar_background',
		'label'    => esc_html__( 'Header Topbar Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-topbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_topbar_background_is_dark',
		'label'    => esc_html__( 'Header Topbar Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-topbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_footer_background',
		'label'    => esc_html__( 'Footer Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-footer-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_footer_background_is_dark',
		'label'    => esc_html__( 'Footer Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-footer-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_offcanvas_background',
		'label'    => esc_html__( 'Offcanvas Menu Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-offcanvas-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_offcanvas_background_is_dark',
		'label'    => esc_html__( 'Offcanvas Menu Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-offcanvas-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_layout_background',
		'label'    => esc_html__( 'Layout Background', 'flux' ),
		'section'  => 'colors',
		'default'  => '#F4F4F4',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-layout-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_layout_background_is_dark',
		'label'    => esc_html__( 'Layout Background Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#3F3F3F',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-layout-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_primary',
		'label'    => esc_html__( 'Primary Color', 'flux' ),
		'section'  => 'colors',
		'default'  => '#000000',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-primary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_primary_color_is_dark',
		'label'    => esc_html__( 'Primary Color Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-primary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_secondary',
		'label'    => esc_html__( 'Secondary Color', 'flux' ),
		'section'  => 'colors',
		'default'  => '#6A6A6A',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-secondary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_secondary_color_is_dark',
		'label'    => esc_html__( 'Secondary Color Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#CBCBCB',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-secondary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_accent',
		'label'    => esc_html__( 'Accent Color', 'flux' ),
		'section'  => 'colors',
		'default'  => '#06845A',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-accent-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_accent_color_is_dark',
		'label'    => esc_html__( 'Accent Color Dark', 'flux' ),
		'section'  => 'colors',
		'default'  => '#06845A',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-accent-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_advanced_settings',
		'label'    => esc_html__( 'Display advanced color settings', 'flux' ),
		'section'  => 'colors',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => false,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_background',
		'label'           => esc_html__( 'Input Background', 'flux' ),
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-input-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_background_is_dark',
		'label'           => esc_html__( 'Input Background Dark', 'flux' ),
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-input-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input',
		'label'           => esc_html__( 'Input Color', 'flux' ),
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-input-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_color_is_dark',
		'label'           => esc_html__( 'Input Color Dark', 'flux' ),
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-input-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background',
		'label'           => esc_html__( 'Button Background', 'flux' ),
		'section'         => 'colors',
		'default'         => '#06845A',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_is_dark',
		'label'           => esc_html__( 'Button Background Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#06845A',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button',
		'label'           => esc_html__( 'Button Color', 'flux' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_color_is_dark',
		'label'           => esc_html__( 'Button Color Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover',
		'label'           => esc_html__( 'Button Hover Background', 'flux' ),
		'section'         => 'colors',
		'default'         => '#048258',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover_is_dark',
		'label'           => esc_html__( 'Button Hover Background Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#048258',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_hover',
		'label'           => esc_html__( 'Button Hover Color', 'flux' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_hover_color_is_dark',
		'label'           => esc_html__( 'Button Hover Color Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_tag',
		'label'           => esc_html__( 'Menu Tag Color', 'flux' ),
		'section'         => 'colors',
		'default'         => '#DB2546',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-tag-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_tag_is_dark',
		'label'           => esc_html__( 'Menu Tag Color Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#DB2546',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-tag-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_border',
		'label'           => esc_html__( 'Border Color', 'flux' ),
		'description'     => esc_html__( 'Used on Form Inputs, Separators etc.', 'flux' ),
		'section'         => 'colors',
		'default'         => '#E0E0E0',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-border-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_border_color_is_dark',
		'label'           => esc_html__( 'Border Color Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#4D4D4D',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-border-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_overlay',
		'label'           => esc_html__( 'Overlay Background', 'flux' ),
		'section'         => 'colors',
		'default'         => '#000000',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-overlay-background',
				'context'  => array( 'editor', 'front' ),
			),
			array(
				'element'  => ':root, [data-scheme="light"]',
				'property' => '--cs-light-overlay-background-rgb',
				'context'  => array( 'editor', 'front' ),
				'convert'  => 'rgb',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_overlay_color_is_dark',
		'label'           => esc_html__( 'Overlay Background Dark', 'flux' ),
		'section'         => 'colors',
		'default'         => '#000000',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-overlay-background',
				'context'  => array( 'editor', 'front' ),
			),
			array(
				'element'  => ':root, [data-scheme="dark"]',
				'property' => '--cs-dark-overlay-background-rgb',
				'context'  => array( 'editor', 'front' ),
				'convert'  => 'rgb',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_advanced_border_settings',
		'label'    => esc_html__( 'Display border radius settings', 'flux' ),
		'section'  => 'colors',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'color_border_settings',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_layout elements_border_radius',
		'label'             => esc_html__( 'Layout Elements Border Radius', 'flux' ),
		'description'       => esc_html__( 'Used on Form Elements, Blockquotes, Block Groups etc.', 'flux' ),
		'section'           => 'colors',
		'default'           => '4px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-layout-elements-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_thumbnail_border_radius',
		'label'             => esc_html__( 'Thumbnail Border Radius', 'flux' ),
		'section'           => 'colors',
		'default'           => '0px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-thumbnail-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_tag_border_radius',
		'label'             => esc_html__( 'Tag Border Radius', 'flux' ),
		'section'           => 'colors',
		'default'           => '0px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-tag-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_input_border_radius',
		'label'             => esc_html__( 'Input Border Radius', 'flux' ),
		'section'           => 'colors',
		'default'           => '4px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-input-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_button_border_radius',
		'label'             => esc_html__( 'Button Border Radius', 'flux' ),
		'section'           => 'colors',
		'default'           => '4px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-button-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
