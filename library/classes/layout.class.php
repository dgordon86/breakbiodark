<?php

class KopaLayout {

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public static function get_current_setting() {
        $settings = get_option(KOPA_OPT_PREFIX . 'layout_settings');
        $setting = array('layout' => '', 'sidebars' => array());

        if (!empty($settings) && is_main_query()) {
            if (is_archive()) {
                $setting = $settings['archive'];
                if (is_tag() || is_category()) {
                    $setting = $settings['taxonomy'];
                    
                    $term_id = get_queried_object_id();
                    if ('true' == get_option(KOPA_OPT_PREFIX . 'is_use_custom_layout_' . $term_id, 'false')) {
                        $setting = get_option(KOPA_OPT_PREFIX . 'layout_' . $term_id, $setting);
                    }
                } else if (is_author()) {
                    $setting = $settings['author'];
                }
            } else if (is_search()) {
                $setting = $settings['search'];
            } else if (is_singular()) {
                global $post;
                if (is_page()) {
                    $setting = $settings['page'];

                    if (is_front_page()) {
                        $setting = $settings['front-page'];
                    } else {
                        if ('true' == KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'is_use_custom_layout', TRUE, 'String', 'false')) {
                            $setting = KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'layout', true, NULL, $setting);
                        }
                    }
                } else if (is_single()) {
                    $setting = $settings['post'];

                    if ('true' == KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'is_use_custom_layout', TRUE, 'String', 'false')) {
                        $setting = KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'layout', true, NULL, $setting);
                    }
                }
            } else if (is_404()) {
                $setting = $settings['_404'];
            } else {
                $setting = $settings['home'];
            }
        }

        return apply_filters('kopa_layout_get_current_setting', $setting);
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
    public static function get_form($template_hierarchy, $setting = array(), $name = '') {
        $kopa_sidebar_position = KopaInit::get_positions();
        $kopa_layout = KopaInit::get_layouts();
        $kopa_template_hierarchy = KopaInit::get_template_hierarchy();
        
        $sidebars = get_option(KOPA_OPT_PREFIX . 'sidebars');

        $obj = $kopa_template_hierarchy[$template_hierarchy];

        $html = '<div class="layout-manage-wrap">';
        $html.= '<div class="row clearfix">';

        #FORM
        $html.= '<div class="col-md-5">';

        #CBO Layouts
        $cbo_layout_opts = array();
        foreach ($obj['layouts'] as $tmp_layout_slug) {
            $tmp_layout = $kopa_layout[$tmp_layout_slug];
            $cbo_layout_opts[$tmp_layout['slug']] = $tmp_layout['title'];
        }
        $tmp_cbo = array(
            'type' => 'select',
            'id' => sprintf("cbo_layout_%s", $name),
            'name' => sprintf("%s[layout_slug]", $name),
            'label' => __('Select the layout', kopa_get_domain()),
            'options' => $cbo_layout_opts,
            'wrap_begin' => '<div class="row-layout-wrap row clearfix">',
            'wrap_end' => '</div>',
            'control_begin' => '<div class="col-md-12">',
            'control_end' => '</div>',
            'label_begin' => '<div class="col-layout-title col-md-12">',
            'label_end' => '</div>',
            'classes' => array('cbo_layout'),
            'value' => $setting['layout_slug'],
            'attributes' => array(
                'onchange' => 'KopaLayout.onChange(event, jQuery(this));'
            )
        );

        $html.= KopaControl::get_html($tmp_cbo);
        #END-CBO Layouts

        foreach ($obj['layouts'] as $tmp_layout_slug) {
            $tmp_layout = $kopa_layout[$tmp_layout_slug];

            $classes = array('row-sidebars-wrap', 'row', 'clearfix');
            $classes[] = ($setting['layout_slug'] == $tmp_layout['slug']) ? 'row-sidebars-active' : 'row-sidebars-deactive';
            $classes[] = "row-sidebars-for-layout-{$tmp_layout['slug']}";

            $html .= sprintf('<div class="%s">', implode(' ', $classes));
            $html .= '<div class="col-md-12">';

            $tmp_positions = $tmp_layout['positions'];
            for ($i = 0; $i < count($tmp_positions); $i++) {
                $tmp_position = $tmp_positions[$i];

                $tmp_cbo = array(
                    'type' => 'select',
                    'id' => sprintf("cbo_%s_%s", $name, $tmp_position),
                    'name' => sprintf("%s[sidebars][%s][]", $name, $tmp_layout_slug),
                    'options' => $sidebars,
                    'label' => $kopa_sidebar_position[$tmp_position]['title'],
                    'wrap_begin' => '<div class="row-sidebar-wrap row clearfix">',
                    'wrap_end' => '</div>',
                    'control_begin' => '<div class="col-xs-7">',
                    'control_end' => '</div>',
                    'label_begin' => '<div class="col-xs-5 col-sidebar-title">',
                    'label_end' => '</div>',
                    'classes' => array('cbo_sidebar'),
                    'value' => $setting['sidebars'][$tmp_layout_slug][$i]
                );

                $html.= KopaControl::get_html($tmp_cbo);
            }

            $html.= '</div>';
            $html.= '</div>';
        }

        $html.= '</div>';
        #END-FORM
        #THUMBNAIL
        $html.= '<div class="col-md-7 col-layout-thumb">';

        foreach ($obj['layouts'] as $tmp_layout_slug) {
            $classes = array('img-responsive');
            $classes[] = ($setting['layout_slug'] == $tmp_layout_slug) ? 'layout-thumb-active' : 'layout-thumb-deactive';
            $classes[] = "thumb-for-layout-{$tmp_layout_slug}";

            $html.= sprintf('<img src="%s" class="%s">', get_template_directory_uri() . "/library/images/layout/{$tmp_layout_slug}.png", implode(' ', $classes));
        }
        $html.= '</div>';
        #END-THUMBNAIL


        $html.= '</div>';
        $html.= '</div>';
        return $html;
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
    public static function get_breadcrumb() {
        if ('false' == KopaOptions::get_option('is_use_breadcrumb', 'true'))
            return;

        global $post, $wp_query;
        $current_class = 'current-page';
        $prefix = '&nbsp;/&nbsp;';
        $breadcrumb_before = '<div class="kp-breadcrumb"><div class="container"><div class="breadcrumb">';
        $breadcrumb_after = '</div></div></div>';

        $breadcrumb_home = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url() . '" itemprop="url"><span itemprop="title"></span>' . __('Home', kopa_get_domain()) . '</span></a></span>';
        $breadcrumb = $breadcrumb_home;

        if (is_archive()) {
            if (is_tag()) {
                $term = get_term(get_queried_object_id(), 'post_tag');
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $term->name);
            } else if (is_category()) {
                $terms_link = explode($prefix, substr(get_category_parents(get_queried_object_id(), TRUE, $prefix), 0, (strlen($prefix) * -1)));
                $n = count($terms_link);
                if ($n > 1) {
                    for ($i = 0; $i < ($n - 1); $i++) {
                        $breadcrumb.= $prefix . $terms_link[$i];
                    }
                }
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, get_the_category_by_ID(get_queried_object_id()));
            } else if (is_year() || is_month() || is_day()) {

                $m = get_query_var('m');
                $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);
                if (strlen($m) >= 4)
                    $date['y'] = substr($m, 0, 4);
                if (strlen($m) >= 6)
                    $date['m'] = substr($m, 4, 2);
                if (strlen($m) >= 8)
                    $date['d'] = substr($m, 6, 2);
                if ($date['y'])
                    if (is_year())
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['y']);
                    else
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_year_link($date['y']), $date['y']);
                if ($date['m'])
                    if (is_month())
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
                    else
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
                if ($date['d'])
                    if (is_day())
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['d']);
                    else
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_day_link($date['y'], $date['m'], $date['d']), $date['d']);
            }else if (is_author()) {

                $author_id = get_queried_object_id();
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Posts created by %1$s', kopa_get_domain()), get_the_author_meta('display_name', $author_id)));
            } else if (is_tax('portfolio_category')) {
                $term = get_term(get_queried_object_id(), 'portfolio_category');
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $term->name);
            } else if (is_post_type_archive('portfolio')) {
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_post_type_archive_link('portfolio'), __('Portfolio', kopa_get_domain()));
            }
        } else if (is_search()) {
            $s = get_search_query();
            $c = $wp_query->found_posts;
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Searched for "%s" return %s results', kopa_get_domain()), $s, $c));
        } else if (is_singular()) {
            if (is_page()) {
                if (is_front_page()) {
                    $breadcrumb = NULL;
                } else {
                    $post_ancestors = get_post_ancestors($post);
                    if ($post_ancestors) {
                        $post_ancestors = array_reverse($post_ancestors);
                        foreach ($post_ancestors as $crumb)
                            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_permalink($crumb), esc_html(get_the_title($crumb)));
                    }
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink(get_queried_object_id()), esc_html(get_the_title(get_queried_object_id())));
                }
            } else if (is_single()) {
                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_category_link($category->term_id), $category->name);
                    }
                }
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink(get_queried_object_id()), esc_html(get_the_title(get_queried_object_id())));
            }
        } else if (is_404()) {
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Page not found', kopa_get_domain()));
        } else {
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Latest News', kopa_get_domain()));
        }

        echo $breadcrumb_before;
        echo $breadcrumb;

        echo $breadcrumb_after;
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
    public static function get_pre_next_post() {
        $data = array();

        $is_in_same_cat = ('true' == KopaOptions::get_option('is_display_post_prev_next_links_same_cat', 'true')) ? true : false;
        $prev = get_previous_post($is_in_same_cat);

        if ($prev) {
            if ($prev) {
                $data['prev']['id'] = $prev->ID;
                $data['prev']['url'] = get_permalink($prev->ID);
                $data['prev']['title'] = get_the_title($prev->ID);
                $data['prev']['date'] = date(get_option('date_format'), strtotime($prev->post_date_gmt));                
            }
        }

        $next = get_next_post($is_in_same_cat);
        if ($next) {
            if ($next) {
                $data['next']['id'] = $next->ID;
                $data['next']['url'] = get_permalink($next->ID);
                $data['next']['title'] = get_the_title($next->ID);
                $data['next']['date'] = date(get_option('date_format'), strtotime($next->post_date_gmt)); 
            }
        }

        return $data;
    }

}
