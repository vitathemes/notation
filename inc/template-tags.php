<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wp_notes
 */

if ( ! function_exists( 'wp_notes_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_notes_posted_on() {
		$time_string = '<time class="c-post__date entry-date" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="c-post__date__published">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_notes_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_notes_posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'wp-notes' ),
			'<span class="author vcard"><a class="c-post__author__link url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="c-post__author byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_notes_comments_num' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_notes_comments_num() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( '%s Comments', 'post author', 'wp-notes' ),
			esc_html( get_comments_number() )
		);

		echo '<span class="c-post__comments"><a class="c-post__comments__link url fn n" href="' . get_the_permalink() . '#comments"> ' . $byline . '</a></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_notes_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wp_notes_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			if ( get_theme_mod( 'show_post_cats', true ) ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'wp-notes' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="c-post__cats">' . esc_html__( 'Categories: %1$s', 'wp-notes' ) . '</span>',
						$categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}

			if ( get_theme_mod( 'show_post_tags', true ) ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wp-notes' ) );
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="c-post__tags">' . esc_html__( 'Tags: %1$s', 'wp-notes' ) . '</span>',
						$tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wp-notes' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-notes' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'wp_notes_post_meta' ) ) :
	function wp_notes_post_meta() {
		if ( get_theme_mod( 'show_post_date', true ) ) {
			wp_notes_posted_on();
		}
		if ( get_theme_mod( 'show_post_date', true ) && get_theme_mod( 'show_post_author',
				true ) || get_theme_mod( 'show_post_comments', true ) && get_theme_mod( 'show_post_date', true ) ) {
			echo '<span class="c-post__meta__separator"> / </span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( get_theme_mod( 'show_post_author', true ) ) {
			wp_notes_posted_by();
		}
		if ( get_theme_mod( 'show_post_comments', true ) && get_theme_mod( 'show_post_author', true ) ) {
			echo '<span class="c-post__meta__separator"> / </span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( get_theme_mod( 'show_post_comments', true ) ) {
			wp_notes_comments_num();
		}
	}
endif;

if ( ! function_exists( 'wp_notes_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function wp_notes_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="c-post__thumbnail c-post__thumbnail--single s-post-thumbnail">
				<?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <a class="c-post__thumbnail s-post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'wp_notes_thumbnail_blog',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
            </a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'wp_notes_post_categories' ) ) {
	/**
	 * Show post categories
	 */
	function wp_notes_post_categories() {
		$categories = get_the_category();

		echo "<ul class='c-cats'>";

		foreach ( $categories as $category ) {
			echo sprintf( '<li class="c-cats__item"><a href="%s" class="c-cats__item__link">%s</a></li>',
				esc_url( get_category_link( $category->term_id ) ),
				esc_html( $category->name ) );
		}

		echo "</ul>";
	}
}

if ( ! function_exists( 'wp_notes_separator' ) ) {
	/**
	 * Dash separator
	 */
	function wp_notes_separator( $condition = true ) {
		if ( $condition ) {
			echo '<span class="o-separator">-</span>';
		}

		return null;
	}
}

