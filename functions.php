<?php
/**
 * ria\'s-apartment functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ria\'s-apartment
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rias_apartment_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ria\'s-apartment, use a find and replace
	 * to change 'rias-apartment' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('rias-apartment', get_template_directory() . '/languages');

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
	add_theme_support('woocommerce');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main-menu' => esc_html__('Main Menu', 'rias-apartment'),
			'footer-menu' => esc_html__('Footer Menu', 'rias-apartment'),
			'extra-links' => esc_html__('Extra Menu', 'rias-apartment'),
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
			'rias_apartment_custom_background_args',
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
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'rias_apartment_setup');
/**
 * Declare WooCommerce Support
 */
function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rias_apartment_content_width()
{
	$GLOBALS['content_width'] = apply_filters('rias_apartment_content_width', 640);
}
add_action('after_setup_theme', 'rias_apartment_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rias_apartment_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'rias-apartment'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'rias-apartment'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'rias_apartment_widgets_init');
wp_enqueue_style('theme-style', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css'));

/**
 * Enqueue scripts and styles.
 */
function rias_apartment_scripts()
{
	$version = rand(10, 100);

	// Custom styles
	wp_enqueue_style('bootstrap-min-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), _S_VERSION);
	wp_enqueue_style('change', get_stylesheet_directory_uri() . '/assets/css/change.css', array(), _S_VERSION);
	wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css', array(), _S_VERSION);
	wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), _S_VERSION);
	wp_enqueue_style('lightgallery-bundle', get_stylesheet_directory_uri() . '/assets/css/lightgallery-bundle.css', array(), _S_VERSION);
	wp_enqueue_style('datepicker', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), _S_VERSION);
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $version);
	wp_enqueue_style('mtps-checkout', get_stylesheet_directory_uri() . '/assets/css/mtps-checkout.css', array(), $version);

	// ── Secure Your Booking box ──────────────────────────────────────────────
	wp_add_inline_style('mtps-checkout', '
/* ── Secure Your Booking Box ─────────────────────────────── */
.rias-secure-booking-box {
	border: 1px solid #e2e8f0;
	border-radius: 10px;
	background: #ffffff;
	padding: 16px 18px;
	margin: 18px 0;
	box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}

/* Header: title + lock icon */
.rias-secure-booking-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 14px;
}
.rias-secure-booking-title {
	font-weight: 700;
	font-size: 1rem;
	color: #1a202c;
}
.rias-secure-booking-lock {
	font-size: 1.1rem;
	opacity: 0.75;
}

/* Pay Now row */
.rias-secure-booking-pay-now {
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	gap: 12px;
	background: #f7f8fa;
	border-radius: 8px;
	padding: 12px 14px;
}
.rias-secure-booking-pay-now-left {
	display: flex;
	flex-direction: column;
	gap: 2px;
}
.rias-secure-booking-pay-label {
	font-weight: 700;
	font-size: 0.95rem;
	color: #2d3748;
}
.rias-secure-booking-badge {
	display: inline-block;
	background: #edf2ff;
	color: #4361ee;
	font-size: 0.72rem;
	font-weight: 600;
	border-radius: 4px;
	padding: 2px 7px;
	margin-top: 3px;
	width: fit-content;
}
.rias-secure-booking-confirm-text {
	font-size: 0.78rem;
	color: #718096;
	margin: 4px 0 0;
	line-height: 1.4;
}
.rias-secure-booking-pay-now-right {
	flex-shrink: 0;
	text-align: right;
}
.rias-secure-booking-pay-amount {
	font-weight: 700;
	font-size: 1.05rem;
	color: #1a202c;
	white-space: nowrap;
}

/* Divider */
.rias-secure-booking-divider {
	border-top: 1px solid #e2e8f0;
	margin: 12px 0;
}

