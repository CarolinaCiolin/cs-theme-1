<?php
/**
 * Abertura do documento e navegação.
 *
 * @package CS_Theme_1
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="cs-skip-link" href="#cs-main"><?php esc_html_e( 'Zum Inhalt springen', 'cs-theme-1' ); ?></a>
<header class="cs-header">
	<div class="cs-shell cs-header__inner">
		<?php get_template_part( 'template-parts/brand' ); ?>
		<?php if ( has_nav_menu( 'cs_primary' ) ) : ?>
			<div class="cs-header__navigation" id="cs-header-navigation">
				<?php cs_theme_1_menu( 'cs_primary', __( 'Hauptnavigation', 'cs-theme-1' ), 'cs-primary-menu' ); ?>
			</div>
		<?php endif; ?>
		<a class="cs-button cs-header__cta" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>">
			<?php esc_html_e( 'Gratis-Coaching buchen', 'cs-theme-1' ); ?>
		</a>
		<?php if ( has_nav_menu( 'cs_primary' ) ) : ?>
			<button class="cs-menu-control" type="button" aria-haspopup="dialog" aria-controls="cs-menu-panel" id="cs-menu-open" hidden>
				<?php esc_html_e( 'Menü', 'cs-theme-1' ); ?>
			</button>
			<dialog class="cs-menu-panel" id="cs-menu-panel" aria-label="<?php esc_attr_e( 'Menü', 'cs-theme-1' ); ?>">
				<button class="cs-menu-control" type="button" id="cs-menu-close" autofocus>
					<?php esc_html_e( 'Menü schließen', 'cs-theme-1' ); ?>
				</button>
			</dialog>
		<?php endif; ?>
	</div>
</header>
