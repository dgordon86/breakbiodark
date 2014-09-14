<?php

add_shortcode('home_url', 'kopa_shortcode_home_url');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_home_url($atts, $content = null) {
    return apply_filters('kopa_shortcode_home_url', home_url());
}