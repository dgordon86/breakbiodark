<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_social_links() {
    $groups['social-links'] = array(
        'icon' => '',
        'title' => __('Social Links', kopa_get_domain()),
        'fields' => array()
    );
    $social_icons = KopaInit::get_social_icons();
    if ($social_icons) {
        foreach ($social_icons as $slug => $info) {
            $groups['social-links']['fields'][] = array(
                'type' => 'text',
                'id' => "social_link_{$slug}",
                'name' => "social_link_{$slug}",
                'label' => sprintf('%s <i class="%s kps-iconmoon pull-right" style="color:%s"></i>', $info['title'], $info['icon'], $info['color']),
                'help' => isset($info['help']) ? $info['help'] : '',
                'default' => ''
            );
        }
    }
   
    return apply_filters('kopa_options_social_links', $groups);
}