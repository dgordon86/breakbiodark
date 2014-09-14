<?php
if (!is_admin())
    require_once get_template_directory() . '/library/cpanel/theme-options/typography.php';
new KopaCustomize();

class KopaCustomize {

    /**
     * An array include custom colors - selected by admin
     *
     * @var array
     */
    public $color_scheme;

    /**
     * An array include custom font (family, size, weight, line-height) - selected by admin
     * 
     * @var array
     */
    public $typography;

    public function __construct() {
        $this->color_scheme = KopaOptions::get_option('colors', '#222222');
        $this->typography = array();
        add_filter('body_class', array(&$this, 'body_class'));
        add_action('wp_footer', array(&$this, 'wp_footer'), 20);
        add_action('admin_enqueue_scripts', array(&$this, 'theme_options_enqueue'));
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
    }

    /**
     * Modify body classes by theme-option
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     * 
     * @param array
     * @return array
     */
    function body_class($classes) {
        global $kopaCurrentLayout;

        $header_style = kopa_get_header_style();
        switch ($header_style) {
            case 2:
                $classes[] = 'header-2';
                break;
            default :
                $classes[] = 'header-1';
                break;
        }


        switch ($kopaCurrentLayout) {
            case 'front-page-1':
                $classes[] = 'index-1';
                break;
            case 'front-page-2':
                $classes[] = 'index-2';
                break;
            case 'front-page-3':
                $classes[] = 'index-3';
                break;
            case 'blog-page-1':
                $classes[] = 'sub-page';
                $classes[] = 'kp-cat';
                $classes[] = 'site-1';
                break;
            case 'blog-page-2':
                $classes[] = 'sub-page';
                $classes[] = 'kp-cat';
                $classes[] = 'kp-cat-2';
                $classes[] = 'site-1';
                break;
            case 'static-page-timeline':
                $classes[] = 'sub-page';
                $classes[] = 'kp-blog-timeline';
                $classes[] = 'site-1';
                break;
            case 'error-404':
                $classes[] = 'sub-page';
                $classes[] = 'kp-404';
                $classes[] = 'site-2';
                break;
            case 'static-page-1':
            case 'single-post-1':
                $classes[] = 'kp-single-1';
                $classes[] = 'site-1';
                $classes[] = 'sub-page';
                break;
            case 'contact-page':
                $classes[] = 'index-4';
                $classes[] = 'kp-single-2';
                $classes[] = 'site-2';
                $classes[] = 'sub-page';
                break;
        }
        if (is_page() && is_front_page()) {
            $classes[] = 'kp-home';
        }
        return array_unique($classes);
    }

