<?php
/**
 * Template Name: Home Template
 */
get_header();
$language = pll_current_language();

?>
<style>
    body {
        max-width: 100% !important;
    }
</style>

<section class="hero__main <?php echo ($language === 'el') ? 'greek_hero' : ''; ?> ">
    <div class="container">
        <div class="hero__home">
            <div class="hero-image">
                <?php
                $media_type = get_field('banner_media_type') ?: 'image';
                $bnrImage = wp_is_mobile() ? get_field('banner_image_phone') : get_field('banner_image');
                if (!$bnrImage && wp_is_mobile()) {
                    $bnrImage = get_field('banner_image');
                }

                $video_file_raw = get_field('banner_video_file');
                $video_file_url = is_array($video_file_raw) ? ($video_file_raw['url'] ?? '') : $video_file_raw;

                $video_url_external = get_field('banner_video_url');
                ?>

                <?php if ($media_type === 'self_video' && $video_file_url): ?>

                    <video autoplay muted loop playsinline class="hero-video">
                        <source src="<?php echo esc_url($video_file_url); ?>" type="video/mp4">
                    </video>

                <?php elseif ($media_type === 'external_video' && $video_url_external): ?>
                    <?php
                    // ================== video url setup
                    $video_url = $video_url_external;
                    if (strpos($video_url, 'youtu') !== false) {
                        preg_match(
                            '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                            $video_url,
                            $match
                        );

                        $video_id = $match[1] ?? '';

                        if ($video_id): ?>
                            <iframe
                                src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo esc_attr($video_id); ?>&controls=0&modestbranding=1"
                                frameborder="0" allow="autoplay; fullscreen" allowfullscreen class="hero-video">
                            </iframe>

                        <?php endif;

                    }
                    // Vimeo Support
                    elseif (strpos($video_url, 'vimeo') !== false) {
                        preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);
                        $video_id = $matches[1] ?? '';

                        if ($video_id): ?>

                            <iframe
                                src="https://player.vimeo.com/video/<?php echo esc_attr($video_id); ?>?autoplay=1&muted=1&loop=1&background=1"
                                frameborder="0" allow="autoplay; fullscreen" allowfullscreen class="hero-video">
                            </iframe>

                        <?php endif;
                    }
                    ?>
                <?php elseif ($bnrImage): ?>
                    <img loading="lazy" src="<?php echo esc_url($bnrImage['url']); ?>"
                        alt="<?php echo esc_attr($bnrImage['title'] ?? ''); ?>">
                <?php endif; ?>

                <!-- </div> -->
            </div>

            <div class="hero__home--inner">
                <?php
                $subheading = ($language == "el") ? get_field("banner_subheadinggr") : get_field("banner_subheading");
                $heading = ($language == "el") ? get_field("banner_headinggr") : get_field("banner_heading");
                $text = ($language == "el") ? get_field("banner_textgr") : get_field("banner_text");
                $promo = ($language == "el") ? get_field("promo_textgr") : get_field("promo_text");
                ?>
                <div class="hero__content">
                    <?php if ($subheading): ?>
                        <h1 class="section-head-highlight"><?= $subheading; ?></h1>
                    <?php endif; ?>

                    <?php if ($heading): ?>
                        <h2><?= $heading; ?></h2>
                    <?php endif; ?>
                    <?php if ($text): ?>
                        <p><?= $text; ?></p>
                    <?php endif; ?>
                </div>
                <div class="hero__search-box has-hero-offer has-offer-activate">
                    <!-- Promo Banner -->
                    <?php if ($promo): ?>
                        <div class="promo-banner">
                            <?= $promo; ?>
                        </div>
                    <?php endif; ?>
                    <div class="homepage-banner-widget">
                        <?php echo do_shortcode('[mphb_availability_search class="is-style-horizontal-form"]'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<section class="feature-room">
    <div class="container">

        <?php
        // Safe helper – fallback to English if Greek missing
        function safe_field($en, $gr, $language)
        {
            $value = ($language === 'el') ? get_field($gr) : get_field($en);
            return $value ?: get_field($en); // fallback to English
        }

        function safe_sub($en, $gr, $language)
        {
            $value = ($language === 'el') ? get_sub_field($gr) : get_sub_field($en);
            return $value ?: get_sub_field($en);
        }

        // Top fields
        $fTitle = safe_field('featured_rooms_title', 'featured_rooms_title_gr', $language);
        $fHeading = safe_field('featured_rooms_heading', 'featured_rooms_heading_gr', $language);
        $fText = safe_field('featured_rooms_text', 'featured_rooms_text_gr', $language);

        $fButton = ($language === 'el') ? get_field('view_stay_button_gr') : get_field('view_stay_button');
        if (!$fButton) {
            $fButton = get_field('view_stay_button');
        }

        $target = $fButton['target'] ?? '_self';
        ?>

        <div class="feature-header">

            <div class="feature-header-right">

                <?php if ($fText): ?>
                    <p class="section-head-brief"><?= $fText; ?></p>
                <?php endif; ?>

                <?php if ($fButton): ?>
                    <a target="<?= $target; ?>" href="<?= $fButton['url']; ?>" class="btn-theme btn-primary">
                        <span><?= $fButton['title']; ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="position-relative">
            <div class="row">
                <div class="col-12 col-xl-3 feature-left-col">
                    <?php if ($fTitle): ?>
                        <h2 class="section-head-highlight"><?= $fTitle; ?></h2>
                    <?php endif; ?>
                    <?php if ($fHeading): ?>
                        <div class="feature-header-left">
                            <h3 class="section-head-main"><?= $fHeading; ?></h3>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('where_you’ll_stay_contents')): ?>
                        <ul class="nav nav-pills feature-room-tab-list" id="feature-room-tab" role="tablist">

                            <?php $tab_index = 0; ?>
                            <?php while (have_rows('where_you’ll_stay_contents')):
                                the_row(); ?>

                                <?php
                                $tab_id = 'tab-' . $tab_index;
                                $tab_title = safe_sub('tab_title', 'tab_title_gr', $language);
                                ?>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?= $tab_index === 0 ? 'active' : '' ?>" id="<?= $tab_id ?>-tab"
                                        data-bs-toggle="pill" data-bs-target="#<?= $tab_id ?>" type="button" role="tab"
                                        aria-controls="<?= $tab_id ?>"
                                        aria-selected="<?= $tab_index === 0 ? 'true' : 'false' ?>">
                                        <?= esc_html($tab_title); ?>
                                    </button>
                                </li>

                                <?php $tab_index++; ?>
                            <?php endwhile; ?>

                        </ul>
                    <?php endif; ?>


                    <?php
                    $welcomeText = safe_field('where_youll_stay_welcome_text', 'where_youll_stay_welcome_text_gr', $language);
                    if ($welcomeText):
                        ?>
                        <p class="section-head-brief text-start"><?= $welcomeText; ?></p>
                    <?php endif; ?>

                </div>

                <div class="col-12 col-xl-9">

                    <?php if (have_rows('where_you’ll_stay_contents')): ?>
                        <div class="tab-content feature-room-tab-content" id="feature-main-tabContent">

                            <?php $content_index = 0; ?>
                            <?php while (have_rows('where_you’ll_stay_contents')):
                                the_row(); ?>

                                <?php $content_id = 'tab-' . $content_index; ?>

                                <div class="tab-pane fade <?= $content_index === 0 ? 'show active' : '' ?>"
                                    id="<?= $content_id ?>" role="tabpanel" aria-labelledby="<?= $content_id ?>-tab"
                                    tabindex="0">

                                    <!-- Highlights -->
                                    <?php if (have_rows('infowrap')): ?>
                                        <div class="feature-highlight-row" id="dynamic-highlights">

                                            <?php while (have_rows('infowrap')):
                                                the_row(); ?>

                                                <?php
                                                $icon = get_sub_field('information_icon');
                                                $icon_url = $icon['url'] ?? get_template_directory_uri() . '/assets/images/sofa1.png';
                                                $icon_alt = $icon['title'] ?? 'Icon';

                                                $info_text = safe_sub('information_text', 'information_text_gr', $language);
                                                ?>

                                                <div class="feature-highlight-item" data-highlight="<?= $content_id ?>">
                                                    <img src="<?= esc_url($icon_url); ?>" alt="<?= esc_attr($icon_alt); ?>">
                                                    <span><?= esc_html($info_text); ?></span>
                                                </div>

                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>


                                    <!-- Slider -->
                                    <?php if (have_rows('gallery_wrap')): ?>
                                        <div class="feature-room-slider">

                                            <?php while (have_rows('gallery_wrap')):
                                                the_row(); ?>

                                                <?php
                                                $img = get_sub_field('slider_image');
                                                if (!$img)
                                                    continue; // skip empty
                                
                                                $image_title = safe_sub('image_title', 'image_title_gr', $language);
                                                ?>

                                                <div class="feature-room-slider-item" data-room="<?= $content_id ?>">
                                                    <div class="feature-room-slider-img">
                                                        <img src="<?= esc_url($img['url']); ?>" alt="<?= esc_attr($img['title']); ?>">
                                                    </div>
                                                    <p><?= esc_html($image_title); ?></p>
                                                </div>

                                            <?php endwhile; ?>

                                        </div>
                                    <?php endif; ?>

                                </div>

                                <?php $content_index++; ?>
                            <?php endwhile; ?>

                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</section>

