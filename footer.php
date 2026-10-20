<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "cs-site" div and all content after
 *
 * @package Flux
 */

?>

							<?php
							/**
							 * The csco_main_content_end hook.
							 *
							 * @since 1.0.0
							 */
							do_action( 'csco_main_content_end' );
							?>

						</div>

						<?php
						/**
						 * The csco_main_content_after hook.
						 *
						 * @since 1.0.0
						 */
						do_action( 'csco_main_content_after' );
						?>

					</div>

					<?php
					/**
					 * The csco_site_content_end hook.
					 *
					 * @since 1.0.0
					 */
					do_action( 'csco_site_content_end' );
					?>

				</div>

				<?php
				/**
				 * The csco_site_content_after hook.
				 *
				 * @since 1.0.0
				 */
				do_action( 'csco_site_content_after' );
				?>

			</main>

		</div>

		<?php
		/**
		 * The csco_site_end hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_site_end' );
		?>

	</div>

	<?php
	/**
	 * The csco_footer_before hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_footer_before' );
	?>

	<?php get_template_part( 'template-parts/footer' ); ?>

	<?php
	/**
	 * The csco_footer_after hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_footer_after' );
	?>

	<?php
	/**
	 * The csco_site_after hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_site_after' );
	?>

</div>

<?php wp_footer(); ?>

</body>
</html>
