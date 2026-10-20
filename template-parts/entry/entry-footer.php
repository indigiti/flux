<?php
/**
 * The template part for displaying post footer section.
 *
 * @package Flux
 */

$post_footer  = get_theme_mod( 'post_footer', true );
$category     = get_theme_mod( 'post_footer_category', true );
$reading_time = get_theme_mod( 'post_footer_reading_time', false );
$published    = get_theme_mod( 'post_date_published', true );
$updated      = get_theme_mod( 'post_date_updated', true );
$post_comment = get_theme_mod( 'post_footer_comments', false );
$post_share   = get_theme_mod( 'post_share', true );

$meta = array();

if ( $category ) {
	$meta[] = 'category';
}

if ( $reading_time ) {
	$meta[] = 'reading_time';
}

if ( $post_comment ) {
	$meta[] = 'comments';
}

if ( $post_footer ) {
	?>
<div class="cs-entry__footer">
	<div class="cs-entry__footer-inner">
		<?php if ( ! empty( $meta ) || $published || $updated ) { ?>
			<div class="cs-entry__footer-col cs-footer-post-meta">
				<?php csco_get_post_meta( $meta, true, 'post_meta' ); ?>
				<?php if ( $published ) { ?>
					<div class="cs-entry__footer-date">
						<span class="cs-entry__footer-date-title"><?php echo esc_html__( 'Published:', 'flux' ); ?></span>
						<time class="cs-entry__footer-date-value"><?php echo esc_html( get_the_date( 'M d, Y' ) ); ?></time>
					</div>
				<?php } ?>
				<?php if ( $updated ) { ?>
					<div class="cs-entry__footer-date">
						<span class="cs-entry__footer-date-title"><?php echo esc_html__( 'Updated:', 'flux' ); ?></span>
						<time class="cs-entry__footer-date-value"><?php echo esc_html( get_the_modified_date( 'M d, Y' ) ); ?></time>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php
		if ( $post_share ) {
			$share_heading = get_theme_mod( 'post_share_heading', esc_html__( 'Share the Post with Your Besties', 'flux' ) );
			?>
			<div class="cs-entry__footer-col cs-footer-share">
				<?php if ( $share_heading && ! empty( $share_heading ) ) { ?>
					<div class="cs-footer-share__heading"><?php echo esc_html( $share_heading ); ?></div>
				<?php } ?>
				<?php csco_component( 'post_footer_share_links' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
