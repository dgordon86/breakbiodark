<?php

add_shortcode('site_desc', 'kopa_shortcode_site_desc');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_site_desc($atts, $content = null) {
    return apply_filters('kopa_shortcode_site_desc', get_bloginfo('description', 'display'));
}