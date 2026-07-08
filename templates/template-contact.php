<?php
/**
 * Template Name: Contact Template
 */
get_header();
$language = pll_current_language();
?>
<main class="hero__main">
    <div class="container">
        <div class="contact__main">
            <div class="contact__header">
                <?php
                $gTitle = ($language == 'el') ? get_field('get_in_touch_title_gr') : get_field('get_in_touch_title');
                $gText = ($language == 'el') ? get_field('get_in_touch_text_gr') : get_field('get_in_touch_text');
                $gMap = get_field('get_in_touch_map');
                if ($gTitle):
                    ?>
                    <h1 class="section-head-big"><?= $gTitle; ?></h1>
                <?php endif;

                if ($gText):
                    ?>
                    <p class="section-head-brief text-start"><?= $gText; ?></p>
                <?php endif; ?>
            </div>
            <div class="row g-4">
                <?php if (shortcode_exists('display_map_shortcode')): ?>
                    <div class="col-lg-4 col-md-12">
                        <div class="contact__map-area">
                            <?php echo do_shortcode('[display_map_shortcode]'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-8 col-md-12">
                    <!-- Right Side - Contact Form -->
                    <div class="contact__form-section mt-4 mt-md-0">
                        <?php
                        if ($language == 'el') {
                            echo do_shortcode('[contact-form-7 id="08b0e49" title="Greek Contact Form"]');

                        } else {
                            echo do_shortcode('[contact-form-7 id="6456621" title="Contact form 1"]');

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
