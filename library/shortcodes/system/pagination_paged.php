<?php

add_shortcode('pagination_paged', 'kopa_shortcode_pagination_paged');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_pagination_paged($atts, $content = null) {
    $pagination_paged = '';

    if (is_archive() || is_home()) {
        global $page, $paged;
        $current_page = (int) max($paged, $page);
        $pagination_paged = sprintf(__('Page %s', kopa_get_domain()), ($current_page > 0) ? $current_page : 1);
    }

    return apply_filters('kopa_shortcode_pagination_paged', $pagination_paged);
}