<?php
/**
 * Ajustes específicos do site piloto.
 *
 * @package CS_Theme_1_Christoph
 */

defined( 'ABSPATH' ) || exit;

/**
 * Carrega as personalizações após a folha final do tema base.
 */
function cs_theme_1_christoph_assets() {
	wp_enqueue_style(
		'cs-theme-1-christoph',
		get_stylesheet_uri(),
		array( 'cs-theme-1-site' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style(
		'cs-theme-1-christoph-homepage',
		get_stylesheet_directory_uri() . '/assets/css/homepage.css',
		array( 'cs-theme-1-christoph' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'cs_theme_1_christoph_assets', 20 );

/**
 * Carrega a skin da homepage no editor para refletir a largura pública.
 */
function cs_theme_1_christoph_editor_styles() {
	add_editor_style( 'assets/css/homepage.css' );
}
add_action( 'after_setup_theme', 'cs_theme_1_christoph_editor_styles', 20 );
