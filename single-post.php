<?php
get_header();
$language = pll_current_language();
$main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

$categories = get_the_category(get_the_ID());
$category_name = !empty($categories) ? $categories[0]->name : '';
$top_heading = ($language === "el"? get_field("top_heading_text_gr", get_the_ID()): get_field("top_heading_text", get_the_ID()));
?>

<section class="post-hero hero__main">
    <div class="container">
        <?php if($top_heading): ?>
        <h1 class="blog-hero__title section-head-main text-center">
           <?= $top_heading; ?>
        </h1>
        <?php endif; ?>
        <div class="post-hero__media">

            <?php if ($main_image) : ?>
                <img
                    src="<?php echo esc_url($main_image); ?>"
                    alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>

            <div class="post-hero__content">
                <h2 class="post-hero__title"><?php the_title(); ?></h2>

                <?php if ($category_name) : ?>
                    <span class="post-hero__tag">
                        <?php echo esc_html($category_name); ?>
                    </span>
                <?php endif; ?>

                <div class="post-hero__meta">
                    <span><?php echo esc_html(get_the_date('F j, Y')); ?></span>
                    <span><?php echo esc_html(get_reading_time()); ?></span>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- ============ Article + sidebar ============ -->
    <section class="post-section">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-md-7 col-xl-8">
                    <article class="post-content">
                       <?php
                        while (have_posts()) :
                            the_post();
                            the_content();
                        endwhile;
                        ?>
                    </article>
                </div>

                <div class="col-md-5 col-xl-4 post-sidebar-col">
                    <div class="post-sidebar">
                        <?php
                        $banerImage = get_field("check_availability_banner_image", "option");
                        if ($banerImage):
                        ?>
                        <div class="post-sidebar__image">
                            <img src="<?= esc_url($banerImage["url"]); ?>"
                                alt="<?= esc_url($banerImage["alt"]); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="post-sidebar__body">
                            <?php
                            $propertyName = ($language === "el"? get_field("property_title_gr","option"): get_field("property_title","option"));
                            ?>
                            <h4 class="post-sidebar__title"><?= esc_html($propertyName); ?></h4>
                            <?php
                            if(have_rows("property_features","option")): ?>                            
                            <div class="post-sidebar__features">
                                <?php
                                while(have_rows("property_features","option")): the_row();
                                $featureIcon = get_sub_field("feature_icon","option");
                                $featureText = ($language === "el"? get_sub_field("feature_title_gr","option"): get_sub_field("feature_title","option"));
                                ?>
                                <span class="post-sidebar__feature">
                                    <img src="<?= esc_url($featureIcon["url"]); ?>"
                                        alt="<?= esc_url($featureIcon["alt"]); ?>"> <?= esc_html($featureText); ?>
                                </span>
                                    <?php endwhile; ?>                                
                            </div>
                            <?php endif; ?>
                            <?php
                            $prpertPricePart = ($language === "el"? get_field("property_price_part_gr","option"): get_field("property_price_part","option"));
                            if($prpertPricePart): 
                            ?>
                            <p class="post-sidebar__price">
                                <?= $prpertPricePart; ?>
                            </p>                           
                            <?php
                            endif ;
                            $checkButton = ($language === "el")
                                ? get_field("check_availability_button_gr", "option")
                                : get_field("check_availability_button", "option");

                            if ($checkButton):

                                $target = !empty($checkButton['target']) ? $checkButton['target'] : '_self';
                            ?>
                                <a href="<?= esc_url($checkButton['url']); ?>"
                                class="btn-theme btn-primary about-btn"
                                target="<?= esc_attr($target); ?>">
                                    <span><?= esc_html($checkButton['title']); ?></span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FAQ (same component as the homepage) ============ -->
    <section class="faq__section blog-faq">
        <?php
        $faqTitle = ($language === "el"? get_field("faq_title_gr","option"): get_field("faq_title","option"));
        $faqHeading = ($language === "el"? get_field("faq_heading_gr","option"): get_field("faq_heading","option"));
        ?>
        <div class="container">
            <h2 class="section-head-highlight mx-auto px-5"><?= esc_html($faqTitle); ?></h2>
            <h3 class="section-head-main text-center"><?= $faqHeading; ?></h3>
        </div>        
        <?php if (have_rows('faq_contents', 'option')) : ?>
        <div id="faq_section" class="faq__block">
            <div class="accordion faq__accordion" id="postFaqAccordion">
                <?php
                $i = 1;
                while (have_rows('faq_contents', 'option')) : the_row();
                    $question = ($language === "el"? get_sub_field('question_gr'): get_sub_field('question'));
                    $answer   = ($language === "el"? get_sub_field('answer_gr'): get_sub_field('answer'));

                    $heading_id  = 'postFaqHeading' . $i;
                    $collapse_id = 'postFaqCollapse' . $i;
                ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                            <button
                                class="accordion-button <?php echo ($i != 1) ? 'collapsed' : ''; ?>"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                                aria-expanded="<?php echo ($i == 1) ? 'true' : 'false'; ?>"
                                aria-controls="<?php echo esc_attr($collapse_id); ?>">

                                <?php echo esc_html($question); ?>

                            </button>
                        </h2>

                        <div
                            id="<?php echo esc_attr($collapse_id); ?>"
                            class="accordion-collapse collapse <?php echo ($i == 1) ? 'show' : ''; ?>"
                            aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                            data-bs-parent="#postFaqAccordion">

                            <div class="accordion-body">
                                <?php echo wp_kses_post($answer); ?>
                            </div>

                        </div>
                    </div>

                <?php
                    $i++;
                endwhile;
                ?>
            </div>        
        </div>
        <?php endif; ?>
    
    </section>

    <!-- ============ Author bio ============ -->
    
    <section class="post-section pt-3">
        <div class="container">
            <div class="post-author">
                <?php
                $profileImage = get_field("host_profile_image", "option");
                $host_name = ($language === "el"? get_field("host_name_gr", "option"): get_field("host_name", "option"));
                $host_role = ($language === "el"? get_field("host_role_gr", "option"): get_field("host_role", "option"));
                $host_bio = ($language === "el"? get_field("host_bio_gr", "option"): get_field("host_bio", "option"));
                if($profileImage):
                ?>
                <div class="post-author__photo testimonial__dp">
                    <img src="<?= esc_url($profileImage['url']); ?>" alt="<?= esc_attr($host_name); ?>">
                </div>
                <?php endif; ?>
                <div class="post-author-info">
                    <h4 class="post-author__name"><?= esc_html($host_name); ?> <span class="post-author__role"><?= esc_html($host_role); ?></span></h4>
                    <p class="post-author__bio"><?= esc_html($host_bio); ?></p>
                    <?php
                    if(have_rows("host_social_handles", "option")):
                    ?>
                    <div class="post-author__social">
                        <?php
                        while(have_rows("host_social_handles", "option")): the_row();
                        $socialIcon = get_sub_field("social_icon", "option");
                        $socialLink = get_sub_field("social_url", "option");
                        ?>
                        <a 
                         href="<?= $socialLink; ?>" target="_blank" ><?=$socialIcon; ?></a>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    
                    <?php endif; 
                    $abotButton = ($language === "el"? get_field("know_more_button_gr", "option"): get_field("know_more_button", "option"));
                    
                    if($abotButton):
                        $target = $abotButton['target'] ? $abotButton['target'] : '_self';
                    ?>
                    <a href="<?= esc_url($abotButton['url']); ?>" target="<?= esc_attr($target); ?>" class="blog-card__link"><span><?= esc_html($abotButton['title']); ?></span> <i
                            class="fa-solid fa-arrow-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
     <?php
     $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
     );
     $author_query = new WP_Query( $args );
     $readmore_text = ($language === "el"? "Διαβάστε περισσότερα": "Read More");
     if($author_query->have_posts()) :     ?>

    <!-- ============ Continue reading (same card component as the listing page) ============ -->
     
    <section class="post-section post-related pt-0">
        <div class="container">
            <?php
            $continueReadingTitle = ($language === "el"? get_field("continue_reading_title_gr", "option"): get_field("continue_reading_title", "option"));
            if($continueReadingTitle):
            ?>
            <h3 class="section-head-main text-center"><?= $continueReadingTitle; ?></h3>
            <?php endif ; ?>
            <div class="row g-3 mt-2">
                <?php while($author_query->have_posts()) : $author_query->the_post();
                $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
                ?>

                <div class="col-md-4 col-sm-6">
                    <article class="blog-card">
                        <?php if($featured_image) : ?>
                            <div class="blog-card__image">
                                <img src="<?php echo $featured_image; ?>"
                                    alt="<?php echo get_the_title(); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="blog-card__body">
                            <span class="blog-card__date"><?php echo get_the_date("F j, Y"); ?></span>
                            <h3 class="blog-card__title"><?php echo get_the_title(); ?></h3>
                            <p class="blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <a href="<?php echo get_the_permalink(); ?>" class="blog-card__link"><span><?php echo $readmore_text; ?></span> <i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
              
            </div>
            <?php
            $backToBlogButton = ($language === "el"? get_field("back_to_all_articles_button_gr", "option"): get_field("back_to_all_articles_button", "option"));
            $target = $backToBlogButton['target'] ? $backToBlogButton['target'] : '_self';
            if($backToBlogButton):
            ?>
            <div class="text-center mt-4">
                <a href="<?= esc_url($backToBlogButton['url']); ?>" class="btn-theme btn-primary about-btn" target="<?= esc_attr($target); ?>">
                    <i class="fa-solid fa-arrow-left"></i><span><?= esc_html($backToBlogButton['title']); ?></span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php
endif;
get_footer();
?>