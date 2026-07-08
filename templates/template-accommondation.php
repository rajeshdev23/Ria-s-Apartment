<?php
/**
 * Template Name: Accommondation Template
 */
get_header();
$language = pll_current_language();
if (have_rows("view_all_photos_gallery")):
    ?>
    <style>
        .gallery-popup .btn-close {
            background: url("https://staging.riasapartment.com/wp-content/uploads/2025/12/icons8-close-80-1.png");
            position: fixed;
        }
    </style>
    <div class="modal gallery-popup" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <!-- Required wrapper -->
            <div class="modal-content">
                <!-- Required wrapper -->
                <div class="modal-body p-0">
                    <!-- Optional: no padding -->
                    <section class="gallery">
                        <div class="container">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="gallery__wrapper">
                                <div class="gallery__contents">
                                    <div class="gallery-popup__content">
                                        <div class="accommodation-bottom-block" id="view_all_gallery_imageId" >
                                            <div class="accommodation-sizer"></div>
                                            <?php while (have_rows("view_all_photos_gallery")):
                                                the_row();
                                                $image = get_sub_field("image");
                                                ?>
                                                <div class="accommodation__img">
                                                    <a class="view_all_light_box_img" href="<?= $image['url'] ?>"><img src="<?= $image['url'] ?>"   alt="<?= $image['title'] ?>"></a>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;
