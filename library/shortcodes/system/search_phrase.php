<?php

add_shortcode('search_phrase', 'kopa_shortcode_search_phrase');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_search_phrase($atts, $content = null) {
    $search_phrase = '';

    if (is_main_query() || is_search()) {
        $search_phrase = '"' . get_search_query() . '"';
    }

    return apply_filters('kopa_shortcode_search_phrase', $search_phrase);
}