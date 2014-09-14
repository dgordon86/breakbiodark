<?php

$youtube_params = array();
$youtube_params['showinfo'] = ('true' == KopaOptions::get_option('is_youtube_showinfo', 'false')) ? 1 : 0;
$youtube_params['hd'] = (int) ('true' == KopaOptions::get_option('is_youtube_hd_enable', 'false')) ? 1 : 0;
$youtube_params['rel'] = (int) ('true' == KopaOptions::get_option('is_youtube_rel_enable', 'false')) ? 1 : 0;
$youtube_params['theme'] = KopaOptions::get_option('youtube_theme', 'light');
$youtube_params['controls'] = (int) KopaOptions::get_option('youtube_controls', '2');

$youtube_url_params = array();
foreach ($youtube_params as $key => $val) {
    $youtube_url_params[] = "{$key}={$val}";
}

add_shortcode('youtube', 'kopa_shortcode_youtube');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_youtube($atts, $content = null) {
    extract(shortcode_atts(array('id' => ''), $atts));
    $out = NULL;

    if (isset($atts['id']) && !empty($atts['id'])) {
        global $youtube_url_params;

        $out .= '<div class="video-wrapper"><iframe src="http://www.youtube.com/embed/' . $atts['id'] . '?' . implode('&', $youtube_url_params) . '" frameborder="0" allowfullscreen></iframe></div>';
    }

    return apply_filters('kopa_shortcode_youtube', force_balance_tags($out));
}
