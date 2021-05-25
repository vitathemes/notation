<?php

/**
 * WordPress Comment Walker
 *
 * @package     WordPress
 * @subpackage  Comment_Walker
 */
class Notation_walker_comment extends Walker_Comment {
	/**
	 * Output a comment in the HTML5 format. Don't worry, we're
	 * just extending default WordPress functionality.
	 *
	 * @access protected
	 *
	 * @param object $comment Comment to display.
	 * @param int $depth Depth of comment.
	 * @param array $args An array of arguments.
	 *
	 * @see wp_list_comments()
	 *
	 * @since 3.6.0
	 *
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		// Determine which tag we're using
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
        <<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '',
			$comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-meta">
                <div class="comment-avatar">
					<?php if ( $args['avatar_size'] !== 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					} ?>
                </div>

                <div class="comment-content">
                    <div class="comment-header">
						<?php
						if ( get_comment_author_url( $comment ) != "" ) {
							printf( '<div class="comment-author"><a href="%s">%s</a></div>',
								esc_html( esc_url( get_comment_author_url( $comment ) ) ),
								esc_html( esc_html( get_comment_author( $comment ) ) ) );
						} else {
							printf( '<div class="comment-author">%s</div>',
								esc_html( get_comment_author( $comment ) ) );
						}
						?>

                        <div class="time">
                            <time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								printf( '%1$s', esc_html( get_comment_date( '', $comment ) ) );
								?>
                            </time>
                        </div>
                    </div>

					<?php if ( ! $comment->comment_approved ): ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.',
								'notation' ); ?></p>
					<?php endif; ?>
                    <div class="comment-content__comment">
						<?php comment_text(); ?>
                    </div>
                    <div class="comment-content__reply">
	                    <?php
	                    // Output Reply link
	                    comment_reply_link( [
		                    'add_below' => 'div-comment',
		                    'depth'     => $depth,
		                    'max_depth' => $args['max_depth'],
	                    ] );
	                    ?>
                    </div>
					<?php
					// Output Edit link
					edit_comment_link( __( 'Edit', 'notation' ), '<span class="edit-link">', '</span>' );
					?>
                </div>
            </div>
        </article>
		<?php
	}
}
