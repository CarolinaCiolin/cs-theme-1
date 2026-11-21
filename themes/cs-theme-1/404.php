<?php
/**
 * Página de erro do WordPress.
 *
 * @package CS_Theme_1
 */

get_header();
?>
<main id="cs-main" class="cs-shell cs-page" tabindex="-1">
	<h1><?php esc_html_e( 'Seite nicht gefunden', 'cs-theme-1' ); ?></h1>
	<?php get_search_form(); ?>
	<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Zur Startseite', 'cs-theme-1' ); ?></a></p>
</main>
<?php get_footer(); ?>
