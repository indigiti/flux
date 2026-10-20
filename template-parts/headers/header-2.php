<?php
/**
 * The template for displaying the header layout
 *
 * @package Flux
 */

?>
<div class="cs-header-before"></div>

<header class="cs-header cs-header-two cs-header-stretch" <?php csco_header_attr(); ?>>
	<div class="cs-header__outer">
		<div class="cs-container">
			<div class="cs-header__inner cs-header__inner-desktop">
				<div class="cs-header__col cs-col-left">
					<?php csco_component( 'header_offcanvas_toggle' ); ?>
					<?php csco_component( 'header_more_toggle' ); ?>
					<?php csco_component( 'header_nav_menu' ); ?>

				</div>

				<div class="cs-header__col cs-col-center">
					<?php csco_component( 'header_logo' ); ?>
				</div>

				<div class="cs-header__col cs-col-right">
					<div class="cs-header__toggles">
						<?php
						csco_component( 'header_search_toggle' );
						if ( csco_component( 'header_scheme_toggle', false ) ) {
							csco_component( 'header_scheme_toggle' );
						}
						?>
					</div>
					<?php if ( csco_component( 'header_custom_button', false ) ) { ?>
						<?php csco_component( 'header_custom_button' ); ?>
					<?php } ?>
				</div>
			</div>

			<?php csco_site_nav_mobile(); ?>
			<?php csco_burger_menu(); ?>
			<?php csco_more_toggle(); ?>
			<?php csco_site_search(); ?>
		</div>
	</div>
	<?php csco_component( 'floating_header' ); ?>
	<div class="cs-header-overlay"></div>
</header>