/* Remaining Balance row */
.rias-secure-booking-remaining {
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	gap: 12px;
}
.rias-secure-booking-remaining-left {
	display: flex;
	flex-direction: column;
	gap: 2px;
}
.rias-secure-booking-remaining-label {
	font-weight: 700;
	font-size: 0.9rem;
	color: #2d3748;
}
.rias-secure-booking-remaining-sub {
	font-size: 0.78rem;
	color: #718096;
	margin: 2px 0 0;
}
.rias-secure-booking-remaining-right {
	flex-shrink: 0;
	text-align: right;
}
.rias-secure-booking-remaining-amount {
	font-size: 0.95rem;
	font-weight: 600;
	color: #2d3748;
	white-space: nowrap;
}
	');

	wp_enqueue_style('developer', get_stylesheet_directory_uri() . '/assets/css/developer.css', array(), $version);




	// JS files
	wp_enqueue_script('rias-apartment-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('jquery-3-7-1-min-js', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('bootstrap-bundle-min-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('slick-min-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('gallery-js', get_template_directory_uri() . '/assets/js/gallery.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('lg-autoplay-min-js', get_template_directory_uri() . '/assets/js/lg-autoplay.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('lg-thumbnail-min-js', get_template_directory_uri() . '/assets/js/lg-thumbnail.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('lg-zoom-min-js', get_template_directory_uri() . '/assets/js/lg-zoom.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('lightgallery-min-js', get_template_directory_uri() . '/assets/js/lightgallery.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('datepicker-js', 'https://cdn.jsdelivr.net/npm/flatpickr', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('datepicker-greek-js', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/el.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), _S_VERSION, true);

	// Disabled to test default MotoPress search form behavior.
	// wp_enqueue_script('mphb-override-js', get_template_directory_uri() . '/assets/js/mphb-override.js', array('mphb'), _S_VERSION, true);



}
add_action('wp_enqueue_scripts', 'rias_apartment_scripts');

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



add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{
	if (function_exists('acf_add_options_page')) {
		$parent = acf_add_options_page(array(
			'page_title' => __('Theme General Settings', 'your-text-domain'),
			'menu_title' => __('Theme Settings', 'your-text-domain'),
			'menu_slug' => 'theme-general-settings',
			'capability' => 'manage_options',
			'redirect' => false
		));
		acf_add_options_page(array(
			'page_title' => __('Common Settings', 'your-text-domain'),
			'menu_title' => __('Common Settings', 'your-text-domain'),
			'parent_slug' => $parent['menu_slug'],
			'capability' => 'manage_options'
		));
	}
}
// =========================including extra files

include_once("inc/shortcode.php");

add_filter('nav_menu_css_class', function ($classes, $item, $args) {
	if (isset($args->menu_class) && $args->menu_class === 'footer__info-top') {
		$classes[] = 'footer__item';
	}
	return $classes;
}, 10, 3);

add_filter('wpcf7_autop_or_not', '__return_false');


// Register Homepage Widget Area
function mytheme_register_widget_areas()
{
	register_sidebar(array(
		'name' => __('Homepage Banner', 'your-theme-textdomain'),
		'id' => 'homepage-banner',
		'description' => __('Widget area for homepage banner search form.', 'your-theme-textdomain'),
		'before_widget' => '<div class="homepage-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
add_action('widgets_init', 'mytheme_register_widget_areas');

// add_action( 'template_redirect', 'ria_redirect_search_results_to_where_youll_stay' );
// function ria_redirect_search_results_to_where_youll_stay() {

//     if ( is_admin() ) return;

//     // Run ONLY on the MotoPress Search Results page
//     if ( ! is_page( 'search-results' ) ) {
//         return;
//     }

//     // Only run if the search form submitted
//     if ( empty($_GET['mphb_check_in_date']) || empty($_GET['mphb_check_out_date']) ) {
//         return;
//     }

//     // Destination page
//     $target_url = 'https://relaxed-tereshkova.74-208-156-247.plesk.page/rias-apartment/where-youll-stay/';

//     // Preserve booking params
//     $params = [];
//     foreach ( ['mphb_check_in_date','mphb_check_out_date','mphb_adults','mphb_children'] as $k ) {
//         if ( isset($_GET[$k]) ) {
//             $params[$k] = sanitize_text_field($_GET[$k]);
//         }
//     }

//     wp_safe_redirect( add_query_arg( $params, $target_url ) );
//     exit;
// }
// add_action( 'template_redirect', 'ria_redirect_correct_search_results_page' );
// function ria_redirect_correct_search_results_page() {

//     if ( is_admin() ) return;

//     // ---- IMPORTANT ----
//     // Replace this with the actual ID of your Search Results page
//     $search_results_page_id = 1234;

//     // Only run if we are on the real Search Results page
//     if ( ! is_page( $search_results_page_id ) ) {
//         return;
//     }

//     // Only redirect if MotoPress search was submitted
//     if ( empty($_GET['mphb_check_in_date']) || empty($_GET['mphb_check_out_date']) ) {
//         return;
//     }

//     // Your target URL
//     $target_url = 'https://relaxed-tereshkova.74-208-156-247.plesk.page/rias-apartment/where-youll-stay/';

//     // Preserve parameters
//     $params = [];
//     foreach ( ['mphb_check_in_date','mphb_check_out_date','mphb_adults','mphb_children'] as $k ) {
//         if ( isset($_GET[$k]) ) {
//             $params[$k] = sanitize_text_field($_GET[$k]);
//         }
//     }

//     wp_safe_redirect( add_query_arg( $params, $target_url ) );
//     exit;
// }


// Start session early
add_action('init', function () {
	if (!session_id()) {
		session_start();
	}
});

// Redirect search results → custom page
add_action('template_redirect', function () {

	// Don't redirect in admin
	if (is_admin())
		return;

	// Detect MotoPress search request (any page)
	if (
		!isset($_GET['mphb_check_in_date']) ||
		!isset($_GET['mphb_check_out_date']) ||
		!isset($_GET['mphb_adults'])
	) {
		return; // Not a search request
	}

	// Determine language from multiple sources
	$current_lang = 'en'; // default

	// Check the referring page (where the search form was submitted from)
	$referer = $_SERVER['HTTP_REFERER'] ?? '';
	if (strpos($referer, '/el/') !== false || strpos($referer, '/ελ/') !== false) {
		$current_lang = 'el';
	}

	// Also check current URL
	$current_url = $_SERVER['REQUEST_URI'] ?? '';
	if (strpos($current_url, '/el/') !== false || strpos($current_url, '/ελ/') !== false) {
		$current_lang = 'el';
	}

	// Check Polylang
	if (function_exists('pll_current_language')) {
		$pll_lang = pll_current_language();
		if ($pll_lang === 'el') {
			$current_lang = 'el';
		}
	}

	// Get target page based on language
	$en_page = get_page_by_path('where-youll-stay');
	if (!$en_page)
		return;

	$target_page_id = $en_page->ID; // Default to English

	// If Greek, try to get the translated page
	if ($current_lang === 'el' && function_exists('pll_get_post')) {
		$el_page_id = pll_get_post($en_page->ID, 'el');
		if ($el_page_id) {
			$target_page_id = $el_page_id;
		}
	}

	// Check if we're already on the destination page
	if (is_page($target_page_id)) {
		// CLEAN URL ONLY ONCE
		if (isset($_GET['mphb_check_in_date'])) {
			// Save parameters in session
			$_SESSION['mphb_data'] = [
				'check_in' => $_GET['mphb_check_in_date'] ?? '',
				'check_out' => $_GET['mphb_check_out_date'] ?? '',
				'adults' => $_GET['mphb_adults'] ?? '',
				'children' => $_GET['mphb_children'] ?? '',
			];

			// Redirect to clean URL
			wp_redirect(get_permalink());
			exit;
		}
		return;
	}

	// Build redirect URL
	$target_url = get_permalink($target_page_id);
	$redirect_url = add_query_arg($_GET, $target_url);

	// Append anchor to scroll to section
	$redirect_url .= '#CheckAvailabilityId';

	// DEBUG
	error_log('=== SEARCH REDIRECT ===');
	error_log('Referer: ' . $referer);
	error_log('Current URL: ' . $current_url);
	error_log('Detected Lang: ' . $current_lang);
	error_log('Target Page ID: ' . $target_page_id);
	error_log('Redirect to: ' . $redirect_url);

	// Perform redirect
	wp_safe_redirect($redirect_url);
	exit;
});

// Dynamically change MotoPress checkout page based on language
add_filter('option_mphb_checkout_page', function ($value) {

	// Get current language
	$current_lang = 'en';
	if (function_exists('pll_current_language')) {
		$current_lang = pll_current_language();
	}
	// If Greek, return Greek checkout page ID
	if ($current_lang === 'el') {
		$en_page = get_page_by_path('booking-confirmation');
		if ($en_page && function_exists('pll_get_post')) {
			$el_page_id = pll_get_post($en_page->ID, 'el');
			if ($el_page_id) {
				return $el_page_id;
			}
		}
	}
	return $value;
}, 10, 1);

// Dynamically change MotoPress reservation received (thank you) page based on language
add_filter('option_mphb_payment_success_page', function ($value) {

	// Get current language
	$current_lang = 'en';
	if (function_exists('pll_current_language')) {
		$current_lang = pll_current_language();
	}
	// If Greek, return Greek thank-you page ID
	if ($current_lang === 'el') {
		return 1515; // Greek: /el/η-κράτηση-ελήφθη/
	}
	// English: page ID 615 (/reservation-received/) — stored in DB option
	return $value;
}, 10, 1);

// ============================================================
// Force minimum 3-night stay for ALL languages
// Hardcoded override to ensure booking rules apply on both
// English and Greek calendar pages
// ============================================================
// Disabled to test default MotoPress search behavior.
// add_filter('mphb_get_booking_rules_for_date', function ($rules, $roomTypeId, $date) {
// 	// Force minimum stay to 3 nights (applies to all room types, all dates, all languages)
// 	$rules['min_stay_length'] = max($rules['min_stay_length'], 3);
// 	return $rules;
// }, 10, 3);

// Redirect checkout page to correct language version (only when no booking data)
// DISABLED - Using page_link filter instead to preserve POST data
/*
add_action('template_redirect', function() {
    
    // Don't redirect in admin
    if (is_admin()) return;
    
    // Check if we're on the checkout page
    if (!is_page('booking-confirmation') && !is_page('επιβεβαίωση-κράτησης')) {
        return; // Not on checkout page
    }
    
    // DON'T redirect if there's POST data (active booking)
    if (!empty($_POST)) {
        return; // Let MotoPress handle the checkout with POST data
    }
    
    // DON'T redirect if there's booking data in the URL
    if (isset($_GET['mphb_room_type_id']) || isset($_GET['booking_id'])) {
        return; // Active booking, don't redirect
    }
    
    // Determine current language
    $current_lang = 'en';
    
    // Check referer
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    if (strpos($referer, '/el/') !== false || strpos($referer, '/ελ/') !== false) {
        $current_lang = 'el';
    }
    
    // Check current URL
    $current_url = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($current_url, '/el/') !== false || strpos($current_url, '/ελ/') !== false) {
        $current_lang = 'el';
    }
    
    // Check Polylang
    if (function_exists('pll_current_language')) {
        $pll_lang = pll_current_language();
        if ($pll_lang === 'el') {
            $current_lang = 'el';
        }
    }
    
    // Get the correct checkout page
    $en_page = get_page_by_path('booking-confirmation');
    if (!$en_page) return;
    
    $target_page_id = $en_page->ID;
    
    // If Greek, get translated page
    if ($current_lang === 'el' && function_exists('pll_get_post')) {
        $el_page_id = pll_get_post($en_page->ID, 'el');
        if ($el_page_id) {
            $target_page_id = $el_page_id;
        }
    }
    
    // If we're already on the correct page, do nothing
    if (is_page($target_page_id)) {
        return;
    }
    
    // Only redirect if no active booking (empty page access)
    wp_safe_redirect(get_permalink($target_page_id));
    exit;
});
*/

// functions.php

/*
add_filter('gettext', function ($translated_text, $text, $domain) {

	$siteLang = function_exists('pll_current_language') ? pll_current_language() : 'en';

	// === English translations ===
	if ($siteLang === 'en') {

		if ($text === 'Search' && $domain === 'motopress-hotel-booking') {
			return 'Proceed';
		}

		if ($text === 'Check Availability' && $domain === 'motopress-hotel-booking') {
			return 'Book Now';
		}
	}

	// === Greek translations ===
	if ($siteLang === 'el') {

		if ($text === 'Search' && $domain === 'motopress-hotel-booking') {
			return 'Αναζήτηση'; // or your custom Greek text
		}

		if ($text === 'Check Availability' && $domain === 'motopress-hotel-booking') {
			return 'Κάντε Κράτηση'; // Greek version
		}
	}

	return $translated_text;

}, 20, 3);
*/

add_filter('gettext', function ($translated_text, $text, $domain) {
	if ($domain !== 'motopress-hotel-booking') {
		return $translated_text;
	}

	$siteLang = function_exists('pll_current_language') ? pll_current_language() : 'en';
	if ($siteLang !== 'el') {
		return $translated_text;
	}

	if ($text === 'Search') {
		return 'Αναζήτηση';
	}

	if ($text === 'Check Availability') {
		return 'Κάντε Κράτηση';
	}

	return $translated_text;
}, 20, 3);

add_filter('woocommerce_order_button_text', 'custom_place_order_text');
function custom_place_order_text($text)
{
	return 'Confirm Booking';
}


// Add a custom class without removing existing classes
add_filter('woocommerce_order_button_html', 'add_custom_class_to_place_order_button');
function add_custom_class_to_place_order_button($button)
{
	$button = str_replace(
		'class="',
		'class="btn-theme',
		$button
	);
	return $button;
}





add_action('template_redirect', 'rias_reorganize_checkout_fields');
function rias_reorganize_checkout_fields()
{
	// Only target the checkout page
	if (!is_page())
		return;

	$hook = 'mphb_sc_checkout_form';
	$view = '\MPHB\Views\Shortcodes\CheckoutView';

	// Remove ALL original actions to ensure a clean slate
	remove_all_actions($hook);

	// Re-add WRAPPERS and ELEMENTS in the desired order

	// 1. OPEN LEFT COLUMN
	add_action($hook, 'rias_checkout_layout_open_wrapper', 5);

	// 2. LEFT COLUMN CONTENT
	add_action('mphb_sc_checkout_form_booking_details', 'rias_render_checkout_image', 5);
	add_action($hook, array($view, 'renderBookingDetails'), 10, 2);
	add_action($hook, 'rias_render_checkin_info', 11); // Check-in method & House rules
	add_action($hook, 'rias_render_cancellation_policy', 12); // Cancellation Policy
	add_action($hook, array($view, 'renderCustomerDetails'), 15, 3);
	add_action($hook, array($view, 'renderCheckoutText'), 17);
	// remove_action($hook, array($view, 'renderTermsAndConditions'), 19); // We will use our own custom one

	// 3. SWITCH TO RIGHT COLUMN
	add_action($hook, 'rias_checkout_layout_column_switch', 25);

	// 4. RIGHT COLUMN CONTENT
	add_action($hook, array($view, 'renderCoupon'), 30);
	add_action($hook, 'rias_render_grouped_price_breakdown', 35);
	add_action($hook, array($view, 'renderTotalPrice'), 38);
	add_action($hook, 'rias_render_secure_booking_box', 39); // Secure Your Booking deposit box
	add_action($hook, array($view, 'renderBillingDetails'), 40);
	add_action($hook, 'rias_render_custom_checkout_terms', 41); // NEW: Custom T&C Checkbox
	add_action($hook, 'rias_render_trust_icons', 42);


	// 5. CLOSE WRAPPERS
	add_action($hook, 'rias_checkout_layout_close_wrapper', 65);
}

// Wrapper hooks

function rias_checkout_layout_open_wrapper()
{
	echo '<div class="rias-mphb-checkout-container">';
	echo '<div class="rias-mphb-checkout-left">';
}

function rias_checkout_layout_column_switch()
{
	echo '</div>'; // close left
	echo '<div class="rias-mphb-checkout-right">';
}

function rias_checkout_layout_close_wrapper()
{
	echo '</div>'; // close right
	echo '</div>'; // close container
}

function rias_render_checkout_image()
{
	$checkoutBannerImage = get_field("checkout_banner_image", "option");
	?>
	<div class="rias-checkout-details-image" style="margin-bottom: 25px; text-align: center;">
		<img src="<?php echo $checkoutBannerImage["url"]; ?>" alt="<?php echo $checkoutBannerImage["title"]; ?>"
			style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
	</div>
	<?php
}

/**
 * Move the submit (Book Now) button into the right column
 */
add_action('wp_footer', 'rias_move_submit_to_right_column', 100);
function rias_move_submit_to_right_column()
{
	if (!is_page())
		return;

	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
	$err_msg = ($lang === 'el')
		? 'Παρακαλούμε αποδεχτείτε τους όρους και τις προϋποθέσεις για να συνεχίσετε.'
		: 'Please accept the terms & conditions to proceed.';
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			// Wrap check-in/check-out dates in a styled container
			function wrapCheckinCheckoutDates() {
				var $checkIn = $('.mphb_sc_checkout-form .mphb-check-in-date, .mphb_sc_checkout-wrapper .mphb-check-in-date');
				var $checkOut = $('.mphb_sc_checkout-form .mphb-check-out-date, .mphb_sc_checkout-wrapper .mphb-check-out-date');
				if ($checkIn.length && $checkOut.length && !$checkIn.closest('.rias-checkin-checkout-wrapper').length) {
					$checkIn.add($checkOut).wrapAll('<div class="rias-checkin-checkout-wrapper"></div>');
				}
			}
			wrapCheckinCheckoutDates();

			// Move check-in info & cancellation policy right after the date wrapper
			function moveInfoBlocksAfterDates() {
				var $dateWrapper = $('.rias-checkin-checkout-wrapper');
				var $checkinInfo = $('.rias-checkin-info-block');
				var $cancellation = $('.rias-cancellation-policy-block');
				if ($dateWrapper.length) {
					if ($checkinInfo.length && !$checkinInfo.prev().is('.rias-checkin-checkout-wrapper')) {
						$checkinInfo.insertAfter($dateWrapper);
					}
					if ($cancellation.length) {
						var $target = $checkinInfo.length ? $checkinInfo : $dateWrapper;
						if (!$cancellation.prev().is('.rias-checkin-info-block') && !$cancellation.prev().is('.rias-checkin-checkout-wrapper')) {
							$cancellation.insertAfter($target);
						}
					}
				}
			}
			moveInfoBlocksAfterDates();

			function relocateElements() {
				var rightColumn = $('.rias-mphb-checkout-right');
				if (!rightColumn.length) return;

				var terms = $('.rias-checkout-terms-wrapper');
				var trust = $('.rias-trust-icons-wrapper');
				var submit = $('.mphb_sc_checkout-submit-wrapper');

				// Ensure order: Terms -> Trust Icons -> Submit
				// Only append if they are NOT already children of the rightColumn to avoid infinite loops with MutationObserver
				if (terms.length && !rightColumn.find('.rias-checkout-terms-wrapper').length) {
					terms.appendTo(rightColumn);
				}
				if (trust.length && !rightColumn.find('.rias-trust-icons-wrapper').length) {
					trust.appendTo(rightColumn);
				}
				if (submit.length && !rightColumn.find('.mphb_sc_checkout-submit-wrapper').length) {
					submit.appendTo(rightColumn);
				}
			}

			relocateElements();

			// Re-run after AJAX updates
			var observer = new MutationObserver(function () {
				relocateElements();
				wrapCheckinCheckoutDates();
				moveInfoBlocksAfterDates();
			});
			var target = document.querySelector('.mphb_sc_checkout-wrapper') || document.body;
			if (target) {
				observer.observe(target, { childList: true, subtree: true });
			}

			// --- Book Now button visibility logic ---
			function toggleBookNowVisibility() {
				var $submit = $('.mphb_sc_checkout-submit-wrapper');
				if (!$submit.length) return;

				var $fn = $('#mphb_first_name');
				var $ln = $('#mphb_last_name');
				var $em = $('#mphb_email');
				var $ph = $('#mphb_phone');
				var $tc = $('#rias_accept_terms');

				var allFilled = true;

				// Check required text fields
				if ($fn.length && !$.trim($fn.val())) allFilled = false;
				if ($ln.length && !$.trim($ln.val())) allFilled = false;
				if ($em.length && !$.trim($em.val())) allFilled = false;
				if ($ph.length && !$.trim($ph.val())) allFilled = false;

				// Check T&C checkbox
				if ($tc.length && !$tc.is(':checked')) allFilled = false;

				if (allFilled) {
					$submit.addClass('rias-submit-visible');
				} else {
					$submit.removeClass('rias-submit-visible');
				}
			}

			// Run on page load (in case fields are pre-filled)
			setTimeout(toggleBookNowVisibility, 500);

			// Run on any input change in required fields and T&C checkbox
			$(document).on('input change keyup', '#mphb_first_name, #mphb_last_name, #mphb_email, #mphb_phone, #rias_accept_terms', function () {
				toggleBookNowVisibility();
			});

			// Also reset T&C highlight when checked
			$(document).on('change', '#rias_accept_terms', function () {
				if ($(this).is(':checked')) {
					$('.rias-checkout-terms-wrapper').css({
						'border-color': '#cbd5e0',
						'background': '#f8fafc'
					});
				}
			});
		});
	</script>
	<?php
}

/**
 * Render the "Secure Your Booking" deposit box (right column, priority 39)
 */
function rias_render_secure_booking_box()
{
	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

	$title = ($lang === 'el') ? 'Ασφαλίστε την Κράτησή σας' : 'Secure Your Booking';
	$pay_now_label = ($lang === 'el') ? 'Πληρώστε Τώρα' : 'Pay Now';

	// Default label, will be updated by JS
	$deposit_badge = ($lang === 'el') ? '... Προκαταβολή' : '... Deposit';

	$confirm_text = ($lang === 'el') ? 'Για επιβεβαίωση της κράτησής σας άμεσα.' : 'To confirm your reservation immediately.';
	$remaining_label = ($lang === 'el') ? 'Υπόλοιπο Ποσό' : 'Remaining Balance';
	$remaining_sub = ($lang === 'el') ? 'Οφείλεται 1 μήνα πριν την άφιξη' : 'Due 1 month before arrival';
	?>
	<div class="rias-secure-booking-box">
		<div class="rias-secure-booking-header">
			<span class="rias-secure-booking-title"><?php echo esc_html($title); ?></span>
			<span class="rias-secure-booking-lock">&#128274;</span>
		</div>

		<div class="rias-secure-booking-pay-now">
			<div class="rias-secure-booking-pay-now-left">
				<span class="rias-secure-booking-pay-label"><?php echo esc_html($pay_now_label); ?></span>
				<span class="rias-secure-booking-badge"><?php echo esc_html($deposit_badge); ?></span>
				<p class="rias-secure-booking-confirm-text"><?php echo esc_html($confirm_text); ?></p>
			</div>
			<div class="rias-secure-booking-pay-now-right">
				<span class="rias-secure-booking-pay-amount" id="rias-deposit-pay-amount">—</span>
			</div>
		</div>

		<div class="rias-secure-booking-divider"></div>

		<div class="rias-secure-booking-remaining">
			<div class="rias-secure-booking-remaining-left">
				<span class="rias-secure-booking-remaining-label"><?php echo esc_html($remaining_label); ?></span>
				<p class="rias-secure-booking-remaining-sub"><?php echo esc_html($remaining_sub); ?></p>
			</div>
			<div class="rias-secure-booking-remaining-right">
				<span class="rias-secure-booking-remaining-amount" id="rias-deposit-remaining-amount">—</span>
			</div>
		</div>
	</div>
	<?php
	
}

/**
 * JS: Populate the Secure Your Booking box with live MotoPress deposit amounts
 */
add_action('wp_footer', 'rias_enhance_deposit_display', 102);
function rias_enhance_deposit_display()
{
	if (!is_page())
		return;
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			function enhanceDepositDisplay() {
			var $box = $('.rias-secure-booking-box'); // 👈 add this

			// Hide the original MotoPress deposit row
			var $depositEl = $('.mphb-deposit-amount');
			if ($depositEl.length) $depositEl.hide();

			// Get deposit element
			var $depositField = $depositEl.find('.mphb-deposit-amount-field .mphb-price');

			// ❗ If no deposit field → hide box
			if (!$depositField.length) {
				$box.hide();
				return;
			}

			var currencySymbol = '€';
			var totalAmount = 0;
			var depositAmount = 0;

			// Parse total
			var $totalEl = $('.mphb-total-price .mphb-price, tr.mphb-price-breakdown-total .mphb-price').first();
			if ($totalEl.length) {
				currencySymbol = $totalEl.find('.mphb-currency').first().text() || '€';
				totalAmount = parseFloat(
				$totalEl.text().replace(currencySymbol, '').replace(/,/g, '').trim()
				);
			}

			// Parse deposit
			depositAmount = parseFloat(
				$depositField.text().replace(currencySymbol, '').replace(/,/g, '').trim()
			);

			// ❗ If invalid or zero → hide box
			if (isNaN(totalAmount) || isNaN(depositAmount) || depositAmount <= 0) {
				$box.hide();
				return;
			}

			// ✅ Valid data → show box
			$box.show();

			// --- rest of your existing code ---
			var calculatedPercent = (totalAmount > 0)
				? Math.round((depositAmount / totalAmount) * 100)
				: 0;

			var depositLabel = (calculatedPercent > 0 && calculatedPercent < 100)
				? (calculatedPercent + '%')
				: '';

			var remainingAmount = Math.max(0, totalAmount - depositAmount);

			function fmt(num) {
				return currencySymbol + num.toLocaleString('en-US', {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2
				});
			}

			var newDeposit = fmt(depositAmount);
			var newRemaining = fmt(remainingAmount);

			var $payAmt = $('#rias-deposit-pay-amount');
			var $remAmt = $('#rias-deposit-remaining-amount');
			var $badge = $('.rias-secure-booking-badge');

			if ($payAmt.text() !== newDeposit) $payAmt.text(newDeposit);
			if ($remAmt.text() !== newRemaining) $remAmt.text(newRemaining);

			if (depositLabel) {
				var lang = $('html').attr('lang') || 'en';
				var badgeSuffix = (lang.indexOf('el') !== -1) ? ' Προκαταβολή' : ' Deposit';
				$badge.text(depositLabel + badgeSuffix).show();
			} else {
				$badge.hide();
			}
			}

			setTimeout(enhanceDepositDisplay, 800);

			// Debounced observer
			var depositTimer;
			new MutationObserver(function () {
				clearTimeout(depositTimer);
				depositTimer = setTimeout(enhanceDepositDisplay, 150);
			}).observe(
				document.querySelector('.mphb_sc_checkout-wrapper') || document.body,
				{ childList: true, subtree: true, characterData: true }
			);
		});
	</script>
	<?php
}


/**
 * Override MotoPress Hotel Booking calendar popup container.
 * Appends the calendar popup to the parent div of the input instead of the body.
 */
function mphb_calendar_popup_container_override()
{
	$inline_js = "
        (function($) {
            var targetSelectors = '.mphb-check-in-date-wrapper, .mphb-check-out-date-wrapper, .mphb_sc_search-check-in-date, .mphb_sc_search-check-out-date, .mphb-check-in-date, .mphb-check-out-date, .hero__search-box, .homepage-banner-widget';

            function applyPatch() {
                if ($.fn.datepick && !$.fn.datepick._patched) {
                    var original = $.fn.datepick;
                    var patched = function(options) {
                        if (arguments.length === 1 && typeof options === 'object' && options !== null && options.pickerClass && options.pickerClass.indexOf('mphb') !== -1) {
                            var \$input = $(this);
                            var \$wrapper = \$input.closest(targetSelectors);
                            if (\$wrapper.length) {
                                options.popupContainer = \$wrapper[0];
                                console.log('MPHB Override: Set popupContainer for', \$input.attr('name'), 'to', \$wrapper[0]);
                            } else {
                                console.log('MPHB Override: No wrapper found for', \$input.attr('name'));
                            }
                        }
                        return original.apply(this, arguments);
                    };
                    // Essential for kbwood datepick which has many static methods on the plugin function
                    for (var key in original) {
                        if (original.hasOwnProperty(key)) patched[key] = original[key];
                    }
                    $.fn.datepick = patched;
                    $.fn.datepick._patched = true;
                    console.log('MPHB Override: datepick patched');
                }
            }

            // Attempt to patch as early as possible
            if ($.fn.datepick) {
                applyPatch();
            } else {
                var timer = setInterval(function() {
                    if ($.fn.datepick) {
                        applyPatch();
                        clearInterval(timer);
                    }
                }, 20);
                setTimeout(function() { clearInterval(timer); }, 5000);
            }
            
            $(function() { applyPatch(); });
        })(jQuery);
    ";
	// Runs right before mphb.js to catch its initialization calls
	wp_add_inline_script('mphb', $inline_js, 'before');
}
// Disabled to test default MotoPress datepicker behavior.
// add_action('wp_enqueue_scripts', 'mphb_calendar_popup_container_override', 99);

/**
 * Fix: Close check-in datepicker after date selection & enforce 3-day minimum stay
 * on the homepage MotoPress search form.
 *
 * Patches the live MotoPress homepage search form after mphb.js has registered
 * its datepickers, keeping the existing redirect customization untouched.
 */
// Disabled to test default MotoPress datepicker/search behavior.
add_action('wp_enqueue_scripts', 'rias_fix_checkin_datepicker_close', 100);
function rias_fix_checkin_datepicker_close()
{
	// Only run on the front page / homepage
	if (!is_front_page() && !is_page_template('template-home.php')) {
		return;
	}

	$inline_js = <<<'JS'
		(function($) {
			var MIN_NIGHTS = 3;
			var disabledDateCss = [
				'.mphb-unselectable-date a, .mphb-earlier-min-date a, .mphb-not-check-out-date a, .mphb-not-check-in-date a, .mphb-past-date a {',
				'pointer-events: none !important;',
				'cursor: default !important;',
				'opacity: 0.5 !important;',
				'text-decoration: line-through !important;',
				'}'
			].join('');
			$('<style>').prop('type', 'text/css').html(disabledDateCss).appendTo('head');

			$(document).on('click', '.mphb-unselectable-date, .mphb-earlier-min-date, .mphb-not-check-out-date, .mphb-not-check-in-date, .mphb-past-date', function(e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				return false;
			});

			function cloneDate(date) {
				return date ? new Date(date.getTime()) : null;
			}

			function normaliseDate(date) {
				var copy = cloneDate(date);
				if (!copy) {
					return null;
				}
				copy.setHours(0, 0, 0, 1);
				return copy;
			}

			function addDays(date, days) {
				var copy = normaliseDate(date);
				if (!copy) {
					return null;
				}
				copy.setDate(copy.getDate() + days);
				return copy;
			}

			function sameDay(a, b) {
				return !!(
					a &&
					b &&
					a.getFullYear() === b.getFullYear() &&
					a.getMonth() === b.getMonth() &&
					a.getDate() === b.getDate()
				);
			}

			function hasDatepickInstance(inst) {
				return !!(inst && inst.options && inst.elem);
			}

			function getTodayDate() {
				if (window.MPHB && MPHB._data && MPHB._data.today && $.datepick && $.datepick.parseDate) {
					try {
						return $.datepick.parseDate(MPHB._data.settings.dateTransferFormat, MPHB._data.today);
					} catch (e) {}
				}

				var today = new Date();
				today.setHours(0, 0, 0, 1);
				return today;
			}

			function getInputDate($input) {
				if (!$input || !$input.length || !$.datepick) {
					return null;
				}

				try {
					var selectedDates = $input.datepick('getDate');
					if (selectedDates && selectedDates.length && selectedDates[0]) {
						return cloneDate(selectedDates[0]);
					}
				} catch (e) {}

				if (!(window.MPHB && MPHB._data && MPHB._data.settings && $.datepick.parseDate)) {
					return null;
				}

				try {
					return $.datepick.parseDate(MPHB._data.settings.dateFormat, $input.val());
				} catch (e) {
					return null;
				}
			}

			function getHomeSearchForms() {
				return $('form.mphb_sc_search-form, form.mphb_widget_search-form, form.mphb_cb_search_form').filter(function() {
					return $(this).closest('.homepage-banner-widget, .hero__search-box').length > 0;
				});
			}

			function getDatepickerWrapper($input) {
				if (!$input || !$input.length) {
					return $();
				}

				return $input.closest('.mphb_sc_search-check-in-date, .mphb_sc_search-check-out-date, .mphb-check-in-date-wrapper, .mphb-check-out-date-wrapper, .mphb-check-in-date, .mphb-check-out-date');
			}

			function clearPopupLoading($input) {
				var $wrapper = getDatepickerWrapper($input);
				if ($wrapper.length) {
					$wrapper.find('.datepick-popup').removeClass('mphb-loading');
				}
				$('.homepage-banner-widget .datepick-popup, .hero__search-box .datepick-popup').removeClass('mphb-loading');
			}

			function armLoadingWatchdog($input) {
				if (!$input || !$input.length) {
					return;
				}

				var timerId = $input.data('riasLoadingWatchdog');
				if (timerId) {
					window.clearTimeout(timerId);
				}

				timerId = window.setTimeout(function() {
					clearPopupLoading($input);
				}, 1800);

				$input.data('riasLoadingWatchdog', timerId);
			}

			function resetStaleDatepickerState($input) {
				if (!$input || !$input.length || !$.datepick || !$.datepick._getInst) {
					return;
				}

				var inst = $.datepick._getInst($input[0]);
				if (!hasDatepickInstance(inst)) {
					return;
				}

				clearPopupLoading($input);

				if (inst.div && inst.div.length && !inst.div.is(':visible')) {
					inst.div.remove();
					inst.div = null;
				}

				if ($.datepick.curInst === inst && (!inst.div || !inst.div.length || !inst.div.is(':visible'))) {
					$.datepick.curInst = null;
				}
			}

			function hideDatepicker($input) {
				if (!$input || !$input.length || !$.datepick) {
					return;
				}

				var input = $input[0];
				var hide = function() {
					clearPopupLoading($input);
					try {
						input.blur();
					} catch (e) {}
					try {
						$.datepick.hide(input);
					} catch (e) {
						try {
							$input.datepick('hide');
						} catch (ignore) {}
					}
					window.setTimeout(function() {
						getDatepickerWrapper($input).find('.datepick-popup').stop(true, true).hide();
						resetStaleDatepickerState($input);
					}, 0);
				};

				if (window.requestAnimationFrame) {
					window.requestAnimationFrame(hide);
					window.setTimeout(hide, 60);
				} else {
					window.setTimeout(hide, 0);
					window.setTimeout(hide, 60);
				}
			}

			function syncCheckoutField($form, forceDate) {
				var $checkIn = $form.find('input[name="mphb_check_in_date"]');
				var $checkOut = $form.find('input[name="mphb_check_out_date"]');

				if (!$checkIn.length || !$checkOut.length || !$.datepick) {
					return;
				}

				var checkInDate = getInputDate($checkIn);
				if (!checkInDate) {
					try {
						$checkOut.datepick('option', 'minDate', getTodayDate());
					} catch (e) {}
					return;
				}

				// Set the minimum checkout date based on the minimum stay, but do not auto-select a date.
				var minCheckout = addDays(checkInDate, MIN_NIGHTS);
				try {
					$checkOut.datepick('option', 'minDate', minCheckout);
					$checkOut.datepick('option', 'defaultDate', null);
					$checkOut.val('');
					$checkOut.datepick('setDate', null);
				} catch (e) {}
			window.setTimeout(function(){ $checkOut.val(''); $checkOut.datepick('setDate', null); }, 200);

			}

			function wrapInstanceCallback(inst, callbackName, wrapperFactory) {
				if (!hasDatepickInstance(inst)) {
					return false;
				}

				var marker = '__riasWrapped_' + callbackName;
				if (inst.options[marker]) {
					return true;
				}

				var originalCallback = inst.options[callbackName];
				inst.options[callbackName] = wrapperFactory(originalCallback);
				inst.options[marker] = true;
				return true;
			}

			function patchAjaxHelper() {
				if (!window.MPHB || !MPHB.ajaxApiHelper || MPHB.ajaxApiHelper._riasPatchedLoadCalendarData) {
					return !!(window.MPHB && MPHB.ajaxApiHelper);
				}

				MPHB.ajaxApiHelper.loadRoomTypeCalendarData = function(startDate, monthsCount, roomTypeId, isShowPrices, isTruncatePrices, isShowPricesCurrency, runBeforeDataLoading, runAfterDataLoaded, minLoadingMonthsCount) {
					var self = this;
					runBeforeDataLoading = (typeof runBeforeDataLoading === 'function') ? runBeforeDataLoading : function() {};
					runAfterDataLoaded = (typeof runAfterDataLoaded === 'function') ? runAfterDataLoaded : function() {};
					minLoadingMonthsCount = minLoadingMonthsCount || 0;

					var startLoadingDate = new Date(startDate.getTime());
					startLoadingDate.setDate(startLoadingDate.getDate() - 1);

					var formattedStartLoadingDate = $.datepick.formatDate('yyyy-mm-dd', startLoadingDate);
					var endLoadingDate = new Date(startDate.getFullYear(), startDate.getMonth() + monthsCount, 1);
					var formattedEndLoadingDate = $.datepick.formatDate('yyyy-mm-dd', endLoadingDate);

					var roomTypeCalendarData = this.getLoadedRoomTypeCalendarData(roomTypeId, isShowPrices, isTruncatePrices, isShowPricesCurrency);
					var startLoadingDateRoomTypeData = roomTypeCalendarData[formattedStartLoadingDate];

					if (
						typeof roomTypeCalendarData[formattedStartLoadingDate] !== 'undefined' &&
						roomTypeCalendarData[formattedStartLoadingDate].hasOwnProperty('roomTypeStatus') &&
						typeof roomTypeCalendarData[formattedEndLoadingDate] !== 'undefined' &&
						roomTypeCalendarData[formattedEndLoadingDate].hasOwnProperty('roomTypeStatus')
					) {
						return roomTypeCalendarData;
					}

					while (
						startLoadingDate.getTime() < endLoadingDate.getTime() &&
						typeof startLoadingDateRoomTypeData !== 'undefined' &&
						startLoadingDateRoomTypeData.hasOwnProperty('roomTypeStatus')
					) {
						startLoadingDate = $.datepick.add(startLoadingDate, 1, 'd');
						formattedStartLoadingDate = $.datepick.formatDate('yyyy-mm-dd', startLoadingDate);
						startLoadingDateRoomTypeData = roomTypeCalendarData[formattedStartLoadingDate];
					}

					if (startLoadingDate.getTime() >= endLoadingDate.getTime()) {
						return roomTypeCalendarData;
					}

					if (minLoadingMonthsCount > 0) {
						var minEndLoadingDate = new Date(startLoadingDate.getFullYear(), startLoadingDate.getMonth() + minLoadingMonthsCount + 1, 1);
						if (endLoadingDate.getTime() < minEndLoadingDate.getTime()) {
							endLoadingDate = minEndLoadingDate;
							formattedEndLoadingDate = $.datepick.formatDate('yyyy-mm-dd', endLoadingDate);
						}
					}

					runBeforeDataLoading();

					var ajaxRequestKey = JSON.stringify([
						roomTypeId,
						isShowPrices,
						isTruncatePrices,
						isShowPricesCurrency,
						formattedStartLoadingDate,
						formattedEndLoadingDate
					]);

					if (!this._activeAjaxRequests[ajaxRequestKey]) {
						var startedAt = (window.performance && typeof window.performance.now === 'function') ? window.performance.now() : 0;
						var requestData = {
							action: 'mphb_get_room_type_calendar_data',
							mphb_nonce: MPHB._data.nonces['mphb_get_room_type_calendar_data'],
							mphb_is_admin: MPHB._data.isAdmin,
							mphb_locale: MPHB._data.settings.currentLanguage,
							start_date: formattedStartLoadingDate,
							end_date: formattedEndLoadingDate,
							room_type_id: roomTypeId,
							is_show_prices: isShowPrices,
							is_truncate_prices: isTruncatePrices,
							is_show_prices_currency: isShowPricesCurrency
						};

						this._activeAjaxRequests[ajaxRequestKey] = $.ajax({
							url: MPHB._data.ajaxUrl,
							type: 'GET',
							dataType: 'json',
							data: requestData,
							success: function(response) {
								if (startedAt) {
									var endedAt = window.performance.now();
									console.log(
										'DATA LOADED: ' + JSON.stringify(requestData) + ' TIME: ' + ((endedAt - startedAt) / 1000).toFixed(2) + ' sec',
										response.data
									);
								}

								if (response && response.data) {
									Object.assign(roomTypeCalendarData, response.data);
								}
							},
							error: function(response) {
								if (response && response.responseJSON && response.responseJSON.data && response.responseJSON.data.errorMessage) {
									console.error(response.responseJSON.data.errorMessage);
								} else {
									console.error(response);
								}
							},
							complete: function() {
								delete self._activeAjaxRequests[ajaxRequestKey];
							}
						});
					}

					this._activeAjaxRequests[ajaxRequestKey].always(function() {
						runAfterDataLoaded();
					});

					return this._activeAjaxRequests[ajaxRequestKey];
				};

				MPHB.ajaxApiHelper._riasPatchedLoadCalendarData = true;
				return true;
			}

			function patchCalendarHelper() {
				if (!window.MPHB || !MPHB.calendarHelper || MPHB.calendarHelper._riasPatchedMinStay) {
					return !!(window.MPHB && MPHB.calendarHelper);
				}

				var originalCalculate = MPHB.calendarHelper.calculateMinMaxCheckOutDateForSelection;
				if (typeof originalCalculate !== 'function') {
					return false;
				}

				MPHB.calendarHelper.calculateMinMaxCheckOutDateForSelection = function(checkInDate) {
					var result = originalCalculate.apply(this, arguments) || {};
					if (!checkInDate) {
						return result;
					}

					var minimumCheckOutDate = addDays(checkInDate, MIN_NIGHTS);
					if (!minimumCheckOutDate) {
						return result;
					}

					if (!result.minStayDateAfterCheckIn || result.minStayDateAfterCheckIn.getTime() < minimumCheckOutDate.getTime()) {
						result.minStayDateAfterCheckIn = cloneDate(minimumCheckOutDate);
					}

					if (!result.minCheckOutDateForSelection || result.minCheckOutDateForSelection.getTime() < minimumCheckOutDate.getTime()) {
						result.minCheckOutDateForSelection = cloneDate(minimumCheckOutDate);
					}

					return result;
				};

				MPHB.calendarHelper._riasPatchedMinStay = true;
				return true;
			}

			function patchHomeSearchForm($form) {
				if (!$form || !$form.length || !$.datepick || !$.datepick._getInst) {
					return false;
				}

				var $checkIn = $form.find('input[name="mphb_check_in_date"]');
				var $checkOut = $form.find('input[name="mphb_check_out_date"]');
				if (!$checkIn.length || !$checkOut.length) {
					return false;
				}

				var checkInInst = $.datepick._getInst($checkIn[0]);
				var checkOutInst = $.datepick._getInst($checkOut[0]);
				if (!hasDatepickInstance(checkInInst) || !hasDatepickInstance(checkOutInst)) {
					return false;
				}

				wrapInstanceCallback(checkInInst, 'onSelect', function(originalOnSelect) {
					return function(dates) {
						if (typeof originalOnSelect === 'function') {
							originalOnSelect.apply(this, arguments);
						}

						if (dates && dates.length && dates[0]) {
							syncCheckoutField($form, true);
						} else {
							syncCheckoutField($form, false);
						}

						hideDatepicker($checkIn);
					};
				});

				wrapInstanceCallback(checkInInst, 'onShow', function(originalOnShow) {
					return function(element, instance) {
						clearPopupLoading($checkIn);
						armLoadingWatchdog($checkIn);
						if (typeof originalOnShow === 'function') {
							originalOnShow.apply(this, arguments);
						}
					};
				});

				wrapInstanceCallback(checkOutInst, 'onShow', function(originalOnShow) {
					return function(element, instance) {
						clearPopupLoading($checkOut);
						armLoadingWatchdog($checkOut);
						if (typeof originalOnShow === 'function') {
							originalOnShow.apply(this, arguments);
						}
					};
				});

				wrapInstanceCallback(checkOutInst, 'onSelect', function(originalOnSelect) {
					return function(dates) {
						if (typeof originalOnSelect === 'function') {
							originalOnSelect.apply(this, arguments);
						}

						hideDatepicker($checkOut);
					};
				});

				if (!$form.data('riasDatepickEventsBound')) {
					$form.data('riasDatepickEventsBound', true);
					$checkIn.on('mousedown.riasDatepick', function() {
						resetStaleDatepickerState($checkIn);
					});
					$checkIn.on('focus.riasDatepick', function() {
						clearPopupLoading($checkIn);
						armLoadingWatchdog($checkIn);
					});
					$checkOut.on('mousedown.riasDatepick', function() {
						resetStaleDatepickerState($checkOut);
					});
					$checkOut.on('focus.riasDatepick', function() {
						clearPopupLoading($checkOut);
						armLoadingWatchdog($checkOut);
					});
					$form.on('click.riasDatepick', '.datepick-month td a', function() {
						var $dateField = $(this).closest('.mphb_sc_search-check-in-date, .mphb_sc_search-check-out-date, .mphb-check-in-date-wrapper, .mphb-check-out-date-wrapper, .mphb-check-in-date, .mphb-check-out-date');
						if (!$dateField.length) {
							return;
						}

						var $input = $dateField.find('input.mphb-datepick').first();
						if ($input.length) {
							window.setTimeout(function() {
								hideDatepicker($input);
							}, 0);
						}
					});
				}

				syncCheckoutField($form, false);
				return true;
			}

			function bootPatches() {
				patchCalendarHelper();
				patchAjaxHelper();

				var patchedAtLeastOneForm = false;
				getHomeSearchForms().each(function() {
					patchedAtLeastOneForm = patchHomeSearchForm($(this)) || patchedAtLeastOneForm;
				});

				return patchedAtLeastOneForm;
			}

			var attempts = 0;
			var timer = window.setInterval(function() {
				var formsPatched = bootPatches();
				attempts += 1;

				if (formsPatched || attempts > 120) {
					window.clearInterval(timer);
				}
			}, 100);

			$(function() {
				bootPatches();
				window.setTimeout(bootPatches, 50);
				window.setTimeout(bootPatches, 250);
			});
		})(jQuery);
JS;

	wp_add_inline_script('mphb', $inline_js, 'after');
}

add_action('wp_footer', 'change_mphb_room_title_js');
function change_mphb_room_title_js()
{

	if (function_exists('pll_current_language') && pll_current_language() === 'el'):
		?>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
				document.querySelector(".mphb-room-number") function (el) {
					if (el.textContent.includes("Accommodation")) {
						el.textContent = el.textContent.replace("Accommodation", "Διαμονή");
					}

				});
																																																																																																							});
		</script>
		<?php
	endif;
}


