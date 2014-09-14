<?php

class KopaImage {

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public static function get_post_image_src($post_id = 0, $size = NULL, $width = NULL, $height = NULL, $crop = true) {
        $src = NULL;

        if ($size) {
            $size = self::detect_image_size($size);
        }

        if (isset($post_id) && !empty($post_id) && has_post_thumbnail($post_id)) {
            if ('true' == KopaUtil::get_post_meta($post_id, KOPA_OPT_PREFIX . 'is_use_custom_thumbnail', TRUE, 'String', false) && 'true' == KopaOptions::get_option('is_use_custom_thumbnail', 'false') && !empty($size)) {
                $tmp = KopaUtil::get_post_meta($post_id, KOPA_OPT_PREFIX . "thumbnail_{$size}", true);
                if ($tmp) {
                    $src = do_shortcode($tmp);
                }
            }

            if (empty($src)) {
                $feature_image = KopaUtil::get_image_src($post_id, 'full');
                $src = self::get_image_src($feature_image, $size, $width, $height, $crop);
            }
        }

        return apply_filters('kopa_image_get_post_image_src', $src);
    }

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public static function get_image_src($image, $size = NULL, $width = NULL, $height = NULL, $crop = true) {
        $src = NULL;

        if ($size) {
            $size = self::detect_image_size($size);
        }

        if (!empty($image)) {
            if (empty($width) && empty($height) && !empty($size)) {
                $sizes = KopaInit::get_image_sizes();
                if (isset($sizes[$size])) {
                    $width = $sizes[$size]['width'];
                    $height = $sizes[$size]['height'];
                    $crop = $sizes[$size]['crop'];
                }
            }

            $src = bfi_thumb($image, array('width' => $width, 'height' => $height, 'crop' => $crop));
        }

        return apply_filters('kopa_image_get_image_src', $src);
    }

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public static function detect_image_size($size) {
        if ($size && ('true' == KopaOptions::get_option('is_use_mobile_detect', 'false'))) {
            $detect = new Mobile_Detect;

            if ($detect->isMobile()) {
                
            }

            if ($detect->isTablet()) {
                
            }
        }

        return apply_filters('kopa_image_detect_image_size', $size);
    }

}
