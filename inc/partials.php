<?php
/**
 * These functions are used to load template parts (partials) or actions when used within action hooks,
 * and they probably should never be updated or modified.
 *
 * @package Flux
 */

if ( ! function_exists( 'csco_singular_post_type_before' ) ) {
	/**
	 * Add Before Singular Hooks for specific post type.
	 */
	function csco_singular_post_type_before() {
		if ( 'post' === get_post_type() ) {
			/**
			 * The csco_post_content_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_post_content_before' );
		}
		if ( 'page' === get_post_type() ) {
			/**
			 * The csco_page_content_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_page_content_before' );
		}
	}
}

if ( ! function_exists( 'csco_singular_post_type_after' ) ) {
	/**
	 * Add After Singular Hooks for specific post type.
	 */
	function csco_singular_post_type_after() {
		if ( 'post' === get_post_type() ) {
			/**
			 * The csco_post_content_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_post_content_after' );
		}
		if ( 'page' === get_post_type() ) {
			/**
			 * The csco_page_content_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_page_content_after' );
		}
	}
}

if ( ! function_exists( 'csco_home_sections' ) ) {
	/**
	 * Home Sections
	 */
	function csco_home_sections() {

		if ( ! ( is_front_page() || is_home() ) ) {
			return;
		}

		$sections = csco_get_section_settings( 'home' );

		usort(
			$sections,
			function ( $a, $b ) {
				return $a['priority'] <=> $b['priority'];
			}
		);

		foreach ( $sections as $section ) {
			if ( 'none' === $section['display'] ) {
				continue;
			}

			if ( doing_action( 'csco_site_content_before' ) && 'after' === $section['display'] ) {
				continue;
			}

			if ( doing_action( 'csco_site_content_after' ) && 'before' === $section['display'] ) {
				continue;
			}

			$visible = __return_true();

			if ( 'page' === get_option( 'show_on_front', 'posts' ) ) {
				$visible = __return_false();

				$page_on_front  = (int) get_option( 'page_on_front' );
				$page_for_posts = (int) get_option( 'page_for_posts' );

				if ( is_front_page() && 'homepage' === $section['location'] && $page_on_front && get_queried_object_id() === $page_on_front ) {
					$visible = __return_true();
				}

				if ( is_home() && 'posts' === $section['location'] && $page_for_posts && get_queried_object_id() === $page_for_posts ) {
					$visible = __return_true();
				}
			}

			if ( $visible ) {
				do_action( "csco_{$section['slug']}_before" );

				get_template_part( 'template-parts/sections/' . $section['slug'] );

				do_action( "csco_{$section['slug']}_after" );
			}
		}
	}
}

if ( ! function_exists( 'csco_offcanvas' ) ) {
	/**
	 * Off-canvas
	 */
	function csco_offcanvas() {
		get_template_part( 'template-parts/offcanvas' );
	}
}

if ( ! function_exists( 'csco_site_scheme' ) ) {
	/**
	 * Site Scheme
	 */
	function csco_site_scheme() {
		$site_scheme = csco_site_scheme_data();

		if ( ! $site_scheme ) {
			return;
		}

		call_user_func( 'printf', '%s', "data-scheme='{$site_scheme}'" );
	}
}

if ( ! function_exists( 'csco_site_search' ) ) {
	/**
	 * Site Search
	 */
	function csco_site_search() {
		if ( ! get_theme_mod( 'header_search_button', true ) ) {
			return;
		}
		get_template_part( 'template-parts/site-search' );
	}
}

if ( ! function_exists( 'csco_burger_menu' ) ) {
	/**
	 * Burger Menu
	 */
	function csco_burger_menu() {
		if ( ! get_theme_mod( 'header_offcanvas', true ) ) {
			return;
		}
		get_template_part( 'template-parts/burger-menu' );
	}
}

if ( ! function_exists( 'csco_site_nav_mobile' ) ) {
	/**
	 * Site Nav Mobile
	 */
	function csco_site_nav_mobile() {
		get_template_part( 'template-parts/site-nav-mobile' );
	}
}

if ( ! function_exists( 'csco_theme_breadcrumbs' ) ) {
	/**
	 * Theme Breadcrumbs
	 */
	function csco_theme_breadcrumbs() {
		/**
		 * The csco_theme_breadcrumbs hook.
		 *
		 * @since 1.0.0
		 */
		if ( ! apply_filters( 'csco_theme_breadcrumbs', true ) ) {
			return;
		}

		if ( is_front_page() || is_404() ) {
			return;
		}

		csco_breadcrumbs();
	}
}

if ( ! function_exists( 'csco_page_header' ) ) {
	/**
	 * Page Header
	 */
	function csco_page_header() {
		if ( ! ( is_home() || is_archive() || is_search() || is_404() ) ) {
			return;
		}
		get_template_part( 'template-parts/page-header' );
	}
}

if ( ! function_exists( 'csco_page_pagination' ) ) {
	/**
	 * Post Pagination
	 */
	function csco_page_pagination() {
		if ( ! is_singular() ) {
			return;
		}

		/**
		 * The csco_pagination_before hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_pagination_before' );

		wp_link_pages(
			array(
				'before'           => '<div class="navigation pagination posts-navigation"><div class="nav-links">',
				'after'            => '</div></div>',
				'link_before'      => '<span class="page-number">',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'nextpagelink'     => esc_html__( 'Next page', 'flux' ),
				'previouspagelink' => esc_html__( 'Previous page', 'flux' ),
			)
		);

		/**
		 * The csco_pagination_after hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_pagination_after' );
	}
}

if ( ! function_exists( 'csco_entry_breadcrumbs' ) ) {
	/**
	 * Entry Breadcrumbs
	 */
	function csco_entry_breadcrumbs() {
		csco_breadcrumbs();
	}
}

if ( ! function_exists( 'csco_featured_archive' ) ) {
	/**
	 * Archives Header.
	 */
	function csco_featured_archive() {
		if ( is_category() ) {
			$featured_archive_global = get_theme_mod( 'featured_archive', 'disabled' );
			$category_id             = get_queried_object_id();
			$featured_archive_local  = get_term_meta( $category_id, 'csco_featured_category', 'default' );

			if ( 'disabled' === $featured_archive_local || ( ( 'default' === $featured_archive_local || empty( $featured_archive_local ) ) && 'disabled' === $featured_archive_global ) ) {
				return;
			}

			get_template_part( 'template-parts/post-area/featured', 'archive' );
		}
	}
}

if ( ! function_exists( 'csco_entry_header' ) ) {
	/**
	 * Entry Header Standard & Title Only
	 */
	function csco_entry_header() {
		if ( ! is_singular() ) {
			return;
		}

		if ( ! ( 'standard' === csco_get_page_header_type() || 'title' === csco_get_page_header_type() ) ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-header-standard' );
	}
}

if ( ! function_exists( 'csco_entry_header_featured' ) ) {
	/**
	 * Entry Header Featured
	 */
	function csco_entry_header_featured() {
		if ( ! is_singular() ) {
			return;
		}

		if ( ! 'featured' === csco_get_page_header_type() ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-header-featured' );
	}
}

if ( ! function_exists( 'csco_entry_header_featured_overlap' ) ) {
	/**
	 * Entry Header Featured
	 */
	function csco_entry_header_featured_overlap() {
		if ( ! is_singular() ) {
			return;
		}

		if ( ! 'featured_overlap' === csco_get_page_header_type() ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-header-featured-overlap' );
	}
}

if ( ! function_exists( 'csco_entry_header_overlay_standard' ) ) {
	/**
	 * Entry Header Overlay
	 */
	function csco_entry_header_overlay_standard() {
		if ( ! is_singular() ) {
			return;
		}

		if ( ! 'overlay' === csco_get_page_header_type() || 'disabled' === csco_get_page_sidebar() ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-header-overlay' );
	}
}

if ( ! function_exists( 'csco_entry_header_overlay_full' ) ) {
	/**
	 * Entry Header Overlay
	 */
	function csco_entry_header_overlay_full() {
		if ( ! is_singular() ) {
			return;
		}

		if ( ! 'overlay' === csco_get_page_header_type() || 'disabled' !== csco_get_page_sidebar() ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-header-overlay' );
	}
}

if ( ! function_exists( 'csco_entry_metabar' ) ) {
	/**
	 * Entry Metabar
	 */
	function csco_entry_metabar() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_metabar', false ) ) {
			return;
		}

		?>
		<div class="cs-entry__metabar">
			<div class="cs-entry__metabar-inner">
				<div class="cs-entry__metabar-item cs-entry__metabar-share">
					<div role="button" class="cs-entry__metabar-toggle" aria-label="<?php echo esc_attr__( 'Share', 'flux' ); ?>">
						<i class="cs-icon cs-icon-more"></i>
					</div>
					<?php csco_component( 'share_links' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_entry_tags' ) ) {
	/**
	 * Entry Tags
	 */
	function csco_entry_tags() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_tags', true ) ) {
			return;
		}

		the_tags( '<div class="cs-entry__tags"><ul><li>', '</li><li>', '</li></ul></div>' );
	}
}

if ( ! function_exists( 'csco_entry_footer' ) ) {
	/**
	 * Entry Footer
	 */
	function csco_entry_footer() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_footer', true ) ) {
			return;
		}
		get_template_part( 'template-parts/entry/entry-footer' );
	}
}

if ( ! function_exists( 'csco_entry_comments' ) ) {
	/**
	 * Entry Comments
	 */
	function csco_entry_comments() {
		if ( post_password_required() ) {
			return;
		}

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
}

if ( ! function_exists( 'csco_entry_read_next' ) ) {
	/**
	 * Entry Read Next
	 */
	function csco_entry_read_next() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_read_next', true ) ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-read-next' );
	}
}

if ( ! function_exists( 'csco_misc_posts' ) ) {
	/**
	 * Newest Posts.
	 */
	function csco_misc_posts() {
		if ( false === get_theme_mod( 'misc_post', false ) ) {
			return;
		}

		global $wp_query;

		$locations = get_theme_mod( 'misc_post_location' );

		// Define a list of conditional checks.
		$checks = array(
			'is_404'    => is_404(),
			'is_search' => is_search() && ( 0 === $wp_query->found_posts ),
		);

		if ( $locations ) {
			foreach ( $locations as $location ) {
				if ( isset( $checks[ $location ] ) && $checks[ $location ] ) {
					csco_component( 'misc_newest_posts' );
					return;
				}
			}
		}
	}
}

if ( ! function_exists( 'csco_social_links' ) ) {
	/**
	 * Social Links
	 */
	function csco_social_links() {

		if ( false === get_theme_mod( 'misc_social_links', false ) ) {
			return;
		}

		get_template_part( 'template-parts/social-links' );
	}
}

if ( ! function_exists( 'csco_more_toggle' ) ) {
	/**
	 * Site More Toggle
	 */
	function csco_more_toggle() {
		if ( ! get_theme_mod( 'header_more', false ) ) {
			return;
		}
		get_template_part( 'template-parts/more' );
	}
}

if ( ! function_exists( 'csco_entry_banner' ) ) {
	/**
	 * Post Banner Section
	 */
	function csco_entry_banner() {
		if ( ! ( is_singular( 'post' ) || is_archive() ) ) {
			return;
		}

		if ( is_singular( 'post' ) && true === get_theme_mod( 'post_banner_after', false ) ) {

			$settings = array(
				'banner_section'    => 'post-after',
				'banner_html'       => get_theme_mod( 'post_banner_after_html' ),
				'banner_label'      => get_theme_mod( 'post_banner_after_label', true ),
				'banner_label_text' => get_theme_mod( 'post_banner_after_label_text', esc_html__( 'Advertisement', 'flux' ) ),
			);

			csco_banner( $settings );
		}

		if ( is_archive() && true === get_theme_mod( 'archive_banner_after', false ) ) {

			$settings = array(
				'banner_section'    => 'archive-after',
				'banner_html'       => get_theme_mod( 'archive_banner_after_html' ),
				'banner_label'      => get_theme_mod( 'archive_banner_after_label', true ),
				'banner_label_text' => get_theme_mod( 'archive_banner_after_label_text', esc_html__( 'Advertisement', 'flux' ) ),
			);

			csco_banner( $settings );
		}

		if ( is_author() && true === get_theme_mod( 'author_banner_after', false ) ) {

			$settings = array(
				'banner_section'    => 'author-after',
				'banner_html'       => get_theme_mod( 'author_banner_after_html' ),
				'banner_label'      => get_theme_mod( 'author_banner_after_label', true ),
				'banner_label_text' => get_theme_mod( 'author_banner_after_label_text', esc_html__( 'Advertisement', 'flux' ) ),
			);

			csco_banner( $settings );
		}

		if ( is_search() && true === get_theme_mod( 'search_banner_after', false ) ) {

			$settings = array(
				'banner_section'    => 'search-after',
				'banner_html'       => get_theme_mod( 'search_banner_after_html' ),
				'banner_label'      => get_theme_mod( 'search_banner_after_label', true ),
				'banner_label_text' => get_theme_mod( 'search_banner_after_label_text', esc_html__( 'Advertisement', 'flux' ) ),
			);

			csco_banner( $settings );
		}
	}
}
