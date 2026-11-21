<?php
/**
 * Identidade configurável no painel.
 *
 * @package CS_Theme_1
 */

if ( has_custom_logo() ) {
	the_custom_logo();
} else {
	$cs_site_name = get_bloginfo( 'name' );
	?>
	<a class="cs-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php echo esc_html( '' !== $cs_site_name ? $cs_site_name : __( 'Startseite', 'cs-theme-1' ) ); ?>
	</a>
	<?php
}
