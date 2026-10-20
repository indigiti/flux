<?php
/**
 * Theme Functions
 *
 * Utility functions.
 *
 * @package Flux
 */

if ( ! function_exists( 'csco_doing_request' ) ) {
	/**
	 * Determines whether the current request is a WordPress REST or Ajax request.
	 */
	function csco_doing_request() {
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return true;
		}
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return true;
		}
	}
}

if ( ! function_exists( 'csco_is_context_editor' ) ) {
	/**
	 * Determines whether the current request is from WordPress Editor.
	 */
	function csco_is_context_editor() {
		wp_verify_nonce( null );

		if ( isset( $_REQUEST['context'] ) && 'edit' === $_REQUEST['context'] ) { // Input var ok; sanitization ok.
			return true;
		}
	}
}

if ( ! function_exists( 'csco_style' ) ) {
	/**
	 * Processing path of style.
	 *
	 * @param string $path URL to the stylesheet.
	 */
	function csco_style( $path ) {
		// Check RTL.
		if ( is_rtl() ) {
			return $path;
		}

		// Check Dev.
		$dev = get_theme_file_path( 'style-dev.css' );

		if ( file_exists( $dev ) ) {
			return str_replace( '.css', '-dev.css', $path );
		}

		return $path;
	}
}

if ( ! function_exists( 'csco_typography' ) ) {
	/**
	 * Output typography style.
	 *
	 * @param string $field   The field name of kirki.
	 * @param string $type    The type of typography.
	 * @param string $default The default value.
	 */
	function csco_typography( $field, $type, $default ) {
		$value = $default;

		$field_value = get_theme_mod( $field );

		if ( is_array( $field_value ) && $field_value ) {
			if ( isset( $field_value[ $type ] ) ) {
				$value = $field_value[ $type ];
			}
		}

		echo wp_kses( $value, 'content' );
	}
}

if ( ! function_exists( 'csco_enqueue_typography_styles' ) ) {
	/**
	 * Includes typography styles.
	 *
	 * @param string $handle Handle of the style to which typography styles will be added.
	 */
	function csco_enqueue_typography_styles( $handle ) {
		ob_start();

		require get_template_directory() . '/inc/typography.php';

		$typography_css = ob_get_clean();

		if ( $typography_css ) {
			wp_add_inline_style( $handle, $typography_css );
		}
	}
}

