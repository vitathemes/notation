<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wp_notes
 */

get_header();
?>

<?php get_sidebar(); ?>

    <main id="primary" class="c-main js-main">
    <div class="c-main__wrapper">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
			?>
            <div class="c-pagination c-pagination--post-navigation">
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:',
								'wp-notes' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:',
								'wp-notes' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
				?>
            </div>
			<?php
		endwhile; // End of the loop.
		?>
    </div>
<?php
get_footer();
