<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Notation
 */

?>

<footer id="colophon" class="c-footer site-footer">
    <div class="c-footer__bottom site-info">
        <div class="u-default-max-width">
            <div class="c-footer__grid">
                <div class="c-footer__copyright">
					<?php if ( get_theme_mod( 'show_branding_in_footer', true ) ) : ?>
                        <div class="c-footer__branding s-footer-branding">
							<?php notation_branding(); ?>
                        </div>
					<?php endif; ?>
                    <div class="c-footer__copyright__text">
						<?php $allowed_html = [
							'a'      => [
								'href' => [],
								'title' => [],
							],
							'br'     => [],
							'em'     => [],
							'strong' => [],
							'p'      => [],
						];
						echo wp_kses( get_theme_mod( 'copyright_text',
							sprintf( '<span>%s</span><a href="%s" class="customize-unpreviewable">%s</a>',
								esc_html__( 'Notation theme by ', 'notation' ),
								esc_url( 'https://vitathemes.com' ),
								esc_html__( 'VitaThemes', 'notation' ) ) ),
							$allowed_html );
						?>
                    </div>
                </div>
                <div class="c-social-networks">
                    <?php if (get_theme_mod('instagram', false)): ?>
                    <a class="c-social-networks__link" target="_blank" href="<?php echo esc_url(get_theme_mod('instagram')); ?>">
                        Instagram
                        </span></a>
	                <?php endif; ?>
	                <?php if (get_theme_mod('twitter', false)): ?>
                    <a class="c-social-networks__link" target="_blank" href="<?php echo esc_url(get_theme_mod('twitter')); ?>">
                        Twitter
                    </a>
	                <?php endif; ?>
	                <?php if (get_theme_mod('facebook', false)): ?>
                    <a class="c-social-networks__link" target="_blank" href="<?php echo esc_url(get_theme_mod('facebook')); ?>">
                        Facebook
                    </a>
	                <?php endif; ?>
                </div>
            </div>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

</main><!-- #main -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
