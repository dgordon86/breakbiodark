<?php

class KopaOptions {

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public static function get_option($key, $default = NULL, $type = 'String') {
        global $kopaOptions;
        $value = $default;

        if (!isset($kopaOptions) || empty($kopaOptions)) {
            $kopaOptions = get_option(KOPA_OPT_PREFIX . 'options');
        }

        if (isset($kopaOptions[$key])) {
            $value = $kopaOptions[$key];
        }

        switch ($type) {
            case 'Int':
                $value = (int) $value;
                break;
            case 'Boolean':
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                break;
        }

        return apply_filters('kopa_options_get_option', $value, $key, $default, $type);
    }

}
