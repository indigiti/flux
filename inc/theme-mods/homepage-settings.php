<?php
/**
 * Homepage Settings
 *
 * @package Flux
 */

/**
 * Removes default WordPress Static Front Page section
 * and re-adds it in our own panel with the same parameters.
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function csco_reorder_customizer_settings( $wp_customize ) {

	// Get current front page section parameters.
	$static_front_page = $wp_customize->get_section( 'static_front_page' );

	// Remove existing section, so that we can later re-add it to our panel.
	$wp_customize->remove_section( 'static_front_page' );

	// Re-add static front page section with a new name, but same description.
	$wp_customize->add_section(
		'static_front_page',
		array(
			'title'           => esc_html__( 'Display Settings', 'flux' ),
			'description'     => $static_front_page->description,
			'panel'           => 'home_panel',
			'active_callback' => $static_front_page->active_callback,
			'priority'        => 0,
		)
	);
}
add_action( 'customize_register', 'csco_reorder_customizer_settings' );

CSCO_Customizer::add_panel(
	'home_panel',
	array(
		'title' => esc_html__( 'Front & Static Pages', 'flux' ),
	)
);

/* ----------- Hero Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_hero_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Hero', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_hero_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_hero_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_hero_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Slider Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_slider_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Post Slider', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_slider_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_slider_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_slider_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_slider_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Tiles Posts Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_post_tiles_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Post Tile', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_post_tiles_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_tiles_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_tiles_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_post_tiles_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_tiles_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Grid Posts Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_post_grid_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Post Grid', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_post_grid_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_grid_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_post_grid_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_grid_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Post Cards Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_post_cards_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Post Cards', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_post_cards_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_post_cards_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_cards_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_post_cards_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_post_cards_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Categories Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_categories_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Categories', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_categories_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_categories_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_categories_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_categories_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Banner One Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_banner_one_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Banner 1', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_banner_one_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_banner_one_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_one_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_banner_one_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_one_display',
				'operator' => '!=',
				'value'    => 'none',
			),
		),
	)
);

/* ----------- Banner Two Section ----------- */

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_banner_two_collapsible',
		'section'     => 'static_front_page',
		'label'       => esc_html__( 'Banner 2', 'flux' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'select',
		'settings'    => 'home_banner_two_display',
		'label'       => esc_html__( 'Display section', 'flux' ),
		'section'     => 'static_front_page',
		'default'     => 'none',
		'choices'     => array(
			'before' => esc_html__( 'Before Latest Posts', 'flux' ),
			'after'  => esc_html__( 'After Latest Posts', 'flux' ),
			'none'   => esc_html__( 'None', 'flux' ),
		),
		'conditional' => 'home',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_banner_two_location',
		'label'           => esc_html__( 'Location', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 'homepage',
		'choices'         => array(
			'homepage' => esc_html__( 'Homepage', 'flux' ),
			'posts'    => esc_html__( 'Posts page', 'flux' ),
		),
		'conditional'     => 'home',
		'active_callback' => array(
			array(
				'setting'  => 'home_banner_two_display',
				'operator' => '!=',
				'value'    => 'none',
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_banner_two_order',
		'label'           => esc_html__( 'Order priority', 'flux' ),
		'section'         => 'static_front_page',
		'default'         => 10,
		'input_attrs'     => array(
			'min'  => 0,
			'max'  => 10000,
			'step' => 1,
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

require_once get_theme_file_path( '/inc/theme-mods/homepage/latest-posts.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/hero.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/post-slider.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/post-tile.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/post-grid.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/post-cards.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/categories.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/banner-one.php' );
require_once get_theme_file_path( '/inc/theme-mods/homepage/banner-two.php' );
