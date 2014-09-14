<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_single_post() {    
    /*
     * ------------------------------------------------------------
     * METADATA
     * ------------------------------------------------------------
     */
    $groups['metadata'] = array(
        'icon' => '',
        'title' => __('Metadata', kopa_get_domain()),
        'fields' => array()
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_thumbnail_standard',
        'name' => 'is_display_post_thumbnail_standard',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Thumbnail (standard post)', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_thumbnail_other',
        'name' => 'is_display_post_thumbnail_other',
        'value' => 'false',
        'default' => 'false',
        'label' => __('Thumbnail (other format)', kopa_get_domain()),
        'help' => __('Other format e.g. <code>Video</code> <code>Audio</code> <code>Gallery</code> <code>Aside</code> <code>Quote</code> <code>Status</code> ...', kopa_get_domain()),
        'help_classes' => array(),
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_category',
        'name' => 'is_display_post_category',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Categories', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_tag',
        'name' => 'is_display_post_tag',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Tags', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_datetime',
        'name' => 'is_display_post_datetime',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Created date', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );    
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_comments',
        'name' => 'is_display_post_comments',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Number of comments', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_views',
        'name' => 'is_display_post_views',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Number of views', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_likes',
        'name' => 'is_display_post_likes',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Number of likes', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['metadata']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_shares',
        'name' => 'is_display_post_shares',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Share buttons', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    
    /*
     * ------------------------------------------------------------
     * AUTHOR
     * ------------------------------------------------------------
     */
    $groups['author'] = array(
        'icon' => '',
        'title' => __('Author', kopa_get_domain()),
        'fields' => array()
    );
    $groups['author']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_author_information',
        'name' => 'is_display_post_author_information',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Author information', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['author']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_author_social_links',
        'name' => 'is_display_post_author_social_links',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Author social links', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    
    /*
     * ------------------------------------------------------------
     * PREV & NEXT POSTS
     * ------------------------------------------------------------
     */
    $groups['prev-next-links'] = array(
        'icon' => '',
        'title' => __('Previous & Next Post Links', kopa_get_domain()),
        'fields' => array()
    );
    $groups['prev-next-links']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_prev_next_links',
        'name' => 'is_display_post_prev_next_links',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Prev & next post links', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    $groups['prev-next-links']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_prev_next_links_same_cat',
        'name' => 'is_display_post_prev_next_links_same_cat',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Is same category', kopa_get_domain()),
        'help' => '',
        'true' => __('Yes', kopa_get_domain()),
        'false' => __('No', kopa_get_domain()),
    );
    /*
     * ------------------------------------------------------------
     * RELATED POSTS
     * ------------------------------------------------------------
     */
    $groups['related-posts'] = array(
        'icon' => '',
        'title' => __('Related Post', kopa_get_domain()),
        'fields' => array()
    );
    $groups['related-posts']['fields'][] = array(
        'type' => 'select',
        'id' => 'post_related_posts_get_by',
        'name' => 'post_related_posts_get_by',
        'value' => 'post_tag',
        'default' => 'post_tag',
        'label' => __('Get by', kopa_get_domain()),
        'help' => '',
        'options' => array(
            'category' => __('Category', kopa_get_domain()),
            'post_tag' => __('Tag', kopa_get_domain()),
        )
    );
    $groups['related-posts']['fields'][] = array(
        'type' => 'select-number',
        'id' => 'post_related_posts_limit',
        'name' => 'post_related_posts_limit',
        'label' => __('Number of posts', kopa_get_domain()),
        'help' => __('Select <code>0</code> to hide this section.', kopa_get_domain()),
        'default' => 4,
        'min' => 0,
        'max' => 40,
        'step' => 1
    );
    
    /*
     * ------------------------------------------------------------
     * COMMENTS
     * ------------------------------------------------------------
     */
    $groups['comments'] = array(
        'icon' => '',
        'title' => __('Comment System', kopa_get_domain()),
        'fields' => array()
    );
    $groups['comments']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'is_display_post_comments_system',
        'name' => 'is_display_post_comments_system',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Default comment system', kopa_get_domain()),
        'help' => '',
        'true' => __('Show', kopa_get_domain()),
        'false' => __('Hide', kopa_get_domain()),
    );
    return apply_filters('kopa_options_single_post', $groups);
}
