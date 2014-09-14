<?php

class KopaPostsList_CarouselThumb extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_carousel_thumb';
        $name = __('Kopa Carousel Thumb', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_carousel_thumb widget-list-video', 'description' => __('Display posts with owl carousel (only thumb)', kopa_get_domain()));
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
                <div class="owl-carousel">
                    <?php
                    while ($posts->have_posts()):
                        $posts->the_post();
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_url = get_permalink();

                        if (has_post_thumbnail()):
                            $image_croped = KopaImage::get_post_image_src($post_id, 'size_03');
                            ?>
                            <div <?php post_class('item'); ?>>
                                <a href="<?php echo $post_url; ?>"><img src="<?php echo $image_croped; ?>" alt="" />
                                    <div class="mask"></div>
                                    <div class="mask-2"></div>
                                </a>                                
                                <div class="kp-caption">
                                    <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
                                </div>
                            </div>                            
                            <?php
                        endif;
                    endwhile;
                    ?>
                </div>
            </div>
            <?php
        else:
            _e('Posts not found. Pleae config this widget again!', kopa_get_domain());
        endif;
        wp_reset_postdata();

        echo $after_widget;
    }

}
