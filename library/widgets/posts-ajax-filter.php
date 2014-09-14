<?php
add_action('wp_footer', 'kplaf_print_nonce');
add_action('wp_ajax_kplaf_load_contents', 'kplaf_load_contents');
add_action('wp_ajax_nopriv_kplaf_load_contents', 'kplaf_load_contents');

function kplaf_print_nonce() {
    if (!is_admin()) {
        wp_nonce_field('kplaf_load_contents', 'kplaf_load_contents');
    }
}

function kplaf_load_contents() {
    check_ajax_referer('kplaf_load_contents', 'ajax_nonce');

    $widget_id = $_POST['widget_id'];
    $type = $_POST['type'];
    $paged = $_POST['paged'];

    global $wp_registered_widgets;

    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    $instance = $widget_opt[$widget_num];

    $params = array(
        'is_hide_title' => ('true' == $instance['is_hide_title']) ? true : false,
        'is_hide_views' => ('true' == $instance['is_hide_views']) ? true : false,
        'is_hide_created_date' => ('true' == $instance['is_hide_created_date']) ? true : false,
        'is_hide_comments' => ('true' == $instance['is_hide_comments']) ? true : false,
        'is_hide_views' => ('true' == $instance['is_hide_views']) ? true : false,
        'is_hide_excerpt' => ('true' == $instance['is_hide_excerpt']) ? true : false,
        'excerpt_character_limit' => (int) $instance['excerpt_character_limit']
    );
    $obj = new KopaPostsList_AjaxFilter();
    $query = $obj->build_query($instance);

    switch ($type) {
        case 'latest':
            KopaPostsList_AjaxFilter::get_latest($query, $params, $paged);
            break;
        case 'most-comment':
            KopaPostsList_AjaxFilter::get_most_comment($query, $params, $paged);
            break;
        case 'most-view':
            KopaPostsList_AjaxFilter::get_most_view($query, $params, $paged);
            break;
        case 'most-like':
            KopaPostsList_AjaxFilter::get_most_like($query, $params, $paged);
            break;
    }

    exit();
}

