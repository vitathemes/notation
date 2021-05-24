<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Holo
 */

define( 'SITE_LAYOUT', get_theme_mod( 'blog_layout', 'left' ) );
define( 'SHOP_LAYOUT', get_theme_mod( 'shop_layout', 'left' ) );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function holo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'holo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function holo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'holo_pingback_header' );


if ( ! function_exists( 'holo_branding' ) ) {
	/**
	 * Displays branding
	 *
	 * If there is not any custom logo the function will show site title
	 */
	function holo_branding() {
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			if ( is_front_page() && is_home() ) :
				?>
                <h1 class="c-header__branding__title site-title">
                    <a class="c-header__branding__title__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </h1>
			<?php
			else :
				?>
                <p class="c-header__branding__title site-title h1">
                    <a class="c-header__branding__title__link h1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </p>
			<?php
			endif;
		}


	}

	add_action( 'holo_branding_hook', 'holo_branding' );
}

if ( ! function_exists( 'holo_header' ) ) {
	/**
	 * Displays header nav
	 *
	 * This function will show header nav
	 */
	function holo_header() {
		holo_header_nav();
		holo_show_header_icons();
	}

	add_action( 'holo_header_hook', 'holo_header' );
}

if ( ! function_exists( 'holo_theme_settings' ) ) {
	function holo_theme_settings() {
		$vars = ':root {	
	            --holo-branding-color: ' . get_theme_mod( "color_primary_color", "#EC7160" ) . ';
	            --holo-branding-color: ' . get_theme_mod( "color_primary_accent_color", "#DA5745" ) . ';
	            --holo-primary-color: ' . get_theme_mod( "color_1", "#303030" ) . ';
	            --holo-secondary-color: ' . get_theme_mod( "color_2", "#898989" ) . ';
	            --holo-tertiary-color: ' . get_theme_mod( "color_3", "#E7E7E9" ) . ';
	            --holo-quaternary-color: ' . get_theme_mod( "color_4", "#F6F6F6" ) . ';
	            --holo-quinary-color: ' . get_theme_mod( "color_5", "#F9F9F9" ) . ';
	        
			}';

		?>
        <style>
            <?php echo esc_html($vars); ?>
        </style>
		<?php
	}
}
add_action( 'wp_head', 'holo_theme_settings' );

if ( ! function_exists( 'holo_reply_title' ) ) {
	function holo_reply_title( $defaults ) {
		$defaults['title_reply_before'] = '<h3 id="reply-title" class="h2 comment-reply-title">';
		$defaults['title_reply_after']  = '</h3>';

		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'holo_reply_title' );


/**
 * Get blog posts page URL.
 *
 * @return string The blog posts page URL.
 */
function holo_get_blog_posts_page_url() {

	// If front page is set to display a static page, get the URL of the posts page.
	if ( 'page' === get_option( 'show_on_front' ) ) {
		return get_permalink( get_option( 'page_for_posts' ) );
	}

	// The front page IS the posts page. Get its URL.
	return get_home_url();
}
