<?php

/**
 * Latitude51 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Latitude51
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('latitude51_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function latitude51_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Latitude51, use a find and replace
		 * to change 'latitude51' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('latitude51', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// SSWS2020
		// Set post thumbnail size.
		set_post_thumbnail_size(650, 453);

		// SSWS
		// Replace the excerpt [...] with "Read More" btn
		function latitude51_excerpt_more($more) {
			global $post;
		return '<div><button><a class="moretag" href="'. get_permalink($post->ID) . '">' . esc_html__( 'Read more', 'latitude51' ) . '</a></button></div>';
		}
		add_filter('excerpt_more', 'latitude51_excerpt_more');
		/**
		 * Filter the except length to 40 words.
		 *
		 * @param int $length Excerpt length.
		 * @return int (Maybe) modified excerpt length.
		 */
		function wpdocs_custom_excerpt_length( $length ) {
			return 30;
		}
		add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

		// Add custom image size used in Cover Template.
		add_image_size('latitude51-fullscreen', 1980, 9999);

		// Custom logo.
		$logo_width  = 120;
		$logo_height = 90;

		// If the retina setting is active, double the recommended width and height.
		if (get_theme_mod('retina_logo', false)) {
			$logo_width  = floor($logo_width * 2);
			$logo_height = floor($logo_height * 2);
		}

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		add_theme_support(
			'custom-logo',
			array(
				'height'      => $logo_height,
				'width'       => $logo_width,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__('Primary', 'latitude51'),
				// 'mobile' => esc_html__('Mobile', 'latitude51'),
				'footer' => esc_html__('Footer', 'latitude51'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'latitude51_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 120,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'latitude51_setup');

// SSWS SVG support
function latitude51_support_svg($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}
add_filter('upload_mimes', 'latitude51_support_svg');
// end SSWS SVG support

// SSWS ACF BLOCKS

// ver 2.0
/**
 * Register hero block
 * https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
add_action('acf/init', 'hero');
function hero()
{
	// check function exists
	if (function_exists('acf_register_block')) {

		// register a hero block
		acf_register_block(array(
			'name'              => 'hero',
			'title'             => __('Hero Content'),
			'description'       => __('Hero ACF Block: img bg with text & CTA.'),
			// 'render_callback'   => 'latitude51_acf_hero_render_callback', // stored at the bottom of functions.php, just for reference
			'render_template'   => 'template-parts/blocks/content-hero.php',
			'category'          => 'formatting',
			'icon'              => 'format-image',
			'mode'              => 'preview',
			'keywords'          => array('hero', 'image'),
		));
	}
}
// end SSWS ACF BLOCKS

// SSWS ACF callback
// The ACF Hero render callback function has been moved into template-parts/blocks/content-hero.php
// via 'render_template' => 'template-parts/blocks/content-hero.php',

/**
 *  This is the callback that displays the hero block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block content (emtpy string).
 * @param   bool $is_preview True during AJAX preview.
 */

// function latitude51_acf_hero_render_callback($block, $content = '', $is_preview = false) {}
// function logic is in template-parts/blocks/content-hero.php
// end SSWS ACF callback

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function latitude51_content_width()
{
	$GLOBALS['content_width'] = apply_filters('latitude51_content_width', 560);
}
add_action('after_setup_theme', 'latitude51_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function latitude51_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'latitude51'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'latitude51'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'latitude51_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function latitude51_scripts()
{
	wp_enqueue_style('latitude51-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('latitude51-style', 'rtl', 'replace');

	wp_enqueue_script('latitude51-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true);

	// SSWS Google Fonts: Oswald / Roboto
	wp_enqueue_style( 'latitude51-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap|Roboto:wght@400;700;900&display=swap' );

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'latitude51_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}