<section class="spaces__feature">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 text-center d-flex flex-column justify-content-between position-relative">
                <div class="mb-5">
                    <?php
                    $spaceTitle = ($language == 'el') ? get_field('spaces_title_gr') : get_field('spaces_title');
                    $spaceheading = ($language == 'el') ? get_field('spaces_headinggr') : get_field('spaces_heading');
                    $spaceText = ($language == 'el') ? get_field('spaces_textgr') : get_field('spaces_text');
                    $spaceButton = ($language == 'el') ? get_field('spaces_buton_gr') : get_field('spaces_button');
                    ?>
                    <h2 class="section-head-highlight mx-auto"><?= $spaceTitle; ?></h2>
                    <h3 class="section-head-main"><?= $spaceheading; ?></h3>
                    <p class="section-head-brief"><?= $spaceText; ?></p>
                    <a href="<?= $spaceButton['url'] ?>" class="btn-theme btn-primary">
                        <span><?= $spaceButton['title'] ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php
            if (have_rows('spaces_&_amenities')):
                ?>
                <div class="col-12 col-lg-8 position-relative">
                    <div class="row g-3" id="amenitiesGrid">
                        <?php
                        while (have_rows('spaces_&_amenities')):
                            the_row();
                            $sptitle = ($language === 'el') ? get_sub_field('title_gr') : get_sub_field('title');
                            $spText = ($language === 'el') ? get_sub_field('text_gr') : get_sub_field('text');
                            ?>
                            <div class="col-12 col-md-6 amenity-item">
                                <div class="amenity-card">
                                    <div class="amenity-icon">
                                        <img src="<?= esc_url(get_sub_field('image')['url']); ?>"
                                            alt="<?= esc_attr(get_sub_field('image')['title']); ?>">
                                    </div>
                                    <h3 class="amenity-title"><?= $sptitle; ?></h3>
                                    <p class="amenity-description"><?= $spText; ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="mt-4 d-flex justify-content-center w-100">
                        <button class="btn btn-theme btn-primary align-self-center mb-3 d-none" type="button"
                            id="amenities-toggle-btn">
                            <span></span>
                            <i class="fa-solid fa-arrow-down amenity-arrow"></i>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<section class="gallery__section">
    <div class="gallery__section--container">
        <div class="text-center mb-3">
            <?php
            $galleryTitle = ($language == 'el') ? get_field('gallery_title_gr') : get_field('gallery_title');
            $galleryHeading = ($language == 'el') ? get_field('gallery_heading_gr') : get_field('gallery_heading');
            $galleryButton = ($language == 'el') ? get_field('gallery_button_gr') : get_field('gallery_button');
            ?>
            <h2 class="section-head-highlight mx-auto"><?= $galleryTitle; ?></h2>
            <h3 class="section-head-main mx-auto mb-3"><?= $galleryHeading; ?></h3>
            <a href="<?= $galleryButton['url']; ?>" class="btn-theme btn-primary">
                <span><?= $galleryButton['title']; ?></span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <?php if (have_rows('gallery_image')): ?>
            <div class="gallery-grid" id="homePageGallery" >
                <?php
                $n = 1;
                while (have_rows('gallery_image')):
                    the_row();
                    ?>
                    <div class="gallery-item item-<?= $n; ?>">
                         <a href="<?= get_sub_field('image')['url']; ?>" class="gallery-img-lightbox">
                        <img src="<?= get_sub_field('image')['url']; ?>" alt="<?= get_sub_field('image')['title']; ?>">
                        </a>
                    </div>
                    <?php $n++; endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
