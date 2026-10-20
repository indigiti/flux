<?php
/**
 * Filters
 *
 * Filtering native WordPress and third-party plugins' functions.
 *
 * @package Flux
 */

if ( ! function_exists( 'csco_body_class' ) ) {
	/**
	 * Adds classes to <body> tag
	 *
	 * @param array $classes is an array of all body classes.
	 */
	function csco_body_class( $classes ) {

		// Page Layout.
		$classes[] = 'cs-page-layout-' . csco_get_page_sidebar();

		// Sticky Navbar.
		if ( get_theme_mod( 'navbar_sticky', true ) ) {
			$classes['navbar_sticky'] = 'cs-navbar-sticky-enabled';

			// Smart Navbar.
			if ( get_theme_mod( 'navbar_smart_sticky', true ) ) {
				$classes['navbar_sticky'] = 'cs-navbar-smart-enabled';
			}
		}

		// Sticky Sidebar.
		if ( get_theme_mod( 'misc_sticky_sidebar', true ) ) {
			$classes[] = 'cs-sticky-sidebar-enabled';

			$classes[] = get_theme_mod( 'misc_sticky_sidebar_method', 'cs-stick-to-top' );
		} else {
			$classes[] = 'cs-sticky-sidebar-disabled';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'csco_body_class' );

if ( ! function_exists( 'csco_kses_allowed_html' ) ) {
	/**
	 * Filters the HTML that is allowed for a given context.
	 *
	 * @param array  $tags    Tags by.
	 * @param string $context Context name.
	 */
	function csco_kses_allowed_html( $tags, $context ) {

		if ( 'content' === $context ) {
			$tags = array(
				'a'      => array(
					'class'  => true,
					'href'   => true,
					'title'  => true,
					'target' => true,
					'rel'    => true,
				),
				'div'    => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'span'   => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'img'    => array(
					'class'  => true,
					'id'     => true,
					'src'    => true,
					'rel'    => true,
					'srcset' => true,
					'size'   => true,
					'alt'    => true,
				),
				'br'     => array(),
				'b'      => array(),
				'strong' => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'i'      => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'p'      => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h1'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h2'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h3'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h4'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h5'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h6'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'script' => array(
					'src'         => true,
					'type'        => true,
					'async'       => true,
					'crossorigin' => true,
				),
				'ins'    => array(
					'class'          => true,
					'style'          => true,
					'data-ad-layout' => true,
					'data-ad-format' => true,
					'data-ad-client' => true,
					'data-ad-slot'   => true,
				),
			);
		}

		if ( 'common' === $context ) {
			$tags = wp_kses_allowed_html( 'post' );
		}

		return $tags;
	}
	add_filter( 'wp_kses_allowed_html', 'csco_kses_allowed_html', 10, 2 );
}

if ( ! function_exists( 'csco_safe_style_css' ) ) {
	/**
	 * Filters the list of allowed CSS attributes.
	 *
	 * @param array $attr Array of allowed CSS attributes.
	 */
	function csco_safe_style_css( $styles ) {
		$styles[] = 'display';

		return $styles;
	}
	add_filter( 'safe_style_css', 'csco_safe_style_css' );
}

if ( ! function_exists( 'csco_sitecontent_class' ) ) {
	/**
	 * Adds the classes for the site-content element.
	 *
	 * @param array $classes Classes to add to the class list.
	 */
	function csco_sitecontent_class( $classes ) {

		// Page Sidebar.
		if ( 'disabled' !== csco_get_page_sidebar() ) {
			$classes[] = 'cs-sidebar-enabled cs-sidebar-' . csco_get_page_sidebar();
		} else {
			$classes[] = 'cs-sidebar-disabled';
		}

		// Post Metabar.
		if ( true === get_theme_mod( 'post_metabar', false ) ) {
			$classes[] = 'cs-metabar-enabled';
		} else {
			$classes[] = 'cs-metabar-disabled';
		}

		return $classes;
	}
}
add_filter( 'csco_site_content_class', 'csco_sitecontent_class' );

if ( ! function_exists( 'csco_add_entry_class' ) ) {
	/**
	 * Add entry class to post_class
	 *
	 * @param array $classes One or more classes to add to the class list.
	 */
	function csco_add_entry_class( $classes ) {
		array_push( $classes, 'cs-entry', 'cs-video-wrap' );

		return $classes;
	}
}
add_filter( 'post_class', 'csco_add_entry_class' );

if ( ! function_exists( 'csco_remove_hentry_class' ) ) {
	/**
	 * Remove hentry from post_class
	 *
	 * @param array $classes One or more classes to add to the class list.
	 */
	function csco_remove_hentry_class( $classes ) {
		return array_diff( $classes, array( 'hentry' ) );
	}
}
add_filter( 'post_class', 'csco_remove_hentry_class' );

if ( ! function_exists( 'csco_max_srcset_image_width' ) ) {
	/**
	 * Changes max image width in srcset attribute
	 *
	 * @param int   $max_width  The maximum image width to be included in the 'srcset'. Default '1600'.
	 * @param array $size_array Array of width and height values in pixels (in that order).
	 */
	function csco_max_srcset_image_width( $max_width, $size_array ) {
		return 3840;
	}
}
add_filter( 'max_srcset_image_width', 'csco_max_srcset_image_width', 10, 2 );

if ( ! function_exists( 'csco_get_the_archive_title' ) ) {
	/**
	 * Archive Title
	 *
	 * Removes default prefixes, like "Category:" from archive titles.
	 *
	 * @param string $title Archive title.
	 */
	function csco_get_the_archive_title( $title ) {
		if ( is_category() ) {

			$title = single_cat_title( '', false );

		} elseif ( is_tag() ) {

			$title = single_tag_title( '', false );

		} elseif ( is_author() ) {

			$author_id = get_queried_object_id();
			$title     = get_the_author_meta( 'display_name', $author_id );

		}

		return $title;
	}
}
add_filter( 'get_the_archive_title', 'csco_get_the_archive_title' );

if ( ! function_exists( 'csco_excerpt_length' ) ) {
	/**
	 * Excerpt Length
	 *
	 * @param string $length of the excerpt.
	 */
	function csco_excerpt_length( $length ) {
		return 18;
	}
}
add_filter( 'excerpt_length', 'csco_excerpt_length' );

if ( ! function_exists( 'csco_strip_shortcode_from_excerpt' ) ) {
	/**
	 * Strip shortcodes from excerpt
	 *
	 * @param string $content Excerpt.
	 */
	function csco_strip_shortcode_from_excerpt( $content ) {
		$content = strip_shortcodes( $content );
		return $content;
	}
}
add_filter( 'the_excerpt', 'csco_strip_shortcode_from_excerpt' );

if ( ! function_exists( 'csco_strip_tags_from_excerpt' ) ) {
	/**
	 * Strip HTML from excerpt
	 *
	 * @param string $content Excerpt.
	 */
	function csco_strip_tags_from_excerpt( $content ) {
		$content = wp_strip_all_tags( $content );
		return $content;
	}
}
add_filter( 'the_excerpt', 'csco_strip_tags_from_excerpt' );

if ( ! function_exists( 'csco_excerpt_more' ) ) {
	/**
	 * Excerpt Suffix
	 *
	 * @param string $more suffix for the excerpt.
	 */
	function csco_excerpt_more( $more ) {
		return '&hellip;';
	}
}
add_filter( 'excerpt_more', 'csco_excerpt_more' );

if ( ! function_exists( 'csco_post_meta_process' ) ) {
	/**
	 * Pre processing post meta choices
	 *
	 * @param array $data Post meta list.
	 */
	function csco_post_meta_process( $data ) {
		if ( csco_post_views_enabled() ) {
			$data['views'] = esc_html__( 'Views', 'flux' );
		}
		return $data;
	}
}
add_filter( 'csco_post_meta_choices', 'csco_post_meta_process' );

if ( ! function_exists( 'csco_search_only_posts' ) ) {
	/**
	 * Search only posts.
	 *
	 * @param object $query The WP_Query instance (passed by reference).
	 */
	function csco_search_only_posts( $query ) {
		if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {
			$query->set( 'post_type', 'post' );
		}
	}
	add_action( 'pre_get_posts', 'csco_search_only_posts' );
}

if ( ! function_exists( 'csco_comment_form_default_fields' ) ) {
	/**
	 * Pre processing post meta choices
	 *
	 * @param string[] $fields Array of the default comment fields.
	 */
	function csco_comment_form_default_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$user      = wp_get_current_user();
		$req       = get_option( 'require_name_email' );
		$html_req  = ( $req ? " required='required'" : '' );

		$label_author = esc_html__( 'Your Name', 'flux' ) . ( $req ? ' *' : '' );
		$label_email  = esc_html__( 'Your E-mail', 'flux' ) . ( $req ? ' *' : '' );
		$label_url    = esc_html__( 'Your Website', 'flux' );

		$fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" placeholder="' . $label_author . '" ' . wp_kses( $html_req, 'csco' ) . '></p>';
		$fields['email']  = '<p class="comment-form-email"><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" placeholder="' . $label_email . '" ' . wp_kses( $html_req, 'csco' ) . '></p>';
		$fields['url']    = '<p class="comment-form-url"><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" placeholder="' . $label_url . '"></p>';
		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'csco_comment_form_default_fields' );

if ( ! function_exists( 'csco_comment_form_defaults' ) ) {
	/**
	 * Pre processing post meta choices
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	function csco_comment_form_defaults( $defaults ) {

		$label = esc_html__( 'Your Comment', 'flux' ) . ( ' *' );

		$defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . $label . '"></textarea></p>';

		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'csco_comment_form_defaults' );

if ( ! function_exists( 'csco_singular_register_options' ) ) {
	/**
	 * Register options for single and page
	 */
	function csco_singular_register_options() {
		$function = sprintf( 'add_meta_%s', 'box' );

		$function(
			'csco_singular_options',
			esc_html__( 'Singular Options', 'flux' ),
			function () {
				return __return_empty_string();
			},
			array( 'post', 'page' ),
			'side'
		);
	}
	add_action( sprintf( 'add_meta_%s', 'boxes' ), 'csco_singular_register_options' );
}

if ( ! function_exists( 'csco_exclude_archive_featured_posts_from_query' ) ) {
	/**
	 * Exclude Archive Header posts from the Main Query
	 *
	 * @param array $query Default query.
	 */
	function csco_exclude_archive_featured_posts_from_query( $query ) {
		if ( is_admin() ) {
			return $query;
		}

		if ( ! $query->is_main_query() ) {
			return $query;
		}

		$args = array();

		if ( $query->is_category() ) {

			$archive_featured_global = get_theme_mod( 'featured_archive', 'disabled' );
			$category_id             = get_queried_object_id();
			$archive_featured_local  = get_term_meta( $category_id, 'csco_featured_category', 'default' );

			if ( 'disabled' === $archive_featured_local || ( 'default' === $archive_featured_local && 'disabled' === $archive_featured_global ) ) {
				return $query;
			}

			$args = csco_get_archive_featured_query_args( array( 'location' => 'archive' ) );

		} else {

			return $query;

		}

		$args['fields'] = 'ids';

		$query_to_exclude = new WP_Query( $args );

		if ( isset( $query_to_exclude->posts ) && $query_to_exclude->posts ) {
			$post_ids = $query_to_exclude->posts;
		}

		if ( ! isset( $post_ids ) || ! $post_ids ) {
			return $query;
		}

		$query->set( 'post__not_in', array_merge( $query->get( 'post__not_in' ), $post_ids ) );

		return $query;
	}
}
add_action( 'pre_get_posts', 'csco_exclude_archive_featured_posts_from_query', 9999 );

/**
 * -------------------------------------------------------------------------
 * Render Blocks
 * -------------------------------------------------------------------------
 */

if ( ! function_exists( 'csco_custom_render_block_social_links' ) ) {
	/**
	 * Block Render Social Links
	 *
	 * @param string $block_content The content.
	 * @param array  $block         The block.
	 */
	function csco_custom_render_block_social_links( $block_content, $block ) {

		if ( 'core/social-links' === $block['blockName'] ) {
			$block_content = preg_replace_callback(
				'|<a(.*?)href="([^"]+)"|',
				function ( $matches ) {

					$domain = parse_url( $matches[2], PHP_URL_HOST );

					$title = explode( '.', str_replace( 'www.', '', $domain ) )[0];

					return '<a' . $matches[1] . 'href="' . $matches[2] . '"' . ( $title ? ' title="' . ucfirst( $title ) . '"' : '' );
				},
				$block_content
			);
		}

		return $block_content;
	}
}
add_filter( 'render_block', 'csco_custom_render_block_social_links', 10, 2 );

/**
 * -------------------------------------------------------------------------
 * Breadcrumbs separator
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'csco_replace_breadcrumb_separator' ) ) {
	/**
	 * Change the breadcrumbs HTML output.
	 *
	 * @param string $html HTML output.
	 */
	function csco_replace_breadcrumb_separator( $html ) {
		$breadcrumbs_separators = array(
			'#<span class="separator">(.*?)</span>#',
			'#<span class="aioseo-breadcrumb-separator">(.*?)</span>#',
		);

		$html = preg_replace( $breadcrumbs_separators, '<span class="cs-separator"></span>', $html );

		return $html;
	}
}
add_filter( 'rank_math/frontend/breadcrumb/html', 'csco_replace_breadcrumb_separator' );
add_filter( 'aioseo_breadcrumbs_separator', 'csco_replace_breadcrumb_separator' );

if ( ! function_exists( 'csco_comment_form_default_fields' ) ) {
	/**
	 * Customize the consent checkbox text in the comment form.
	 *
	 * @param array $fields The default comment form fields.
	 */
	function csco_comment_form_default_fields( $fields ) {
		$fields['cookies'] = '<p class="comment-form-cookies-consent">' .
				'<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">' .
				'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name and email in this browser for the next time I comment.', 'flux' ) . '</label>' .
				'</p>';
		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'csco_comment_form_default_fields' );

if ( ! function_exists( 'csco_update_post_reading_time' ) ) {
	/**
	 * Update Post Reading Time on Post Save
	 *
	 * @param int $post_id The post ID.
	 */
	function csco_update_post_reading_time( $post_id ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$reading_time = csco_calculate_post_reading_time( $post_id );

		update_post_meta( $post_id, '_csco_reading_time', $reading_time );
	}
}
add_action( 'save_post', 'csco_update_post_reading_time', 10, 1 );


if ( ! function_exists( 'csco_register_block_styles' ) ) {
	/**
	 * Register block styles.
	 */
	function csco_register_block_styles() {
		if ( ! function_exists( 'register_block_style' ) ) {
			return;
		}

		register_block_style(
			'core/heading',
			array(
				'name'  => 'cs-headline',
				'label' => esc_html__( 'Headline', 'flux' ),
			)
		);
	}
	add_action( 'init', 'csco_register_block_styles' );
}

if ( ! function_exists( 'csco_add_comments_popup_link_aria' ) ) {
	/**
	 * Add aria-label attribute to comment popup link attributes string.
	 *
	 * @param string $attrs Existing attributes string (e.g. ' rel="nofollow"').
	 * @return string Modified attributes string with aria-label appended.
	 */
	function csco_add_comments_popup_link_aria( $attrs ) {
		// Avoid duplication.
		if ( strpos( $attrs, 'aria-label' ) !== false ) {
			return $attrs;
		}

		// Try to get current post.
		global $post;
		if ( empty( $post ) || ! isset( $post->ID ) ) {
			return $attrs;
		}

		$post_title      = get_the_title( $post->ID );
		$comments_number = get_comments_number( $post->ID );

		if ( '0' === $comments_number ) {
			$label = sprintf(
			/* translators: %s: post title */
				esc_attr__( 'Leave a comment on %s', 'flux' ),
				$post_title
			);
		} else {
			$label = sprintf(
			/* translators: 1: number of comments, 2: post title */
				esc_attr__( 'View %1$d comments on %2$s', 'flux' ),
				$comments_number,
				$post_title
			);
		}

		// Append aria-label (note the leading space).
		$attrs .= ' aria-label="' . esc_attr( $label ) . '"';

		return $attrs;
	}

	add_filter( 'comments_popup_link_attributes', 'csco_add_comments_popup_link_aria' );
}
