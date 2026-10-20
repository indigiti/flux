<?php
/**
 * Post Settings
 *
 * @package Flux
 */

CSCO_Customizer::add_section(
	'post_settings',
	array(
		'title' => esc_html__( 'Post Settings', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'post_collapsible_common',
		'section'     => 'post_settings',
		'label'       => esc_html__( 'Common', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'post_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'flux' ),
		'section'  => 'post_settings',
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
		'settings' => 'post_header_type',
		'label'    => esc_html__( 'Default Page Header Type', 'flux' ),
		'section'  => 'post_settings',
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
		'type'     => 'multicheck',
		'settings' => 'post_meta',
		'label'    => esc_html__( 'Post Meta', 'flux' ),
		'section'  => 'post_settings',
		'default'  => array( 'category', 'reading_time', 'author', 'date', 'comments' ),
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
		'type'            => 'radio',
		'settings'        => 'post_media_preview',
		'label'           => esc_html__( 'Standard Page Header Preview', 'flux' ),
		'section'         => 'post_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'flux' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'flux' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'post_header_type',
					'operator' => '==',
					'value'    => 'standard',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_subtitle',
		'label'    => esc_html__( 'Display excerpt as post subtitle', 'flux' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_metabar',
		'label'    => esc_html__( 'Display metabar section', 'flux' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_comments_simple',
		'label'    => esc_html__( 'Display comments without the \'View Comments\' button', 'flux' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

// Post Footer.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_footer',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Post Footer', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_tags',
		'label'    => esc_html__( 'Display tags', 'flux' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'post_settings',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_footer',
		'label'    => esc_html__( 'Display post footer', 'flux' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_footer_category',
		'label'           => esc_html__( 'Display category', 'flux' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_footer_reading_time',
		'label'           => esc_html__( 'Display reading time', 'flux' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_footer_comments',
		'label'           => esc_html__( 'Display comments', 'flux' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_date_published',
		'label'           => esc_html__( 'Display published date', 'flux' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_date_updated',
		'label'           => esc_html__( 'Display updated date', 'flux' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_share',
		'label'           => esc_html__( 'Display share links', 'flux' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'share_divider' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'post_share',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'post_share_heading',
		'label'           => esc_html__( 'Heading', 'flux' ),
		'section'         => 'post_settings',
		'default'         => esc_html__( 'Share the Post with Your Besties', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'post_share',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_share_labels',
		'label'           => esc_html__( 'Display labels', 'flux' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_footer',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'post_share',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


// Read Next section.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_read_next',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Read Next', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_read_next',
		'label'    => esc_html__( 'Enable read next section', 'flux' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'post_read_next_heading',
		'label'             => esc_html__( 'Section Heading', 'flux' ),
		'section'           => 'post_settings',
		'default'           => esc_html__( 'You may be interested', 'flux' ),
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_posts',
		'label'           => esc_html__( 'Display posts', 'flux' ),
		'description'     => esc_html__( 'The section will display posts from the current category, published after the current post\'s date, before it, or the newest posts. In case fewer than six posts meet the requirements, the section will display other posts from the current category. In case there are fewer than six posts in the current category, the section will display posts from other categories.', 'flux' ),
		'section'         => 'post_settings',
		'default'         => 'after',
		'choices'         => apply_filters(
			'csco_header_layouts',
			array(
				'after'  => esc_html__( 'After current post date', 'flux' ),
				'before' => esc_html__( 'Before current post date', 'flux' ),
				'new'    => esc_html__( 'Newest posts', 'flux' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'post_read_next_number',
		'label'           => esc_html__( 'Number of posts', 'flux' ),
		'section'         => 'post_settings',
		'default'         => 4,
		'input_attrs'     => array(
			'min'  => 4,
			'max'  => 50,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'flux' ),
		'section'         => 'post_settings',
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
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_image_size',
		'label'           => esc_html__( 'Image Size', 'flux' ),
		'section'         => 'post_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'read_next_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'flux' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'post_read_next_meta',
		'label'           => esc_html__( 'Post Meta', 'flux' ),
		'section'         => 'post_settings',
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
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

// Auto Load next post.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_load_nextpost',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Auto Load Next Post', 'flux' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_load_nextpost',
		'label'    => esc_html__( 'Enable the auto load next post feature', 'flux' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_same_category',
		'label'           => esc_html__( 'Auto load posts from the same category only', 'flux' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_reverse',
		'label'           => esc_html__( 'Auto load previous posts instead of next ones', 'flux' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


// Banner after Post.
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'post_banner_after_collapsible',
		'label'       => esc_html__( 'Banner', 'flux' ),
		'section'     => 'post_settings',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_banner_after',
		'label'    => esc_html__( 'Enable banner after the post', 'flux' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'post_banner_after_html',
		'label'             => esc_html__( 'HTML Code', 'flux' ),
		'section'           => 'post_settings',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'post_banner_width_divider' ),
		'section'         => 'post_banner_after_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'settings'        => 'post_banner_after_width_heading',
		'label'           => esc_html__( 'Banner Width', 'flux' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_desktop',
		'label'           => esc_html__( 'Desktop', 'flux' ),
		'section'         => 'post_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'  => '.cs-banner-post-after',
				'property' => '--cs-banner-width',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_laptop',
		'label'           => esc_html__( 'Laptop', 'flux' ),
		'section'         => 'post_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_tablet',
		'label'           => esc_html__( 'Tablet', 'flux' ),
		'section'         => 'post_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_mobile',
		'label'           => esc_html__( 'Mobile', 'flux' ),
		'section'         => 'post_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'post_banner_after_label_divider' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_banner_after_label',
		'label'           => esc_html__( 'Display label', 'flux' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'post_banner_after_label_text',
		'label'           => esc_html__( 'Label', 'flux' ),
		'section'         => 'post_settings',
		'default'         => esc_html__( 'Advertisement', 'flux' ),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),

			array(
				'setting'  => 'post_banner_after_label',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'post_banner_after_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'flux' ),
		'section'         => 'post_settings',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'flux' ),
			'center' => esc_html__( 'Center', 'flux' ),
			'right'  => esc_html__( 'Right', 'flux' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-post-after',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'post_banner_after',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'post_banner_after_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
