<?php

class KopaSEO {

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public static function get_title() {
        $title = '';
        $pattern = '';

        if (is_main_query() && ('true' == KopaOptions::get_option('seo_status', 'true'))) {
            $pattern = '[site_name] - [site_desc]';

            if (is_archive()) {
                if (is_tag() || is_category()) {
                    $pattern = KopaOptions::get_option('seo_title_taxonomy', '[term_type] - [term_name] - [pagination_paged] - [site_name]');
                } else if (is_author()) {
                    $pattern = KopaOptions::get_option('seo_title_author', 'Posts created by [author_name] - [site_name]');
                }
            } else if (is_search()) {
                $pattern = KopaOptions::get_option('seo_title_search', 'Search pages: You searched for [search_phrase] return [search_result_count] results - [site_name]');
            } else if (is_singular()) {
                if (is_page()) {
                    $pattern = KopaOptions::get_option('seo_title_page', '[page_name] - [site_name]');
                    if (is_front_page()) {
                        $pattern = KopaOptions::get_option('seo_title_front_page', '[site_name] - [site_desc]');
                    }
                } else if (is_single()) {
                    $pattern = KopaOptions::get_option('seo_title_post', '[post_name] - Created by [post_author_name] - In category: [post_cats] - Tagged with: [post_tags] - [site_name] - [site_desc]');
                }
            } else if (is_404()) {
                $pattern = KopaOptions::get_option('seo_title_404', 'Oops! 404 Page not found - [site_name] - [site_desc]');
            } else if (is_home()) {
                $pattern = KopaOptions::get_option('seo_title_home_page', 'Latest News - [pagination_paged] - [site_name] - [site_desc]');
            }
        }

        if (empty($pattern)) {
            global $page, $paged;
            $title = wp_title('|', FALSE, 'right');
            $title.= get_bloginfo('name');
            $site_description = get_bloginfo('description', 'display');

            if ($site_description && ( is_home() || is_front_page() ))
                $title.= " | $site_description";
            if ($paged >= 2 || $page >= 2)
                $title.= ' | ' . sprintf(__('Page %s', kopa_get_domain()), max($paged, $page));
        }else {
            $title = do_shortcode($pattern);
        }

        return apply_filters('kopa_seo_get_title', $title);
    }

}