add_action('init', function () {
	if (function_exists('pll_register_string')) {
		// Register strings with a specific group for easier discovery
		pll_register_string('site_title', get_option('blogname'), 'Website Details');
		pll_register_string('site_tagline', get_option('blogdescription'), 'Website Details');

		// Register night/nights for price breakdown translation
		pll_register_string('night_singular', 'night', 'Price Breakdown');
		pll_register_string('night_plural', 'nights', 'Price Breakdown');

		// Register checkout validation error messages
		pll_register_string('checkout_fill_required', 'Please fill in all required fields above before selecting a payment method.', 'Checkout Validation');
		pll_register_string('checkout_secure_payment', 'Secure Payment', 'Checkout Validation');
	}
});

/**
 * Filter: Translate core MotoPress error messages to Greek if missing.
 */
add_filter('gettext', function ($translated_text, $text, $domain) {
	if ($domain === 'motopress-hotel-booking' && $text === 'Email is required.') {
		if (function_exists('pll_current_language') && pll_current_language() === 'el') {
			return 'Το email είναι υποχρεωτικό.';
		}
	}
	return $translated_text;
}, 10, 3);

// Translate Site Title and Tagline using Polylang
add_filter('option_blogname', 'pll_translate_site_info');
add_filter('option_blogdescription', 'pll_translate_site_info');

