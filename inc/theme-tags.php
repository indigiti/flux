<?php
/**
 * Template Tags
 *
 * Functions that are called directly from template parts or within actions.
 *
 * @package Flux
 */

if ( ! function_exists( 'csco_header_nav_menu' ) ) {
	class CSCO_NAV_Walker extends Walker_Nav_Menu {

		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 * @since 5.9.0 Renamed `$item` to `$data_object` and `$id` to `$current_object_id`
		 *              to match parent class for PHP 8 named parameter support.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output            Used to append additional content (passed by reference).
		 * @param WP_Post  $data_object       Menu item data object.
		 * @param int      $depth             Depth of menu item. Used for padding.
		 * @param stdClass $args              An object of wp_nav_menu() arguments.
		 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
		 */
		public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
			// Restores the more descriptive, specific name for use within this method.
			$menu_item = $data_object;

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
			$classes[] = 'menu-item-' . $menu_item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param WP_Post  $menu_item Menu item data object.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
			$atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
			if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
				$atts['rel'] = 'noopener';
			} else {
				$atts['rel'] = $menu_item->xfn;
			}
			$atts['href']         = ! empty( $menu_item->url ) ? $menu_item->url : '';
			$atts['aria-current'] = $menu_item->current ? 'page' : '';

			if ( '#' === trim( $menu_item->url ) ) {
					$atts['class'] = 'menu-item-without-link';
			}

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria-current The aria-current attribute.
			 * }
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/**
			 * The the_title hook.
			 *
			 * @since 1.0.0
			 */
			$title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title     The menu item's title.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

			$link_tag = 'a';

			$item_output  = $args->before;
			$item_output .= '<' . $link_tag . $attributes . '>';
			$item_output .= $args->link_before . '<span>' . $title . '</span>' . $args->link_after;
			$item_output .= '</' . $link_tag . '>';
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $menu_item   Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @since 3.0.0
		 * @since 5.9.0 Renamed `$item` to `$data_object` to match parent class for PHP 8 named parameter support.
		 *
		 * @see Walker::end_el()
		 *
		 * @param string   $output      Used to append additional content (passed by reference).
		 * @param WP_Post  $data_object Menu item data object. Not used.
		 * @param int      $depth       Depth of page. Not Used.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		public function end_el( &$output, $data_object, $depth = 0, $args = null ) {

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}

			$featured_menu       = get_post_meta( $data_object->ID, '_featured_menu_field', true );
			$featured_categories = get_post_meta( $data_object->ID, '_featured_menu_categories', true );

			if ( 'latest_posts' === $featured_menu ) {
				$category_id = $data_object->object_id;

				set_query_var( 'category_id', $category_id );

				ob_start();

				get_template_part( 'inc/featured-menu' );

				$output .= ob_get_clean();
			} elseif ( 'categories' === $featured_menu ) {
				set_query_var( 'featured_categories', $featured_categories );

				ob_start();

				get_template_part( 'inc/categories-menu' );

				$output .= ob_get_clean();
			}

			$output .= "</li>{$n}";
		}
	} // end of Walker.

	/**
	 * Header Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_nav_menu( $settings = array() ) {
		if ( ! get_theme_mod( 'header_navigation_menu', true ) ) {
			return;
		}

		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__nav-inner',
					'theme_location'  => 'primary',
					'container'       => 'nav',
					'container_class' => 'cs-header__nav',
					'walker'          => new CSCO_NAV_Walker(),
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_header_logo' ) ) {
	/**
	 * Header Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_logo( $settings = array() ) {

		$logo_default_name = 'logo';
		$logo_dark_name    = 'logo_dark';
		$logo_class        = null;

		$defaults = array(
			'variant' => null,
			'tag'     => 'div',
		);

		if ( is_front_page() && get_theme_mod( 'title_tag', true ) ) {
			$defaults['tag'] = 'h1';
		}

		$settings = apply_filters( 'csco_header_logo_settings', wp_parse_args( $settings, $defaults ) );

		// For hide logo.
		if ( 'hide' === $settings['variant'] ) {
			$logo_class = 'cs-logo-hide';
		}

		// Get default logo.
		$logo_url = get_theme_mod( $logo_default_name );

		$logo_id = attachment_url_to_postid( $logo_url );

		// Set mode of logo.
		$logo_mode = 'cs-logo-once';

		// Check display mode.
		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}

		// Logo tag
		$logo_tag = $settings['tag'];
		?>
		<<?php echo esc_html( $logo_tag ); ?> class="cs-logo">
			<a class="cs-header__logo <?php echo esc_attr( $logo_mode ); ?> <?php echo esc_attr( $logo_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {
				$logo_dark_url = get_theme_mod( $logo_dark_name ) ? get_theme_mod( $logo_dark_name ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-header__logo cs-logo-dark <?php echo esc_attr( $logo_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</<?php echo esc_html( $logo_tag ); ?>>
		<?php
	}
}

if ( ! function_exists( 'csco_header_offcanvas_toggle' ) ) {
	/**
	 * Header Offcanvas Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_offcanvas_toggle( $settings = array() ) {

		if ( csco_offcanvas_exists() ) {
			if ( ! isset( $settings['mobile'] ) ) {
				if ( ! get_theme_mod( 'header_offcanvas', false ) ) {
					return;
				}
			}

			?>
				<span class="cs-header__burger-toggle" role="button" aria-label="<?php echo esc_attr__( 'Burger menu button', 'flux' ); ?>">
					<i class="cs-icon cs-icon-menu"></i>
					<i class="cs-icon cs-icon-close"></i>
				</span>
				<span class="cs-header__offcanvas-toggle" role="button" aria-label="<?php echo esc_attr__( 'Mobile menu button', 'flux' ); ?>">
					<i class="cs-icon cs-icon-menu"></i>
				</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_follow' ) ) {
	/**
	 * Footer Follow
	 */
	function csco_footer_follow() {
		if ( ! get_theme_mod( 'footer_follow', false ) ) {
			return;
		}

		$footer_follow_heading = get_theme_mod( 'footer_follow_heading', esc_html__( 'Follow', 'flux' ) );
		?>
		<?php if ( csco_component( 'social_links', false ) ) { ?>
			<div class="cs-footer__follow">
				<?php if ( $footer_follow_heading ) { ?>
					<div class="cs-footer__follow-heading">
						<?php echo do_shortcode( $footer_follow_heading ); ?>
					</div>
				<?php } ?>
				<div class="cs-footer__follow-content">
					<?php csco_component( 'social_links' ); ?>
				</div>
			</div>
		<?php } ?>
		<?php
	}
}

