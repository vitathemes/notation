<?php
global $post;
$active_class = '';
if ($post->ID === get_the_ID()){
    $active_class = ' is-selected-post';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c-post c-post--archive'. $active_class); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="c-post__link" aria-label="<?php the_title(); ?>"></a>
	<header class="c-post__header">
		<?php
		the_title( '<h3 class="c-post__title h3">','</h2>' );
		?>
	</header><!-- .entry-header -->
	<?php if ( get_theme_mod( 'show_post_excerpt_sidebar', true ) ): ?>
	<div class="c-post__content">
		<?php
		the_excerpt();
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	<?php if ( get_theme_mod( 'show_date_sidebar', true ) ): ?>
	<footer class="c-post__footer">
		<div class="c-post__footer__meta">
			<?php
			notation_posted_on();
			?>
		</div><!-- .entry-meta -->
	</footer>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