if ( ! function_exists( 'wp_notes__share_links' ) ) {
	function wp_notes__share_links() {
		if ( get_theme_mod( 'show_share_icons', true ) ) {
			$wp_notes_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$wp_notes_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$wp_notes_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();

			echo '<div class="c-social-share">';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo sprintf( '<a class="c-social-share__link" target="_blank" href="%s"><svg class="c-social-share__link__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M8.46 18h2.93v-7.3h2.45l.37-2.84h-2.82V6.04c0-.82.23-1.38 1.41-1.38h1.51V2.11c-.26-.03-1.15-.11-2.19-.11-2.18 0-3.66 1.33-3.66 3.76v2.1H6v2.84h2.46V18z"/></g></svg></span></a>',
				esc_url( $wp_notes_facebook_url ) );
			echo sprintf( '<a class="c-social-share__link" target="_blank" href="%s"><svg class="c-social-share__link__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M18.94 4.46c-.49.73-1.11 1.38-1.83 1.9.01.15.01.31.01.47 0 4.85-3.69 10.44-10.43 10.44-2.07 0-4-.61-5.63-1.65.29.03.58.05.88.05 1.72 0 3.3-.59 4.55-1.57-1.6-.03-2.95-1.09-3.42-2.55.22.04.45.07.69.07.33 0 .66-.05.96-.13-1.67-.34-2.94-1.82-2.94-3.6v-.04c.5.27 1.06.44 1.66.46-.98-.66-1.63-1.78-1.63-3.06 0-.67.18-1.3.5-1.84 1.81 2.22 4.51 3.68 7.56 3.83-.06-.27-.1-.55-.1-.84 0-2.02 1.65-3.66 3.67-3.66 1.06 0 2.01.44 2.68 1.16.83-.17 1.62-.47 2.33-.89-.28.85-.86 1.57-1.62 2.02.75-.08 1.45-.28 2.11-.57z"/></g></svg></a>',
				esc_url( $wp_notes_twitter_url ) );
			echo sprintf( '<a class="c-social-share__link" target="_blank" href="%s"><svg class="c-social-share__link__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M2.5 18h3V6.9h-3V18zM4 2c-1 0-1.8.8-1.8 1.8S3 5.6 4 5.6s1.8-.8 1.8-1.8S5 2 4 2zm6.6 6.6V6.9h-3V18h3v-5.7c0-3.2 4.1-3.4 4.1 0V18h3v-6.8c0-5.4-5.7-5.2-7.1-2.6z"/></g></svg></a>',
				esc_url( $wp_notes_linkedin_url ) );
			echo '</div>';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}


if ( ! function_exists( 'wp_notes_posts_pagination' ) ) :
	/**
	 * Generate Posts Pagination
	 */
	function wp_notes_posts_pagination() {
		the_posts_pagination( array(
			'screen_reader_text' => ' ',
			'mid_size'           => 2,
			'prev_text'          => '<span class="dashicons dashicons-arrow-left-alt2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M14 5l-5 5 5 5-1 2-7-7 7-7z"/></g></svg></span>',
			'next_text'          => '<span class="dashicons dashicons-arrow-right-alt2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M6 15l5-5-5-5 1-2 7 7-7 7z"/></g></svg></span>',
		) );
	}
endif;


if ( ! function_exists( 'wp_notes_footer_credit_text' ) ) :
	/**
	 * Footer Credit Text
	 */
	function wp_notes_footer_credit_text() {
		$allowed_html = [
			'a'      => [
				'href'  => [],
				'title' => [],
			],
			'br'     => [],
			'em'     => [],
			'strong' => [],
			'p'      => [],
		];

		$wp_notes_credit = '<span>%s</span><a href="%s" class="customize-unpreviewable">%s</a>';
		echo wp_kses(
			sprintf( $wp_notes_credit,
				esc_html__( 'WP Notes theme by ', 'wp-notes' ),
				esc_url( 'https://vitathemes.com' ),
				esc_html__( 'VitaThemes', 'wp-notes' ) ),
			$allowed_html );

	}
endif;


if ( ! function_exists( 'wp_notes_footer_copyright_text' ) ) :
	/**
	 * Footer Credit Text
	 */
	function wp_notes_footer_copyright_text() {
		if ( get_theme_mod( 'copyright_text', '' ) ) {
			$allowed_html = [
				'a'      => [
					'href'  => [],
					'title' => [],
				],
				'br'     => [],
				'em'     => [],
				'strong' => [],
				'p'      => [],
			];

			$wp_notes_credit = '<p>%s</p>';
			echo wp_kses(
				sprintf( $wp_notes_credit,
					get_theme_mod( 'copyright_text', '' ) ),
				$allowed_html );
		}
	}
endif;
