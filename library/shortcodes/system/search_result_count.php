<?php

add_shortcode('search_result_count', 'kopa_shortcode_search_result_count');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_search_result_count($atts, $content = null) {
    $search_result_count = '';

    if (is_main_query() || is_search()) {
        global $wp_query;
        $search_result_count = $wp_query->found_posts;
    }

    return apply_filters('kopa_shortcode_search_phrase', $search_result_count);
}