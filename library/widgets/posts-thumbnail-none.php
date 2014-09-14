<?php

class KopaPostsList_WithoutIMG extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_without_img';
        $name = __('Kopa Posts Without IMG', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_without_img widget-hot-news', 'description' => __('Display posts without thumbnail', kopa_get_domain()));
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
            ?>
            <div class="widget-content clearfix">
                <?php
                $metadata = array();
                $metadata['date'] = ('true' != $instance['is_hide_created_date']) ? true : false;
                $metadata['comments'] = ('true' != $instance['is_hide_comments']) ? true : false;
                $metadata['views'] = ('true' != $instance['is_hide_views']) ? true : false;
                $metadata['likes'] = ('true' != $instance['is_hide_likes']) ? true : false;

                while ($posts->have_posts()):
                    $posts->the_post();
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_url = get_permalink();
                    ?>
                    <div <?php post_class('item'); ?>>

                        <?php if (has_category()): ?>
                            <h5 class="post-cat">
                                <?php the_category(', '); ?>
                            </h5>
                        <?php endif; ?>

                        <?php if ('true' != $instance['is_hide_title']): ?>                                        
                            <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
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
                ?>                
            </div>
            <?php
        else:
            _e('Posts not found. Pleae config this widget again!', kopa_get_domain());
        endif;
        wp_reset_postdata();

        echo $after_widget;
    }

}
