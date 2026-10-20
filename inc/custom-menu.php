<?php
/**
 * Menu Customization.
 *
 * @package Flux
 */

/**
 * -------------------------------------------------------------------------
 * [ Menus ]
 * -------------------------------------------------------------------------
 */

if ( ! function_exists( 'csco_menu_item_args' ) ) {
	/**
	 * Filters the arguments for a single nav menu item.
	 *
	 * @param object $args  An object of wp_nav_menu() arguments.
	 * @param object $item  (WP_Post) Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 */
	function csco_menu_item_args( $args, $item, $depth ) {
		$args->link_before = '';
		$args->link_after  = '';

		$locations                  = get_nav_menu_locations();
		$primary_menu_id            = isset( $locations['primary'] ) ? $locations['primary'] : 0;
		$mobile_menu_id             = isset( $locations['mobile'] ) ? $locations['mobile'] : 0;
		$burger_menu_id             = isset( $locations['burger'] ) ? $locations['burger'] : 0;
		$footer_columns_menu_id     = isset( $locations['footer_columns'] ) ? $locations['footer_columns'] : 0;
		$is_primary_location        = $primary_menu_id && has_term( $primary_menu_id, 'nav_menu', $item->ID );
		$is_mobile_location         = $mobile_menu_id && has_term( $mobile_menu_id, 'nav_menu', $item->ID );
		$is_burger_location         = $burger_menu_id && has_term( $burger_menu_id, 'nav_menu', $item->ID );
		$is_footer_columns_location = $footer_columns_menu_id && has_term( $footer_columns_menu_id, 'nav_menu', $item->ID );

		if ( $is_primary_location && 0 === $depth ) {
			$args->link_before = '<span>';
			$args->link_after  = '</span>';
		}

		if ( ( $is_primary_location || $is_mobile_location || $is_burger_location || $is_footer_columns_location ) && ( 0 === $depth || 1 === $depth ) ) {
			$args->link_before = '';
			$args->link_after  = '';

			// Retrieve the tag.
			$menu_tag = get_post_meta( $item->ID, '_menu_item_tag', true );

			if ( ! empty( $menu_tag ) ) {
				if ( $is_footer_columns_location ) {
					$args->link_before = '<span class="menu-name">';
				}

				$args->link_after .= '</span><span class="menu-item-tag">' . esc_html( $menu_tag ) . '</span>';
			}
		}

		return $args;
	}
	add_filter( 'nav_menu_item_args', 'csco_menu_item_args', 10, 3 );
}

