<?php

class KopaPostsList_CarouselTwoCols extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_carousel_two_cols';
        $name = __('Kopa Carousel Two Cols', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_carousel_two_cols widget-feature-news-slider', 'description' => __('Display posts with owl carousel (two cols)', kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

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

            $max = (int) $instance['posts_per_page'];
            $limit_carousel = ($max >= 3) ? $posts->post_count - 2 : -1;
            $loop_index = 0;

            $metadata = array();
            $metadata['date'] = ('true' != $instance['is_hide_created_date']) ? true : false;
            $metadata['comments'] = ('true' != $instance['is_hide_comments']) ? true : false;
            $metadata['views'] = ('true' != $instance['is_hide_views']) ? true : false;
            $metadata['likes'] = ('true' != $instance['is_hide_likes']) ? true : false;
            ?>
            <div class="widget-content clearfix">
                <div class="owl-carousel pull-left">
                    <?php
                    while ($posts->have_posts()):
                        $posts->the_post();
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_url = get_permalink();

                        if ((-1 != $limit_carousel) && ($limit_carousel == $loop_index)) {
                            break;
                        } else {
                            $loop_index++;
                        }
                        ?>     
                        <div <?php post_class('item'); ?>>
                            <?php
                            if (has_post_thumbnail()):
                                $image_croped = KopaImage::get_post_image_src($post_id, 'size_04');
                                ?>
                                <a href="<?php echo $post_url; ?>"><img src="<?php echo $image_croped; ?>" alt="<?php echo $post_title; ?>"/></a>
                                <?php
                            endif;
                            ?>

                            <?php if (('true' != $instance['is_hide_title']) || ('true' != $instance['is_hide_excerpt'])): ?>
                                <div class="kp-caption">
                                    <?php if ('true' != $instance['is_hide_title']): ?>
                                        <?php $h4_class = ('true' != $instance['is_hide_excerpt']) ? '' : 'hide_excerpt'; ?>
                                        <h4 class="post-title <?php echo $h4_class;?>"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
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
                            <?php endif; ?>

                            <?php
                            if ($metadata['date'] || $metadata['comments'] || $metadata['views'] || $metadata['likes']):
                                ?>
                                <footer>
                                    <ul class="kp-meta-post list-inline">    
                                        <?php
                                        $is_metadata_first = true;
                                        foreach ($metadata as $key => $val) {
                                            if ($val) {
                                                $class = $is_metadata_first ? 'metadata-first' : '';
                                                $is_metadata_first = false;
                                                switch ($key) {
                                                    case 'date':
                                                        printf('<li class="%s">%s<span>%s</span></li>', $class, KopaIcon::getIconDatetime(), get_the_date());
                                                        break;
                                                    case 'comments':
                                                        ?>
                                                        <li class="<?php echo $class; ?>"><?php echo KopaIcon::getIconComment(); ?><span><?php comments_popup_link(__('No Comment', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain()), '', __('0 Comment', kopa_get_domain())); ?></span></li>                                            
                                                        <?php
                                                        break;
                                                    case 'views':
                                                        printf('<li class="%s">%s<span>%s</span></li>', $class, KopaIcon::getIconView(), KopaUtil::get_views($post_id, true));
                                                        break;
                                                    case 'likes':
                                                        printf('<li class="%s">%s</li>', $class, KopaUtil::kopa_get_like_button($post_id, true));
                                                        break;
                                                }
                                            }
                                        }
                                        ?>                                   
                                    </ul> 
                                </footer>
                            <?php endif; ?>

                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <?php if (-1 != $limit_carousel): ?>
                    <ul class="list-content pull-left list-unstyled">
                        <?php
                        $sub_posts = new WP_Query($query);
                        $sub_loop_index = 0;

                        while ($sub_posts->have_posts()):
                            $sub_posts->the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            $post_url = get_permalink();

                            if ($sub_loop_index >= $limit_carousel):
                                ?>     
                                <li>
                                    <?php
                                    if (has_post_thumbnail()):
                                        $image_croped = KopaImage::get_post_image_src($post_id, 'size_02');
                                        ?>
                                        <a href="<?php echo $post_url; ?>"><img src="<?php echo $image_croped; ?>" alt="<?php echo $post_title; ?>"/></a>
                                        <?php
                                    endif;
                                    ?>

                                    <?php if ('true' != $instance['is_hide_title']): ?>
                                        <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
                                    <?php endif; ?>

                                    <?php
                                    if ($metadata['date'] || $metadata['comments'] || $metadata['views'] || $metadata['likes']):
                                        ?>
                                        <footer>
                                            <ul class="kp-meta-post list-inline">    
                                                <?php
                                                $is_metadata_first = true;
                                                foreach ($metadata as $key => $val) {
                                                    if ($val) {
                                                        $class = $is_metadata_first ? 'metadata-first' : '';
                                                        $is_metadata_first = false;
                                                        switch ($key) {
                                                            case 'date':
                                                                printf('<li class="%s">%s<span>%s</span></li>', $class, KopaIcon::getIconDatetime(), get_the_date());
                                                                break;
                                                            case 'comments':
                                                                ?>
                                                                <li class="<?php echo $class; ?>"><?php echo KopaIcon::getIconComment(); ?><span><?php comments_popup_link(__('No Comment', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain()), '', __('0 Comment', kopa_get_domain())); ?></span></li>                                            
                                                                <?php
                                                                break;                                                            
                                                        }
                                                    }
                                                }
                                                ?>                                   
                                            </ul> 
                                        </footer>
                                    <?php endif; ?>

                                </li>
                                <?php
                            endif;
                            $sub_loop_index++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </ul>
                <?php endif; ?>
            </div>                      
            <?php
        else:
            _e('Posts not found. Pleae config this widget again!', kopa_get_domain());
        endif;

        echo $after_widget;
    }

}
