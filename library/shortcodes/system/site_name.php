<?php

add_shortcode('site_name', 'kopa_shortcode_site_name');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_site_name($atts, $content = null) {
    return apply_filters('kopa_shortcode_site_name', get_bloginfo('name'));
}