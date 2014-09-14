<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_elements() {
    $groups['lightbox'] = array(
        'icon' => '',
        'title' => __('Lightbox (Pretty Photo)', kopa_get_domain()),
        'fields' => array()
    );
    $groups['lightbox']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_play_video_on_lightbox',
        'name' => 'is_play_video_on_lightbox',
        'label' => __('Play video on lighbox', kopa_get_domain()),
        'help' => NULL,
        'default' => 'true',
        'true' => __('Yes', kopa_get_domain()),
        'false' => __('No', kopa_get_domain()),
    );
    $groups['lightbox']['fields'][] = array(
        'type' => 'select',
        'id' => 'lightbox_skin',
        'name' => 'lightbox_skin',
        'label' => __('Skin', kopa_get_domain()),
        'help' => NULL,
        'default' => 'pp_default',
        'options' => array(
            'pp_default' => __('Default', kopa_get_domain()),
            'facebook' => __('Facebook', kopa_get_domain()),
            'dark_rounded' => __('Dark rounded', kopa_get_domain()),
            'dark_square' => __('Dark square', kopa_get_domain()),
            'light_rounded' => __('Light rounded', kopa_get_domain()),
            'light_square' => __('Light square', kopa_get_domain()),
        )
    );
    $groups['lightbox']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_lightbox_modal_mode',
        'name' => 'is_lightbox_modal_mode',
        'label' => __('Modal mode', kopa_get_domain()),
        'help' => __('If set to Yes, only the close button will close the window', kopa_get_domain()),
        'default' => 'true',
        'true' => __('Enable', kopa_get_domain()),
        'false' => __('Disable', kopa_get_domain()),
    );
    $groups['lightbox']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_lightbox_show_title',
        'name' => 'is_lightbox_show_title',
        'label' => __('Title', kopa_get_domain()),
        'default' => 'true',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['lightbox']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_lightbox_social_tools',
        'name' => 'is_lightbox_social_tools',
        'label' => __('Sharing with Facebook, Twitter', kopa_get_domain()),
        'default' => 'true',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['lightbox']['fields'][] = array(
        'type' => 'select-number',
        'id' => 'lightbox_opacity',
        'name' => 'lightbox_opacity',
        'label' => __('Overlay Opacity', kopa_get_domain()),
        'help' => __('Value between 0% and 100%', kopa_get_domain()),
        'default' => 70,
        'min' => 0,
        'max' => 100,
        'step' => 5,
        'suffix' => '%'
    );
    return apply_filters('kopa_options_lightbox', $groups);
}
