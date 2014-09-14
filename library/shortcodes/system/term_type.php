<?php

add_shortcode('term_type', 'kopa_shortcode_term_type');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_term_type($atts, $content = null) {
    $term_type = '';
    if (is_main_query() && is_tag() || is_category()) {
        $term = get_queried_object();

        switch ($term->taxonomy) {
            case 'category':
                $term_type = __('Category', kopa_get_domain());
                break;
            case 'post_tag':
                $term_type = __('Tag', kopa_get_domain());
                break;
        }
    }

    return apply_filters('kopa_shortcode_term_type', $term_type);
}
