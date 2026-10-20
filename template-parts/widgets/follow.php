<?php
/**
 * The template for displaying the widget follow.
 *
 * @package Flux
 */

$widget_title = get_theme_mod( 'theme_widget_follow_title' );

$follow_items = array();

for ( $i = 1; $i <= 3; $i++ ) {

	$follow_items[ $i ] = array(
		'icon'       => get_theme_mod( "theme_widget_follow_item_{$i}_icon" ),
		'avatar'     => get_theme_mod( "theme_widget_follow_item_{$i}_avatar" ),
		'link'       => get_theme_mod( "theme_widget_follow_item_{$i}_url" ),
		'target'     => get_theme_mod( "theme_widget_follow_item_{$i}_target", '_blank' ),
		'heading'    => get_theme_mod( "theme_widget_follow_item_{$i}_heading" ),
		'subheading' => get_theme_mod( "theme_widget_follow_item_{$i}_subheading" ),
	);

	if ( $follow_items[ $i ]['icon'] ) {
		$follow_items[ $i ]['icon'] = attachment_url_to_postid( $follow_items[ $i ]['icon'] );
	}

	if ( $follow_items[ $i ]['avatar'] ) {
		$follow_items[ $i ]['avatar'] = attachment_url_to_postid( $follow_items[ $i ]['avatar'] );

		if ( 0 === $follow_items[ $i ]['avatar'] ) {
			$follow_items[ $i ]['avatar'] = null;
		}
	}
}

$follow_items = array_filter(
	$follow_items,
	function ( $item ) {
		return ! empty( $item['heading'] ) || ! empty( $item['subheading'] );
	}
);

?>

<div class="widget cs-widget cs-widget-follow">

	<?php if ( $widget_title ) { ?>
		<h2 class="cs-widget__heading"><?php echo esc_html( $widget_title ); ?></h2>
	<?php } ?>

	<?php if ( $follow_items && ! empty( $follow_items ) ) { ?>
		<div class="cs-widget__content">
			<?php
			foreach ( $follow_items as $item ) {
				$item_heading_open  = '<div class="cs-widget-follow__item-heading">';
				$item_heading_close = '</div>';

				if ( $item['link'] ) {
					$item_heading_open  = '<a href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $item['target'] ) . '" rel="noindex nofollow" class="cs-widget-follow__item-heading">';
					$item_heading_close = '</a>';
				}
				?>
				<div class="cs-widget-follow__item">
					<?php
					if ( $item['avatar'] ) {
						?>
						<div class="cs-widget-follow__item-left">
							<div class="cs-widget-follow__item-avatar">
								<?php csco_get_retina_image( $item['avatar'], array( 'alt' => '' ) ); ?>
							</div>
							<?php if ( $item['icon'] ) { ?>
								<div class="cs-widget-follow__item-icon"><?php csco_get_retina_image( $item['icon'], array( 'alt' => '' ) ); ?></div>
							<?php } ?>
							<?php
							if ( $item['link'] ) {
								/* translators: Follow item heading. %s: Heading. */
								$aria_label = sprintf( __( 'Follow %s', 'flux' ), $item['heading'] );
								?>
								<a href="<?php echo esc_url( $item['link'] ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>" target="<?php echo esc_attr( $item['target'] ); ?>" rel="noindex nofollow" class="cs-widget-follow__item-link"></a>
							<?php } ?>
						</div>
					<?php } ?>
					<?php if ( $item['heading'] || $item['subheading'] ) { ?>
						<div class="cs-widget-follow__item-right">
							<?php if ( $item['heading'] ) { ?>
								<?php echo wp_kses( $item_heading_open, 'post' ); ?>
									<?php echo do_shortcode( $item['heading'] ); ?>
								<?php echo wp_kses( $item_heading_close, 'post' ); ?>
							<?php } ?>
							<?php if ( $item['subheading'] ) { ?>
								<div class="cs-widget-follow__item-subheading"><?php echo do_shortcode( $item['subheading'] ); ?></div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

</div>
