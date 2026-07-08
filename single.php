<?php
/**
 * The template for displaying all single posts
 *
 * @package ria\'s-apartment
 */

get_header();
?>

<section class="gallery hero__main">
    <div class="container">
        <div class="gallery__wrapper">

            <div class="title_box">
                <h2><?php the_title(); ?></h2>
            </div>

            <div class="featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>

            <?php
while (have_posts()):
    the_post();
    the_content();
endwhile;
?>

            <!-- ================= REVIEWS SECTION ================= -->

            <div class="reviews-section">
                <h3>Guest Reviews</h3>

                <?php
// Show MotoPress Reviews
echo do_shortcode("[mphb_accommodation_reviews id='595']");
?>
            </div>

            <div class="review-form-section">
                <h3>Leave a Review</h3>

                <?php
// Load Review Form for Accommodation
$accommodation_id = 595; // 🔁 change if needed

global $post;
$temp_post = $post;

// Switch to accommodation post
$post = get_post($accommodation_id);
setup_postdata($post);

// Load comment template (review form)
comments_template();

// Restore original post
$post = $temp_post;
wp_reset_postdata();
?>
            </div>

            <!-- ================= END REVIEWS ================= -->

        </div>
    </div>
</section>

<?php
get_footer();