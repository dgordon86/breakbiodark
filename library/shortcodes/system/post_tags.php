<?php

add_shortcode('post_tags', 'kopa_shortcode_post_tags');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_post_tags($atts, $content = null) {
    $post_tags = array();

    if (is_main_query() || is_single()) {
        $post_id = get_queried_object_id();
        $terms = get_the_terms($post_id, 'post_tag');
        if ($terms) {
            foreach ($terms as $term) {
                $post_tags[] = $term->name;
            }
        }
    }

    return apply_filters('kopa_shortcode_post_tags', implode(', ', $post_tags));
}