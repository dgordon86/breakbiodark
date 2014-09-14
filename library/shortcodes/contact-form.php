<?php

add_shortcode('contact_form', 'kopa_shortcode_contact_form');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_contact_form($atts, $content = null) {
    global $kopa;
    $content = '';

    #Get config information
    $mail = KopaOptions::get_option('contact_email');
    $phone = KopaOptions::get_option('contact_phone');
    $fax = KopaOptions::get_option('contact_fax');
    $address = KopaOptions::get_option('contact_address');

    $google_map = KopaOptions::get_option('contact_map');
    $info_caption = KopaOptions::get_option('contact_info_caption');
    $info_description = KopaOptions::get_option('contact_info_description');
    $form_caption = KopaOptions::get_option('contact_form_caption');
    $form_description = KopaOptions::get_option('contact_form_description');

    $recaptcha_skin = KopaOptions::get_option('recaptcha_skin', 'off');
    $publickey = KopaOptions::get_option('recaptcha_public_key');
    $privatekey = KopaOptions::get_option('recaptcha_private_key');

    if ($google_map) {
        $maps_arr = explode(',', $google_map);
        if (2 == count($maps_arr)) {
            $content .= sprintf("<div id='kp-map' class='kp-map' data-latitude='%s' data-longitude='%s'></div>", $maps_arr[0], $maps_arr[1]);
        }
    }

    $content .= '<div class="contact-info">';
    $content .= '<div class="container">';
    $content .= $info_caption ? sprintf('<h3 class="contact-title">%s</h3>', $info_caption) : '';
    $content .= $info_description ? sprintf('<p>%s</p>', $info_description) : '';

    if ($mail || $phone || $working_time || $address) {
        $number_of_cols = 0;

        $number_of_cols = !empty($mail) ? ($number_of_cols + 1) : $number_of_cols;
        $number_of_cols = !empty($phone) ? ($number_of_cols + 1) : $number_of_cols;
        $number_of_cols = !empty($fax) ? ($number_of_cols + 1) : $number_of_cols;
        $number_of_cols = !empty($address) ? ($number_of_cols + 1) : $number_of_cols;

        $col_classes = array();

        switch ($number_of_cols) {
            case '1':
                $col_classes = array('col-xs-12');
                break;
            case '2':
                $col_classes = array('col-md-6', 'col-sm-6', 'col-xs-6');
                break;
            case '3':
                $col_classes = array('col-md-4', 'col-sm-6', 'col-xs-6');
                break;
            default:
                $col_classes = array('col-md-3', 'col-sm-6', 'col-xs-6');
                break;
        }

        $content .= '<div class="row">';

        if (!empty($address)) {
            $content .= sprintf('<div class="%s">', implode(' ', $col_classes));
            $content .= '<div class="item">';
            $content .= sprintf('<span>%s</span>', KopaIcon::getIcon('fa fa-map-marker'));
            $content .= sprintf('<h4>%s</h4>', __('Address', kopa_get_domain()));
            $content .= sprintf('<p>%s</p>', $address);
            $content .= '</div>';
            $content .= '</div>';
        }

        if (!empty($phone)) {
            $content .= sprintf('<div class="%s">', implode(' ', $col_classes));
            $content .= '<div class="item">';
            $content .= sprintf('<span>%s</span>', KopaIcon::getIcon('fa fa-phone'));
            $content .= sprintf('<h4>%s</h4>', __('Phone number', kopa_get_domain()));
            $content .= sprintf('<p>%s</p>', $phone);
            $content .= '</div>';
            $content .= '</div>';
        }

        if (!empty($fax)) {
            $content .= sprintf('<div class="%s">', implode(' ', $col_classes));
            $content .= '<div class="item">';
            $content .= sprintf('<span>%s</span>', KopaIcon::getIcon('fa fa-print'));
            $content .= sprintf('<h4>%s</h4>', __('Fax number', kopa_get_domain()));
            $content .= sprintf('<p>%s</p>', $fax);
            $content .= '</div>';
            $content .= '</div>';
        }

        if (!empty($mail)) {
            $content .= sprintf('<div class="%s">', implode(' ', $col_classes));
            $content .= '<div class="item">';
            $content .= sprintf('<span>%s</span>', KopaIcon::getIcon('fa fa-envelope-o'));
            $content .= sprintf('<h4>%s</h4>', __('Email', kopa_get_domain()));
            $content .= sprintf('<p>%s</p>', $mail);
            $content .= '</div>';
            $content .= '</div>';
        }

        $content .= '</div>';
    }
    $content .= '</div>';
    $content .= '</div>';


    $content .= '<div class="form-contact">';
    $content .= '<div class="container">';
    $content .= $form_caption ? sprintf('<h3 class="contact-title">%s</h3>', $form_caption) : '';
    $content .= $form_description ? sprintf('<p>%s</p>', $form_description) : '';

    $content .= '<form id="contact-form" class="contact-form clearfix" action="' . admin_url('admin-ajax.php') . '" method="post" autocomplete="off">';
    $content .= '<div class="row">';

    $content .= '<div class="col-md-6 col-sm-6 col-sx-12">';
    $content .= '<div class="form-group">';
    $content .= sprintf('<input class="form-control" type="text" id="contact_name" name="contact_name" placeholder="%s">', __('Name', kopa_get_domain()));
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="col-md-6 col-sm-6 col-sx-12">';
    $content .= '<div class="form-group">';
    $content .= sprintf('<input class="form-control" type="text" id="contact_email" name="contact_email" placeholder="%s">', __('Email', kopa_get_domain()));
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="form-group">';
    $content .= sprintf('<textarea class="form-control" id="contact_message" name="contact_message" placeholder="%s"></textarea>', __('Your message', kopa_get_domain()));
    $content .= '</div>';

    if ('off' != $recaptcha_skin && $publickey && $privatekey) {
        $content .= '<div class="recaptcha-block clearfix">';
        $content .= recaptcha_get_html($publickey);
        $content .= '</div>';
    }

    #SUBMIT
    $content .= '<div class="contact-button">';
    $content .= '<input type="hidden" name="action" value="kopa_send_contact">';
    $content .= wp_nonce_field('kopa_send_contact', 'ajax_nonce', true, false);
    $content .= wp_nonce_field('kopa_check_recaptcha', 'ajax_nonce_recaptcha', false, false);
    $content .= '<input type="submit" name="submit-contact" id="submit-contact" class="btn btn-block style-5" value="' . __('Send', kopa_get_domain()) . '">';
    $content .= '</div>';

    $content .= '</form>';
    $content .= '<div id="contact_response"></div>';
    $content .= '</div>';
    $content .= '</div>';

    return $content;
}
