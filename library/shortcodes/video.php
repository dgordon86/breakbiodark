<?php

add_filter('wp_video_shortcode', 'kopa_video_shortcode');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_video_shortcode($html) {
    if (!empty($html)) {
        $out = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
        $out = preg_replace('/(width|height)="\d*"\s/', "", $out);
    }

    return $out;
}
