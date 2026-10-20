<?php
/**
 * The template part for displaying off-canvas area.
 *
 * @package Flux
 */

if ( csco_offcanvas_exists() ) {

	$offcanvas_social_links = get_theme_mod( 'header_burger_social_links', true );
	?>

	<div class="cs-site-overlay"></div>

	<div class="cs-offcanvas" <?php csco_offcanvas_attr(); ?>>

		<div class="cs-offcanvas__header">
			<?php
			/**
			 * The csco_offcanvas_header_start hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_offcanvas_header_start' );
			?>

			<div class="cs-offcanvas__close-toggle" role="button" aria-label="<?php echo esc_attr__( 'Close mobile menu button', 'flux' ); ?>">
				<i class="cs-icon cs-icon-x"></i>
			</div>

			<?php csco_component( 'mobile_logo' ); ?>

			<?php
			/**
			 * The csco_offcanvas_header_end hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_offcanvas_header_end' );
			?>
		</div>

		<aside class="cs-offcanvas__sidebar">
			<div class="cs-offcanvas__inner cs-offcanvas__area cs-widget-area cs-container">

				<?php
				$locations = get_nav_menu_locations();

				// Get menu by location.
				if ( isset( $locations['primary'] ) || isset( $locations['mobile'] ) ) {

					if ( isset( $locations['primary'] ) ) {
						$location = $locations['primary'];
					}
					if ( isset( $locations['mobile'] ) ) {
						$location = $locations['mobile'];
					}

					the_widget(
						'WP_Nav_Menu_Widget',
						array( 'nav_menu' => $location ),
						array(
							'before_widget' => '<div class="widget %s">',
							'after_widget'  => '</div>',
						)
					);
				}

				dynamic_sidebar( 'sidebar-offcanvas' );
				?>

				<div class="cs-offcanvas__bottombar">
					<?php if ( csco_component( 'header_custom_button', false ) ) { ?>
						<?php csco_component( 'header_custom_button' ); ?>
					<?php } ?>

					<?php if ( $offcanvas_social_links && csco_component( 'social_links', false ) ) { ?>
						<div class="cs-offcanvas__follow">
							<?php csco_component( 'social_links' ); ?>
						</div>
					<?php } ?>

					<div class="cs-offcanvas__separator">
						<?php csco_component( 'header_scheme_toggle' ); ?>

						<?php if ( csco_component( 'additional_menu', false ) ) { ?>
							<?php csco_component( 'additional_menu' ); ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</aside>

	</div>
	<?php
}
