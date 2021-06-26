<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Wp_notes
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_notes_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'wp_notes_pingback_header' );


if ( ! function_exists( 'wp_notes_branding' ) ) {
	/**
	 * Displays branding
	 *
	 * If there is not any custom logo the function will show site title
	 */
	function wp_notes_branding() {
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			if ( is_front_page() && is_home() ) :
				?>
                <h1 class="c-header__branding__title site-title">
                    <a class="c-header__branding__title__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                </h1>
			<?php
			else :
				?>
                <p class="c-header__branding__title site-title h1">
                    <a class="c-header__branding__title__link h1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                </p>
			<?php
			endif;
		}


	}

	add_action( 'wp_notes_branding_hook', 'wp_notes_branding' );
}

if ( ! function_exists( 'wp_notes_header' ) ) {
	/**
	 * Displays header nav
	 *
	 * This function will show header nav
	 */
	function wp_notes_header() {
		wp_notes_header_nav();
		wp_notes_show_header_icons();
	}

	add_action( 'wp_notes_header_hook', 'wp_notes_header' );
}

if ( ! function_exists( 'wp_notes_theme_settings' ) ) {
	function wp_notes_theme_settings() {
		$vars = ':root {	
	            --wp_notes-branding-color: ' . get_theme_mod( "color_primary_color", "#EC7160" ) . ';
	            --wp_notes-branding-accent-color: ' . get_theme_mod( "color_primary_accent_color", "#DA5745" ) . ';
	            --wp_notes-primary-color: ' . get_theme_mod( "color_1", "#303030" ) . ';
	            --wp_notes-secondary-color: ' . get_theme_mod( "color_2", "#898989" ) . ';
	            --wp_notes-tertiary-color: ' . get_theme_mod( "color_3", "#E7E7E9" ) . ';
	            --wp_notes-quaternary-color: ' . get_theme_mod( "color_4", "#F6F6F6" ) . ';
	            --wp_notes-quinary-color: ' . get_theme_mod( "color_5", "#F9F9F9" ) . ';
	        
			}';

		?>
        <style>
            <?php echo esc_html($vars); ?>
        </style>
		<?php
	}
}
add_action( 'wp_head', 'wp_notes_theme_settings' );

if ( ! function_exists( 'wp_notes_reply_title' ) ) {
	function wp_notes_reply_title( $defaults ) {
		$defaults['title_reply_before'] = '<h3 id="reply-title" class="h2 comment-reply-title">';
		$defaults['title_reply_after']  = '</h3>';

		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'wp_notes_reply_title' );


/**
 * Get blog posts page URL.
 *
 * @return string The blog posts page URL.
 */
if ( ! function_exists( 'wp_notes_get_sidebar_button' ) ) {
	function wp_notes_get_sidebar_button() {

		// If front page is set to display a static page, get the URL of the posts page.
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$wp_notes_blog_page_url = get_permalink( get_option( 'page_for_posts' ) );
			printf( '<div class="c-sidebar__footer"><a class="c-btn c-btn--secondary c-btn--fw" href="%s">%s</a></div>',
				esc_url( $wp_notes_blog_page_url ),
				esc_html__( 'All Posts', 'wp-notes' ) );
		}

		if ( get_theme_mod( 'blog_content', true ) ) {
			printf( '<div class="c-sidebar__footer"><a class="c-btn c-btn--secondary c-btn--fw" href="%s">%s</a></div>',
				esc_url( get_home_url() ),
				esc_html__( 'All Posts', 'wp-notes' ) );
		}
	}
}


/**
 * Homepage - Show latest sticky post
 */

if ( ! function_exists( 'wp_notes_show_latest_post' ) ) {
	function wp_notes_show_latest_post() {
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

if ( ! function_exists( 'wp_notes_get_excerpt' ) ) {
	function wp_notes_get_excerpt() {
		if ( get_theme_mod( 'limit_sidebar_posts_excerpt_toggle', false ) ) {
			$count   = get_theme_mod( 'limit_sidebar_posts_excerpt', 100 );
			$excerpt = get_the_content();
			$excerpt = strip_tags( $excerpt );
			$excerpt = substr( $excerpt, 0, $count + 1 );
			$excerpt = $excerpt . '...';

			return $excerpt;
		} else {
			return get_the_excerpt();
		}
	}
}

if ( ! function_exists( 'wp_notes_is_page_for_posts' ) ) {
	function wp_notes_is_page_for_posts() {
		$result = false;

		if ( is_home() && ! is_front_page() ) {
			$page = get_queried_object();

			$result = ! is_null( $page ) && $page->ID == get_option( 'page_for_posts' );
		}

		return $result;
	}
}
