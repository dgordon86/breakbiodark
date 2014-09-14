<?php

add_action('after_setup_theme', 'kopa_after_setup_theme');

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_after_setup_theme() {
    kopa_i18n();
    if (is_admin()) {
        add_action('kopa_after_save_post_custom_post_type', 'kopa_after_save_post_custom_post_type');

        add_action('admin_menu', 'kopa_admin_menu');
        add_action('admin_notices', 'kopa_update_notices');
        add_filter('user_contactmethods', 'kopa_user_contact_methods');
        add_action('admin_enqueue_scripts', 'kopa_admin_register_assets', 5);
        add_action('admin_enqueue_scripts', 'kopa_theme_options_enqueue', 10);
        add_action('admin_enqueue_scripts', 'kopa_sidebar_manage_enqueue', 10);
        add_action('admin_enqueue_scripts', 'kopa_layout_manage_enqueue', 10);
        add_action('admin_enqueue_scripts', 'kopa_widget_enqueue', 10);
        add_action('admin_enqueue_scripts', 'kopa_edit_post_enqueue', 10);
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_after_save_post_custom_post_type() {
    global $post;
    $is_use_custom_layout = KopaUtil::get_post_meta($post->ID, KOPA_OPT_PREFIX . 'is_use_custom_layout', true, 'Boolean', false);

    if (!$is_use_custom_layout) {
        delete_post_meta($post->ID, KOPA_OPT_PREFIX . 'is_use_custom_layout');
        delete_post_meta($post->ID, KOPA_OPT_PREFIX . 'layout');
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_user_contact_methods($user_contact_method) {
    $user_contact_method['facebook'] = __('Facebook URL', kopa_get_domain());
    $user_contact_method['twitter'] = __('Twitter URL', kopa_get_domain());
    $user_contact_method['dribbble'] = __('Dribbble URL', kopa_get_domain());
    $user_contact_method['pinterest'] = __('Pinterest URL', kopa_get_domain());
    $user_contact_method['flickr'] = __('Flickr URL', kopa_get_domain());
    $user_contact_method['google_profile'] = __('Google Profile URL', kopa_get_domain());
    $user_contact_method['youtube'] = __('Youtube URL', kopa_get_domain());
    $user_contact_method['rss'] = __('RSS URL', kopa_get_domain());
    return $user_contact_method;
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_admin_register_assets() {
    $dir = get_template_directory_uri();
    /*
     * --------------------------------------------------
     * STYLESHEETS    
     * --------------------------------------------------
     */
    wp_register_style(KOPA_OPT_PREFIX . 'font-awesome', "{$dir}/library/assets/fonts/awesome/css/font-awesome.css");
    wp_register_style(KOPA_OPT_PREFIX . 'bootstrap', "{$dir}/library/assets/bootstrap/bootstrap.css");
    wp_register_style(KOPA_OPT_PREFIX . 'colorbox', "{$dir}/library/assets/colorbox/colorbox.css");
    wp_register_style(KOPA_OPT_PREFIX . 'ui', "{$dir}/library/css/kopa.ui.css");
    wp_register_style(KOPA_OPT_PREFIX . 'cpanel', "{$dir}/library/css/kopa.cpanel.css");
    wp_register_style(KOPA_OPT_PREFIX . 'theme-options', "{$dir}/library/css/kopa.themeOptions.css");
    wp_register_style(KOPA_OPT_PREFIX . 'layout-manager', "{$dir}/library/css/kopa.layoutManager.css");
    wp_register_style(KOPA_OPT_PREFIX . 'sidebar-manager', "{$dir}/library/css/kopa.sidebarManager.css");
    wp_register_style(KOPA_OPT_PREFIX . 'widget', "{$dir}/library/css/kopa.widget.css");
    wp_register_style(KOPA_OPT_PREFIX . 'shortcodes', "{$dir}/library/css/kopa.shortcodes.css");
    wp_register_style(KOPA_OPT_PREFIX . 'posts', "{$dir}/library/css/kopa.posts.css");

    /*
     * --------------------------------------------------
     * SCRIPTS    
     * --------------------------------------------------
     */
    wp_register_script(KOPA_OPT_PREFIX . 'bootstrap', "{$dir}/library/assets/bootstrap/bootstrap.js", array('jquery'), '3.0.3', TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'colorbox', "{$dir}/library/assets/colorbox/colorbox.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'shortcodes', "{$dir}/library/js/kopa.shortcodes.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'ui', "{$dir}/library/js/kopa.ui.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'cpanel', "{$dir}/library/js/kopa.cpanel.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'theme-options', "{$dir}/library/js/kopa.themeOptions.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'layout-manager', "{$dir}/library/js/kopa.layoutManager.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'sidebar-manager', "{$dir}/library/js/kopa.sidebarManager.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'widget', "{$dir}/library/js/kopa.widget.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'metabox', "{$dir}/library/js/kopa.metabox.js", array('jquery'), NULL, TRUE);
    wp_register_script(KOPA_OPT_PREFIX . 'menu', "{$dir}/library/js/kopa.menu.js", array('jquery'), NULL, TRUE);
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_admin_localize_script() {
    return array(
        'AjaxUrl' => admin_url('admin-ajax.php'),
        'ajax' => array(
            'shortcode_template' => wp_nonce_url(admin_url('admin-ajax.php'), 'kopa_get_shortcode_template', 'ajax_nonce') . '&action=kopa_get_shortcode_template',
        ),
        'dir_assets' => get_template_directory_uri() . '/library/assets',
        'dir_images' => get_template_directory_uri() . '/library/images',
        'dir_js' => get_template_directory_uri() . '/library/js',
        'dir_css' => get_template_directory_uri() . '/library/css',
        'dir_form' => get_template_directory_uri() . '/library/js/tiny-mce-plugin/forms',
        'i18n' => array(
            'shortcodes' => __('Shortcodes', kopa_get_domain()),
            'grid' => __('Grid', kopa_get_domain()),
            'container' => __('Container', kopa_get_domain()),
            'accordion' => __('Accordion', kopa_get_domain()),
            'toggle' => __('Toggle', kopa_get_domain()),
            'video' => __('Video', kopa_get_domain()),
            'youtube' => __('Youtube', kopa_get_domain()),
            'vimeo' => __('Vimeo', kopa_get_domain()),
            'mp4' => __('Mp4', kopa_get_domain()),
            'dropcap' => __('Dropcap', kopa_get_domain()),
            'square' => __('Square', kopa_get_domain()),
            'circle' => __('Circle', kopa_get_domain()),
            'solid' => __('Solid', kopa_get_domain()),
            'mp4' => __('Square', kopa_get_domain()),
            'blockquote' => __('Blockquote', kopa_get_domain()),
            'blockquote_icon_after' => __('Icon after', kopa_get_domain()),
            'blockquote_icon_before' => __('Icon before', kopa_get_domain()),
            'button' => __('Button', kopa_get_domain()),
            'icons' => __('Icons', kopa_get_domain()),
            'contact_form' => __('Contact form', kopa_get_domain()),
            'sidebar_manager' => array(
                'please_enter_sidebar_name' => __('Please enter sidebar name!', kopa_get_domain()),
                'do_you_want_to_remove_this_sidebar' => __('Do you want to remove this sidebar?', kopa_get_domain())
            ),
            'theme_options' => array(
                'do_you_want_to_reset_all_setting_to_default' => __('Do you want to reset all setting to default?', kopa_get_domain()),
                'do_you_want_to_remove_this_custom_info' => __('Do you want to remove this custom info?', kopa_get_domain())
            ),
            'uploader' => array(
                'media_center' => __('Media Center', kopa_get_domain()),
                'choose_image' => __('Choose Image', kopa_get_domain()),
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
function kopa_theme_options_enqueue($hook) {
    if ('toplevel_page_kopa_cpanel_theme_options' == $hook) {
        global $google_font;
        /*
         * --------------------------------------------------
         * STYLESHEET    
         * --------------------------------------------------
         */
        wp_enqueue_style(KOPA_OPT_PREFIX . 'font-awesome');
        wp_enqueue_style('thickbox');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'ui');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'cpanel');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'theme-options');
        /*
         * --------------------------------------------------
         * SCRIPTS    
         * --------------------------------------------------
         */
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-form');
        wp_enqueue_media();
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'ui');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'cpanel');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'theme-options');
        wp_localize_script('jquery', 'kopa_variable', kopa_admin_localize_script());
        wp_localize_script('jquery', 'google_fonts', $google_font);
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_sidebar_manage_enqueue($hook) {
    if (KOPA_OPT_PREFIX . 'page_kopa_cpanel_sidebar_management' == $hook) {
        /*
         * --------------------------------------------------
         * STYLESHEET    
         * --------------------------------------------------
         */
        wp_enqueue_style(KOPA_OPT_PREFIX . 'font-awesome');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'cpanel');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'sidebar-manager');
        /*
         * --------------------------------------------------
         * SCRIPTS    
         * --------------------------------------------------
         */
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-form');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'cpanel');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'sidebar-manager');
        wp_localize_script('jquery', 'kopa_variable', kopa_admin_localize_script());
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_layout_manage_enqueue($hook) {
    if (KOPA_OPT_PREFIX . 'page_kopa_cpanel_layout_management' == $hook) {
        /*
         * --------------------------------------------------
         * STYLESHEET
         * --------------------------------------------------
         */
        wp_enqueue_style(KOPA_OPT_PREFIX . 'font-awesome');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'cpanel');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'layout-manager');
        /*
         * --------------------------------------------------
         * SCRIPTS    
         * --------------------------------------------------
         */
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-form');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'cpanel');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'layout-manager');
        wp_localize_script('jquery', 'kopa_variable', kopa_admin_localize_script());
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_widget_enqueue($hook) {
    if ('widgets.php' == $hook) {
        /*
         * --------------------------------------------------
         * STYLESHEET    
         * --------------------------------------------------
         */
        wp_enqueue_style('thickbox');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'bootstrap');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'widget');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'ui');
        /*
         * --------------------------------------------------
         * SCRIPTS    
         * --------------------------------------------------
         */
        wp_enqueue_script('jquery');
        wp_enqueue_media();
        wp_enqueue_script('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('wp-color-picker');

        wp_enqueue_script(KOPA_OPT_PREFIX . 'bootstrap');

        wp_enqueue_style(KOPA_OPT_PREFIX . 'widget');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'widget');

        wp_enqueue_style(KOPA_OPT_PREFIX . 'shortcodes');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'shortcodes');

        wp_enqueue_style(KOPA_OPT_PREFIX . 'colorbox');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'colorbox');

        wp_enqueue_style(KOPA_OPT_PREFIX . 'ui');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'ui');

        wp_localize_script('jquery', 'kopa_variable', kopa_admin_localize_script());
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_edit_post_enqueue($hook) {
    if (in_array($hook, array('post.php', 'post-new.php'))) {
        wp_enqueue_media();

        wp_enqueue_style(KOPA_OPT_PREFIX . 'shortcodes');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'shortcodes');
        wp_enqueue_style(KOPA_OPT_PREFIX . 'colorbox');
        wp_enqueue_script(KOPA_OPT_PREFIX . 'colorbox');
        wp_localize_script('jquery', 'kopa_variable', kopa_admin_localize_script());
    } else if ('edit.php' == $hook) {
        wp_enqueue_style(KOPA_OPT_PREFIX . 'posts');
    }
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_admin_menu() {
    add_menu_page(
            __('Theme Options', kopa_get_domain()), constant('KOPA_THEME_NAME'), 'edit_theme_options', 'kopa_cpanel_theme_options', '', trailingslashit(get_template_directory_uri()) . '/library/images/logo.png', 61
    );
    #General Setting Page
    add_submenu_page(
            'kopa_cpanel_theme_options', __('Theme Options', kopa_get_domain()), __('Theme Options', kopa_get_domain()), 'edit_theme_options', 'kopa_cpanel_theme_options', 'kopa_cpanel_theme_options'
    );
    #Sidebar Management Page
    add_submenu_page(
            'kopa_cpanel_theme_options', __('Sidebar Manage', kopa_get_domain()), __('Sidebar Manager', kopa_get_domain()), 'edit_theme_options', 'kopa_cpanel_sidebar_management', 'kopa_cpanel_sidebar_management'
    );
    #Layout Management Page
    add_submenu_page(
            'kopa_cpanel_theme_options', __('Layout Manage', kopa_get_domain()), __('Layout Manager', kopa_get_domain()), 'edit_theme_options', 'kopa_cpanel_layout_management', 'kopa_cpanel_layout_management'
    );
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_cpanel_theme_options() {
    include trailingslashit(get_template_directory()) . '/library/cpanel/theme-options.php';
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_cpanel_sidebar_management() {
    include trailingslashit(get_template_directory()) . '/library/cpanel/sidebar-manager.php';
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_cpanel_layout_management() {
    include trailingslashit(get_template_directory()) . '/library/cpanel/layout-manager.php';
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_get_domain() {
    return constant('KOPA_DOMAIN');
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_i18n() {
    load_theme_textdomain(kopa_get_domain(), get_template_directory() . '/languages');
}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_update_notices() {
    $xml = KopaUtil::get_theme_info();
    if ($xml) {
        $theme_data = wp_get_theme();
        if (version_compare($theme_data['Version'], $xml->version) == -1) {
            $out = '<div class="updated kopa_update_info">';
            $out .= sprintf('<p>Latest version of  <b>%1$s</b> theme is <b>%2$s</b> - <a href="%3$s">Update Now</a> - <a href="%4$s" target="_blank">View Change Log</a></p>', $xml->name, $xml->version, $xml->download, $xml->changelog);
            $out .= '</div>';
            echo $out;
        }
    }
}
