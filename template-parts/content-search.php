<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wp_notes
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--archive c-post--archive-main' ); ?>>
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="c-post__link" aria-label="<?php the_title(); ?>"></a>
    <header class="c-post__header">
		<?php
		the_title( '<h2 class="c-post__title">','</h2>' );
		?>
    </header><!-- .entry-header -->

    <div class="c-post__content">
		<?php
		the_excerpt();
		?>
    </div><!-- .entry-content -->
    <footer class="c-post__footer">
        <div class="c-post__footer__meta">
			<?php
			wp_notes_posted_on();
			?>
        </div><!-- .entry-meta -->
    </footer>
</article><!-- #post-<?php the_ID(); ?> -->