?>
<section class="hero__main accomodation">
    <?php
    // Clean field names (no curly quotes)
    $rtitle = ($language == 'el') ? get_field('rias_apartment_title_gr') : get_field('rias_apartment_title');
    $rviewalltext = ($language == 'el') ? get_field('view_all_photos_text_gr') : get_field('view_all_photos_text');
    $rleftImage = get_field('rias_apartment_big_image');
    ?>
    <div class="container">
        <div class="accomodation__top d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <?php if (!empty($rtitle)): ?>
                <h1 class="section-head-big">
                    <?= esc_html($rtitle); ?>
                </h1>
            <?php endif; ?>

            <?php if (!empty($rviewalltext)): ?>
                <button type="button" class="btn-theme btn-primary" data-bs-toggle="modal" data-bs-target="#galleryModal">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/accomodation-image/viewicon.png'); ?>"
                        alt="view icon">
                    <span><?= esc_html($rviewalltext); ?></span>
                </button>
            <?php endif; ?>
        </div>
        <div class="accomodation__bottom" id="accomodationGallery">
            <?php if (!empty($rleftImage)): ?>
                <div class="accomodation__item-wrapper">
                    <div class="accomodation__bottom-item">
                        <a href="<?= esc_url($rleftImage['url']); ?>" class="accomodation__hero-img">
                            <img src="<?= esc_url($rleftImage['url']); ?>" alt="<?= esc_attr($rleftImage['title']); ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (have_rows("rias_apartment_right_gallery")): ?>
                <div class="accomodation__item-wrapper">
                    <div class="accomodation__grid">
                        <?php while (have_rows("rias_apartment_right_gallery")):
                            the_row();
                            $image = get_sub_field("image");
                            ?>
                            <div class="accomodation__grid-item">
                                <a href="<?= esc_url($image['url']); ?>" class="accomodation__hero-img">
                                    <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['title']); ?>">
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="accomondation-content">
    <div class="container">
        <div class="accomondation-content__wrapper d-lg-flex">
            <div class="accomondation-content__item">
                <?php
                $sTitl = ($language == 'el') ? get_field('spacious_urban_heading_gr') : get_field('spacious_urban_heading');
                ?>
                <?php if (!empty($sTitl)): ?>
                    <h3 class="section-head-main resize-content"><?= esc_html($sTitl); ?></h3>
                <?php endif; ?>
                <?php if (have_rows('spacious_urban_features')): ?>
                    <div class="d-flex gap-4 flex-wrap">
                        <?php while (have_rows('spacious_urban_features')):
                            the_row();
                            $icon = get_sub_field('spacious_urban_features_icon');
                            $text = ($language == 'el')
                                ? get_sub_field('spacious_urban_features_text_gr')
                                : get_sub_field('spacious_urban_features_text');
                            ?>
                            <div class="feature-highlight-item">
                                <?php if (!empty($icon)): ?>
                                    <img src="<?= esc_url($icon['url']); ?>" alt="<?= esc_attr($icon['title']); ?>">
                                <?php endif; ?>
                                <?php if (!empty($text)): ?>
                                    <span><?= esc_html($text); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="accomondation-content__item">
                <?php
                $full_text = ($language == 'el') ? get_field('spacious_urban_content_gr') : get_field('spacious_urban_content');
                if ($full_text):
                    // Remove HTML tags for accurate word counting
                    $plain_text = strip_tags($full_text);
                    $words = explode(' ', $plain_text);
                    $max_words = 48;

                    if (count($words) > $max_words) {
                        $visible_text = implode(' ', array_slice($words, 0, $max_words));
                        $hidden_text = implode(' ', array_slice($words, $max_words));
                        ?>

                        <p class="section-head-brief text-start">
                            <?= esc_html($visible_text); ?><span class="dots">...</span>
                            <span class="collapse" id="readMoreContent">
                                <?= esc_html($hidden_text); ?>
                            </span>
                        </p>
                        <?php
                        $readMoreText = ($language == 'el') ? 'Διαβάστε περισσότερα' : 'Read more';
                        ?>
                        <button class="btn-theme btn-primary align-self-center" type="button" id="btn-content">
                            <span><?= $readMoreText; ?></span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>

                        <?php
                    } else {
                        echo '<p class="section-head-brief text-start">' . esc_html($full_text) . '</p>';
                    }
                endif;
                ?>
            </div>
        </div>
        <?php if (have_rows('content_cards')): ?>
            <div class="content__cards">
                <div class="row row-cols-1 row row-cols-md-2 row-cols-lg-3 g-4">
                    <?php while (have_rows('content_cards')):
                        the_row();
                        $cicon = get_sub_field('content_card_icon');
                        $ctitle = ($language == 'el') ? get_sub_field('content_card_title_gr') : get_sub_field('content_card_title');
                        $ctext = ($language == 'el') ? get_sub_field('content_card_text_gr') : get_sub_field('content_card_text');
                        ?>
                        <div class="col">
                            <div class="accomondation-content__card  d-flex flex-column align-items-center text-center">
                                <?php if ($cicon): ?>
                                    <div class="icon">
                                        <img src="<?= $cicon['url']; ?>" alt="<?= $cicon['title']; ?>">
                                    </div>
                                <?php endif;
                                if ($ctitle):
                                    ?>
                                    <span class="content-title"><?= $ctitle; ?></span>
                                    <?php
                                endif;
                                if ($ctext):
                                    ?>
                                    <p><?= $ctext; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<section id="CheckAvailabilityId" class="Check-availability">
    <div class="container">
        <div class="booking-container">
            <div class="calendar-section">
                <?php
                if ($language === "el") {
                    echo do_shortcode('[mphb_availability_calendar id="1063"]');

                } else {
                    echo do_shortcode('[mphb_availability_calendar id="594"]');

                }
                ?>

            </div>

            <!-- Booking Panel - RIGHT SIDE -->
            <div class="booking-panel">
                <?php
                if ($language === 'el') {
                    echo do_shortcode('[mphb_availability id="1063"]');

                } else {
                    echo do_shortcode('[mphb_availability id="594"]');

                }

                ?>
            </div>
        </div>
    </div>
</section>
<?php
$gstitle = ($language == 'el') ? get_field('guest_services_title_gr') : get_field('guest_services_title');
$gsubtitle = ($language == 'el') ? get_field('guest_services_subtitle_gr') : get_field('guest_services_subtitle');
?>
<section id="guest-servicesId" class="guest-services">
    <div class="container">
        <div class="guest-services__wrapper">
            <?php if ($gstitle): ?>
                <h3 class="section-head-main fw-bold"> <?= $gstitle; ?></h3>
            <?php endif ?>
            <?php if ($gsubtitle): ?>
                <p class="subtitle"> <?= $gsubtitle; ?></p>
            <?php endif ?>
            <?php if (have_rows('guest_services__listings')): ?>
                <div class="guest-row">
                    <!-- Transport & Mobility -->
                    <?php while (have_rows('guest_services__listings')):
                        the_row();
                        $gtitle = ($language == 'el') ? get_sub_field('guest_services_listing_title_gr') : get_sub_field('guest_services_listing_title');
                        $gticon = get_sub_field('guest_services_listing_icon');
                        ?>
                        <div class="guest-card mb-4">
                            <?php if ($gticon): ?>
                                <div class="guestService-icon"><?php echo $gticon; ?></div>
                            <?php endif; ?>
                            <h5><?= $gtitle; ?></h5>
                            <?php if (have_rows('guest_services_listing_ponits')):

                                ?>
                                <ul class="guest-list section-head-brief">
                                    <?php while (have_rows('guest_services_listing_ponits')):
                                        the_row();
                                        $gitem = ($language == 'el') ? get_sub_field('guest_services_listing_points_title_gr') : get_sub_field('guest_services_listing_points_title');
                                        $giteminfo = ($language == 'el') ? get_sub_field('guest_services_listing_points_tooltip_text_gr') : get_sub_field('guest_services_listing_points_tooltip_text');
                                        ?>
                                        <li><?= $gitem; ?>
                                            <?php if ($giteminfo): ?>
                                                <span class="info-icon" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?= $giteminfo; ?>">
                                                    i
                                                </span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endwhile; ?>

                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php
            $gnote = ($language == 'el') ? get_field('guest_services_notes_gr') : get_field('guest_services_notes');
            ?>
            <div class="note subtitle">
                *<?= $gnote; ?>
            </div>
        </div>
    </div>