if (get_field("reviews_button")): ?>
    <section class="testimonial__section">
        <div class="container">
            <div class="location__section--head mx-auto">
                <?php
                $testimonialsTitle = ($language == 'el') ? get_field('testimonials_title_gr') : get_field('testimonials_title');
                $testimonialsHeading = ($language == 'el') ? get_field('testimonials_heading_gr') : get_field('testimonials_heading');
                $testimonialsText = ($language == 'el') ? get_field('testimonials_text_gr') : get_field('testimonials_text');
                ?>
                <h2 class="section-head-highlight mx-auto"><?= $testimonialsTitle; ?></h2>
                <h3 class="section-head-main"><?= $testimonialsHeading; ?></h3>
                <p class="section-head-brief"><?= $testimonialsText; ?></p>
            </div>
            <?php echo do_shortcode("[trustindex no-registration=google]"); ?>
            <?php echo do_shortcode('[trustindex no-registration=airbnb limit=4]'); ?>
            <?php echo do_shortcode('[trustindex no-registration=booking]'); ?>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field("travel_guide_buttonenable_disable")): ?>
    <section class="travel__guidance">
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <div class="travel-guide-wrapper">
                        <?php
                        $tTitle = ($language == 'el') ? get_field('travel_guide_title_gr') : get_field('travel_guide_title');
                        $tHeading = ($language == 'el') ? get_field('travel_heading_gr') : get_field('travel_heading');
                        $tContent = ($language == 'el') ? get_field('travel_content_gr') : get_field('travel_content');
                        $hlTitle = ($language == 'el') ? get_field('highlights_title_gr') : get_field('highlights_title');
                        $hlContent = ($language == 'el') ? get_field('highlights_content_gr') : get_field('highlights_content');

                        $locationMap = get_field('location_map');
                        ?>
                        <div class="travel__guide--box">
                            <h2 class="section-head-highlight"><?= $tTitle; ?></h2>
                            <h3 class="section-head-main"><?= $tHeading; ?></h3>
                            <p class="section-head-brief text-start mb-5"><?= $tContent; ?></p>
                            <h4 class="section-head-sm"><?= $hlTitle; ?></h4>
                            <p class="section-head-brief text-start"><?= $hlContent; ?></p>
                            <?php if (have_rows('top_activities_&_highlights')):
                                while (have_rows("top_activities_&_highlights")):
                                    the_row();
                                    $flTitle = ($language == 'el') ? get_sub_field('title_gr') : get_sub_field('title');
                                    $flContent = ($language == 'el') ? get_sub_field('description_gr') : get_sub_field('description');
                                    if ($flTitle):
                                        ?>
                                        <div class="travel__brief mt-4">
                                            <?php if (have_rows("travel_gallery")): ?>
                                                <div class="row g-3">
                                                    <?php while (have_rows("travel_gallery")):
                                                        the_row();
                                                        $image = get_sub_field('image');
                                                        ?>
                                                        <?php if ($image): ?>
                                                            <div class="col-12 col-sm-6">
                                                                <div class="travel__brief-img">
                                                                    <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
                                                                </div>
                                                            </div>
                                                        <?php endif;
                                                    endwhile;
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                            <h4 class="section-head-sm mt-4"><?= $flTitle; ?> </h4>
                                            <p class="section-head-brief text-start"><?= $flContent; ?></p>
                                        </div>
                                        <?php
                                    endif;
                                endwhile;
                            endif; ?>
                        </div>
                    </div>
                </div>

                <?php if (shortcode_exists('display_map_shortcode')): ?>
                    <div class="col-12 col-lg-6">
                        <div class="travel-location-wrapper">
                            <div class="location__section--head mx-auto">
                                <?php
                                $locationTitle = ($language == 'el') ? get_field('location_title_gr') : get_field('location_title');
                                $locationHeading = ($language == 'el') ? get_field('location_heading_gr') : get_field('location_heading');
                                $locationContent = ($language == 'el') ? get_field('location_content_gr') : get_field('location_content');
                                $locationButton = ($language == 'el') ? get_field('location_button_gr') : get_field('location_button');
                                $locationMap = get_field('location_map');
                                $target = $locationButton['target'] ? $locationButton['target'] : '_self';
                                ?>
                                <h2 class="section-head-highlight mx-auto"><?= $locationTitle; ?></h2>
                                <h3 class="section-head-main"><?= $locationHeading; ?></h3>
                                <p class="section-head-brief"><?= $locationContent; ?></p>
                                <a href="<?= $locationButton['url']; ?>" target="<?= $target; ?>" class="btn-theme btn-primary">
                                    <span><?= $locationButton['title']; ?></span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="travel__location--box">
                                <?php echo do_shortcode('[display_map_shortcode]'); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<section class="faq__section">
    <?php
    $fTitle = ($language == 'el') ? get_field('faq_title_gr') : get_field('faq_title');
    $fHeading = ($language == 'el') ? get_field('faq_heading_gr') : get_field('faq_heading');
    $fContents = ($language == 'el') ? 'faq_contents_gr' : 'faq_contents';
    ?>
    <div class="container">
        <h2 class="section-head-highlight mx-auto px-5"><?= $fTitle; ?></h2>
        <h3 class="section-head-main text-center"><?= $fHeading; ?></h3>
    </div>
    <?php if (have_rows($fContents)): ?>
        <div id="faq_section" class="faq__block">
            <div class="accordion faq__accordion" id="faqAccordion">
                <?php

                $n = 1;
                while (have_rows($fContents)):
                    the_row();
                    $is_first = ($n === 1);
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?= $n; ?>">
                            <button class="accordion-button <?= $is_first ? '' : 'collapsed'; ?>" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse<?= $n; ?>"
                                aria-expanded="<?= $is_first ? 'true' : 'false'; ?>" aria-controls="collapse<?= $n; ?>">
                                <?= esc_html(get_sub_field('faq_contents_title')); ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $n; ?>" class="accordion-collapse collapse <?= $is_first ? 'show' : ''; ?>"
                            aria-labelledby="heading<?= $n; ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?= wp_kses_post(get_sub_field('faq_contents_text')); ?>
                            </div>
                        </div>
                    </div>
                    <?php $n++; endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</section>


