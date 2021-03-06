<?php

/**
 * Template Name: front-page
 * 
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Latitude51
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- SSWS: just render the page template content, which includes the Hero Blocks -->
    <div class="hero-main-container">
        <?php
	if (have_posts()) :

		/* Start the Loop */
		while (have_posts()) :
			the_post();

			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content', get_post_type());
			// get_template_part('template-parts/blocks/content', 'hero');

		endwhile;

		// SSWS no need for post nav on front-page
		// the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>
    </div><!-- end hero-wrapper -->

    <!-- SSWS: render the news posts -->
    <div class="fp-cat-title">
        <h1>News & Events</h1>
        <hr class="cat-title">
    </div>

    <div class="content-wrapper">

        <?php
	// SSWS
    $the_query = new WP_Query( array(
    'post_type'			=> 'post',
    'posts_per_page'	=> 3,
    'post_status'		=> 'publish',
	'cat'				=> '196,20', // news #196, events #20 // this does not show posts from any children of these categories)
	// 'page_name'			=> 'news-events',
	// others parameters here: https://developer.wordpress.org/reference/classes/wp_query/
    ) );

    if ($the_query->have_posts()) :

		/* Start the Loop */
		while ($the_query->have_posts()) :
			$the_query->the_post();

			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content', get_post_type());

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>
    </div><!-- end .content-wrapper -->

</main><!-- #main -->

<?php
get_sidebar();
get_footer();