if ( ! function_exists( 'csco_component' ) ) {
	/**
	 * Display or return the component from the theme
	 *
	 * @param string $name     The name of component.
	 * @param bool   $output   Output or return.
	 * @param array  $settings The advanced settings.
	 */
	function csco_component( $name, $output = true, $settings = array() ) {

		global $csco_components;

		$func_name = sprintf( 'csco_%s', $name );

		// Set cache key.
		$cache_key = sprintf( '%s_%s', $name, md5( maybe_serialize( $settings ) ) );

		// Get component from object cache.
		$markup = isset( $csco_components[ $cache_key ] ) ? $csco_components[ $cache_key ] : null;

		// Call component.
		if ( empty( $markup ) && function_exists( $func_name ) ) {
			ob_start();
			/**
			 * The csco_component_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_component_before', $name, $settings );

			call_user_func( $func_name, $settings );

			/**
			 * The csco_component_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_component_after', $name, $settings );

			$markup = ob_get_clean();

			if ( ! $csco_components ) {
				$csco_components = array();
			}

			$csco_components[ $cache_key ] = $markup;
		}

		// If there is no markup.
		if ( ! $markup ) {
			return;
		}

		// If output is enabled.
		if ( $output ) {
			return call_user_func( 'printf', '%s', $markup );
		}

		return $markup;
	}
}

if ( ! function_exists( 'csco_get_current_language' ) ) {
	/**
	 * Get current language.
	 */
	function csco_get_current_language() {
		$current_language = __return_empty_string();

		// Polylang.
		if ( function_exists( 'pll_current_language' ) ) {
			$current_language = pll_current_language();
		}

		// WPML.
		if ( empty( $current_language ) && defined( 'ICL_SITEPRESS_VERSION' ) ) {
			if ( function_exists( 'wpml_get_current_language' ) ) {
				$current_language = wpml_get_current_language();
			} elseif ( function_exists( 'icl_get_current_language' ) ) {
				$current_language = icl_get_current_language();
			}
		}

		return $current_language;
	}
}

if ( ! function_exists( 'csco_set_ajax_lang' ) ) {
	/**
	 * Set proper lang for AJAX requests
	 */
	function csco_set_ajax_lang() {
		// Check Nonce.
		wp_verify_nonce( null );

		if ( isset( $_REQUEST['current_lang'] ) && $_REQUEST['current_lang'] ) { // Input var ok.
			$lang = sanitize_text_field( $_REQUEST['current_lang'] ); // Input var ok.

			// Polylang.
			if ( function_exists( 'pll_current_language' ) ) {
				add_action(
					'pre_get_posts',
					function ( $query ) use ( $lang ) {
						$query->set( 'lang', $lang );
					},
					999
				);
			}

			// WPML.
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				add_filter(
					'wpml_current_language',
					function () use ( $lang ) {
						return $lang;
					},
					999
				);
			}
		}
	}
}

if ( ! function_exists( 'csco_set_ajax_locale' ) ) {
	/**
	 * Set proper locale for AJAX requests
	 */
	function csco_set_ajax_locale() {
		// Check Nonce.
		wp_verify_nonce( null );

		if ( isset( $_REQUEST['current_locale'] ) && $_REQUEST['current_locale'] ) { // Input var ok.
			$locale = sanitize_text_field( $_REQUEST['current_locale'] ); // Input var ok.

			// Force set locale for this request.
			add_filter(
				'locale',
				function () use ( $locale ) {
					return $locale;
				},
				999
			);

			// Reload text domain with correct locale.
			if ( function_exists( 'switch_to_locale' ) ) {
				switch_to_locale( $locale );
			}

			// For Loco Translate compatibility.
			if ( class_exists( 'Loco_Locale' ) ) {
				$loco_locale = Loco_Locale::parse( $locale );
				if ( $loco_locale ) {
					apply_filters( 'loco_current_locale', $loco_locale );
				}
			}

			// Reload theme textdomain.
			load_theme_textdomain( 'flux', get_template_directory() . '/languages' );
		}
	}
}

if ( ! function_exists( 'csco_get_theme_data' ) ) {
	/**
	 * Get data about the theme.
	 *
	 * @param mixed $name The name of param.
	 */
	function csco_get_theme_data( $name ) {
		$theme = wp_get_theme( get_template() );

		return $theme->get( $name );
	}
}

if ( ! function_exists( 'csco_encode_data' ) ) {
	/**
	 * Encode data
	 *
	 * @param  mixed  $content    The content.
	 * @param  string $secret_key The key.
	 * @return string
	 */
	function csco_encode_data( $content, $secret_key = 'flux' ) {

		$content = wp_json_encode( $content );

		return call_user_func( sprintf( 'base64_%s', 'encode' ), $content );
	}
}

if ( ! function_exists( 'csco_decode_data' ) ) {
	/**
	 * Decode data
	 *
	 * @param  string $content    The content.
	 * @param  string $secret_key The key.
	 * @return string
	 */
	function csco_decode_data( $content, $secret_key = 'flux' ) {

		$content = call_user_func( sprintf( 'base64_%s', 'decode' ), $content );

		return json_decode( $content, true );
	}
}

if ( ! function_exists( 'csco_hex2rgba' ) ) {
	/**
	 * Convert hex to rgb.
	 *
	 * @param mixed $hex    Color.
	 * @param bool  $format Format.
	 */
	function csco_hex2rgba( $hex, $format = true ) {
		$hex = trim( $hex, ' #' );

		$size = strlen( $hex );
		if ( 3 === $size || 4 === $size ) {
			$parts = str_split( $hex, 1 );
			$hex   = '';
			foreach ( $parts as $row ) {
				$hex .= $row . $row;
			}
		}

		$dec = hexdec( $hex );
		$rgb = array();

		if ( 3 === $size || 6 === $size ) {
			$rgb['red']   = 0xFF & ( $dec >> 0x10 );
			$rgb['green'] = 0xFF & ( $dec >> 0x8 );
			$rgb['blue']  = 0xFF & $dec;

			$output = implode( ',', $rgb );

			if ( $format ) {
				$output = sprintf( 'rgba(%s, 1)', $output );
			}

			return $output;
		} elseif ( 5 === $size || 8 === $size ) {
			$rgb['red']   = 0xFF & ( $dec >> 0x16 );
			$rgb['green'] = 0xFF & ( $dec >> 0x10 );
			$rgb['blue']  = 0xFF & ( $dec >> 0x8 );

			$output = implode( ',', $rgb );

			if ( $format ) {
				$alpha = 0xFF & $dec;

				$output = sprintf( 'rgba(%s, %s)', $output, round( ( $alpha / ( 255 / 100 ) ) / 100, 2 ) );
			}

			return $output;
		}
	}
}

if ( ! function_exists( 'csco_rgba2hex' ) ) {
	/**
	 * Convert rgba to hex.
	 *
	 * @param mixed $color Color.
	 */
	function csco_rgba2hex( $color ) {
		if ( isset( $color[0] ) && '#' === $color[0] ) {
			return $color;
		}

		$rgba = array();

		if ( preg_match_all( '#\((([^()]+|(?R))*)\)#', $color, $matches ) ) {
			$rgba = explode( ',', implode( ' ', $matches[1] ) );
		} else {
			$rgba = explode( ',', $color );
		}

		$rr = dechex( $rgba['0'] );
		$gg = dechex( $rgba['1'] );
		$bb = dechex( $rgba['2'] );

		if ( array_key_exists( '3', $rgba ) ) {
			$aa = dechex( $rgba['3'] * 255 );

			return strtoupper( "#$aa$rr$gg$bb" );
		} else {
			return strtoupper( "#$rr$gg$bb" );
		}
	}
}

if ( ! function_exists( 'csco_get_round_number' ) ) {
	/**
	 * Get rounded number.
	 *
	 * @param int $number    Input number.
	 * @param int $min_value Minimum value to round number.
	 * @param int $decimal   How may decimals shall be in the rounded number.
	 */
	function csco_get_round_number( $number, $min_value = 1000, $decimal = 1 ) {
		if ( $number < $min_value ) {
			return number_format_i18n( $number );
		}
		$alphabets = array(
			1000000000 => esc_html__( 'B', 'flux' ),
			1000000    => esc_html__( 'M', 'flux' ),
			1000       => esc_html__( 'K', 'flux' ),
		);
		foreach ( $alphabets as $key => $value ) {
			if ( $number >= $key ) {
				return number_format_i18n( round( $number / $key, $decimal ), $decimal ) . $value;
			}
		}
	}
}

if ( ! function_exists( 'csco_the_round_number' ) ) {
	/**
	 * Echo rounded number.
	 *
	 * @param int $number    Input number.
	 * @param int $min_value Minimum value to round number.
	 * @param int $decimal   How may decimals shall be in the rounded number.
	 */
	function csco_the_round_number( $number, $min_value = 1000, $decimal = 1 ) {
		echo esc_html( csco_get_round_number( $number, $min_value, $decimal ) );
	}
}

if ( ! function_exists( 'csco_str_truncate' ) ) {
	/**
	 * Truncates string with specified length
	 *
	 * @param  string $string      Text string.
	 * @param  int    $length      Letters length.
	 * @param  string $etc         End truncate.
	 * @param  bool   $break_words Break words or not.
	 * @return string
	 */
	function csco_str_truncate( $string, $length = 80, $etc = '&hellip;', $break_words = false ) {
		if ( 0 === $length ) {
			return '';
		}

		if ( function_exists( 'mb_strlen' ) ) {
			// MultiBite string functions.
			if ( mb_strlen( $string ) > $length ) {
				$length -= min( $length, mb_strlen( $etc ) );
				if ( ! $break_words ) {
					$string = preg_replace( '/\s+?(\S+)?$/', '', mb_substr( $string, 0, $length + 1 ) );
				}

				return mb_substr( $string, 0, $length ) . $etc;
			}
		} else {
			// Default string functions.
			if ( strlen( $string ) > $length ) {
				$length -= min( $length, strlen( $etc ) );
				if ( ! $break_words ) {
					$string = preg_replace( '/\s+?(\S+)?$/', '', substr( $string, 0, $length + 1 ) );
				}

				return substr( $string, 0, $length ) . $etc;
			}
		}

		return $string;
	}
}

if ( ! function_exists( 'csco_convert_retina_link' ) ) {
	/**
	 * Convert retina link.
	 *
	 * @param array  $dirname   Dirname.
	 * @param string $filename  Original filename.
	 * @param string $extension File extension.
	 *
	 * @return string Converted URL with the '@2x' suffix.
	 */
	function csco_convert_retina_link( $dirname, $filename, $extension ) {
		$filename_parts = explode( '-', $filename );

		$last_part = end( $filename_parts );

		if ( is_numeric( $last_part ) ) {
			array_pop( $filename_parts );
		}

		$filename = implode( '-', $filename_parts );

		$filename = $filename . '@2x';

		if ( is_numeric( $last_part ) ) {
			$filename = $filename . '-' . $last_part;
		}

		$new_url = $dirname . '/' . $filename . '.' . $extension;

		return $new_url;
	}
}

if ( ! function_exists( 'csco_get_retina_image' ) ) {
	/**
	 * Get retina image.
	 *
	 * @param int    $attachment_id Image attachment ID.
	 * @param array  $attr Attributes for the image markup. Default empty.
	 * @param string $type The tag of type.
	 * @param bool   $output Defualt true.
	 * @return string|void
	 */
	function csco_get_retina_image( $attachment_id, $attr = array(), $type = 'img', $output = true ) {
		$attachment_url = wp_get_attachment_url( $attachment_id );

		// Retina image.
		$attached_file = get_attached_file( $attachment_id );

		if ( $attached_file ) {
			$uriinfo  = pathinfo( $attachment_url );
			$pathinfo = pathinfo( $attached_file );

			$retina_uri  = sprintf( '%s/%s@2x.%s', $uriinfo['dirname'], $uriinfo['filename'], $uriinfo['extension'] );
			$retina_file = sprintf( '%s/%s@2x.%s', $pathinfo['dirname'], $pathinfo['filename'], $pathinfo['extension'] );

			if ( file_exists( $retina_file ) ) {
				$attr['srcset'] = sprintf( '%s 1x, %s 2x', $attachment_url, $retina_uri );
			} else {
				$retina_uri  = csco_convert_retina_link( $uriinfo['dirname'], $uriinfo['filename'], $uriinfo['extension'] );
				$retina_file = csco_convert_retina_link( $pathinfo['dirname'], $pathinfo['filename'], $pathinfo['extension'] );

				if ( file_exists( $retina_file ) ) {
					$attr['srcset'] = sprintf( '%s 1x, %s 2x', $attachment_url, $retina_uri );
				}
			}
		}

		// Sizes.
		if ( 'amp-img' === $type || 'logo' === $type ) {
			$data = wp_get_attachment_image_src( $attachment_id, 'full' );

			if ( isset( $data[1] ) ) {
				$attr['width'] = $data[1];
			}
			if ( isset( $data[2] ) ) {
				$attr['height'] = $data[2];
			}

			// Calc max height and set new width depending on proportion.
			if ( isset( $attr['width'] ) && isset( $attr['height'] ) ) {
				/**
				 * The csco_amp_navbar_height hook.
				 *
				 * @since 1.0.0
				 */
				if ( 'amp-img' === $type ) {
					$max_height = apply_filters( 'csco_amp_navbar_height', 72 ) - 20;
				} elseif ( 'logo' === $type ) {
					$header_height = get_theme_mod( 'header_height', 72 );
					$header_height = (int) $header_height;
					$max_height    = $header_height - 20;
				}

				if ( $max_height > 0 && $attr['height'] > $max_height ) {
					$attr['width'] = $attr['width'] / $attr['height'] * $max_height;

					$attr['height'] = $max_height;
				}
			}

			if ( 'logo' === $type ) {
				$type = 'img';
			}
		}

		// Attr.
		$attr_output = __return_null();

		foreach ( $attr as $name => $value ) {
			$attr_output .= sprintf( ' %s="%s" ', esc_attr( $name ), esc_attr( $value ) );
		}

		// Generate the HTML for the image.
		$image_tag = sprintf( '<%1$s src="%2$s"%3$s>', esc_attr( $type ), esc_url( $attachment_url ), $attr_output );

		// Print or return the image HTML based on the $print parameter.
		if ( $output ) {
			$allowed_html = array(
				'img' => array(
					'src'     => true,
					'alt'     => true,
					'width'   => true,
					'height'  => true,
					'srcset'  => true,
					'sizes'   => true,
					'class'   => true,
					'id'      => true,
					'style'   => true,
					'title'   => true,
					'loading' => true,
				),
			);

			echo wp_kses( $image_tag, $allowed_html );
		} else {
			return $image_tag;
		}
	}
}

if ( ! function_exists( 'csco_offcanvas_exists' ) ) {
	/**
	 * Check if offcanvas exists.
	 */
	function csco_offcanvas_exists() {
		$locations = get_nav_menu_locations();

		if ( isset( $locations['primary'] ) || isset( $locations['mobile'] ) || is_active_sidebar( 'sidebar-offcanvas' ) ) {
			return true;
		}
	}
}

if ( ! function_exists( 'csco_site_content_class' ) ) {
	/**
	 * Display the classes for the cs-site-content element.
	 *
	 * @param array $class Classes to add to the class list.
	 */
	function csco_site_content_class( $class = array() ) {
		$class[] = 'cs-site-content';

		/**
		 * The csco_site_content_class hook.
		 *
		 * @since 1.0.0
		 */
		$class = apply_filters( 'csco_site_content_class', $class );

		// Separates classes with a single space, collates classes.
		printf( 'class="%s"', esc_attr( join( ' ', $class ) ) );
	}
}

if ( ! function_exists( 'csco_site_submenu_class' ) ) {
	/**
	 * Display the classes for the site-submenu element.
	 *
	 * @param array $class Classes to add to the class list.
	 */
	function csco_site_submenu_class( $class = array() ) {
		$class[] = 'cs-site-submenu';

		/**
		 * The csco_site_submenu_class hook.
		 *
		 * @since 1.0.0
		 */
		$class = apply_filters( 'csco_site_submenu_class', $class );

		// Separates classes with a single space, collates classes.
		printf( 'class="%s"', esc_attr( join( ' ', $class ) ) );
	}
}

if ( ! function_exists( 'csco_site_scheme_data' ) ) {
	/**
	 * Get site scheme data
	 */
	function csco_site_scheme_data() {

		// Get options.
		$color_scheme = get_theme_mod( 'color_scheme', 'system' ); // Field. User’s system preference.
		$color_toggle = get_theme_mod( 'color_scheme_toggle', true ); // Field. Enable dark/light mode toggle.

		// Set site scheme.
		$site_scheme = __return_empty_string();

		switch ( $color_scheme ) {
			case 'dark':
				$site_scheme = 'dark';
				break;
			case 'light':
				$site_scheme = 'light';
				break;
			case 'system':
				$site_scheme = 'auto';
				break;
		}

		if ( $color_toggle ) {
			if ( isset( $_COOKIE['_color_schema'] ) && 'light' === $_COOKIE['_color_schema'] ) {
				$site_scheme = 'light';
			}
			if ( isset( $_COOKIE['_color_schema'] ) && 'dark' === $_COOKIE['_color_schema'] ) {
				$site_scheme = 'dark';
			}
		}

		return $site_scheme;
	}
}

if ( ! function_exists( 'csco_get_the_excerpt' ) ) {
	/**
	 * Filters the number of words in an excerpt.
	 */
	function csco_get_the_excerpt_length() {
		return 5000;
	}

	/**
	 * Get excerpt of post.
	 *
	 * @param int    $length      Letters length.
	 * @param string $etc         End truncate.
	 * @param bool   $break_words Break words or not.
	 */
	function csco_get_the_excerpt( $length = 80, $etc = '&hellip;', $break_words = false ) {
		add_filter( 'excerpt_length', 'csco_get_the_excerpt_length' );

		$excerpt = get_the_excerpt();

		call_user_func( 'remove_filter', 'excerpt_length', 'csco_get_the_excerpt_length' );

		return csco_str_truncate( $excerpt, $length, $etc, $break_words );
	}
}
if ( ! function_exists( 'csco_get_video_id' ) ) {
	/**
	 * Get video ID from URL based on the provider
	 *
	 * @param string $url Video URL.
	 * @param string $provider Video provider (youtube, self).
	 * @return string|bool Video ID or false if not found.
	 */
	function csco_get_video_id( $url, &$provider ) {
		if ( strpos( $url, 'youtube' ) !== false || strpos( $url, 'youtu.be' ) !== false ) {
			$provider = 'youtube';
			preg_match( '/(?:youtube\.com\/.*[?&]v=|youtu\.be\/|embed\/)([a-z_A-Z0-9\-]{11})/i', $url, $matches );
			return $matches[1] ?? false;
		} elseif ( strpos( $url, '.mp4' ) !== false ||
			strpos( $url, '.m4v' ) !== false ||
			strpos( $url, '.webm' ) !== false ||
			strpos( $url, '.ogv' ) !== false ||
			strpos( $url, '.mov' ) !== false ||
			strpos( $url, '.wmv' ) !== false ||
			strpos( $url, '.avi' ) !== false ||
			strpos( $url, '.flv' ) !== false ||
			strpos( $url, '.3gp' ) !== false
		) {
			$provider = 'self';
			return $url;
		}
		return false;
	}
}


if ( ! function_exists( 'csco_get_video_background' ) ) {
	/**
	 * Get element video background
	 *
	 * @param string $location The current location.
	 * @param int    $post_id  The id of post.
	 * @param string $template Template.
	 * @param bool   $controls Display controls.
	 * @param bool   $link     Display link.
	 * @param bool   $volume   Display volume.
	 */
	function csco_get_video_background( $location = null, $post_id = null, $template = 'default', $controls = true, $link = true, $volume = true ) {
		if ( csco_is_context_editor() || is_customize_preview() ) {
			return;
		}

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$url    = get_post_meta( $post_id, 'csco_post_video_url', true );
		$start  = get_post_meta( $post_id, 'csco_post_video_bg_start_time', true );
		$end    = get_post_meta( $post_id, 'csco_post_video_bg_end_time', true );
		$volume = get_post_meta( $post_id, 'csco_post_video_bg_volume', true );

		if ( $location ) {
			$support = (array) get_post_meta( $post_id, 'csco_post_video_location', true );

			if ( 'home' === $location ) {
				$location = 'archive';
			}

			if ( ! in_array( $location, $support, true ) ) {
				return;
			}
		}

		$provider = __return_empty_string();

		$id = csco_get_video_id( $url, $provider );

		if ( $id ) {
			?>
			<div class="cs-video-wrapper" data-video-id="<?php echo esc_attr( $id ); ?>" data-video-provider="<?php echo esc_attr( $provider ); ?>" data-video-start="<?php echo esc_attr( (int) $start ); ?>" data-video-end="<?php echo esc_attr( (int) $end ); ?>">
				<div class="cs-video-inner">
					<?php if ( 'self' === $provider ) { ?>
						<video src="<?php echo esc_url( $id ); ?>" autoplay loop muted playsinline></video>
					<?php } ?>
				</div>
				<div class="cs-video-loader"></div>
			</div>
			<?php if ( $controls ) { ?>
				<div class="cs-video-controls cs-video-controls-<?php echo esc_attr( $template ); ?>">
					<?php if ( $link && 'youtube' === $provider ) { ?>
						<a class="cs-player-control cs-player-link cs-player-stop" target="_blank" href="<?php echo esc_url( $url ); ?>">
							<span class="cs-tooltip">
								<span>
									<?php echo esc_html__( 'View on YouTube', 'flux' ); ?>
								</span>
							</span>
						</a>
					<?php } ?>
					<span class="cs-player-control cs-player-state cs-player-pause"></span>
					<?php if ( $volume ) { ?>
						<span class="cs-player-control cs-player-volume cs-player-mute"></span>
					<?php } ?>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'csco_get_archive_location' ) ) {
	/**
	 * Returns Archive Location.
	 */
	function csco_get_archive_location() {

		global $wp_query;

		if ( isset( $wp_query->query_vars['csco_query']['location'] ) ) {

			return $wp_query->query_vars['csco_query']['location'];
		}

		if ( is_home() ) {

			return 'home';

		} elseif ( is_search() ) {

			return 'search';

		} elseif ( is_author() ) {

			return 'author';

		} else {

			return 'archive';
		}
	}
}

if ( ! function_exists( 'csco_get_archive_option' ) ) {
	/**
	 * Returns Archive Option Name.
	 *
	 * @param string $option_name The customize option name.
	 */
	function csco_get_archive_option( $option_name ) {

		return csco_get_archive_location() . '_' . $option_name;
	}
}

if ( ! function_exists( 'csco_get_archive_options' ) ) {
	/**
	 * Returns Archive Options.
	 */
	function csco_get_archive_options() {
		$options = array(
			'location'          => csco_get_archive_location(),
			'meta'              => csco_get_archive_option( 'post_meta' ),
			'layout'            => get_theme_mod( csco_get_archive_option( 'layout' ), 'grid' ),
			'columns'           => get_theme_mod( csco_get_archive_option( 'columns_desktop' ), 2 ),
			'image_orientation' => get_theme_mod( csco_get_archive_option( 'image_orientation' ), 'landscape-16-9' ),
			'image_size_mobile' => 'csco-thumbnail',
			'image_size'        => get_theme_mod( csco_get_archive_option( 'image_size' ), 'csco-thumbnail' ),
			'summary_type'      => get_theme_mod( csco_get_archive_option( 'summary' ), 'summary' ),
			'excerpt'           => get_theme_mod( csco_get_archive_option( 'excerpt' ), false ),
		);

		/**
		 * The csco_get_archive_options hook.
		 *
		 * @since 1.0.0
		 */
		$options = apply_filters( 'csco_get_archive_options', $options );

		return $options;
	}
}

if ( ! function_exists( 'csco_get_page_preview' ) ) {
	/**
	 * Returns Page Preview.
	 */
	function csco_get_page_preview() {

		if ( is_home() ) {
			/**
			 * The csco_page_media_preview hook.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'csco_page_media_preview', get_theme_mod( 'home_media_preview', 'uncropped' ) );
		}

		if ( is_singular( array( 'post', 'page' ) ) ) {
			$post_type = get_post_type( get_queried_object_id() );

			/**
			 * The csco_page_media_preview hook.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'csco_page_media_preview', get_theme_mod( $post_type . '_media_preview', 'uncropped' ) );
		}

		if ( is_archive() ) {
			/**
			 * The csco_page_media_preview hook.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'csco_page_media_preview', get_theme_mod( 'archive_media_preview', 'uncropped' ) );
		}

		if ( is_404() ) {
			/**
			 * The csco_page_media_preview hook.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'csco_page_media_preview', 'uncropped' );
		}

		/**
		 * The csco_page_media_preview hook.
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'csco_page_media_preview', 'uncropped' );
	}
}

if ( ! function_exists( 'csco_get_page_sidebar' ) ) {
	/**
	 * Returns Page Sidebar: right, left or disabled.
	 *
	 * @param int    $post_id The ID of post.
	 * @param string $layout  The layout of post.
	 */
	function csco_get_page_sidebar( $post_id = false, $layout = false ) {

		/**
		 * The csco_sidebar hook.
		 *
		 * @since 1.0.0
		 */
		$location = apply_filters( 'csco_sidebar', 'sidebar-main' );

		if ( ! is_active_sidebar( $location ) ) {
			return 'disabled';
		}

		$home_id = __return_false();

		$page_on_front  = (int) get_option( 'page_on_front' );
		$page_for_posts = (int) get_option( 'page_for_posts' );

		if ( 'page' === get_option( 'show_on_front', 'posts' ) ) {
			if ( $post_id && (int) $post_id === $page_on_front ) {
				$home_id = $post_id;
			}
		}

		if ( is_home() || $home_id ) {

			$show_on_front = get_option( 'show_on_front', 'posts' );

			if ( 'posts' === $show_on_front ) {
				return apply_filters( 'csco_page_sidebar', get_theme_mod( 'home_sidebar', 'right' ) );
			}

			if ( 'page' === $show_on_front && ( $page_on_front || $page_for_posts ) ) {
				return apply_filters( 'csco_page_sidebar', get_theme_mod( 'home_sidebar', 'right' ) );
			}

			if ( 'page' === $show_on_front ) {

				$home_id = $home_id ? $home_id : get_queried_object_id();

				// Get layout for the blog posts page.
				if ( ! $layout ) {
					$layout = get_post_meta( $home_id, 'csco_singular_sidebar', true );
				}

				if ( ! $layout || 'default' === $layout ) {

					return apply_filters( 'csco_page_sidebar', get_theme_mod( 'page_sidebar', 'right' ) );
				}

				return apply_filters( 'csco_page_sidebar', $layout );
			}
		}

		if ( is_singular( array( 'post', 'page' ) ) || $post_id ) {

			$post_id = $post_id ? $post_id : get_queried_object_id();

			// Get layout for current post.
			if ( ! $layout ) {
				$layout = get_post_meta( $post_id, 'csco_singular_sidebar', true );
			}

			if ( ! $layout || 'default' === $layout ) {

				$post_type = get_post_type( $post_id );

				return apply_filters( 'csco_page_sidebar', get_theme_mod( $post_type . '_sidebar', 'right' ) );
			}

			return apply_filters( 'csco_page_sidebar', $layout );
		}

		if ( is_archive() ) {

			if ( is_author() ) {
				return apply_filters( 'csco_page_sidebar', get_theme_mod( 'author_sidebar', 'disabled' ) );
			}

			return apply_filters( 'csco_page_sidebar', get_theme_mod( 'archive_sidebar', 'right' ) );
		}

		if ( is_search() ) {

			return apply_filters( 'csco_page_sidebar', get_theme_mod( 'search_sidebar', 'disabled' ) );
		}

		if ( is_404() ) {

			return apply_filters( 'csco_page_sidebar', 'disabled' );
		}

		return apply_filters( 'csco_page_sidebar', 'right' );
	}
}

if ( ! function_exists( 'csco_get_page_header_type' ) ) {
	/**
	 * Returns Page Header
	 */
	function csco_get_page_header_type() {

		$allow = array( 'none', 'standard', 'featured', 'featured_overlap', 'overlay', 'title' );

		if ( is_singular( array( 'post', 'page' ) ) ) {
			$page_header_type = get_post_meta( get_queried_object_id(), 'csco_page_header_type', true );

			if ( ! in_array( $page_header_type, $allow, true ) || 'default' === $page_header_type ) {
				$post_type = get_post_type( get_queried_object_id() );

				/**
				 * The csco_page_header_type hook.
				 *
				 * @since 1.0.0
				 */
				return apply_filters( 'csco_page_header_type', get_theme_mod( $post_type . '_header_type', 'standard' ) );
			}

			/**
			 * The csco_page_header_type hook.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'csco_page_header_type', $page_header_type );
		}

		/**
		 * The csco_page_header_type hook.
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'csco_page_header_type', 'standard' );
	}
}

if ( ! function_exists( 'csco_get_state_load_nextpost' ) ) {
	/**
	 * State Auto Load Next Post.
	 */
	function csco_get_state_load_nextpost() {

		if ( is_singular( 'post' ) ) {
			$page_load_nextpost = get_post_meta( get_queried_object_id(), 'csco_page_load_nextpost', true );

			if ( ! $page_load_nextpost || 'default' === $page_load_nextpost ) {
				return apply_filters( 'csco_page_load_nextpost', get_theme_mod( 'post_load_nextpost', false ) );
			}

			$page_load_nextpost = 'enabled' === $page_load_nextpost ? true : false;

			return apply_filters( 'csco_page_load_nextpost', $page_load_nextpost );
		}

		return apply_filters( 'csco_page_load_nextpost', false );
	}
}

if ( ! function_exists( 'csco_post_views_enabled' ) ) {
	/**
	 * Check post views module.
	 *
	 * @return string Type.
	 */
	function csco_post_views_enabled() {

		// Post Views Counter.
		if ( class_exists( 'Post_Views_Counter' ) ) {
			return 'post_views';
		}
	}
}

if ( ! function_exists( 'csco_get_page_id_by_title' ) ) {
	/**
	 * Get page id by title
	 *
	 * @param string $title Page title.
	 */
	function csco_get_page_id_by_title( $title ) {
		$query = new WP_Query();

		$pages = $query->query(
			array(
				'post_type' => 'page',
				'title'     => $title,
			)
		);

		if ( $pages ) {
			foreach ( $pages as $find_page ) {
				return $find_page->ID;
			}
		}
	}
}

if ( ! function_exists( 'csco_breadcrumbs' ) ) {
	/**
	 * SEO Breadcrumbs
	 */
	function csco_breadcrumbs() {

		if ( csco_doing_request() ) {
			return;
		}

		ob_start();

		$wrap_before = '<div class="cs-breadcrumbs" id="breadcrumbs">';
		$wrap_after  = '</div>';

		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( $wrap_before, $wrap_after );
		} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
			$args = array(
				'wrap_before' => $wrap_before,
				'wrap_after'  => $wrap_after,
			);
			rank_math_the_breadcrumbs( $args );
		} elseif ( function_exists( 'aioseo_breadcrumbs' ) ) {
			$breadcrumbs = str_replace( '<div class="aioseo-breadcrumbs">', $wrap_before, aioseo_breadcrumbs( false ) );
			echo wp_kses_post( $breadcrumbs );
		}

		$output_breadcrumbs = ob_get_clean();

		/**
		 * The csco_breadcrumbs hook.
		 *
		 * @since 1.0.0
		 */
		$output_breadcrumbs = apply_filters( 'csco_breadcrumbs', $output_breadcrumbs );

		$output_breadcrumbs = '<div class="cs-container">' . $output_breadcrumbs . '</div>';

		call_user_func( 'printf', '%s', $output_breadcrumbs );
	}
}

if ( ! function_exists( 'csco_get_available_image_sizes' ) ) {
	/**
	 * Get the available image sizes
	 */
	function csco_get_available_image_sizes() {
		$wais = & $GLOBALS['_wp_additional_image_sizes'];

		$sizes       = array();
		$image_sizes = get_intermediate_image_sizes();

		if ( is_array( $image_sizes ) && $image_sizes ) {
			foreach ( $image_sizes as $size ) {
				if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ), true ) ) {
					$sizes[ $size ] = array(
						'width'  => get_option( "{$size}_size_w" ),
						'height' => get_option( "{$size}_size_h" ),
						'crop'   => (bool) get_option( "{$size}_crop" ),
					);
				} elseif ( isset( $wais[ $size ] ) ) {
					$sizes[ $size ] = array(
						'width'  => $wais[ $size ]['width'],
						'height' => $wais[ $size ]['height'],
						'crop'   => $wais[ $size ]['crop'],
					);
				}

				// Size registered, but has 0 width and height.
				if ( 0 === (int) $sizes[ $size ]['width'] && 0 === (int) $sizes[ $size ]['height'] ) {
					unset( $sizes[ $size ] );
				}
			}
		}

		return $sizes;
	}
}

if ( ! function_exists( 'csco_get_image_size' ) ) {
	/**
	 * Gets the data of a specific image size.
	 *
	 * @param string $size Name of the size.
	 */
	function csco_get_image_size( $size ) {
		if ( ! is_string( $size ) ) {
			return;
		}

		$sizes = csco_get_available_image_sizes();

		return isset( $sizes[ $size ] ) ? $sizes[ $size ] : false;
	}
}

if ( ! function_exists( 'csco_get_list_available_image_sizes' ) ) {
	/**
	 * Get the list available image sizes
	 */
	function csco_get_list_available_image_sizes() {

		$image_sizes = wp_cache_get( 'csco_available_image_sizes' );

		if ( empty( $image_sizes ) ) {
			$image_sizes = array();

			$intermediate_image_sizes = get_intermediate_image_sizes();

			foreach ( $intermediate_image_sizes as $size ) {
				$image_sizes[ $size ] = $size;

				$data = csco_get_image_size( $size );

				if ( isset( $data['width'] ) || isset( $data['height'] ) ) {
					$width  = '~';
					$height = '~';

					if ( isset( $data['width'] ) && $data['width'] ) {
						$width = $data['width'] . 'px';
					}
					if ( isset( $data['height'] ) && $data['height'] ) {
						$height = $data['height'] . 'px';
					}

					$image_sizes[ $size ] .= sprintf( ' [%s, %s]', $width, $height );
				}
			}

			wp_cache_set( 'csco_available_image_sizes', $image_sizes );
		}

		return $image_sizes;
	}
}

if ( ! function_exists( 'csco_get_post_types_stack' ) ) {
	/**
	 * Get stack post types.
	 */
	function csco_get_post_types_stack() {

		$stack = wp_cache_get( 'csco_get_post_types_stack' );

		if ( ! $stack ) {
			$stack = array();

			$post_types = get_post_types( array( 'publicly_queryable' => 1 ), 'objects' );

			unset( $post_types['attachment'] );

			foreach ( $post_types as $post_type ) {
				$stack[ $post_type->name ] = $post_type->label;
			}

			wp_cache_set( 'csco_get_post_types_stack', $stack );
		}

		return $stack ? $stack : array();
	}
}

if ( ! function_exists( 'csco_get_categories_stack' ) ) {
	/**
	 * Get stack categories.
	 */
	function csco_get_categories_stack() {

		$stack = wp_cache_get( 'csco_get_categories_stack' );

		if ( ! $stack ) {
			$stack = array();

			$categories = get_terms(
				array(
					'taxonomy'   => 'category',
					'hide_empty' => false,
				)
			);

			foreach ( $categories as $category ) {
				$stack[ $category->term_id ] = $category->name;
			}

			wp_cache_set( 'csco_get_categories_stack', $stack );
		}

		return $stack ? $stack : array();
	}
}

if ( ! function_exists( 'csco_user_social_links' ) ) {
	/**
	 * User Social URLs
	 */
	function csco_user_social_links() {

		$options = array(
			'facebook'   => array(
				'key'  => 'facebook',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"><g clip-path="url(#clip0_540_5982)"><g clip-path="url(#clip1_540_5982)"><rect width="28" height="28" rx="14" fill="#066BDE"/><path d="M16.1391 19.104H18.8127L19.8821 14.8263H16.1391V12.6874C16.1391 11.5865 16.1391 10.5485 18.278 10.5485H19.8821V6.95525C19.5338 6.909 18.217 6.80542 16.8266 6.80542C13.9236 6.80542 11.8613 8.57734 11.8613 11.8315V14.8263H8.65295V19.104H11.8613V28.1943H16.1391V19.104Z" fill="white"/></g></g><defs><clipPath id="clip0_540_5982"><rect width="28" height="28" rx="14" fill="white"/></clipPath><clipPath id="clip1_540_5982"><rect width="28" height="28" rx="14" fill="white"/></clipPath></defs></svg>',
			),
			'twitter'    => array(
				'key'     => 'twitter',
				'prepend' => 'https://twitter.com/',
				'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"><rect width="28" height="28" rx="14" fill="black"/><path d="M11.3556 7.77783H7L12.1401 14.6313L7.27997 20.2222H8.92888L12.9038 15.6496L16.3333 20.2223H20.6889L15.3326 13.0806L19.9423 7.77783H18.2934L14.5689 12.0623L11.3556 7.77783ZM16.9556 18.9778L9.48889 9.02228H10.7333L18.2 18.9778H16.9556Z" fill="white"/></svg>',
			),
			'instagram'  => array(
				'key'  => 'instagram',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"><rect width="28" height="28" rx="14" fill="url(#paint0_linear_540_5931)"/><path d="M14 11.9C12.8398 11.9 11.9 12.8402 11.9 14C11.9 15.1601 12.8402 16.1 14 16.1C15.1601 16.1 16.1 15.1598 16.1 14C16.1 12.8399 15.1598 11.9 14 11.9ZM14 10.5C15.9323 10.5 17.5 12.066 17.5 14C17.5 15.9323 15.934 17.5 14 17.5C12.0677 17.5 10.5 15.934 10.5 14C10.5 12.0677 12.066 10.5 14 10.5ZM18.55 10.3244C18.55 10.8075 18.1574 11.1994 17.675 11.1994C17.1919 11.1994 16.8 10.8069 16.8 10.3244C16.8 9.84193 17.1925 9.45 17.675 9.45C18.1568 9.44939 18.55 9.84193 18.55 10.3244ZM14 8.4C12.2679 8.4 11.9855 8.40458 11.1799 8.44046C10.631 8.46623 10.2631 8.54005 9.92122 8.67277C9.61742 8.79059 9.39827 8.93128 9.16478 9.16478C8.93038 9.39918 8.78994 9.61774 8.67259 9.92168C8.53956 10.2643 8.46576 10.6317 8.44046 11.1798C8.40423 11.9526 8.4 12.2227 8.4 14C8.4 15.7321 8.40458 16.0145 8.44045 16.82C8.46623 17.3687 8.54015 17.7372 8.67255 18.0782C8.79068 18.3824 8.93166 18.6021 9.16403 18.8345C9.39935 19.0695 9.61856 19.2104 9.91962 19.3266C10.2656 19.4603 10.6333 19.5343 11.1798 19.5595C11.9526 19.5957 12.2227 19.6 14 19.6C15.7322 19.6 16.0145 19.5954 16.82 19.5595C17.3675 19.5338 17.7363 19.4597 18.0782 19.3274C18.3816 19.2096 18.6019 19.0681 18.8345 18.8359C19.0698 18.6002 19.2105 18.3816 19.3268 18.0798C19.4602 17.7351 19.5343 17.3668 19.5595 16.8202C19.5957 16.0474 19.6 15.7772 19.6 14C19.6 12.2679 19.5954 11.9855 19.5595 11.18C19.5338 10.6323 19.4597 10.263 19.3272 9.92122C19.2097 9.61826 19.0685 9.39844 18.8352 9.16478C18.6004 8.93 18.3824 8.78985 18.0783 8.67259C17.7359 8.53968 17.368 8.46577 16.8202 8.44047C16.0474 8.40423 15.7772 8.4 14 8.4ZM14 7C15.9016 7 16.1391 7.007 16.8858 7.042C17.6306 7.07642 18.1388 7.19425 18.585 7.3675C19.0464 7.54542 19.4361 7.78575 19.8251 8.17483C20.2136 8.56392 20.454 8.95475 20.6325 9.415C20.8051 9.86067 20.923 10.3693 20.958 11.1142C20.9913 11.8609 21 12.0983 21 14C21 15.9017 20.993 16.1391 20.958 16.8857C20.9236 17.6307 20.8051 18.1387 20.6325 18.585C20.4546 19.0464 20.2136 19.436 19.8251 19.8252C19.4361 20.2137 19.0446 20.454 18.585 20.6325C18.1388 20.8052 17.6306 20.923 16.8858 20.958C16.1391 20.9912 15.9016 21 14 21C12.0983 21 11.8609 20.993 11.1142 20.958C10.3693 20.9235 9.86183 20.8052 9.415 20.6325C8.95416 20.4545 8.56391 20.2137 8.17483 19.8252C7.78575 19.436 7.546 19.0447 7.3675 18.585C7.19425 18.1387 7.077 17.6307 7.042 16.8857C7.00875 16.1391 7 15.9017 7 14C7 12.0983 7.007 11.8609 7.042 11.1142C7.07641 10.3687 7.19425 9.86125 7.3675 9.415C7.54541 8.95417 7.78575 8.56392 8.17483 8.17483C8.56391 7.78575 8.95475 7.546 9.415 7.3675C9.86125 7.19425 10.3687 7.077 11.1142 7.042C11.8609 7.00875 12.0983 7 14 7Z" fill="white"/><defs><linearGradient id="paint0_linear_540_5931" x1="5.6875" y1="0.21875" x2="24.0625" y2="28.2187" gradientUnits="userSpaceOnUse"><stop stop-color="#9117FC"/><stop offset="0.255" stop-color="#FD17CB"/><stop offset="0.595" stop-color="#FF2938"/><stop offset="1" stop-color="#FFC81B"/></linearGradient></defs></svg>',
			),
			'linkedin'   => array(
				'key'  => 'linkedin',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"><g clip-path="url(#clip0_829_17704)"><path d="M28 14C28 21.732 21.732 28 14 28C6.26801 28 0 21.732 0 14C0 6.26801 6.26801 0 14 0C21.732 0 28 6.26801 28 14Z" fill="white"/><path d="M14 0C6.26801 0 0 6.26801 0 14C0 21.732 6.26801 28 14 28C21.732 28 28 21.732 28 14C28 6.26801 21.732 0 14 0ZM10.2648 20.7683H7.19092V10.8376H10.2648V20.7683ZM8.71319 9.53713C7.7093 9.53713 6.89548 8.71667 6.89548 7.70475C6.89548 6.69272 7.70942 5.87231 8.71319 5.87231C9.71696 5.87231 10.5308 6.69272 10.5308 7.70475C10.5308 8.71673 9.71701 9.53713 8.71319 9.53713ZM21.7839 20.7683H18.725V15.5555C18.725 14.1258 18.1819 13.3277 17.0514 13.3277C15.821 13.3277 15.1783 14.1589 15.1783 15.5555V20.7683H12.2301V10.8376H15.1783V12.1751C15.1783 12.1751 16.0651 10.5347 18.1708 10.5347C20.2766 10.5347 21.784 11.8205 21.784 14.4803L21.7839 20.7683Z" fill="url(#paint0_linear_829_17704)"/></g><defs><linearGradient id="paint0_linear_829_17704" x1="4.10049" y1="4.10049" x2="23.8995" y2="23.8995" gradientUnits="userSpaceOnUse"><stop stop-color="#2489BE"/><stop offset="1" stop-color="#0575B3"/></linearGradient><clipPath id="clip0_829_17704"><rect width="28" height="28" fill="white"/></clipPath></defs></svg>',
			),
			'myspace'    => array(
				'key'  => 'myspace',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.8694 2H4.13063C2.95283 2 1.99854 2.95401 1.99854 4.13168V19.8683C1.99854 21.046 2.95283 22 4.13063 22H19.8694C21.0471 22 22.0015 21.046 22.0015 19.8683V4.13168C22.0015 2.95401 21.0471 2 19.8694 2ZM14.9898 5.58237C16.1037 5.58237 17.0066 6.48581 17.0066 7.60001C17.0066 8.71324 16.1037 9.61672 14.9898 9.61672C13.8754 9.61672 12.9725 8.71324 12.9725 7.60001C12.9725 6.48581 13.8754 5.58237 14.9898 5.58237ZM10.9258 6.2494C11.7837 6.2494 12.4814 6.94702 12.4814 7.80654C12.4814 8.66505 11.7838 9.36271 10.9258 9.36271C10.066 9.36271 9.36831 8.66505 9.36831 7.80654C9.36835 6.94702 10.066 6.2494 10.9258 6.2494ZM7.93989 6.75812C8.51765 6.75812 8.98734 7.22807 8.98734 7.80654C8.98734 8.38401 8.51769 8.85399 7.93989 8.85399C7.36209 8.85399 6.89185 8.38405 6.89185 7.80654C6.89185 7.22807 7.36213 6.75812 7.93989 6.75812ZM17.7152 17.946C17.7152 18.2126 17.4991 18.4287 17.2326 18.4287H12.4827C12.2161 18.4287 12 18.2126 12 17.946V15.5717H8.91045C8.64386 15.5717 8.42776 15.3556 8.42776 15.0891V13.4286H6.76732C6.50073 13.4286 6.28463 13.2125 6.28463 12.946V10.9286C6.28463 9.94244 7.08459 9.14289 8.07074 9.14289C8.7951 9.14289 9.41461 9.57543 9.6947 10.1949C10.0608 9.98644 10.4776 9.8571 10.9284 9.8571C11.8788 9.8571 12.6963 10.3945 13.119 11.1756C13.6017 10.8023 14.2003 10.5714 14.8576 10.5714C16.4359 10.5714 17.7152 11.8507 17.7152 13.4287V17.946Z" /></svg>',
			),
			'pinterest'  => array(
				'key'  => 'pinterest',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"><rect width="28" height="28" rx="14" fill="#E60023"/><path d="M23.9537 13.6818C23.9537 19.1049 19.5661 23.5012 14.1538 23.5012C8.74144 23.5012 4.35382 19.1049 4.35382 13.6818C4.35382 8.25867 8.74144 3.86244 14.1538 3.86244C19.5661 3.86244 23.9537 8.25867 23.9537 13.6818Z" fill="white"/><path d="M14.1535 3.8622C8.74119 3.8622 4.35358 8.2585 4.35358 13.6816C4.35358 17.8415 6.93668 21.3977 10.5822 22.8285C10.4965 22.0516 10.4191 20.8568 10.6162 20.0086C10.7943 19.2423 11.7653 15.1278 11.7653 15.1278C11.7653 15.1278 11.4722 14.5395 11.4722 13.6699C11.4722 12.3045 12.262 11.2852 13.2455 11.2852C14.0816 11.2852 14.4854 11.9141 14.4854 12.6683C14.4854 13.5108 13.9501 14.7705 13.6738 15.9377C13.4429 16.9151 14.1629 17.7121 15.125 17.7121C16.8668 17.7121 18.2057 15.8719 18.2057 13.2156C18.2057 10.8645 16.5197 9.2207 14.1122 9.2207C11.3237 9.2207 9.68703 11.3163 9.68703 13.482C9.68703 14.326 10.0115 15.2309 10.4164 15.7229C10.4965 15.8201 10.5082 15.9053 10.4843 16.0046C10.4099 16.3147 10.2446 16.9816 10.2122 17.1182C10.1694 17.2979 10.0701 17.336 9.88441 17.2494C8.66046 16.6786 7.89521 14.8856 7.89521 13.4454C7.89521 10.3479 10.1413 7.50325 14.3704 7.50325C17.77 7.50325 20.4119 9.93056 20.4119 13.1745C20.4119 16.5586 18.2824 19.2821 15.3266 19.2821C14.3336 19.2821 13.4 18.7652 13.0805 18.1546C13.0805 18.1546 12.5891 20.0294 12.4699 20.4888C12.2487 21.3417 11.6514 22.4108 11.2519 23.063C12.1688 23.3475 13.1433 23.5009 14.1535 23.5009C19.566 23.5009 23.9536 19.1046 23.9536 13.6816C23.9536 8.2585 19.566 3.8622 14.1535 3.8622Z" fill="#E60023"/></svg>',
			),
			'youtube'    => array(
				'key'  => 'youtube',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none"><rect width="28" height="28" rx="14" fill="#F60004"/><path d="M14.1882 7.84009C14.5995 7.84235 15.6285 7.8523 16.7218 7.89609L17.1094 7.91299C18.2102 7.96511 19.31 8.05414 19.8555 8.20624C20.5831 8.41065 21.155 9.00708 21.3483 9.76311C21.6561 10.9637 21.6946 13.3069 21.6994 13.8739L21.7 13.9914V13.9997C21.7 13.9997 21.7 14.0025 21.7 14.008L21.6994 14.1255C21.6946 14.6926 21.6561 17.0358 21.3483 18.2363C21.1523 18.9951 20.5804 19.5916 19.8555 19.7932C19.31 19.9453 18.2102 20.0343 17.1094 20.0864L16.7218 20.1033C15.6285 20.1471 14.5995 20.157 14.1882 20.1593L14.0077 20.16H13.9997C13.9997 20.16 13.997 20.16 13.9917 20.16L13.8114 20.1593C12.9409 20.1546 9.30143 20.1152 8.1439 19.7932C7.41629 19.5887 6.8444 18.9923 6.65108 18.2363C6.34332 17.0358 6.30485 14.6926 6.30005 14.1255V13.8739C6.30485 13.3069 6.34332 10.9637 6.65108 9.76311C6.84708 9.00427 7.41897 8.40785 8.1439 8.20624C9.30143 7.88416 12.9409 7.84488 13.8114 7.84009H14.1882ZM12.4596 11.3046V16.6948L17.0798 13.9997L12.4596 11.3046Z" fill="white"/></svg>',
			),
			'soundcloud' => array(
				'key'  => 'soundcloud',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g clip-path="url(#clip0_3402_895)"><path d="M0.226503 9.49439C0.184772 9.49439 0.151649 9.52666 0.146253 9.57268L0 10.6836L0.146253 11.7754C0.151649 11.8214 0.184751 11.8535 0.226503 11.8535C0.266922 11.8535 0.299842 11.8216 0.306289 11.7758L0.479642 10.6836L0.306289 9.57245C0.300044 9.52664 0.26672 9.49439 0.226503 9.49439ZM1.04899 8.88741C1.0421 8.83967 1.00791 8.80675 0.965752 8.80675C0.923373 8.80675 0.888311 8.84074 0.882511 8.88741C0.882511 8.88783 0.685917 10.6836 0.685917 10.6836L0.882511 12.44C0.888108 12.4871 0.923171 12.5211 0.965752 12.5211C1.00769 12.5211 1.0419 12.488 1.04877 12.4405L1.27244 10.6836L1.04899 8.88741ZM4.14713 7.23059C4.06647 7.23059 3.99978 7.29661 3.99592 7.3805L3.83934 10.6851L3.99592 12.8207C4 12.9042 4.06647 12.97 4.14713 12.97C4.22736 12.97 4.29382 12.9039 4.29855 12.8203V12.8209L4.47556 10.6851L4.29855 7.3805C4.2938 7.29661 4.22734 7.23059 4.14713 7.23059ZM2.54364 8.37915C2.4817 8.37915 2.43115 8.42862 2.42618 8.49464L2.24982 10.6842L2.42618 12.8026C2.43091 12.8682 2.48168 12.9177 2.54364 12.9177C2.60493 12.9177 2.65547 12.8682 2.66087 12.8026L2.86132 10.6842L2.66087 8.4942C2.65547 8.42862 2.60493 8.37915 2.54364 8.37915ZM5.77665 12.9698C5.87666 12.9698 5.95796 12.8891 5.96204 12.7859L6.11563 10.6862L5.96227 6.28654C5.95818 6.18329 5.87686 6.10264 5.77687 6.10264C5.67598 6.10264 5.59448 6.18351 5.59123 6.28676L5.45508 10.686L5.59123 12.7865C5.59446 12.8889 5.67596 12.9698 5.77665 12.9698ZM9.11266 12.9797C9.25033 12.9797 9.3639 12.8663 9.36647 12.727L9.47359 10.6875L9.36645 5.60622C9.36408 5.46706 9.2503 5.3535 9.11264 5.3535C8.97477 5.3535 8.861 5.46686 8.85883 5.60644L8.76312 10.6858C8.76312 10.689 8.85883 12.7282 8.85883 12.7282C8.86102 12.8663 8.975 12.9797 9.11266 12.9797ZM7.43195 12.9717C7.55177 12.9717 7.64833 12.8756 7.65156 12.753V12.7545L7.78189 10.6866L7.65134 6.25515C7.64811 6.13254 7.55155 6.03663 7.43173 6.03663C7.31106 6.03663 7.2145 6.13256 7.21192 6.25515L7.096 10.6868L7.21214 12.7543C7.21472 12.8756 7.31128 12.9717 7.43195 12.9717ZM3.34226 12.9524C3.41346 12.9524 3.47111 12.8954 3.47649 12.8203L3.66534 10.6843L3.47649 8.65231C3.47133 8.57726 3.4137 8.52067 3.34226 8.52067C3.27001 8.52067 3.21236 8.57766 3.20785 8.65318L3.04157 10.6843L3.20785 12.8201C3.21258 12.8954 3.26999 12.9524 3.34226 12.9524ZM1.75148 12.8354C1.80352 12.8354 1.84568 12.7943 1.8517 12.7375L2.06377 10.6838L1.8519 8.55272C1.84566 8.49573 1.8035 8.45463 1.75146 8.45463C1.69876 8.45463 1.6566 8.49594 1.65122 8.55272L1.46453 10.6838L1.65122 12.7371C1.6564 12.794 1.69855 12.8354 1.75148 12.8354ZM8.26909 6.18137C8.13897 6.18137 8.03463 6.28484 8.03206 6.41733L7.92625 10.687L8.03206 12.7416C8.03465 12.8723 8.13874 12.9758 8.26909 12.9758C8.399 12.9758 8.50269 12.8726 8.50568 12.7401V12.7418L8.62441 10.6873L8.50568 6.41689C8.50267 6.28484 8.39898 6.18137 8.26909 6.18137ZM4.95886 12.9741C5.04877 12.9741 5.12298 12.9007 5.12729 12.8072L5.29248 10.6857L5.12729 6.6253C5.12276 6.53151 5.04877 6.4584 4.95886 6.4584C4.86811 6.4584 4.79412 6.53173 4.79024 6.6253L4.64399 10.6857L4.79046 12.808C4.7941 12.9007 4.86809 12.9741 4.95886 12.9741ZM6.80347 12.7738V12.7727L6.94542 10.6864L6.80347 6.13857C6.80001 6.02566 6.71097 5.93704 6.60106 5.93704C6.49049 5.93704 6.40145 6.02544 6.39846 6.13857L6.27242 10.6862L6.39866 12.7736C6.40167 12.8855 6.49073 12.9738 6.60107 12.9738C6.71119 12.9738 6.79981 12.8855 6.80349 12.773V12.7738H6.80347ZM17.5402 8.0649C17.2032 8.0649 16.8816 8.13308 16.5887 8.25589C16.3929 6.03877 14.5337 4.29956 12.2658 4.29956C11.7109 4.29956 11.17 4.40883 10.6923 4.59358C10.5066 4.66543 10.4572 4.73941 10.4555 4.88288V12.6906C10.4574 12.8411 10.5742 12.9665 10.7211 12.9814C10.7273 12.982 17.4962 12.9855 17.5401 12.9855C18.8985 12.9855 20 11.884 20 10.5253C20 9.16657 18.8987 8.0649 17.5402 8.0649ZM9.95257 4.876C9.8048 4.876 9.68351 4.99732 9.68134 5.14636L9.57036 10.6881L9.68157 12.6994C9.68351 12.8463 9.80482 12.9674 9.95257 12.9674C10.0999 12.9674 10.2212 12.8463 10.2234 12.6973V12.6996L10.344 10.6881L10.2234 5.14594C10.2212 4.99732 10.0999 4.876 9.95257 4.876ZM1.98657 14.5494C1.69556 14.481 1.61683 14.4444 1.61683 14.3291C1.61683 14.2478 1.68243 14.1637 1.87902 14.1637C2.047 14.1637 2.17822 14.2319 2.2961 14.3526L2.56088 14.0958C2.38774 13.9149 2.17801 13.8073 1.89238 13.8073C1.53017 13.8073 1.23657 14.0119 1.23657 14.3451C1.23657 14.7068 1.47276 14.8144 1.81088 14.8929C2.15694 14.9714 2.21997 15.0241 2.21997 15.1422C2.21997 15.2811 2.11737 15.3415 1.90012 15.3415C1.7244 15.3415 1.55921 15.2813 1.4306 15.1314L1.16578 15.3676C1.30472 15.5721 1.57251 15.7006 1.879 15.7006C2.38017 15.7006 2.6004 15.4646 2.6004 15.1159C2.60042 14.7172 2.27779 14.6176 1.98657 14.5494ZM3.67585 13.8073C3.17513 13.8073 2.87895 14.1954 2.87895 14.7539C2.87895 15.3125 3.17511 15.7003 3.67585 15.7003C4.17659 15.7003 4.47318 15.3125 4.47318 14.7539C4.47318 14.1954 4.17659 13.8073 3.67585 13.8073ZM3.67585 15.3362C3.37969 15.3362 3.25621 15.0817 3.25621 14.7541C3.25621 14.4264 3.37967 14.1719 3.67585 14.1719C3.97246 14.1719 4.09549 14.4264 4.09549 14.7541C4.09549 15.0817 3.97246 15.3362 3.67585 15.3362ZM5.95495 14.8669C5.95495 15.1604 5.81042 15.3415 5.57726 15.3415C5.34389 15.3415 5.20234 15.1553 5.20234 14.8617V13.8359H4.83498V14.8669C4.83498 15.4016 5.13418 15.7006 5.57724 15.7006C6.04399 15.7006 6.32209 15.3936 6.32209 14.8617V13.8359H5.95495V14.8669ZM7.90579 14.6124C7.90579 14.7148 7.91095 14.9454 7.91095 15.0136C7.8873 14.9662 7.82708 14.8746 7.78254 14.8062L7.13191 13.8357H6.78065V15.6718H7.14266V14.8639C7.14266 14.7615 7.13749 14.5309 7.13749 14.4627C7.16093 14.5098 7.22157 14.6017 7.26589 14.6701L7.93997 15.6717H8.26776V13.8357H7.90577L7.90579 14.6124ZM9.31398 13.8359H8.7397V15.6719H9.28751C9.75963 15.6719 10.2266 15.399 10.2266 14.7539C10.2266 14.0824 9.83837 13.8359 9.31398 13.8359ZM9.28751 15.3153H9.10686V14.1928H9.30087C9.6891 14.1928 9.84914 14.3788 9.84914 14.7539C9.84912 15.0897 9.67318 15.3153 9.28751 15.3153ZM11.3621 14.1717C11.5272 14.1717 11.6322 14.2453 11.6978 14.3711L12.0387 14.2139C11.9232 13.9753 11.7133 13.8073 11.3672 13.8073C10.8877 13.8073 10.5518 14.1954 10.5518 14.7539C10.5518 15.3334 10.8742 15.7003 11.354 15.7003C11.6872 15.7003 11.9075 15.5457 12.0333 15.2861L11.724 15.1024C11.627 15.2652 11.5298 15.336 11.3646 15.336C11.0893 15.336 10.9293 15.0841 10.9293 14.7539C10.9291 14.4132 11.0869 14.1717 11.3621 14.1717ZM12.7238 13.8359H12.3566V15.6719H13.46V15.3097H12.7238V13.8359ZM14.4273 13.8073C13.9261 13.8073 13.6299 14.1954 13.6299 14.7539C13.6299 15.3125 13.9261 15.7003 14.4273 15.7003C14.928 15.7003 15.2244 15.3125 15.2244 14.7539C15.2244 14.1954 14.928 13.8073 14.4273 13.8073ZM14.4273 15.3362C14.1307 15.3362 14.0076 15.0817 14.0076 14.7541C14.0076 14.4264 14.1307 14.1719 14.4273 14.1719C14.7232 14.1719 14.8465 14.4264 14.8465 14.7541C14.8465 15.0817 14.7232 15.3362 14.4273 15.3362ZM16.7059 14.8669C16.7059 15.1604 16.562 15.3415 16.3287 15.3415C16.0949 15.3415 15.9535 15.1553 15.9535 14.8617V13.8359H15.5864V14.8669C15.5864 15.4016 15.8854 15.7006 16.3287 15.7006C16.7954 15.7006 17.0733 15.3936 17.0733 14.8617V13.8359H16.7059V14.8669ZM18.1064 13.8359H17.5323V15.6719H18.0801C18.5524 15.6719 19.019 15.399 19.019 14.7539C19.019 14.0824 18.631 13.8359 18.1064 13.8359ZM18.0801 15.3153H17.8992V14.1928H18.0935C18.4812 14.1928 18.6413 14.3788 18.6413 14.7539C18.6413 15.0897 18.4655 15.3153 18.0801 15.3153Z" /></g><defs><clipPath id="clip0_3402_895"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>',
			),
			'tumblr'     => array(
				'key'  => 'tumblr',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g clip-path="url(#clip0_3402_907)"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V20H20V0H0ZM14.2212 16.1534C13.7059 16.4291 13.1706 16.6274 12.6139 16.7473C12.1399 16.8658 11.6258 16.9231 11.0693 16.9231C10.5899 16.9231 10.0386 16.8458 9.40475 16.69C8.88936 16.4916 8.49393 16.2533 8.21824 15.9776C7.85873 15.654 7.62035 15.3424 7.50585 15.0255C7.3447 14.6247 7.26615 14.1506 7.26615 13.5993V8.78294H5.77873V6.82273C6.25675 6.66031 6.70949 6.40598 7.14624 6.04642C7.58308 5.69354 7.90127 5.29807 8.09833 4.86127C8.25415 4.50176 8.41525 3.90923 8.5724 3.07692H10.4606V6.65099H13.6592V8.78294H10.4606V12.2891C10.4606 13.0854 10.5325 13.5994 10.6524 13.8391C10.6936 14.0362 10.8348 14.2133 11.0692 14.3744C11.4687 14.5675 11.8229 14.666 12.1398 14.666C12.8109 14.666 13.5087 14.4316 14.2211 13.9536V16.1534H14.2212Z" /></g><defs><clipPath id="clip0_3402_907"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>',
			),
			'wikipedia'  => array(
				'key'  => 'wikipedia',
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.1358 3.73584V4.07005C14.6949 4.14835 14.3613 4.28685 14.1347 4.48556C13.8102 4.78064 13.4276 5.23227 13.1766 5.84047L8.06951 16.2642H7.72971L2.60269 5.70498C2.36391 5.16302 2.03929 4.83182 1.94133 4.71138C1.78827 4.52471 1.6 4.37868 1.37653 4.27329C1.15305 4.16792 0.85152 4.10017 0.471924 4.07005V3.73584H5.46066V4.07005C4.88513 4.12426 4.61075 4.22061 4.43932 4.3591C4.26789 4.49761 4.18217 4.67526 4.18218 4.89203C4.18217 5.19313 4.32299 5.66283 4.60463 6.30114L8.39094 13.4822L12.0929 6.39146C12.3807 5.69294 12.6194 5.20819 12.6194 4.93719C12.6194 4.76257 12.5306 4.59547 12.3531 4.43588C12.1755 4.27631 11.9746 4.1634 11.5522 4.09715C11.5215 4.09114 11.4695 4.08211 11.396 4.07005V3.73584H15.1358Z" /><path d="M19.5281 3.73584V4.07005C19.0873 4.14835 18.7536 4.28685 18.5271 4.48556C18.2026 4.78064 17.82 5.23227 17.569 5.84047L13.0869 16.2642H12.7471L8.01068 5.70498C7.7719 5.16302 7.44728 4.83182 7.34932 4.71138C7.19625 4.52471 7.00799 4.37868 6.78452 4.27329C6.56104 4.16792 6.3586 4.10017 5.979 4.07005V3.73584H10.8686V4.07005C10.2931 4.12426 10.0187 4.22061 9.84731 4.3591C9.67588 4.49761 9.59016 4.67526 9.59017 4.89203C9.59016 5.19313 9.73098 5.66283 10.0126 6.30114L13.4083 13.4822L16.4853 6.39146C16.773 5.69294 17.0118 5.20819 17.0118 4.93719C17.0118 4.76257 16.923 4.59547 16.7455 4.43588C16.5679 4.27631 16.2679 4.1634 15.8454 4.09715C15.8148 4.09114 15.7628 4.08211 15.6893 4.07005V3.73584H19.5281Z" /></svg>',
			),
		);

		$output = array();

		foreach ( $options as $social => $settings ) {
			$url = get_user_meta( get_the_author_meta( 'ID' ), $settings['key'], true );

			if ( 'twitter' === $social && $url ) {
				$url = sprintf( 'https://twitter.com/%s/', $url );
			}

			if ( $url && ! empty( $settings['icon'] ) ) {
				$output[] = '<a href="' . esc_url_raw( $url ) . '">' . $settings['icon'] . '<span class="screen-reader-text">' . $social . '</span></a>';
			}
		}

		if ( ! empty( $output ) ) {
			call_user_func( 'printf', '%s', '<div class="cs-page__author-social"><div class="cs-page__author-heading">' . esc_html__( 'Follow', 'flux' ) . '</div><div class="cs-page__author-social-links">' . join( ' ', $output ) . '</div></div>' );
		}
	}
}

if ( ! function_exists( 'csco_get_post_categories' ) ) {
	/**
	 * Get the list of available post categories
	 */
	function csco_get_post_categories() {
		$options = array();

		$categories = get_categories();

		foreach ( $categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		return $options;
	}
}

if ( ! function_exists( 'csco_detect_color_scheme' ) ) {
	/**
	 * Detect color scheme.
	 *
	 * @param mixed $color Color.
	 * @param int   $level Detect level.
	 */
	function csco_detect_color_scheme( $color, $level = 190 ) {

		// Trim color.
		$color = trim( $color );

		// Excludes.
		if ( in_array( $color, array( '#0e131a' ), true ) ) {
			return 'dark';
		}

		// Set alpha channel.
		$alpha = 1;

		$rgba = array( 255, 255, 255 );

		// If HEX format.
		if ( isset( $color[0] ) && '#' === $color[0] ) {
			// Remove '#' from start.
			$color = str_replace( '#', '', trim( $color ) );

			if ( 3 === strlen( $color ) ) {
				$color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
			}

			$rgba[0] = hexdec( substr( $color, 0, 2 ) );
			$rgba[1] = hexdec( substr( $color, 2, 2 ) );
			$rgba[2] = hexdec( substr( $color, 4, 2 ) );
		} elseif ( preg_match_all( '#\((([^()]+|(?R))*)\)#', $color, $color_reg ) ) {
			// Convert RGB or RGBA.
			$rgba = explode( ',', implode( ' ', $color_reg[1] ) );

			if ( array_key_exists( '3', $rgba ) ) {
				$alpha = (float) $rgba['3'];
			}
		}

		// Apply alpha channel.
		foreach ( $rgba as $key => $channel ) {
			$rgba[ $key ] = str_pad( $channel + ceil( ( 255 - $channel ) * ( 1 - $alpha ) ), 2, '0', STR_PAD_LEFT );
		}

		// Set default scheme.
		$scheme = 'light';

		// Get brightness.
		$brightness = ( ( $rgba[0] * 299 ) + ( $rgba[1] * 587 ) + ( $rgba[2] * 114 ) ) / 1000;

		// If color gray.
		if ( $rgba[0] === $rgba[1] && $rgba[1] === $rgba[2] ) {
			if ( $brightness < $level ) {
				$scheme = 'dark';
			}
		} elseif ( $brightness < $level ) {
				$scheme = 'inverse';
		}

		return $scheme;
	}
}

if ( ! function_exists( 'csco_color_scheme' ) ) {
	/**
	 * Output color scheme.
	 *
	 * @param mixed $light Light color.
	 * @param mixed $dark  Dark color.
	 */
	function csco_color_scheme( $light, $dark = '' ) {

		$data = csco_site_scheme_data();

		$site_scheme = csco_site_scheme_data();

		if ( 'auto' === $site_scheme ) {
			return sprintf( 'data-scheme="auto" data-l="%s" data-d="%s"', csco_detect_color_scheme( $light ), csco_detect_color_scheme( $dark ) );
		}

		if ( 'dark' === $site_scheme ) {
			$scheme = csco_detect_color_scheme( $dark );
		} else {
			$scheme = csco_detect_color_scheme( $light );
		}

		return sprintf( 'data-scheme="%s"', $scheme );
	}
}

if ( ! function_exists( 'csco_header_scheme_attr' ) ) {
	/**
	 * Get Site Header scheme attribute
	 *
	 * @param bool $is_echo Optional. Whether to echo or return the classes. Default true for echo.
	 */
	function csco_header_scheme_attr( $is_echo = false ) {

		$scheme = csco_color_scheme(
			get_theme_mod( 'color_header_background', '#FFFFFF' ),
			get_theme_mod( 'color_header_background_is_dark', '#161616' )
		);

		$scheme_attr = apply_filters( 'csco_header_scheme_attr', $scheme );

		if ( $is_echo ) {
			echo wp_kses( $scheme_attr, 'csco' );
		} else {
			return $scheme_attr;
		}
	}
}

if ( ! function_exists( 'csco_header_attr' ) ) {
	/**
	 * Get Site Header attributes
	 */
	function csco_header_attr() {
		$attributes = csco_header_scheme_attr();

		echo wp_kses( apply_filters( 'csco_header_attr', $attributes ), 'csco' );
	}
}

if ( ! function_exists( 'csco_header_topbar_attr' ) ) {
	/**
	 * Get Site Header Topbar attributes
	 */
	function csco_header_topbar_attr() {
		$attributes = csco_header_scheme_attr();

		echo wp_kses( apply_filters( 'csco_header_topbar_attr', $attributes ), 'csco' );
	}
}

if ( ! function_exists( 'csco_footer_scheme_attr' ) ) {
	/**
	 * Get Site Footer scheme attribute
	 *
	 * @param bool $is_echo Optional. Whether to echo or return the classes. Default false for echo.
	 */
	function csco_footer_scheme_attr( $is_echo = false ) {
		$scheme = csco_color_scheme(
			get_theme_mod( 'color_footer_background', '#FFFFFF' ),
			get_theme_mod( 'color_footer_background_dark', '#161616' )
		);

		$scheme_attr = apply_filters( 'csco_footer_scheme_attr', $scheme );
		if ( $is_echo ) {
			echo wp_kses( $scheme_attr, 'csco' );
		} else {
			return $scheme_attr;
		}
	}
}

if ( ! function_exists( 'csco_footer_attr' ) ) {
	/**
	 * Get Site Footer attributes
	 */
	function csco_footer_attr() {
		$attributes = csco_footer_scheme_attr();

		echo wp_kses( apply_filters( 'csco_footer_attr', $attributes ), 'csco' );
	}
}

if ( ! function_exists( 'csco_offcanvas_scheme_attr' ) ) {
	/**
	 * Get Site Offcanvas scheme attribute
	 *
	 * @param bool $is_echo Optional. Whether to echo or return the classes. Default true for echo.
	 */
	function csco_offcanvas_scheme_attr( $is_echo = false ) {

		$scheme = csco_color_scheme(
			get_theme_mod( 'color_offcanvas_background', '#FFFFFF' ),
			get_theme_mod( 'color_offcanvas_background_is_dark', '#161616' )
		);

		$scheme_attr = apply_filters( 'csco_offcanvas_scheme_attr', $scheme );

		if ( $is_echo ) {
			echo wp_kses( $scheme_attr, 'csco' );
		} else {
			return $scheme_attr;
		}
	}
}

if ( ! function_exists( 'csco_offcanvas_attr' ) ) {
	/**
	 * Get Site Offcanvas attributes
	 */
	function csco_offcanvas_attr() {
		$attributes = csco_offcanvas_scheme_attr();

		echo wp_kses( apply_filters( 'csco_offcanvas_attr', $attributes ), 'csco' );
	}
}


if ( ! function_exists( 'csco_post_thumbnail_caption' ) ) {
	/**
	 * Post Thumbnail Caption
	 */
	function csco_post_thumbnail_caption() {
		$thumbnail_id = '';
		$caption      = '';

		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$caption      = wp_get_attachment_caption( $thumbnail_id );
		}

		return $caption;
	}
}

if ( ! function_exists( 'csco_get_archive_featured_query_args' ) ) {
	/**
	 * Get query arguments for the Featured Archive section.
	 *
	 * @param array $settings The advanced settings.
	 * @return array Query arguments.
	 */
	function csco_get_archive_featured_query_args( $settings = array() ) {

		global $csco_avoid_duplicate_post_ids;

		if ( ! $csco_avoid_duplicate_post_ids ) {
			$csco_avoid_duplicate_post_ids = array();
		}

		$query_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => true,
		);

		if ( isset( $settings['location'] ) && 'archive' === $settings['location'] ) {
			$current_category_id = get_queried_object_id();

			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $current_category_id,
				),
			);
		}

		if ( $csco_avoid_duplicate_post_ids ) {
			$query_args['post__not_in'] = $csco_avoid_duplicate_post_ids;
		}

		return $query_args;
	}
}


if ( ! function_exists( 'csco_get_read_next_post_ids' ) ) {
	/**
	 * Retrieve read next posts.
	 *
	 * Will retrive the newer posts from the current category,
	 * if the limit is not reached it will add older posts from current category,
	 * if the limit still not reached it will add posts from other categories.
	 *
	 * @param int $limit Optional. Number of posts to return.
	 *
	 * @param int $read_next_posts Optional. Post order.
	 */
	function csco_get_read_next_post_ids( $limit = 6, $read_next_posts = 'after' ) {

		$post_ids                = array();
		$current_post_id         = get_the_ID();
		$exclude_post_ids        = array( $current_post_id );
		$current_post_categories = wp_get_post_categories( $current_post_id, array( 'fields' => 'ids' ) );

		$order            = 'ASC';
		$date_query_param = 'after';

		if ( 'before' === $read_next_posts ) {
			$order            = 'DESC';
			$date_query_param = 'before';
		}

		if ( 'new' === $read_next_posts ) {
			$order            = 'DESC';
			$date_query_param = 'after';
		}

		$args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $limit,
			'post_status'         => 'publish',
			'orderby'             => 'date',
			'order'               => $order,
			'date_query'          => array(
				$date_query_param => get_the_time( 'Y-m-d H:i:s', $current_post_id ),
			),
			'ignore_sticky_posts' => true,
			'cat'                 => $current_post_categories,
		);

		$next_posts_query = new WP_Query( $args );

		if ( $next_posts_query->have_posts() ) {
			$post_ids         = wp_list_pluck( $next_posts_query->posts, 'ID' );
			$exclude_post_ids = array_merge( $exclude_post_ids, $post_ids );
		}

		$posts_count = count( $post_ids );

		if ( $posts_count < $limit ) {
			$posts_to_fetch = $limit - $posts_count;

			$category = get_the_category( $current_post_id );

			if ( isset( $category[0] ) ) {
				$category_id = $category[0]->term_id;

				$args_category = array(
					'post_type'           => 'post',
					'posts_per_page'      => $posts_to_fetch,
					'cat'                 => $category_id,
					'post_status'         => 'publish',
					'orderby'             => 'date',
					'order'               => $order,
					'ignore_sticky_posts' => true,
					'cat'                 => $current_post_categories,
					'post__not_in'        => $exclude_post_ids,
				);

				$category_query = new WP_Query( $args_category );

				if ( $category_query->have_posts() ) {
					$category_post_ids = wp_list_pluck( $category_query->posts, 'ID' );
					$post_ids          = array_merge( $post_ids, $category_post_ids );
					$exclude_post_ids  = array_merge( $exclude_post_ids, $post_ids );
				}
			}
		}

		$posts_count = count( $post_ids );

		if ( $posts_count < $limit ) {
			$posts_to_fetch = $limit - $posts_count;

			$args_additional = array(
				'post_type'           => 'post',
				'posts_per_page'      => $posts_to_fetch,
				'post_status'         => 'publish',
				'orderby'             => 'date',
				'ignore_sticky_posts' => true,
				'post__not_in'        => $exclude_post_ids,
			);

			$additional_posts_query = new WP_Query( $args_additional );

			if ( $additional_posts_query->have_posts() ) {
				$additional_post_ids = wp_list_pluck( $additional_posts_query->posts, 'ID' );
				$post_ids            = array_merge( $post_ids, $additional_post_ids );
			}
		}

		wp_reset_postdata();

		return $post_ids;
	}
}

if ( ! function_exists( 'csco_comments_callback' ) ) {
	/**
	 * Custom comments callback.
	 *
	 * @param object $comment The comment object.
	 * @param array  $args    An array of arguments.
	 * @param int    $depth   Depth of the current comment.
	 */
	function csco_comments_callback( $comment, $args, $depth ) {
		$tag               = ( 'div' === $args['style'] ) ? 'div' : 'li';
		$post_author_id    = get_post_field( 'post_author', $comment->comment_post_ID );
		$is_by_post_author = ( $comment->user_id === $post_author_id );
		$has_children      = ! empty( $args['has_children'] );
		$comment_author_id = $comment->user_id;

		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( $has_children ? 'parent' : '', $comment ); ?> id="comment-<?php echo esc_attr( get_comment_ID() ); ?>">
			<article id="div-<?php echo esc_attr( get_comment_ID() ); ?>" class="comment-body">
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
						// Display the avatar.
						if ( 0 !== $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						}

						if ( $comment_author_id ) {
							$author_url         = get_author_posts_url( $comment_author_id );
							$author_posts_count = count_user_posts( $comment_author_id );

							if ( $author_posts_count > 0 ) {
								?>
								<b class="fn">
									<span class="by"><?php echo esc_html__( 'by', 'flux' ); ?></span>
									<a href="<?php echo esc_url( $author_url ); ?>" class="url">
										<?php echo esc_html( get_comment_author() ); ?>
									</a>
								</b>
								<?php
							} else {
								?>
								<b class="fn"><span class="by"><?php echo esc_html__( 'by', 'flux' ); ?></span> <?php echo esc_html( get_comment_author() ); ?></b>
								<?php
							}
						} else {
							?>
							<b class="fn"><span class="by"><?php echo esc_html__( 'by', 'flux' ); ?></span> <?php echo get_comment_author_link(); ?></b>
							<?php
						}
						?>
					</div>

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date, 2: time */
							echo esc_html( sprintf( __( '%1$s at %2$s', 'flux' ), get_comment_date(), get_comment_time() ) );
							?>
						</a>
						<?php edit_comment_link( esc_html__( '(Edit)', 'flux' ), '  ', '' ); ?>
					</div>

					<?php if ( '0' === $comment->comment_approved ) { ?>
						<em class="comment-awaiting-moderation">
							<?php echo esc_html__( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'flux' ); ?>
						</em>
					<?php } ?>
				</footer>

				<div class="reply">
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							)
						)
					);
					?>
				</div>
			</article>
		<?php
		// No need to manually close the tag here as WordPress will handle it.
	}
}

