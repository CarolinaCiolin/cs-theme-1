<?php
/**
 * Comentários moderados pelo WordPress.
 *
 * @package CS_Theme_1
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="cs-shell cs-comments" aria-labelledby="cs-comments-title">
	<h2 id="cs-comments-title"><?php esc_html_e( 'Kommentare', 'cs-theme-1' ); ?></h2>
	<?php if ( have_comments() ) : ?>
		<ol class="cs-comment-list">
			<?php wp_list_comments( array( 'style' => 'ol' ) ); ?>
		</ol>
		<?php the_comments_pagination(); ?>
	<?php endif; ?>
	<?php
	comment_form(
		array(
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3>',
		)
	);
	?>
</section>
