<?php

/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if (!function_exists('twentytwentyfour_block_styles')) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles()
	{

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __('Arrow icon', 'twentytwentyfour'),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __('Pill', 'twentytwentyfour'),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __('Checkmark', 'twentytwentyfour'),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __('With arrow', 'twentytwentyfour'),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __('With asterisk', 'twentytwentyfour'),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action('init', 'twentytwentyfour_block_styles');

/**
 * Enqueue block stylesheets.
 */

if (!function_exists('twentytwentyfour_block_stylesheets')) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets()
	{
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri('assets/css/button-outline.css'),
				'ver'    => wp_get_theme(get_template())->get('Version'),
				'path'   => get_parent_theme_file_path('assets/css/button-outline.css'),
			)
		);
	}
endif;

add_action('init', 'twentytwentyfour_block_stylesheets');

/**
 * Register pattern categories.
 */

if (!function_exists('twentytwentyfour_pattern_categories')) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories()
	{

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x('Pages', 'Block pattern category', 'twentytwentyfour'),
				'description' => __('A collection of full page layouts.', 'twentytwentyfour'),
			)
		);
	}
endif;

add_theme_support('menus');

// NOTE 404 Page
function twentytwentyfour_template_404($template) {
	if (is_404()) {
		return get_theme_file_path('404.php');
	}
	return $template;
}
add_filter('template_include', 'twentytwentyfour_template_404');

function top_nav_menu()
{

	$menu = wp_get_nav_menu_items('top-nav');

	$result = [];

	foreach ($menu as $item) {

		$my_item = [

			'name' => $item->title,

			'href' => $item->url

		];

		$result[] = $my_item;
	}

	return $result;
}

add_action('rest_api_init', function () {
	// top-nav menu
	register_rest_route('wp/v2', 'top-nav', array(
		'methods' => 'GET',
		'callback' => 'top_nav_menu',
		'permission_callback' => '__return_true',
	));
});

// JSON PRODUCT API
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/product_service/', array(
		'methods' => 'GET',
		'callback' => 'getProductsList',
	));
});

// JSON SELECTED COLLECTION
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/selected_collection/', array(
		'methods' => 'GET',
		'callback' => 'getCollectionsList',
	));
});
// JSON SELECTED MATERIAL
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/selected_materials/', array(
		'methods' => 'GET',
		'callback' => 'getMaterialsList',
	));
});

// JSON SELECTED MOOD
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/selected_moods/(?P<slug>[a-zA-Z0-9-]+)?', array(
		'methods' => 'GET',
		'callback' => 'getMoodList',
	));
});
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/selected_moods/', array(
		'methods' => 'GET',
		'callback' => 'getMoodList',
	));
});

// JSON SELECTED PROJECTS
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/selected_inspirations/', array(
		'methods' => 'GET',
		'callback' => 'getInspirationsList',
	));
});


function getMoodList($request)
{
	$json_file_path = get_template_directory() . '/api/moods.json';

	if (!file_exists($json_file_path)) {
		return new WP_Error('no_file', 'File not found', array('status' => 404));
	}

	$json_content = file_get_contents($json_file_path);
	$data = json_decode($json_content, true);

	if (isset($request['slug'])) {
		$slug = $request['slug'];
		$data = array_filter($data, function ($item) use ($slug) {
			return $item['slug'] === $slug;
		});
	}
	if (json_last_error() !== JSON_ERROR_NONE) {
		return new WP_Error('json_error', 'Error decoding JSON', array('status' => 500));
	}
	return new WP_REST_Response($data, 200);
}
function getInspirationsList($request)
{
	$json_file_path = get_template_directory() . '/api/inspirations.json';
	if (!file_exists($json_file_path)) {
		return new WP_Error('no_file', 'File not found', array('status' => 404));
	}

	$json_content = file_get_contents($json_file_path);
	$data = json_decode($json_content, true);

	if (json_last_error() !== JSON_ERROR_NONE) {
		return new WP_Error('json_error', 'Error decoding JSON', array('status' => 500));
	}
	return new WP_REST_Response($data, 200);
}
function getProductsList()
{
	$json_file_path = get_template_directory() . '/api/product.json';

	if (!file_exists($json_file_path)) {
		return new WP_Error('no_file', 'File not found', array('status' => 404));
	}

	$json_content = file_get_contents($json_file_path);
	$data = json_decode($json_content, true);

	if (json_last_error() !== JSON_ERROR_NONE) {
		return new WP_Error('json_error', 'Error decoding JSON', array('status' => 500));
	}
	return new WP_REST_Response($data, 200);
}
function getCollectionsList()
{
	$json_file_path = get_template_directory() . '/api/collection.json';

	if (!file_exists($json_file_path)) {
		return new WP_Error('no_file', 'File not found', array('status' => 404));
	}

	$json_content = file_get_contents($json_file_path);
	$data = json_decode($json_content, true);

	if (json_last_error() !== JSON_ERROR_NONE) {
		return new WP_Error('json_error', 'Error decoding JSON', array('status' => 500));
	}
	return new WP_REST_Response($data, 200);
}
function getMaterialsList()
{
	$json_file_path = get_template_directory() . '/api/materials.json';

	if (!file_exists($json_file_path)) {
		return new WP_Error('no_file', 'File not found', array('status' => 404));
	}

	$json_content = file_get_contents($json_file_path);
	$data = json_decode($json_content, true);

	if (json_last_error() !== JSON_ERROR_NONE) {
		return new WP_Error('json_error', 'Error decoding JSON', array('status' => 500));
	}
	return new WP_REST_Response($data, 200);
}

