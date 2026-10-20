<?php
/**
 * Adding Custom Meta Boxes.
 *
 * @package Flux
 */

/**
 * ==================================
 * Category Options
 * ==================================
 */

/**
 * Add fields to Category
 *
 * @param string $taxonomy The taxonomy slug.
 */
function csco_mb_category_options_add( $taxonomy ) {
	wp_nonce_field( 'category_options', 'csco_mb_category_options' );
	?>
	<div class="form-field">
		<p><?php esc_html_e( 'Featured Post', 'flux' ); ?></p>
		<label for="csco_featured_category_default">
			<input type="radio" name="csco_featured_category" id="csco_featured_category_default" value="default" checked />
			<?php esc_html_e( 'Default', 'flux' ); ?>
		</label>
		<label for="csco_featured_category_enabled">
			<input type="radio" name="csco_featured_category" id="csco_featured_category_enabled" value="enabled" />
			<?php esc_html_e( 'Enabled', 'flux' ); ?>
		</label>
		<label for="csco_featured_category_disabled">
			<input type="radio" name="csco_featured_category" id="csco_featured_category_disabled" value="disabled" />
			<?php esc_html_e( 'Disabled', 'flux' ); ?>
		</label>
		<p class="description"><?php esc_html_e( 'Enabling or disabling this option will override the default configuration.', 'flux' ); ?></p>
	</div>
	<hr>
	<div class="form-field">
		<label><?php echo esc_html__( 'Category Thumbnail', 'flux' ); ?></label>
		<div class="category-upload-image upload-img-container" data-frame-title="<?php esc_attr_e( 'Select or upload image', 'flux' ); ?>" data-frame-btn-text="<?php esc_attr_e( 'Set image', 'flux' ); ?>">
			<p class="icon-description">
				<?php echo esc_html__( 'The category thumbnail is displayed in its original dimensions on your website. Please upload the 2x version of your thumbnail via the Media Library with @2x suffix for Retina display support. For example, image@2x.png. Recommended maximum size is 528px (1056px for Retina version).', 'flux' ); ?>
			</p>
			<p class="uploaded-img-box">
				<span class="uploaded-image"></span>
				<input id="csco_category_thumbnail" class="uploaded-img-id" name="csco_category_thumbnail" type="hidden"/>
			</p>
			<p class="hide-if-no-js">
				<a class="upload-img-link button button-primary" href="#"><?php echo esc_html__( 'Upload image', 'flux' ); ?></a>
				<a class="delete-img-link button button-secondary hidden" href="#"><?php echo esc_html__( 'Remove image', 'flux' ); ?></a>
			</p>
		</div>
	</div>
	<?php
}
add_action( 'category_add_form_fields', 'csco_mb_category_options_add', 10 );

/**
 * Edit fields from Category
 *
 * @param object $term     Current taxonomy term object.
 * @param string $taxonomy Current taxonomy slug.
 */
function csco_mb_category_options_edit( $term, $taxonomy ) {
	wp_nonce_field( 'category_options', 'csco_mb_category_options' );

	$featured_category = get_term_meta( $term->term_id, 'csco_featured_category', true );
	$featured_category = ( ! empty( $featured_category ) ) ? $featured_category : 'default';

	$csco_category_thumbnail     = get_term_meta( $term->term_id, 'csco_category_thumbnail', true );
	$csco_category_thumbnail_url = wp_get_attachment_image_url( $csco_category_thumbnail, 'thumbnail' );
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="csco_featured_category"><?php esc_html_e( 'Featured Post', 'flux' ); ?></label></th>
		<td>
			<p class="description">
				<input type="radio" name="csco_featured_category" id="csco_featured_category_default" value="default" <?php checked( $featured_category, 'default' ); ?> />
				<label for="csco_featured_category_default"><?php esc_html_e( 'Default', 'flux' ); ?></label><br>
				<input type="radio" name="csco_featured_category" id="csco_featured_category_enabled" value="enabled" <?php checked( $featured_category, 'enabled' ); ?> />
				<label for="csco_featured_category_enabled"><?php esc_html_e( 'Enabled', 'flux' ); ?></label><br>
				<input type="radio" name="csco_featured_category" id="csco_featured_category_disabled" value="disabled" <?php checked( $featured_category, 'disabled' ); ?> />
				<label for="csco_featured_category_disabled"><?php esc_html_e( 'Disabled', 'flux' ); ?></label>
			</p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label for="csco_category_thumbnail"><?php echo esc_html__( 'Category Thumbnail', 'flux' ); ?></label></th>
		<td>
			<div class="category-upload-image upload-img-container" data-frame-title="<?php esc_attr_e( 'Select or upload image', 'flux' ); ?>" data-frame-btn-text="<?php esc_attr_e( 'Set image', 'flux' ); ?>">
				<p class="icon-description">
					<?php echo esc_html__( 'The category thumbnail is displayed in its original dimensions on your website. Please upload the 2x version of your thumbnail via the Media Library with @2x suffix for Retina display support. For example, image@2x.png. Recommended maximum size is 528px (1056px for Retina version).', 'flux' ); ?>
				</p>
				<p class="uploaded-img-box">
					<span class="uploaded-image">
						<?php if ( $csco_category_thumbnail_url ) { ?>
							<img src="<?php echo esc_url( $csco_category_thumbnail_url ); ?>" style="max-width:100%;" />
						<?php } ?>
					</span>
					<input id="csco_category_thumbnail" class="uploaded-img-id" name="csco_category_thumbnail" type="hidden" value="<?php echo esc_attr( $csco_category_thumbnail ); ?>" />
				</p>
				<p class="hide-if-no-js">
					<a class="upload-img-link button button-primary <?php echo esc_attr( $csco_category_thumbnail_url ? 'hidden' : '' ); ?>" href="#"><?php echo esc_html__( 'Upload image', 'flux' ); ?></a>
					<a class="delete-img-link button button-secondary <?php echo esc_attr( ! $csco_category_thumbnail_url ? 'hidden' : '' ); ?>" href="#"><?php echo esc_html__( 'Remove image', 'flux' ); ?></a>
				</p>
			</div>
		</td>
	</tr>

	<?php
}
add_action( 'category_edit_form_fields', 'csco_mb_category_options_edit', 10, 2 );

