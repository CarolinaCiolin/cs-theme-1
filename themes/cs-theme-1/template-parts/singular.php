<?php
/**
 * Loop principal compartilhado entre páginas e artigos.
 *
 * @package CS_Theme_1
 */

$cs_full_width = isset( $args['layout'] ) && 'full' === $args['layout'];
?>
<main id="cs-main" class="<?php echo $cs_full_width ? 'cs-page-full' : 'cs-page cs-singular'; ?>" tabindex="-1">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( ! $cs_full_width ) : ?>
				<header class="cs-shell cs-entry-header">
					<?php the_title( '<h1>', '</h1>' ); ?>
					<?php the_post_thumbnail( 'large' ); ?>
				</header>
			<?php endif; ?>
			<div class="<?php echo $cs_full_width ? 'cs-entry-content--full' : 'cs-shell cs-entry-content'; ?>">
				<?php the_content(); ?>
				<?php
				wp_link_pages(
					array(
						'before' => '<p class="cs-page-links">' . esc_html__( 'Seiten:', 'cs-theme-1' ),
						'after'  => '</p>',
					)
				);
				?>
			</div>
		</article>
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	<?php endwhile; ?>
</main>
