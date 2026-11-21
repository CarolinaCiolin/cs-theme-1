<?php
/**
 * Resumo de um conteúdo nas listagens.
 *
 * @package CS_Theme_1
 */

$cs_post_title = get_the_title();
?>
<article <?php post_class( 'cs-post-summary' ); ?>>
	<?php the_post_thumbnail( 'medium_large' ); ?>
	<h2>
		<a href="<?php the_permalink(); ?>">
			<?php echo esc_html( '' !== $cs_post_title ? $cs_post_title : __( 'Beitrag ansehen', 'cs-theme-1' ) ); ?>
		</a>
	</h2>
	<?php the_excerpt(); ?>
</article>