/**
 * Save meta box
 *
 * @param int    $term_id  ID of the term about to be edited.
 * @param string $taxonomy Taxonomy slug of the related term.
 */
function csco_mb_category_options_save( $term_id, $taxonomy ) {

	// Bail if we're doing an auto save.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// if our nonce isn't there, or we can't verify it, bail.
	if ( ! isset( $_POST['csco_mb_category_options'] ) || ! wp_verify_nonce( $_POST['csco_mb_category_options'], 'category_options' ) ) { // Input var ok; sanitization ok.
		return;
	}

	$valid_values = array( 'default', 'enabled', 'disabled' );

	if ( isset( $_POST['csco_featured_category'] ) && in_array( $_POST['csco_featured_category'], $valid_values ) ) {
		update_term_meta( $term_id, 'csco_featured_category', $_POST['csco_featured_category'] ); // Input var ok; sanitization ok.
	} else {
		delete_term_meta( $term_id, 'csco_featured_category' );
	}

	if ( isset( $_POST['csco_category_thumbnail'] ) ) { // Input var ok; sanitization ok.
		$csco_category_thumbnail = sanitize_text_field( $_POST['csco_category_thumbnail'] ); // Input var ok; sanitization ok.
		update_term_meta( $term_id, 'csco_category_thumbnail', $csco_category_thumbnail );
		update_term_meta( $term_id, '_csco_category_thumbnail', wp_get_attachment_image_url( $csco_category_thumbnail, 'full' ) );
	}
}
add_action( 'created_category', 'csco_mb_category_options_save', 10, 2 );
add_action( 'edited_category', 'csco_mb_category_options_save', 10, 2 );

/**
 * Meta box Enqunue Scripts
 *
 * @param string $page Current page.
 */
function csco_mb_category_enqueue_scripts( $page ) {
	$screen = get_current_screen();

	if ( null !== $screen && 'edit-category' !== $screen->id ) {
		return;
	}

	ob_start();
	?>

	<?php
	wp_enqueue_script( 'jquery' );

	// Init Media Control.
	wp_enqueue_media();

	ob_start();
	?>
	<script>
		jQuery( document ).ready(function( $ ) {

			var powerkitMediaFrame;
			/* Set all variables to be used in scope */
			var metaBox = '.category-upload-image, .category-icon-image';

			/* Add Image Link */
			$( metaBox ).find( '.upload-img-link' ).on( 'click', function( event ){
				event.preventDefault();

				var parentContainer = $( this ).parents( metaBox );

				// Options.
				var options = {
					title: parentContainer.data( 'frame-title' ) ? parentContainer.data( 'frame-title' ) : 'Select or Upload Media',
					button: {
						text: parentContainer.data( 'frame-btn-text' ) ? parentContainer.data( 'frame-btn-text' ) : 'Use this media',
					},
					library : { type : 'image' },
					multiple: false // Set to true to allow multiple files to be selected.
				};

				// Create a new media frame
				powerkitMediaFrame = wp.media( options );

				// When an image is selected in the media frame...
				powerkitMediaFrame.on( 'select', function() {

					// Get media attachment details from the frame state.
					var attachment = powerkitMediaFrame.state().get('selection').first().toJSON();

					// Send the attachment URL to our custom image input field.
					parentContainer.find( '.uploaded-image' ).html( '<img src="' + attachment.url + '" style="max-width:25%;"/>' );
					parentContainer.find( '.uploaded-img-id' ).val( attachment.id ).change();
					parentContainer.find( '.upload-img-link' ).addClass( 'hidden' );
					parentContainer.find( '.delete-img-link' ).removeClass( 'hidden' );

					powerkitMediaFrame.close();
				});

				// Finally, open the modal on click.
				powerkitMediaFrame.open();
			});


			/* Delete Image Link */
			$( metaBox ).find( '.delete-img-link' ).on( 'click', function( event ){
				event.preventDefault();

				$( this ).parents( metaBox ).find( '.uploaded-image' ).html( '' );
				$( this ).parents( metaBox ).find( '.upload-img-link' ).removeClass( 'hidden' );
				$( this ).parents( metaBox ).find( '.delete-img-link' ).addClass( 'hidden' );
				$( this ).parents( metaBox ).find( '.uploaded-img-id' ).val( '' ).change();
			});
		});

		jQuery( document ).ajaxSuccess(function(e, request, settings){
			let action   = settings.data.indexOf( 'action=add-tag' );
			let screen   = settings.data.indexOf( 'screen=edit-category' );
			let taxonomy = settings.data.indexOf( 'taxonomy=category' );

			if( action > -1 && screen > -1 && taxonomy > -1 ){
				jQuery( '.delete-img-link' ).click();
			}
		});
	</script>
	<?php
	wp_add_inline_script( 'jquery', str_replace( array( '<script>', '</script>' ), '', ob_get_clean() ) );
}
add_action( 'admin_enqueue_scripts', 'csco_mb_category_enqueue_scripts' );