if ( ! function_exists( 'csco_value_is' ) ) {
	/**
	 * Checks if a given value is set and optionally matches an expected value.
	 *
	 * @param mixed $value  The value to check.
	 * @param mixed $expect (Optional) The value to compare against.
	 *
	 * @return bool
	 */
	function csco_value_is( &$value, $expect = null ) {
		// Ensure the variable exists and is not null.
		if ( ! isset( $value ) ) {
			return false;
		}

		// If only checking for existence, return true if it's not empty.
		if ( func_num_args() === 1 ) {
			return ! empty( $value );
		}

		// Otherwise, check if the value matches the expected one.
		return $value === $expect;
	}
}

if ( ! function_exists( 'csco_calculate_post_reading_time' ) ) {
	/**
	 * Calculate Post Reading Time in Minutes
	 *
	 * @param int $post_id The post ID.
	 */
	function csco_calculate_post_reading_time( $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$post_content     = get_post_field( 'post_content', $post_id );
		$strip_shortcodes = strip_shortcodes( $post_content );
		$strip_tags       = wp_strip_all_tags( $strip_shortcodes );

		$str        = preg_replace( '/[[:punct:]]/', '', $strip_tags );
		$str        = preg_replace( '/[\s]+/', ' ', $str );
		$word_count = count( (array) array_filter( (array) explode( ' ', $str ) ) );

		$reading_time = intval( ceil( $word_count / 265 ) );

		// Filter for Reading Time.
		if ( function_exists( 'iconv_strlen' ) ) {
			$reading_time = apply_filters( 'csco_calculate_reading_time', $reading_time, iconv_strlen( $strip_tags ) );
		} else {
			$reading_time = apply_filters( 'csco_calculate_reading_time', $reading_time, mb_strlen( $strip_tags ) );
		}

		return $reading_time;
	}
}