if ( ! function_exists( 'csco_burger_follow' ) ) {
	/**
	 * Burger Menu Follow
	 */
	function csco_burger_follow() {
		if ( ! get_theme_mod( 'burger_menu_follow', false ) ) {
			return;
		}
		if ( ! get_theme_mod( 'footer_follow', false ) ) {
			return;
		}

		$burger_follow_heading = get_theme_mod( 'burger_menu_follow_heading', esc_html__( 'Follow', 'flux' ) );
		?>
		<?php if ( csco_component( 'social_links', false ) ) { ?>
			<div class="cs-burger-menu__follow">
				<?php if ( $burger_follow_heading ) { ?>
					<div class="cs-burger-menu__follow-heading">
						<?php echo do_shortcode( $burger_follow_heading ); ?>
					</div>
				<?php } ?>
				<div class="cs-burger-menu__follow-content">
					<?php csco_component( 'social_links' ); ?>
				</div>
			</div>
		<?php } ?>
		<?php
	}
}

if ( ! function_exists( 'csco_share_links' ) ) {
	/**
	 * Share Links section
	 */
	function csco_share_links() {
		?>

		<div class="cs-share">

			<?php
			$share_url = get_permalink();

			$text               = rawurlencode( html_entity_decode( get_the_title( get_the_ID() ) ) );
			$twitter_share_url  = esc_url( 'https://twitter.com/share?t=' . $text . '&url=' . $share_url, null, '' );
			$facebook_share_url = esc_url( 'https://www.facebook.com/sharer.php?text=' . $text . '&u=' . $share_url, null, '' );
			$reddit_share_url   = esc_url( 'https://www.reddit.com/submit?url=' . $share_url . '&title=' . $text, null, '' );
			?>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $facebook_share_url ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 28 28" fill="none"><g clip-path="url(#clip0_540_5982)"><g clip-path="url(#clip1_540_5982)"><rect width="28" height="28" rx="14" fill="#066BDE"/><path d="M16.1391 19.104H18.8127L19.8821 14.8263H16.1391V12.6874C16.1391 11.5865 16.1391 10.5485 18.278 10.5485H19.8821V6.95525C19.5338 6.909 18.217 6.80542 16.8266 6.80542C13.9236 6.80542 11.8613 8.57734 11.8613 11.8315V14.8263H8.65295V19.104H11.8613V28.1943H16.1391V19.104Z" fill="white"/></g></g><defs><clipPath id="clip0_540_5982"><rect width="28" height="28" rx="14" fill="white"/></clipPath><clipPath id="clip1_540_5982"><rect width="28" height="28" rx="14" fill="white"/></clipPath></defs></svg>
			</a>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $twitter_share_url ); ?>" title="<?php esc_attr_e( 'Share in Twitter', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 28 28" fill="none"><rect width="28" height="28" rx="14" fill="black"/><path d="M11.3556 7.77783H7L12.1401 14.6313L7.27997 20.2222H8.92888L12.9038 15.6496L16.3333 20.2223H20.6889L15.3326 13.0806L19.9423 7.77783H18.2934L14.5689 12.0623L11.3556 7.77783ZM16.9556 18.9778L9.48889 9.02228H10.7333L18.2 18.9778H16.9556Z" fill="white"/></svg>
			</a>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $reddit_share_url ); ?>" title="<?php esc_attr_e( 'Share in Reddit', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="16" fill="#FF4500"/><path d="M26.4748 16.1369C26.4779 16.3485 26.4514 16.5598 26.3953 16.7641C26.3392 16.9684 26.2542 17.1642 26.1428 17.3449C26.0317 17.5256 25.8954 17.6901 25.738 17.8334C25.5805 17.9767 25.4037 18.0972 25.2123 18.1914C25.2166 18.2478 25.2201 18.3046 25.2221 18.3614C25.2268 18.4746 25.2268 18.588 25.2221 18.7012C25.2201 18.758 25.2166 18.8147 25.2123 18.8711C25.2123 22.3314 21.1446 25.1429 16.1261 25.1429C11.1076 25.1429 7.03983 22.3314 7.03983 18.8711C7.03554 18.8147 7.03204 18.758 7.03009 18.7012C7.0254 18.588 7.0254 18.4746 7.03009 18.3614C7.03204 18.3046 7.03554 18.2478 7.03983 18.1914C6.74011 18.0549 6.4739 17.8554 6.25962 17.6068C6.04535 17.3582 5.88813 17.0665 5.79885 16.7517C5.70971 16.4368 5.69072 16.1065 5.7432 15.7836C5.79568 15.4607 5.91837 15.153 6.10276 14.8818C6.28699 14.6106 6.52855 14.3824 6.81066 14.213C7.09277 14.0436 7.40869 13.9371 7.73649 13.9008C8.06434 13.8644 8.39625 13.8991 8.70924 14.0024C9.02222 14.1058 9.30878 14.2754 9.54907 14.4994C9.99514 14.1998 10.4625 13.9325 10.9475 13.6996C11.4326 13.4671 11.934 13.2694 12.4479 13.1087C12.9619 12.9481 13.4871 12.8249 14.0189 12.7395C14.5508 12.6542 15.0885 12.6075 15.6274 12.5994L16.7807 7.23901C16.7935 7.17683 16.8189 7.11813 16.8551 7.06561C16.8909 7.01347 16.9373 6.96868 16.9907 6.9343C17.0445 6.89993 17.1045 6.87638 17.1676 6.86479C17.2303 6.85359 17.295 6.85475 17.3573 6.86827L21.1757 7.6252C21.5611 6.96906 22.37 6.68791 23.0842 6.96134C23.7984 7.23476 24.2067 7.98204 24.0469 8.72431C23.8876 9.46657 23.2073 9.98407 22.4428 9.94506C21.678 9.90606 21.0549 9.32213 20.9731 8.56751L17.6379 7.87237L16.6248 12.692C17.1571 12.7032 17.6881 12.7527 18.2134 12.8396C19.2651 13.0133 20.2861 13.3367 21.2447 13.7996C21.7235 14.0306 22.1848 14.2954 22.6252 14.5921C22.9418 14.2908 23.3397 14.0868 23.7707 14.0047C24.2017 13.9223 24.6476 13.9654 25.0545 14.1287C25.4615 14.2919 25.8121 14.5683 26.0641 14.9246C26.3161 15.281 26.4588 15.702 26.4748 16.1369ZM11.0079 18.2729C11.0866 18.4602 11.2011 18.6305 11.3461 18.7738C11.4906 18.9175 11.6624 19.031 11.8514 19.109C12.0406 19.1866 12.2433 19.2264 12.4479 19.2264C13.0784 19.2264 13.6465 18.8499 13.888 18.2729C14.1292 17.6956 13.9956 17.0313 13.5498 16.5895C13.1041 16.1477 12.4339 16.0152 11.8514 16.2543C11.2693 16.4937 10.8894 17.0568 10.8894 17.6817C10.8894 17.8844 10.9295 18.0852 11.0079 18.2729ZM19.9344 21.9811C20.0142 21.9039 20.0598 21.7985 20.0614 21.688C20.0629 21.5772 20.0197 21.4706 19.9418 21.3914C19.8638 21.3122 19.7575 21.2671 19.646 21.2655C19.5342 21.264 19.4267 21.3068 19.3367 21.3737C19.1023 21.5403 18.8541 21.6869 18.5948 21.812C18.3355 21.9371 18.0659 22.0404 17.789 22.1205C17.5124 22.2005 17.2291 22.2573 16.9428 22.2901C16.656 22.3229 16.3673 22.3314 16.0793 22.316C15.7918 22.3287 15.5035 22.3171 15.2179 22.2816C14.9322 22.2464 14.6501 22.187 14.3747 22.1039C14.0988 22.0213 13.8311 21.9155 13.5736 21.788C13.316 21.6606 13.0698 21.5115 12.8376 21.3428C12.7569 21.2771 12.6545 21.2435 12.55 21.2485C12.4456 21.2535 12.347 21.2972 12.273 21.3702C12.1994 21.4436 12.1553 21.5413 12.1503 21.6448C12.1452 21.7483 12.1791 21.8498 12.2453 21.9298C12.5192 22.1345 12.8103 22.3152 13.1154 22.4704C13.4205 22.6257 13.7388 22.7543 14.0661 22.8555C14.3934 22.9567 14.7289 23.0296 15.069 23.0741C15.4092 23.1181 15.7524 23.1331 16.0949 23.1192C16.4374 23.1331 16.7807 23.1181 17.1208 23.0741C17.8021 22.9852 18.4629 22.7811 19.0744 22.4704C19.3795 22.3152 19.6706 22.1345 19.9445 21.9298L19.9344 21.9811ZM19.6484 19.35C19.8596 19.3523 20.0692 19.3118 20.2644 19.2314C20.4596 19.1507 20.6361 19.0318 20.7834 18.8816C20.9307 18.7313 21.0452 18.5529 21.1208 18.3571C21.1964 18.1615 21.231 17.9527 21.2225 17.7434C21.2225 17.1186 20.8426 16.5555 20.2605 16.3161C19.678 16.077 19.0078 16.2095 18.5621 16.6513C18.1163 17.0931 17.9827 17.7573 18.2239 18.3347C18.4654 18.9117 19.0335 19.2882 19.664 19.2882L19.6484 19.35Z" fill="white"/></svg>
			</a>

			<a class="cs-share__link cs-share__copy-link" target="_blank" href="<?php echo esc_url( $share_url ); ?>" title="<?php esc_attr_e( 'Copy link', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16Z" fill="black"/><path d="M12.2856 12.1143V9.88568C12.2856 9.47541 12.6182 9.14282 13.0285 9.14282H21.9428C22.353 9.14282 22.6856 9.47541 22.6856 9.88568V20.2857C22.6856 20.696 22.353 21.0285 21.9428 21.0285H19.7142V23.2564C19.7142 23.6671 19.38 24 18.9663 24H10.0621C9.64906 24 9.31433 23.6697 9.31433 23.2564L9.31626 12.8578C9.31634 12.4471 9.65058 12.1143 10.0642 12.1143H12.2856ZM10.8018 13.6L10.8002 22.5142H18.2285V13.6H10.8018ZM13.7713 12.1143H19.7142V19.5428H21.1999V10.6285H13.7713V12.1143Z" fill="white"/></svg>
			</a>

		</div>

		<?php
	}
}

if ( ! function_exists( 'csco_post_footer_share_links' ) ) {
	/**
	 * Footer share Links section
	 */
	function csco_post_footer_share_links() {
		?>

		<div class="cs-share">

			<?php
			$share_url = get_permalink();

			$text               = rawurlencode( html_entity_decode( get_the_title( get_the_ID() ) ) );
			$twitter_share_url  = esc_url( 'https://twitter.com/share?t=' . $text . '&url=' . $share_url, null, '' );
			$facebook_share_url = esc_url( 'https://www.facebook.com/sharer.php?text=' . $text . '&u=' . $share_url, null, '' );
			$reddit_share_url   = esc_url( 'https://www.reddit.com/submit?url=' . $share_url . '&title=' . $text, null, '' );

			$post_share_labels = get_theme_mod( 'post_share_labels', true );
			?>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $facebook_share_url ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 28 28" fill="none"><g clip-path="url(#clip0_540_5982)"><g clip-path="url(#clip1_540_5982)"><rect width="28" height="28" rx="14" fill="#066BDE"/><path d="M16.1391 19.104H18.8127L19.8821 14.8263H16.1391V12.6874C16.1391 11.5865 16.1391 10.5485 18.278 10.5485H19.8821V6.95525C19.5338 6.909 18.217 6.80542 16.8266 6.80542C13.9236 6.80542 11.8613 8.57734 11.8613 11.8315V14.8263H8.65295V19.104H11.8613V28.1943H16.1391V19.104Z" fill="white"/></g></g><defs><clipPath id="clip0_540_5982"><rect width="28" height="28" rx="14" fill="white"/></clipPath><clipPath id="clip1_540_5982"><rect width="28" height="28" rx="14" fill="white"/></clipPath></defs></svg>
				<?php if ( $post_share_labels ) { ?>
					<span class="cs-share__label"><?php echo esc_html__( 'Facebook', 'flux' ); ?></span>
				<?php } ?>
			</a>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $twitter_share_url ); ?>" title="<?php esc_attr_e( 'Share in Twitter', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 28 28" fill="none"><rect width="28" height="28" rx="14" fill="black"/><path d="M11.3556 7.77783H7L12.1401 14.6313L7.27997 20.2222H8.92888L12.9038 15.6496L16.3333 20.2223H20.6889L15.3326 13.0806L19.9423 7.77783H18.2934L14.5689 12.0623L11.3556 7.77783ZM16.9556 18.9778L9.48889 9.02228H10.7333L18.2 18.9778H16.9556Z" fill="white"/></svg>
				<?php if ( $post_share_labels ) { ?>
					<span class="cs-share__label"><?php echo esc_html__( 'X', 'flux' ); ?></span>
				<?php } ?>
			</a>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $reddit_share_url ); ?>" title="<?php esc_attr_e( 'Share in Reddit', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="16" fill="#FF4500"/><path d="M26.4748 16.1369C26.4779 16.3485 26.4514 16.5598 26.3953 16.7641C26.3392 16.9684 26.2542 17.1642 26.1428 17.3449C26.0317 17.5256 25.8954 17.6901 25.738 17.8334C25.5805 17.9767 25.4037 18.0972 25.2123 18.1914C25.2166 18.2478 25.2201 18.3046 25.2221 18.3614C25.2268 18.4746 25.2268 18.588 25.2221 18.7012C25.2201 18.758 25.2166 18.8147 25.2123 18.8711C25.2123 22.3314 21.1446 25.1429 16.1261 25.1429C11.1076 25.1429 7.03983 22.3314 7.03983 18.8711C7.03554 18.8147 7.03204 18.758 7.03009 18.7012C7.0254 18.588 7.0254 18.4746 7.03009 18.3614C7.03204 18.3046 7.03554 18.2478 7.03983 18.1914C6.74011 18.0549 6.4739 17.8554 6.25962 17.6068C6.04535 17.3582 5.88813 17.0665 5.79885 16.7517C5.70971 16.4368 5.69072 16.1065 5.7432 15.7836C5.79568 15.4607 5.91837 15.153 6.10276 14.8818C6.28699 14.6106 6.52855 14.3824 6.81066 14.213C7.09277 14.0436 7.40869 13.9371 7.73649 13.9008C8.06434 13.8644 8.39625 13.8991 8.70924 14.0024C9.02222 14.1058 9.30878 14.2754 9.54907 14.4994C9.99514 14.1998 10.4625 13.9325 10.9475 13.6996C11.4326 13.4671 11.934 13.2694 12.4479 13.1087C12.9619 12.9481 13.4871 12.8249 14.0189 12.7395C14.5508 12.6542 15.0885 12.6075 15.6274 12.5994L16.7807 7.23901C16.7935 7.17683 16.8189 7.11813 16.8551 7.06561C16.8909 7.01347 16.9373 6.96868 16.9907 6.9343C17.0445 6.89993 17.1045 6.87638 17.1676 6.86479C17.2303 6.85359 17.295 6.85475 17.3573 6.86827L21.1757 7.6252C21.5611 6.96906 22.37 6.68791 23.0842 6.96134C23.7984 7.23476 24.2067 7.98204 24.0469 8.72431C23.8876 9.46657 23.2073 9.98407 22.4428 9.94506C21.678 9.90606 21.0549 9.32213 20.9731 8.56751L17.6379 7.87237L16.6248 12.692C17.1571 12.7032 17.6881 12.7527 18.2134 12.8396C19.2651 13.0133 20.2861 13.3367 21.2447 13.7996C21.7235 14.0306 22.1848 14.2954 22.6252 14.5921C22.9418 14.2908 23.3397 14.0868 23.7707 14.0047C24.2017 13.9223 24.6476 13.9654 25.0545 14.1287C25.4615 14.2919 25.8121 14.5683 26.0641 14.9246C26.3161 15.281 26.4588 15.702 26.4748 16.1369ZM11.0079 18.2729C11.0866 18.4602 11.2011 18.6305 11.3461 18.7738C11.4906 18.9175 11.6624 19.031 11.8514 19.109C12.0406 19.1866 12.2433 19.2264 12.4479 19.2264C13.0784 19.2264 13.6465 18.8499 13.888 18.2729C14.1292 17.6956 13.9956 17.0313 13.5498 16.5895C13.1041 16.1477 12.4339 16.0152 11.8514 16.2543C11.2693 16.4937 10.8894 17.0568 10.8894 17.6817C10.8894 17.8844 10.9295 18.0852 11.0079 18.2729ZM19.9344 21.9811C20.0142 21.9039 20.0598 21.7985 20.0614 21.688C20.0629 21.5772 20.0197 21.4706 19.9418 21.3914C19.8638 21.3122 19.7575 21.2671 19.646 21.2655C19.5342 21.264 19.4267 21.3068 19.3367 21.3737C19.1023 21.5403 18.8541 21.6869 18.5948 21.812C18.3355 21.9371 18.0659 22.0404 17.789 22.1205C17.5124 22.2005 17.2291 22.2573 16.9428 22.2901C16.656 22.3229 16.3673 22.3314 16.0793 22.316C15.7918 22.3287 15.5035 22.3171 15.2179 22.2816C14.9322 22.2464 14.6501 22.187 14.3747 22.1039C14.0988 22.0213 13.8311 21.9155 13.5736 21.788C13.316 21.6606 13.0698 21.5115 12.8376 21.3428C12.7569 21.2771 12.6545 21.2435 12.55 21.2485C12.4456 21.2535 12.347 21.2972 12.273 21.3702C12.1994 21.4436 12.1553 21.5413 12.1503 21.6448C12.1452 21.7483 12.1791 21.8498 12.2453 21.9298C12.5192 22.1345 12.8103 22.3152 13.1154 22.4704C13.4205 22.6257 13.7388 22.7543 14.0661 22.8555C14.3934 22.9567 14.7289 23.0296 15.069 23.0741C15.4092 23.1181 15.7524 23.1331 16.0949 23.1192C16.4374 23.1331 16.7807 23.1181 17.1208 23.0741C17.8021 22.9852 18.4629 22.7811 19.0744 22.4704C19.3795 22.3152 19.6706 22.1345 19.9445 21.9298L19.9344 21.9811ZM19.6484 19.35C19.8596 19.3523 20.0692 19.3118 20.2644 19.2314C20.4596 19.1507 20.6361 19.0318 20.7834 18.8816C20.9307 18.7313 21.0452 18.5529 21.1208 18.3571C21.1964 18.1615 21.231 17.9527 21.2225 17.7434C21.2225 17.1186 20.8426 16.5555 20.2605 16.3161C19.678 16.077 19.0078 16.2095 18.5621 16.6513C18.1163 17.0931 17.9827 17.7573 18.2239 18.3347C18.4654 18.9117 19.0335 19.2882 19.664 19.2882L19.6484 19.35Z" fill="white"/></svg>
				<?php if ( $post_share_labels ) { ?>
					<span class="cs-share__label"><?php echo esc_html__( 'Reddit', 'flux' ); ?></span>
			<?php } ?>
			</a>

			<a class="cs-share__link cs-share__copy-link" target="_blank" href="<?php echo esc_url( $share_url ); ?>" title="<?php esc_attr_e( 'Copy link', 'flux' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16Z" fill="black"/><path d="M12.2856 12.1143V9.88568C12.2856 9.47541 12.6182 9.14282 13.0285 9.14282H21.9428C22.353 9.14282 22.6856 9.47541 22.6856 9.88568V20.2857C22.6856 20.696 22.353 21.0285 21.9428 21.0285H19.7142V23.2564C19.7142 23.6671 19.38 24 18.9663 24H10.0621C9.64906 24 9.31433 23.6697 9.31433 23.2564L9.31626 12.8578C9.31634 12.4471 9.65058 12.1143 10.0642 12.1143H12.2856ZM10.8018 13.6L10.8002 22.5142H18.2285V13.6H10.8018ZM13.7713 12.1143H19.7142V19.5428H21.1999V10.6285H13.7713V12.1143Z" fill="white"/></svg>
				<?php if ( $post_share_labels ) { ?>
					<span class="cs-share__label"><?php echo esc_html__( 'Copy Link', 'flux' ); ?></span>
				<?php } ?>
			</a>

		</div>

		<?php
	}
}

if ( ! function_exists( 'csco_header_search_toggle' ) ) {
	/**
	 * Header Search Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_search_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'header_search_button', true ) ) {
			return;
		}
		?>
		<div role="button" class="cs-header__toggle cs-header__search-toggle" aria-label="<?php echo esc_attr__( 'Search', 'flux' ); ?>">
			<i class="cs-icon cs-icon-search"></i>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_search_toggle_labeled' ) ) {
	/**
	 * Header Search Toggle Labeled
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_search_toggle_labeled( $settings = array() ) {
		if ( ! get_theme_mod( 'header_search_button', true ) ) {
			return;
		}
		?>
		<div role="button" class="cs-header__toggle-labeled cs-header__search-toggle" aria-label="<?php echo esc_attr__( 'Search', 'flux' ); ?>">
			<i class="cs-icon cs-icon-search"></i>
			<span class="cs-header__toggle-label">
				<?php echo esc_html__( 'Search', 'flux' ); ?>
			</span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle' ) ) {
	/**
	 * Header Scheme Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
		<div role="button" class="cs-header__toggle cs-header__scheme-toggle cs-site-scheme-toggle" aria-label="<?php echo esc_attr__( 'Scheme Toggle', 'flux' ); ?>">
			<span class="cs-header__scheme-toggle-icons">
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
			</span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle_labeled' ) ) {
	/**
	 * Header Scheme Toggle Labeled
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle_labeled( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
		<div role="button" class="cs-header__toggle-labeled cs-header__toggle-labeled cs-header__scheme-toggle cs-site-scheme-toggle" aria-label="<?php echo esc_attr__( 'Scheme Toggle', 'flux' ); ?>">
			<span class="cs-header__scheme-toggle-icons">
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
			</span>
			<span class="cs-header__toggle-label">
				<span class="cs-display-only-light"><?php echo esc_html__( 'Dark Mode', 'flux' ); ?></span>
				<span class="cs-display-only-dark"><?php echo esc_html__( 'Light Mode', 'flux' ); ?></span>
			</span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle_mobile' ) ) {
	/**
	 * Header Scheme Toggle Mobile
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle_mobile( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
		<span role="button" class="cs-header__scheme-toggle cs-header__scheme-toggle-mobile cs-site-scheme-toggle" aria-label="<?php echo esc_attr__( 'Scheme Toggle', 'flux' ); ?>">
			<span class="cs-header__scheme-toggle-icons">
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
			</span>
		</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_custom_button' ) ) {
	/**
	 * Header Custom Button
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_custom_button( $settings = array() ) {
		if ( ! get_theme_mod( 'header_custom_button', true ) ) {
			return;
		}

		$button = get_theme_mod( 'header_custom_button_label' );
		$link   = get_theme_mod( 'header_custom_button_link' );
		$target = get_theme_mod( 'header_custom_button_target', '_self' );

		if ( $button && $link ) {
			?>
			<a class="cs-button cs-button-animated cs-header__custom-button" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<span>
					<span><?php echo wp_kses( $button, 'content' ); ?></span>
					<span><?php echo wp_kses( $button, 'content' ); ?></span>
				</span>
			</a>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_header_burger_post' ) ) {
	/**
	 * Header Burger Posts
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_burger_post( $settings = array() ) {
		if ( ! get_theme_mod( 'header_burger_post', false ) ) {
			return;
		}

		$burger_post_heading = get_theme_mod( 'header_burger_post_heading', esc_html__( 'Popular Posts', 'flux' ) );

		$query_args = array(
			'filter_posts'      => get_theme_mod( 'header_burger_filter_posts' ),
			'filter_categories' => get_theme_mod( 'header_burger_filter_categories' ),
			'filter_tags'       => get_theme_mod( 'header_burger_filter_tags' ),
			'filter_offset'     => get_theme_mod( 'header_burger_filter_offset', 0 ),
			'orderby'           => get_theme_mod( 'header_burger_sort_orderby', 'date' ),
			'time_frame'        => get_theme_mod( 'header_burger_time_frame' ),
			'order'             => get_theme_mod( 'header_burger_sort_order', 'DESC' ),
			'number_items'      => 2,
		);

		$query = new WP_Query( csco_build_custom_query_args( $query_args ) );

		if ( $query->have_posts() ) {
			?>
			<div class="cs-posts-area-posts">
				<?php if ( $burger_post_heading ) { ?>
					<div class="cs-burger-menu__heading"><?php echo esc_html( $burger_post_heading ); ?></div>
				<?php } ?>
				<div class="cs-burger-menu__post-area cs-posts-area__grid cs-posts-area__main">
					<?php
					$current = 1;
					while ( $query->have_posts() ) {
						$query->the_post();

						get_template_part(
							'template-parts/post-area/card',
							'overlay',
							array(
								'image_orientation' => get_theme_mod( 'header_burger_post_image_orientation', 'landscape-16-9' ),
								'image_size'        => get_theme_mod( 'header_burger_post_image_size', 'csco-thumbnail' ),
								'image_lazyload'    => 'lazy',
								'meta'              => get_theme_mod( 'header_burger_post_meta', array( 'category', 'author', 'date', 'comments' ) ),
								'excerpt'           => false,
								'location'          => 'burger_menu',
								'current_post'      => $current,
							)
						);

						++$current;
					}
					?>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
}

if ( ! function_exists( 'csco_search_categories' ) ) {
	/**
	 * Header Search Categories
	 */
	function csco_search_categories() {
		$search_heading = get_theme_mod( 'header_search_categories_heading', esc_html__( 'Popular Searches', 'flux' ) );

		$taxonomy_slugs = get_theme_mod( 'header_search_categories_filter_slugs' );
		$args           = array(
			'taxonomy'   => 'category',
			'hide_empty' => true,
			'orderby'    => get_theme_mod( 'header_search_categories_sort_orderby', 'name' ),
			'order'      => get_theme_mod( 'header_search_categories_sort_order', 'ASC' ),
			'number'     => get_theme_mod( 'header_search_categories_limit', 4 ),
		);

		$filter_slug = ! empty( $taxonomy_slugs ) ? explode( ',', $taxonomy_slugs ) : array();

		if ( ! empty( $filter_slug ) ) {
			$args['slug']   = $filter_slug;
			$args['number'] = 0;
		}

		$terms = get_terms( $args );

		if ( $terms ) {
			?>
			<div class="cs-search__categories">
				<?php if ( $search_heading ) { ?>
					<div class="cs-search__categories-header">
						<?php echo wp_kses( $search_heading, 'content' ); ?>
					</div>
				<?php } ?>
				<div class="cs-entry__post-meta">
					<ul class="cs-search__categories post-categories">
						<?php
						foreach ( $terms as $term_item ) {
							?>
							<li>
								<a href="<?php echo esc_url( get_category_link( $term_item->term_id ) ); ?>" rel="category tag">
									<?php echo esc_attr( $term_item->name ); ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_search_tags' ) ) {
	/**
	 * Search Tags.
	 */
	function csco_search_tags() {
		$heading          = get_theme_mod( 'search_tags_heading', esc_html__( 'Popular Searches', 'flux' ) );
		$taxonomy_name    = get_theme_mod( 'search_tags_taxonomy_type', 'category' );
		$taxonomy_slugs   = get_theme_mod( 'search_tags_filter_slugs' );
		$taxonomy_orderby = get_theme_mod( 'search_tags_sort_orderby', 'name' );
		$taxonomy_order   = get_theme_mod( 'search_tags_sort_order', 'ASC' );
		$taxonomy_limit   = get_theme_mod( 'search_tags_limit', 4 );

		$args = array(
			'taxonomy'   => $taxonomy_name,
			'orderby'    => $taxonomy_orderby,
			'order'      => $taxonomy_order,
			'number'     => $taxonomy_limit,
			'hide_empty' => true,
		);

		$filter_slug = ! empty( $taxonomy_slugs ) ? explode( ',', $taxonomy_slugs ) : array();

		if ( ! empty( $filter_slug ) ) {
			$args['slug']   = $filter_slug;
			$args['number'] = 0;
		}

		$terms = get_terms( $args );

		if ( $terms ) {
			?>
			<div class="cs-search__popular">
				<?php if ( $heading ) { ?>
					<div class="cs-search__popular__header">
						<?php echo esc_html( $heading ); ?>
					</div>
				<?php } ?>
				<div class="cs-entry__post-meta">
					<ul class="cs-search__popular-categories post-categories">
						<?php
						foreach ( $terms as $term_item ) {
							?>
							<li>
								<a href="<?php echo esc_url( get_category_link( $term_item->term_id ) ); ?>" rel="category tag">
									<?php echo esc_attr( $term_item->name ); ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_header_search_post' ) ) {
	/**
	 * Header Burger Posts
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_search_post( $settings = array() ) {
		if ( ! get_theme_mod( 'header_search_post', false ) ) {
			return;
		}

		$post_heading = get_theme_mod( 'header_search_post_heading', esc_html__( 'Popular posts', 'flux' ) );

		$query_args = array(
			'filter_posts'      => get_theme_mod( 'header_search_filter_posts' ),
			'filter_categories' => get_theme_mod( 'header_search_filter_categories' ),
			'filter_tags'       => get_theme_mod( 'header_search_filter_tags' ),
			'filter_offset'     => get_theme_mod( 'header_search_filter_offset', 0 ),
			'orderby'           => get_theme_mod( 'header_search_sort_orderby', 'date' ),
			'time_frame'        => get_theme_mod( 'header_search_time_frame' ),
			'order'             => get_theme_mod( 'header_search_sort_order', 'DESC' ),
			'number_items'      => 2,
		);

		$query = new WP_Query( csco_build_custom_query_args( $query_args ) );

		if ( $query->have_posts() ) {
			?>
			<div class="cs-posts-area__outer">
				<?php if ( $post_heading ) { ?>
					<div class="cs-posts-area__header">
						<?php echo wp_kses( $post_heading, 'content' ); ?>
					</div>
				<?php } ?>
				<div class="cs-search__post-area cs-posts-area__grid cs-posts-area__main">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();

						get_template_part(
							'template-parts/post-area/card',
							'overlay',
							array(
								'image_orientation' => get_theme_mod( 'header_search_post_image_orientation', 'landscape-16-9' ),
								'image_size'        => get_theme_mod( 'header_search_post_image_size', 'csco-thumbnail' ),
								'image_lazyload'    => 'lazy',
								'meta'              => get_theme_mod( 'header_search_post_meta', array( 'category', 'author', 'date', 'comments' ) ),
								'excerpt'           => false,
								'location'          => 'header_search',
							)
						);
					}
					?>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
}

if ( ! function_exists( 'csco_misc_newest_posts' ) ) {
	/**
	 * Miscellaneous Posts
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_misc_newest_posts( $settings = array() ) {
		if ( ! get_theme_mod( 'misc_post', false ) ) {
			return;
		}

		$misc_post_heading = get_theme_mod( 'misc_post_heading', esc_html__( 'Recommended for you', 'flux' ) );

		$query_args = array(
			'filter_posts'      => get_theme_mod( 'misc_post_filter_posts' ),
			'filter_categories' => get_theme_mod( 'misc_post_filter_categories' ),
			'filter_tags'       => get_theme_mod( 'misc_post_filter_tags' ),
			'filter_offset'     => get_theme_mod( 'misc_post_filter_offset', 0 ),
			'orderby'           => get_theme_mod( 'misc_post_sort_orderby', 'date' ),
			'time_frame'        => get_theme_mod( 'misc_post_time_frame' ),
			'order'             => get_theme_mod( 'misc_post_sort_order', 'DESC' ),
			'number_items'      => 4,
		);

		$query = new WP_Query( csco_build_custom_query_args( $query_args ) );

		if ( $query->have_posts() ) {
			?>
			<section class="cs-newest-post">
				<?php if ( $misc_post_heading ) { ?>
					<div class="cs-newest-post__headline">
						<div class="cs-newest-post__headline-container">
							<?php if ( $misc_post_heading ) { ?>
								<h2 class="cs-newest-post__heading">
									<?php echo do_shortcode( $misc_post_heading ); ?>
								</h2>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<div class="cs-newest-post__post-area cs-posts-area__main cs-posts-area__grid">
					<?php
					$current = 1;
					while ( $query->have_posts() ) {
						$query->the_post();

						get_template_part(
							'template-parts/post-area/card',
							'standard',
							array(
								'image_orientation' => get_theme_mod( 'misc_post_image_orientation', 'landscape-16-9' ),
								'image_size'        => get_theme_mod( 'misc_post_image_size', 'csco-thumbnail' ),
								'image_lazyload'    => 'lazy',
								'meta'              => get_theme_mod( 'misc_post_meta', array( 'category', 'author', 'date', 'comments' ) ),
								'excerpt'           => get_theme_mod( 'misc_post_excerpt', false ),
								'location'          => 'header_search',
								'current_post'      => $current,
							)
						);

						++$current;
					}
					?>
				</div>
			</section>
			<?php
		}
		wp_reset_postdata();
	}
}

if ( ! function_exists( 'csco_floating_header' ) ) {
	/**
	 * Floating Header
	 */
	function csco_floating_header() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_floating_header', false ) ) {
			return;
		}

		$post_floating_prev_next = get_theme_mod( 'post_floating_prev_next', false );

		$prev_post = get_previous_post();
		$next_post = get_next_post();
		?>
		<div class="cs-floating-header">
			<div class="cs-floating-header__content">

				<?php
				// Prev post.
				if ( $post_floating_prev_next && $prev_post ) {
					$query = new WP_Query(
						array(
							'posts_per_page' => 1,
							'p'              => $prev_post->ID,
						)
					);

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<div class="cs-floating-header__prev">
								<a href="<?php the_permalink(); ?>" class="cs-floating-header__prev-link" title="<?php echo esc_html( $prev_post->post_title ); ?>"></a>
								<span class="cs-floating-header__prev-icon"></span>
								<div class="cs-floating-header__prev-post">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="cs-entry__thumbnail cs-entry__inner cs-overlay-ratio cs-ratio-square">
											<div class="cs-overlay-background cs-overlay-transparent">
												<?php the_post_thumbnail( 'csco-small' ); ?>
											</div>
										</div>
									<?php } ?>
									<?php echo esc_html( $prev_post->post_title ); ?>
								</div>
							</div>
							<?php
						}
					}
					wp_reset_postdata();
				}
				?>

				<div class="cs-floating-header__current">
					<span><?php the_title(); ?></span>
				</div>

				<?php
				// Next post.
				if ( $post_floating_prev_next && $next_post ) {
					$query = new WP_Query(
						array(
							'posts_per_page' => 1,
							'p'              => $next_post->ID,
						)
					);

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<div class="cs-floating-header__next">
								<a href="<?php the_permalink(); ?>" class="cs-floating-header__next-link" title="<?php echo esc_html( $next_post->post_title ); ?>"></a>
								<div class="cs-floating-header__next-post">
									<?php echo esc_html( $next_post->post_title ); ?>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="cs-entry__thumbnail cs-entry__inner cs-overlay-ratio cs-ratio-square">
											<div class="cs-overlay-background cs-overlay-transparent">
												<?php the_post_thumbnail( 'csco-small' ); ?>
											</div>
										</div>
									<?php } ?>
								</div>
								<span class="cs-floating-header__next-icon"></span>
							</div>
							<?php
						}
					}
					wp_reset_postdata();
				}
				?>

			</div>
			<div class="cs-floating-header__progress">
				<div class="cs-floating-header__progress-bar"></div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_mobile_logo' ) ) {
	/**
	 * Mobile Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_mobile_logo( $settings = array() ) {
		$logo_url = get_theme_mod( 'mobile_logo' );

		$logo_id = attachment_url_to_postid( $logo_url );

		$logo_mode = 'cs-logo-once';

		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}
		?>
		<div class="cs-logo cs-logo-mobile">
			<a class="cs-header__logo cs-header__logo-mobile <?php echo esc_attr( $logo_mode ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {
				$logo_dark_url = get_theme_mod( 'mobile_logo_dark' ) ? get_theme_mod( 'mobile_logo_dark' ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-header__logo cs-logo-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_logo' ) ) {
	/**
	 * Footer Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_logo( $settings = array() ) {
		$logo_url = get_theme_mod( 'footer_logo' );

		$logo_id = attachment_url_to_postid( $logo_url );

		$logo_mode = 'cs-logo-once';

		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}
		?>
		<div class="cs-logo">
			<a class="cs-footer__logo <?php echo esc_attr( $logo_mode ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {
				$logo_dark_url = get_theme_mod( 'footer_logo_dark' ) ? get_theme_mod( 'footer_logo_dark' ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-footer__logo cs-logo-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_description' ) ) {
	/**
	 * Footer Description
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_description( $settings = array() ) {

		$footer_text = get_theme_mod( 'footer_text' );
		if ( $footer_text ) {
			?>
			<div class="cs-footer__description">
				<span>
					<?php echo do_shortcode( $footer_text ); ?>
				</span>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_marquee' ) ) {
	/**
	 * Footer Running Line
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_marquee( $settings = array() ) {
		if ( ! get_theme_mod( 'footer_marquee', false ) ) {
			return;
		}

		$footer_marquee_text = get_theme_mod( 'footer_marquee_text' );

		if ( $footer_marquee_text && ! empty( $footer_marquee_text ) ) {
			?>
			<div class="cs-footer__item cs-footer__item-cs-running-line cs-footer-marquee">
				<div class="cs-footer-marquee__content">
					<?php for ( $i = 1; $i <= 6; $i++ ) { ?>
						<div class="cs-footer-marquee__item"><?php echo do_shortcode( $footer_marquee_text ); ?></div>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_copyright' ) ) {
	/**
	 * Footer Copyright
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_copyright( $settings = array() ) {
		$footer_copyright = get_theme_mod( 'footer_copyright', esc_html__( '© 2025 Flux. All Rights Reserved.', 'flux' ) );

		if ( $footer_copyright ) {
			?>
			<div class="cs-footer__col cs-col-right">
				<div class="cs-footer__copyright">
					<?php echo do_shortcode( $footer_copyright ); ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_burger_nav_menu' ) ) {
	/**
	 * Burger Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_burger_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'burger' ) ) {
			?>
			<div class="cs-burger-menu__nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'burger',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-burger-menu__nav-menu %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 2,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_columns_nav_menu' ) ) {
	/**
	 * Footer Columns Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_columns_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'footer_columns' ) ) {
			?>
			<div class="cs-footer-columns__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer_columns',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-footer-columns__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 2,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_additional_menu' ) ) {
	/**
	 * Footer Nav Menu.
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_additional_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'additional_menu' ) ) {
			?>
			<div class="cs-footer__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'additional_menu',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-footer__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 1,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_additional_menu' ) ) {
	/**
	 * Additional Menu.
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_additional_menu( $settings = array() ) {
		if ( ! get_theme_mod( 'header_additional_menu', false ) ) {
			return;
		}

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'additional_menu' ) ) {
			?>
			<div class="cs-additional__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'additional_menu',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-additional__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 1,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_off_canvas_button' ) ) {
	/**
	 * Off-Canvas Button
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_off_canvas_button( $settings = array() ) {
		if ( ! get_theme_mod( 'header_custom_button', false ) ) {
			return;
		}

		$button = get_theme_mod( 'header_custom_button_label' );
		$link   = get_theme_mod( 'header_custom_button_link' );
		$target = get_theme_mod( 'header_custom_button_target', '_self' );

		if ( $button && $link ) {
			?>
			<div class="cs-offcanvas__button">
				<a class="cs-button cs-offcanvas__button" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
					<?php echo wp_kses( $button, 'content' ); ?>
				</a>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_scroll_to_top' ) ) {
	/**
	 * Scroll to Top
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_scroll_to_top( $settings = array() ) {
		if ( ! get_theme_mod( 'misc_scroll_to_top', true ) ) {
			return;
		}
		?>
			<button class="cs-scroll-top" role="button" aria-label="<?php echo esc_attr__( 'Scroll to top button', 'flux' ); ?>">
				<i class="cs-icon cs-icon-chevron-down"></i>
			</button>
		<?php
	}
}

if ( ! function_exists( 'csco_off_canvas_scheme_toggle' ) ) {
	/**
	 * Offcanvas Scheme Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_off_canvas_scheme_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
			<span class="cs-site-scheme-toggle cs-offcanvas__scheme-toggle" role="button" aria-label="<?php echo esc_attr__( 'Scheme Toggle', 'flux' ); ?>">
				<span class="cs-header__scheme-toggle-icons">
					<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
					<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
				</span>
			</span>
		<?php
	}
}

if ( ! function_exists( 'csco_post_subtitle' ) ) {
	/**
	 * Post Subtitle
	 */
	function csco_post_subtitle() {
		if ( ! is_single() ) {
			return;
		}

		if ( get_theme_mod( 'post_subtitle', true ) ) {
			/**
			 * The plugins/wp_subtitle/get_subtitle hook.
			 *
			 * @since 1.0.0
			 */
			$subtitle = apply_filters(
				'plugins/wp_subtitle/get_subtitle',
				'',
				array(
					'before'  => '',
					'after'   => '',
					'post_id' => get_the_ID(),
				)
			);

			if ( $subtitle ) {
				?>
				<div class="cs-entry__subtitle">
					<?php echo wp_kses( $subtitle, 'content' ); ?>
				</div>
				<?php
			} elseif ( has_excerpt() ) {
				?>
				<div class="cs-entry__subtitle">
					<?php the_excerpt(); ?>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'csco_archive_post_description' ) ) {
	/**
	 * Post Description in Archive Pages
	 */
	function csco_archive_post_description() {
		if ( is_author() ) {
			$author      = get_queried_object();
			$description = get_the_author_meta( 'description', $author->ID );
		} else {
			$description = get_the_archive_description();
		}
		if ( $description ) {
			?>
			<div class="cs-page__archive-description">
				<?php echo do_shortcode( $description ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_archive_post_count' ) ) {
	/**
	 * Post Count in Archive Pages
	 */
	function csco_archive_post_count() {
		global $wp_query;
		$found_posts = $wp_query->found_posts;

		$featured_archive_global = get_theme_mod( 'featured_archive', 'disabled' );
		$category_id             = get_queried_object_id();
		$featured_archive_local  = get_term_meta( $category_id, 'csco_featured_category', 'default' );

		if ( 'enabled' === $featured_archive_local || ( 'enabled' === $featured_archive_global && 'disabled' !== $featured_archive_local ) ) {
			++$found_posts;
		}

		if ( $found_posts > 0 ) {
			?>
			<span class="cs-page__archive-count">
				<?php
				/* translators: 1: Singular, 2: Plural. */
				$found_posts_count = sprintf( _n( '%s result', '%s results', $found_posts, 'flux' ), $found_posts );

				/**
				 * The csco_article_full_count hook.
				 *
				 * @since 1.0.0
				 */
				echo esc_html( apply_filters( 'csco_article_full_count', $found_posts_count, $found_posts ) );
				?>
			</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_header_more_toggle' ) ) {
	/**
	 * Header More Toggle
	 */
	function csco_header_more_toggle() {
		$header_more = get_theme_mod( 'header_more', false );

		if ( ! $header_more ) {
			return;
		}

		?>
		<span class="cs-header__more-toggle" role="button" aria-label="<?php echo esc_attr__( 'More toggle button', 'flux' ); ?>">
			<i class="cs-icon cs-icon-more"></i>
		</span>
		<?php
	}
}

if ( ! function_exists( 'csco_the_post_format_icon' ) ) {
	/**
	 * Post Format Icon
	 *
	 * @param string $content After content.
	 */
	function csco_the_post_format_icon( $content = null ) {
		$post_format = get_post_format();

		if ( 'gallery' === $post_format ) {
			$attachments = count(
				(array) get_children(
					array(
						'post_parent' => get_the_ID(),
						'post_type'   => 'attachment',
					)
				)
			);

			$content = $attachments ? sprintf( '<span>%s</span>', $attachments ) : '';
		}

		if ( $post_format ) {
			?>
			<span class="cs-entry-format">
				<i class="cs-format-icon cs-format-<?php echo esc_attr( $post_format ); ?>"></i>
			</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_banner' ) ) {
	/**
	 * Banner Section
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_banner( $settings ) {
		$section_class = 'cs-banner-entry cs-banner-' . $settings['banner_section'];
		?>
		<section class="<?php echo esc_attr( $section_class ); ?>">
			<div class="cs-banner">
				<div class="cs-banner__container">
					<div class="cs-banner__content">
						<?php echo do_shortcode( $settings['banner_html'] ); ?>
					</div>

					<?php if ( true === $settings['banner_label'] && $settings['banner_label_text'] ) { ?>
						<div class="cs-banner__label">
							<?php echo esc_html( $settings['banner_label_text'] ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php
	}
}

if ( ! function_exists( 'csco_exclude_home_section_posts_from_query' ) ) {
	/**
	 * Exclude specific home section posts from the main query.
	 *
	 * @param WP_Query $query The main query object.
	 */
	function csco_exclude_home_section_posts_from_query( $query ) {

		if ( is_admin() || ! $query->is_home() || ! $query->is_main_query() ) {
			return;
		}

		$excluded_ids = array();

		$sections = csco_get_section_settings();

		foreach ( $sections as $section_group ) {
			foreach ( $section_group as $section ) {
				if ( 'none' !== $section['display'] && ( isset( $section['exclude_posts'] ) && $section['exclude_posts'] ) ) {
					$query_args = csco_build_custom_query_args(
						array(
							'filter_posts'      => $section['filter_posts'],
							'filter_categories' => $section['filter_categories'],
							'filter_tags'       => $section['filter_tags'],
							'number_items'      => $section['number_items'],
						),
						true
					);

					$query_args['fields']       = 'ids';
					$query_args['post__not_in'] = $excluded_ids;

					$sub_query = new WP_Query( $query_args );

					if ( $sub_query->have_posts() ) {
						$new_ids      = array_map( 'intval', $sub_query->posts );
						$excluded_ids = array_merge( $excluded_ids, $new_ids );
					}
				}
			}
		}

		$query->set( 'post__not_in', array_unique( $excluded_ids ) );
	}
}
add_action( 'pre_get_posts', 'csco_exclude_home_section_posts_from_query', 9999 );
