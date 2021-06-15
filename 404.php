<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Notation
 */

get_header();
?>

    <main id="primary" class="c-main js-main">
    <div class="c-main__wrapper">
        <section class="error-404 not-found">
            <header class="page-header">
                <span style="font-size: 2.5rem;"><?php esc_html_e('404 ERROR', 'notation') ?></span>
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.',
				        'notation' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'notation' ); ?></p>

                <p style="margin: 3rem 0 4rem;">
                    <a href="<?php echo esc_url(home_url()); ?>" class="c-btn c-btn--secondary"><?php esc_html_e('Homepage', 'notation') ?></a>
                </p>

                <div class="o-grid">
                    <div class="o-col-12_md-5">
                        <div class="c-widget widget_search">
                            <h3><?php esc_html_e('Search for:' , 'notation'); ?></h3>
					        <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- .error-404 -->

    </div>

<?php
get_footer();