function pll_translate_site_info($value)
{
	if (function_exists('pll__')) {
		return pll__($value);
	}
	return $value;
}


/**
 * Custom Price Breakdown with Grouped Nightly Rates
 * Shows e.g. "3 nights × €220 = €660" before the detailed breakdown
 * Replaces CheckoutView::renderPriceBreakdown in the checkout layout
 */
function rias_render_grouped_price_breakdown($booking)
{
	// Get breakdown data within the correct pricing context
	MPHB()->reservationRequest()->setupParameter('pricing_strategy', 'base-price');
	$priceBreakdown = $booking->getPriceBreakdown();
	$breakdownHtml = \MPHB\Views\BookingView::generatePriceBreakdownArray($priceBreakdown);
	MPHB()->reservationRequest()->resetDefaults(array('pricing_strategy'));

	// Build grouped nightly rate summary HTML
	$groupedHtml = '';
	if (!empty($priceBreakdown['rooms'])) {
		foreach ($priceBreakdown['rooms'] as $key => $roomBreakdown) {
			if (isset($roomBreakdown['room']['list']) && count($roomBreakdown['room']['list']) > 0) {
				$groups = rias_group_prices_by_rate($roomBreakdown['room']['list']);
				if (!empty($groups)) {
					$groupedHtml .= '<div class="rias-nightly-rate-summary">';
					$groupedHtml .= '<table class="rias-nightly-rate-table">';
					foreach ($groups as $group) {
						$nightLabel = $group['count'] === 1
							? (function_exists('pll__') ? pll__('night') : __('night', 'rias-apartment'))
							: (function_exists('pll__') ? pll__('nights') : __('nights', 'rias-apartment'));
						$groupedHtml .= '<tr>';
						$groupedHtml .= '<td class="rias-nightly-rate-label">';
						$groupedHtml .= esc_html($group['count'] . ' ' . $nightLabel) . ' &times; ' . mphb_format_price($group['price']);
						$groupedHtml .= '</td>';
						$groupedHtml .= '<td class="rias-nightly-rate-total">';
						$groupedHtml .= mphb_format_price($group['total']);
						$groupedHtml .= '</td>';
						$groupedHtml .= '</tr>';
					}
					$groupedHtml .= '</table>';
					$groupedHtml .= '</div>';
				}
			}
		}
	}
	?>
	<section id="mphb-price-details" class="mphb-room-price-breakdown-wrapper mphb-checkout-section">
		<h4 class="mphb-price-breakdown-title">
			<?php esc_html_e('Price Breakdown', 'motopress-hotel-booking'); ?>
		</h4>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $groupedHtml;
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $breakdownHtml;
		?>
	</section>
	<?php
}