</section>
<?php //endif; ?>
<section class="amenities">
    <div class="container">
        <div class="amenities__wrapper">
            <?php
            $aTitle = ($language == 'el') ? get_field('amenities_heading_gr') : get_field('amenities_heading');
            if (!empty($aTitle)):
                ?>
                <h3 class="section-head-main amenities-title"><?= esc_html($aTitle); ?></h3>
            <?php endif;

            if (have_rows('amenities_popup_data')):
                ?>
                <div class="accordion amenities__accordion amenities-block" id="accordionAmenities">
                    <?php
                    $n = 1;
                    while (have_rows('amenities_popup_data')):
                        the_row();
                        $ptitle = ($language == 'el') ? get_sub_field('amenities_heading_gr') : get_sub_field('amenities_heading');
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button <?= ($n !== 1) ? 'collapsed' : ''; ?>" type="button"
                                    aria-expanded="<?= ($n === 1) ? 'true' : 'false'; ?>" aria-controls="collapse<?= $n; ?>">
                                    <?= esc_html($ptitle); ?>
                                </button>
                            </h2>
                            <?php if (have_rows('amenities_points')): ?>
                                <div id="collapse<?= $n; ?>" class="accordion-collapse collapse <?= ($n === 1) ? 'show' : ''; ?>"
                                    data-bs-parent="#accordionAmenities">
                                    <div class="accordion-body">
                                        <?php
                                        while (have_rows('amenities_points')):
                                            the_row();
                                            $pntTitle = ($language == 'el') ? get_sub_field('points_text_gr') : get_sub_field('points_text');
                                            ?>
                                            <div class="amenities-highlight-item">
                                                <?php if ($icon = get_sub_field('icon')): ?>
                                                    <img src="<?= esc_url($icon['url']); ?>" alt="<?= esc_attr($icon['title']); ?>">
                                                <?php endif; ?>

                                                <?php if ($pntTitle): ?>
                                                    <span><?= esc_html($pntTitle); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                        $n++;
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>
            <?php
            $viewAllTxt = ($language == 'el') ? 'Δείτε όλες τις παροχές' : 'View all amenities';
            ?>
            <button class="btn btn-theme btn-primary align-self-center mb-3 d-none" type="button" id="toggle-amenities"
                data-view-all="<?= esc_attr($viewAllTxt); ?>"
                data-hide-text="<?= ($language == 'el') ? 'Λιγότερες παροχές' : 'Hide amenities'; ?>">
                <span><?= $viewAllTxt; ?></span>
                <i class="fa-solid amenity-arrow fa-arrow-down"></i>
            </button>
        </div>
    </div>
</section>

