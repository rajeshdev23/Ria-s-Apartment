<?php
/* Template Name: Vik Booking Search Results */
get_header();
?>

<main id="primary" class="site-main">
    <?php
    // Output Vik Booking search results
    echo do_shortcode('[vikbooking view="vikbooking"]');
    ?>
</main>

<?php
get_footer();
