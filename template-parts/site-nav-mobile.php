<?php
/**
 * The template for displaying the header mobile
 *
 * @package Flux
 */

?>

<div class="cs-header__inner cs-header__inner-mobile">
	<div class="cs-header__col cs-col-left">
		<?php csco_component( 'header_offcanvas_toggle', true, array( 'mobile' => true ) ); ?>
		<?php csco_component( 'header_more_toggle' ); ?>
	</div>
	<div class="cs-header__col cs-col-center">
		<?php csco_component( 'mobile_logo' ); ?>
	</div>
	<div class="cs-header__col cs-col-right">
		<div class="cs-header__toggles">
			<?php csco_component( 'header_search_toggle' ); ?>
		</div>
	</div>
</div>
