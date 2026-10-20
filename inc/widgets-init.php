<?php
/**
 * Widgets Init
 *
 * Register sidebar locations for widgets.
 *
 * @package Flux
 */

if ( ! function_exists( 'csco_widgets_init' ) ) {
	/**
	 * Register sidebars
	 */
	function csco_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Default Sidebar', 'flux' ),
				'id'            => 'sidebar-main',
				'before_widget' => '<div class="widget %1$s %2$s">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Off-canvas', 'flux' ),
				'id'            => 'sidebar-offcanvas',
				'before_widget' => '<div class="widget %1$s %2$s">',
				'after_widget'  => '</div>',
			)
		);
	}
	add_action( 'widgets_init', 'csco_widgets_init' );
}

/**
 * Build and cache custom widgets for a sidebar.
 *
 * @param string $sidebar_id Sidebar ID.
 * @return array[] Array of ['priority' => int, 'html' => string] sorted ASC.
 */
function csco_get_custom_widgets( $sidebar_id ) {

	static $cache = array();

	if ( isset( $cache[ $sidebar_id ] ) ) {
		return $cache[ $sidebar_id ];
	}

	$defs = csco_get_section_settings( 'sidebar' );

	$defs = apply_filters( 'csco_custom_widgets', $defs, $sidebar_id );

	$blocks = array();

	foreach ( $defs as $w ) {
		if ( 'none' === $w['display'] || $w['display'] !== $sidebar_id ) {
			continue;
		}

		if ( in_array( 'frontpage', $w['visibility'], true ) && is_front_page() ) {
			continue;
		}

		if ( in_array( 'homepage', $w['visibility'], true ) && is_home() ) {
			continue;
		}

		if ( in_array( 'category', $w['visibility'], true ) && is_category() ) {
			continue;
		}

		if ( in_array( 'post', $w['visibility'], true ) && is_single() ) {
			continue;
		}

		if ( in_array( 'page', $w['visibility'], true ) && is_page() ) {
			continue;
		}

		ob_start();
		do_action( "csco_{$w['slug']}_before" );

		get_template_part( 'template-parts/widgets/' . $w['slug'] );

		do_action( "csco_{$w['slug']}_after" );

		$html = ob_get_clean();

		$blocks[] = array(
			'priority' => (int) $w['priority'],
			'html'     => $html,
		);
	}

	usort(
		$blocks,
		static function ( $a, $b ) {
			return $a['priority'] <=> $b['priority'];
		}
	);

	$cache[ $sidebar_id ] = $blocks;

	return $cache[ $sidebar_id ];
}

/**
 * Sidebar custom-widget integration.
 *
 * Adds theme-controlled widgets (about, custom, …) into the regular
 * WordPress sidebar flow according to a numeric priority. Works without
 * buffering or regex-based HTML parsing; relies solely on core hooks.
 */

define( 'CSCO_WP_WIDGET_STEP', 10 );

$GLOBALS['csco_sidebar_state'] = array();

/**
 * Treat sidebar as “active” when it contains only custom widgets.
 *
 * @param bool   $active Whether the sidebar is active.
 * @param string $id     Sidebar ID.
 * @return bool
 */
add_filter(
	'is_active_sidebar',
	function ( $active, $id ) {
		return $active || ( ! is_admin() && ! empty( csco_get_custom_widgets( $id ) ) );
	},
	10,
	2
);

/**
 * Prepare sidebar state and output custom widgets with priority < 10.
 *
 * @hook dynamic_sidebar_before
 *
 * @param int|string $index   Sidebar index or ID.
 * @param array      $sidebar Sidebar args.
 */
add_action(
	'dynamic_sidebar_before',
	function ( $index, $sidebar ) {

		$id = is_int( $index ) ? $sidebar['id'] : $index;

		$GLOBALS['csco_sidebar_state'][ $id ] = array(
			'custom'   => csco_get_custom_widgets( $id ),
			'pointer'  => 0,
			'max'      => count( csco_get_custom_widgets( $id ) ),
			'wp_count' => 0,
		);

		csco_flush_custom_until( $id, CSCO_WP_WIDGET_STEP );
	},
	10,
	2
);

/**
 * Inject custom widgets between WordPress widgets.
 *
 * @hook dynamic_sidebar_params
 *
 * @param array $params Widget output parameters.
 * @return array
 */
add_filter(
	'dynamic_sidebar_params',
	function ( $params ) {

		$id = $params[0]['id'];
		$s  = &$GLOBALS['csco_sidebar_state'][ $id ];

		$s['wp_count'] = isset( $s['wp_count'] ) ? $s['wp_count'] : 0;

		$next_limit = ( $s['wp_count'] + 1 ) * CSCO_WP_WIDGET_STEP;

		ob_start();
		csco_flush_custom_until( $id, $next_limit );
		$inject = ob_get_clean();

		if ( $inject ) {
			$params[0]['before_widget'] = $inject . $params[0]['before_widget'];
		}

		$s['wp_count']++;

		return $params;
	},
	10,
	1
);

/**
 * Echo cached custom widgets while priority < $limit.
 *
 * @param string $sidebar_id Sidebar ID.
 * @param int    $limit      Upper bound (exclusive).
 */
function csco_flush_custom_until( $sidebar_id, $limit ) {

	if ( empty( $GLOBALS['csco_sidebar_state'][ $sidebar_id ] ) ) {
		return;
	}

	$s   = &$GLOBALS['csco_sidebar_state'][ $sidebar_id ];
	$ptr = &$s['pointer'];

	while ( $ptr < $s['max'] && $s['custom'][ $ptr ]['priority'] <= $limit ) {
		call_user_func( 'printf', '%s', $s['custom'][ $ptr ]['html'] . "\n" );

		++$ptr;
	}
}

/**
 * Output remaining custom widgets after the last WordPress widget.
 *
 * @hook dynamic_sidebar_after
 *
 * @param int|string $index   Sidebar index or ID.
 * @param array      $sidebar Sidebar args.
 */
add_action(
	'dynamic_sidebar_after',
	static function ( $index, $sidebar ) {
		$id = is_int( $index ) ? $sidebar['id'] : $index;

		csco_flush_custom_until( $id, PHP_INT_MAX );
	},
	10,
	2
);