    /**
     * Print custom style from Color Scheme, Typography, Custom CSS
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     * @return NULL
     */
    function wp_footer() {
        $css = array();

        /*
         * --------------------------------------------------
         * COLOR
         * --------------------------------------------------
         */
        $primary_colors = strtolower(KopaOptions::get_option('primary_color', '#d40202'));

        if ('#d40202' != $primary_colors) {
            ?>
            <style type="text/css">
                body,
                a,
                .search-form .search-submit,
                .breadcrumb span:last-child a:hover,                
                .kp-cat .list-post-cat ul.page-numbers li > a i, .kp-cat .list-post-cat ul.page-numbers li > span i,
                .ui-accordion .ui-accordion-header:after,
                ul.page-numbers li > a i, ul.page-numbers li > span i,
                .kp-blog-timeline .kp-isotope .item .kopa-thumb span, .kp-blog-timeline .kp-isotope .item .kopa-thumb a,
                .form-contact .contact-form .form-control {
                    color: #7c7c7c;
                }

                .read-more{
                    border-color: <?php echo $primary_colors; ?>;
                    color: <?php echo $primary_colors; ?>;
                }
                .read-more:hover{
                    background-color: <?php echo $primary_colors; ?>; 
                }               
                .widget-gallery .sync2{
                    background-color: <?php echo $primary_colors; ?>; 
                }               
                .widget-lastest-post .owl-carousel .item .post-title a:hover, 
                .widget-random .item .post-title a:hover, 
                .widget-list-video .item .post-title a:hover, 
                .kp-blog .feature-post .item .post-title a:hover, 
                .last-post-review .item .post-title a:hover,
                h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
                a:hover,
                .index-4 h1 a, .index-4 h2 a, .index-4 h3 a, .index-4 h4 a, .index-4 h5 a, .index-4 h6 a,
                .load-more span,                
                #main-content .widget-newsletter .widget-title,
                #sidebar .widget-newsletter .widget-title,
                .widget-popular .post-cat a,
                .widget-popular ul.page-numbers li a:hover, .widget-popular ul.page-numbers li span.current,
                .widget-popular ul.page-numbers li a:hover i, .widget-popular ul.page-numbers li span.current i,
                .widget-hot-news .post-cat a,
                .widget_archive ul li a:hover,
                .widget_categories ul li a:hover,
                .widget_pages ul li a:hover,
                .widget_meta ul li a:hover,
                .widget_recent_comments ul li a:hover,
                .widget_recent_entries ul li a:hover,
                .widget_rss ul li a:hover,
                .widget_nav_menu ul li a:hover,
                .widget-area-4 a:hover,
                .widget-area-4 .widget_text p span,
                .widget-area-4 .widget_text a:hover,
                .widget-twitters .tweetList .timestamp,
                .widget-twitters .tweetList a:hover,
                #page-footer .bottom-menu a:hover,
                .index-3 .widget-area-2 .widget-feature-slider .kp-caption .post-title a:hover,
                .header-2 .main-menu .menu-primary.sf-menu ul li a:hover,
                .bottom-sidebar.bottom-sidebar-2 .widget-area-4 .widget-twitters .tweetList a,
                .bottom-sidebar.bottom-sidebar-2 .widget-area-4 .widget-latest-news .post-title a:hover,
                .bottom-sidebar.bottom-sidebar-2 .widget-area-4 .widget_text p span,
                .bottom-sidebar.bottom-sidebar-2 .widget-area-4 .widget_text a:hover,
                .widget-feature-images .item .kp-caption .post-title a:hover,
                .widget-tool-2 .item .kp-icon .tool-icon:hover,
                .header-3 .main-menu .sf-menu > li > a:hover,
                .header-3 .main-menu .sf-menu .curent-menu-item a,
                .header-3 .main-menu .sf-menu ul li a:hover,
                .site-1 .post-content .kp-author .social-box.style-2 a:hover,
                .sub-page .post-content .page-links a:hover,
                .sub-page .post-content .page-links > span,
                .sub-page .post-content .pager-page a.prev, .sub-page .post-content .pager-page a.next,
                .sub-page.site-2 .post-content .page-links a:hover, .sub-page.site-2 .post-content .page-links > span,
                #comments .comment-list .comment-body .comment-content header h4,
                #comments .comment-list .comment-body .comment-content header .kp-metadata a:hover,
                #comments .pagination > a:hover,
                #comments .pagination .current,
                #respond .comment-form label.error,
                #respond .comment-notes span,
                #respond label span,                
                .site-2 .post-content .pager-page a.prev, .site-2 .post-content .pager-page a.next, .site-2 .post-content .pager-page a.prev:before, .site-2 .post-content .pager-page a.next:after,
                .site-2 #comments .comment-list .comment-body .comment-content header h4,                
                .kp-cat .list-post-cat ul.page-numbers li > a:hover, .kp-cat .list-post-cat ul.page-numbers li > a:hover i, .kp-cat .list-post-cat ul.page-numbers li .current,
                .widget-gallery .sync1 .item .post-title a:hover,
                .ui-accordion.style-2 .ui-accordion-header:hover,
                .ui-accordion.style-2 .ui-accordion-header-active,
                ul.page-numbers li > a:hover, ul.page-numbers li > a:hover i, ul.page-numbers li .current,
                .kp-dropcap.style-3,
                .kp-blog-timeline .filter-isotope .kp-year.show > span,
                .kp-blog-timeline .kp-isotope .load-more span,
                .form-contact .form-group label.error {
                    color: <?php echo $primary_colors; ?>; }


                #page-header .header-bottom,
                .main-menu .header-bottom-inner,                
                #main-content .widget-newsletter input[type="submit"],
                #sidebar .widget-newsletter input[type="submit"],
                .widget-newsletter .like-box a,
                .widget-popular .post-cat:before,
                .widget_tag_cloud .tagcloud a:hover,
                .widget-feature-news-slider .owl-carousel .kp-caption,
                .widget-latest-article > header .widget-title,
                .widget-latest-article .item figure a span,
                .header-2 #page-header .search-form .search-submit,
                .header-2 .main-menu .header-bottom-inner,
                .widget-area-4 .widget-newsletter .newsletter-form input[type="submit"],
                .widget-area-4 .widget-social a:hover,
                .site-1 .post-content .kp-author .social-box.style-2 a:hover,
                .sub-page .post-content .kp-tags a:hover,
                .site-2 #main-content .related-article .kp-caption,
                .site-2 .post-content .kp-tags a:hover,
                .widget-gallery .sync1 .owl-controls .owl-buttons div,
                .ui-accordion .ui-accordion-header:hover:after,
                .ui-accordion .ui-accordion-header-active:after,
                .ui-accordion.style-2 .ui-accordion-header:hover,
                .ui-accordion.style-2 .ui-accordion-header-active,
                .ui-tabs .ui-tabs-nav .ui-state-default[aria-selected=false] a,
                .btn,
                ul.page-numbers.style-2 li > a:hover,
                ul.page-numbers.style-2 li span.current,
                .kp-dropcap,
                .kp-blockquote-2:after,
                .social-box.style-2 a:hover,
                .kp-blog-timeline .filter-isotope .kp-year:hover,
                .kp-blog-timeline .filter-isotope .kp-year ul li a:hover,
                .kp-blog-timeline .filter-isotope .kp-year ul .active a,
                .kp-blog-timeline .filter-isotope .kp-now,
                .kp-blog-timeline .kp-isotope .item .more-i .more-time,
                .kp-blog-timeline .kp-isotope .item .more-i > i,
                .contact-info .item span,
                .form-contact .contact-form input[type="submit"] {
                    background: <?php echo $primary_colors; ?>;
                }                
                .widget_tag_cloud .tagcloud a:hover {
                    border-color: <?php echo $primary_colors; ?>; }
                .header-2 .main-menu .menu-primary.sf-menu ul li a:hover {
                    border-left-color: <?php echo $primary_colors; ?>;}
                .site-1 .post-content .kp-author .social-box.style-2 a:hover {
                    border-color: <?php echo $primary_colors; ?>; }
                .ui-accordion.style-2 .ui-accordion-header:hover {
                    border-color: <?php echo $primary_colors; ?>;}
                .ui-accordion.style-2 .ui-accordion-header-active {
                    border-color: <?php echo $primary_colors; ?>;}
                ul.page-numbers.style-2 li > a:hover {
                    border-color: <?php echo $primary_colors; ?>;}
                ul.page-numbers.style-2 li span.current {
                    border-color: <?php echo $primary_colors; ?>;}
                .social-box.style-2 a:hover {
                    border-color: <?php echo $primary_colors; ?>; }
                .kp-blog-timeline .filter-isotope .kp-year ul li a:hover {
                    border-left-color: <?php echo $primary_colors; ?>; }
                .kp-blog-timeline .filter-isotope .kp-year ul .active a {
                    border-left-color: <?php echo $primary_colors; ?>; }
                .breaking-news > span:before{
                    border-left-color: <?php echo $primary_colors; ?>; }
                .breaking-news > span:after{
                    border-right-color: <?php echo $primary_colors; ?>; }                
                #main-content .widget-title span span span, #sidebar .widget-title span span span{
                    border-bottom-color: <?php echo $primary_colors; ?>; }  
                .widget-hot-news .post-cat a{
                    border-bottom-color: <?php echo $primary_colors; ?>; }  
                #main-content .widget-newsletter .widget-title span span span, #sidebar .widget-newsletter .widget-title span span span{
                    border-bottom-color: <?php echo $primary_colors; ?>; }  
                .widget-most-review .index0 a{
                    background-color:<?php echo KopaUtil::convert_hex2rgba($primary_colors, 0.75); ?>
                }
                .kp-blog-timeline .filter-isotope .kp-now:before{
                    border-top-color: <?php echo $primary_colors; ?>; }  
                .kp-blog-timeline .kp-isotope .item .more-i > i:after{
                    border-right-color: <?php echo $primary_colors; ?>; }  
                #comments .comments-title span span span, #comments .comment-reply-title span span span{
                    border-bottom-color: <?php echo $primary_colors; ?>; }  
                .widget.kopa_owl_slider .owl-slider-col-right .owl-slider-single-slide-detail .kopa-icon-post-format{
                    background-color: <?php echo $primary_colors; ?>;
                }
                .widget.kopa_owl_slider .owl-slider-col-right .owl-slider-single-slide-detail .kopa-metadata li i.fa{
                    color: <?php echo $primary_colors; ?>;
                }
                .widget.kopa_owl_slider .owl-slider-col-left .owl-slider-navigation-post-title:hover, .widget.kopa_owl_slider .owl-slider-col-left .owl-slider-navigation-post-title.active{
                    border-left-color: <?php echo $primary_colors; ?>;
                }
                .btn:hover{
                    border-color: <?php echo $primary_colors; ?>;
                }
                blockquote{
                    border-left-color: <?php echo $primary_colors; ?>;
                }
                .widget-popular h5.post-cat{
                    color: <?php echo $primary_colors; ?>;
                }
                .widget-hot-news h5.post-cat{
                    color: <?php echo $primary_colors; ?>;
                }
            </style>
            <?php
        }

        $header_style = kopa_get_header_style();
        if ('' == $header_style) {
            $header_bg_color = KopaOptions::get_option('header_background_color', '#141414');
            ?>
            <style type="text/css">
                body.header-1 #page-header .header-middle{
                    background-color: <?php echo $header_bg_color; ?>; 
                }                
            </style>
            <?php
        }

        /*
         * --------------------------------------------------
         * FONT
         * --------------------------------------------------
         */
        $typo_selector = array();
        foreach ($this->typography as $slug => $typo) {
            if ('off' != $typo['family']) {
                switch ($slug) {
                    case 'body_font':
                        $typo_selector[$slug] = 'body';
                        break;
                    case 'widget_title_font':
                        $typo_selector[$slug] = '#sidebar .widget-newsletter h3.widget-title, .widget-area-4 h3.widget-title, #sidebar h3.widget-title, #main-content h3.widget-title, h3.widget-title';
                        break;
                    case 'entry_title_font':
                        $typo_selector[$slug] = '.sub-page .post-content .title-post, h1.title-post.entry-title';
                        break;
                    case 'entry_content_font':
                        $typo_selector[$slug] = '#main-content .entry-content, #main-content .entry-content p';
                        break;
                    case 'nav_top_font':
                        $typo_selector[$slug] = '#menu-second li a';
                        break;
                    case 'nav_bottom_font':
                        $typo_selector[$slug] = '#bottom-menu li a';
                        break;
                    case 'nav_primary_font':
                        $typo_selector[$slug] = '#menu-primary li a';
                        break;
                    case 'h1_font':
                        $typo_selector[$slug] = 'h1';
                        break;
                    case 'h2_font':
                        $typo_selector[$slug] = 'h2';
                        break;
                    case 'h3_font':
                        $typo_selector[$slug] = 'h3';
                        break;
                    case 'h4_font':
                        $typo_selector[$slug] = 'h4';
                        break;
                    case 'h5_font':
                        $typo_selector[$slug] = 'h5';
                        break;
                    case 'h6_font':
                        $typo_selector[$slug] = 'h6';
                        break;
                }
            }
        }

        if (!empty($typo_selector)) {
            foreach ($typo_selector as $slug => $selector) {
                $css[$selector]['font-family'] = "'{$this->typography[$slug]['family']}'";
                $css[$selector]['font-size'] = $this->typography[$slug]['size'] . 'px';
                $css[$selector]['font-weight'] = $this->typography[$slug]['weight'];
                $css[$selector]['line-height'] = $this->typography[$slug]['line-height'] . 'px';
                $css[$selector]['text-transform'] = $this->typography[$slug]['text-transform'];
            }
        }


        /*
         * --------------------------------------------------
         * LOGO MARGIN
         * --------------------------------------------------
         */
        $css['#logo-image']['margin-top'] = sprintf('%spx', KopaOptions::get_option('logo_margin_top', 40));
        $css['#logo-image']['margin-bottom'] = sprintf('%spx', KopaOptions::get_option('logo_margin_bottom', 10));
        $css['#logo-image']['margin-left'] = sprintf('%spx', KopaOptions::get_option('logo_margin_left', 0));
        $css['#logo-image']['margin-right'] = sprintf('%spx', KopaOptions::get_option('logo_margin_right', 0));


        /*
         * --------------------------------------------------
         * PRINT CUSTOMIZE RULES
         * --------------------------------------------------
         */
        $css = apply_filters('kopa_customize', $css);
        if (!empty($css)) {
            $out = '';
            foreach ($css as $element => $rules) {
                $tmp = '';
                foreach ($rules as $rule => $value) {
                    $tmp .= sprintf('%s : %s;', $rule, $value);
                }
                $out .= sprintf('%s{%s}', $element, $tmp);
            }
            printf('<style id="kopa-customize-style" type="text/css">%s</style>', $out);
        }

        /*
         * --------------------------------------------------
         * PRINT CUSTOMIZE CSS (from theme options)
         * --------------------------------------------------
         */
        $custom_css = htmlspecialchars_decode(stripslashes(KopaOptions::get_option('custom_css')));
        if ($custom_css) {
            printf('<style type="text/css">%s</style>', $custom_css);
        }
    }

    /**
     * Enqueue customize scripts (or style) for frontend
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     * 
     * @param string
     * @return NULl
     */
    function enqueue_scripts($hook) {
        $this->load_font();
    }

    /**
     * Enqueue customize scripts (or style) for backend
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     * 
     * @param string
     * @return NULl
     */
    function theme_options_enqueue($hook) {
        if ('toplevel_page_kopa_cpanel_theme_options' == $hook) {
            $this->load_font();
        }
    }

    /**
     * Enqueue custom font - selected by admin
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     * @return NULl
     */
    function load_font() {
        global $google_font;

        $character_sets = KopaOptions::get_option('character_sets', array());
        $subset = '';
        if (!empty($character_sets)) {
            $subset = sprintf('&subset=%s', implode(',', $character_sets));
        }

        $typos = kopa_options_typography();
        foreach ($typos as $group) {
            foreach ($group['fields'] as $field) {
                if ('font' == $field['type']) {
                    $value = KopaOptions::get_option($field['name'], $field['default']);
                    if (isset($value) || !empty($value)) {
                        if ('off' != $value['family']) {
                            $font_family = str_replace(' ', '+', $google_font['items'][$value['family']]['family']);
                            $cssID = sprintf('css-dynamic-%s-family', $field['name']);
                            $tmp = sprintf('http://fonts.googleapis.com/css?family=%s:%s%s', $font_family, $value['weight'], $subset);

                            wp_enqueue_style($cssID, $tmp, array(), NULL);
                            $this->typography[$field['name']] = $value;
                            $this->typography[$field['name']]['family'] = $google_font['items'][$value['family']]['family'];
                        }
                    }
                }
            }
        }
    }

}
