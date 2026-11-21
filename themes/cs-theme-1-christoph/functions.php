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
}
add_action( 'wp_enqueue_scripts', 'cs_theme_1_christoph_assets', 20 );
