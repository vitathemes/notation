<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Holo
 */

if ( is_singular() ) :
	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--single' ); ?>>
        <header class="c-post__header">
			<?php
			the_title( '<h1 class="c-post__title">', '</h1>' );

			if ( 'post' === get_post_type() ) :
				?>
                <div class="c-post__meta">
					<?php
					holo_post_meta();
					?>
                </div><!-- .entry-meta -->
			<?php endif; ?>
        </header><!-- .entry-header -->

		<?php if ( get_theme_mod( 'show_post_thumbnail', true ) ) {
		    holo_post_thumbnail();
		} ?>

        <div class="c-post__content s-post-content entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'holo' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'holo' ),
					'after'  => '</div>',
				)
			);
			?>
        </div><!-- .entry-content -->

        <footer class="c-post__footer">
			<?php holo_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->
<?php
else:
	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--archive c-post--archive-main' ); ?>>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="c-post__link" aria-label="<?php the_title(); ?>"></a>
        <header class="c-post__header">
			<?php
			the_title( '<h2 class="c-post__title h3">', '</h2>' );
			?>
        </header><!-- .entry-header -->
	<?php if ( get_theme_mod( 'show_post_excerpt', true ) ): ?>
        <div class="c-post__content">
			<?php
			the_excerpt();
			?>
        </div><!-- .entry-content -->
	<?php endif; ?>
		<?php if ( get_theme_mod( 'show_date_archive', true ) ): ?>
            <footer class="c-post__footer">
                <div class="c-post__footer__meta">
					<?php
					holo_posted_on();
					?>
                </div><!-- .entry-meta -->
            </footer>
		<?php endif; ?>
    </article><!-- #post-<?php the_ID(); ?> -->
<?php
endif;
