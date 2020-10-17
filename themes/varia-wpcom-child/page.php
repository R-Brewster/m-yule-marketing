<?php
/**
 * The template for displaying all single posts
 *
 */

get_header();
?>

	<section id="primary" class="content-area varia-wpcom-child">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

    <?php if(is_user_logged_in()):
        include('sidebar.php');
    endif;?>

<?php
get_footer();