/**
 * Retrieve a private property value from a SeasonPrice instance.
 *
 * @param object $seasonPrice
 * @param string $property
 * @return mixed|null
 */
function rias_get_season_price_private_property( $seasonPrice, $property ) {
	try {
		$reflection = new ReflectionClass( $seasonPrice );
		if ( $reflection->hasProperty( $property ) ) {
			$prop = $reflection->getProperty( $property );
			$prop->setAccessible( true );
			return $prop->getValue( $seasonPrice );
		}
	} catch ( ReflectionException $e ) {
		return null;
	}
	return null;
}

/**
 * Call protected SeasonPrice::getPriceForPeriod and return the resolved price.
 *
 * @param object $seasonPrice
 * @param array $prices
 * @param int $nightsCount
 * @return float
 */
function rias_get_season_price_for_period( $seasonPrice, $prices, $nightsCount ) {
	if ( ! is_array( $prices ) ) {
		return 0.0;
	}

	try {
		$reflection = new ReflectionClass( $seasonPrice );
		if ( $reflection->hasMethod( 'getPriceForPeriod' ) ) {
			$method = $reflection->getMethod( 'getPriceForPeriod' );
			$method->setAccessible( true );
			return (float) $method->invoke( $seasonPrice, $prices, $nightsCount, 0 );
		}
	} catch ( ReflectionException $e ) {
		return 0.0;
	}

	return 0.0;
}

/**
 * Calculate extra adult and extra child surcharge totals for a reserved room.
 *
 * @param object $reservedRoom
 * @param string[] $bookedDates
 * @return float[] [adultTotal, childTotal]
 */
function rias_get_extra_guest_totals_for_reserved_room( $reservedRoom, $bookedDates ) {
	$rate = $reservedRoom->getRate();
	if ( ! $rate || empty( $bookedDates ) ) {
		return array( 0.0, 0.0, 0, 0 );
	}

	$nightsCount = count( $bookedDates );
	$adultTotal = 0.0;
	$childTotal = 0.0;
	$adultCount = 0;
	$childCount = 0;

	foreach ( $rate->getSeasonPrices() as $seasonPrice ) {
		if ( ! method_exists( $seasonPrice, 'getDatePrices' ) ) {
			continue;
		}

		$seasonDates = $seasonPrice->getDatePrices();
		if ( empty( $seasonDates ) ) {
			continue;
		}

		$matchedDates = array_intersect( $bookedDates, array_keys( $seasonDates ) );
		if ( empty( $matchedDates ) ) {
			continue;
		}

		$extraAdults = max( 0, $reservedRoom->getAdults() - $seasonPrice->getBaseAdults() );
		$extraChildren = max( 0, $reservedRoom->getChildren() - $seasonPrice->getBaseChildren() );
		if ( $extraAdults === 0 && $extraChildren === 0 ) {
			continue;
		}

		$adultPricePerNight = rias_get_season_price_for_period(
			$seasonPrice,
			rias_get_season_price_private_property( $seasonPrice, 'extraAdultPrices' ),
			$nightsCount
		);
		$childPricePerNight = rias_get_season_price_for_period(
			$seasonPrice,
			rias_get_season_price_private_property( $seasonPrice, 'extraChildPrices' ),
			$nightsCount
		);

		$matchedCount = count( $matchedDates );
		$adultTotal += $extraAdults * $adultPricePerNight * $matchedCount;
		$childTotal += $extraChildren * $childPricePerNight * $matchedCount;
		$adultCount = max( $adultCount, $extraAdults );
		$childCount = max( $childCount, $extraChildren );
	}

	return array( round( $adultTotal, 2 ), round( $childTotal, 2 ), $adultCount, $childCount );
}

add_filter( 'mphb_booking_price_breakdown', 'rias_add_extra_guest_fees_to_price_breakdown', 10, 2 );

/**
 * Add extra guest surcharge display to the booking price breakdown.
 *
 * The plugin already includes the extra guest cost in room prices, so this
 * filter only adds labeled fee lines for checkout price breakdown visibility.
 *
 * @param array $priceBreakdown
 * @param object $booking
 * @return array
 */
function rias_add_extra_guest_fees_to_price_breakdown( $priceBreakdown, $booking ) {
	static $processing = false;

	if ( $processing || ! is_object( $booking ) || ! method_exists( $booking, 'getReservedRooms' ) ) {
		return $priceBreakdown;
	}

	if ( empty( $priceBreakdown['rooms'] ) || ! is_array( $priceBreakdown['rooms'] ) ) {
		return $priceBreakdown;
	}

	$processing = true;
	MPHB()->reservationRequest()->setupParameter( 'pricing_strategy', 'base-price' );
	$basePriceBreakdown = $booking->getPriceBreakdown();
	MPHB()->reservationRequest()->resetDefaults( array( 'pricing_strategy' ) );
	$processing = false;

	if ( empty( $basePriceBreakdown['rooms'] ) || ! is_array( $basePriceBreakdown['rooms'] ) ) {
		return $priceBreakdown;
	}

	$reservedRooms = $booking->getReservedRooms();

	foreach ( $priceBreakdown['rooms'] as $roomIndex => &$roomBreakdown ) {
		if ( ! isset( $basePriceBreakdown['rooms'][ $roomIndex ] ) ) {
			continue;
		}

		$baseRoomBreakdown = $basePriceBreakdown['rooms'][ $roomIndex ];
		$extraGuestCharge = round( (float) $roomBreakdown['room']['total'] - (float) $baseRoomBreakdown['room']['total'], 2 );
		if ( $extraGuestCharge <= 0 ) {
			continue;
		}

		$reservedRoom = $reservedRooms[ $roomIndex ] ?? null;
		if ( ! $reservedRoom ) {
			continue;
		}

		$bookedDates = array_keys( $roomBreakdown['room']['list'] );
		$nightsCount = count( $bookedDates );
		list( $adultTotal, $childTotal, $adultCount, $childCount ) = rias_get_extra_guest_totals_for_reserved_room( $reservedRoom, $bookedDates );

		if ( ! isset( $roomBreakdown['fees'] ) || ! is_array( $roomBreakdown['fees'] ) ) {
			$roomBreakdown['fees'] = array(
				'list'           => array(),
				'total'          => 0.0,
				'discount'       => 0.0,
				'discount_total' => 0.0,
			);
		}

		if ( $adultTotal > 0 ) {
			$roomBreakdown['fees']['list'][] = array(
				'label' => sprintf( _n( '%1$s extra adult × %2$s night surcharge', '%1$s extra adults × %2$s nights surcharge', $adultCount, 'motopress-hotel-booking' ), $adultCount, $nightsCount ),
				'price' => $adultTotal,
			);
			$roomBreakdown['fees']['total'] += $adultTotal;
			$roomBreakdown['fees']['discount_total'] += $adultTotal;
		}

		if ( $childTotal > 0 ) {
			$roomBreakdown['fees']['list'][] = array(
				'label' => sprintf( _n( '%1$s extra child × %2$s night surcharge', '%1$s extra children × %2$s nights surcharge', $childCount, 'motopress-hotel-booking' ), $childCount, $nightsCount ),
				'price' => $childTotal,
			);
			$roomBreakdown['fees']['total'] += $childTotal;
			$roomBreakdown['fees']['discount_total'] += $childTotal;
		}

		if ( $adultTotal <= 0 && $childTotal <= 0 ) {
			$roomBreakdown['fees']['list'][] = array(
				'label' => __( 'Extra guest surcharge', 'motopress-hotel-booking' ),
				'price' => $extraGuestCharge,
			);
			$roomBreakdown['fees']['total'] += $extraGuestCharge;
			$roomBreakdown['fees']['discount_total'] += $extraGuestCharge;
		}
	}

	return $priceBreakdown;
}

/**
 * Group consecutive dates that share the same nightly rate
 *
 * @param array $dateList Associative array of date => price from MPHB breakdown
 * @return array Array of groups, each with 'count', 'price', and 'total'
 */
function rias_group_prices_by_rate($dateList)
{
	$groups = [];
	$currentPrice = null;
	$currentCount = 0;

	foreach ($dateList as $date => $price) {
		if ($currentPrice !== null && abs($price - $currentPrice) < 0.01) {
			$currentCount++;
		} else {
			if ($currentPrice !== null) {
				$groups[] = [
					'count' => $currentCount,
					'price' => $currentPrice,
					'total' => $currentCount * $currentPrice,
				];
			}
			$currentPrice = $price;
			$currentCount = 1;
		}
	}

	if ($currentPrice !== null) {
		$groups[] = [
			'count' => $currentCount,
			'price' => $currentPrice,
			'total' => $currentCount * $currentPrice,
		];
	}

	return $groups;
}

/**
 * Render Payment & Trust Icons above the 'Book Now' button
 */
function rias_render_trust_icons()
{
	?>
	<div class="rias-trust-icons-wrapper">
		<div class="rias-trust-icons-list">

			<!-- Mastercard -->
			<div class="rias-trust-icon mastercard">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 28" width="45" height="28">
					<rect width="45" height="28" rx="3" fill="#222" />
					<circle cx="17.5" cy="14" r="7" fill="#EB001B" />
					<circle cx="27.5" cy="14" r="7" fill="#F79E1B" />
					<path fill="#FF5F00"
						d="M22.5 14a6.9 6.9 0 0 0 2.1-4.9c0-1.9-.8-3.6-2.1-4.9a6.9 6.9 0 0 0-2.1 4.9c0 1.9.8 3.6 2.1 4.9z" />
				</svg>
			</div>

			<!-- Maestro -->
			<div class="rias-trust-icon maestro">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 28" width="45" height="28">
					<rect width="45" height="28" rx="3" fill="#222" />

					<!-- VISA Text (changed to white for visibility) -->
					<text x="50%" y="16" text-anchor="middle" fill="#FFFFFF" font-size="9" font-family="Arial, sans-serif"
						font-weight="bold">
						VISA
					</text>

					<!-- Yellow accent stripe -->
					<rect x="28" y="18" width="10" height="2" fill="#F7B600" />
				</svg>
			</div>

			<!-- Google Pay -->
			<!-- Google Pay -->
			<!-- Google Pay -->
			<div class="rias-trust-icon gpay">
				<img src="https://img.icons8.com/color/48/google-pay.png" alt="Google Pay">
			</div>

			<!-- Apple Pay -->
			<div class="rias-trust-icon applepay">
				<img src="https://img.icons8.com/color/48/apple-pay.png" alt="Apple Pay">
			</div>

			<!-- PayPal -->
			<div class="rias-trust-icon paypal">
				<img src="https://img.icons8.com/color/48/paypal.png" alt="PayPal">
			</div>

			<!-- Stripe -->
			<div class="rias-trust-icon stripe">
				<img src="https://img.icons8.com/color/48/stripe.png" alt="Stripe">
			</div>

		</div>
	</div>
	<?php
}

