<?php

add_shortcode('toggles', 'kopa_shortcode_toggles');
add_shortcode('toggle', 'kopa_shortcode_toggle');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_toggles($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = KopaUtil::get_shortcode($content, true, array('toggle'));
    $panels = array();

    if ($items) {
        foreach ($items as $item) {
            $title = $item['atts']['title'];
            $tmp = sprintf('<h3>%s</h3>', $title);
            $tmp .= sprintf('<div>%s</div>', do_shortcode($item['content']));
            $panels[] = $tmp;
        }
    }
    $output = '<div class="kp-accordion">';
    $output.= implode('', $panels);
    $output.= '</div>';

    return apply_filters('kopa_shortcode_toggles', $output);
}

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_toggle() {
    return false;
}
