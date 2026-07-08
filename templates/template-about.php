<?php
/**
 * Template Name: About Us Template
 */
get_header();
$language = pll_current_language();
 if ( get_field('hero_button') ) : 
?>
<section class="about-hero hero__main">
        <div class="container">
            <?php
            $hroTitle = ($language === "el"? get_field("hero_title_gr"): get_field("hero_title"));
            if($hroTitle):
            ?>
            <h1 class="about-hero__top section-head-main text-center">
                <?= $hroTitle; ?>
            </h1>
            <?php endif ; 
            $hrImage = get_field("hero_image");
            if($hrImage):
            ?>
            <div class="about-hero__image">
                <img src="<?= $hrImage['url']; ?>"
                    alt="<?= $hrImage['alt']; ?>">
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php 
     endif;
     if( get_field('host_button') ) :
    ?>
    <!-- ============ Host introduction ============ -->
    <section class="about-host">
        <div class="container">
            <div class="host-badge">
                <?php
                $hostIcon = get_field("your_host_title_icon1");
                if($hostIcon):
                ?>
                <img src="<?= $hostIcon['url']; ?>" alt="<?= $hostIcon['alt']; ?>" class="laurel-icon">
                <?php endif; 
                $hstTitle = ($language === "el"? get_field("your_host_title_gr"): get_field("your_host_title"));
                if($hstTitle):
                ?>
                <span><?= $hstTitle; ?></span>
                <?php endif; 
                $hostIcon = get_field("your_host_title_icon1");
                if($hostIcon):
                 ?>
                <img src="<?= $hostIcon['url']; ?>" alt="<?= $hostIcon['alt']; ?>" class="laurel-icon">
                <?php endif; ?>
            </div>
            <?php
            $hstNmae = ($language === "el"? get_field("host_name_gr"): get_field("host_name"));
            $hostRole = ($language === "el"? get_field("host_heading_gr"): get_field("host_heading"));
            if($hstNmae):
            ?>
            <h2 class="host-name"><?= $hstNmae; ?></h2>
            <p class="host-role"><?= $hostRole; ?></p>
            <?php endif; ?>
            <?php
            $ourStoryBtn = ($language === "el"? get_field("read_our_story_button_gr"): get_field("read_our_story_button"));
            $target = $ourStoryBtn['target'] ? $ourStoryBtn['target'] : '_self';
            if($ourStoryBtn):
            ?>
            <a href="<?= $ourStoryBtn['url']; ?>" class="btn-theme btn-primary about-btn" target="<?= $target; ?>">
                <span><?= $ourStoryBtn['title']; ?></span><i class="fa-solid fa-chevron-down"></i>
            </a>
            <?php endif; ?>
        </div>
    </section>
    <?php 
     endif;
     if( get_field('about_us_button') ) :
     ?>

    <!-- ============ Our story ============ -->
    <section class="about-story" id="about-story">
        <div class="container">
            <?php
            $abTitle = ($language === "el"? get_field("about_us_title_gr"): get_field("about_us_title"));
            if($abTitle):
            ?>
            <h2 class="section-head-highlight mx-auto"><?= $abTitle; ?></h2>
            <?php endif; 
            $abtHeading = ($language === "el"? get_field("about_us_heading_gr"): get_field("about_us_heading"));
            if($abtHeading):
            ?>
            <h3 class="section-head-main"><?= $abtHeading; ?></h3>
            <?php endif; 
            $abtContent = ($language === "el"? get_field("about_us_content_gr"): get_field("about_us_content"));
            if($abtContent):
            ?>
            <div class="about-story__text">
                <?= $abtContent; ?>
            </div>
            <?php 
            endif;
            if( have_rows('about_us_gallery') ):
            ?>
            <div class="about-gallery-grid gallery-bottom-block">
                <?php while( have_rows('about_us_gallery') ): the_row(); 
                    $image = get_sub_field('gallery_image');
                ?>
                <div class="about-gallery__img"><img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>"></div>
                <?php endwhile; ?>
            </div>
            <?php
            endif; 
            $extraText = ($language === "el"? get_field("the_home_we_built_for_you_text_gr"): get_field("the_home_we_built_for_you_text"));
            if($extraText):
            ?>           <p class="section-statement"><?= $extraText; ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php 
     endif;
     if( get_field('rias_difference_button') ) :
     ?>

    <!-- ============ The Ria's difference ============ -->
    <section class="about-difference">
        <div class="container">
            <?php
            $diffTitle = ($language === "el"? get_field("rias_difference_title_gr"): get_field("rias_difference_title"));
            if($diffTitle):
            ?>
            <span class="section-eyebrow"><?= $diffTitle; ?></span>
            <?php endif; 
            $difHeading= ($language === "el"? get_field("rias_difference_heading_gr"): get_field("rias_difference_heading"));
            if($difHeading):
            ?>
            <h3 class="section-head-main"><?= $difHeading; ?></h3>
            <?php endif;
            if( have_rows('rias_difference_points') ):
             ?>
             
            <div class="row g-2 about-difference__grid">
                <?php while( have_rows('rias_difference_points') ): the_row(); 
                    $diffIcon = get_sub_field('icon');
                    $diffTitle = ($language === "el"? get_sub_field("title_gr"): get_sub_field("title"));
                    $diffContent = ($language === "el"? get_sub_field("text_gr"): get_sub_field("text")); 
                ?>
                <div class="col-sm-6">
                    <div class="amenity-card about-difference__card h-100">
                        <div class="amenity-icon"><img src="<?= $diffIcon['url']; ?>" alt="<?= $diffIcon['alt']; ?>"></div>
                        <h4 class="amenity-title"><?= $diffTitle; ?></h4>
                        <p class="amenity-description"><?= $diffContent; ?></p>
                    </div>
                </div>
                <?php endwhile; ?>               
            </div>
            <?php
            endif;
            ?>
        </div>
    </section>
    <?php 
     endif;
     if( get_field('why_guests_button') ) :
     ?>

    <!-- ============ Why guests love staying here ============ -->
    <section class="about-why">
        <div class="container">
            <?php
            $whyTitle = ($language === "el"? get_field("why_guests_title_gr"): get_field("why_guests_title"));
            if($whyTitle):
            ?>
            <h3 class="section-head-main"><?= $whyTitle; ?></h3>
            <?php endif;
            $whyContent = ($language === "el"? get_field("why_guests_contents_gr"): get_field("why_guests_contents"));
            if($whyContent):
                ?>
            <ul class="about-why__list">
               <?= $whyContent; ?>
            </ul>
            <?php endif;
            $checkButton = ($language === "el"? get_field("why_guests_link_button_gr"): get_field("why_guests_link_button")); 
           
            if($checkButton):
                 $target = $checkButton['target'] ? $checkButton['target'] : '_self';
            ?>
            <a href="<?= $checkButton['url']; ?>" target="<?= $target; ?>" class="btn-theme btn-primary about-btn">
                <span><?= $checkButton['title']; ?></span><i class="fa-solid fa-arrow-right"></i>
            </a>
            <?php endif; ?>
        </div>
    </section>
    <?php 
     endif;     
     ?>
<?php get_footer(); ?>
