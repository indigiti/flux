<?php
/**
 * The template part for displaying header primary info.
 *
 * @package Flux
 */

$header_type = csco_get_page_header_type();

$overlapp_class = '';
if ( 'overlay' === $header_type || 'featured_overlap' === $header_type ) {
	$overlapp_class = 'cs-entry__title-line';
}


// Title.
the_title( '<h1 class="cs-entry__title ' . $overlapp_class . '"><span>', '</span></h1>' );

// Subtitle.
csco_post_subtitle();
