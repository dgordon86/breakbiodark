<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_custom_css() {
    $groups['custom-css'] = array(
        'icon' => '',
        'title' => __('Custom CSS', kopa_get_domain()),
        'fields' => array()
    );
    $groups['custom-css']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'custom_css',
        'name' => 'custom_css',
        'label' => NULL,
        'help' => NULL,
        'default' => '',        
        'classes' => array('txa_large','linedtextarea'),
        'control_begin' => '<div class="col-md-12">',
        'control_end' => '</div>'
    );
    return apply_filters('kopa_options_custom_css', $groups);
}
