<?php

/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_general() {
    /*
     * --------------------------------------------------
     * LOGO - FAVICON - ICON
     * --------------------------------------------------
     */
    $groups['logo-favicon-icon'] = array(
        'icon' => '',
        'title' => __('Logo - Favicon - Apple Icon', kopa_get_domain()),
        'fields' => array()
    );
    $groups['logo-favicon-icon']['fields'][] = array(
        'type' => 'media',
        'id' => 'logo',
        'name' => 'logo',
        'label' => __('Logo', kopa_get_domain()),
        'help' => NULL,
        'default' => '',
        'sub_fields' => array(
            array(
                'type' => 'number',
                'id' => 'logo_margin_top',
                'name' => 'logo_margin_top',
                'value' => KopaOptions::get_option('logo_margin_top', 0),
                'default' => 0,
                'label' => __('Top', kopa_get_domain()),
                'wrap_begin' => '<div class="kopa-opt-sub-fields"><p>' . __('Margin:', kopa_get_domain()) . '</p><div class="row cleardix"><div class="col-md-3">',
                'wrap_end' => '</div>',
                'suffix' => 'px'
            ),
            array(
                'type' => 'number',
                'id' => 'logo_margin_bottom',
                'name' => 'logo_margin_bottom',
                'value' => KopaOptions::get_option('logo_margin_bottom', 0),
                'default' => 0,
                'label' => __('Bottom', kopa_get_domain()),
                'wrap_begin' => '<div class="col-md-3">',
                'wrap_end' => '</div>',
                'suffix' => 'px'
            ),
            array(
                'type' => 'number',
                'id' => 'logo_margin_left',
                'name' => 'logo_margin_left',
                'value' => KopaOptions::get_option('logo_margin_left', 0),
                'default' => 0,
                'label' => __('Left', kopa_get_domain()),
                'wrap_begin' => '<div class="col-md-3">',
                'wrap_end' => '</div>',
                'suffix' => 'px'
            ),
            array(
                'type' => 'number',
                'id' => 'logo_margin_right',
                'name' => 'logo_margin_right',
                'value' => KopaOptions::get_option('logo_margin_right', 0),
                'default' => 0,
                'label' => __('Right', kopa_get_domain()),
                'wrap_begin' => '<div class="col-md-3">',
                'wrap_end' => '</div></div></div>',
                'suffix' => 'px'
            ),
        )
    );
    $groups['logo-favicon-icon']['fields'][] = array(
        'type' => 'media',
        'id' => 'favicon',
        'name' => 'favicon',
        'label' => __('Favicon', kopa_get_domain()),
        'help' => NULL,
        'default' => ''
    );
    $groups['logo-favicon-icon']['fields'][] = array(
        'type' => 'media',
        'id' => 'apple_icon',
        'name' => 'apple_icon',
        'label' => __('Apple Icon', kopa_get_domain()),
        'help' => __('Upload your <a target="_blank" href="https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html">apple icon</a> (152x152). This image will be crop to multi size for iPhone(retina), iPad(retina)', kopa_get_domain()),
        'default' => ''
    );
    /*
     * --------------------------------------------------
     * HEADER
     * --------------------------------------------------
     */
    $groups['header'] = array(
        'icon' => '',
        'title' => __('Header', kopa_get_domain()),
        'fields' => array()
    );

    $groups['header']['fields'][] = array(
        'type' => 'select',
        'id' => 'header_style',
        'name' => 'header_style',
        'default' => '1',
        'label' => __('Header Style', kopa_get_domain()),
        'options' => array(
            '1' => __('Top Menu - Logo - Top Banner - (ALLOW CUSTOM BACKGROUND COLOR)', kopa_get_domain()),
            '2' => __('Top Menu - Logo - Primary Menu - Search Box - (NO TOP-BANNER)', kopa_get_domain()),
        ),
        'attributes' => array(
            'style' => 'width: 100%;',
            'onchange' => 'KopaThemeOptions.onChangeHeaderStyle(event, jQuery(this));'
        )
    );
    
    $groups['header']['fields'][] = array(
        'type' => 'color',
        'id' => 'header_background_color',
        'name' => 'header_background_color',
        'label' => __('Header background color', kopa_get_domain()),
        'help' => '',
        'default' => '#141414'        
    );

    $groups['header']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_search_form',
        'name' => 'is_display_search_form',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Search form', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );

    /*
     * --------------------------------------------------
     * TOP BANNER
     * --------------------------------------------------
     */
    $groups['top-banner'] = array(
        'icon' => '',
        'title' => __('Top Banner', kopa_get_domain()),
        'fields' => array()
    );
    $groups['top-banner']['fields'][] = array(
        'type' => 'media',
        'id' => 'top_banner_image',
        'name' => 'top_banner_image',
        'label' => __('Image', kopa_get_domain()),
        'help' => NULL,
        'default' => ''
    );
    $groups['top-banner']['fields'][] = array(
        'type' => 'url',
        'id' => 'top_banner_url',
        'name' => 'top_banner_url',
        'label' => __('Link to', kopa_get_domain()),
        'help' => NULL,
        'default' => ''
    );
    $groups['top-banner']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_open_top_banner_on_new_tab',
        'name' => 'is_open_top_banner_on_new_tab',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Open on new Tab', kopa_get_domain()),
        'help' => NULL,
        'true' => __('Yes', kopa_get_domain()),
        'false' => __('No', kopa_get_domain()),
    );
    $groups['top-banner']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'top_banner_code',
        'name' => 'top_banner_code',
        'label' => __('Custom content', kopa_get_domain()),
        'help' => __('E.g. Google adsense code, or your custom HTML,...', kopa_get_domain()),
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 10
        ),
        'default' => ''
    );

    /*
     * --------------------------------------------------
     * HEADLINE
     * --------------------------------------------------
     */
    $groups['headline'] = array(
        'icon' => '',
        'title' => __('Headline', kopa_get_domain()),
        'fields' => array()
    );
    $groups['headline']['fields'][] = array(
        'type' => 'text',
        'id' => 'headline_prefix',
        'name' => 'headline_prefix',
        'label' => __('Prefix', kopa_get_domain()),
        'help' => NULL,
        'default' => __('Breaking News', kopa_get_domain()),
    );
    $groups['headline']['fields'][] = array(
        'type' => 'taxonomy',
        'id' => 'headline_cats',
        'name' => 'headline_cats',
        'label' => __('Categories', kopa_get_domain()),
        'help' => NULL,
        'default' => '',
        'taxonomy' => 'category',
        'attributes' => array(
            'multiple' => 'multiple'
        )
    );
    $groups['headline']['fields'][] = array(
        'type' => 'taxonomy',
        'id' => 'headline_tags',
        'name' => 'headline_tags',
        'label' => __('Tags', kopa_get_domain()),
        'help' => NULL,
        'default' => '',
        'taxonomy' => 'post_tag',
        'attributes' => array(
            'multiple' => 'multiple'
        )
    );
    $groups['headline']['fields'][] = array(
        'type' => 'taxonomy',
        'id' => 'headline_formats',
        'name' => 'headline_formats',
        'label' => __('Post formats', kopa_get_domain()),
        'help' => NULL,
        'default' => '',
        'taxonomy' => 'post_format',
        'attributes' => array(
            'multiple' => 'multiple'
        )
    );
    $groups['headline']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'headline_relation',
        'name' => 'headline_relation',
        'value' => 'false',
        'default' => 'false',
        'label' => __('Relation', kopa_get_domain()),
        'help' => __('Combine condition by <code>Tags</code> <code>Categories</code> and <code>Format</code>', kopa_get_domain()),
        'true' => __('Yes', kopa_get_domain()),
        'false' => __('No', kopa_get_domain()),
    );
    $groups['headline']['fields'][] = array(
        'type' => 'select',
        'id' => 'headline_timestamp',
        'name' => 'headline_timestamp',
        'default' => '',
        'classes' => array(),
        'label' => __('Timestamp (ago)', kopa_get_domain()),
        'help' => NULL,
        'options' => array(
            '' => __('-- Select --', kopa_get_domain()),
            '-1 week' => __('1 week', kopa_get_domain()),
            '-2 week' => __('2 weeks', kopa_get_domain()),
            '-3 week' => __('3 weeks', kopa_get_domain()),
            '-1 month' => __('1 months', kopa_get_domain()),
            '-2 month' => __('2 months', kopa_get_domain()),
            '-3 month' => __('3 months', kopa_get_domain()),
            '-4 month' => __('4 months', kopa_get_domain()),
            '-5 month' => __('5 months', kopa_get_domain()),
            '-6 month' => __('6 months', kopa_get_domain()),
            '-7 month' => __('7 months', kopa_get_domain()),
            '-8 month' => __('8 months', kopa_get_domain()),
            '-9 month' => __('9 months', kopa_get_domain()),
            '-10 month' => __('10 months', kopa_get_domain()),
            '-11 month' => __('11 months', kopa_get_domain()),
            '-1 year' => __('1 year', kopa_get_domain()),
            '-2 year' => __('2 years', kopa_get_domain()),
            '-3 year' => __('3 years', kopa_get_domain()),
            '-4 year' => __('4 years', kopa_get_domain()),
            '-5 year' => __('5 years', kopa_get_domain()),
            '-6 year' => __('6 years', kopa_get_domain()),
            '-7 year' => __('7 years', kopa_get_domain()),
            '-8 year' => __('8 years', kopa_get_domain()),
            '-9 year' => __('9 years', kopa_get_domain()),
            '-10 year' => __('10 years', kopa_get_domain()),
        )
    );
    $groups['headline']['fields'][] = array(
        'type' => 'select-number',
        'id' => 'headline_limit',
        'name' => 'headline_limit',
        'label' => __('Number of posts', kopa_get_domain()),
        'help' => __('Select <code>0</code> to hide headline.', kopa_get_domain()),
        'default' => '4',
        'min' => 0,
        'max' => 20,
        'step' => 1
    );

    /*
     * --------------------------------------------------
     * FOOTER
     * --------------------------------------------------
     */
    $groups['footer'] = array(
        'icon' => '',
        'title' => __('Footer', kopa_get_domain()),
        'fields' => array()
    );
    $groups['footer']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'copyright',
        'name' => 'copyright',
        'label' => __('Footer information', kopa_get_domain()),
        'help' => __('Enter the content you want to display in your footer (e.g. copyright text)', kopa_get_domain()),
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 10
        ),
        'default' => ''
    );
    /*
     * --------------------------------------------------
     * SYSTEM
     * --------------------------------------------------
     */
    $groups['system'] = array(
        'icon' => '',
        'title' => __('System', kopa_get_domain()),
        'fields' => array()
    );
    $groups['system']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_use_custom_thumbnail',
        'name' => 'is_use_custom_thumbnail',
        'value' => 'false',
        'default' => 'false',
        'label' => __('Custom thumbnail for each post', kopa_get_domain()),
        'help' => NULL,
        'true' => __('Enable', kopa_get_domain()),
        'false' => __('Disable', kopa_get_domain()),
    );
    $groups['system']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_use_breadcrumb',
        'name' => 'is_use_breadcrumb',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Breadcrumb', kopa_get_domain()),
        'help' => NULL,
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    return apply_filters('kopa_options_general', $groups);
}