if ( ! function_exists( 'csco_get_post_reading_time' ) ) {
	/**
	 * Get Post Reading Time from Post Meta
	 *
	 * @param int $post_id The post ID.
	 */
	function csco_get_post_reading_time( $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// Get existing post meta.
		$reading_time = get_post_meta( $post_id, '_csco_reading_time', true );

		// Calculate and save reading time, if there's no existing post meta.
		if ( ! $reading_time ) {
			$reading_time = csco_calculate_post_reading_time( $post_id );
			update_post_meta( $post_id, '_csco_reading_time', $reading_time );
		}

		return $reading_time;
	}
}

if ( ! function_exists( 'csco_build_custom_query_args' ) ) {
	/**
	 * Build query arguments for the home sections based on passed parameters.
	 *
	 * @param array $settings {
	 *     Array of query settings.
	 *
	 *     @type string $filter_posts      Comma-separated post IDs to include.
	 *     @type string $filter_categories Comma-separated category slugs to filter by.
	 *     @type string $filter_tags       Comma-separated tag slugs to filter by.
	 *     @type int $offset               Offset setting.
	 *     @type string $orderby           Orderby setting.
	 *     @type string $time_frame        Time frame setting.
	 *     @type string $order             Order setting.
	 *     @type int    $number_items      Number of items to display.
	 * }
	 * @param bool  $avoid_duplicates      Section setting.
	 * @return array Query arguments for WP_Query.
	 */
	function csco_build_custom_query_args( $settings = array(), $avoid_duplicates = false ) {

		global $csco_avoid_duplicate_post_ids;

		if ( ! $csco_avoid_duplicate_post_ids ) {
			$csco_avoid_duplicate_post_ids = array();
		}

		$defaults = array(
			'filter_posts'      => '',
			'filter_categories' => '',
			'filter_tags'       => '',
			'filter_offset'     => 0,
			'orderby'           => 'date',
			'time_frame'        => '',
			'order'             => 'DESC',
			'number_items'      => 1,
		);

		$settings = wp_parse_args( $settings, $defaults );

		$query_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $settings['number_items'],
			'ignore_sticky_posts' => true,
		);

		// Filter by specific posts.
		if ( ! empty( $settings['filter_posts'] ) ) {
			$post_ids = array_filter( array_map( 'absint', explode( ',', $settings['filter_posts'] ) ) );

			if ( ! empty( $post_ids ) ) {
				$query_args['post__in'] = $post_ids;
			}
		}

		// Filter by categories (overrides tag filtering if both are set).
		if ( ! empty( $settings['filter_categories'] ) ) {
			$categories = array_filter( array_map( 'sanitize_text_field', explode( ',', $settings['filter_categories'] ) ) );

			if ( ! empty( $categories ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $categories,
					),
				);
			}
		}

		// Filter by tags.
		if ( ! empty( $settings['filter_tags'] ) ) {
			$tags = array_filter( array_map( 'sanitize_text_field', explode( ',', $settings['filter_tags'] ) ) );

			if ( ! empty( $tags ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'slug',
						'terms'    => $tags,
					),
				);
			}
		}

		// Offset.
		if ( ! empty( $settings['filter_offset'] ) ) {
			$query_args['offset'] = $settings['filter_offset'];
		}

		// Orderby.
		if ( ! empty( $settings['orderby'] ) ) {
			if ( 'views' === $settings['orderby'] && csco_post_views_enabled() ) {
				$query_args['orderby'] = 'post_views';

				$query_args['views_query']['hide_empty'] = false;

				// Time Frame for Post Views.
				$time_frame = $settings['time_frame'];
				if ( $time_frame ) {
					$query_args['date_query'] = array(
						array(
							'column' => 'post_date_gmt',
							'after'  => $time_frame . ' ago',
						),
					);
				}
			} else {
				$query_args['orderby'] = $settings['orderby'];
			}
		}

		// Order.
		if ( ! empty( $settings['order'] ) ) {
			$query_args['order'] = $settings['order'];
		}

		if ( $avoid_duplicates && $csco_avoid_duplicate_post_ids ) {
			$query_args['post__not_in'] = $csco_avoid_duplicate_post_ids;
		}

		return $query_args;
	}
}

