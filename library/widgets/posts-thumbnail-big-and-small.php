<?php

class KopaPostsList_BigIMG extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list_big_img';
        $name = __('Kopa Posts Big IMG', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list_big_img widget-list-post', 'description' => __('Display posts with layout: big thumb for first, small for next', kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        unset($this->groups['col-1']['fields']['is_hide_views']);
        unset($this->groups['col-1']['fields']['is_hide_likes']);        
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
            $metadata = array();
            $metadata['date'] = ('true' != $instance['is_hide_created_date']) ? true : false;
            $metadata['comments'] = ('true' != $instance['is_hide_comments']) ? true : false;

            global $post;
            ?>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <?php
                    $is_first = true;
                    while ($posts->have_posts()):
                        $posts->the_post();
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_url = get_permalink();

                        if ($is_first):
                            $is_first = false;
                            ?>
                            <li <?php post_class('style-1'); ?>>
                                <div class="item clearfix">
                                    <?php
                                    if (has_post_thumbnail()):
                                        $image_croped = KopaImage::get_post_image_src($post_id, 'size_02');
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

                                        <?php
                                        if ($metadata['date'] || $metadata['comments']):
                                            ?>

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
                                        <?php if ('true' != $instance['is_hide_readmore']): ?>                                            
                                            <a class="read-more" href="<?php echo $post_url; ?>"><?php _e('Read more', kopa_get_domain()); ?></a>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </li>
                            <?php
                        else:
                            ?>
                            <li>
                                <div class="item clearfix">
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

                                        <?php
                                        if ($metadata['date'] || $metadata['comments']):
                                            ?>

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
                                                                break;                                                                                                                            break;
                                                        }
                                                    }
                                                }
                                                ?>                                   
                                            </ul> 

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </li>
                        <?php
                        endif;
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
