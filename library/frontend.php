<?php
add_action('after_setup_theme', 'kopa_front_after_setup_theme');

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_front_after_setup_theme() {
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('editor_style');

    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

    add_editor_style('editor-style.css');
    global $content_width;
    if (!isset($content_width))
        $content_width = 700;
    register_nav_menus(array(
        'top-nav' => __('Top Menu', kopa_get_domain()),
        'primary-nav' => __('Primary Menu', kopa_get_domain()),
        'bottom-nav' => __('Bottom Menu', kopa_get_domain()),
    ));
    if (!is_admin()) {
        add_action('wp_enqueue_scripts', 'kopa_front_enqueue_scripts');
        add_action('wp_footer', 'kopa_footer');
        add_action('wp_head', 'kopa_head');
        add_filter('widget_text', 'do_shortcode');
        add_filter('post_class', 'kopa_post_class');
        add_filter('body_class', 'kopa_body_class');
        add_filter('wp_nav_menu_items', 'kopa_add_home_menuitem', 10, 2);
        add_action('pre_get_posts', 'kopa_edit_archive_query');
        add_filter('kopa_blog_is_display_blog_post_format', 'kopa_blog_is_display_blog_post_format');
        add_filter('kopa_blog_thumbnail_position', 'kopa_blog_thumbnail_position');
        add_filter('language_attributes', 'kopa_add_open_graph_xml_nameservers');
        add_filter('dynamic_sidebar_params', 'kopa_dynamic_sidebar_params');
        add_filter('kopa_get_breadcrumb', 'kopa_get_breadcrumb_for_header2');
    } else {
        add_action('in_widget_form', 'kopa_in_widget_form', 5, 3);
        add_filter('widget_update_callback', 'kopa_in_widget_form_update', 5, 3);
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_add_open_graph_xml_nameservers($doctype) {
    if ('true' == KopaOptions::get_option('seo_status', 'false')) {
        $nameservers = array();
        $nameservers[] = 'xmlns="http://www.w3.org/1999/xhtml"';
        $nameservers[] = 'xmlns:og="http://ogp.me/ns#"';
        $nameservers[] = 'xmlns:fb="http://www.facebook.com/2008/fbml"';
        $doctype.= sprintf(' %s ', implode(' ', $nameservers));
    }
    return $doctype;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_blog_is_display_blog_post_format($is_display) {
    global $wp_query;
    $private_is_display = 'inherit';
    if (!is_admin() && $wp_query->is_main_query()) {
        if (is_tag() || is_category()) {
            $id = get_queried_object_id();
            $key = sprintf('%s%s_%s', KOPA_OPT_PREFIX, 'is_display_content_formatted', $id);
            $private_is_display = get_option($key, 'inherit');
        }
    }
    if ('inherit' != $private_is_display) {
        $is_display = $private_is_display;
    }
    return $is_display;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_edit_archive_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        $post_per_page = 'inherit';
        if (is_tag()) {
            $slug = $query->query_vars['tag'];
            $tag = get_term_by('slug', $slug, 'post_tag');
            if (!empty($tag)) {
                $post_per_page = get_option(KOPA_OPT_PREFIX . 'posts_per_page_' . $tag->term_id, 'inherit');
            }
        } else if (is_category()) {
            $slug = $query->query_vars['category_name'];
            $cat = get_term_by('slug', $slug, 'category');
            if (!empty($cat)) {
                $post_per_page = get_option(KOPA_OPT_PREFIX . 'posts_per_page_' . $cat->term_id, 'inherit');
            }
        }
        if ('inherit' != $post_per_page) {
            switch ($post_per_page) {
                case '-1':
                    $query->query_vars['posts_per_page'] = -1;
                    break;
                default:
                    $query->query_vars['posts_per_page'] = (int) $post_per_page;
                    break;
            }
        }
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_add_home_menuitem($items, $args) {
    if ('primary-nav' == $args->theme_location && 'main-menu' == $args->menu_id) {
        $home_html = sprintf('<li class="home-menu-icon"><a class="icon-home" href="%s" title="%s"></a></li>', home_url(), __('Home', kopa_get_domain()));
        $items = $home_html . $items;
    }
    return $items;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_post_class($classes) {
    return $classes;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_body_class($classes) {
    $kopa_layout = KopaInit::get_layouts();
    $kopaCurrentSetting = KopaLayout::get_current_setting();
    $kopaCurrentLayout = $kopaCurrentSetting['layout_slug'];
    $kopaCurrentSidebars = $kopaCurrentSetting['sidebars'][$kopaCurrentLayout];
    $classes[] = "kopa-layout-{$kopaCurrentLayout}";
    $positions = $kopa_layout[$kopaCurrentLayout]['positions'];
    foreach ($positions as $index => $position) {
        if (!is_active_sidebar($kopaCurrentSidebars[$index])) {
            $classes[] = "kopa-hide-{$position}";
        } else {
            $classes[] = "kopa-show-{$position}";
        }
    }
    return $classes;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_head() {
    /**
     * FAVICON
     */
    $favicon = KopaOptions::get_option('favicon');
    if ($favicon) {
        printf('<link rel="shortcut icon" type="image/x-icon"  href="%s">', do_shortcode($favicon));
    }
    /**
     * APPLE ICON
     */
    $apple_icon = KopaOptions::get_option('apple_icon');
    if ($apple_icon) {
        $apple_icon = do_shortcode($apple_icon);
        foreach (array(60, 76, 120, 152) as $size) {
            $tmp = bfi_thumb($apple_icon, array('width' => $size, 'height' => $size, 'crop' => true));
            printf('<link rel="apple-touch-icon" sizes="%1$sx%1$s" href="%2$s">', $size, $tmp);
        }
    }
    /**
     * VERIFICATION SERVICES
     */
    $verification_services = array(
        'google_verify_meta' => 'google-site-verification',
        'bing_verify_meta' => 'msvalidate.01',
        'pinterest_verify_meta' => 'p:domain_verify',
        'yandex_verify_meta' => 'yandex-verification'
    );
    foreach ($verification_services as $option_key => $meta_key) {
        $meta_value = KopaOptions::get_option($option_key);
        if ($meta_value) {
            printf('<meta name="%s" content="%s">', $meta_key, $meta_value);
        }
    }
    /**
     * SEO
     */
    if ('true' == KopaOptions::get_option('seo_status', 'false')) {
        $keywords = explode(',', str_replace(' ', '', KopaOptions::get_option('seo_keywords')));
        $description = KopaOptions::get_option('seo_descriptions');
        $thumbnail = do_shortcode(KopaOptions::get_option('logo'));
        $url = home_url();
        $title = KopaSEO::get_title();
        $author = KopaOptions::get_option('seo_google_profile_url');
        $tmp_keywords = '';
        $tmp_description = '';
        if (is_singular() && !is_front_page()) {
            global $post;
            $tmp_keywords = KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'seo_keywords', true);
            $tmp_description = KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'seo_descriptions', true);
            $url = get_permalink($post->ID);
            $thumbnail = KopaImage::get_post_image_src($post->ID, 'size_03');
            $user_id = $post->post_author;
            $current_author = get_the_author_meta('google_profile', $user_id);
            $author = ($current_author) ? $current_author : $author;
        } else if (is_category() || is_tag()) {
            $term_id = get_queried_object_id();
            $tmp_keywords = get_option(KOPA_OPT_PREFIX . 'seo_keywords_' . $term_id);
            $tmp_description = get_option(KOPA_OPT_PREFIX . 'seo_descriptions_' . $term_id);
        }
        if ($tmp_keywords) {
            $tmp_keywords = explode(',', str_replace(' ', '', $tmp_keywords));
            $keywords = array_merge($keywords, $tmp_keywords);
        }
        $keywords = implode(',', array_unique($keywords));
        $description = ($tmp_description) ? $tmp_description : $description;
        printf('<meta name="keywords" content="%s">', $keywords);
        printf('<meta name="description" content="%s">', $description);
        /**
         * Open Graph
         */
        printf('<meta property="og:description" content="%s">', $description);
        printf('<meta property="og:type" content="%s">', (is_singular() && !is_front_page()) ? 'article' : 'website');
        printf('<meta property="og:site_name" content="%s">', get_bloginfo('name'));
        printf('<meta property="og:url" content="%s">', $url);
        printf('<meta property="og:image" content="%s">', $thumbnail);
        printf('<meta property="og:title" content="%s">', $title);
        # Google Map
        $google_map = KopaOptions::get_option('contact_map');
        if ($google_map) {
            $maps_arr = explode(',', $google_map);
            if (2 == count($maps_arr)) {
                printf('<meta property="og:latitude" content="%s">', trim($maps_arr[0]));
                printf('<meta property="og:longitude" content="%s">', trim($maps_arr[1]));
                printf('<meta name="geo.position" content="%s;%s">', trim($maps_arr[0]), trim($maps_arr[1]));
            }
        }
        #Contact Information
        $contact_email = KopaOptions::get_option('contact_email');
        $contact_phone = KopaOptions::get_option('contact_phone');
        $contact_fax = KopaOptions::get_option('contact_fax');
        $contact_address = KopaOptions::get_option('contact_address');
        if ($contact_email)
            printf('<meta property="og:email" content="%s">', $contact_email);
        if ($contact_phone)
            printf('<meta property="og:phone_number" content="%s">', $contact_phone);
        if ($contact_fax)
            printf('<meta property="og:fax_number" content="%s">', $contact_fax);
        if ($contact_address) {
            printf('<meta property="og:street-address" content="%s">', $contact_address);
            printf('<meta name="geo.placename" content="%s">', $contact_address);
        }
        #Twitter
        $twitter_name = KopaOptions::get_option('seo_twitter_name');
        if ($twitter_name) {
            printf('<meta name="twitter:card" content="%s">', $twitter_name);
            printf('<meta name="twitter:site" content="%s">', $twitter_name);
        }
        printf('<meta name="twitter:title" content="%s">', $title);
        printf('<meta name="twitter:description" content="%s">', $description);
        printf('<meta name="twitter:image:src" content="%s">', $thumbnail);
        #GOOGLE PROFILE URL
        if ($author)
            printf('<link rel="author" href="%s">', $author);
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_footer() {
    echo htmlspecialchars_decode(stripslashes(KopaOptions::get_option('tracking_code')));
    wp_nonce_field('kopa_set_view_count', 'kopa_set_view_count_ajax_nonce', false);
    wp_nonce_field('kopa_click_like_button', 'kopa_click_like_button_ajax_nonce', false);
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_front_enqueue_scripts() {
    if (!is_admin()) {
        global $wp_styles, $is_IE, $kopaCurrentLayout;
        $dir = get_template_directory_uri();
        /*
         * --------------------------------------------------
         * STYLESHEETS    
         * --------------------------------------------------
         */
        $character_sets = KopaOptions::get_option('character_sets', array());
        $subset = '';
        if (!empty($character_sets)) {
            $subset = sprintf('&subset=%s', implode(',', $character_sets));
        }

        wp_enqueue_style(KOPA_OPT_PREFIX . 'font-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' . $subset, array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'font-roboto-slab', 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' . $subset, array(), NULL);

        wp_enqueue_style(KOPA_OPT_PREFIX . 'font-awesome', "{$dir}/library/assets/fonts/awesome/css/font-awesome.css");
        wp_enqueue_style(KOPA_OPT_PREFIX . 'common', $dir . '/css/common.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'component', $dir . '/css/component.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'direction-hover', $dir . '/css/direction-hover.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'jquery.navgoco', $dir . '/css/jquery.navgoco.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'owl.carousel', $dir . '/css/owl.carousel.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'owl.theme', $dir . '/css/owl.theme.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'perfect-scrollbar', $dir . '/css/perfect-scrollbar.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'superfish', $dir . '/css/superfish.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'jquery.magnific-popup', "{$dir}/css/jquery.magnific-popup.css", array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'jquery-ui', $dir . '/css/jquery-ui.css', array(), NULL);
        wp_enqueue_style(KOPA_OPT_PREFIX . 'style', get_stylesheet_uri(), array(), NULL);
        if ($is_IE) {
            wp_register_style(KOPA_OPT_PREFIX . 'ie', $dir . '/css/ie.css', array(), NULL);
            wp_enqueue_style(KOPA_OPT_PREFIX . 'ie');
            $wp_styles->add_data(KOPA_OPT_PREFIX . 'ie', 'conditional', 'lt IE 9');
        }
        wp_enqueue_style(KOPA_OPT_PREFIX . 'responsive', $dir . '/css/responsive.css', array(KOPA_OPT_PREFIX . 'style'), NULL);

        /*
         * --------------------------------------------------
         * SCRIPTS    
         * --------------------------------------------------
         */
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-form');
        wp_enqueue_script('jquery-masonry');



        if ($is_IE) {
            wp_enqueue_script(KOPA_OPT_PREFIX . 'html5shiv', $dir . '/js/html5shiv.js', array(), NULL, TRUE);
            wp_enqueue_script(KOPA_OPT_PREFIX . 'css3-mediaqueries', $dir . '/js/css3-mediaqueries.js', array(), NULL, TRUE);
            wp_enqueue_script(KOPA_OPT_PREFIX . 'pie', $dir . '/js/pie.js', array(), NULL, TRUE);
        }

        wp_enqueue_script(KOPA_OPT_PREFIX . 'modernizr', $dir . '/js/modernizr.js', array('jquery'), NULL, TRUE);

        if ('contact-page' == $kopaCurrentLayout) {
            wp_enqueue_script(KOPA_OPT_PREFIX . 'maps-api', 'http://maps.google.com/maps/api/js?sensor=true', array('jquery'), NULL, TRUE);
        }

        if (is_singular()) {
            wp_enqueue_script('comment-reply');
        }
        wp_enqueue_script(KOPA_OPT_PREFIX . 'custom', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);

        wp_localize_script(KOPA_OPT_PREFIX . 'custom', 'kopa_variable', kopa_variable_front());
        wp_localize_script(KOPA_OPT_PREFIX . 'custom', 'RecaptchaOptions', array(
            'theme' => KopaOptions::get_option('recaptcha_skin', 'off')
        ));
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_variable_front() {
    return array(
        'url' => array(
            'template_directory_uri' => get_template_directory_uri(),
            'ajax' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        ),
        'contact' => array(
            'address' => KopaOptions::get_option('contact_address', ''),
            'marker' => do_shortcode(KopaOptions::get_option('contact_map_marker', '')),
        ),
        'recaptcha' => array(
            'status' => ('off' != KopaOptions::get_option('recaptcha_skin', 'off') && KopaOptions::get_option('recaptcha_public_key') && KopaOptions::get_option('recaptcha_private_key'))
        ),
        'i18n' => array(
            'LOAD_MORE' => __('Load more', kopa_get_domain()),
            'LOADING' => __('Loading...', kopa_get_domain()),
            'VIEW' => __('View', kopa_get_domain()),
            'VIEWS' => __('Views', kopa_get_domain()),
            'validate' => array(
                'form' => array(
                    'CHECKING' => __('Checking', kopa_get_domain()),
                    'SUBMIT' => __('Submit', kopa_get_domain()),
                    'SENDING' => __('Sending...', kopa_get_domain())
                ),
                'recaptcha' => array(
                    'INVALID' => __('Your captcha is incorrect. Please try again', kopa_get_domain()),
                    'REQUIRED' => __('Captcha is required', kopa_get_domain())
                ),
                'name' => array(
                    'REQUIRED' => __('Please enter your name', kopa_get_domain()),
                    'MINLENGTH' => __('At least {0} characters required', kopa_get_domain())
                ),
                'email' => array(
                    'REQUIRED' => __('Please enter your email', kopa_get_domain()),
                    'EMAIL' => __('Please enter a valid email', kopa_get_domain())
                ),
                'url' => array(
                    'REQUIRED' => __('Please enter your url', kopa_get_domain()),
                    'URL' => __('Please enter a valid url', kopa_get_domain())
                ),
                'message' => array(
                    'REQUIRED' => __('Please enter a message', kopa_get_domain()),
                    'MINLENGTH' => __('At least {0} characters required', kopa_get_domain())
                )
            )
        )
    );
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_get_headline() {
    $limit = (int) KopaOptions::get_option('headline_limit', 4);
    if ($limit) {
        $prefix = KopaOptions::get_option('headline_prefix');
        $cats = KopaOptions::get_option('headline_cats');
        $tags = KopaOptions::get_option('headline_tags');
        $formats = KopaOptions::get_option('headline_formats');
        $timestamp = KopaOptions::get_option('headline_timestamp');
        $query = array(
            'post_type' => array('post'),
            'posts_per_page' => $limit,
            'post_status' => array('publish'),
            'ignore_sticky_posts' => true
        );
        if (!empty($cats)) {
            $query['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $cats
            );
        }
        if (!empty($tags)) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field' => 'id',
                'terms' => $tags
            );
        }
        if (!empty($formats)) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_format',
                'field' => 'id',
                'terms' => $formats
            );
        }
        if (isset($query['tax_query']) && (count($query['tax_query']) >= 2)) {
            $query['tax_query']['relation'] = ('true' == KopaOptions::get_option('headline_relation')) ? 'AND' : 'OR';
        }
        global $wp_version;
        if (version_compare($wp_version, '3.7.0', '>=')) {
            if (isset($timestamp) && !empty($timestamp)) {
                $y = date('Y', strtotime($timestamp));
                $m = date('m', strtotime($timestamp));
                $d = date('d', strtotime($timestamp));
                $query['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }
        $posts = new WP_Query($query);
        if ($posts->have_posts()) {
            ?>
            <div class="breaking-news">
                <?php if ($prefix): ?>
                    <span class="kp-headline-title"><?php echo $prefix; ?></span>
                <?php endif; ?>
                <div class="caroufredsel_wrapper">
                    <div class="ticker">
                        <?php
                        while ($posts->have_posts()) {
                            $posts->the_post();
                            $post_url = get_permalink();
                            $post_title = get_the_title();
                            ?>
                            <h4 class="post-title"><a href="<?php echo $post_url; ?>"><span  class="date updated"><?php echo get_the_date(); ?></span> - <?php echo $post_title; ?></a></h4>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_get_related_posts() {
    if (is_single()) {
        $get_by = get_option('post_related_posts_get_by', 'post_tag');
        $limit = (int) KopaOptions::get_option('post_related_posts_limit', 4);
        if ($limit > 0) {
            global $post;
            $taxs = array();
            if ('category' == $get_by) {
                $cats = get_the_category(($post->ID));
                if ($cats) {
                    $ids = array();
                    foreach ($cats as $cat) {
                        $ids[] = $cat->term_id;
                    }
                    $taxs [] = array(
                        'taxonomy' => 'category',
                        'field' => 'id',
                        'terms' => $ids
                    );
                }
            } else {
                $tags = get_the_tags($post->ID);
                if ($tags) {
                    $ids = array();
                    foreach ($tags as $tag) {
                        $ids[] = $tag->term_id;
                    }
                    $taxs [] = array(
                        'taxonomy' => 'post_tag',
                        'field' => 'id',
                        'terms' => $ids
                    );
                }
            }
            if ($taxs) {
                $related_args = array(
                    'tax_query' => $taxs,
                    'post__not_in' => array($post->ID),
                    'posts_per_page' => $limit
                );
                $related_posts = new WP_Query($related_args);
                if ($related_posts->have_posts()):
                    ?>
                    <div class="related-article">
                        <h3 class="widget-title"><span><span><span><?php _e('Related articles', kopa_get_domain()); ?></span></span></span></h3>
                        <div class="widget-content">
                            <div class="owl-carousel owl-carousel-related">
                                <?php
                                while ($related_posts->have_posts()):
                                    $related_posts->the_post();
                                    $post_id = get_the_ID();
                                    $post_url = get_permalink();
                                    $post_title = get_the_title();
                                    ?>
                                    <div <?php post_class('item'); ?>>
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image_croped = KopaImage::get_post_image_src($post_id, 'size_08');
                                            ?>
                                            <a href="<?php echo $post_url; ?>"><img src="<?php echo $image_croped; ?>" alt="<?php echo $post_title; ?>" /></a>
                                            <?php
                                        }
                                        ?>
                                        <div class="kp-caption">
                                            <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>

                                            <ul class="kp-meta-post list-inline">
                                                <li><?php echo KopaIcon::getIconDatetime(); ?><span><?php echo get_the_date(); ?></span></li>                                                
                                                <li><?php echo KopaIcon::getIconComment(); ?><span><?php comments_popup_link(__('No Comment', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain()), '', __('0 Comment', kopa_get_domain())); ?></span></li>
                                            </ul>

                                            <span class="kp-meta-post"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                wp_reset_postdata();
            }
        }
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_get_about_author() {
    if ('true' == KopaOptions::get_option('is_display_post_author_information', 'true')) {
        global $post;
        $user_id = $post->post_author;
        $description = get_the_author_meta('description', $user_id);
        $email = get_the_author_meta('user_email', $user_id);
        $name = get_the_author_meta('display_name', $user_id);
        $url = trim(get_the_author_meta('user_url', $user_id));
        $link = ($url) ? $url : get_author_posts_url($user_id);
        ?>
        <div class="kp-author clearfix">
            <h3 class="widget-title"><span><span><span><?php _e('About the author', kopa_get_domain()); ?></span></span></span></h3>
            <div class="author-body clearfix">
                <figure class="pull-left">
                    <?php echo get_avatar($email, 80); ?>
                </figure>
                <div class="item-right">
                    <h3><a target="_blank"  href="<?php echo $link; ?>"><?php echo $name; ?></a></h3>
                    <?php echo ($description) ? "<p>{$description}</p>" : ''; ?>
                    <?php if ('true' == KopaOptions::get_option('is_display_post_author_social_links', 'true')): ?>
                        <p class="social-box style-2">
                            <?php
                            $socials = array('facebook', 'twitter', 'dribbble', 'flickr', 'pinterest', 'google_profile', 'youtube');
                            foreach ($socials as $social) {
                                $tmp = get_the_author_meta($social, $user_id);
                                if ($tmp) {
                                    switch ($social){
                                        case 'google_profile':
                                            $social = 'google-plus';
                                            break;
                                    }
                                    ?>
                                    <a target="_blank" href="<?php echo $tmp; ?>" class="<?php echo "fa fa-$social"; ?>"></a>
                                    <?php
                                }
                            }
                            ?>
                            
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_dynamic_sidebar_params($params) {
    if (!in_array($params[0]['widget_name'], array('Kopa Slider Text', 'Kopa Slider Steel')))
        return $params;

    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];


    if (isset($widget_opt[$widget_num]['bonus-background']) && ('true' == $widget_opt[$widget_num]['bonus-background'])) {
        $widget_styles = array();
        if (!empty($widget_opt[$widget_num]['background-color'])) {
            $color = $widget_opt[$widget_num]['background-color'];
            $opacity = (int) $widget_opt[$widget_num]['background-opacity'];
            $widget_styles[] = sprintf('background-color:%s', KopaUtil::convert_hex2rgba($color, $opacity / 100));
        }
        if (!empty($widget_opt[$widget_num]['background-image'])) {
            $background_image = $widget_opt[$widget_num]['background-image'];
            $background_type = $widget_opt[$widget_num]['background-type'];
            $parallax_height = (int) $widget_opt[$widget_num]['parallax-height'];
            if (!empty($background_image)) {
                $parallax_before = '';
                $parallax_after = '';
                $parallax_args = array();
                $widget_styles[] = sprintf('background-image:url(%s)', do_shortcode($background_image));
                if ($parallax_height > 0) {
                    $widget_obj['callback'][0]->widget_options['classname'] .= ' parallax';
                    $widget_styles[] = sprintf('height:%1$spx', $parallax_height);
                    $parallax_before = sprintf('<div class="widget-inner" style="height:%1$spx">', $parallax_height);
                    $parallax_after = '</div>';
                    $parallax_args[] = 'data-speed="10"';
                    $parallax_args[] = 'data-type="background"';
                }
                switch ($background_type) {
                    case 'repeat':
                        $widget_styles[] = 'background-repeat: repeat';
                        break;
                    case 'no-repeat':
                        $widget_styles[] = 'background-repeat: no-repeat';
                        break;
                    default:
                        $widget_styles[] = 'background-repeat: no-repeat';
                        $widget_styles[] = 'background-size: cover';
                        $widget_styles[] = '-webkit-background-size: cover';
                        $widget_styles[] = '-moz-background-size: cover';
                        $widget_styles[] = '-o-background-size: cover';
                        break;
                }
                $params[0]['before_widget'] = sprintf('<div id="%1$s" class="widget %2$s clearfix" style="%3$s;" %4$s>', $widget_id, $widget_obj['callback'][0]->widget_options['classname'], implode('; ', $widget_styles), implode(' ', $parallax_args)) . $parallax_before;
                $params[0]['after_widget'] = $parallax_after . '</div>';
            }
        } else {
            $params[0]['before_widget'] = sprintf('<div id="%1$s" class="widget %2$s clearfix" style="%3$s;">', $widget_id, $widget_obj['callback'][0]->widget_options['classname'], implode('; ', $widget_styles));
        }
    }

    return $params;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_in_widget_form($t, $return, $instance) {
    if (!in_array($t->id_base, array('kopa_slider_text', 'kopa_owl_slider')))
        return;

    $default = array(
        'background-color' => '#FFFFFF',
        'background-opacity' => 1,
        'background-image' => '',
        'background-type' => '',
        'parallax-height' => 600
    );
    $instance = wp_parse_args((array) $instance, $default);

    $background = array(
        'title' => __('Parallax Background', kopa_get_domain()),
        'help' => NULL,
        'fields' => array()
    );
    $background['fields'][] = array(
        'type' => 'color',
        'id' => 'background-color',
        'name' => 'background-color',
        'default' => '',
        'classes' => array(),
        'label' => NULL,
        'help' => NULL
    );
    $background['fields'][] = array(
        'type' => 'select-number',
        'id' => 'background-opacity',
        'name' => 'background-opacity',
        'label' => __('Opacity (only for background color)', kopa_get_domain()),
        'default' => 100,
        'min' => 0,
        'max' => 100,
        'step' => 5,
        'suffix' => '%'
    );
    $background['fields'][] = array(
        'type' => 'media',
        'id' => 'background-image',
        'name' => 'background-image',
        'default' => '',
        'classes' => array(),
        'label' => __('Image', kopa_get_domain()),
        'help' => NULL
    );
    $background['fields'][] = array(
        'type' => 'select',
        'id' => 'background-type',
        'name' => 'background-type',
        'default' => 'repeat',
        'classes' => array(),
        'label' => __('Type', kopa_get_domain()),
        'help' => NULL,
        'options' => array(
            'repeat' => __('Repeat', kopa_get_domain()),
            'no-repeat' => __('No Repeat', kopa_get_domain()),
            'cover' => __('Cover', kopa_get_domain()),
        )
    );
    $background['fields'][] = array(
        'type' => 'number',
        'id' => 'parallax-height',
        'name' => 'parallax-height',
        'default' => 0,
        'classes' => array(),
        'label' => __('Parallax height', kopa_get_domain()),
        'help' => __('Enter <code>0</code> to disable parallax.', kopa_get_domain()),
    );
    $groups = array(
        'bonus-background' => $background
    );
    foreach ($groups as $key => $group) {
        ?>
        <div class="kopa-widget-bonus-wrap">
            <p class="kopa-widget-bonus-caption clearfix">
                <?php echo $group['title']; ?>
                <?php
                $group_checked = '';
                $group_inner_style = 'display: none;';
                if (isset($instance[$key]) && ('true' == $instance[$key])) {
                    $group_checked = 'checked=checked';
                    $group_inner_style = 'display: block;';
                }
                ?>
                <input onclick="KopaWidget.clickBonusSection(event, jQuery(this));" <?php echo $group_checked; ?> class="pull-right" type="checkbox" value="true" name="<?php echo $t->get_field_name($key); ?>" id="<?php echo $t->get_field_name($key); ?>">
                <?php printf('<i>%s</i>', $group['help']); ?>
            </p>
            <div class="kopa-widget-bonus-inner" style="<?php echo $group_inner_style; ?>">
                <?php
                $i = 0;
                foreach ($group['fields'] as $field) {
                    $field['value'] = $instance[$field['name']];
                    $wrap_classes = array('kopa-widget-control-wrap', 'clearfix');
                    $wrap_classes[] = (0 == $i % 2) ? 'even' : 'odd';
                    $field['wrap_begin'] = sprintf('<div class="%1$s">', implode(' ', $wrap_classes));
                    $field['wrap_end'] = '</div>';
                    $field['id'] = $t->get_field_id($field['id']);
                    $field['name'] = $t->get_field_name($field['name']);
                    $i++;
                    echo KopaControl::get_html($field);
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
    return array($t, $return, $instance);
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_in_widget_form_update($instance, $new_instance, $old_instance) {
    if (isset($new_instance['background-color']))
        $instance['background-color'] = $new_instance['background-color'];

    if (isset($new_instance['background-opacity']))
        $instance['background-opacity'] = $new_instance['background-opacity'];

    if (isset($new_instance['background-image']))
        $instance['background-image'] = $new_instance['background-image'];

    if (isset($new_instance['background-type']))
        $instance['background-type'] = $new_instance['background-type'];

    if (isset($new_instance['parallax-height']))
        $instance['parallax-height'] = $new_instance['parallax-height'];

    if (isset($new_instance['bonus-title']))
        $instance['bonus-title'] = isset($new_instance['bonus-title']) ? 'true' : 'false';

    if (isset($new_instance['bonus-background']))
        $instance['bonus-background'] = isset($new_instance['bonus-background']) ? 'true' : 'false';

    return $instance;
}

/**
 *
 * Get header style. Config by Theme Options >> General Setting >> Header
 *
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_get_header_style() {
    $style = (int) KopaOptions::get_option('header_style', '1');
    $style = (1 == $style) ? '' : $style;
    return apply_filters('kopa_get_header_style', $style);
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 */
function kopa_get_social_links() {
    $social_links = KopaInit::get_social_icons();
    ?>
    <ul id="header-social-links">
        <?php
        foreach ($social_links as $slug => $info) {
            $href = KopaOptions::get_option("social_link_{$slug}");
            if ('rss' == $slug) {
                if (empty($href)) {
                    $href = get_bloginfo_rss('rss2_url');
                } elseif ('HIDE' == $href) {
                    $href = '';
                }
            }
            if (!empty($href)) {
                printf('<li><a class="kopa-social-link" href="%s" target="_blank" title="%s" rel="nofollow"><i class="%s"></i></a></li>', $href, $info['title'], $info['icon']);
            }
        }
        ?>
    </ul>
    <?php
}
