<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Holo
 */

get_header();
?>

    <main id="primary" class="c-main">

        <div class="c-main__header">
			<?php
			the_archive_title( '<h1 class="c-main__title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
        </div>

    <div class="c-main__wrapper">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
                <header>
                    <h1 class="c-main__title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile; ?>
            <div class="c-pagination s-pagination">
				<?php
				holo_posts_pagination();
				?>
            </div>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
    </div>
<?php
get_footer();