// END JSON PRODUCT API


// CUSTOM Collections
add_action('init', function () {
	add_rewrite_rule('^collections/([^/]+)/?$', 'index.php?collection=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'collection';
	return $query_vars;
});

add_action('template_include', function ($template) {

	if (get_query_var('collection') == false || get_query_var('collection') == '') {
		return $template;
	}

	return get_template_directory() . '/pages/collections.php';
});

// CUSTOM Categories
add_action('init', function () {
	add_rewrite_rule('categories/([a-z0-9]+)[/]?$', 'index.php?category=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'category';
	return $query_vars;
});

add_action('template_include', function ($template) {

	if (get_query_var('category') == false || get_query_var('product_category') == '') {
		return $template;
	}

	return get_template_directory() . '/pages/product-category-detail.php';
});

// CUSTOM product-category details
add_action('init', function () {
	add_rewrite_rule('products/([a-z0-9-]+)[/]?$', 'index.php?product=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'product';
	return $query_vars;
});

add_filter('wp_title', function ($title) {
    if (get_query_var('product')) {
        return get_query_var('product');
    }
    return $title;
});

add_action('template_include', function ($template) {
	if (get_query_var('product') == false || get_query_var('product') == '') {
		return $template;
	}

	return get_template_directory() . '/pages/product-category-detail.php';
});

// CUSTOM product-page details
add_action('init', function () {
	add_rewrite_rule('^product-detail/([^/]+)?$', 'index.php?detail=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'detail';
	return $query_vars;
});

add_action('template_include', function ($template) {
	if (get_query_var('detail') == false || get_query_var('detail') == '') {
		return $template;
	}

	return get_template_directory() . '/pages/product-detail.php';
});

// CUSTOM Moods details
add_action('init', function () {
	add_rewrite_rule('^moods/([^/]+)/?$', 'index.php?mood=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'mood';
	return $query_vars;
});

add_action('template_include', function ($template) {
	if (get_query_var('mood') == false || get_query_var('mood') == '') {
		return $template;
	}
	return get_template_directory() . '/pages/moods.php';
});
// CUSTOM Site map
add_action('init', function () {
	add_rewrite_rule('^sitemap/([^/]+)/?$', 'index.php?sitemap=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
	$query_vars[] = 'sitemap';
	return $query_vars;
});

add_action('template_include', function ($template) {

	if (get_query_var('sitemap') == false || get_query_var('sitemap') == '') {
		return $template;
	}

	return get_template_directory() . '/pages/sitemap_actions.php';
});

//enable upload for webp image files.
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

//enable preview / thumbnail for webp image files.
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

// TAILWIND INIT

function enqueue_styles()
{
	wp_enqueue_style('tailwind-style', get_template_directory_uri() . '/output.css', array(), '1.0.0');
	wp_enqueue_style('global', get_template_directory_uri() . '/global.css', array(), '1.0.0');
}

add_action('wp_enqueue_scripts', 'enqueue_styles');


function slugToTitleCase($slug) {
    return ucwords(str_replace('-', ' ', $slug));
}