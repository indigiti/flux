<?php
/**
 * Typography
 *
 * @package Flux
 */

CSCO_Customizer::add_panel(
	'typography',
	array(
		'title' => esc_html__( 'Typography', 'flux' ),
	)
);

CSCO_Customizer::add_section(
	'typography_general',
	array(
		'title' => esc_html__( 'General', 'flux' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_base',
		'label'    => esc_html__( 'Base Font', 'flux' ),
		'section'  => 'typography_general',
		'default'  => array(
			'font-family'    => 'Inter',
			'variant'        => '500',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => '-0.02em',
			'line-height'    => '1.4',
		),
		'choices'  => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_primary',
		'label'       => esc_html__( 'Primary Font', 'flux' ),
		'description' => esc_html__( 'Used for buttons, and tags and other actionable elements.', 'flux' ),
		'section'     => 'typography_general',
		'default'     => array(
			'font-family'    => 'Satoshi',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_secondary',
		'label'       => esc_html__( 'Secondary Font', 'flux' ),
		'description' => esc_html__( 'Used for breadcrumbs and other secondary elements.', 'flux' ),
		'section'     => 'typography_general',
		'default'     => array(
			'font-family'    => 'Inter',
			'variant'        => '500',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.75rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'typography_advanced_settings',
		'label'    => esc_html__( 'Display advanced typography settings', 'flux' ),
		'section'  => 'typography_general',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_section_headings',
		'label'           => esc_html__( 'Section Headings Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.875rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_title',
		'label'           => esc_html__( 'Post Title Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Satoshi',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '3rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_subtitle',
		'label'           => esc_html__( 'Post Subtitle Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.375rem',
			'letter-spacing' => '-0.02em',
			'line-height'    => '1.5',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_category',
		'label'           => esc_html__( 'Post Category Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.625rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_meta',
		'label'           => esc_html__( 'Post Meta Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '500',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.75rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_content',
		'label'           => esc_html__( 'Post Content Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.125rem',
			'letter-spacing' => '-0.01em',
			'line-height'    => '1.7',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_input',
		'label'           => esc_html__( 'Input Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '500',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'line-height'    => '1.4',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_entry_title',
		'label'           => esc_html__( 'Entry Title Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Satoshi',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.02em',
			'line-height'    => '1.2',
			'text-transform' => 'none',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_excerpt',
		'label'           => esc_html__( 'Entry Excerpt Font', 'flux' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'Inter',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.875rem',
			'letter-spacing' => '-0.02em',
			'line-height'    => '1.6',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_section(
	'typography_logos',
	array(
		'title' => esc_html__( 'Logos', 'flux' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_main_logo',
		'label'           => esc_html__( 'Main Logo', 'flux' ),
		'description'     => esc_html__( 'The main logo is used in the navigation bar and mobile view of your website.', 'flux' ),
		'section'         => 'typography_logos',
		'default'         => array(
			'font-family'    => 'Archivo',
			'font-size'      => '2.75rem',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.05em',
			'line-height'    => '1',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'logo',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_mobile_logo',
		'label'           => esc_html__( 'Mobile Logo', 'flux' ),
		'description'     => esc_html__( 'The mobile logo is used in the site mobile view and in the sticky menu.', 'flux' ),
		'section'         => 'typography_logos',
		'default'         => array(
			'font-family'    => 'Archivo',
			'font-size'      => '2.75rem',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.05em',
			'line-height'    => '1',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'mobile_logo',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_footer_logo',
		'label'           => esc_html__( 'Footer Logo', 'flux' ),
		'description'     => esc_html__( 'The footer logo is used in the site footer in desktop and mobile view.', 'flux' ),
		'section'         => 'typography_logos',
		'default'         => array(
			'font-family'    => 'Archivo',
			'font-size'      => '2.75rem',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.05em',
			'line-height'    => '1',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'footer_logo',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_section(
	'typography_headings',
	array(
		'title' => esc_html__( 'Headings', 'flux' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_headings',
		'label'    => esc_html__( 'Headings', 'flux' ),
		'section'  => 'typography_headings',
		'default'  => array(
			'font-family'    => 'Satoshi',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'  => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'800',
				'800italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'typography_headings_collapsible',
		'section'     => 'typography_headings',
		'label'       => esc_html__( 'Headings Font Size', 'flux' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h1_size',
		'label'             => esc_html__( 'Heading 1', 'flux' ),
		'section'           => 'typography_headings',
		'default'           => '3rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-1-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h2_size',
		'label'             => esc_html__( 'Heading 2', 'flux' ),
		'section'           => 'typography_headings',
		'default'           => '2.25rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-2-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h3_size',
		'label'             => esc_html__( 'Heading 3', 'flux' ),
		'section'           => 'typography_headings',
		'default'           => '1.625rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-3-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h4_size',
		'label'             => esc_html__( 'Heading 4', 'flux' ),
		'section'           => 'typography_headings',
		'default'           => '1.375rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-4-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h5_size',
		'label'             => esc_html__( 'Heading 5', 'flux' ),
		'section'           => 'typography_headings',
		'default'           => '1.125rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-5-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h6_size',
		'label'             => esc_html__( 'Heading 6', 'flux' ),
		'section'           => 'typography_headings',
		'default'           => '1rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-6-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_section(
	'typography_navigation',
	array(
		'title' => esc_html__( 'Navigation', 'flux' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_menu',
		'label'       => esc_html__( 'Menu Font', 'flux' ),
		'description' => esc_html__( 'Used for main top level menu elements.', 'flux' ),
		'section'     => 'typography_navigation',
		'default'     => array(
			'font-family'    => 'Satoshi',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.25rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_submenu',
		'label'       => esc_html__( 'Submenu Font', 'flux' ),
		'description' => esc_html__( 'Used for submenu elements.', 'flux' ),
		'section'     => 'typography_navigation',
		'default'     => array(
			'font-family'    => 'Satoshi',
			'variant'        => '500',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.125rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_footer_menu',
		'label'    => esc_html__( 'Footer Menu Font', 'flux' ),
		'section'  => 'typography_navigation',
		'default'  => array(
			'font-family'    => 'Satoshi',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.25rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'  => array(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_footer_submenu',
		'label'    => esc_html__( 'Footer Submenu Font', 'flux' ),
		'section'  => 'typography_navigation',
		'default'  => array(
			'font-family'    => 'Satoshi',
			'variant'        => '500',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'  => array(),
	)
);
