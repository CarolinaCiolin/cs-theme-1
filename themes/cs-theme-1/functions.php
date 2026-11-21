<?php
/**
 * Inicialização do tema base.
 *
 * @package CS_Theme_1
 */

defined( 'ABSPATH' ) || exit;

require_once get_template_directory() . '/inc/navigation.php';

/**
 * Registra recursos do tema e posições de navegação.
 */
function cs_theme_1_setup() {
	load_theme_textdomain( 'cs-theme-1', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/fonts.css', 'assets/css/editor.css' ) );

	register_nav_menus(
		array(
			'cs_primary'         => __( 'Hauptnavigation', 'cs-theme-1' ),
			'cs_footer'          => __( 'Navigation im Footer', 'cs-theme-1' ),
			'cs_footer_services' => __( 'Leistungen im Footer', 'cs-theme-1' ),
			'cs_footer_contact'  => __( 'Kontakt im Footer', 'cs-theme-1' ),
			'cs_footer_social'   => __( 'Soziale Medien im Footer', 'cs-theme-1' ),
			'cs_footer_legal'    => __( 'Rechtliche Links im Footer', 'cs-theme-1' ),
		)
	);
}
add_action( 'after_setup_theme', 'cs_theme_1_setup' );

/**
 * Carrega os recursos públicos com dependências explicitadas.
 */
function cs_theme_1_assets() {
	$base    = get_template_directory_uri();
	$version = wp_get_theme( get_template() )->get( 'Version' );

	wp_enqueue_style( 'cs-theme-1', $base . '/style.css', array(), $version );
	wp_enqueue_style( 'cs-theme-1-fonts', $base . '/assets/css/fonts.css', array( 'cs-theme-1' ), $version );
	wp_enqueue_style( 'cs-theme-1-base', $base . '/assets/css/base.css', array( 'cs-theme-1-fonts' ), $version );
	wp_enqueue_style( 'cs-theme-1-content', $base . '/assets/css/content.css', array( 'cs-theme-1-base' ), $version );
	wp_enqueue_style( 'cs-theme-1-site', $base . '/assets/css/site.css', array( 'cs-theme-1-content' ), $version );

	if ( has_nav_menu( 'cs_primary' ) ) {
		wp_enqueue_script( 'cs-theme-1-navigation', $base . '/assets/js/navigation.js', array(), $version, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cs_theme_1_assets' );
