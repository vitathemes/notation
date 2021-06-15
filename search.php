<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Notation
 */

get_header();
?>

    <main id="primary" class="c-main js-main">

    <div class="c-main__header">
        <h1 class="c-main__title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'notation' ), '<span>' . get_search_query() . '</span>' );
			?>
        </h1>
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

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; ?>
            <div class="c-pagination s-pagination">
				<?php
				notation_posts_pagination();
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
