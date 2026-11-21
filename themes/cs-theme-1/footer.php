<?php
/**
 * Regiões opcionais do rodapé.
 *
 * @package CS_Theme_1
 */

$cs_footer_regions = array(
	'cs_footer'          => __( 'Navigation', 'cs-theme-1' ),
	'cs_footer_services' => __( 'Leistungen', 'cs-theme-1' ),
	'cs_footer_contact'  => __( 'Kontakt', 'cs-theme-1' ),
	'cs_footer_social'   => __( 'Soziale Medien', 'cs-theme-1' ),
	'cs_footer_legal'    => __( 'Rechtliche Hinweise', 'cs-theme-1' ),
);
?>
<footer class="cs-footer">
	<div class="cs-shell">
		<div class="cs-footer__columns">
			<div><?php get_template_part( 'template-parts/brand' ); ?></div>
			<?php foreach ( $cs_footer_regions as $cs_location => $cs_label ) : ?>
				<?php if ( has_nav_menu( $cs_location ) ) : ?>
					<div>
						<p class="cs-footer__label"><?php echo esc_html( $cs_label ); ?></p>
						<?php cs_theme_1_menu( $cs_location, $cs_label, $cs_location . '_menu' ); ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<p class="cs-footer__copyright">
			&copy; <?php echo esc_html( wp_date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ); ?>
		</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
