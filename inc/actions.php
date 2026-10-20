<?php
/**
 * All core theme actions.
 *
 * Please do not modify this file directly.
 * You may remove actions in your child theme by using remove_action().
 *
 * Please see /inc/partials.php for the list of partials,
 * added to actions.
 *
 * @package Flux
 */

/**
 * Body
 */
add_action( 'csco_site_before', 'csco_offcanvas' );
add_action( 'csco_site_content_before', 'csco_theme_breadcrumbs', 1 );

/**
 * Singular
 */
add_action( 'csco_entry_content_before', 'csco_singular_post_type_before', 10 );
add_action( 'csco_entry_content_after', 'csco_singular_post_type_after', 999 );

/**
 * Entry Header
 */
add_action( 'csco_entry_wrap_start', 'csco_entry_header', 10 );
add_action( 'csco_entry_wrap_start', 'csco_entry_header_overlay_standard', 10 );

add_action( 'csco_site_content_start', 'csco_entry_header_featured', 10 );
add_action( 'csco_site_content_start', 'csco_entry_header_featured_overlap', 10 );
add_action( 'csco_site_content_start', 'csco_entry_header_overlay_full', 10 );


/**
 * Home Sections
 */
add_action( 'csco_site_content_before', 'csco_home_sections' );
add_action( 'csco_site_content_after', 'csco_home_sections' );

/**
 * Page Header
 */
add_action( 'csco_main_before', 'csco_page_header', 10 );
add_action( 'csco_main_before', 'csco_featured_archive', 20 );

/**
 * Entry Elements
 */
add_action( 'csco_entry_container_start', 'csco_entry_metabar', 10 );

/**
 * Entry Sections
 */
add_action( 'csco_entry_content_after', 'csco_page_pagination', 10 );
add_action( 'csco_entry_content_after', 'csco_entry_tags', 20 );
add_action( 'csco_entry_content_after', 'csco_entry_footer', 30 );
add_action( 'csco_main_content_after', 'csco_entry_read_next', 40 );
add_action( 'csco_entry_content_after', 'csco_entry_comments', 50 );
add_action( 'csco_main_content_after', 'csco_misc_posts', 60 );
add_action( 'csco_main_content_after', 'csco_entry_banner', 70 );
