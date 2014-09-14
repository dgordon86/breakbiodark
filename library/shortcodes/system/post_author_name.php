<?php

add_shortcode('post_author_name', 'kopa_shortcode_post_author_name');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_post_author_name($atts, $content = null) {
    $post_author_name = '';

    if (is_main_query() || is_single() || is_page()) {
        $post = get_queried_object();
        $user_id = $post->post_author;
        $post_author_name = get_the_author_meta('display_name', $user_id);
    }

    return apply_filters('kopa_shortcode_post_author_name', $post_author_name);
}