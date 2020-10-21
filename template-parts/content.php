<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Latitude51
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-box">
        <header class="entry-header">
            <?php
		
		// SSWS btn for post category
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			echo '<div><button class="cat-btn"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></button></div>';
		}

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
            <div class="entry-meta">
                <?php
				latitude51_posted_by();
				latitude51_posted_on();
				latitude51_entry_footer();
				?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
		// the_content(
		the_excerpt(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'latitude51' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'latitude51' ),
				'after'  => '</div>',
			)
		);
		?>
        </div><!-- .entry-content -->
    </div><!-- .content-box -->

    <?php latitude51_post_thumbnail(); ?>

    <!-- <footer class="entry-footer"> -->
    <?php // latitude51_entry_footer(); ?>
    <!-- </footer>.entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->