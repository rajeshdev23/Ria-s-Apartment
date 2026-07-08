<?php
/**
 * Template Name: Single Accommodation Template
 * 
 */

get_header();
?>

<section class="gallery hero__main hhelo">
    <div class="container">
        <div class="gallery__wrapper">
            

            <div class="title_box">
                <h2><?php the_title(); ?></h2>
            </div>

            <?php
while (have_posts()):
    the_post();

    // IMPORTANT: Initialize MotoPress room type
    global $mphb_room_type;
    $mphb_room_type = new \MPHB\Entities\RoomType(get_the_ID());
?>

            <!-- Featured Image -->
            <div class="featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>

            <!-- Gallery Images -->
            <div class="accommodation-gallery">
                <?php mphb_tmpl_the_room_type_gallery(); ?>
            </div>

            <!-- DETAILS -->
            <div class="accommodation-details">
                <?php mphb_tmpl_the_room_type_attributes(); ?>
            </div>

            <!-- PRICE -->
            <div class="accommodation-price">
                <?php mphb_tmpl_the_room_type_price(); ?>
            </div>
            <h3>==============================================================</h3>

            <!-- DESCRIPTION -->
            <div class="accommodation-description">
                <?php the_content(); ?>
            </div>

            <!-- BOOKING FORM -->
            <div class="accommodation-booking">
                <?php mphb_tmpl_the_booking_form(); ?>
            </div>

            <?php
endwhile; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