class KopaPostsList_AjaxFilter extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_ajax_filter';
        $name = __('Kopa Ajax Filter', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_ajax_filter widget-latest-article', 'description' => __('Display posts with ajax filter: created-date, views, likes, comments', kopa_get_domain()));
        $control_options = array('width' => '600', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        $this->groups['col-1']['fields']['is_hide_created_date']['label'] = __('Disable filter by "Date"', kopa_get_domain());
        $this->groups['col-1']['fields']['is_hide_comments']['label'] = __('Disable filter by "Comments"', kopa_get_domain());
        $this->groups['col-1']['fields']['is_hide_views']['label'] = __('Disable filter by "Views"', kopa_get_domain());
        $this->groups['col-1']['fields']['is_hide_likes']['label'] = __('Disable filter by "Likes"', kopa_get_domain());


        $this->groups['col-1']['size'] = 5;
        $this->groups['col-2']['size'] = 7;

        unset($this->groups['col-1']['fields']['is_hide_readmore']);
        unset($this->groups['col-2']['fields']['orderby']);

        $this->groups['col-1']['fields']['is_hide_loadmore'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_loadmore',
            'name' => 'is_hide_loadmore',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Disable load more', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $query = $this->build_query($instance);

        echo $before_widget;

        $unique_id = wp_generate_password(4, false, false);

        $latest_id = "latest-{$unique_id}";
        $most_comment_id = "most-comment-{$unique_id}";
        $most_view_id = "most-view-{$unique_id}";
        $most_like_id = "most-like-{$unique_id}";

        $params = array(
            'is_hide_title' => ('true' == $instance['is_hide_title']) ? true : false,
            'is_hide_views' => ('true' == $instance['is_hide_views']) ? true : false,
            'is_hide_created_date' => ('true' == $instance['is_hide_created_date']) ? true : false,
            'is_hide_comments' => ('true' == $instance['is_hide_comments']) ? true : false,
            'is_hide_likes' => ('true' == $instance['is_hide_likes']) ? true : false,
            'is_hide_excerpt' => ('true' == $instance['is_hide_excerpt']) ? true : false,
            'excerpt_character_limit' => (int) $instance['excerpt_character_limit']
        );
        ?>        

        <header>
            <?php echo (empty($title)) ? '' : $before_title . $title . $after_title; ?>
            <?php
            if (!$params['is_hide_created_date'] || !$params['is_hide_comments'] || !$params['is_hide_views'] || !$params['is_hide_likes']):
                $is_first = true;
                $class = '';
                ?>
                <ul class="filter-isotope list-unstyled">
                    <?php
                    if (!$params['is_hide_created_date']):
                        if ($is_first) {
                            $class = 'active';
                            $is_first = false;
                        } else {
                            $class = '';
                        }
                        ?>
                        <li class="<?php echo $class; ?>"><a class="kplaf_filter_name" href="#<?php echo $latest_id; ?>"><?php echo KopaIcon::getIconDatetime(); ?></a></li>
                    <?php endif; ?>

                    <?php
                    if (!$params['is_hide_comments']):
                        if ($is_first) {
                            $class = 'active';
                            $is_first = false;
                        } else {
                            $class = '';
                        }
                        ?>
                        <li class="<?php echo $class; ?>"><a class="kplaf_filter_name" href="#<?php echo $most_comment_id; ?>"><?php echo KopaIcon::getIconComment(); ?></a></li>
                    <?php endif; ?>

                    <?php
                    if (!$params['is_hide_views']):
                        if ($is_first) {
                            $class = 'active';
                            $is_first = false;
                        } else {
                            $class = '';
                        }
                        ?>
                        <li class="<?php echo $class; ?>"><a class="kplaf_filter_name" href="#<?php echo $most_view_id; ?>"><?php echo KopaIcon::getIconView(); ?></a></li>
                    <?php endif; ?>

                    <?php
                    if (!$params['is_hide_likes']):
                        if ($is_first) {
                            $class = 'active';
                            $is_first = false;
                        } else {
                            $class = '';
                        }
                        ?>
                        <li class="<?php echo $class; ?>"><a class="kplaf_filter_name" href="#<?php echo $most_like_id; ?>"><?php echo KopaIcon::getIconLike(); ?></a></li>
                    <?php endif; ?>                                    
                </ul>
            <?php endif; ?>                                                
        </header>

        <div class="widget-content">
            <?php
            $sections = array(
                'latest' => array(
                    'id' => $latest_id,
                    'title' => __('Latest', kopa_get_domain())
                ),
                'most-comment' => array(
                    'id' => $most_comment_id,
                    'title' => __('Most comment', kopa_get_domain())
                ),
                'most-view' => array(
                    'id' => $most_view_id,
                    'title' => __('Most view', kopa_get_domain())
                ),
                'most-like' => array(
                    'id' => $most_like_id,
                    'title' => __('Most like', kopa_get_domain())
                )
            );


            if ($params['is_hide_created_date']) {
                unset($sections['latest']);
            }

            if ($params['is_hide_comments']) {
                unset($sections['most-comment']);
            }

            if ($params['is_hide_views']) {
                unset($sections['most-view']);
            }

            if ($params['is_hide_likes']) {
                unset($sections['most-like']);
            }

            if ($sections) {
                $is_first = true;
                foreach ($sections as $key => $section) {
                    if ($is_first) {
                        $section_display = 'block';
                        $is_first = false;
                    } else {
                        $section_display = 'none';
                    }
                    ?>
                    <div id="<?php echo $section['id']; ?>" class="section-content" style="display: <?php echo $section_display; ?>"  data-type="<?php echo $key; ?>" data-paged="1">
                        <div class="kp-isotope">
                            <?php
                            switch ($key) {
                                case 'latest':
                                    self::get_latest($query, $params);
                                    break;
                                case 'most-comment':
                                    self::get_most_comment($query, $params);
                                    break;
                                case 'most-view':
                                    self::get_most_view($query, $params);
                                    break;
                                case 'most-like':
                                    self::get_most_like($query, $params);
                                    break;
                            }
                            ?>
                        </div>                    
                    </div>
                    <?php
                }
            }
            ?>     
            
            <?php if ('true' != $instance['is_hide_loadmore']): ?>
                <p class="kplaf_load_more load-more"><span><?php echo KopaIcon::getIcon('fa fa-spinner', 'i'); ?>&nbsp;<?php _e('load more', kopa_get_domain()); ?></span></p>
            <?php endif; ?>
        </div>

        <?php
        echo $after_widget;
    }

    public static function get_html($query, $params, $paged = 1, $orderby = 'date') {
        global $post;

        $query['paged'] = (int) $paged;

        $posts = new WP_Query($query);
        while ($posts->have_posts()):
            $posts->the_post();
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_url = get_permalink();
            $post_format = get_post_format();
            ?>
            <div class="item">
                <?php
                if (has_post_thumbnail()):
                    $image_croped = KopaImage::get_post_image_src($post_id, 'size_07');
                    ?>
                    <figure>
                        <a href="<?php echo $post_url; ?>" class="pull-left">
                            <img src="<?php echo $image_croped; ?>" alt="">                                            
                            <span><?php echo KopaIcon::getIconPostFormat($post_format); ?></span>
                        </a>                            
                    </figure>
                    <?php
                endif;
                ?>

                <div class="item-content">
                    <?php if (!$params['is_hide_title']): ?>
                        <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
                    <?php endif; ?>                   


                    <?php
                    if (!$params['is_hide_excerpt']) {
                        if ((int) $params['excerpt_character_limit'] > 0) {
                            $excerpt = KopaUtil::substr($post->post_content, (int) $params['excerpt_character_limit']);
                            echo ($excerpt) ? sprintf('<p>%s</p>', $excerpt) : '';
                        } else {
                            the_excerpt();
                        }
                    }
                    ?>

                </div>

                <ul class="kp-meta-post bottom list-inline">
                    <li class="metadata-first"><?php echo KopaIcon::getIconDatetime(); ?><span><?php echo get_the_date(); ?></span></li>

                    <?php
                    switch ($orderby) {
                        case 'views':
                            printf('<li>%s<span>%s</span></li>', KopaIcon::getIconView(), KopaUtil::get_views($post_id, true));
                            break;
                        case 'likes':
                            printf('<li>%s</li>', KopaUtil::kopa_get_like_button($post_id, true));
                            break;
                        default:
                            ?>
                            <li><?php echo KopaIcon::getIconComment(); ?><?php comments_popup_link(__('No Comment', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain()), '', __('0 Comment', kopa_get_domain())); ?></li>
                            <?php
                            break;
                    }
                    ?> 
                </ul>

            </div>
            <?php
        endwhile;

        wp_reset_postdata();
    }

    public static function get_latest($query, $params, $paged = 1) {
        $query['orderby'] = 'date';

        self::get_html($query, $params, $paged, 'date');
    }

    public static function get_most_view($query, $params, $paged = 1) {
        $query['meta_key'] = KOPA_OPT_PREFIX . 'total_view';
        $query['orderby'] = 'meta_value_num';

        self::get_html($query, $params, $paged, 'views');
    }

    public static function get_most_comment($query, $params, $paged = 1) {
        $query['orderby'] = 'comment_count';

        self::get_html($query, $params, $paged, 'comments');
    }

    public static function get_most_like($query, $params, $paged = 1) {
        $query['meta_key'] = KOPA_OPT_PREFIX . 'likes';
        $query['orderby'] = 'meta_value_num';

        self::get_html($query, $params, $paged, 'likes');
    }

}
