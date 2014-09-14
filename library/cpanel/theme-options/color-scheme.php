<?php

/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_color_scheme() {
    $groups['main-color'] = array(
        'icon' => '',
        'title' => __('Pre defined colors', kopa_get_domain()),
        'fields' => array()
    );
    $groups['main-color']['fields'][] = array(
        'type' => 'color-swatches-single',
        'id' => 'colors',
        'name' => 'colors',
        'label' => NULL,
        'help' => '',
        'default' => '#D40202',
        'control_begin' => '<div class="col-xs-12">',
        'control_end' => '</div>',
        'colors' => array(
            array(
                'primary' => '#D40202',
                'label' => NULL,
                'classes' => array()
            ),
            array(
                'primary' => 'customize',
                'label' => '<i class="dashicons dashicons-plus"></i>',
                'classes' => array('color-swatches-single-custom')
            ),
        )
    );
    /**
     * CUSTOM COLORS
     */
    $groups['custom-color'] = array(
        'icon' => '',
        'title' => __('Custom colors', kopa_get_domain()),
        'fields' => array()
    );

    $groups['custom-color']['fields'][] = array(
        'type' => 'color',
        'id' => 'primary_color',
        'name' => 'primary_color',
        'label' => __('Primary color', kopa_get_domain()),
        'help' => '',
        'default' => '#D40202',
        'classes' => array('mc-primary')
    );

    return apply_filters('kopa_options_styling', $groups);
}
