<?php

class KopaPostsList_MostReviews extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_posts_list-most_reviews';
        $name = __('Kopa Most Reviews', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_posts_list-most_reviews  widget-most-review', 'description' => __('Display posts order by views count', kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);
        
        unset($this->groups['col-1']['fields']['excerpt_character_limit']);
        unset($this->groups['col-1']['fields']['posts_per_page']);
        unset($this->groups['col-1']['fields']['is_hide_title']);
        unset($this->groups['col-1']['fields']['is_hide_excerpt']);
        unset($this->groups['col-1']['fields']['is_hide_created_date']);                
        unset($this->groups['col-1']['fields']['is_hide_comments']);
        unset($this->groups['col-1']['fields']['is_hide_likes']);
        unset($this->groups['col-1']['fields']['is_hide_views']);
        unset($this->groups['col-1']['fields']['is_hide_readmore']);
        unset($this->groups['col-2']['fields']['orderby']);
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }

        $instance['orderby'] = 'popular';
        $instance['posts_per_page'] = 5;
                
        $query = $this->build_query($instance);

        $posts = new WP_Query($query);
        if ($posts->have_posts()):            
            ?>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <?php
                    $loop_index = 0;
                    while ($posts->have_posts()):
                        $posts->the_post();
                        $post_id = get_the_ID();
                        $percent = 100 - ($loop_index * 10);
                        ?>
                        <li>
                            <div class="item clearfix" style="width: <?php echo $percent; ?>%;">
                                <h4 class="post-title" ><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                <span><?php echo KopaUtil::get_views($post_id); ?></span>
                            </div>
                        </li>
                        <?php
                        $loop_index++;
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