/**
 * Render Check-in Method & House Rules Block
 */
function rias_render_checkin_info()
{
	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
	?>
	<div class="rias-checkin-info-block">
		<div class="rias-checkin-method">
			<p class="checkin-method-title">
				<?php echo ($lang === 'el') ? 'Μέθοδος Άφιξη' : 'Check in method'; ?>
			</p>
			<p class="checkin-method-value">
				<?php echo ($lang === 'el') ? 'Συνάντηση & Υποδοχή | Αυτόματο check-in (Κάρτα-κλειδί/Κωδικός)' : 'Meet & Greet | Self Check-in (Key-card/Code)'; ?>
			</p>
		</div>
		<div class="rias-house-rules">
			<div class="rias-house-rule-item">
				<?php echo ($lang === 'el') ? 'Απαγορεύεται το κάπνισμα' : 'No smoking'; ?>
			</div>
			<div class="rias-house-rule-item">
				<?php echo ($lang === 'el') ? 'Δεν επιτρέπονται κατοικίδια' : 'No pets'; ?>
			</div>
			<div class="rias-house-rule-item">
				<?php echo ($lang === 'el') ? 'Απαγορεύονται οι κοινωνικές συγκεντρώσεις' : 'No social gathering'; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Render Cancellation Policy Block
 */
function rias_render_cancellation_policy()
{
	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
	?>
	<div class="rias-cancellation-policy-block">
		<h4 class="policy-title">
			<i class="fa-solid fa-shield-halved"></i>
			<?php echo ($lang === 'el') ? 'Πολιτική Ακύρωσης: Μέτρια' : 'Cancellation Policy: Moderate'; ?>
		</h4>
		<div class="policy-tiers">
			<div class="policy-tier tier-100">
				<span class="tier-icon"><i class="fa-solid fa-circle-check"></i></span>
				<span class="tier-text">
					<strong><?php echo ($lang === 'el') ? '100% Επιστροφή:' : '100% Refund:'; ?></strong>
					<?php echo ($lang === 'el') ? 'Ακύρωση έως 1 μήνα πριν την άφιξη.' : 'Cancel up to 1 month prior to arrival.'; ?>
				</span>
			</div>
			<div class="policy-tier tier-50">
				<span class="tier-icon"><i class="fa-solid fa-circle-info"></i></span>
				<span class="tier-text">
					<strong><?php echo ($lang === 'el') ? '50% Επιστροφή:' : '50% Refund:'; ?></strong>
					<?php echo ($lang === 'el') ? 'Ακύρωση έως 2 εβδομάδες πριν την άφιξη.' : 'Cancel up to 2 weeks prior to arrival.'; ?>
				</span>
			</div>
			<div class="policy-tier tier-none">
				<span class="tier-icon"><i class="fa-solid fa-circle-xmark"></i></span>
				<span class="tier-text">
					<strong><?php echo ($lang === 'el') ? 'Καμία Επιστροφή:' : 'No Refund:'; ?></strong>
					<?php echo ($lang === 'el') ? 'Ακυρώσεις λιγότερο από 14 ημέρες πριν το check-in.' : 'Cancellations less than 14 days prior to check-in.'; ?>
				</span>
			</div>
		</div>
		<p class="policy-note">
			<?php echo ($lang === 'el')
				? '* Όλες οι ακυρώσεις πρέπει να γίνονται μέχρι τις 12:00 (μεσημέρι) τοπική ώρα.'
				: '* All cancellations must take place by 12:00 (midday) local time.'; ?>
		</p>
	</div>
	<?php
}

/**
 * Render Custom T&C Checkbox and Modal
 */
function rias_render_custom_checkout_terms()
{
	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

	$checkbox_label = ($lang === 'el')
		? 'Αποδέχομαι τους <a href="#" data-bs-toggle="modal" data-bs-target="#riasTermsModal">όρους και προϋποθέσεις</a>'
		: 'I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#riasTermsModal">terms & conditions</a>';
	?>
	<div class="rias-checkout-terms-wrapper">
		<div class="form-check">
			<input class="form-check-input" type="checkbox" id="rias_accept_terms" required>
			<label class="form-check-label" for="rias_accept_terms">
				<?php echo $checkbox_label; ?>
			</label>
		</div>
	</div>
	<?php
}

/**
 * Render Terms Modal in Footer
 */
add_action('wp_footer', 'rias_render_terms_modal_footer');
function rias_render_terms_modal_footer()
{
	if (!is_page())
		return;

	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

	$terms_text_en = 'The guest will be refunded the full amount of the booking fees if (s)he cancels the booking up to 1 month prior to his/her arrival day (check-in) to the Host\'s accommodation. The guest will be refunded 50% of the booking fees, if (s)he cancels the booking up to 2 weeks prior to his/her arrival (check-in) to the Host\'s accommodation. All cancellations must take place by 12:00 (midday) according to the Central European Time (CET), on the appropriate day.';

	$terms_text_el = 'Ο επισκέπτης θα λάβει πλήρη επιστροφή των τελών κράτησης εάν ακυρώσει την κράτηση έως και 1 μήνα πριν από την ημέρα άφιξής του (check-in) στο κατάλυμα του Οικοδεσπότη. Ο επισκέπτης θα λάβει επιστροφή 50% των τελών κράτησης εάν ακυρώσει την κράτηση έως και 2 εβδομάδες πριν από την ημέρα άφιξής του (check-in) στο κατάλυμα του Οικοδεσπότη. Όλες οι ακυρώσεις πρέπει να γίνονται έως τις 12:00 (μεσημέρι) σύμφωνα με την ώρα Κεντρικής Ευρώπης (CET), την κατάλληλη ημέρα.';

	$terms_text = ($lang === 'el') ? $terms_text_el : $terms_text_en;
	$modal_title = ($lang === 'el') ? 'Όροι & προϋποθέσεις' : 'Terms & conditions';
	$close_btn = ($lang === 'el') ? 'Κλείσιμο' : 'Close';
	?>
	<!-- Terms Modal -->
	<div class="modal fade" id="riasTermsModal" tabindex="-1" aria-labelledby="riasTermsModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="riasTermsModalLabel"><?php echo $modal_title; ?></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php echo nl2br(esc_html($terms_text)); ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-modal-close"
						data-bs-dismiss="modal"><?php echo $close_btn; ?></button>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Fix: Stripe card fields not reappearing after switching payment gateways.
 *
 * Patches the MPHB BillingSection and StripeGateway instances to:
 * 1. Call cancelSelection() BEFORE .empty() destroys the DOM
 * 2. Always create fresh Stripe Elements on gateway re-selection
 * 3. Make cancelSelection() safe when DOM is already gone
 */
add_action('wp_footer', 'rias_fix_stripe_gateway_remount', 100);
function rias_fix_stripe_gateway_remount()
{
	// Pass translated validation messages to JS
	$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

	$rias_validation_msgs = array(
		'fillRequired' => 'Please fill in all required fields above before selecting a payment method.',

	);

	// Provide Greek defaults if current language is Greek
	if ($current_lang === 'el') {
		$rias_validation_msgs = array(
			'fillRequired' => 'Παρακαλούμε συμπληρώστε όλα τα απαιτούμενα πεδία παραπάνω πριν επιλέξετε μια μέθοδο πληρωμής.',

		);
	}

	// Still allow override via Polylang admin ifpll__ is available
	foreach ($rias_validation_msgs as $key => $msg) {
		if (function_exists('pll__')) {
			$translated = pll__($msg);
			if ($translated && $translated !== $msg) {
				$rias_validation_msgs[$key] = $translated;
			}
		}
	}
	?>
	<script type="text/javascript">
		var riasCheckoutStrings = <?php echo json_encode($rias_validation_msgs); ?>;
		(function ($) {

			// Helper: show inline validation error inside the billing section
			function showBillingValidationError($section, message) {
				$section.find('.rias-billing-validation-error').remove();
				$section.find('.rias-gateway-spinner').remove();
				var $error = $('<div class="rias-billing-validation-error"></div>').text(message);
				$section.append($error);
			}

			// Helper: check if any required fields are missing
			function hasRequiredFieldErrors() {
				// Check adults select(s)
				var $adults = $('select[name*="[adults]"]');
				if ($adults.length && !$adults.val()) return true;

				// Check children select(s)
				var $children = $('select[name*="[children]"]');
				if ($children.length && $children.attr('required') && !$children.val() && $children.val() !== '0') return true;

				// Check first name
				var $fn = $('#mphb_first_name');
				if ($fn.length && $fn.attr('required') && !$.trim($fn.val())) return true;

				// Check last name
				var $ln = $('#mphb_last_name');
				if ($ln.length && $ln.attr('required') && !$.trim($ln.val())) return true;

				// Check email
				var $em = $('#mphb_email');
				if ($em.length && $em.attr('required')) {
					var emailVal = $.trim($em.val());
					if (!emailVal) return true;
					var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					if (!emailReg.test(emailVal.toLowerCase())) return true;
				}

				// Check phone
				var $ph = $('#mphb_phone');
				if ($ph.length && $ph.attr('required') && !$.trim($ph.val())) return true;

				return false;
			}

			var waitForInit = setInterval(function () {

				if (typeof MPHB === 'undefined') return;
				if (!MPHB.CheckoutForm || !MPHB.CheckoutForm.myThis) return;

				var form = MPHB.CheckoutForm.myThis;
				if (!form.billingSection) return;

				var billing = form.billingSection;
				var stripeGw = billing.gateways['stripe'];
				if (!stripeGw) return;

				clearInterval(waitForInit);

				// Patch unsetFreeMode to force gateway remount on checkout info update (e.g. guests change)
				var origUnsetFreeMode = form.unsetFreeMode.bind(form);
				form.unsetFreeMode = function () {
					origUnsetFreeMode();
					if (this.billingSection) {
						this.billingSection.notifySelectedGateway();
					}
				};

				// Override updateBillingInfo: call cancelSelection BEFORE .empty()
				// and show a visible loading spinner during the AJAX call
				// + client-side validation to prevent infinite skeleton loader
				billing.updateBillingInfo = function (el, e) {
					var gatewayId = el.val();
					var $billingSection = $('#mphb-billing-details');

					// --- Client-side validation ---
					if (hasRequiredFieldErrors()) {
						// Remove any existing skeleton/spinner and previous errors
						$billingSection.find('.rias-gateway-spinner').remove();
						$billingSection.find('.rias-billing-validation-error').remove();

						// Cleanup previous gateway UI (e.g. remove Stripe card fields)
						if (this.lastGatewayId && this.gateways[this.lastGatewayId]) {
							try { this.gateways[this.lastGatewayId].cancelSelection(); } catch (err) { }
						}
						this.billingFieldsWrapperEl.empty().addClass('mphb-billing-fields-hidden');

						// Show single consolidated error message
						var s = window.riasCheckoutStrings || {};
						var errorHtml = '<div class="rias-billing-validation-error">';
						errorHtml += '<p style="margin:0;font-weight:600;">' + (s.fillRequired || 'Please fill in all required fields above before selecting a payment method.') + '</p>';
						errorHtml += '</div>';
						$billingSection.append(errorHtml);

						// Store the gatewayId so it re-triggers when fields change
						this.lastGatewayId = gatewayId;
						return; // Do NOT show skeleton or fire AJAX
					}

					// --- Valid: proceed normally ---
					$billingSection.find('.rias-billing-validation-error').remove();

					if (this.lastGatewayId && this.gateways[this.lastGatewayId]) {
						try { this.gateways[this.lastGatewayId].cancelSelection(); } catch (err) { }
					}

					var self = this;
					this.billingFieldsWrapperEl.empty().addClass('mphb-billing-fields-hidden');

					// Show a skeleton loader in the billing section only for MotoPress Stripe
					$billingSection.find('.rias-gateway-spinner').remove();
					if (gatewayId === 'stripe') {
						var $skeleton = $('<div class="rias-gateway-spinner rias-stripe-skeleton-loader"><div class="rias-skeleton-label"></div><div class="rias-skeleton-input"></div></div>');
						$skeleton.data('ts', Date.now());
						$billingSection.append($skeleton);
					}

					clearTimeout(this.updateBillingFieldsTimeout);
					this.updateBillingFieldsTimeout = setTimeout(function () {
						var formData = self.getBookingDetails();
						$.ajax({
							url: MPHB._data.ajaxUrl,
							type: 'GET',
							dataType: 'json',
							data: {
								action: 'mphb_get_billing_fields',
								mphb_nonce: MPHB._data.nonces.mphb_get_billing_fields,
								mphb_gateway_id: gatewayId,
								formValues: formData,
								lang: MPHB._data.settings.currentLanguage
							},
							success: function (response) {
								if (response.hasOwnProperty('success') && response.success) {
									self.billingFieldsWrapperEl.html(response.data.fields);

									// For non-Stripe: remove spinner now that fields are injected
									if (gatewayId !== 'stripe') {
										$billingSection.find('.rias-gateway-spinner').remove();
									}

									if (response.data.hasVisibleFields) {
										// Delay unhiding for Stripe until 'ready' event
										if (gatewayId !== 'stripe') {
											self.billingFieldsWrapperEl.removeClass('mphb-billing-fields-hidden');
										}
									} else {
										self.billingFieldsWrapperEl.addClass('mphb-billing-fields-hidden');
									}
									self.notifySelectedGateway(gatewayId);
									self.lastGatewayId = gatewayId; // Track the successful selection for clean unmounting
								} else {
									// Show error inline in billing section instead of at form top
									var errMsg = (response.data && response.data.message) ? response.data.message : MPHB._data.translations.errorHasOccured;
									showBillingValidationError($billingSection, errMsg);
									self.billingFieldsWrapperEl.removeClass('mphb-billing-fields-hidden');
								}
							},
							error: function () {
								showBillingValidationError($billingSection, MPHB._data.translations.errorHasOccured);
								self.billingFieldsWrapperEl.removeClass('mphb-billing-fields-hidden');
							},
							complete: function () {
								self.hidePreloader();
							}
						});
					}, 200);
				};

				// Safety: remove any stuck spinner after 6 seconds and unhide fields
				setInterval(function () {
					var $stuck = $('#mphb-billing-details .rias-gateway-spinner');
					if ($stuck.length && $stuck.data('ts') && (Date.now() - $stuck.data('ts') > 6000)) {
						$stuck.remove();
						$('.mphb-billing-fields').removeClass('mphb-billing-fields-hidden');
					}
				}, 1000);

				// Safe cancelSelection: handle DOM-already-gone gracefully
				stripeGw.cancelSelection = function () {
					try {
						if (this.cardControl) { try { this.cardControl.unmount(); } catch (e) { } }
						if (this.sepaDebitControl && this.payments && this.payments.isEnabled('sepa_debit')) {
							try { this.sepaDebitControl.unmount(); } catch (e) { }
						}
						if (this.payments) { try { this.payments.unmount(); } catch (e) { } }
					} catch (e) { }
					this.mountWrapper = null;
					this.errorsWrapper = null;
				};

				// Always create fresh Stripe Elements on selection
				stripeGw.afterSelection = function (mountWrapper) {
					try { if (this.cardControl) this.cardControl.destroy(); } catch (e) { }
					try { if (this.sepaDebitControl) this.sepaDebitControl.destroy(); } catch (e) { }

					this.cardControl = this.elements.create('card', {
						style: this.style,
						hidePostalCode: this.fullAddressRequired
					});
					this.sepaDebitControl = this.elements.create('iban', {
						style: this.style,
						supportedCountries: ['SEPA']
					});

					var self = this;
					this.cardControl.on('change', function (ev) { self.onChange(ev); });
					this.sepaDebitControl.on('change', function (ev) { self.onChange(ev); });



					try {
						MPHB.Gateway.prototype.afterSelection.call(this, mountWrapper);

						// Prevent duplicating the Stripe fields if they are already in the DOM
						if (mountWrapper.find('#mphb-stripe-payment-container').length === 0) {
							mountWrapper.append(this.mountHtml());
						}

						this.mountWrapper = mountWrapper;
						this.errorsWrapper = mountWrapper.find('#mphb-stripe-errors');

						this.cardControl.mount('#mphb-stripe-card-element');

						if (this.payments.isEnabled('sepa_debit')) {
							this.sepaDebitControl.mount('#mphb-stripe-iban-element');
						}

						this.payments.mount(mountWrapper);

						this.payments.inputs.on('change', function () {
							switch (self.payments.currentPayment) {
								case 'card': self.cardControl.clear(); break;
								case 'sepa_debit': self.sepaDebitControl.clear(); break;
							}
							self.payments.selectPayment(this.value);
						});

						// Wait for Stripe iframe to actually render before hiding skeleton
						this.cardControl.on('ready', function () {
							$('#mphb-billing-details').find('.rias-gateway-spinner').remove();
							mountWrapper.removeClass('mphb-billing-fields-hidden');
						});

					} catch (err) {
						console.error('Stripe gateway mount error:', err);
						$('#mphb-billing-details').find('.rias-gateway-spinner').remove();
						$('.mphb-billing-fields').removeClass('mphb-billing-fields-hidden');
					}
				};

			}, 200);

			// Auto-retry: when user fills in a required field after seeing a validation error,
			// clear the error and re-trigger gateway loading
			$(document).on('change input', '#mphb_first_name, #mphb_last_name, #mphb_email, #mphb_phone, select[name*="[adults]"], select[name*="[children]"]', function () {
				var $err = $('#mphb-billing-details .rias-billing-validation-error');
				if ($err.length) {
					if (!hasRequiredFieldErrors()) {
						// All fields now valid — remove error and re-trigger billing
						$err.remove();
						var $selectedGateway = $('input[name="mphb_gateway_id"]:checked');
						if ($selectedGateway.length && typeof MPHB !== 'undefined' && MPHB.CheckoutForm && MPHB.CheckoutForm.myThis) {
							var billingObj = MPHB.CheckoutForm.myThis.billingSection;
							if (billingObj) {
								billingObj.updateBillingInfo($selectedGateway);
							}
						}
					}
				}
			});

			// Block form submission if required fields are missing/invalid
			$(document).on('submit', '.mphb_sc_checkout-form', function (e) {
				if (hasRequiredFieldErrors()) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var s = window.riasCheckoutStrings || {};
					var errorMsg = s.fillRequired || 'Please fill in all required fields above before selecting a payment method.';

					if (typeof MPHB !== 'undefined' && MPHB.CheckoutForm && MPHB.CheckoutForm.myThis) {
						var form = MPHB.CheckoutForm.myThis;

						// Show error at top using MPHB native error display
						form.showError(errorMsg);

						// Scroll to errors
						$('html, body').animate({
							scrollTop: form.element.offset().top - 120
						}, 500);

						// Also show inline error if not already visible
						var $billingSection = $('#mphb-billing-details');
						if ($billingSection.length && !$billingSection.find('.rias-billing-validation-error').length) {
							var inlineErrorHtml = '<div class="rias-billing-validation-error">';
							inlineErrorHtml += '<p style="margin:0;font-weight:600;">' + errorMsg + '</p>';
							inlineErrorHtml += '</div>';
							$billingSection.find('.rias-gateway-spinner').remove();
							$billingSection.append(inlineErrorHtml);
						}
					}
					return false;
				}
			});

		})(jQuery);
	</script>
	<?php
}

/**
 * ============================================================
 * Payment Loading Indicators
 * 1. MotoPress: spinner while switching payment gateways
 * 2. MotoPress: loader overlay on "Book Now" button click
 * 3. WooCommerce: skeleton loader for payment options on page load
 * ============================================================
 */
add_action('wp_footer', 'rias_payment_loading_indicators', 101);
function rias_payment_loading_indicators()
{
	?>
	<!-- Payment Loading CSS -->
	<style>
		/* === Shared spinner keyframes === */
		@keyframes rias-spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		@keyframes rias-pulse {

			0%,
			100% {
				opacity: 0.4;
			}

			50% {
				opacity: 1;
			}
		}

		/* -----------------------------------------------
																																						   1. MotoPress gateway-switch inline spinner
																																						   ----------------------------------------------- */
		.rias-gateway-spinner {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 12px;
			padding: 24px 16px;
			margin-top: 10px;
		}

		.rias-gateway-spinner-icon {
			width: 28px;
			height: 28px;
			border: 3px solid #e0e0e0;
			border-top-color: #b08d57;
			border-radius: 50%;
			animation: rias-spin 0.7s linear infinite;
			flex-shrink: 0;
		}

		.rias-stripe-skeleton-loader {
			display: block;
			padding: 0;
			margin-top: 15px;
			animation: rias-fadeIn 0.3s ease-in-out;
		}

		.rias-skeleton-label {
			height: 14px;
			width: 140px;
			background-color: #f0f0f0;
			border-radius: 4px;
			margin-bottom: 12px;
			animation: rias-pulse 1.5s ease-in-out infinite;
		}

		.rias-skeleton-input {
			height: 48px;
			width: 100%;
			background-color: #fafafa;
			border: 1px solid #e0e0e0;
			border-radius: 4px;
			animation: rias-pulse 1.5s ease-in-out infinite;
		}

		.rias-gateway-spinner span {
			color: #888;
			font-size: 14px;
		}

		/* Inline validation error inside billing/payment section */
		.rias-billing-validation-error {
			padding: 16px 20px;
			margin-top: 12px;
			background: #fff8f0;
			border: 1px solid #e8a838;
			border-left: 4px solid #e8a838;
			border-radius: 4px;
			color: #8a6d3b;
			font-size: 14px;
			line-height: 1.5;
			animation: rias-fadeIn 0.3s ease-out;
		}

		.rias-billing-validation-error ul {
			list-style: disc;
			margin: 0;
			padding-left: 18px;
		}

		.rias-billing-validation-error li {
			margin-bottom: 2px;
		}

		/* Smooth fade-in for billing fields when they load */
		fieldset.mphb-billing-fields {
			animation: rias-fadeIn 0.4s ease-out;
		}

		@keyframes rias-fadeIn {
			0% {
				opacity: 0;
				transform: translateY(6px);
			}

			100% {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* -----------------------------------------------
																																									   2. MotoPress "Book Now" button loading state
																																									   ----------------------------------------------- */
		.mphb_sc_checkout-submit-wrapper.rias-btn-loading {
			position: relative;
			pointer-events: none;
		}

		.mphb_sc_checkout-submit-wrapper.rias-btn-loading .button,
		.mphb_sc_checkout-submit-wrapper.rias-btn-loading input[type="submit"] {
			opacity: 0.6;
			cursor: wait;
		}

		.mphb_sc_checkout-submit-wrapper.rias-btn-loading::after {
			content: '';
			position: absolute;
			top: 50%;
			right: 24px;
			width: 20px;
			height: 20px;
			margin-top: -10px;
			border: 3px solid rgba(255, 255, 255, 0.4);
			border-top-color: #fff;
			border-radius: 50%;
			animation: rias-spin 0.7s linear infinite;
			z-index: 11;
		}

		/* -----------------------------------------------
																																									   3. WooCommerce payment options skeleton loader
																																									   ----------------------------------------------- */
		.rias-wc-payment-skeleton {
			padding: 20px;
			border: 1px solid #e5e5e5;
			border-radius: 8px;
			background: #fafafa;
		}

		.rias-wc-payment-skeleton .rias-skeleton-row {
			display: flex;
			align-items: center;
			padding: 14px 0;
			border-bottom: 1px solid #eee;
		}

		.rias-wc-payment-skeleton .rias-skeleton-row:last-child {
			border-bottom: none;
		}

		.rias-skeleton-circle {
			width: 18px;
			height: 18px;
			border-radius: 50%;
			background: #ddd;
			margin-right: 12px;
			flex-shrink: 0;
			animation: rias-pulse 1.4s ease-in-out infinite;
		}

		.rias-skeleton-bar {
			height: 14px;
			border-radius: 4px;
			background: #ddd;
			animation: rias-pulse 1.4s ease-in-out infinite;
		}

		.rias-skeleton-bar.w60 {
			width: 60%;
		}

		.rias-skeleton-bar.w45 {
			width: 45%;
		}

		.rias-skeleton-bar.w50 {
			width: 50%;
		}
	</style>

	<!-- Payment Loading JS -->
	<script type="text/javascript">
		(function ($) {
			'use strict';

			/* =============================================
			   1. MotoPress gateway-switch spinner
			   — Now handled inside updateBillingInfo override
				 in rias_fix_stripe_gateway_remount (above)
			   ============================================= */

			/* =============================================
			   2. MotoPress: loader on "Book Now" click
			   ============================================= */
			$(document).on('click', '.mphb_sc_checkout-submit-wrapper input[type="submit"], .mphb_sc_checkout-submit-wrapper .button', function (e) {
				var $wrapper = $(this).closest('.mphb_sc_checkout-submit-wrapper');

				// Only add loader if the form will actually submit (basic validation)
				var $form = $(this).closest('form');
				if ($form.length && $form[0].checkValidity && !$form[0].checkValidity()) {
					return; // Don't show loader if form is invalid
				}

				$wrapper.addClass('rias-btn-loading');
			});

			// Remove loader if MPHB shows an error (submission failed)
			var submitObserver = new MutationObserver(function () {
				if ($('.mphb-errors-wrapper:visible').length || $('.mphb-alert.mphb-alert-error:visible').length) {
					$('.mphb_sc_checkout-submit-wrapper').removeClass('rias-btn-loading');
				}
			});
			$(function () {
				var checkoutForm = document.querySelector('.mphb_sc_checkout-wrapper') || document.querySelector('.mphb-booking-form');
				if (checkoutForm) {
					submitObserver.observe(checkoutForm, { childList: true, subtree: true, attributes: true });
				}
			});

			/* =============================================
			   3. WooCommerce: skeleton loader for payment options
			   ============================================= */
			var skeletonHtml = '<div class="rias-wc-payment-skeleton" id="rias-wc-skeleton">' +
				'<div class="rias-skeleton-row"><div class="rias-skeleton-circle"></div><div class="rias-skeleton-bar w60"></div></div>' +
				'<div class="rias-skeleton-row"><div class="rias-skeleton-circle"></div><div class="rias-skeleton-bar w45"></div></div>' +
				'<div class="rias-skeleton-row"><div class="rias-skeleton-circle"></div><div class="rias-skeleton-bar w50"></div></div>' +
				'</div>';

			function removeSkeleton() {
				$('#rias-wc-skeleton').fadeOut(300, function () { $(this).remove(); });
			}

			function tryShowWcSkeleton() {
				// Don't add duplicate
				if ($('#rias-wc-skeleton').length) return;

				var $wcPayment = $('#payment');
				if (!$wcPayment.length) {
					$wcPayment = $('.woocommerce-checkout-payment');
				}
				if (!$wcPayment.length) return;

				var $methods = $wcPayment.find('ul.wc_payment_methods, ul.payment_methods');
				var hasVisibleMethods = $methods.length > 0 && $methods.find('li:visible').length > 0;

				// Show skeleton if payment methods aren't visible yet
				if (!hasVisibleMethods) {
					$wcPayment.prepend(skeletonHtml);

					// Watch for real payment methods to appear
					var wcObserver = new MutationObserver(function () {
						var $m = $wcPayment.find('ul.wc_payment_methods li:visible, ul.payment_methods li:visible');
						if ($m.length > 0) {
							removeSkeleton();
							wcObserver.disconnect();
						}
					});
					wcObserver.observe($wcPayment[0], { childList: true, subtree: true, attributes: true, attributeFilter: ['style', 'class'] });

					// Fallback: remove after 10 seconds
					setTimeout(removeSkeleton, 10000);
				}
			}

			// Run on DOM ready
			$(function () {
				tryShowWcSkeleton();
			});

			// Also handle WooCommerce AJAX fragment refresh
			$(document.body).on('updated_checkout', removeSkeleton);

			// Handle WooCommerce blockUI overlay (payment area loading after AJAX)
			$(document.body).on('update_checkout', function () {
				tryShowWcSkeleton();
			});

		})(jQuery);
	</script>
	<?php
}

// =========================woocommerce buttons

// Change Place Order button text

/**
 * Fix: Redirect to translated WooCommerce checkout page for MotoPress WooCommerce Integration.
 * When a user is in Greek, ensure WooCommerce checkout URL uses the Greek page (ID 2275).
 */
add_filter('woocommerce_get_checkout_url', 'rias_localize_wc_checkout_url', 99);
function rias_localize_wc_checkout_url($url)
{
	if (function_exists('pll_current_language') && pll_current_language() === 'el') {
		// Greek checkout page ID is 2275
		$translated_url = get_permalink(2275);
		if ($translated_url) {
			return $translated_url;
		}
	}
	return $url;
}

/**
 * Restructure Payment Request Page into Two Columns
 */
add_action('wp_footer', 'rias_payment_request_two_column_layout', 99);
function rias_payment_request_two_column_layout()
{
	if (!is_page())
		return;
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			var $prForm = $('.mphb_sc_payment_request_checkout-form');
			if ($prForm.length) {
				// Inject the top banner image
				if (!$prForm.find('.rias-checkout-details-image').length) {
					var bannerImageHTML = <?php echo json_encode(rias_get_checkout_image_html()); ?>;
					if (bannerImageHTML) {
						$(bannerImageHTML).prependTo($prForm);
					}
				}

				// Inject trust icons above submit button
				if (!$prForm.find('.rias-trust-icons-wrapper').length) {
					var trustIconsHTML = <?php echo json_encode(rias_get_trust_icons_html()); ?>;
					if (trustIconsHTML) {
						$(trustIconsHTML).insertBefore($prForm.find('.mphb_sc_payment_request_checkout-submit-wrapper'));
					}
				}

				// Apply checkout layout wrapper
				if (!$prForm.find('.rias-mphb-checkout-container').length) {
					var $left = $('<div class="rias-mphb-checkout-left"></div>');
					var $right = $('<div class="rias-mphb-checkout-right"></div>');
					var $container = $('<div class="rias-mphb-checkout-container"></div>');

					// Wrap check-in/check-out dates on the payment request page
					var $prCheckIn = $prForm.find('.mphb-check-in-date');
					var $prCheckOut = $prForm.find('.mphb-check-out-date');
					if ($prCheckIn.length && $prCheckOut.length && !$prCheckIn.closest('.rias-checkin-checkout-wrapper').length) {
						$prCheckIn.add($prCheckOut).wrapAll('<div class="rias-checkin-checkout-wrapper"></div>');
					}

					// Move elements into left column
					$left.append($prForm.find('.rias-checkout-details-image, #mphb-booking-details'));

					// Move elements into right column
					$right.append($prForm.find('#mphb-payment-history, #mphb-price-details, #mphb-billing-details, .mphb-total-price, .mphb-errors-wrapper, .rias-trust-icons-wrapper, .mphb_sc_payment_request_checkout-submit-wrapper'));

					$container.append($left).append($right);

					// Prepend the new container just after the hidden inputs to keep form functional
					$prForm.append($container);
				}
			}
		});
	</script>
	<?php
}

function rias_get_checkout_image_html()
{
	if (function_exists('rias_render_checkout_image')) {
		ob_start();
		rias_render_checkout_image();
		return ob_get_clean();
	}
	return '';
}

function rias_get_trust_icons_html()
{
	if (function_exists('rias_render_trust_icons')) {
		ob_start();
		rias_render_trust_icons();
		return ob_get_clean();
	}
	return '';
}

/**
 * Add an information tooltip to the Environmental Fee in the Price Breakdown
 */
add_action('wp_footer', 'rias_add_environmental_fee_tooltip', 105);
function rias_add_environmental_fee_tooltip()
{
	if (!is_page())
		return;

	$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
	$tooltip_text = ($lang === 'el') ? 'Από την 1η Ιανουαρίου 2024, όλα τα καταλύματα στην Ελλάδα υποχρεούνται να εφαρμόζουν ένα νέο περιβαλλοντικό τέλος που ορίζεται ως Τέλος Ανθεκτικότητας στην Κλιματική Κρίση. Το τέλος αυτό θεσπίστηκε με το άρθρο 30 του Ν. 5073/2023 και αντικαθιστά τον προηγούμενο Φόρο Διαμονής.' : 'As of January 1, 2024, all accommodations in Greece are required to implement a new environmental fee defined as the Climate Crisis Resilience Fee. This fee was established under Article 30 of Law 5073/2023 and replaces the previous Accommodation Tax.';
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			function addEnvTooltip() {
				// Target table cells potentially containing the fee label
				$('.mphb-price-breakdown-wrapper th, .mphb-price-breakdown-wrapper td, #mphb-price-details th, #mphb-price-details td').each(function () {
					var $cell = $(this);

					// Avoid duplicate icons
					if ($cell.has('.rias-env-tooltip').length) return;

					var text = $cell.text().toLowerCase();
					if (text.indexOf('environmental') !== -1 || text.indexOf('περιβαλλοντικό') !== -1) {
						var $icon = $('<span class="rias-env-tooltip" style="margin-left:8px; " data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr($tooltip_text); ?>"><i class="fa-solid fa-circle-info"></i></span>');
						$cell.append($icon);

						// Initialize Bootstrap tooltip if available
						if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
							new bootstrap.Tooltip($icon[0], {
								customClass: 'environmental-fee-tooltip'
							});
						} else if ($.fn.tooltip) {
							$icon.tooltip();
						}
					}
				});
			}

			// Run initially after slight delay for dynamic dom readiness
			setTimeout(addEnvTooltip, 800);

			// Observe for DOM edits (like AJAX price breakdown updates)
			var observer = new MutationObserver(function () {
				addEnvTooltip();
			});

			var target = document.querySelector('.mphb_sc_checkout-wrapper') || document.querySelector('.mphb_sc_payment_request_checkout-form') || document.body;
			if (target) {
				observer.observe(target, { childList: true, subtree: true, characterData: true });
			}
		});
		</script>
		<?php
}


