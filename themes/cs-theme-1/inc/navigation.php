<?php
/**
 * Menus nativos e configuração inicial.
 *
 * @package CS_Theme_1
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cria o menu apenas na primeira ativação e preserva configurações existentes.
 */
function cs_theme_1_seed_navigation() {
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['cs_primary'] ) ) {
		return;
	}

	$menu_id = (int) get_option( 'cs_theme_1_initial_menu' );
	if ( ! $menu_id ) {
		$menu_id = wp_create_nav_menu( 'CS Theme 1 – Hauptnavigation' );
		if ( is_wp_error( $menu_id ) ) {
			return;
		}

		$links = array(
			'/'                          => __( 'Startseite', 'cs-theme-1' ),
			'/bewegungsanalyse/'         => __( 'Bewegungsanalyse', 'cs-theme-1' ),
			'/schmerzcoaching/'          => __( 'Schmerzcoaching', 'cs-theme-1' ),
			'/biomechanisches-training/' => __( 'Biomechanisches Training', 'cs-theme-1' ),
			'/haltungscoaching/'         => __( 'Haltungscoaching', 'cs-theme-1' ),
			'/ueber-mich/'               => __( 'Über mich', 'cs-theme-1' ),
			'/blog/'                     => __( 'Blog', 'cs-theme-1' ),
			'/kontakt/'                  => __( 'Kontakt', 'cs-theme-1' ),
		);

		foreach ( $links as $route => $title ) {
			$item = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => $title,
					'menu-item-url'    => home_url( $route ),
					'menu-item-type'   => 'custom',
					'menu-item-status' => 'publish',
				)
			);
			if ( is_wp_error( $item ) ) {
				wp_delete_nav_menu( $menu_id );
				return;
			}
		}
		update_option( 'cs_theme_1_initial_menu', $menu_id, false );
	}

	if ( wp_get_nav_menu_object( $menu_id ) ) {
		$locations['cs_primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}
add_action( 'after_switch_theme', 'cs_theme_1_seed_navigation' );

/**
 * Exibe o menu atribuído à posição, com rótulo para leitores de tela.
 *
 * @param string $location Posição registrada no WordPress.
 * @param string $label Rótulo acessível.
 * @param string $id Identificador exclusivo da lista.
 */
function cs_theme_1_menu( $location, $label, $id ) {
	if ( ! has_nav_menu( $location ) ) {
		return;
	}

	$menu = wp_nav_menu(
		array(
			'theme_location' => $location,
			'container'      => false,
			'menu_id'        => $id,
			'menu_class'     => 'cs-menu',
			'fallback_cb'    => false,
			'echo'           => false,
			'depth'          => 1,
		)
	);

	if ( $menu ) {
		printf(
			'<nav aria-label="%1$s">%2$s</nav>',
			esc_attr( $label ),
			$menu // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML do renderizador nativo de menus.
		);
	}
}