if ( ! function_exists( 'csco_get_section_settings' ) ) {
	/**
	 * Get Section settings.
	 *
	 * @param null $name section name.
	 * @return array[]
	 */
	function csco_get_section_settings( $name = null ) {
		$settings = array(
			'home'    => array(
				array(
					'slug'              => 'hero',
					'display'           => (string) get_theme_mod( 'home_hero_display', 'none' ),
					'location'          => (string) get_theme_mod( 'home_hero_location', 'homepage' ),
					'priority'          => (int) get_theme_mod( 'home_hero_order', 10 ),
					'exclude_posts'     => (bool) get_theme_mod( 'home_hero_exclude_posts', false ),
					'filter_posts'      => (string) get_theme_mod( 'home_hero_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'home_hero_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'home_hero_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'home_hero_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'home_hero_filter_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'home_hero_time_frame' ),
					'order'             => (string) get_theme_mod( 'home_hero_filter_sort_order', 'DESC' ),
					'number_items'      => 1,
				),
				array(
					'slug'              => 'post-slider',
					'display'           => (string) get_theme_mod( 'home_slider_display', 'none' ),
					'location'          => (string) get_theme_mod( 'home_slider_location', 'homepage' ),
					'priority'          => (int) get_theme_mod( 'home_slider_order', 10 ),
					'exclude_posts'     => (bool) get_theme_mod( 'home_slider_exclude_posts', false ),
					'filter_posts'      => (string) get_theme_mod( 'home_slider_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'home_slider_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'home_slider_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'home_slider_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'home_slider_filter_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'home_slider_filter_time_frame' ),
					'order'             => (string) get_theme_mod( 'home_slider_filter_sort_order', 'DESC' ),
					'number_items'      => (int) get_theme_mod( 'home_slider_number_items', 3 ),
				),
				array(
					'slug'              => 'post-tile',
					'display'           => (string) get_theme_mod( 'home_post_tiles_display', 'none' ),
					'location'          => (string) get_theme_mod( 'home_post_tiles_location', 'homepage' ),
					'priority'          => (int) get_theme_mod( 'home_post_tiles_order', 10 ),
					'exclude_posts'     => (bool) get_theme_mod( 'home_post_tiles_exclude_posts', false ),
					'filter_posts'      => (string) get_theme_mod( 'home_post_tiles_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'home_post_tiles_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'home_post_tiles_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'home_post_tiles_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'home_post_tiles_filter_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'home_post_tiles_time_frame' ),
					'order'             => (string) get_theme_mod( 'home_post_tiles_filter_sort_order', 'DESC' ),
					'number_items'      => 'type-1' === get_theme_mod( 'home_tiles_layout', 'type-1' ) ? 5 : 3,
				),
				array(
					'slug'              => 'post-grid',
					'display'           => (string) get_theme_mod( 'home_post_grid_display', 'none' ),
					'location'          => (string) get_theme_mod( 'home_post_grid_location', 'homepage' ),
					'priority'          => (int) get_theme_mod( 'home_post_grid_order', 10 ),
					'exclude_posts'     => (bool) get_theme_mod( 'home_post_grid_exclude_posts', false ),
					'filter_posts'      => (string) get_theme_mod( 'home_post_grid_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'home_post_grid_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'home_post_grid_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'home_post_grid_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'home_post_grid_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'home_post_grid_time_frame' ),
					'order'             => (string) get_theme_mod( 'home_post_grid_sort_order', 'DESC' ),
					'number_items'      => 'type-3' === get_theme_mod( 'home_post_grid_layout', 'type-1' ) ? 4 : 3,
				),
				array(
					'slug'              => 'post-cards',
					'display'           => (string) get_theme_mod( 'home_post_cards_display', 'none' ),
					'location'          => (string) get_theme_mod( 'home_post_cards_location', 'homepage' ),
					'priority'          => (int) get_theme_mod( 'home_post_cards_order', 10 ),
					'exclude_posts'     => (bool) get_theme_mod( 'home_post_cards_exclude_posts', false ),
					'filter_posts'      => (string) get_theme_mod( 'home_post_cards_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'home_post_cards_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'home_post_cards_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'home_post_cards_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'home_post_cards_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'home_post_cards_time_frame' ),
					'order'             => (string) get_theme_mod( 'home_post_cards_sort_order', 'DESC' ),
					'number_items'      => (int) get_theme_mod( 'home_post_cards_limit', 8 ),
				),
				array(
					'slug'     => 'categories',
					'display'  => (string) get_theme_mod( 'home_categories_display', 'none' ),
					'location' => (string) get_theme_mod( 'home_categories_location', 'homepage' ),
					'priority' => (int) get_theme_mod( 'home_categories_order', 10 ),
				),
				array(
					'slug'     => 'banner-one',
					'display'  => (string) get_theme_mod( 'home_banner_one_display', 'none' ),
					'location' => (string) get_theme_mod( 'home_banner_one_location', 'homepage' ),
					'priority' => (int) get_theme_mod( 'home_banner_one_order', 10 ),
				),
				array(
					'slug'     => 'banner-two',
					'display'  => (string) get_theme_mod( 'home_banner_two_display', 'none' ),
					'location' => (string) get_theme_mod( 'home_banner_two_location', 'homepage' ),
					'priority' => (int) get_theme_mod( 'home_banner_two_order', 10 ),
				),
			),
			'sidebar' => array(
				array(
					'slug'              => 'post-horizontal',
					'display'           => (string) get_theme_mod( 'theme_widget_post_horizontal_display', 'none' ),
					'priority'          => (int) get_theme_mod( 'theme_widget_post_horizontal_order', 1000 ),
					'visibility'        => (array) get_theme_mod( 'theme_widget_post_horizontal_visibility' ),
					'exclude_posts'     => (bool) get_theme_mod( 'theme_widget_post_horizontal_exclude', false ),
					'filter_posts'      => (string) get_theme_mod( 'theme_widget_post_horizontal_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'theme_widget_post_horizontal_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'theme_widget_post_horizontal_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'theme_widget_post_horizontal_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'theme_widget_post_horizontal_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'theme_widget_post_horizontal_time_frame' ),
					'order'             => (string) get_theme_mod( 'theme_widget_post_horizontal_sort_order', 'DESC' ),
					'number_items'      => (int) get_theme_mod( 'theme_widget_post_horizontal_number_items', 3 ),
				),
				array(
					'slug'              => 'post-overlay',
					'display'           => (string) get_theme_mod( 'theme_widget_post_overlay_display', 'none' ),
					'priority'          => (int) get_theme_mod( 'theme_widget_post_overlay_order', 1000 ),
					'visibility'        => (array) get_theme_mod( 'theme_widget_post_overlay_visibility' ),
					'exclude_posts'     => (bool) get_theme_mod( 'theme_widget_post_overlay_exclude', false ),
					'filter_posts'      => (string) get_theme_mod( 'theme_widget_post_overlay_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'theme_widget_post_overlay_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'theme_widget_post_overlay_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'theme_widget_post_overlay_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'theme_widget_post_overlay_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'theme_widget_post_overlay_time_frame' ),
					'order'             => (string) get_theme_mod( 'theme_widget_post_overlay_sort_order', 'DESC' ),
					'number_items'      => (int) get_theme_mod( 'theme_widget_post_overlay_number_items', 1 ),
				),
				array(
					'slug'              => 'post-slider',
					'display'           => (string) get_theme_mod( 'theme_widget_post_slider_display', 'none' ),
					'priority'          => (int) get_theme_mod( 'theme_widget_post_slider_order', 1000 ),
					'visibility'        => (array) get_theme_mod( 'theme_widget_post_slider_visibility' ),
					'exclude_posts'     => (bool) get_theme_mod( 'theme_widget_post_slider_exclude', false ),
					'filter_posts'      => (string) get_theme_mod( 'theme_widget_post_slider_filter_posts' ),
					'filter_categories' => (string) get_theme_mod( 'theme_widget_post_slider_filter_categories' ),
					'filter_tags'       => (string) get_theme_mod( 'theme_widget_post_slider_filter_tags' ),
					'offset'            => (int) get_theme_mod( 'theme_widget_post_slider_filter_offset', 0 ),
					'orderby'           => (string) get_theme_mod( 'theme_widget_post_slider_sort_orderby', 'date' ),
					'time_frame'        => (string) get_theme_mod( 'theme_widget_post_slider_time_frame' ),
					'order'             => (string) get_theme_mod( 'theme_widget_post_slider_sort_order', 'DESC' ),
					'number_items'      => (int) get_theme_mod( 'theme_widget_post_slider_number_items', 3 ),
				),
				array(
					'slug'       => 'about',
					'display'    => (string) get_theme_mod( 'theme_widget_about_display', 'none' ),
					'priority'   => (int) get_theme_mod( 'theme_widget_about_order', 1000 ),
					'visibility' => (array) get_theme_mod( 'theme_widget_about_visibility' ),
				),
				array(
					'slug'       => 'follow',
					'display'    => (string) get_theme_mod( 'theme_widget_follow_display', 'none' ),
					'priority'   => (int) get_theme_mod( 'theme_widget_follow_order', 1000 ),
					'visibility' => (array) get_theme_mod( 'theme_widget_follow_visibility' ),
				),
				array(
					'slug'       => 'banner',
					'display'    => (string) get_theme_mod( 'theme_widget_banner_display', 'none' ),
					'priority'   => (int) get_theme_mod( 'theme_widget_banner_order', 1000 ),
					'visibility' => (array) get_theme_mod( 'theme_widget_banner_visibility' ),
				),
			),
		);

		if ( null !== $name ) {
			return $settings[ $name ];
		} else {
			return $settings;
		}
	}
}
