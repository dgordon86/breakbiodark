<?php

add_action('init', 'kopa_init_database');

class KopaInit {

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_positions() {
        $positions = array();
        $positions['position_1'] = array('title' => __('Widget Area 1', kopa_get_domain()));
        $positions['position_2'] = array('title' => __('Widget Area 2', kopa_get_domain()));
        $positions['position_3'] = array('title' => __('Widget Area 3', kopa_get_domain()));
        $positions['position_4'] = array('title' => __('Widget Area 4', kopa_get_domain()));
        $positions['position_5'] = array('title' => __('Widget Area 5', kopa_get_domain()));
        $positions['position_6'] = array('title' => __('Widget Area 6', kopa_get_domain()));
        $positions['position_7'] = array('title' => __('Widget Area 7', kopa_get_domain()));
        $positions['position_8'] = array('title' => __('Widget Area 8', kopa_get_domain()));
        $positions['position_9'] = array('title' => __('Widget Area 9', kopa_get_domain()));
        $positions['position_10'] = array('title' => __('Widget Area 10', kopa_get_domain()));
        $positions['position_11'] = array('title' => __('Widget Area 11', kopa_get_domain()));
        $positions['position_12'] = array('title' => __('Widget Area 12', kopa_get_domain()));
        return apply_filters('kopa_init_get_positions', $positions);
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_layouts() {
        $layouts = array();

        $layouts['front-page-1'] = array(
            'title' => __('Front Page 1', kopa_get_domain()),
            'slug' => 'front-page-1',
            'positions' => array(
                'position_1',
                'position_3',
                'position_4',
                'position_7',
                'position_8',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );
        $layouts['front-page-2'] = array(
            'title' => __('Front Page 2', kopa_get_domain()),
            'slug' => 'front-page-2',
            'positions' => array(
                'position_1',
                'position_2',
                'position_7',
                'position_8',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );
        $layouts['front-page-3'] = array(
            'title' => __('Front Page 3', kopa_get_domain()),
            'slug' => 'front-page-3',
            'positions' => array(
                'position_1',
                'position_2',
                'position_3',
                'position_4',
                'position_5',
                'position_6',
                'position_7',
                'position_8',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );
        $layouts['blog-page-1'] = array(
            'title' => __('Blog Page 1 (One Col)', kopa_get_domain()),
            'slug' => 'blog-page-1',
            'positions' => array(
                'position_7',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );
        $layouts['blog-page-2'] = array(
            'title' => __('Blog Page 2 (Two Cols)', kopa_get_domain()),
            'slug' => 'blog-page-2',
            'positions' => array(
                'position_7',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );
        $layouts['single-post-1'] = array(
            'title' => __('Single Post 1', kopa_get_domain()),
            'slug' => 'single-post-1',
            'positions' => array(
                'position_7',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );

        $layouts['static-page-1'] = array(
            'title' => __('Static Page 1', kopa_get_domain()),
            'slug' => 'static-page-1',
            'positions' => array(
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );

        $layouts['contact-page'] = array(
            'title' => __('Contact Page', kopa_get_domain()),
            'slug' => 'contact-page',
            'positions' => array(
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );

        $layouts['static-page-timeline'] = array(
            'title' => __('Static Page - Timeline', kopa_get_domain()),
            'slug' => 'static-page-timeline',
            'positions' => array(
                'position_7',
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );

        $layouts['error-404'] = array(
            'title' => __('Error 404', kopa_get_domain()),
            'slug' => 'error-404',
            'positions' => array(
                'position_9',
                'position_10',
                'position_11',
                'position_12'
            )
        );
        return apply_filters('kopa_init_get_layouts', $layouts);
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_sidebars() {
        $sidebars = array();
        $sidebars['sidebar_hide'] = __('-- None --', kopa_get_domain());
        $sidebars['sidebar_1'] = __('Front Page Slider', kopa_get_domain());
        $sidebars['sidebar_2'] = __('Main Sidebar - Top', kopa_get_domain());
        $sidebars['sidebar_3'] = __('Main Sidebar - Left', kopa_get_domain());
        $sidebars['sidebar_4'] = __('Main Sidebar - Middle', kopa_get_domain());
        $sidebars['sidebar_5'] = __('Main Sidebar - Right', kopa_get_domain());
        $sidebars['sidebar_6'] = __('Main Sidebar - Bottom', kopa_get_domain());
        $sidebars['sidebar_7'] = __('Right Sidebar', kopa_get_domain());
        $sidebars['sidebar_8'] = __('Before Footer', kopa_get_domain());
        $sidebars['sidebar_9'] = __('Footer 1', kopa_get_domain());
        $sidebars['sidebar_10'] = __('Footer 2', kopa_get_domain());
        $sidebars['sidebar_11'] = __('Footer 3', kopa_get_domain());
        $sidebars['sidebar_12'] = __('Footer 4', kopa_get_domain());
        return apply_filters('kopa_init_get_sidebars', $sidebars);
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_sidebar_args() {
        $args = array(
            'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span><span><span>',
            'after_title' => '</span></span></span></h3>'
        );
        return apply_filters('kopa_ini_get_sidebar_args', $args);
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_theme_option_fields() {
        $tabs = array();
        $tabs['general-setting'] = array(
            'title' => __('General Setting', kopa_get_domain()),
            'groups' => kopa_options_general(),
            'icon' => 'fa fa-gear'
        );
        $tabs['blog-posts'] = array(
            'title' => __('Blog Posts', kopa_get_domain()),
            'groups' => kopa_options_blog_posts(),
            'icon' => 'fa fa-folder-open-o'
        );
        $tabs['single-post'] = array(
            'title' => __('Single Post', kopa_get_domain()),
            'groups' => kopa_options_single_post(),
            'icon' => 'fa fa-file-text-o'
        );
        $tabs['contact'] = array(
            'title' => __('Contact', kopa_get_domain()),
            'groups' => kopa_options_contact(),
            'icon' => 'fa fa-envelope-o'
        );
        $tabs['social-links'] = array(
            'title' => __('Social Links', kopa_get_domain()),
            'groups' => kopa_options_social_links(),
            'icon' => 'fa fa-share-square-o'
        );
        $tabs['typography'] = array(
            'title' => __('Typography', kopa_get_domain()),
            'groups' => kopa_options_typography(),
            'icon' => 'fa fa-text-height'
        );
        $tabs['color-scheme'] = array(
            'title' => __('Color Scheme', kopa_get_domain()),
            'groups' => kopa_options_color_scheme(),
            'icon' => 'fa fa-tint'
        );
        $tabs['custom-css'] = array(
            'title' => __('Custom CSS', kopa_get_domain()),
            'groups' => kopa_options_custom_css(),
            'icon' => 'fa fa-code'
        );
        $tabs['shortcode'] = array(
            'title' => __('Shortcode', kopa_get_domain()),
            'groups' => kopa_options_shortcode(),
            'icon' => 'fa fa-gift'
        );
        $tabs['seo'] = array(
            'title' => __('SEO', kopa_get_domain()),
            'groups' => kopa_options_seo(),
            'icon' => 'fa fa-star-o'
        );
        return $tabs;
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_template_hierarchy() {
        $template = array();
        $template['home'] = array(
            'icon' => 'dashicons dashicons-admin-home',
            'title' => __('Home', kopa_get_domain()),
            'layouts' => array(
                'blog-page-1',
                'blog-page-2'
            )
        );
        $template['front-page'] = array(
            'icon' => 'dashicons dashicons-welcome-view-site',
            'title' => __('Front Page', kopa_get_domain()),
            'layouts' => array(
                'front-page-1',
                'front-page-2',
                'front-page-3',
                'static-page-1',
                'contact-page',
                'static-page-timeline',
            )
        );
        $template['post'] = array(
            'icon' => 'dashicons dashicons-admin-post',
            'title' => __('Single Post', kopa_get_domain()),
            'layouts' => array(
                'single-post-1'
            )
        );
        $template['page'] = array(
            'icon' => 'dashicons dashicons-admin-page',
            'title' => __('Static Page', kopa_get_domain()),
            'layouts' => array(
                'static-page-1',
                'contact-page',
                'static-page-timeline',
                'front-page-1',
                'front-page-2',
                'front-page-3',
            )
        );
        $template['archive'] = array(
            'icon' => 'dashicons dashicons-images-alt',
            'title' => __('Archive', kopa_get_domain()),
            'layouts' => array(
                'blog-page-1',
                'blog-page-2'
            )
        );
        $template['taxonomy'] = array(
            'icon' => 'dashicons dashicons-tag',
            'title' => __('Category | Tag', kopa_get_domain()),
            'layouts' => array(
                'blog-page-1',
                'blog-page-2'
            )
        );
        $template['author'] = array(
            'icon' => 'dashicons dashicons-businessman',
            'title' => __('Author', kopa_get_domain()),
            'layouts' => array(
                'blog-page-1',
                'blog-page-2'
            )
        );
        $template['search'] = array(
            'icon' => 'dashicons dashicons-search',
            'title' => __('Search Result', kopa_get_domain()),
            'layouts' => array(
                'blog-page-1',
                'blog-page-2',
            )
        );
        $template['_404'] = array(
            'icon' => 'dashicons dashicons-sos',
            'title' => __('404 Page not found', kopa_get_domain()),
            'layouts' => array(
                'error-404'
            )
        );
        return apply_filters('kopa_init_get_template_hierarchy', $template);
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_social_icons() {
        $socials = array();

        $socials['facebook'] = array(
            'title' => __('Facebook', kopa_get_domain()),
            'icon' => 'fa fa-facebook',
            'color' => ''
        );
        $socials['dribbble'] = array(
            'title' => __('Dribbble', kopa_get_domain()),
            'icon' => 'fa fa-dribbble',
            'color' => ''
        );
        $socials['linkedin'] = array(
            'title' => __('Linkedin', kopa_get_domain()),
            'icon' => 'fa fa-linkedin',
            'color' => ''
        );
        $socials['pinterest'] = array(
            'title' => __('Pinterest', kopa_get_domain()),
            'icon' => 'fa fa-pinterest',
            'color' => ''
        );
        $socials['google-plus'] = array(
            'title' => __('Google plus', kopa_get_domain()),
            'icon' => 'fa fa-google-plus',
            'color' => ''
        );
        $socials['twitter'] = array(
            'title' => __('Twitter', kopa_get_domain()),
            'icon' => 'fa fa-twitter',
            'color' => ''
        );
        $socials['adn'] = array(
            'title' => __('Adn', kopa_get_domain()),
            'icon' => 'fa fa-adn',
            'color' => ''
        );
        $socials['android'] = array(
            'title' => __('Android', kopa_get_domain()),
            'icon' => 'fa fa-android',
            'color' => ''
        );
        $socials['apple'] = array(
            'title' => __('Apple', kopa_get_domain()),
            'icon' => 'fa fa-apple',
            'color' => ''
        );
        $socials['bitbucket'] = array(
            'title' => __('Bitbucket', kopa_get_domain()),
            'icon' => 'fa fa-bitbucket',
            'color' => ''
        );
        $socials['btc'] = array(
            'title' => __('Btc', kopa_get_domain()),
            'icon' => 'fa fa-btc',
            'color' => ''
        );
        $socials['css3'] = array(
            'title' => __('Css3', kopa_get_domain()),
            'icon' => 'fa fa-css3',
            'color' => ''
        );
        $socials['dropbox'] = array(
            'title' => __('Dropbox', kopa_get_domain()),
            'icon' => 'fa fa-dropbox',
            'color' => ''
        );
        $socials['flickr'] = array(
            'title' => __('Flickr', kopa_get_domain()),
            'icon' => 'fa fa-flickr',
            'color' => ''
        );
        $socials['foursquare'] = array(
            'title' => __('Foursquare', kopa_get_domain()),
            'icon' => 'fa fa-foursquare',
            'color' => ''
        );
        $socials['github'] = array(
            'title' => __('Github', kopa_get_domain()),
            'icon' => 'fa fa-github',
            'color' => ''
        );
        $socials['gittip'] = array(
            'title' => __('Gittip', kopa_get_domain()),
            'icon' => 'fa fa-gittip',
            'color' => ''
        );
        $socials['html5'] = array(
            'title' => __('Html5', kopa_get_domain()),
            'icon' => 'fa fa-html5',
            'color' => ''
        );
        $socials['instagram'] = array(
            'title' => __('Instagram', kopa_get_domain()),
            'icon' => 'fa fa-instagram',
            'color' => ''
        );
        $socials['linux'] = array(
            'title' => __('Linux', kopa_get_domain()),
            'icon' => 'fa fa-linux',
            'color' => ''
        );
        $socials['pagelines'] = array(
            'title' => __('Pagelines', kopa_get_domain()),
            'icon' => 'fa fa-pagelines',
            'color' => ''
        );
        $socials['maxcdn'] = array(
            'title' => __('Maxcdn', kopa_get_domain()),
            'icon' => 'fa fa-maxcdn',
            'color' => ''
        );
        $socials['renren'] = array(
            'title' => __('Renren', kopa_get_domain()),
            'icon' => 'fa fa-renren',
            'color' => ''
        );
        $socials['skype'] = array(
            'title' => __('Skype', kopa_get_domain()),
            'icon' => 'fa fa-skype',
            'color' => ''
        );
        $socials['stack-exchange'] = array(
            'title' => __('Stack exchange', kopa_get_domain()),
            'icon' => 'fa fa-stack-exchange',
            'color' => ''
        );
        $socials['stack-overflow'] = array(
            'title' => __('Stack overflow', kopa_get_domain()),
            'icon' => 'fa fa-stack-overflow',
            'color' => ''
        );
        $socials['trello'] = array(
            'title' => __('Trello', kopa_get_domain()),
            'icon' => 'fa fa-trello',
            'color' => ''
        );
        $socials['tumblr'] = array(
            'title' => __('Tumblr', kopa_get_domain()),
            'icon' => 'fa fa-tumblr',
            'color' => ''
        );
        $socials['vk'] = array(
            'title' => __('vk', kopa_get_domain()),
            'icon' => 'fa fa-vk',
            'color' => ''
        );
        $socials['weibo'] = array(
            'title' => __('Weibo', kopa_get_domain()),
            'icon' => 'fa fa-weibo',
            'color' => ''
        );
        $socials['windows'] = array(
            'title' => __('Windows', kopa_get_domain()),
            'icon' => 'fa fa-windows',
            'color' => ''
        );
        $socials['xing'] = array(
            'title' => __('Xing', kopa_get_domain()),
            'icon' => 'fa fa-xing',
            'color' => ''
        );
        $socials['youtube'] = array(
            'title' => __('Youtube', kopa_get_domain()),
            'icon' => 'fa fa-youtube',
            'color' => ''
        );
        $socials['rss'] = array(
            'title' => __('RSS', kopa_get_domain()),
            'icon' => 'fa fa-rss',
            'color' => '',
            'help' => __('Display the RSS feed button with the default RSS feed or enter a custom feed above. <br/>Enter <code>HIDE</code> if you want to hide it', kopa_get_domain())
        );
        return apply_filters('kopa_init_get_social_icons', $socials);
    }

    /**
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0         
     */
    static function get_image_sizes() {
        $sizes = array();
        // posts-thubnail-big-and-small
        // posts-thumbnail-small
        $sizes['size_00'] = array(
            'name' => __('80 x 80 (pixel)', kopa_get_domain()),
            'width' => 80,
            'height' => 80,
            'crop' => true,
            'desc' => __('Widget: posts thubnail big and small<br/>Widget: posts thumbnail small', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-carousel-multi
        // posts-carousel-scroll
        $sizes['size_01'] = array(
            'name' => __('277 x 211 (pixel)', kopa_get_domain()),
            'width' => 277,
            'height' => 211,
            'crop' => true,
            'desc' => __('Widget: posts carousel multi<br/>Widget: posts carousel scroll', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-carousel-two-cols
        // posts-carousel-big-and-small
        $sizes['size_02'] = array(
            'name' => __('272 x 181 (pixel)', kopa_get_domain()),
            'width' => 272,
            'height' => 181,
            'crop' => true,
            'desc' => __('Widget: posts carousel two cols<br/>Widget: posts carousel big and small', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-carousel-thumb        
        $sizes['size_03'] = array(
            'name' => __('182 x 128 (pixel)', kopa_get_domain()),
            'width' => 182,
            'height' => 128,
            'crop' => true,
            'desc' => __('Widget: posts carousel thumb', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-carousel-two-cols
        $sizes['size_04'] = array(
            'name' => __('503 x 363 (pixel)', kopa_get_domain()),
            'width' => 503,
            'height' => 363,
            'crop' => true,
            'desc' => __('Widget: posts carousel two cols', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-carousel-single
        $sizes['size_05'] = array(
            'name' => __('300 x 203 (pixel)', kopa_get_domain()),
            'width' => 300,
            'height' => 203,
            'crop' => true,
            'desc' => __('Widget: posts carousel single', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-thumbnail-medium
        $sizes['size_06'] = array(
            'name' => __('398 x 398 (pixel)', kopa_get_domain()),
            'width' => 398,
            'height' => 398,
            'crop' => true,
            'desc' => __('Widget: posts thumbnail medium', kopa_get_domain()),
            'type' => array('post')
        );

        // posts-ajax-filter
        $sizes['size_07'] = array(
            'name' => __('350 x auto (pixel)', kopa_get_domain()),
            'width' => 350,
            'height' => NULL,
            'crop' => false,
            'desc' => __('Widget: posts ajax filter', kopa_get_domain()),
            'type' => array('post')
        );

        // gallery shortcode        
        $sizes['size_08'] = array(
            'name' => __('287 x 226 (pixel)', kopa_get_domain()),
            'width' => 287,
            'height' => 226,
            'crop' => true,
            'desc' => __('Shortcode: gallery (small)', kopa_get_domain()),
            'type' => array('post')
        );

        // blog-page-1
        // blog-page-2        
        // blog-timeline
        // single-post-1            
        $sizes['size_09'] = array(
            'name' => __('785 x 442 (pixel)', kopa_get_domain()),
            'width' => 785,
            'height' => 442,
            'crop' => true,
            'desc' => __('Layout: blog page 1<br/>Layout: blog page 2<br/>Layout: blog page 3<br/>Layout: blog timeline<br/>Layout: single post 1<br/>Layout: single post 2', kopa_get_domain()),
            'type' => array('post')
        );

        // gallery (big)    
        $sizes['size_10'] = array(
            'name' => __('800 x 450(pixel)', kopa_get_domain()),
            'width' => 800,
            'height' => 450,
            'crop' => true,
            'desc' => __('Shortcode: gallery (big)', kopa_get_domain()),
            'type' => array('post')
        );

        // gallery (big)    
        $sizes['size_11'] = array(
            'name' => __('940 x 476(pixel)', kopa_get_domain()),
            'width' => 940,
            'height' => 476,
            'crop' => true,
            'desc' => __('Shortcode: gallery (big)', kopa_get_domain()),
            'type' => array('post')
        );

        // slider fluid
        $sizes['size_12'] = array(
            'name' => __('847 x 467(pixel)', kopa_get_domain()),
            'width' => 847,
            'height' => 467,
            'crop' => true,
            'desc' => __('Slider fluid', kopa_get_domain()),
            'type' => array('post')
        );

        $sizes['size_13'] = array(
            'name' => __('340 x 230 (pixel)', kopa_get_domain()),
            'width' => 340,
            'height' => 230,
            'crop' => true,
            'desc' => __('Layout: blog page 1<br/>Layout: blog page 2<br/>Layout: blog page 3<br/>Layout: blog timeline<br/>Layout: single post 1<br/>Layout: single post 2', kopa_get_domain()),
            'type' => array('post')
        );

        return apply_filters('kopa_init_get_image_sizes', $sizes);
    }

}

/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_init_database() {
    $kopa_is_database_setup = get_option(KOPA_OPT_PREFIX . 'database_setup');
    if ($kopa_is_database_setup !== KOPA_INIT_VERSION) {
        $kopa_setting = array(
            'home' => array(
                'layout_slug' => 'blog-page-1',
                'sidebars' => array(
                    'blog-page-1' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'blog-page-2' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                )
            ),
            'front-page' => array(
                'layout_slug' => 'front-page-1',
                'sidebars' => array(
                    'front-page-1' => array(
                        'sidebar_1',
                        'sidebar_3',
                        'sidebar_4',
                        'sidebar_7',
                        'sidebar_8',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'front-page-2' => array(
                        'sidebar_1',
                        'sidebar_2',
                        'sidebar_7',
                        'sidebar_8',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'front-page-3' => array(
                        'sidebar_1',
                        'sidebar_2',
                        'sidebar_3',
                        'sidebar_4',
                        'sidebar_5',
                        'sidebar_6',
                        'sidebar_7',
                        'sidebar_8',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'static-page-1' => array(
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'contact-page' => array(
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'static-page-timeline' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                ),
            ),
            'post' => array(
                'layout_slug' => 'single-post-1',
                'sidebars' => array(
                    'single-post-1' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                ),
            ),
            'page' => array(
                'layout_slug' => 'static-page-1',
                'sidebars' => array(
                    'static-page-1' => array(
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'contact-page' => array(
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'static-page-timeline' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'front-page-1' => array(
                        'sidebar_1',
                        'sidebar_3',
                        'sidebar_4',
                        'sidebar_7',
                        'sidebar_8',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'front-page-2' => array(
                        'sidebar_1',
                        'sidebar_2',
                        'sidebar_7',
                        'sidebar_8',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'front-page-3' => array(
                        'sidebar_1',
                        'sidebar_2',
                        'sidebar_3',
                        'sidebar_4',
                        'sidebar_5',
                        'sidebar_6',
                        'sidebar_7',
                        'sidebar_8',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                )
            ),
            'taxonomy' => array(
                'layout_slug' => 'blog-page-1',
                'sidebars' => array(
                    'blog-page-1' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'blog-page-2' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                )
            ),
            'author' => array(
                'layout_slug' => 'blog-page-1',
                'sidebars' => array(
                    'blog-page-1' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'blog-page-2' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                )
            ),
            'search' => array(
                'layout_slug' => 'blog-page-1',
                'sidebars' => array(
                    'blog-page-1' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'blog-page-2' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                )
            ),
            'archive' => array(
                'layout_slug' => 'blog-page-1',
                'sidebars' => array(
                    'blog-page-1' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    ),
                    'blog-page-2' => array(
                        'sidebar_7',
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12'
                    )
                )
            ),
            '_404' => array(
                'layout_slug' => 'error-404',
                'sidebars' => array(
                    'error-404' => array(
                        'sidebar_9',
                        'sidebar_10',
                        'sidebar_11',
                        'sidebar_12',
                    )
                )
            )
        );
        $kopa_sidebar = KopaInit::get_sidebars();
        update_option(KOPA_OPT_PREFIX . 'layout_settings', $kopa_setting);
        update_option(KOPA_OPT_PREFIX . 'database_setup', KOPA_INIT_VERSION);
        //if (KOPA_DOMAIN . '-layout-setting-v1' == KOPA_INIT_VERSION) {
        update_option(KOPA_OPT_PREFIX . 'sidebars', $kopa_sidebar);
        //}
        $saved_opts = get_option(KOPA_OPT_PREFIX . 'options');
        if (!$saved_opts) {
            $tabs = KopaInit::get_theme_option_fields();
            $opts = array();
            foreach ($tabs as $tab) {
                foreach ($tab['groups'] as $groups) {
                    foreach ($groups['fields'] as $field) {
                        kopa_save_theme_options_loop($field, $opts);
                    }
                }
            }
            update_option(KOPA_OPT_PREFIX . 'options', $opts);
        }
    }
    $sidebars = get_option(KOPA_OPT_PREFIX . 'sidebars');
    foreach ($sidebars as $key => $value) {
        if ('sidebar_hide' != $key) {
            $sidebar_args = KopaInit::get_sidebar_args();
            $sidebar_args['name'] = $value;
            $sidebar_args['id'] = $key;
            register_sidebar($sidebar_args);
        }
    }
}
