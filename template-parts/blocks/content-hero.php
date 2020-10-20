<?php
/**
 * Block Name: Hero
 * 
 * Template part for displaying hero section on front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Latitude51
 */
?>

<?php
// SSWS ACF BLOCKS
// ver 2.0

// create id attribute for specific styling
$id = 'hero-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// ACF field variables
$hero_image = get_field('hero_image');
$title = get_field('title');
$content = get_field('content');
$cta_link = get_field('link');
?>

<section id="<?php echo $id; ?>" class="hero-wrapper <?php echo $align_class; ?> latitude51-<?php echo $id; ?>"
    style="background-image: url(<?php echo $hero_image; ?>);">

    <!-- Hero Section Title -->
    <?php if ($title) : ?>
    <h2><?php echo $title; ?></h2>
    <?php endif; ?>

    <!-- Hero Section Content -->
    <?php if ($content) : ?>
    <div class="hero-content-wrapper">
        <p><?php echo $content; ?></p>
    </div>
    <?php endif; ?>

    <!-- Hero Section CTA -->
    <?php if ($cta_link) : ?>
    <button class="cta-btn"><a class="cta-link" href="<?php echo $cta_link['url']; ?>"
            target="<?php echo $cta_link['target']; ?>"><?php echo $cta_link['title']; ?></a></button>
    <?php endif; ?>
</section>