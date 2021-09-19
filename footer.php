<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wp_notes
 */

?>

<footer id="colophon" class="c-footer site-footer">
    <div class="c-footer__bottom site-info">
        <div class="u-default-max-width">
            <div class="c-footer__grid">
                <div class="c-footer__copyright">
					<?php if ( get_theme_mod( 'show_branding_in_footer', true ) ) : ?>
                        <div class="c-footer__branding s-footer-branding">
							<?php wp_notes_branding(); ?>
                        </div>
					<?php endif; ?>
                    <div class="c-footer__copyright__text">
						<?php
						wp_notes_footer_credit_text();
						wp_notes_footer_copyright_text();
						?>
                    </div>
                </div>
                <?php
                if ( has_nav_menu( 'menu-2' ) ) {
	                wp_nav_menu(
		                array(
			                'theme_location' => 'menu-2',
			                'menu_class'     => 'c-nav c-nav--footer s-nav js-nav',
			                'container'      => '',
		                )
	                );
                }
                ?>
            </div>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

</main><!-- #main -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
