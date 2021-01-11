<?php
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h3>
			<?php
			printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'ahura' ), number_format_i18n( get_comments_number() ) );
			?>
		</h3>
		<div class="commentlist">
			<?php
			wp_list_comments('avatar_size=80');
			?>
		</div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Previous Comments', 'ahura' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'New Comments &rarr;', 'ahura' ) ); ?></div>
		</nav>
		<?php endif; ?>

	<?php endif; ?>
	<?php comment_form(); ?>
	<?php if ( ! comments_open() ) :?>
	<p class="nocomments"><?php echo __( 'Comments closed.', 'ahura' ); ?></p>
	<?php endif; ?>
</div>