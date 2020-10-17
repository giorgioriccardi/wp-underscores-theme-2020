<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Latitude51
 */

?>

<footer id="colophon" class="site-footer">
    <div class="site-info">
        <!-- ssws -->
        <?php
		echo date_i18n(
			/* translators: Copyright date format, see https://www.php.net/date */
			_x('Y', 'copyright date format', 'latitude51')
		);
		?>

        &copy;

        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>

        <?php
		printf(esc_html__('All Rights Reserved', 'latitude51'));
		?>

        <span class="sep"> | </span>

        <a href="<?php echo esc_url(__('https://sosmediacorp.com/', 'latitude51')); ?>">
            <?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf(esc_html__('Edmonton Web Design & Development'), 'latitude51');
			?>
        </a>

        <?php
		printf(esc_html__('by SOS Media Corp', 'latitude51'));
		?>
    </div><!-- .site-info -->

    <nav aria-label="<?php esc_attr_e('Footer', 'latitude51'); ?>" role="navigation" class="debug footer-menu-wrapper">

        <ul class="footer-menu reset-list-style">
            <?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
        </ul>

    </nav><!-- .footer-menu-wrapper -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>