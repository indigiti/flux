<?php
/**
 * Miscellaneous Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'miscellaneous',
	array(
		'title' => esc_html__( 'Miscellaneous Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_published_date',
		'label'    => esc_html__( 'Display published date instead of modified date', 'flux' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);


// Social Links section.
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_social_links_section',
		'label'       => esc_html__( 'Social Links', 'flux' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_links',
		'label'    => esc_html__( 'Enable social links', 'flux' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);


// Social 1.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_1',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 1', 'flux' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'flux' ),
			'preset' => esc_html__( 'Preset', 'flux' ),
			'custom' => esc_html__( 'Custom', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_1_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'flux' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'flux' ),
			'instagram' => esc_html__( 'Instagram', 'flux' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'flux' ),
			'youtube'   => esc_html__( 'Youtube', 'flux' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'flux' ),
			'pinterest' => esc_html__( 'Pinterest', 'flux' ),
			'dribbble'  => esc_html__( 'Dribbble', 'flux' ),
			'behance'   => esc_html__( 'Behance', 'flux' ),
			'reddit'    => esc_html__( 'Reddit', 'flux' ),
			'github'    => esc_html__( 'Github', 'flux' ),
			'telegram'  => esc_html__( 'Telegram', 'flux' ),
			'tiktok'    => esc_html__( 'TikTok', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_1_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>icon@2x.png</code>' . esc_html__( '. Recommended width and height is 20px (40px for Retina version).', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_1_label',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_1_url',
		'label'           => esc_html__( 'URL', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_1_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'misc_social_1_hr' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);


// Social 2.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_2',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 2', 'flux' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'flux' ),
			'preset' => esc_html__( 'Preset', 'flux' ),
			'custom' => esc_html__( 'Custom', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_2_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'flux' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'flux' ),
			'instagram' => esc_html__( 'Instagram', 'flux' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'flux' ),
			'youtube'   => esc_html__( 'Youtube', 'flux' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'flux' ),
			'pinterest' => esc_html__( 'Pinterest', 'flux' ),
			'dribbble'  => esc_html__( 'Dribbble', 'flux' ),
			'behance'   => esc_html__( 'Behance', 'flux' ),
			'reddit'    => esc_html__( 'Reddit', 'flux' ),
			'github'    => esc_html__( 'Github', 'flux' ),
			'telegram'  => esc_html__( 'Telegram', 'flux' ),
			'tiktok'    => esc_html__( 'TikTok', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_2_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>icon@2x.png</code>' . esc_html__( '. Recommended width and height is 20px (40px for Retina version).', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_2_label',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_2_url',
		'label'           => esc_html__( 'URL', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_2_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'misc_social_2_hr' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);


// Social 3.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_3',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 3', 'flux' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'flux' ),
			'preset' => esc_html__( 'Preset', 'flux' ),
			'custom' => esc_html__( 'Custom', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_3_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'flux' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'flux' ),
			'instagram' => esc_html__( 'Instagram', 'flux' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'flux' ),
			'youtube'   => esc_html__( 'Youtube', 'flux' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'flux' ),
			'pinterest' => esc_html__( 'Pinterest', 'flux' ),
			'dribbble'  => esc_html__( 'Dribbble', 'flux' ),
			'behance'   => esc_html__( 'Behance', 'flux' ),
			'reddit'    => esc_html__( 'Reddit', 'flux' ),
			'github'    => esc_html__( 'Github', 'flux' ),
			'telegram'  => esc_html__( 'Telegram', 'flux' ),
			'tiktok'    => esc_html__( 'TikTok', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_3_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>icon@2x.png</code>' . esc_html__( '. Recommended width and height is 20px (40px for Retina version).', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_3_label',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_3_url',
		'label'           => esc_html__( 'URL', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_3_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'misc_social_3_hr' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);


// Social 4.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_4',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 4', 'flux' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'flux' ),
			'preset' => esc_html__( 'Preset', 'flux' ),
			'custom' => esc_html__( 'Custom', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_4_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'flux' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'flux' ),
			'instagram' => esc_html__( 'Instagram', 'flux' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'flux' ),
			'youtube'   => esc_html__( 'Youtube', 'flux' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'flux' ),
			'pinterest' => esc_html__( 'Pinterest', 'flux' ),
			'dribbble'  => esc_html__( 'Dribbble', 'flux' ),
			'behance'   => esc_html__( 'Behance', 'flux' ),
			'reddit'    => esc_html__( 'Reddit', 'flux' ),
			'github'    => esc_html__( 'Github', 'flux' ),
			'telegram'  => esc_html__( 'Telegram', 'flux' ),
			'tiktok'    => esc_html__( 'TikTok', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_4_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>icon@2x.png</code>' . esc_html__( '. Recommended width and height is 20px (40px for Retina version).', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_4_label',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_4_url',
		'label'           => esc_html__( 'URL', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_4_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'misc_social_4_hr' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);


// Social 5.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_5',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 5', 'flux' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'flux' ),
			'preset' => esc_html__( 'Preset', 'flux' ),
			'custom' => esc_html__( 'Custom', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_5_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'flux' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'flux' ),
			'instagram' => esc_html__( 'Instagram', 'flux' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'flux' ),
			'youtube'   => esc_html__( 'Youtube', 'flux' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'flux' ),
			'pinterest' => esc_html__( 'Pinterest', 'flux' ),
			'dribbble'  => esc_html__( 'Dribbble', 'flux' ),
			'behance'   => esc_html__( 'Behance', 'flux' ),
			'reddit'    => esc_html__( 'Reddit', 'flux' ),
			'github'    => esc_html__( 'Github', 'flux' ),
			'telegram'  => esc_html__( 'Telegram', 'flux' ),
			'tiktok'    => esc_html__( 'TikTok', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_5_icon',
		'label'           => esc_html__( 'Icon', 'flux' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'flux' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'flux' ) . '<code>icon@2x.png</code>' . esc_html__( '. Recommended width and height is 20px (40px for Retina version).', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_5_label',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_5_url',
		'label'           => esc_html__( 'URL', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_5_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'flux' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'flux' ),
			'_blank' => esc_html__( 'In a new tab', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

// Sidebar Section.
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_sticky_sidebar_section',
		'label'       => esc_html__( 'Sticky Sidebar', 'flux' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_sticky_sidebar',
		'label'    => esc_html__( 'Enable sticky sidebar', 'flux' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'misc_sticky_sidebar_method',
		'label'           => esc_html__( 'Sticky Method', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => 'cs-stick-to-top',
		'choices'         => array(
			'cs-stick-to-top'    => esc_html__( 'Sidebar top edge', 'flux' ),
			'cs-stick-to-bottom' => esc_html__( 'Sidebar bottom edge', 'flux' ),
			'cs-stick-last'      => esc_html__( 'Last widget top edge', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_sticky_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_scroll_to_top_section',
		'label'       => esc_html__( 'Scroll to Top', 'flux' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_scroll_to_top',
		'label'    => esc_html__( 'Enable scroll to top button', 'flux' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

// Read Next section.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'misc_post_section',
		'section'  => 'miscellaneous',
		'label'    => esc_html__( 'Newest Posts', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_post',
		'label'    => esc_html__( 'Enable newest posts section', 'flux' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'misc_post_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'description'     => esc_html__( 'Select the pages where this section will be displayed.', 'flux' ),
		'section'         => 'miscellaneous',
		/**
		 * Contact section location.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_misc_post_location_choices',
			array(
				'is_search' => esc_html__( 'Search', 'flux' ),
				'is_404'    => esc_html__( '404 Page', 'flux' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'misc_post_heading',
		'label'             => esc_html__( 'Section Heading', 'flux' ),
		'section'           => 'miscellaneous',
		'default'           => esc_html__( 'Recommended for you', 'flux' ),
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'misc_post_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => array( 'category', 'author', 'date', 'comments' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_post_meta_choices',
			array(
				'category'     => esc_html__( 'Category', 'flux' ),
				'reading_time' => esc_html__( 'Reading time', 'flux' ),
				'author'       => esc_html__( 'Author', 'flux' ),
				'date'         => esc_html__( 'Date', 'flux' ),
				'comments'     => esc_html__( 'Comments', 'flux' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'misc_post_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_post_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'miscellaneous',
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
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_post_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'misc_post_divider' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_post_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs (max. 4). For example: 12, 34, 145. Leave empty for all posts.', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_post_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_post_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'flux' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),

		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'misc_post_filter_offset',
		'label'           => esc_html__( 'Offset', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => 0,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_post_sort_orderby',
		'label'           => esc_html__( 'Order By', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => 'date',
		'choices'         => array(
			'date'          => esc_html__( 'Published Date', 'flux' ),
			'modified'      => esc_html__( 'Modified Date', 'flux' ),
			'title'         => esc_html__( 'Title', 'flux' ),
			'rand'          => esc_html__( 'Random', 'flux' ),
			'views'         => esc_html__( 'Views', 'flux' ),
			'comment_count' => esc_html__( 'Comment Count', 'flux' ),
			'ID'            => esc_html__( 'ID', 'flux' ),
			'post__in'      => esc_html__( 'Custom', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'misc_post_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_post_time_frame',
		'label'           => esc_html__( 'Filter by Time Frame', 'flux' ),
		'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'misc_post_sort_orderby',
				'operator' => '==',
				'value'    => 'views',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_post_sort_order',
		'label'           => esc_html__( 'Order', 'flux' ),
		'section'         => 'miscellaneous',
		'default'         => 'DESC',
		'choices'         => array(
			'ASC'  => esc_html__( 'ASC', 'flux' ),
			'DESC' => esc_html__( 'DESC', 'flux' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_post',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'misc_post_sort_orderby',
				'operator' => '!=',
				'value'    => 'post__in',
			),
		),
	)
);
