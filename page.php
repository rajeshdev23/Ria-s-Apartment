<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ria\'s-apartment
 */

get_header();
$isContePage = get_field("is_content_page");
$isContePage = ($isContePage == "true") ? "default_content_page" : "";
?>

<section class="default_page hero__main <?= $isContePage ?>">
    <div class="container">
        <div class="title_box ">
            <h2 class="section-head-main"><?= the_title(); ?></h2>
        </div>

        <?php
        while (have_posts()):
            the_post();

            the_content();

        endwhile; // End of the loop.
        ?>

    </div>
</section>

<?php
//get_sidebar();
get_footer();

?>