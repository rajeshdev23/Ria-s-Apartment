<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ria\'s-apartment
 */
$language = pll_current_language();
if (empty($language) && function_exists('icl_object_id')) {
    $language = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
}
if (empty($language)) {
    $language = 'en';
}
?>

<footer class="footer-main">
    <div class="container">
        <div class="footer__wrapper">
            <div class="footer__top">
                <?php if (get_field('foote_logo', 'option')): ?>
                    <div class="footer__logo">
                        <img src="<?php echo get_field('foote_logo', 'option')['url']; ?>"
                            alt="<?php echo get_field('foote_logo', 'option')['title']; ?>">
                    </div>
                <?php endif; ?>
                <div class="footer__info-wrapper">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'footer__info-top',
                        'link_class' => 'footer__item',
                        'fallback_cb' => false,
                    ));
                    ?>
                    <div class="footer__middle">
                        <div class="footer__middle__wrapperone">
                            <?php if (get_field('phonne_number', 'option')): ?>
                                <div class="d-flex flex-column">
                                    <?php $coText = ($language === "el") ? get_field("contact_text_gr", "option") : get_field("contact_text", "option");
                                    ?>
                                    <span><?= $coText; ?></span>
                                    <span class="details"><a target='_blank'
                                            href="tel:<?= get_field('phonne_number', 'option') ?>"><?= get_field('phonne_number', 'option') ?></a></span>
                                </div>
                                <?php
                            endif;
                            if (get_field('email_address', 'option')):

                                ?>
                                <div class="d-flex flex-column">
                                    <?php
                                    $ftEmail = ($language === "el") ? get_field("email_text_gr", "option") : get_field("email_text", "option");
                                    ?>
                                    <span><?= $ftEmail; ?></span>
                                    <span class="details"><a target='_blank'
                                            href="mailto:<?= get_field('email_address', 'option'); ?>"><?= get_field('email_address', 'option'); ?></a></span>
                                </div>
                            <?php endif; ?>
                            <!-- <a href="" class="footer__media"><i class="fa-solid fa-phone"></i></a>
                            <a href="" class="footer__media"><i class="fa-regular fa-envelope"></i></a> -->

                        </div>
                        <?php if (get_field('address', 'option')): ?>
                            <div class="footer__middle__wrappertwo flex-wrap">
                                <?php
                                if (have_rows('social_urls', 'option')):
                                    ?>
                                    <div class="d-flex gap-1 align-items-center justify-content-center flex-wrap mb-4">
                                        <?php
                                        while (have_rows('social_urls', 'option')):
                                            the_row();
                                            ?>
                                            <a target="_blank" href="<?= get_sub_field('social_link', 'option'); ?>"
                                                class="footer__media">
                                                <?= get_sub_field('icon', 'option'); ?>
                                            </a>
                                        <?php endwhile;
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="d-flex flex-column justify-content-center text-center text-lg-start">
                                    <?php
                                    $ftAdrees = ($language === "el") ? get_field("address_text_gr", "option") : get_field("address_text", "option");
                                    ?>
                                    <span><?= $ftAdrees; ?></span>
                                    <span
                                        class="details"><?= ($language === "el") ? get_field('address_gr', 'option') : get_field('address', 'option'); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer__bottom">
            <?php if (get_field('copyright_text', 'option')): ?>
                <span>© <?php
                echo date('Y') . '—' . (
                    $language === 'el'
                    ? get_field('copyright_text_gr', 'option')
                    : get_field('copyright_text', 'option')
                );
                ?>
                </span>
            <?php endif; ?>
            <span><a
                    href="<?= ($language === "el") ? get_field("privacy_policy_page_url_gr", "option") : get_field("privacy_policy_page_url", "option") ?>"><?= ($language === "el") ? 'Πολιτική Απορρήτου' : 'Privacy Policy';
                              ; ?></a></span>
        </div>

        <button id="backToTopBtn" class="btn btn-primary rounded-circle" title="Go to top">
            ↑
        </button>
    </div>
</footer>

<a href="<?= ($language === 'el')
    ? home_url('/el/πού-θα-μείνετε/#CheckAvailabilityId')
    : home_url('/where-youll-stay/#CheckAvailabilityId');?>" id="mobileReserveBtn" class="mobile-reserve-btn"
        aria-label="<?= ($language === 'el') ? 'Κάντε Κράτηση' : 'Make a Reservation' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        <span><?= ($language === 'el') ? 'Κράτηση' : 'Book Now' ?></span>
    </a>
<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
<script>
   (function () {
    'use strict';

    const btn = document.getElementById('mobileReserveBtn');
    if (!btn) return;

    const calendarSection = document.getElementById('CheckAvailabilityId');
    const guestSection = document.getElementById('guest-servicesId');

    function onScroll() {

        // If sections don't exist on this page,
        // just show button after 150px scroll.
        if (!calendarSection || !guestSection) {
            if (window.scrollY > 150) {
                btn.classList.add('is-visible');
            } else {
                btn.classList.remove('is-visible');
            }
            return;
        }

        const calendarRect = calendarSection.getBoundingClientRect();
        const guestRect = guestSection.getBoundingClientRect();

        const calendarVisible =
            calendarRect.top <= window.innerHeight &&
            calendarRect.bottom >= 0;

        const guestVisible =
            guestRect.top <= window.innerHeight &&
            guestRect.bottom >= 0;

        if (window.scrollY > 150) {
            if (calendarVisible && !guestVisible) {
                btn.classList.remove('is-visible');
            } else {
                btn.classList.add('is-visible');
            }
        } else {
            btn.classList.remove('is-visible');
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);

    onScroll();
})();
</script>
</body>

</html>