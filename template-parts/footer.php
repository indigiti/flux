<?php
/**
 * The template for displaying the footer layout
 *
 * @package Flux
 */


$social           = get_theme_mod( 'footer_follow', false );
$footer_copyright = get_theme_mod( 'footer_copyright', esc_html__( '© 2025 Flux. All Rights Reserved.', 'flux' ) );

?>

<footer class="cs-footer" <?php csco_footer_attr(); ?>>
	<div class="cs-footer__item cs-footer__item-center-bar">
		<div class="cs-container">
			<div class="cs-footer__item-inner">
				<div class="cs-footer__col cs-col-left">
					<?php csco_component( 'footer_logo' ); ?>
					<?php csco_component( 'footer_description' ); ?>
				</div>

				<?php if ( csco_component( 'footer_columns_nav_menu', false ) ) { ?>
					<div class="cs-footer__col cs-col-center">
						<?php csco_component( 'footer_columns_nav_menu' ); ?>
					</div>
				<?php } ?>

				<?php if ( $social ) { ?>
					<div class="cs-footer__col cs-col-right">
						<?php csco_component( 'footer_follow' ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php csco_component( 'footer_marquee' ); ?>

	<?php if ( $footer_copyright || csco_component( 'footer_nav_menu', false ) ) { ?>
		<div class="cs-footer__item cs-footer__item-bottom-bar" data-scheme="inverse">
			<div class="cs-container">
				<div class="cs-footer__item-inner">
					<div class="cs-footer__col cs-col-left">
						<?php csco_component( 'footer_copyright' ); ?>
					</div>
					<?php if ( csco_component( 'footer_additional_menu', false ) ) { ?>
						<div class="cs-footer__col cs-col-right"><?php csco_component( 'footer_additional_menu' ); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
</footer>

<?php csco_component( 'scroll_to_top' ); ?>
