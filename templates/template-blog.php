<?php
// Template Name: Blog Template
get_header();
$language = pll_current_language();
if (empty($language) && function_exists('icl_object_id')) {
    $language = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
}
if (empty($language)) {
    $language = 'en';
}

// Categories used as filter tabs (only those that actually have posts).
$blog_categories = get_categories(array(
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
));

// Initial blog grid (page 1, no filter).
$blog_paged = 1;
$blog_query = new WP_Query(rias_blog_query_args('all', $blog_paged, $language));
$blog_has_more = ($blog_paged < (int) $blog_query->max_num_pages);

// UI strings — English / Greek (el). Same pattern as the CTA section below.
$is_el         = ($language === 'el');
$txt_all       = $is_el ? 'Όλα' : 'All';
$txt_show_more = $is_el ? 'Περισσότερα' : 'Show More';
$txt_loading   = $is_el ? 'Φόρτωση…' : 'Loading…';
$txt_no_posts  = $is_el ? 'Δεν βρέθηκαν αναρτήσεις.' : 'No blog posts found.';
$hero_title    = $is_el
	? get_field("hero_title_gr")
	: get_field("hero_title");
?>

 <section class="blog-hero hero__main">    
        <div class="container">
            <h1 class="blog-hero__title section-head-main text-center"><?php echo $hero_title; ?></h1>

            <ul class="nav nav-pills feature-room-tab-list blog-filter-tabs" id="blogFilterTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" type="button" data-filter="all"><?php echo esc_html($txt_all); ?></button>
                </li>
                <?php foreach ($blog_categories as $blog_cat) : ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" type="button" data-filter="<?php echo esc_attr($blog_cat->slug); ?>"><?php echo esc_html($blog_cat->name); ?></button>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <style>
        .blog-grid__row { transition: opacity .25s ease; }
        .blog-grid__loader {
            display: none;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 30px 0;
            font-size: 16px;
        }
        .blog-grid__loader.is-visible { display: flex; }
        .blog-spinner {
            width: 22px;
            height: 22px;
            border: 3px solid rgba(0, 0, 0, .15);
            border-top-color: currentColor;
            border-radius: 50%;
            animation: rias-blog-spin .7s linear infinite;
        }
        .relativeContainer{
            position: relative;
        }
        .blog-grid__loader {
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(255, 255, 255, 0.08);
        padding: 20px;
        border-radius: 8px;
        z-index: 10;
        }

        @keyframes rias-blog-spin { to { transform: rotate(360deg); } }
        #blogShowMoreBtn[disabled] { opacity: .7; cursor: not-allowed; }
    </style>
    <!-- ============ Blog card grid ============ -->
    <section class="blog-grid">
        <div class="container relativeContainer">
            <div class="blog-grid__loader" id="blogGridLoader" aria-live="polite">
                <span class="blog-spinner" aria-hidden="true"></span>
                <span><?php echo esc_html($txt_loading); ?></span>
            </div>
            <div class="row g-3 blog-grid__row" id="blogGridRow">
                <?php
                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                        echo rias_render_blog_card(get_the_ID(), $language);
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12">
                        <p class="text-center blog-grid__empty"><?php echo esc_html($txt_no_posts); ?></p>
                    </div>
                    <?php
                endif;
                ?>
            </div>           

            <div class="text-center mt-4" id="blogShowMoreWrap"<?php echo $blog_has_more ? '' : ' style="display:none;"'; ?>>
                <button type="button" id="blogShowMoreBtn" class="btn-theme btn-primary about-btn">
                    <span class="btnLoading"><?php echo esc_html($txt_show_more); ?></span><i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>
        </div>
    </section>    
     <!-- ============ CTA banner ============ -->
      <?php
      if(get_field('cta_button')):?>
    <section class="blog-cta">
        <div class="container">
            <div class="blog-cta__inner">
                <?php
                $ctaBannerImage = get_field("cta_banner_image"); 
                if($ctaBannerImage):     
                ?>
                <img src="<?= $ctaBannerImage['url']; ?>" alt="<?= $ctaBannerImage['alt']; ?>">
                <?php endif; 
                $ctaHeading = ($language === "el"? get_field("cta_heading_gr"): get_field("cta_heading"));
                
                ?>
                <div class="blog-cta__content">
                    <?php
                    if($ctaHeading):
                    ?>
                    <h2 class="blog-cta__title"><?= $ctaHeading; ?></h2>
                    <?php endif; ?>
                    <?php
                    $checkButton = ($language === "el"? get_field("back_to_all_articles_button_gr","option"): get_field("back_to_all_articles_button","option")); 
                    $target = $checkButton['target'] ? $checkButton['target'] : '_self';
                    if($checkButton):
                    ?>
                    <a href="<?= $checkButton['url']; ?>" target="<?= $target; ?>" class="btn-theme btn-primary btn-blog-cta">
                        <span><?= $checkButton['title']; ?></span><i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <?php endif; ?>                   
                </div>
                
            </div>
        </div>
    </section>
    <?php endif; ?>    