if ( version_compare( get_bloginfo( 'version' ), '5.4', '>=' ) ) {
	/**
	 * -------------------------------------------------------------------------
	 * [ Menu item Tags ]
	 * -------------------------------------------------------------------------
	 */
	/**
	 * Adds a Tag input field to the menu item settings form.
	 *
	 * @param int      $item_id The ID of the menu item.
	 * @param WP_Post  $item    The menu item object.
	 * @param int      $depth   Depth of the menu item.
	 * @param stdClass $args    An object containing wp_nav_menu() arguments.
	 */
	function csco_custom_menu_item_tag_field( $item_id, $item, $depth, $args ) {
		$tag_value = get_post_meta( $item_id, '_menu_item_tag', true );

		$locations                  = get_nav_menu_locations();
		$primary_menu_id            = isset( $locations['primary'] ) ? $locations['primary'] : 0;
		$mobile_menu_id             = isset( $locations['mobile'] ) ? $locations['mobile'] : 0;
		$burger_menu_id             = isset( $locations['burger'] ) ? $locations['burger'] : 0;
		$footer_columns_menu_id     = isset( $locations['footer_columns'] ) ? $locations['footer_columns'] : 0;
		$is_primary_location        = $primary_menu_id && has_term( $primary_menu_id, 'nav_menu', $item->ID );
		$is_mobile_location         = $mobile_menu_id && has_term( $mobile_menu_id, 'nav_menu', $item->ID );
		$is_burger_location         = $burger_menu_id && has_term( $burger_menu_id, 'nav_menu', $item->ID );
		$is_footer_columns_location = $footer_columns_menu_id && has_term( $footer_columns_menu_id, 'nav_menu', $item->ID );

		if ( ( $is_primary_location || $is_mobile_location || $is_burger_location || $is_footer_columns_location ) && ( 0 === $depth || 1 === $depth ) ) {
			$nonce_value = wp_create_nonce( 'menu_tag_nonce_action' );
			?>
			<div class="description-group">
				<p class="description description-wide">
					<label for="edit-menu-item-tag-<?php echo esc_attr( $item_id ); ?>">
						<?php echo esc_html__( 'Menu Tag', 'flux' ); ?>
						<input
							type="text"
							id="edit-menu-item-tag-<?php echo esc_attr( $item_id ); ?>"
							class="widefat code edit-menu-item-tag"
							name="menu-item-tag[<?php echo esc_attr( $item_id ); ?>]"
							value="<?php echo esc_attr( $tag_value ); ?>" />
					</label>
					<input type="hidden" name="menu_tag_nonce" value="<?php echo esc_attr( $nonce_value ); ?>" />
				</p>
			</div>
			<?php
		}
	}
	add_action( 'wp_nav_menu_item_custom_fields', 'csco_custom_menu_item_tag_field', 10, 4 );

	/**
	 * Saves the value of the menu item tag field.
	 *
	 * @param int   $menu_id         ID of the menu.
	 * @param int   $menu_item_db_id ID of the menu item being updated.
	 * @param array $args            Arguments passed to wp_update_nav_menu_item().
	 */
	function csco_save_custom_menu_item_tag_field( $menu_id, $menu_item_db_id, $args ) {
		if ( isset( $_POST['menu_tag_nonce'] ) && wp_verify_nonce( $_POST['menu_tag_nonce'], 'menu_tag_nonce_action' ) ) {
			// Only update if the field exists in $_POST.
			if ( isset( $_POST['menu-item-tag'] ) && isset( $_POST['menu-item-tag'][ $menu_item_db_id ] ) ) {
				$tag_value = sanitize_text_field( $_POST['menu-item-tag'][ $menu_item_db_id ] );
				update_post_meta( $menu_item_db_id, '_menu_item_tag', $tag_value );
			}
		}
	}
	add_action( 'wp_update_nav_menu_item', 'csco_save_custom_menu_item_tag_field', 10, 3 );

	/**
	 * Adds Featured menu fields to the menu item settings form.
	 *
	 * @param int      $item_id The ID of the menu item.
	 * @param WP_Post  $item    The menu item object.
	 * @param int      $depth   Depth of the menu item.
	 * @param stdClass $args    An object containing wp_nav_menu() arguments.
	 */
	function custom_menu_item_featured_menu( $item_id, $item, $depth, $args ) {
		$locations           = get_nav_menu_locations();
		$primary_menu_id     = $locations['primary'] ?? 0;
		$is_primary_location = $primary_menu_id && has_term( $primary_menu_id, 'nav_menu', $item->ID );

		if ( $item->object && 0 === $depth && $is_primary_location ) {
			$nonce_value              = wp_create_nonce( 'featured_menu_nonce_action' );
			$featured_menu_type       = get_post_meta( $item_id, '_featured_menu_field', true );
			$featured_menu_categories = get_post_meta( $item_id, '_featured_menu_categories', true );

			?>
			<div class="cs-featured-menu-row">
				<p class="description description-wide">
					<label for="edit-menu-item-featured-menu-<?php echo esc_attr( $item_id ); ?>">
						<?php echo esc_html__( 'Featured Menu', 'flux' ); ?>
						<select
							id="edit-menu-item-featured-menu-<?php echo esc_attr( $item_id ); ?>"
							class="widefat code edit-menu-item-featured-menu"
							name="menu-item-featured-menu[<?php echo esc_attr( $item_id ); ?>]">
							<option value="0" <?php selected( '0', $featured_menu_type ); ?>><?php echo esc_html__( 'Disabled', 'flux' ); ?></option>
							<option value="latest_posts" <?php selected( 'latest_posts', $featured_menu_type ); ?>><?php echo esc_html__( 'Latest Posts', 'flux' ); ?></option>
							<option value="categories" <?php selected( 'categories', $featured_menu_type ); ?>><?php echo esc_html__( 'Categories', 'flux' ); ?></option>
						</select>
					</label>
					<input type="hidden" name="featured_menu_nonce" value="<?php echo esc_attr( $nonce_value ); ?>" />
				</p>
				<p class="description description-thin categories-menu-item <?php echo 'categories' !== $featured_menu_type ? 'hidden' : ''; ?>">
					<label for="edit-menu-item-featured-menu-post-id-<?php echo esc_attr( $item_id ); ?>"><?php echo esc_html__( 'Categories', 'flux' ); ?></label>
					<input type="text" id="edit-menu-item-featured-menu-post-id-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-featured-menu-post-id" name="menu-item-featured-menu-post-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $featured_menu_categories ); ?>" />
				</p>
			</div>


			<script type="text/javascript">
				jQuery(document).ready(function($) {
					// Toggle visibility based on selected image source.
					$('#edit-menu-item-featured-menu-<?php echo esc_attr( $item_id ); ?>').on('change', function () {
						var value = $(this).val();
						console.log($(this).closest('.cs-featured-menu-row').find('.categories-menu-item'));
						$(this).closest('.cs-featured-menu-row').find('.categories-menu-item').toggleClass('hidden', value !== 'categories');
					});
				});
			</script>

			<?php
		}
	}
	add_action( 'wp_nav_menu_item_custom_fields', 'custom_menu_item_featured_menu', 10, 4 );

	/**
	 * Saves the value of the featured menu checkbox fields.
	 *
	 * @param int   $menu_id         ID of the menu.
	 * @param int   $menu_item_db_id ID of the menu item being updated.
	 * @param array $args            Arguments passed to wp_update_nav_menu_item().
	 */
	function save_custom_menu_item_featured_menu( $menu_id, $menu_item_db_id, $args ) {
		if ( isset( $_POST['featured_menu_nonce'] ) && wp_verify_nonce( $_POST['featured_menu_nonce'], 'featured_menu_nonce_action' ) ) {
			$featured_menu_type = isset( $_POST['menu-item-featured-menu'][ $menu_item_db_id ] ) ? sanitize_text_field( $_POST['menu-item-featured-menu'][ $menu_item_db_id ] ) : '0';
			update_post_meta( $menu_item_db_id, '_featured_menu_field', $featured_menu_type );

			$featured_menu_categories = isset( $_POST['menu-item-featured-menu-post-id'][ $menu_item_db_id ] ) ? $_POST['menu-item-featured-menu-post-id'][ $menu_item_db_id ] : '';
			if ( $featured_menu_categories ) {
				update_post_meta( $menu_item_db_id, '_featured_menu_categories', $featured_menu_categories );
			} else {
				delete_post_meta( $menu_item_db_id, '_featured_menu_categories' );
			}
		}
	}
	add_action( 'wp_update_nav_menu_item', 'save_custom_menu_item_featured_menu', 10, 3 );

	/**
	 * Filters the CSS class(es) applied to a menu item's list item element.
	 *
	 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post  $item    The current menu item.
	 * @param stdClass $args    An object of wp_nav_menu() arguments.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 * @return array (Maybe) modified CSS classes.
	 */
	function csco_featured_menu_item_classes( $classes, $item, $args, $depth ) {
		$featured_menu = get_post_meta( $item->ID, '_featured_menu_field', true );

		if ( 'latest_posts' === $featured_menu ) {
			$classes[] = 'cs-featured-menu';
		} elseif ( 'categories' === $featured_menu ) {
			$classes[] = 'cs-categories-menu';
		}

		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'csco_featured_menu_item_classes', 10, 4 );
}
