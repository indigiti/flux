<?php
/**
 * Template part for Entry Header
 *
 * @package Flux
 */

$header_type = csco_get_page_header_type();

if ( 'featured' === $header_type ) {?>
	<div class="cs-entry__header cs-entry__header-featured">
		<div class="cs-container">
			<div class="cs-entry__header-inner">
				<div class="cs-entry__header-content">
					<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
					<?php get_template_part( 'template-parts/entry/entry-header-secondary-info' ); ?>
				</div>

				<?php
				if ( has_post_thumbnail() ) {
					$caption = csco_post_thumbnail_caption();
					?>
					<div class="cs-entry__media">
						<div class="cs-entry__media-wrap cs-overlay-ratio cs-ratio-landscape-21-9">
							<figure class="cs-overlay-background cs-overlay-transparent">
								<?php the_post_thumbnail( 'csco-large' ); ?>
							</figure>
						</div>
						<?php if ( $caption ) { ?>
							<div class="cs-entry__thumbnail-caption">
								<?php echo wp_kses_post( $caption ); ?>
							</div>
						<?php } ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
