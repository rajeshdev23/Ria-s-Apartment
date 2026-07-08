<?php
/**
 * Template Name: Location Template
 */

get_header();
$language = pll_current_language();
?>
<section class="gallery hero__main">
    <div class="container">
        <div class="gallery__wrapper">
            <?php
            $bTitle = ($language == "el")? get_field('banner_title_gr'): get_field('banner_title');
            $bText = ($language == "el")? get_field('banner_text_gr'): get_field('banner_text');
            $bImage = get_field('banner_image');

            ?>
            <div class="location__header mx-auto">
                <?php if($bTitle): ?>
                <h1 class="section-head-big text-center"><?=  $bTitle ; ?>
                </h1>
                <?php endif ; ?>
                <?php if($bText): ?>
                <p class="section-head-brief"><?=$bText ; ?></p>
                <?php endif ; ?>
            </div>
            <?php if($bImage): ?>
            <div class="location__hero">
                <img src="<?=$bImage['url']; ?>" alt="<?=$bImage['url']; ?>">
            </div>
            <?php endif ; ?>
        </div>
</section>
<section class="location__section location__display-map pt-4 pb-5">
    <?php
     $nrTitle = ($language == "el")? get_field('nearby_title_gr'): get_field('nearby_title');
     $nrMap = get_field('google_map');
     $nrButton = ($language == "el")? get_field('nearby__button_gr'): get_field('nearby__button');
     $target = $nrButton['target']?  $nrButton['target']: '_self';
    ?>
    <div class="container">
        <div class="location__section--head mx-auto">
            <h3 class="section-head-main mb-3"><?= $nrTitle ; ?></h3>
            <a target="<?=$target ; ?>" href="<?=$nrButton['url'];?>" class="btn-theme btn-primary">
                <span><?= $nrButton['title'] ; ?></span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <?php if($nrMap): ?>
        <div class="location__section--view__box">
            <?= $nrMap ; ?>
        </div>
        <?php endif ; ?>
        <?php
        if(have_rows('nearby_highlights')):
        ?>
        <div class="location__feature mt-4">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php 
                while(have_rows('nearby_highlights')): the_row();
                $locationImage = get_sub_field('location_icon');
                $locationTitle = ($language == 'el')? get_sub_field('location_title_gr'): get_sub_field('location_title');
                ?>
                <div class="col">
                    <div class="location__feature--item">
                        <?php if($locationImage): ?>
                        <img src="<?= $locationImage['url']; ?>" alt="<?= $locationImage['title']; ?>">
                        <?php endif ; ?>
                        <?php if($locationTitle): ?>
                        <p><?= $locationTitle ; ?></p>
                        <?php endif ; ?>
                    </div>
                </div>
                <?php endwhile ;  ?>                
            </div>
        </div>
        <?php endif ; ?>
    </div>
</section>
<section class="location__highlight">
    <div class="container">
        <?php
        $nsTitle = ($language == 'el')? get_field('agios_nikolaos_title_gr'): get_field('agios_nikolaos_title');
       if($nsTitle):
        ?>
        <h2 class="section-head-main text-center"><?= $nsTitle ;?></h2>
        <?php endif ; 
        if(have_rows('highlights_of_agios_nikolaos')):
        ?>
        <div class="row row-cols-1 row-cols-sm-2 g-4 mt-3 mb-5">
            <?php 
            while(have_rows('highlights_of_agios_nikolaos')): the_row();
            $locImage = get_sub_field('location_image');
            $locTitle = ($language == 'el')? get_sub_field('location_title_gr'): get_sub_field('location_title');
            ?>
            <div class="col">
                <div class="location__highlight-item">
                    <?php if($locImage): ?>
                    <div class="location__highlight-img">
                        <img src="<?= $locImage['url']; ?>" alt="<?= $locImage['title']; ?>">
                    </div>
                    <?php
                    endif ;
                    if($locTitle):
                    ?>
                    <p class="section-head-brief"><?= $locTitle ; ?></p>
                    <?php endif ; ?>
                </div>
            </div>
            <?php endwhile ; ?>           
        </div>
        <?php endif ; ?>

        <?php 
         if ( shortcode_exists( 'display_map_shortcode' ) ):
        ?>
        <div id="location-map" class="location__section--view__box">
            <?php echo do_shortcode('[display_map_shortcode]'); ?> 
        </div>
        <?php
        endif ;
        ?>
    </div>
</section>
<?php get_footer();?>