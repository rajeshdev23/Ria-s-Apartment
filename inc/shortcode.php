<?php

function display_map() {   
    ob_start();

    if ( wp_is_mobile() ) {
        return get_field('map_phone', 'option');
    } else {
        return get_field('map', 'option');
    }
    $content = ob_get_clean();
    return $content ;
}

add_shortcode('display_map_shortcode', 'display_map');
