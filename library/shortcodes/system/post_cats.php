<?php

add_shortcode('post_cats', 'kopa_shortcode_post_cats');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_post_cats($atts, $content = null) {
    $post_cats = array();

    if (is_main_query() || is_single()) {
        $post_id = get_queried_object_id();
        $terms = get_the_terms($post_id, 'category');
        if ($terms) {
            foreach ($terms as $term) {
                $post_cats[] = $term->name;
            }
        }
    }

    return apply_filters('kopa_shortcode_post_cats', implode(', ', $post_cats));
}