<?php

add_shortcode('accordions', 'kopa_shortcode_accordions');
add_shortcode('accordion', 'kopa_shortcode_accordion');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_accordions($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = KopaUtil::get_shortcode($content, true, array('accordion'));
    $panels = array();

    if ($items) {        
        foreach ($items as $item) {
            $title = $item['atts']['title'];            
            $tmp = sprintf('<h3>%s</h3>', $title);
            $tmp .= sprintf('<div>%s</div>', do_shortcode($item['content']));
            $panels[] = $tmp;
        }
    }
    $output = '<div class="kp-accordion style-2">';
    $output.= implode('', $panels);
    $output.= '</div>';

    return apply_filters('kopa_shortcode_tabs', $output);
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
function kopa_shortcode_accordion() {
    return false;
}
