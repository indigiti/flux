<?php
/**
 * The template for displaying the home banner.
 *
 * @package Flux
 */

$banner_section    = (string) get_theme_mod( 'home_banner_two_display', 'none' );
$banner_html       = get_theme_mod( 'home_banner_two_after_html' );
$banner_label      = get_theme_mod( 'home_banner_two_after_label', true );
$banner_label_text = get_theme_mod( 'home_banner_two_after_label_text', esc_html__( 'Advertisement', 'flux' ) );

$section_class = 'cs-banner-home cs-banner-home-two cs-banner-' . $banner_section;

?>

<section class="<?php echo esc_attr( $section_class ); ?>">
	<div class="cs-container">
		<div class="cs-banner">
			<div class="cs-banner__container">
				<div class="cs-banner__content">
					<?php echo do_shortcode( $banner_html ); ?>
				</div>

				<?php if ( true === $banner_label && $banner_label_text ) { ?>
					<div class="cs-banner__label">
						<?php echo esc_html( $banner_label_text ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
