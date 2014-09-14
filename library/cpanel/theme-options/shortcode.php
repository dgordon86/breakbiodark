<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_shortcode() {
    
    /*
     * YOUTUBE SHORTCODE
     * **************************** */
    $groups['youtube'] = array(
        'icon' => '',
        'title' => __('Youtube (shortcode)', kopa_get_domain()),
        'fields' => array()
    );
    $groups['youtube']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_youtube_showinfo',
        'name' => 'is_youtube_showinfo',
        'label' => __('Video information', kopa_get_domain()),
        'default' => 'true',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
        'help' => __('If you set the parameter value to <code>Hide</code>, then the player will not display information like the video title and uploader before the video starts playing.', kopa_get_domain())
    );
    $groups['youtube']['fields'][] = array(
        'type' => 'select',
        'id' => 'youtube_theme',
        'name' => 'youtube_theme',
        'label' => __('Theme', kopa_get_domain()),
        'help' => NULL,
        'default' => 'light',
        'options' => array(
            'dark ' => __('The Dark', kopa_get_domain()),
            'light' => __('The Light', kopa_get_domain()),
        )
    );
    $groups['youtube']['fields'][] = array(
        'type' => 'select',
        'id' => 'youtube_controls',
        'name' => 'youtube_controls',
        'label' => __('Coltrols', kopa_get_domain()),
        'help' => NULL,
        'default' => 2,
        'options' => array(
            0 => __('Player controls DO NOT display in the player.', kopa_get_domain()),
            1 => __('Player controls display in the player', kopa_get_domain()),
            2 => __('Player controls ONLY display in the player (after the user initiates the video playback)', kopa_get_domain()),
        )
    );
    $groups['youtube']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_youtube_hd_enable',
        'name' => 'is_youtube_hd_enable',
        'label' => __('HD playback by default', kopa_get_domain()),
        'default' => 'false',
        'true' => __('Enable', kopa_get_domain()),
        'false' => __('Disable', kopa_get_domain()),
        'help' => __('This has no effect on the Chromeless Player.<br/> This also has no effect if an HD version of the video is not available.', kopa_get_domain())
    );
    $groups['youtube']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_youtube_rel_enable',
        'name' => 'is_youtube_rel_enable',
        'label' => __('Related videos', kopa_get_domain()),
        'default' => 'true',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
        'help' => __('This option indicates whether the player should show related videos when playback of the initial video ends', kopa_get_domain())
    );
    /*
     * VIMEO SHORTCODE
     * **************************** */
    $groups['vimeo'] = array(
        'icon' => '',
        'title' => __('Vimeo (shortcode)', kopa_get_domain()),
        'fields' => array()
    );
    $groups['vimeo']['fields'][] = array(
        'type' => 'color',
        'id' => 'vimeo_color',
        'name' => 'vimeo_color',
        'label' => __('Color', kopa_get_domain()),
        'help' => 'Specify the color of the video controls',
        'default' => '#00adef'
    );
    $groups['vimeo']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_show_vimeo_title',
        'name' => 'is_show_vimeo_title',
        'label' => __('Title', kopa_get_domain()),
        'default' => 'false',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
        'help' => __('Show the title on the video', kopa_get_domain())
    );
    $groups['vimeo']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_show_vimeo_byline',
        'name' => 'is_show_vimeo_byline',
        'label' => __('Byline', kopa_get_domain()),
        'default' => 'false',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
        'help' => __("Show the user's byline on the video", kopa_get_domain())
    );
    $groups['vimeo']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_show_vimeo_portrait',
        'name' => 'is_show_vimeo_portrait',
        'label' => __('Portrait', kopa_get_domain()),
        'default' => 'true',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
        'help' => __("Show the user's portrait on the video", kopa_get_domain())
    );
    return apply_filters('kopa_options_shortcode', $groups);
}
