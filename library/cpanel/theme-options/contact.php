<?php

/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_contact() {
    $groups['info'] = array(
        'icon' => '',
        'title' => __('Contact Infomation', kopa_get_domain()),
        'fields' => array()
    );
    $groups['info']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_info_caption',
        'name' => 'contact_info_caption',
        'label' => __('Caption', kopa_get_domain()),
        'help' => '',
        'classes' => array('linedtextarea'),
        'default' => __('Contact information', kopa_get_domain())
    );
    $groups['info']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'contact_info_description',
        'name' => 'contact_info_description',
        'label' => __('Descripton', kopa_get_domain()),
        'help' => '',
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 10
        ),
        'default' => ''
    );
    $groups['info']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_phone',
        'name' => 'contact_phone',
        'label' => __('Phone number', kopa_get_domain()),
        'default' => ''
    );
    $groups['info']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_fax',
        'name' => 'contact_fax',
        'label' => __('Fax number', kopa_get_domain()),
        'default' => ''
    );
    $groups['info']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_email',
        'name' => 'contact_email',
        'label' => __('Email(s)', kopa_get_domain()),
        'default' => ''
    );
    $groups['info']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_address',
        'name' => 'contact_address',
        'label' => __('Address', kopa_get_domain()),
        'default' => ''
    );
    $groups['info']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_map',
        'name' => 'contact_map',
        'label' => __('Google Map', kopa_get_domain()),
        'help' => sprintf('Enter your google map code <code>latitude,longitude</code>. Example: <code>40.722868,-73.99739</code>. %s <a target="_blank" href="https://db.tt/p77FqjZC">%s</a>.', __('How to get it? Click', kopa_get_domain()), __('here', kopa_get_domain())),
        'default' => '40.722868,-73.99739'
    );
    $groups['info']['fields'][] = array(
        'type' => 'media',
        'id' => 'contact_map_marker',
        'name' => 'contact_map_marker',
        'label' => __('Gmap Marker', kopa_get_domain()),
        'help' => __('You can download, and edit marker image from PSD file. Download <a href="https://db.tt/qssyQ4pY" target="_blank">here</a>', kopa_get_domain()),
        'default' => get_template_directory_uri() . '/images/marker.png'
    );
    /*
     * --------------------------------------------------
     * CONTACT FORM
     * --------------------------------------------------
     */
    $groups['form'] = array(
        'icon' => '',
        'title' => __('Contact Form', kopa_get_domain()),
        'fields' => array()
    );
    $groups['form']['fields'][] = array(
        'type' => 'text',
        'id' => 'contact_form_caption',
        'name' => 'contact_form_caption',
        'label' => __('Caption', kopa_get_domain()),
        'help' => '',
        'classes' => array('linedtextarea'),
        'default' => __('Contact form', kopa_get_domain())
    );
    $groups['form']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'contact_form_description',
        'name' => 'contact_form_description',
        'label' => __('Descripton', kopa_get_domain()),
        'help' => '',
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 10
        ),
        'default' => ''
    );
    $groups['form']['fields'][] = array(
        'type' => 'group',
        'id' => 'recaptcha',
        'name' => 'recaptcha',
        'label' => __('reCaptcha', kopa_get_domain()),
        'default' => '',
        'sub_fields' => array(
            array(
                'type' => 'select',
                'id' => 'recaptcha_skin',
                'name' => 'recaptcha_skin',
                'label' => __('<code>SKIN</code>', kopa_get_domain()),
                'help' => __('To view skins preview, click <a target="_blank" href="https://db.tt/cYvusoxp">here</a>.<br/>To create your public & private key, click <a target="_blank" href="http://www.google.com/recaptcha/whyrecaptcha">here</a>', kopa_get_domain()),
                'default' => 'clean',
                'value' => KopaOptions::get_option('recaptcha_skin', 'clean'),
                'options' => array(
                    'off' => __('-- Hide --', kopa_get_domain()),
                    'clean' => __('Clean', kopa_get_domain()),
                    'red' => __('Red', kopa_get_domain()),
                    'white' => __('White', kopa_get_domain()),
                    'blackglass' => __('Black glass', kopa_get_domain()),
                ),
                'classes' => array('kopa_sub_field_control', 'kopa_recaptcha_skin'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'label_begin' => '<div>',
                'label_end' => '</div>',
                'attributes' => array(
                    'onchange' => 'KopaThemeOptions.onChangeReCaptchaSkin(event, jQuery(this));'
                ),
            ),
            array(
                'type' => 'text',
                'id' => 'recaptcha_public_key',
                'name' => 'recaptcha_public_key',
                'value' => KopaOptions::get_option('recaptcha_public_key'),
                'default' => '6Lc6ou4SAAAAAF2yR3zRLTSljpTCPpdFRqWD5wXt',
                'label' => __('<code>PUBLIC KEY</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>'
            ),
            array(
                'type' => 'text',
                'id' => 'recaptcha_private_key',
                'name' => 'recaptcha_private_key',
                'value' => KopaOptions::get_option('recaptcha_private_key'),
                'default' => '6Lc6ou4SAAAAAO1_5edZqUythRWLGxgHGyDTYRUJ',
                'label' => __('<code>PRIVATE KEY</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>'
            ),
        )
    );
    $groups['form']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'contact_reply_template',
        'name' => 'contact_reply_template',
        'label' => __('Mail Reply Template', kopa_get_domain()),
        'help' => 'Variable: <code>[contact_name]</code>, <code>[contact_email]</code>, <code>[contact_message]</code>',
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 10
        ),
        'default' => '<p>Aloha!</p>
<p>You have a new message from  [contact_name] ([contact_email])</p>
<div>[contact_message]</div>
<p>Thanks!</p>'
    );
    return apply_filters('kopa_options_contact', $groups);
}
