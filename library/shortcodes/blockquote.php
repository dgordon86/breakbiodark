<?php

add_shortcode('blockquote', 'kopa_shortcode_blockquote');

/**
 * 
 * Register blockquote shortcode, and filter "kopa_shortcode_blockquote"
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_blockquote($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('class' => ''), $atts));
        $class = isset($atts['class']) ? $atts['class'] : 'kp-blockquote';
        return apply_filters('kopa_shortcode_blockquote', sprintf('<blockquote class="%s">%s</blockquote>', $class, $content));
    }
}
