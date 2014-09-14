<?php

$tmp_kopaSettings = get_option(KOPA_OPT_PREFIX . 'layout_settings');

$post = new KopaPosttype('Page', 'page', '', array(), array(), array(), array(), array(
    'styles' => array(        
        KOPA_OPT_PREFIX . 'bootstrap',
        KOPA_OPT_PREFIX . 'ui',
        KOPA_OPT_PREFIX . 'layout-manager'
    ),
    'scripts' => array(
        KOPA_OPT_PREFIX . 'bootstrap',
        KOPA_OPT_PREFIX . 'shortcodes',
        KOPA_OPT_PREFIX . 'ui',
        KOPA_OPT_PREFIX . 'layout-manager'
        )));

$metaboxes['fields'] = array(    
    array(
        'type' => 'checkbox',
        'id' => KOPA_OPT_PREFIX . 'is_use_custom_layout',
        'name' => KOPA_OPT_PREFIX . 'is_use_custom_layout',
        'default' => 'false',
        'classes' => array('ckb_is_use_custom_layout_toggle'),
        'label' => __('Is use custom layout for this page', kopa_get_domain()),
        'is_append_label_before_control' => false,
        'help' => NULL,
        'attributes' => array(
            'onchange' => 'KopaLayout.isUseCustomLayoutToggle(event, jQuery(this));'
        )
    ),
    array(
        'type' => 'layout',
        'id' => KOPA_OPT_PREFIX . 'layout',
        'name' => KOPA_OPT_PREFIX . 'layout',
        'default' => $tmp_kopaSettings['page'],
        'template_hierarchy' => 'page'
    ),
);

$post->add_meta_box(__('Layout & Sidebar Options', kopa_get_domain()), 'kopa-metabox-page-layout-manage', $metaboxes);


/**
 * Add metaboxes "SEO" for Post
 */
if ('true' == KopaOptions::get_option('seo_status', 'false')) {
    $metaboxes['fields'] = array(
        array(
            'type' => 'textarea',
            'id' => KOPA_OPT_PREFIX . 'seo_keywords',
            'name' => KOPA_OPT_PREFIX . 'seo_keywords',
            'label' => __('Keywords', kopa_get_domain()),
            'help' => __('Enter keyword(s) of current page, separated by comma.', kopa_get_domain()),
            'classes' => array('linedtextarea'),
            'attributes' => array(
                'rows' => 4
            ),
            'default' => ''
        ),
        array(
            'type' => 'textarea',
            'id' => KOPA_OPT_PREFIX . 'seo_descriptions',
            'name' => KOPA_OPT_PREFIX . 'seo_descriptions',
            'label' => __('Description', kopa_get_domain()),
            'help' => __('Enter description of current page', kopa_get_domain()),
            'classes' => array('linedtextarea'),
            'attributes' => array(
                'rows' => 4
            ),
            'default' => ''
        )
    );

    $post->add_meta_box(__('SEO - Search engine optimization', kopa_get_domain()), 'kopa-metabox-post-seo', $metaboxes);
}