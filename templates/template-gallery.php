<?php
/**
 * Template Name: Gallery Template
 */
get_header();
$language = pll_current_language();
?>

<section class="gallery hero__main">
    <div class="container">
        <?php        
        $gTitle    = ($language == 'el') ? get_field('gallery_title_gr') : get_field('gallery_title');
        $gSubtitle = ($language == 'el') ? get_field('gallery_text_gr') : get_field('gallery_text');
        ?>
        <div class="gallery__wrapper">
            <div class="gallery__top-block hero__content mw-100">
                <?php if ($gTitle): ?>
                <h2><?= $gTitle; ?></h2>
                <?php endif; ?>
                <?php if ($gSubtitle): ?>
                <p><?= esc_html($gSubtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php if (have_rows('gallery_tab_contents')): ?>
            <div class="gallery__tabs">
                <?php $tabIndex = 1; ?>
                <?php while (have_rows('gallery_tab_contents')): the_row(); 
                        $tabTitle = ($language == 'el') ? get_sub_field('gallery_image_tab_title_gr') : get_sub_field('gallery_image_tab_title');
                        $tabIcon  = get_sub_field('gallery_image_tab');
                    ?>
                <div class="gallery__item-wrapper">
                    <div class="gallery__item" id="tab<?= $tabIndex; ?>" data-target="content<?= $tabIndex; ?>">
                        <?php if (!empty($tabIcon['url'])): ?>
                        <img src="<?= esc_url($tabIcon['url']); ?>" alt="<?= esc_attr($tabTitle); ?>">
                        <?php else: ?>
                        <img src="<?= esc_url(get_template_directory_uri() . '/assets/images/galleryimage/rias_apartment1.jpg'); ?>"
                            alt="Default tab image">
                        <?php endif; ?>
                    </div>
                    <?php if ($tabTitle): ?>
                    <h6 class="gallery__heading"><?= esc_html($tabTitle); ?></h6>
                    <?php endif; ?>
                </div>
                <?php $tabIndex++; ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
            <div class="gallery__contents">
                <?php if (have_rows('gallery_tab_contents')): ?>
                <?php $contentIndex = 1; ?>
                <?php while (have_rows('gallery_tab_contents')): the_row(); 
                        $tabTitle = ($language == 'el') ? get_sub_field('gallery_image_tab_title_gr') : get_sub_field('gallery_image_tab_title');
                    ?>
                <div class="gallery__content <?= $contentIndex === 1 ? 'active' : ''; ?>"
                    id="content<?= $contentIndex; ?>">
                    <?php if ($tabTitle): ?>
                    <h3 class="section-head-main text-center mb-4"><?= esc_html($tabTitle); ?></h3>
                    <?php endif; ?>

                    <?php if (have_rows('gallery_features')): ?>
                    <div class="feature-highlight-row justify-content-center">
                        <?php while (have_rows('gallery_features')): the_row(); 
                                        $featureIcon = get_sub_field('gallery_features_icon');
                                        $featureText = ($language == 'el') ? get_sub_field('gallery_features_text_gr') : get_sub_field('gallery_features_text');
                                    ?>
                        <?php if ($featureText): ?>
                        <div class="feature-highlight-item">
                            <?php if (!empty($featureIcon['url'])): ?>
                            <img src="<?= esc_url($featureIcon['url']); ?>" alt="<?= esc_attr($featureText); ?>">
                            <?php else: ?>
                            <img src="<?= esc_url(get_template_directory_uri() . '/assets/images/sofa.png'); ?>"
                                alt="Default feature icon">
                            <?php endif; ?>
                            <span><?= esc_html($featureText); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (have_rows('gallery_images_new')): ?>
                    <div class="gallery-bottom-block" id="galleryPageLightBox<?= $contentIndex; ?>">
                        <div class="grid-sizer"></div>
                        <?php while (have_rows('gallery_images_new')): the_row(); 
                            $image = get_sub_field('image');
                        ?>
                            <?php if ($image): ?>
                                <div class="gallery__img">
                                    <a href="<?= esc_url($image['url']); ?>" class="gallery_page_light_box_img" >
                                        <img 
                                        loading="lazy"
                                        title="<?= esc_attr($image['alt']); ?>"
                                        src="<?= esc_url($image['url']); ?>" 
                                        alt="<?= esc_attr($image['alt']); ?>"
                                    >
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                </div>
                <?php $contentIndex++; ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
 <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

  var grids = document.querySelectorAll('.gallery-bottom-block');
  var masonryInstances = [];

  grids.forEach(function (grid) {

    var msnry = new Masonry(grid, {
      itemSelector: '.gallery__img',
      columnWidth: '.grid-sizer',
      gutter: 16,
      percentPosition: true
    });

    masonryInstances.push(msnry);

    // wait for images
    imagesLoaded(grid, function () {
      msnry.layout();
    });

  });

  // tab click fix
  document.querySelectorAll('.gallery__item').forEach(function(tab) {
    tab.addEventListener('click', function() {

      setTimeout(function() {
        masonryInstances.forEach(function(msnry) {
          msnry.layout();
        });
      }, 300);

    });
  });

});
</script>
<?php
 get_footer();
 ?>
 <script>
    jQuery(document).ready(function ($) {

    function initGallery(galleryEl) {
        if (!galleryEl.hasClass('lg-initialized')) {
            lightGallery(galleryEl[0], {
                selector: '.gallery_page_light_box_img',
                speed: 500,
                thumbnail: true,
                zoom: true,
                download: false,
                controls: true,
                actualSize: true,
                counter: true,
                plugins: [lgThumbnail, lgZoom],
            });

            galleryEl.addClass('lg-initialized');
        }
    }
    initGallery($('#galleryPageLightBox1'));
    // 🔥 TAB CLICK
    $('.gallery__item').on('click', function () {
        let target = $(this).data('target'); // content1, content2...
        let index = target.replace('content', '');

        // toggle active tab (your existing logic may already exist)
        $('.gallery__content').removeClass('active');
        $('#' + target).addClass('active');

        // init gallery for that tab
        initGallery($('#galleryPageLightBox' + index));
    });

});
</script>