<?php if (get_field("review_score_button")): ?>
    <section class="review">
        <div class="container">
            <div class="review__wrapper">
                <div class="review__score flex-grow-1">
                    <div class="score-itemone d-flex align-items-center">
                        <div class="score-block"><?= get_field("review_score"); ?></div>
                        <div class="score-text d-flex flex-column">
                            <span
                                class="subtext"><?= ($language === "el") ? get_field("review_score_text_gr") : get_field("review_score_text"); ?></span>

                        </div>
                        <div class="review__star">
                            <div class="review__itemone"><span><img
                                        src="<?php echo get_template_directory_uri(); ?>/assets/images/accomodation-image/star.png"
                                        alt=""></span><span><?= get_field("review_score_ratings_number"); ?></span></div>

                        </div>
                    </div>
                    <style>
                        .score-itemtwo {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 20px;
                        }
                    </style>
                    <?php if (have_rows('review_ratings')): ?>
                        <div class="score-itemtwo">

                            <?php while (have_rows('review_ratings')):
                                the_row();

                                // Get translated title
                                $title = ($language === "el")
                                    ? get_sub_field('title_gr')
                                    : get_sub_field('title');

                                // Get numeric score safely
                                $score = get_sub_field('score');
                                $score = is_numeric($score) ? floatval($score) : 0;

                                // Calculate percentage
                                $percentage = ($score / 10) * 100;
                                ?>

                                <div class="progress-item">
                                    <span><?php echo esc_html($title); ?></span>

                                    <div class="review-progress-block">

                                        <div class="rating-bar flex-grow-1">
                                            <div class="rating-fill" style="width: <?php echo esc_attr($percentage); ?>%;">
                                            </div>
                                        </div>

                                        <a href="#!" class="star-number">
                                            <?php echo esc_html($score); ?>
                                        </a>

                                    </div>
                                </div>

                            <?php endwhile; ?>

                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </section>
    <section class="testimonial__section accomodation-testimonial">
        <div class="container">
            <div class="row g-3">
                <?php echo do_shortcode("[trustindex no-registration=google]"); ?>
                <?php echo do_shortcode("[trustindex no-registration=airbnb]"); ?>
                <?php echo do_shortcode('[trustindex no-registration=booking]'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="location__section accomodation-location pb-md-2 pb-lg-0">
    <div class="container">
        <div class="location__section--head mx-auto">
            <?php
            $lTitle = ($language == 'el') ? get_field('your_location_title_gr') : get_field('your_location_title');
            $lButton = ($language == 'el') ? get_field('view_on_map_button_gr') : get_field('view_on_map_button');
            $target = $lButton['target'] ? $lButton['target'] : '_self';
            if (!empty($lTitle)):
                ?>
                <h3 class="section-head-main mb-3"><?= $lTitle; ?></h3>
                <?php
            endif;
            if (!empty($lButton)):
                ?>
                <a target="<?= $target; ?>" href="<?= $lButton['url']; ?>" class="btn-theme btn-primary">
                    <span><?= $lButton['title']; ?></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>
        <?php
        if (have_rows('your_locations')):
            ?>
            <div class="location__feature mt-4">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php
                    while (have_rows('your_locations')):
                        the_row();
                        $lcIcon = get_sub_field('location_icon');
                        $clText = ($language == 'el') ? get_sub_field('location_title_gr') : get_sub_field('location_title');
                        ?>
                        <div class="col" bis_skin_checked="1">
                            <div class="amenities-highlight-item" bis_skin_checked="1">
                                <?php if ($lcIcon) ?>
                                <img src="<?= $lcIcon['url']; ?>" alt="<?= $lcIcon['title']; ?>">
                                <?php
                                if ($clText):
                                    ?>
                                    <span><?= $clText; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif;
        if (shortcode_exists('display_map_shortcode')):
            ?>
            <div class="location__section--view__box">
                <?php echo do_shortcode('[display_map_shortcode]'); ?>
            </div>
            <?php
        endif;
        $mText = ($language == 'el') ? get_field(
            'map_bottom_text_gr',
        ) : get_field('map_bottom_text');
        if ($mText):
            ?>
            <p class="accomodation-location__text">
                <?= $mText; ?>
            </p>
        <?php endif; ?>


    </div>
</section>
 <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

  var grids = document.querySelectorAll('.accommodation-bottom-block');
  var masonryInstances = [];

  grids.forEach(function (grid) {

    var msnry = new Masonry(grid, {
      itemSelector: '.accommodation__img',
      columnWidth: '.accommodation-sizer',
      gutter: 16,
      percentPosition: true
    });

    masonryInstances.push(msnry);

    imagesLoaded(grid, function () {
      msnry.layout();
    });

  });

  // 🔥 CRITICAL FIX: re-layout when modal opens
  var modal = document.getElementById('galleryModal');

  if (modal) {
    modal.addEventListener('shown.bs.modal', function () {
      masonryInstances.forEach(function (msnry) {
        msnry.layout();
      });
    });
  }

});
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
const guests = document.querySelector('.guest-services'); // or any selector

