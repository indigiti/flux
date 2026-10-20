<?php
/**
 * The template part for displaying burger-menu area.
 *
 * @package Flux
 */

$header_burger_post = get_theme_mod( 'header_burger_post', false );

?>
<div class="cs-burger-menu">
	<div class="cs-container">
		<div class="cs-burger-menu__content">
			<?php if ( has_nav_menu( 'burger' ) ) { ?>
				<div class="cs-burger-menu__left">
					<?php csco_component( 'burger_nav_menu' ); ?>
				</div>
			<?php } ?>
			<?php if ( $header_burger_post ) { ?>
				<div class="cs-burger-menu__right">
					<?php csco_component( 'header_burger_post' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php if ( csco_component( 'burger_follow', false ) || csco_component( 'additional_menu', false ) ) { ?>
		<div class="cs-burger-menu__bottombar">
			<div class="cs-container">
				<div class="cs-burger-menu__bottombar-content">
					<?php if ( csco_component( 'burger_follow', false ) ) { ?>
						<div class="cs-burger-menu__left">
							<?php csco_component( 'burger_follow' ); ?>
						</div>
					<?php } ?>
					<div class="cs-burger-menu__right">
						<?php if ( csco_component( 'additional_menu', false ) ) { ?>
							<?php csco_component( 'additional_menu' ); ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<?php
