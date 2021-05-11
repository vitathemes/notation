<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Holo
 */

?>

<footer id="colophon" class="c-footer site-footer">
    <div class="c-footer__bottom site-info">
        <div class="u-default-max-width">
            <div class="c-footer__grid">
                <div class="c-footer__copyright">
					<?php if ( get_theme_mod( 'show_branding_in_footer', true ) ) : ?>
                        <div class="c-footer__branding s-footer-branding">
							<?php holo_branding(); ?>
                        </div>
					<?php endif; ?>
                    <p>
						<?php $allowed_html = [
							'a'      => [
								'href'  => [],
								'title' => [],
							],
							'br'     => [],
							'em'     => [],
							'strong' => [],
							'p'      => [],
						];
						echo wp_kses( get_theme_mod( 'copyright_text', sprintf( '</span>%s <a href="%s" class="customize-unpreviewable">%s</a>.', esc_html__( 'Designed by ', 'holo' ), esc_url( 'https://vitathemes.com' ), esc_html__( 'VitaThemes', 'holo' ) ) ), $allowed_html );
						?>
                    </p>
                </div>
				<?php holo__share_links(); ?>
            </div>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

</main><!-- #main -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