if (guests) { 
  const tooltipTriggerList = [].slice.call(
    guests.querySelectorAll('[data-bs-toggle="tooltip"]')
  );

  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });
}
});
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const guests = document.querySelector('.guest-services');

        if (guests) {
            const tooltipTriggerList = [].slice.call(
                guests.querySelectorAll('[data-bs-toggle="tooltip"]')
            );

            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl, {
                    customClass: 'custom-tooltip'
                });
            });
        }
    });
</script>

<?php
get_footer();
?>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Accordion: fully manual (no Bootstrap toggle) ──────────────────
        const accordion = document.getElementById('accordionAmenities');

        if (accordion) {
            accordion.querySelectorAll('.accordion-button').forEach((button) => {
                button.addEventListener('click', function () {
                    const targetId = this.getAttribute('aria-controls');
                    const target = document.getElementById(targetId);
                    if (!target) return;

                    const isOpen = target.classList.contains('show');

                    if (isOpen) {
                        // Close it
                        target.classList.remove('show');
                        this.classList.add('collapsed');
                        this.setAttribute('aria-expanded', 'false');
                    } else {
                        // Close every other open panel first
                        accordion.querySelectorAll('.accordion-collapse.show').forEach((openPanel) => {
                            openPanel.classList.remove('show');
                        });
                        accordion.querySelectorAll('.accordion-button:not(.collapsed)').forEach((openBtn) => {
                            openBtn.classList.add('collapsed');
                            openBtn.setAttribute('aria-expanded', 'false');
                        });

                        // Open this one
                        target.classList.add('show');
                        this.classList.remove('collapsed');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        }

         
        const toggleBtn = document.getElementById('toggle-amenities');
        if (!accordion || !toggleBtn) {
            return;
        }

        const accordionItems = Array.from(accordion.querySelectorAll('.accordion-item'));
        const btnText = toggleBtn.querySelector('span');
        const siteLang = "<?php echo pll_current_language(); ?>";
        const viewAllTxt = siteLang === 'el'
            ? (toggleBtn.getAttribute('data-view-all') || '')
            : 'View more';
        const hideTxt = siteLang === 'el'
            ? (toggleBtn.getAttribute('data-hide-text') || '')
            : 'View less';
        const visibleCount = 3;
        let expanded = false;

        function closeHiddenPanels() {
            accordionItems.forEach((item, index) => {
                if (index < visibleCount) {
                    return;
                }

                const collapse = item.querySelector('.accordion-collapse');
                const button = item.querySelector('.accordion-button');

                if (collapse) {
                    collapse.classList.remove('show');
                }

                if (button) {
                    button.classList.add('collapsed');
                    button.setAttribute('aria-expanded', 'false');
                }
            });
        }

        function updateToggleState() {
            accordionItems.forEach((item, index) => {
                item.classList.toggle('hidden-amenity', index >= visibleCount);
            });

            if (accordionItems.length <= visibleCount) {
                expanded = false;
                accordion.classList.remove('is-expanded');
                toggleBtn.classList.remove('is-expanded');
                toggleBtn.classList.add('d-none');
                btnText.textContent = viewAllTxt;
                closeHiddenPanels();
                return;
            }

            toggleBtn.classList.remove('d-none');
            accordion.classList.toggle('is-expanded', expanded);
            toggleBtn.classList.toggle('is-expanded', expanded);
            btnText.textContent = expanded ? hideTxt : viewAllTxt;

            if (!expanded) {
                closeHiddenPanels();
            }
        }

        updateToggleState();

        // Toggle button click event
        toggleBtn.addEventListener('click', function () {
            expanded = !expanded;
            accordion.classList.toggle('is-expanded', expanded);
            toggleBtn.classList.toggle('is-expanded', expanded);
            btnText.textContent = expanded ? hideTxt : viewAllTxt;

            if (expanded) {
                return;
            }

            closeHiddenPanels();

            setTimeout(function () {
                const btnTop = toggleBtn.getBoundingClientRect().top + window.pageYOffset;
                const scrollTo = btnTop - window.innerHeight + toggleBtn.offsetHeight + 40;
                window.scrollTo({ top: scrollTo, behavior: 'smooth' });
            }, 200);
        });
    });
    
</script>
<style>
    /* Hide amenities after the 3rd one unless container is expanded */
    #accordionAmenities:not(.is-expanded) .hidden-amenity {
        display: none;
    }

    #accordionAmenities.is-expanded .hidden-amenity {
        display: block;
    }

    /* Rotate arrow based on button class */
    #toggle-amenities.is-expanded .amenity-arrow {
        transform: rotate(180deg);
    }

    .amenity-arrow {
        transition: transform 0.3s ease;
    }
   
