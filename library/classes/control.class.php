<?php

if (!class_exists('KopaControl')) {

    class KopaControl {

        /**
         * Get HTML code for control (ui element)
         *
         * @package Kopa
         * @subpackage Core
         * @author thethangtran <tranthethang@gmail.com>
         * @since 1.0.0
         * 
         * @param array $args
         * @return string
         */
        public static function get_html($args = array()) {
            $type = isset($args['type']) ? $args['type'] : 'text';
            $obj = new KopaUI();
            switch ($type) {
                case 'text':
                    $obj = new KopaUIText($args);
                    break;
                case 'url':
                    $obj = new KopaUIUrl($args);
                    break;
                case 'textarea':
                    $obj = new KopaUITextArea($args);
                    break;
                case 'checkbox':
                    $obj = new KopaUICheckbox($args);
                    break;
                case 'email':
                    $obj = new KopaUIEmail($args);
                    break;
                case 'number':
                    $obj = new KopaUINumber($args);
                    break;
                case 'select':
                    $obj = new KopaUISelect($args);
                    break;
                case 'radio':
                    $obj = new KopaUIRadio($args);
                    break;
                case 'radio-list':
                    $obj = new KopaUIRadioList($args);
                    break;
                case 'radio-truefalse':
                    $obj = new KopaUIRadioTrueFalse($args);
                    break;
                case 'select-number':
                    $obj = new KopaUISelectNumber($args);
                    break;
                case 'color':
                    $obj = new KopaUIColor($args);
                    break;
                case 'media':
                    $obj = new KopaUIMedia($args);
                    break;
                case 'gallery':
                    $obj = new KopaUIGallery($args);
                    break;
                case 'taxonomy':
                    $obj = new KopaUITaxonomy($args);
                    break;
                case 'list-post':
                    $obj = new KopaUIListPost($args);
                    break;
                case 'list-page':
                    $obj = new KopaUIListPage($args);
                    break;
                case 'color-swatches':
                    $obj = new KopaUIRadioColorSwatches($args);
                    break;
                case 'color-swatches-single':
                    $obj = new KopaUIRadioColorSwatchesSingle($args);
                    break;
                case 'pattern':
                    $obj = new KopaUIRadioPattern($args);
                    break;
                case 'layout':
                    $obj = new KopaUILayout($args);
                    break;
                case 'group':
                    $obj = new KopaUIGroup($args);
                    break;
                case 'font':
                    $obj = new KopaUIFont($args);
                    break;
                case 'sidebar-manage':
                    $obj = new KopaUISidebarManager($args);
                    break;
                case 'icon':
                    $obj = new KopaUIIcon($args);
                    break;
                case 'multi-text':
                    $obj = new KopaUIMultiText($args);
                    break;
                case 'custom':
                    $obj = new KopaUICustom($args);
                    break;
                case 'hidden':
                    $obj = new KopaUIHidden($args);
                    break;
                default:
                    $obj = new KopaUIText($args);
                    break;
            }

            return $obj->get_html();
        }

        /**
         * Filter data before use
         *
         * @package Kopa
         * @subpackage Core
         * @author thethangtran <tranthethang@gmail.com>
         * @since 1.0.0
         * 
         * @param array $field current field infomation
         * @param mixer $data data of current field
         * @return mixer (string | int | array)
         */
        public static function filter_post_data($field = array(), $data = NULL) {
            $out = NULL;

            $type = $field['type'];

            switch ($type) {
                case 'checkbox':
                    $out = $data;
                    break;
                case 'textarea':
                    $out = htmlspecialchars_decode(stripslashes($data));
                    break;
                case 'url':
                    $out = stripslashes($data);
                    break;
                case 'number':
                    $out = (int) $data;
                    break;
                case 'list-post':
                case 'list-page':
                case 'taxonomy':
                case 'select':
                    if (isset($field['attributes']['multiple'])) {
                        if (is_array($data)) {
                            $data = array_filter($data);
                        }
                        $out = (empty($data)) ? array() : $data;
                    } else {
                        $out = (empty($data)) ? '' : $data;
                    }
                    break;
                case 'select-number':
                    $out = (empty($data)) ? 0 : $data;
                    break;
                case 'media':
                    if (!empty($data)) {
                        $out = str_replace(home_url(), '[home_url]', $data);
                    }
                    break;
                case 'multi-text':
                    $out = array();
                    if (is_array($data) && $data) {
                        for ($i = 0; $i < count($data['value']); $i++) {
                            if ('' != $data['id'][$i] && '' != $data['value'][$i]) {
                                $out[$i]['id'] = $data['id'][$i];
                                $out[$i]['value'] = $data['value'][$i];
                            }
                        }
                    }
                    break;
                case 'group':
                case 'custom':
                    $out = NULL;
                default:
                    $out = $data;
                    break;
            }
            return $out;
        }

    }

}
