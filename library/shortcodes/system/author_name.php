<?php

add_shortcode('author_name', 'kopa_shortcode_author_name');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_author_name($atts, $content = null) {
    $author_name = '';

    if (is_main_query() || is_author()) {
        $author = get_queried_object();
        $author_name = $author->display_name;
    }

    return apply_filters('kopa_shortcode_author_name', $author_name);
}