</style>

<script>
    jQuery(document).ready(function ($) {

    var siteLang = "<?php echo pll_current_language(); ?>";

    const TEXT = {
        readMore: siteLang === 'el' ? 'Διαβάστε περισσότερα' : 'Read more',
        readLess: siteLang === 'el' ? 'Λιγότερα' : 'Read less'
    };

    const $btn = $('#btn-content');
    const $btnText = $btn.find('span');
    const $content = $('#readMoreContent');
    const $dots = $('.dots');

    let expanded = false;

    // INITIAL STATE
    $btnText.text(TEXT.readMore);
    $content.hide();

    // TOGGLE
    $btn.on('click', function () {

        if (!expanded) {
            expanded = true;

            $content.slideDown(200); // smoother than show()
            $dots.hide();
            $btnText.text(TEXT.readLess);

        } else {
            expanded = false;

            $content.slideUp(200);
            $dots.show();
            $btnText.text(TEXT.readMore);

            // optional scroll (same behavior as 2nd block)
            setTimeout(function () {
                const btnTop = $btn.offset().top;
                const scrollTo = btnTop - window.innerHeight + $btn.outerHeight() + 40;

                window.scrollTo({ top: scrollTo, behavior: 'smooth' });
            }, 200);
        }
    });

    // REQUIRED TEXT
    const reqrdText = siteLang === 'el'
        ? 'Τα υποχρεωτικά πεδία ακολουθούνται από...'
        : 'Required fields are followed by...';

    $(".mphb-required-fields-tip small").text(reqrdText);

});

    jQuery(document).ready(function ($) {

        var lang = "<?php echo pll_current_language(); ?>";

        // ========= TEXTS PER LANGUAGE =========
        var checkInLabel = (lang === 'el') ? 'Ημερομηνία Άφιξης' : 'Check-in Date';
        var checkInPlaceholder = (lang === 'el') ? 'Ημερομηνία Άφιξης' : 'Check-in Date';

        var checkOutLabel = (lang === 'el') ? 'Ημερομηνία Αναχώρησης' : 'Check-out Date';
        var checkOutPlaceholder = (lang === 'el') ? 'Ημερομηνία Αναχώρησης' : 'Check-out Date';


        // ========= UPDATE CHECK-IN LABEL =========
        $(".mphb-check-in-date-wrapper label").contents().filter(function () {
            return this.nodeType === 3; // text node
        }).first().replaceWith(checkInLabel + " ");

        // ========= UPDATE CHECK-IN PLACEHOLDER =========
        $(".mphb-check-in-date-wrapper input.mphb-datepick")
            .attr("placeholder", checkInPlaceholder);



        // ========= UPDATE CHECK-OUT LABEL =========
        $(".mphb-check-out-date-wrapper label").contents().filter(function () {
            return this.nodeType === 3; // text node
        }).first().replaceWith(checkOutLabel + " ");

        // ========= UPDATE CHECK-OUT PLACEHOLDER =========
        $(".mphb-check-out-date-wrapper input.mphb-datepick")
            .attr("placeholder", checkOutPlaceholder);

    });


    $(document).ready(function () {

        lightGallery(document.getElementById('accomodationGallery'), {
            licenseKey: '0000-0000-000-0000', // Optional, replace with your license key if needed
            selector: '.accomodation__hero-img',
            speed: 500,
            thumbnail: true,
            zoom: true,
            download: false,
            controls: true,
            actualSize: true,
            counter: true,
            plugins: [lgThumbnail, lgZoom],
        });

        lightGallery(document.getElementById('view_all_gallery_imageId'), {
            licenseKey: '0000-0000-000-0000', // Optional, replace with your license key if needed
            selector: '.view_all_light_box_img',
            speed: 500,
            thumbnail: true,
            zoom: true,
            download: false,
            controls: true,
            actualSize: true,
            counter: true,
            plugins: [lgThumbnail, lgZoom],
        });
    });
</script>
