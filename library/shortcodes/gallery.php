<?php

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'kopa_shortcode_gallery');

/**
 * 
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_shortcode_gallery($atts) {
    extract(shortcode_atts(array("ids" => ''), $atts));
    $output = '';

    if (isset($atts['ids'])) {
        $ids = explode(',', $atts['ids']);
        if ($ids) {
            if (is_single()) {

                $thumbs = array();

                $output.= '<div class="widget-gallery">';
                $output.= '<div class="owl-carousel sync1">';

                foreach ($ids as $id) {
                    $post = get_post($id);
                    setup_postdata($post);

                    $title = $post->post_title;
                    $image = wp_get_attachment_image_src($id, 'full');
                    $image_full = KopaImage::get_image_src($image[0], 'size_10');
                    $thumbs[$id]['image'] = KopaImage::get_image_src($image[0], 'size_08');
                    $thumbs[$id]['title'] = $title;

                    $output.= '<div class="item">';
                    $output.= sprintf('<img src="%s" alt="%s">', $image_full, $title);
                    $output.= '<div class="kp-caption">';                    
                    $output.= ($post->post_excerpt) ? sprintf('<p>%s</p>', $post->post_excerpt) : '';
                    $output.= '</div>';
                    $output.= '</div>';

                    wp_reset_postdata();
                    wp_reset_query();
                }

                $output.= '</div>';
                $output.= '<div class="owl-carousel sync2">';

                foreach ($ids as $id) {
                    $output.= '<div class="item">';
                    $output.= sprintf('<img src="%s" alt="%s">', $thumbs[$id]['image'], $thumbs[$id]['title']);
                    $output.= '</div>';
                }

                $output.= '</div>';
                $output.= '</div>';
            } else {
                $output .= '<div class="kopa-minimal-gallery owl-carousel">';
                foreach ($ids as $id) {
                    $post = get_post($id);
                    $title = $post->post_title;
                    $image = wp_get_attachment_image_src($id, 'full');
                    $image_full = KopaImage::get_image_src($image[0], 'size_10');
                    $output .= sprintf('<div class="item"><img src="%s" alt="%s"></div>', $image_full, $title);

                    wp_reset_postdata();
                    wp_reset_query();
                }
                $output .= '</div>';
            }
        }
    }

    return apply_filters('kopa_shortcode_gallery', force_balance_tags($output));
}
