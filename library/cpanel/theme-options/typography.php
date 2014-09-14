<?php

/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_typography() {
    $typo_caption = '<div class="kopa-font-ui-caption row clearfix">';
    $typo_caption.= '<div class="col-xs-4"><span>';
    $typo_caption.= sprintf('Font family', kopa_get_domain());
    $typo_caption.= '</span></div>';
    $typo_caption.= '<div class="col-xs-2"><span>';
    $typo_caption.= sprintf('Font size', kopa_get_domain());
    $typo_caption.= '</span></div>';
    $typo_caption.= '<div class="col-xs-2"><span>';
    $typo_caption.= sprintf('Font weight', kopa_get_domain());
    $typo_caption.= '</span></div>';
    $typo_caption.= '<div class="col-xs-2"><span>';
    $typo_caption.= sprintf('Line height', kopa_get_domain());
    $typo_caption.= '</span></div>';
    $typo_caption.= '<div class="col-xs-2"><span>';
    $typo_caption.= sprintf('Transform', kopa_get_domain());
    $typo_caption.= '</span></div>';
    $typo_caption.= '</div>';
    /**
     * BODY
     */
    $groups['common'] = array(
        'icon' => '',
        'title' => __('Common', kopa_get_domain()),
        'fields' => array()
    );
    $groups['common']['fields'][] = array(
        'type' => 'custom',
        'id' => 'common_caption',
        'name' => 'common_caption',
        'default' => NULL,
        'label' => '&nbsp;',
        'help' => NULL,
        'html' => $typo_caption
    );
    $groups['common']['fields'][] = array(
        'type' => 'font',
        'id' => 'body_font',
        'name' => 'body_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('Body', kopa_get_domain()),
        'help' => NULL
    );
    $groups['common']['fields'][] = array(
        'type' => 'font',
        'id' => 'widget_title_font',
        'name' => 'widget_title_font',
        'default' => array('family' => 'off', 'size' => 16, 'weight' => '400', 'line-height' => 16, 'text-transform' => 'none'),
        'label' => __('Widget title', kopa_get_domain()),
        'help' => NULL
    );
    /**
     * POST + PAGE
     */
    $groups['entry'] = array(
        'icon' => '',
        'title' => __('Post | Page', kopa_get_domain()),
        'fields' => array()
    );
    $groups['entry']['fields'][] = array(
        'type' => 'custom',
        'id' => 'entry_caption',
        'name' => 'entry_caption',
        'default' => NULL,
        'label' => '&nbsp;',
        'help' => NULL,
        'html' => $typo_caption
    );
    $groups['entry']['fields'][] = array(
        'type' => 'font',
        'id' => 'entry_title_font',
        'name' => 'entry_title_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('Title', kopa_get_domain()),
        'help' => NULL
    );
    $groups['entry']['fields'][] = array(
        'type' => 'font',
        'id' => 'entry_content_font',
        'name' => 'entry_content_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('Content', kopa_get_domain()),
        'help' => NULL
    );
    /**
     * NAVIGATION
     */
    $groups['navigation'] = array(
        'icon' => '',
        'title' => __('Navigation', kopa_get_domain()),
        'fields' => array()
    );
    $groups['navigation']['fields'][] = array(
        'type' => 'custom',
        'id' => 'navigation_caption',
        'name' => 'navigation_caption',
        'default' => NULL,
        'label' => '&nbsp;',
        'help' => NULL,
        'html' => $typo_caption
    );
    $groups['navigation']['fields'][] = array(
        'type' => 'font',
        'id' => 'nav_top_font',
        'name' => 'nav_top_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('Top', kopa_get_domain()),
        'help' => NULL
    );
    $groups['navigation']['fields'][] = array(
        'type' => 'font',
        'id' => 'nav_primary_font',
        'name' => 'nav_primary_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('Primary', kopa_get_domain()),
        'help' => NULL
    );
    $groups['navigation']['fields'][] = array(
        'type' => 'font',
        'id' => 'nav_bottom_font',
        'name' => 'nav_bottom_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('Bottom', kopa_get_domain()),
        'help' => NULL
    );
    /**
     * HEADING TAGs
     */
    $groups['heading'] = array(
        'icon' => '',
        'title' => __('Heading', kopa_get_domain()),
        'fields' => array()
    );
    $groups['heading']['fields'][] = array(
        'type' => 'custom',
        'id' => 'heading_caption',
        'name' => 'heading_caption',
        'default' => NULL,
        'label' => '&nbsp;',
        'help' => NULL,
        'html' => $typo_caption
    );
    $groups['heading']['fields'][] = array(
        'type' => 'font',
        'id' => 'h1_font',
        'name' => 'h1_font',
        'default' => array('family' => 'off', 'size' => 22, 'weight' => '400', 'line-height' => 22, 'text-transform' => 'none'),
        'label' => __('H1', kopa_get_domain()),
        'help' => NULL
    );
    $groups['heading']['fields'][] = array(
        'type' => 'font',
        'id' => 'h2_font',
        'name' => 'h2_font',
        'default' => array('family' => 'off', 'size' => 20, 'weight' => '400', 'line-height' => 20, 'text-transform' => 'none'),
        'label' => __('H2', kopa_get_domain()),
        'help' => NULL
    );
    $groups['heading']['fields'][] = array(
        'type' => 'font',
        'id' => 'h3_font',
        'name' => 'h3_font',
        'default' => array('family' => 'off', 'size' => 18, 'weight' => '400', 'line-height' => 18, 'text-transform' => 'none'),
        'label' => __('H3', kopa_get_domain()),
        'help' => NULL
    );
    $groups['heading']['fields'][] = array(
        'type' => 'font',
        'id' => 'h4_font',
        'name' => 'h4_font',
        'default' => array('family' => 'off', 'size' => 16, 'weight' => '400', 'line-height' => 16, 'text-transform' => 'none'),
        'label' => __('H4', kopa_get_domain()),
        'help' => NULL
    );
    $groups['heading']['fields'][] = array(
        'type' => 'font',
        'id' => 'h5_font',
        'name' => 'h5_font',
        'default' => array('family' => 'off', 'size' => 14, 'weight' => '400', 'line-height' => 14, 'text-transform' => 'none'),
        'label' => __('H5', kopa_get_domain()),
        'help' => NULL
    );
    $groups['heading']['fields'][] = array(
        'type' => 'font',
        'id' => 'h6_font',
        'name' => 'h6_font',
        'default' => array('family' => 'off', 'size' => 12, 'weight' => '400', 'line-height' => 12, 'text-transform' => 'none'),
        'label' => __('H6', kopa_get_domain()),
        'help' => NULL
    );

    /*
     * ------------------------------------------------------------
     * RELATED POSTS
     * ------------------------------------------------------------
     */
    $groups['character-sets'] = array(
        'icon' => '',
        'title' => __('Character sets (scripts)', kopa_get_domain()),
        'fields' => array()
    );
    $groups['character-sets']['fields'][] = array(
        'type' => 'select',
        'id' => 'character_sets',
        'name' => 'character_sets',
        'value' => array('latin'),
        'default' => '',
        'label' => __('Choose the character sets', kopa_get_domain()),
        'help' => '',
        'options' => array(
            'cyrillic' => __('Cyrillic', kopa_get_domain()),
            'cyrillic-ext' => __('Cyrillic Extended', kopa_get_domain()),
            'devanagari' => __('Devanagari', kopa_get_domain()),
            'greek' => __('Greek', kopa_get_domain()),
            'greek-ext' => __('Greek Extended', kopa_get_domain()),
            'khmer' => __('Khmer', kopa_get_domain()),
            'latin' => __('Latin', kopa_get_domain()),
            'latin-ext' => __('Latin Extended', kopa_get_domain()),
            'vietnamese' => __('Vietnamese', kopa_get_domain())
        ),
        'attributes' => array(
            'multiple' => 'multiple',
            'row' => 9
        )
    );

    return apply_filters('kopa_options_typography', $groups);
}
