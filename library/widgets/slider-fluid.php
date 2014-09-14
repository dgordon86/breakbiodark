<?php

class KopaSliderFluid extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_fluid_slider';
        $name = __('Kopa Slider Fluid', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_fluid_slider widget-big-carousel', 'description' => __("This is a full width slider.", kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        $this->groups['col-1']['fields']['title']['type'] = 'hidden';
        $this->groups['col-1']['fields']['title']['label'] = '';
        
        unset($this->groups['col-1']['fields']['excerpt_character_limit']);
        unset($this->groups['col-1']['fields']['is_hide_title']);
        unset($this->groups['col-1']['fields']['is_hide_excerpt']);
        unset($this->groups['col-1']['fields']['is_hide_created_date']);
        unset($this->groups['col-1']['fields']['is_hide_comments']);
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
            ?>    

            <div class="widget widget-big-carousel">
                <div class="widget-content clearfix">
                    <div class="owl-carousel">

                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            $post_url = get_permalink();
                            if (has_post_thumbnail()):
                                $classes = array('item');
                                $image_croped = KopaImage::get_post_image_src($post_id, 'size_12');
                                ?>

                                <div <?php post_class($classes); ?>>
                                    <a href="<?php echo $post_url;?>">
                                        <img src="<?php echo $image_croped;?>" alt="<?php echo $post_title; ?>">
                                    </a>
                                    <div class="post-content">
                                        <h4 class="post-title"><a href="<?php echo $post_url;?>"><?php echo $post_title; ?></a></h4>
                                        <a href="<?php echo $post_url;?>" class="kopa-readmore"><?php _e('read more', kopa_get_domain()); ?></a>
                                    </div>
                                    <div class="mask"></div>
                                </div>    

                                <?php
                            endif;
                        endwhile;
                        ?>
                    </div>                    
                </div>                
            </div>            

            <?php
        endif;

        wp_reset_postdata();

        echo $after_widget;
    }

}
