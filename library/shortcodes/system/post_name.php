<?php

add_shortcode('page_name', 'kopa_shortcode_post_name');
add_shortcode('post_name', 'kopa_shortcode_post_name');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_post_name($atts, $content = null) {
    $post_name = '';

    if (is_main_query() || is_page() || is_single()) {
        $page_id = get_queried_object_id();
        $post_name = get_the_title($page_id);
    }

    return apply_filters('kopa_shortcode_post_name', $post_name);
}