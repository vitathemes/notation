<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Notation
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="o-grid-noGutter c-site js-site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'notation' ); ?></a>

    <header id="masthead" class="c-header js-header">
        <div class="c-header__branding">
			<?php
			notation_branding();
			?>
        </div><!-- .site-branding -->

        <div class="c-header__search js-header-search">
            <button aria-label="<?php esc_attr_e( 'Search',
				'notation' ); ?>" class="c-header__link c-header__link--search js-search-btn">
                <svg class="c-header__link__icon c-header__link__icon--close" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="2em" height="2em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                    <path d="M229.651 218.344l-43.222-43.223a92.112 92.112 0 1 0-11.315 11.314l43.223 43.223a8 8 0 1 0 11.314-11.314zM40 116a76 76 0 1 1 76 76a76.086 76.086 0 0 1-76-76z"/>
                </svg>
                <svg class="c-header__link__icon c-header__link__icon--open" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="2em" height="2em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                    <path d="M205.657 194.343a8 8 0 1 1-11.314 11.314L128 139.313l-66.343 66.344a8 8 0 0 1-11.314-11.314L116.687 128L50.343 61.657a8 8 0 0 1 11.314-11.314L128 116.687l66.343-66.344a8 8 0 0 1 11.314 11.314L139.313 128z"/>
                    <rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)"/>
                </svg>
            </button>
            <div class="c-header__Search__wrapper">
				<?php get_search_form(); ?>
            </div>
        </div>

        <nav id="site-navigation" class="c-header__nav">
            <button class="c-header__link c-header__link--menu js-menu-btn js-menu-btn--toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="hamburger-box"><span class="hamburger-inner"></span></span>
            </button>
            <div class="c-header__nav__wrapper">
                <button aria-label="<?php esc_attr_e( 'Menu close',
					'notation' ); ?>" class="c-header__link c-header__link--menu c-header__link--menu-close js-menu-btn js-menu-btn--close">
                    <svg class="c-header__link__icon" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="2em" height="2em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                        <path d="M205.657 194.343a8 8 0 1 1-11.314 11.314L128 139.313l-66.343 66.344a8 8 0 0 1-11.314-11.314L116.687 128L50.343 61.657a8 8 0 0 1 11.314-11.314L128 116.687l66.343-66.344a8 8 0 0 1 11.314 11.314L139.313 128z"/>
                        <rect x="0" y="0" width="256" height="256" fill="rgba(0, 0, 0, 0)"/>
                    </svg>
                </button>
				<?php
				if ( has_nav_menu( 'menu-1' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_class'     => 'c-nav s-nav js-nav',
							'container'      => '',
						)
					);
				}
				?>
            </div>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->
