<?php

add_shortcode('button', 'kopa_shortcode_button');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_button($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'link' => '', 'target' => ''), $atts));

    $link = isset($atts['link']) ? $atts['link'] : '#';
    $class = isset($atts['class']) ? $atts['class'] : 'kp-button';
    $target = isset($atts['target']) ? $atts['target'] : '';

    $output = sprintf('<a href="%s" class="%s" target="%s">%s</a>', $link, $class, $target, do_shortcode($content));
    return apply_filters('kopa_shortcode_button', $output);
}