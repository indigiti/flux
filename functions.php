<?php
/**
 * Flux functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flux
 */

if ( ! class_exists( 'Flux' ) ) {
	/**
	 * Main Core Class
	 */
	class Flux {


		/**
		 * __construct
		 *
		 * This function will initialize the initialize
		 */
		public function __construct() {
			$this->init();
			$this->theme_files();
		}

		/**
		 * Init
		 */
		public function init() {
			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		}

		/**
		 * Theme support
		 */
		public function theme_support() {
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'custom-logo' );
			add_theme_support( 'custom-header' );
			add_theme_support( 'custom-background' );
			register_block_pattern();
			add_editor_style();
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function theme_setup() {
			/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on Flux, use a find and replace
			* to change 'flux' to the name of your theme in all the template files.
			*/
			load_theme_textdomain( 'flux', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
			add_theme_support( 'title-tag' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus(
				array(
					'primary'         => esc_html__( 'Primary', 'flux' ),
					'mobile'          => esc_html__( 'Mobile', 'flux' ),
					'burger'          => esc_html__( 'Burger', 'flux' ),
					'footer_columns'  => esc_html__( 'Footer Columns', 'flux' ),
					'additional_menu' => esc_html__( 'Additional', 'flux' ),
				)
			);

			/*
			* Switch default core markup for search form, comment form, comments, etc.
			* to output valid HTML5.
			*/
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				)
			);

			// Supported Appearance Tools.
			add_theme_support( 'custom-line-height' );
			add_theme_support( 'custom-spacing' );
			add_theme_support( 'custom-units' );
			add_theme_support( 'appearance-tools' );
			add_theme_support( 'border' );
			add_theme_support( 'link-color' );

			// Add support for responsive embeds.
			add_theme_support( 'responsive-embeds' );

			// Supported Formats.
			add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

			// Add theme support for selective refresh for widgets.
			remove_theme_support( 'customize-selective-refresh-widgets' );

			// Add support for full and wide align images.
			add_theme_support( 'align-wide' );

			/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			*/
			add_theme_support( 'post-thumbnails' );

			// Register custom thumbnail sizes.
			add_image_size( 'csco-small', 120, 120, true );
			add_image_size( 'csco-small-2x', 240, 240, true );

			add_image_size( 'csco-thumbnail', 528, 297, true );
			add_image_size( 'csco-thumbnail-2x', 1056, 594, true );
			add_image_size( 'csco-thumbnail-vertical', 528, 704, true );
			add_image_size( 'csco-thumbnail-vertical-2x', 1056, 1408, true );
			add_image_size( 'csco-thumbnail-uncropped', 528, 0, false );
			add_image_size( 'csco-thumbnail-uncropped-2x', 1056, 0, false );

			add_image_size( 'csco-medium', 822, 462, true );
			add_image_size( 'csco-medium-2x', 1644, 924, true );
			add_image_size( 'csco-medium-uncropped', 822, 0, false );

			add_image_size( 'csco-large', 1240, 698, true );
			add_image_size( 'csco-large-2x', 2480, 1395, true );
			add_image_size( 'csco-large-uncropped', 1240, 0, false );
		}

		/**
		 * Include theme files
		 */
		public function theme_files() {
			require_once get_theme_file_path( '/inc/deprecated.php' );
			require_once get_theme_file_path( '/inc/theme-setup.php' );
			require_once get_theme_file_path( '/core/theme-dashboard/class-theme-dashboard.php' );
			require_once get_theme_file_path( '/core/theme-demos/class-theme-demos.php' );
			require_once get_theme_file_path( '/core/customizer/class-customizer.php' );
			require_once get_theme_file_path( '/inc/assets.php' );
			require_once get_theme_file_path( '/inc/widgets-init.php' );
			require_once get_theme_file_path( '/inc/theme-functions.php' );
			require_once get_theme_file_path( '/inc/theme-demos.php' );
			require_once get_theme_file_path( '/inc/theme-mods.php' );
			require_once get_theme_file_path( '/inc/filters.php' );
			require_once get_theme_file_path( '/inc/gutenberg.php' );
			require_once get_theme_file_path( '/inc/actions.php' );
			require_once get_theme_file_path( '/inc/partials.php' );
			require_once get_theme_file_path( '/inc/theme-tags.php' );
			require_once get_theme_file_path( '/inc/post-meta.php' );
			require_once get_theme_file_path( '/inc/load-more.php' );
			require_once get_theme_file_path( '/inc/load-nextpost.php' );
			require_once get_theme_file_path( '/inc/custom-menu.php' );
			require_once get_theme_file_path( '/inc/custom-content.php' );
			require_once get_theme_file_path( '/inc/metabox.php' );
		}
	}

	// Initialize.
	new Flux();
}
