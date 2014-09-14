<?php

add_shortcode('tabs', 'kopa_shortcode_tabs');
add_shortcode('tab', 'kopa_shortcode_tab');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_tabs($atts, $content = null) {
    extract(shortcode_atts(array(
        'style' => 'horizontal',
        'width' => 200
                    ), $atts));

    $style = !empty($atts['style']) && in_array($atts['style'], array('horizontal', 'vertical')) ? $atts['style'] : 'horizontal';

    $width = '';
    if ('vertical' == $style) {
        $width = !empty($atts['width']) ? (int) $atts['width'] : 200;
        $width = sprintf('style="width:%spx;"', ($width > 0) ? $width : 200);
    }

    $items = KopaUtil::get_shortcode($content, true, array('tab'));
    $navs = array();
    $panels = array();

    if ($items) {
        $active = 'active';
        foreach ($items as $item) {
            $title = $item['atts']['title'];
            $item_id = 'tab-' . wp_generate_password(4, false, false);

            $navs[] = sprintf('<li><a href="#%s">%s</a></li>', $item_id, do_shortcode($title));
            $panels[] = sprintf('<div id="%s">%s</div>', $item_id, do_shortcode($item['content']));

            $active = '';
        }
    }

    $output = sprintf('<div class="kp-tabs tab-%s">', $style);
    $output.= sprintf('<ul %s>', $width);
    $output.= implode('', $navs);
    $output.= '</ul>';
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
function kopa_shortcode_tab() {
    return false;
}
