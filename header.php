<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ria\'s-apartment
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <?php wp_head(); ?>
</head>
<?php
$language = pll_current_language();
?>

<body <?php body_class(($language === 'el') ? 'greek_body' : ''); ?>>
    <?php wp_body_open(); ?>
    <header class="header__main">
        <div class="container">
            <div class="header__row">
                <?php
				if(get_field('brand_logo', 'option')):
				?>
                
                <a href="<?php echo home_url(); ?>" class="logo"><img
                        src="<?php echo get_field('brand_logo', 'option')['url']; ?>"
                        alt="<?php echo get_field('brand_logo', 'option')['title']; ?>"></a>
                <?php endif ; ?>
                <div class="header-action">
                    <nav class="navbar__main">
                        <?php
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'container'      => false, 
							'menu_class'     => 'menu__list text-center',
							'link_class'     => 'menu__item', 
							'fallback_cb'    => false,
						) );
                        $language = pll_current_language();
                        $bookNowBtn = ($language == 'el')? get_field('book_now_button_gr','option'): get_field('book_now_button', 'option');
                        $taregt = $bookNowBtn['target']? $bookNowBtn['target']: '_self';
                        if($bookNowBtn):
						?>
                        <a target="<?= $taregt ;?>" href="<?=$bookNowBtn['url'];?>" class="btn-theme d-xl-none"><span><?=$bookNowBtn['title'];?></span><i
                                class="fa-solid fa-arrow-right"></i></a>
                        <?php endif ; ?>
                    </nav>
                    <div class="header-cta">
                        <?php
                        if (function_exists('pll_current_language') && function_exists('pll_the_languages')) {
                            $current_lang = pll_current_language();
                            $languages = pll_the_languages(['raw' => 1]);

                            $english_key = array_search('English', array_column($languages, 'name'));
                            $greek_key   = array_search('Greek', array_column($languages, 'name'));

                            $en_key = ($english_key !== false) ? array_keys($languages)[$english_key] : 'en';
                            $el_key = ($greek_key !== false) ? array_keys($languages)[$greek_key] : 'el';

                            $en_url = esc_url($languages[$en_key]['url']);
                            $el_url = esc_url($languages[$el_key]['url']);                            
                            $flipped = ($current_lang === $el_key);
                        }
                        ?>
                        <div class="language__selector">
                            <div class="language__flip-container" id="langFlip"
                                style="transform: <?php echo $flipped ? 'rotateY(180deg)' : 'rotateY(0deg)'; ?>;">

                                <!-- Active = current language -->
                                <button
                                    class="language__button language__button--front <?php echo ($current_lang === $en_key) ? 'active' : ''; ?>"
                                    data-lang="EN" data-url="<?php echo $en_url; ?>">
                                    EN
                                </button>
                                <button
                                    class="language__button language__button--back <?php echo ($current_lang === $el_key) ? 'active' : ''; ?>"
                                    data-lang="GR" data-url="<?php echo $el_url; ?>">
                                    GR
                                </button>
                            </div>
                        </div>
                        <?php 
                         
                        if($bookNowBtn):
						?>
                        <a target="<?= $taregt ;?>" href="<?=$bookNowBtn['url'];?>" class="btn-theme d-none d-xl-inline-flex"><span><?=$bookNowBtn['title'];?></span><i
                                class="fa-solid fa-arrow-right"></i></a>
                        <?php endif ; ?>
                        <div class="menu__bar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>