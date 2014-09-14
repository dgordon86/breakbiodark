<?php

$tmp_kopaSettings = get_option(KOPA_OPT_PREFIX . 'layout_settings');


$post = new KopaPosttype('Post', 'post', '', array(), array(), array(), array(), array(
    'styles' => array(                
        KOPA_OPT_PREFIX . 'bootstrap',
        KOPA_OPT_PREFIX . 'ui',
        KOPA_OPT_PREFIX . 'layout-manager'
    ),
    'scripts' => array(
        KOPA_OPT_PREFIX . 'bootstrap',
        KOPA_OPT_PREFIX . 'shortcodes',
        KOPA_OPT_PREFIX . 'ui',
        KOPA_OPT_PREFIX . 'layout-manager',
        KOPA_OPT_PREFIX . 'metabox')));

/**
 * Add metaboxes "Layout & Sidebar Options" for POST
 */
$metaboxes['fields'] = array(
    array(
        'type' => 'checkbox',
        'id' => KOPA_OPT_PREFIX . 'is_use_custom_layout',
        'name' => KOPA_OPT_PREFIX . 'is_use_custom_layout',
        'default' => 'false',
        'classes' => array('ckb_is_use_custom_layout_toggle'),
        'label' => __('Is use custom layout for this post', kopa_get_domain()),
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
        'default' => $tmp_kopaSettings['post'],
        'template_hierarchy' => 'post'
    ),
);

$post->add_meta_box(__('Layout & Sidebar Options', kopa_get_domain()), 'kopa-metabox-post-layout-manage', $metaboxes);


/**
 * Add metaboxes "Custom Thumbnails" for POST
 */
if ('true' == KopaOptions::get_option('is_use_custom_thumbnail', 'false')) {
    $sizes = KopaInit::get_image_sizes();
    if (!empty($sizes)) {
        $second_metaboxes['fields'] = array();

        $second_metaboxes['fields'][] = array(
            'type' => 'checkbox',
            'id' => KOPA_OPT_PREFIX . 'is_use_custom_thumbnail',
            'name' => KOPA_OPT_PREFIX . 'is_use_custom_thumbnail',
            'default' => 'false',
            'classes' => array('ckb_is_use_custom_thumbnail_toggle'),
            'label' => __('Is use custom thumbnail for this post', kopa_get_domain()),
            'is_append_label_before_control' => false,
            'help' => NULL,
            'attributes' => array(
                'onchange' => 'KopaMetabox.isUseCustomThumbnailToggle(event, jQuery(this));'
            )
        );

        foreach ($sizes as $name => $size) {
            $second_metaboxes['fields'][] = array(
                'type' => 'media',
                'id' => KOPA_OPT_PREFIX . "thumbnail_{$name}",
                'name' => KOPA_OPT_PREFIX . "thumbnail_{$name}",
                'label' => $size['name'],
                'help' => $size['desc'],
                'default' => ''
            );
        }

        $post->add_meta_box(__('Custom Thumbnails', kopa_get_domain()), 'kopa-metabox-post-custom-thumbnail', $second_metaboxes);
    }
}

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
            'help' => __('Enter keyword(s) of current post, separated by comma.', kopa_get_domain()),
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
            'help' => __('Enter description of current post', kopa_get_domain()),
            'classes' => array('linedtextarea'),
            'attributes' => array(
                'rows' => 4
            ),
            'default' => ''
        )
    );

    $post->add_meta_box(__('SEO - Search engine optimization', kopa_get_domain()), 'kopa-metabox-post-seo', $metaboxes);
}

/**
 * Add metaboxes for post's taxonomies
 */
$limis = array();
$limis['inherit'] = __('-- Inherit setting from Reading Settings --', kopa_get_domain());
$limis['-1'] = __('Display all posts on a page', kopa_get_domain());
for ($i = 1; $i <= 100; $i++) {
    $limis[$i] = $i;
}


$taxonomy_fields = array();

$taxonomy_fields[] = array(
    'type' => 'select',
    'id' => KOPA_OPT_PREFIX . 'posts_per_page',
    'name' => KOPA_OPT_PREFIX . 'posts_per_page',
    'label' => __('Posts per page', kopa_get_domain()),
    'default' => 'inherit',
    'classes' => array('percent30'),
    'options' => $limis
);

$taxonomy_fields[] = array(
    'type' => 'select',
    'id' => KOPA_OPT_PREFIX . 'is_display_content_formatted',
    'name' => KOPA_OPT_PREFIX . 'is_display_content_formatted',
    'default' => 'inherit',
    'label' => __('Is display content formatted', kopa_get_domain()),
    'classes' => array('percent30'),
    'options' => array(
        'inherit' => __('-- Inherit setting from Theme Options --', kopa_get_domain()),
        'true' => __('Yes', kopa_get_domain()),
        'false' => __('No', kopa_get_domain())
    )
);

$taxonomy_fields[] = array(
    'type' => 'checkbox',
    'id' => KOPA_OPT_PREFIX . 'is_use_custom_layout',
    'name' => KOPA_OPT_PREFIX . 'is_use_custom_layout',
    'default' => 'false',
    'classes' => array('ckb_is_use_custom_layout_toggle'),
    'label' => __('Is use custom layout for this post', kopa_get_domain()),
    'is_append_label_before_control' => false,
    'help' => NULL,
    'attributes' => array(
        'onchange' => 'KopaLayout.isUseCustomLayoutToggle(event, jQuery(this));'
    )
);

$taxonomy_fields[] = array(
    'type' => 'layout',
    'id' => KOPA_OPT_PREFIX . 'layout',
    'name' => KOPA_OPT_PREFIX . 'layout',
    'label' => NULL,
    'default' => $tmp_kopaSettings['taxonomy'],
    'template_hierarchy' => 'taxonomy'
);


if ('true' == KopaOptions::get_option('seo_status', 'false')) {

    $taxonomy_fields[] = array(
        'type' => 'textarea',
        'id' => KOPA_OPT_PREFIX . 'seo_keywords',
        'name' => KOPA_OPT_PREFIX . 'seo_keywords',
        'label' => __('Keywords', kopa_get_domain()),
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 4
        ),
        'default' => ''
    );

    $taxonomy_fields[] = array(
        'type' => 'textarea',
        'id' => KOPA_OPT_PREFIX . 'seo_descriptions',
        'name' => KOPA_OPT_PREFIX . 'seo_descriptions',
        'label' => __('Description', kopa_get_domain()),
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 4
        ),
        'default' => ''
    );
}

$post->add_taxonomy_fields($taxonomy_fields, 'category');
$post->add_taxonomy_fields($taxonomy_fields, 'post_tag');
