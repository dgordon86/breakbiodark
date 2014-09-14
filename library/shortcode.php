<?php

add_action('admin_init', 'kopa_shortcode_add_button');

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_shortcode_add_button() {
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'kopa_add_plugin');
        add_filter('mce_buttons', 'kopa_register_button');
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_add_plugin($plugin_array) {
    $plugin_array['kopa_shortcode'] = get_template_directory_uri() . '/library/js/kopa.tinymce.js';   
    return $plugin_array;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_register_button($buttons) {
    $buttons[] = 'kopa_shortcode';
    return $buttons;
}
