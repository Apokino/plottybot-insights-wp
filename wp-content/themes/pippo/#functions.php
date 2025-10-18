<?php
/**
 * pippo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pippo
 */

// carica stile plotty
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'plotty-main-style', // handle unico
        'https://plottybot.com/wp-content/themes/pippo/style.css', // URL diretto al CSS principale
        array(), // eventuali dipendenze
        filemtime(ABSPATH . '/wp-content/themes/pippo/style.css') // versioning cache-busting opzionale
    );
});


// Cancella il cookie di autenticazione al logout
add_action('wp_logout', function() {
    setcookie('plotty_token', '', time() - 3600, '/', '.plottybot.com', true, true);
});

// Controllo automatico del login su plottybot.com
add_action('init', 'plotty_check_token_login');
function plotty_check_token_login() {
    // Evita di interferire se l’utente è già loggato
    if (is_user_logged_in()) return;

    // Se non c’è cookie, nulla da fare
    if (empty($_COOKIE['plotty_token'])) return;

    $token = sanitize_text_field($_COOKIE['plotty_token']);

    // Valida il token tramite API del dominio principale
    $response = wp_remote_post('https://plottybot.com/wp-json/custom-api/v1/validate', [
        'body' => ['token' => $token],
        'timeout' => 5,
    ]);

    if (is_wp_error($response)) return;

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($data['success'])) return;

    // Se utente valido, loggalo localmente
    $email = sanitize_email($data['email']);
    $login = sanitize_user($data['username']);

    // Cerca utente locale o crealo
    $user = get_user_by('email', $email);
    if (!$user) {
        $user_id = wp_create_user($login, wp_generate_password(), $email);
        $user = get_user_by('ID', $user_id);
    }

    // Imposta sessione WordPress
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID);
}





if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'pippo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pippo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pippo, use a find and replace
		 * to change 'pippo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pippo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'pippo' ),
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
				'pippo_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pippo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pippo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pippo_content_width', 640 );
}
add_action( 'after_setup_theme', 'pippo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pippo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pippo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pippo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pippo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pippo_scripts() {
	wp_enqueue_style( 'pippo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pippo-style', 'rtl', 'replace' );

	wp_enqueue_script( 'pippo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pippo_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