<?php
get_footer();
?>
<script>
    jQuery(document).ready(function ($) {

        var lang = "<?php echo pll_current_language(); ?>";

        // ==========================
        //   LANGUAGE TEXTS
        // ==========================

        var checkInShortLabel = (lang === 'el') ? 'Άφιξη' : 'Check-in';
        var checkOutShortLabel = (lang === 'el') ? 'Αναχώρηση' : 'Check-out';

        var checkInPlaceholder = (lang === 'el') ? 'Ημερομηνία Άφιξης' : 'Check-in Date';
        var checkOutPlaceholder = (lang === 'el') ? 'Ημερομηνία Αναχώρησης' : 'Check-out Date';

        var adultsLabel = (lang === 'el') ? 'Ενήλικες' : 'Adults';
        var childrenLabel = (lang === 'el') ? 'Παιδιά' : 'Children';


        // ==========================
        //   CHECK-IN LABEL
        // ==========================
        $(".mphb_sc_search-check-in-date label").contents().filter(function () {
            return this.nodeType === 3;
        }).first().replaceWith(checkInShortLabel + " ");

        // CHECK-IN PLACEHOLDER
        $(".mphb_sc_search-check-in-date input.mphb-datepick")
            .attr("placeholder", checkInPlaceholder);


        // ==========================
        //   CHECK-OUT LABEL
        // ==========================
        $(".mphb_sc_search-check-out-date label").contents().filter(function () {
            return this.nodeType === 3;
        }).first().replaceWith(checkOutShortLabel + " ");

        // CHECK-OUT PLACEHOLDER
        $(".mphb_sc_search-check-out-date input.mphb-datepick")
            .attr("placeholder", checkOutPlaceholder);


        // ==========================
        //   ADULTS LABEL
        // ==========================
        $("label[for^='mphb_adults']").contents().filter(function () {
            return this.nodeType === 3;
        }).first().replaceWith(adultsLabel + " ");


        // ==========================
        //   CHILDREN LABEL
        // ==========================
        $("label[for^='mphb_children']").contents().filter(function () {
            return this.nodeType === 3;
        }).first().replaceWith(childrenLabel + " ");

    });
