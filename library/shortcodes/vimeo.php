<?php

$vimeo_params = array();
$vimeo_params['title'] = ('true' == KopaOptions::get_option('is_show_vimeo_title', 'false')) ? 1 : 0;
$vimeo_params['byline'] = (int) ('true' == KopaOptions::get_option('is_show_vimeo_byline', 'false')) ? 1 : 0;
$vimeo_params['portrait'] = (int) ('true' == KopaOptions::get_option('is_show_vimeo_portrait', 'false')) ? 1 : 0;
$vimeo_params['color'] = str_replace('#', '', KopaOptions::get_option('vimeo_color', '#00adef'));

$vimeo_url_params = array();
foreach ($vimeo_params as $key => $val) {
    $vimeo_url_params[] = "{$key}={$val}";
}

add_shortcode('vimeo', 'kopa_shortcode_vimeo');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_vimeo($atts, $content = null) {
    extract(shortcode_atts(array('id' => ''), $atts));
    $out = NULL;

    if (isset($atts['id']) && !empty($atts['id'])) {
        global $vimeo_url_params;
        $out .= '<div class="video-wrapper"><iframe src="http://player.vimeo.com/video/' . $atts['id'] . '?' . implode('&', $vimeo_url_params) . '" frameborder="0" allowfullscreen></iframe></div>';
    }

    return apply_filters('kopa_shortcode_vimeo', force_balance_tags($out));
}
