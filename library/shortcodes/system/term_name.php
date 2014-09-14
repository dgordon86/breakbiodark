<?php

add_shortcode('term_name', 'kopa_shortcode_term_name');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_term_name($atts, $content = null) {
    $term_name = '';
    if (is_tag() || is_category()) {
        $term_name = single_term_title('', false);
    }
    return apply_filters('kopa_shortcode_term_name', $term_name);
}
