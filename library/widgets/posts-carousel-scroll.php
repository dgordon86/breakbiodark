<?php

class KopaPostsList_CarouselScroll extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_carousel_scroll';
        $name = __('Kopa Carousel Scroll', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_carousel_scroll widget-random', 'description' => __('Display posts with owl carousel (scroll bottom)', kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        unset($this->groups['col-1']['fields']['is_hide_comments']);
        unset($this->groups['col-1']['fields']['is_hide_likes']);
        unset($this->groups['col-1']['fields']['is_hide_views']);
        unset($this->groups['col-1']['fields']['is_hide_readmore']);

        $this->groups['col-1']['fields']['posts_per_page']['default'] = 6;
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
                <div class="container">
                    <ul class="list-unstyled">
                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            $post_url = get_permalink();

                            if (has_post_thumbnail()):
                                ?>   
                                <li>                                    
                                    <div <?php post_class('item'); ?>>
                                        <?php
                                        $image_croped = KopaImage::get_post_image_src($post_id, 'size_01');
                                        ?>
                                        <a href="<?php echo $post_url; ?>">
                                            <img src="<?php echo $image_croped; ?>" alt="">
                                            <div class="mask"></div>
                                            <div class="mask-2"></div>
                                        </a>               

                                        <div class="kp-caption">
                                            <?php if ('true' != $instance['is_hide_title']): ?>                                        
                                                <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
                                            <?php endif; ?>

                                            <?php if ('true' != $instance['is_hide_created_date']): ?>
                                                <span class="kp-meta-post date updated"><?php echo get_the_date(); ?></span>
                                            <?php endif; ?>

                                            <?php
                                            if ('true' != $instance['is_hide_excerpt']) {
                                                if ((int) $instance['excerpt_character_limit'] > 0) {
                                                    $excerpt = KopaUtil::substr($post->post_content, (int) $instance['excerpt_character_limit']);
                                                    echo ($excerpt) ? sprintf('<p>%s</p>', $excerpt) : '';
                                                } else {
                                                    the_excerpt();
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>  
                                </li>
                                <?php
                            endif;
                        endwhile;
                        ?>
                    </ul>
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
