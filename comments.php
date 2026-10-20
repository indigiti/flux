<?php
/**
 * The template for displaying comments
 *
 * @package Flux
 */

?>

<?php
/**
 * The csco_comments_before hook.
 *
 * @since 1.0.0
 */
do_action( 'csco_comments_before' );

$comments_simple = get_theme_mod( 'post_comments_simple', false );
$comments_class  = 'cs-entry__comments';

if ( $comments_simple ) {
	$comments_class .= ' cs-entry__comments-visible';
}

$button_text     = '';
$comments_number = get_comments_number();

if ( $comments_number > 0 ) {
	// translators: %s: number of comments.
	$button_text = sprintf( __( 'View Comments (%s)', 'flux' ), $comments_number );
} else {
	$button_text = __( 'Add a comment', 'flux' );
}



?>

<div class="<?php echo esc_attr( $comments_class ); ?>" id="comments">

	<?php if ( ! $comments_simple ) { ?>
		<span class="cs-button cs-button-large cs-button-animated cs-entry__comments-toggle" role="button" aria-label="<?php echo esc_attr__( 'Comments', 'flux' ); ?>">
			<span>
				<span><?php echo esc_html( $button_text ); ?></span>
				<span><?php echo esc_html( $button_text ); ?></span>
			</span>
		</span>
	<?php } ?>

	<div class="cs-entry__comments-inner">

		<?php if ( have_comments() ) { ?>
			<?php
			if ( $comments_number > 0 ) {
				$comments_count = sprintf( __( 'Comments (%s)', 'flux' ), $comments_number );
				?>
					<div class="cs-entry__comments-count"><?php echo esc_html( $comments_count ); ?></div>
			<?php } ?>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'callback'    => 'csco_comments_callback',
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 0, // Use 0 to disable avatar.
					)
				);
				?>
			</ol>

			<?php the_comments_navigation(); ?>

		<?php } ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>

			<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'flux' ); ?></p>

			<?php
		}
		?>

		<?php
		comment_form(
			array(
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
				'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s cs-button cs-button-large cs-button-animated" value="%4$s" /><span><span>' . esc_html__( 'Submit Comment', 'flux' ) . ' </span><span>' . esc_html__( 'Submit Comment', 'flux' ) . ' </span></span></button>',
			)
		);
		?>

	</div>

</div>

<?php
/**
 * The csco_comments_after hook.
 *
 * @since 1.0.0
 */
do_action( 'csco_comments_after' );
?>
