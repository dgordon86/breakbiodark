<?php

add_shortcode('dropcap', 'kopa_shortcode_dropcap');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_dropcap($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('class' => ''), $atts));
        $class = isset($atts['class']) ? $atts['class'] : 'kp-dropcap';
        return apply_filters('kopa_shortcode_dropcap', sprintf('<span class="%s">%s</span>', $class, $content));
    }
}