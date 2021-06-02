<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Notation
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
function notation_body_classes( $classes ) {
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

add_filter( 'body_class', 'notation_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function notation_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'notation_pingback_header' );


if ( ! function_exists( 'notation_branding' ) ) {
	/**
	 * Displays branding
	 *
	 * If there is not any custom logo the function will show site title
	 */
	function notation_branding() {
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

	add_action( 'notation_branding_hook', 'notation_branding' );
}

if ( ! function_exists( 'notation_header' ) ) {
	/**
	 * Displays header nav
	 *
	 * This function will show header nav
	 */
	function notation_header() {
		notation_header_nav();
		notation_show_header_icons();
	}

	add_action( 'notation_header_hook', 'notation_header' );
}

if ( ! function_exists( 'notation_theme_settings' ) ) {
	function notation_theme_settings() {
		$vars = ':root {	
	            --notation-branding-color: ' . get_theme_mod( "color_primary_color", "#EC7160" ) . ';
	            --notation-branding-accent-color: ' . get_theme_mod( "color_primary_accent_color", "#DA5745" ) . ';
	            --notation-primary-color: ' . get_theme_mod( "color_1", "#303030" ) . ';
	            --notation-secondary-color: ' . get_theme_mod( "color_2", "#898989" ) . ';
	            --notation-tertiary-color: ' . get_theme_mod( "color_3", "#E7E7E9" ) . ';
	            --notation-quaternary-color: ' . get_theme_mod( "color_4", "#F6F6F6" ) . ';
	            --notation-quinary-color: ' . get_theme_mod( "color_5", "#F9F9F9" ) . ';
	        
			}';

		?>
        <style>
            <?php echo esc_html($vars); ?>
        </style>
		<?php
	}
}
add_action( 'wp_head', 'notation_theme_settings' );

if ( ! function_exists( 'notation_reply_title' ) ) {
	function notation_reply_title( $defaults ) {
		$defaults['title_reply_before'] = '<h3 id="reply-title" class="h2 comment-reply-title">';
		$defaults['title_reply_after']  = '</h3>';

		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'notation_reply_title' );


/**
 * Get blog posts page URL.
 *
 * @return string The blog posts page URL.
 */
if ( ! function_exists( 'notation_get_blog_posts_page_url' ) ) {
	function notation_get_blog_posts_page_url() {

		// If front page is set to display a static page, get the URL of the posts page.
		if ( 'page' === get_option( 'show_on_front' ) ) {
			return get_permalink( get_option( 'page_for_posts' ) );
		}

		// The front page IS the posts page. Get its URL.
		return get_home_url();
	}
}


/**
 * Homepage - Show latest sticky post
 */

if ( ! function_exists( 'notation_show_latest_post' ) ) {
	function notation_show_latest_post() {
		$stickies = get_option( 'sticky_posts' );
		wp_reset_query();
		wp_reset_postdata();
		// Make sure we have stickies to avoid unexpected output
		if ( $stickies ) {
			$args = [
				'post_type'           => 'post',
				'post__in'            => $stickies,
				'posts_per_page'      => 1,
				'ignore_sticky_posts' => 1,
			];
		} else {
			$args = [
				'post_type'           => 'post',
				'posts_per_page'      => 1,
				'ignore_sticky_posts' => 1,
			];
		}
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			}
			wp_reset_postdata();
		}
	}
}