<script>
        (function ($) {
            var ajaxUrl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
            var nonce = '<?php echo esc_js(wp_create_nonce('rias_blog_nonce')); ?>';
            var lang = '<?php echo esc_js($language); ?>';
            var txtLoading = '<?php echo esc_js($txt_loading); ?>';
            var txtNoPosts = '<?php echo esc_js($txt_no_posts); ?>';
            

            var $row = $('#blogGridRow');
            var $tabs = $('#blogFilterTabs');
            var $moreWrap = $('#blogShowMoreWrap');
            var $moreBtn = $('#blogShowMoreBtn');
            var $gridLoader = $('#blogGridLoader');
            var $moreBtnIcon = $moreBtn.find('i');
            var $moreBtnLabel = $moreBtn.find('.btnLoading');
            var moreBtnLabelText = $moreBtnLabel.text();

            var currentCategory = 'all';
            var currentPaged = 1;
            var loading = false;

            function loadPosts(reset) {
                if (loading) return;
                loading = true;

                var pagedToLoad = reset ? 1 : currentPaged + 1;

                if (reset) {
                    // Filter change: dim the grid, hide the button, show the loader below it.
                    $row.css('opacity', 0.4);
                    $moreWrap.hide();
                    $gridLoader.addClass('is-visible');
                } else {
                    // Show More: spin the button icon and switch its label.
                    $moreBtn.prop('disabled', true).addClass('is-loading');
                    $moreBtnLabel.text(txtLoading);
                    $moreBtnIcon.attr('class', 'fa-solid fa-spinner fa-spin');
                }

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'rias_load_blog_posts',
                        nonce: nonce,
                        category: currentCategory,
                        paged: pagedToLoad,
                        lang: lang
                    }
                }).done(function (res) {
                    if (res && res.success) {
                        if (reset) {
                            $row.html(res.data.html || '<div class="col-12"><p class="text-center blog-grid__empty">' + txtNoPosts + '</p></div>');
                        } else {
                            $row.append(res.data.html || '');
                        }
                        currentPaged = pagedToLoad;
                        $moreWrap.toggle(!!res.data.has_more);
                    }
                }).always(function () {
                    loading = false;
                    $row.css('opacity', 1);
                    $gridLoader.removeClass('is-visible');
                    $moreBtn.prop('disabled', false).removeClass('is-loading');
                    $moreBtnLabel.text(moreBtnLabelText);
                    $moreBtnIcon.attr('class', 'fa-solid fa-chevron-down');
                });
            }

            // Category filter
            $tabs.on('click', '.nav-link', function () {
                var $btn = $(this);
                if ($btn.hasClass('active')) return;

                $tabs.find('.nav-link').removeClass('active');
                $btn.addClass('active');

                currentCategory = $btn.data('filter') || 'all';
                loadPosts(true);
            });

            // Show More
            $moreBtn.on('click', function () {
                loadPosts(false);
            });
        })(jQuery);
    </script>  
<?php get_footer(); ?>
