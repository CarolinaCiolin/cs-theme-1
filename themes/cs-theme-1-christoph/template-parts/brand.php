<?php
/**
 * Identidade textual provisória do site piloto.
 *
 * @package CS_Theme_1_Christoph
 */

if ( has_custom_logo() ) {
	the_custom_logo();
} else {
	?>
	<a class="cs-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		Christoph Wimmersberger
	</a>
	<?php
}