/**
 * ============================================================
 * Blog Template – Dynamic posts, category filter & Show More (AJAX)
 * ------------------------------------------------------------
 * Used by template-blog.php. Renders standard WP posts as blog
 * cards (same markup as the static design) and powers the
 * category filter + Show More button via admin-ajax.
 * ============================================================
 */

if (! defined('RIAS_BLOG_POSTS_PER_PAGE')) {
	// Number of blog cards loaded per page (initial load + each "Show More").
	define('RIAS_BLOG_POSTS_PER_PAGE', 3);
}

/**
 * Build the WP_Query arguments for the blog grid.
 *
 * @param string $category Category slug, or 'all' for no filter.
 * @param int    $paged    Page number (1-based).
 * @param string $lang     Polylang language slug (optional).
 * @return array
 */
function rias_blog_query_args($category = 'all', $paged = 1, $lang = '')
{
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => RIAS_BLOG_POSTS_PER_PAGE,
		'paged'               => max(1, (int) $paged),
		'ignore_sticky_posts' => true,
	);

	if ($category && $category !== 'all') {
		$args['category_name'] = sanitize_title($category);
	}

	if ($lang) {
		// Polylang honours the "lang" query var to scope results to one language.
		$args['lang'] = sanitize_text_field($lang);
	}

	return $args;
}

