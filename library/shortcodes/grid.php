<?php

add_shortcode('row', 'kopa_shortcode_row');
add_shortcode('col', 'kopa_shortcode_col');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_row($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = KopaUtil::get_shortcode($content, true, array('col'));
    $panels = array();

    if ($items) {
        foreach ($items as $item) {
            $panels[] = sprintf('<div class="col-sm-%s">%s</div>', $item['atts']['col'], do_shortcode($item['content']));
        }
    }

    $output = '<div class="row clearfix">';
    $output.= implode('', $panels);
    $output.= '</div>';

    return apply_filters('kopa_shortcode_row', $output);
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
function kopa_shortcode_col() {
    return false;
}