<?php

class KopaPostsList_SmallThumb extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_small_thumb';
        $name = __('Kopa Posts Small IMG', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_small_thumb widget-latest-news', 'description' => __('Display posts with small thumbnail', kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);
        unset($this->groups['col-1']['fields']['excerpt_character_limit']);
        unset($this->groups['col-1']['fields']['is_hide_excerpt']);
        unset($this->groups['col-1']['fields']['is_hide_comments']);
        unset($this->groups['col-1']['fields']['is_hide_likes']);
        unset($this->groups['col-1']['fields']['is_hide_views']);
        unset($this->groups['col-1']['fields']['is_hide_readmore']);
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        $query = $this->build_query($instance);
        $posts = new WP_Query($query);
        if ($posts->have_posts()):
            global $post;
            ?>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <?php
                    while ($posts->have_posts()):
                        $posts->the_post();
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_url = get_permalink();
                        ?>
                        <li <?php post_class('clearfix'); ?> >
                            <?php
                            if (has_post_thumbnail()):
                                $image_croped = KopaImage::get_post_image_src($post_id, 'size_00');
                                ?>
                                <a href="<?php echo $post_url; ?>" class="pull-left">
                                    <img src="<?php echo $image_croped; ?>" alt="">                                            
                                </a>               
                                    <?php
                                endif;
                                ?>
                            <div class="item-right">
                                <?php if ('true' != $instance['is_hide_title']): ?>                                        
                                    <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
                                <?php endif; ?>
                <?php if ('true' != $instance['is_hide_created_date']): ?>
                                    <span class="kp-meta-post"><?php echo get_the_date(); ?></span>
                        <?php endif; ?>
                            </div>
                        </li>
                <?php
            endwhile;
            ?>
                </ul>
            </div>
            <?php
        else:
            _e('Posts not found. Pleae config this widget again!', kopa_get_domain());
        endif;
        wp_reset_postdata();
        echo $after_widget;
    }

}
