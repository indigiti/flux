<?php
/**
 * The template part for displaying more area.
 *
 * @package Flux
 */

$more_items = array();

for ( $i = 1; $i <= 4; $i++ ) {
	$more_items[ $i ] = array(
		'icon'       => get_theme_mod( "header_more_connect_{$i}_icon" ),
		'background' => get_theme_mod( "header_more_connect_{$i}_background" ),
		'heading'    => get_theme_mod( "header_more_connect_{$i}_heading" ),
		'subheading' => get_theme_mod( "header_more_connect_{$i}_subheading" ),
		'url'        => get_theme_mod( "header_more_connect_{$i}_link" ),
		'target'     => get_theme_mod( "header_more_connect_{$i}_target", '_blank' ),
	);

	if ( $more_items[ $i ]['icon'] ) {
		$more_items[ $i ]['image_id'] = attachment_url_to_postid( $more_items[ $i ]['icon'] );

		if ( 0 === $more_items[ $i ]['image_id'] ) {
			$more_items[ $i ]['image_id'] = null;
		}
	}
}

$more_items = array_filter(
	$more_items,
	function ( $item ) {
		return ! empty( $item['heading'] );
	}
);

?>
<div class="cs-more">
	<div class="cs-container">
		<div class="cs-more__content">
			<?php if ( ! empty( $more_items ) ) { ?>
				<div class="cs-more-connect">
					<?php
					foreach ( $more_items as $item ) {
						$style_attr = '';

						$item_heading_open  = '<span>';
						$item_heading_close = '</span>';

						if ( $item['url'] ) {
							$item_heading_open  = '<a href="' . esc_url( $item['url'] ) . '" target="' . esc_attr( $item['target'] ) . '" rel="noindex nofollow" >';
							$item_heading_close = '</a>';
						}

						if ( $item['background'] ) {
							$style_attr .= 'background-color: ' . $item['background'] . ';';
						}

						?>
						<div class="cs-more-connect__item" style="<?php echo esc_attr( $style_attr ); ?>">
							<div class="cs-more-connect__content">
								<?php if ( isset( $item['image_id'] ) ) { ?>
									<div class="cs-more-connect__image">
										<?php
										csco_get_retina_image(
											$item['image_id'],
											array(
												'alt'     => '',
												'loading' => 'lazy',
											)
										);
										?>
									</div>
								<?php } ?>

								<?php if ( $item['heading'] ) { ?>
									<div class="cs-more-connect__heading">
										<?php echo wp_kses( $item_heading_open, 'post' ); ?>
											<?php echo wp_kses( $item['heading'], 'post' ); ?>
										<?php echo wp_kses( $item_heading_close, 'post' ); ?>
									</div>
								<?php } ?>
							</div>
							<?php if ( isset( $item['subheading'] ) ) { ?>
								<div class="cs-more-connect__subheading">
									<?php echo wp_kses( $item['subheading'], 'post' ); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
