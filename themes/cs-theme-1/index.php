<?php
/**
 * Listagens do WordPress, incluindo blog, arquivos e busca.
 *
 * @package CS_Theme_1
 */

get_header();
?>
<main id="cs-main" class="cs-shell cs-page" tabindex="-1">
	<?php if ( is_search() ) : ?>
		<h1>
			<?php
			/* translators: %s: termo buscado. */
			printf( esc_html__( 'Suche: %s', 'cs-theme-1' ), esc_html( get_search_query( false ) ) );
			?>
		</h1>
	<?php elseif ( is_archive() ) : ?>
		<?php the_archive_title( '<h1>', '</h1>' ); ?>
		<?php the_archive_description( '<div>', '</div>' ); ?>
	<?php elseif ( is_home() ) : ?>
		<?php $cs_blog_title = single_post_title( '', false ); ?>
		<h1><?php echo esc_html( $cs_blog_title ? $cs_blog_title : __( 'Blog', 'cs-theme-1' ) ); ?></h1>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<div class="cs-post-list">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'template-parts/summary' ); ?>
			<?php endwhile; ?>
		</div>
		<?php
		the_posts_pagination(
			array(
				'prev_text'          => __( 'Zurück', 'cs-theme-1' ),
				'next_text'          => __( 'Weiter', 'cs-theme-1' ),
				'screen_reader_text' => __( 'Weitere Beiträge', 'cs-theme-1' ),
			)
		);
		?>
	<?php else : ?>
		<p><?php esc_html_e( 'Keine Beiträge gefunden.', 'cs-theme-1' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