/**
 * Render a single blog card. Markup mirrors the static design in
 * template-blog.php so initial + AJAX-loaded cards are identical.
 *
 * @param int $post_id
 * @return string
 */
function rias_render_blog_card($post_id, $lang = '')
{
	$cat_slugs = array();
	foreach (get_the_category($post_id) as $cat) {
		$cat_slugs[] = $cat->slug;
	}
	$data_category = esc_attr(implode(' ', $cat_slugs));

	$title   = get_the_title($post_id);
	$date    = get_the_date('F j, Y', $post_id);
	$excerpt = wp_trim_words(get_the_excerpt($post_id), 28, '…');
	$link    = get_permalink($post_id);
	$read_more = ($lang === 'el') ? 'Διαβάστε περισσότερα' : 'Read More';

	$img_url = get_the_post_thumbnail_url($post_id, 'large');
	if (! $img_url) {
		// Graceful fallback so the layout never breaks on posts without a featured image.
		$img_url = get_template_directory_uri() . '/images/about-images/blog1.webp';
	}

	ob_start();
	?>
	<div class="col-lg-4 col-sm-6" data-category="<?php echo $data_category; ?>">
		<article class="blog-card">
			<div class="blog-card__image">
				<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>">
			</div>
			<div class="blog-card__body">
				<span class="blog-card__date"><?php echo esc_html($date); ?></span>
				<h3 class="blog-card__title"><?php echo esc_html($title); ?></h3>
				<p class="blog-card__excerpt"><?php echo esc_html($excerpt); ?></p>
				<a href="<?php echo esc_url($link); ?>" class="blog-card__link"><span><?php echo esc_html($read_more); ?></span> <i
						class="fa-solid fa-arrow-right"></i></a>
			</div>
		</article>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * AJAX handler powering both the category filter and the Show More button.
 */
function rias_load_blog_posts()
{
	check_ajax_referer('rias_blog_nonce', 'nonce');

	$category = isset($_POST['category']) ? sanitize_text_field(wp_unslash($_POST['category'])) : 'all';
	$paged    = isset($_POST['paged']) ? (int) $_POST['paged'] : 1;
	$lang     = isset($_POST['lang']) ? sanitize_text_field(wp_unslash($_POST['lang'])) : '';

	$query = new WP_Query(rias_blog_query_args($category, $paged, $lang));

	$html = '';
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$html .= rias_render_blog_card(get_the_ID(), $lang);
		}
	}
	wp_reset_postdata();

	wp_send_json_success(array(
		'html'     => $html,
		'has_more' => ($paged < (int) $query->max_num_pages),
		'found'    => (int) $query->found_posts,
	));
}
add_action('wp_ajax_rias_load_blog_posts', 'rias_load_blog_posts');
add_action('wp_ajax_nopriv_rias_load_blog_posts', 'rias_load_blog_posts');

function get_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));

    $reading_time = max(1, ceil($word_count / 200));

    return $reading_time . ' min read';
}


function rias_blog_menu_active($classes, $item) {

    // Blog page ID (English + Greek)
    $blog_page_ids = array(3837, 4010); // Replace with your actual page IDs

    if (is_singular('post') && in_array($item->object_id, $blog_page_ids)) {
        $classes[] = 'current-menu-item';
        $classes[] = 'current_page_item';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'rias_blog_menu_active', 10, 2);