</script>
<style>
    /* Hide amenities after the 3rd one unless container is expanded */
    #accordionAmenities:not(.is-expanded) .hidden-amenity,
    #amenitiesGrid:not(.is-expanded) .hidden-amenity {
        display: none;
    }

    #accordionAmenities.is-expanded .hidden-amenity,
    #amenitiesGrid.is-expanded .hidden-amenity {
        display: block;
    }

    /* Rotate arrow based on button class */
    #toggle-amenities.is-expanded .amenity-arrow,
    #amenities-toggle-btn.is-expanded .amenity-arrow {
        transform: rotate(180deg);
    }

    .amenity-arrow {
        transition: transform 0.3s ease;
    }
   
</style>

<script>
    jQuery(document).ready(function ($) {

        var lang = "<?php echo pll_current_language(); ?>";

        var TEXT = {
            viewAll: lang === 'el' ? 'Δείτε όλες τις παροχές' : 'View more',
            viewLess: lang === 'el' ? 'Λιγότερες παροχές' : 'View less'
        };

        var $grid = $('#amenitiesGrid');
        var $cards = $grid.find('.amenity-item');
        var $toggleBtn = $('#amenities-toggle-btn');
        var $btnText = $toggleBtn.find('span');
        var expanded = false;

        function getVisibleCount() {
            return window.innerWidth <= 991 ? 2 : 6;
        }

        var visibleCount = getVisibleCount();

        if (!$grid.length || !$toggleBtn.length) return;

        function updateToggleState() {
            visibleCount = getVisibleCount();

            if ($cards.length <= visibleCount) {
                expanded = false;
                $toggleBtn.addClass('d-none').removeClass('is-expanded');
                $grid.removeClass('is-expanded');
                $cards.removeClass('hidden-amenity');
                return;
            }

            $toggleBtn.removeClass('d-none');
            $grid.toggleClass('is-expanded', expanded);
            $toggleBtn.toggleClass('is-expanded', expanded);
            $btnText.text(expanded ? TEXT.viewLess : TEXT.viewAll);

            if (expanded) {
                $cards.removeClass('hidden-amenity');
            } else {
                $cards.each(function (index) {
                    $(this).toggleClass('hidden-amenity', index >= visibleCount);
                });
            }
        }

        updateToggleState();

        // TOGGLE
        $toggleBtn.on('click', function () {
            expanded = !expanded;
            $grid.toggleClass('is-expanded', expanded);
            $toggleBtn.toggleClass('is-expanded', expanded);
            $btnText.text(expanded ? TEXT.viewLess : TEXT.viewAll);

            if (expanded) {
                $cards.removeClass('hidden-amenity');
                return;
            }

            $cards.each(function (index) {
                $(this).toggleClass('hidden-amenity', index >= visibleCount);
            });

            setTimeout(function () {
                var btnTop = $toggleBtn.offset().top;
                var scrollTo = btnTop - window.innerHeight + $toggleBtn.outerHeight() + 40;
                window.scrollTo({ top: scrollTo, behavior: 'smooth' });
            }, 200);
        });

        // RESIZE
        $(window).on('resize', function () {
            updateToggleState();
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkin = document.querySelector('input[name="mphb_check_in_date"]');
        if (!checkin) return;
        checkin.addEventListener('invalid', function (e) {
            if (document.documentElement.lang === 'el') {
                e.target.setCustomValidity('Παρακαλώ επιλέξτε ημερομηνία άφιξης');
            }
        });
        checkin.addEventListener('input', function (e) {
            e.target.setCustomValidity('');
        });
    });
    jQuery(document).ready(function ($) {
    const gallery = document.getElementById('homePageGallery');

    if (gallery && typeof lightGallery !== "undefined") {
        lightGallery(gallery, {
            selector: '.gallery-img-lightbox',
            speed: 500,
            thumbnail: true,
            zoom: true,
            download: false,
            controls: true,
            actualSize: true,
            counter: true,
            plugins: [lgThumbnail, lgZoom],
        });
    } else {
        console.log("Gallery or lightGallery not found");
    }
});
</script>
