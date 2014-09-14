<?php

class KopaSliderSteel extends KopaWidgetPosts {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_owl_slider';
        $name = __('Kopa Slider Steel', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_owl_slider', 'description' => __("This is slider with owl carousel", kopa_get_domain()));
        $control_options = array('width' => '500', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        unset($this->groups['col-1']['fields']['posts_per_page']);
        unset($this->groups['col-1']['fields']['excerpt_character_limit']);
        unset($this->groups['col-1']['fields']['is_hide_title']);
        unset($this->groups['col-1']['fields']['is_hide_excerpt']);

        $this->groups['col-1']['fields']['title']['type'] = 'hidden';
        $this->groups['col-1']['fields']['title']['label'] = '';

        $this->groups['col-2']['fields']['transition_type'] = array(
            'type' => 'select',
            'id' => 'transition_type',
            'name' => 'transition_type',
            'default' => 'backSlide',
            'classes' => array(),
            'label' => __('Transition type', kopa_get_domain()),
            'help' => NULL,
            'options' => array(
                'fade' => __('fade', kopa_get_domain()),
                'fadeUp' => __('fadeUp', kopa_get_domain()),
                'backSlide' => __('backSlide', kopa_get_domain()),
                'goDown' => __('goDown', kopa_get_domain())
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }

        $instance['posts_per_page'] = 4;
        $query = $this->build_query($instance);

        $posts = new WP_Query($query);

        if ($posts->have_posts()):
            ?>    
            <div class="widget-content container clearfix">
                <div class="owl-slider-col-left pull-left">
                    <?php
                    $is_first = true;
                    $loop_index = 0;
                    while ($posts->have_posts()):
                        $posts->the_post();
                        if (has_post_thumbnail()):
                            $classes = array('owl-slider-navigation-post-title');
                            if ($is_first) {
                                $classes[] = 'active';
                                $classes[] = 'first';
                                $is_first = false;
                            }
                            ?>
                            <p class="<?php echo implode(' ', $classes); ?>" data-index="<?php echo $loop_index; ?>">
                                <?php echo get_the_title(); ?>
                            </p>
                            <?php
                            $loop_index++;
                        endif;
                    endwhile;
                    ?>                
                </div>

                <div class="owl-slider-col-center pull-left">
                    <div class="owl-carousel" data-transition="<?php echo $instance['transition_type']; ?>">
                        <?php
                        $is_first = true;
                        global $post;
                        while ($posts->have_posts()):
                            $posts->the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            $post_url = get_permalink();
                            $post_format = get_post_format();

                            if (has_post_thumbnail()):
                                $classes = array('owl-slider-single-slide');
                                if ($is_first) {
                                    $classes[] = 'active';
                                    $classes[] = 'first';
                                    $classes[] = 'synced';
                                    $is_first = false;
                                }
                                $image_croped = KopaImage::get_post_image_src($post_id, 'size_11');
                                ?>
                                <div class="<?php echo implode(' ', $classes); ?>">
                                    <?php
                                    if ('video' == $post_format) {
                                        $video = KopaUtil::get_video($post->post_content, array('youtube', 'vimeo'));
                                        if ($video) {
                                            $url = '';
                                            if ('youtube' == $video['type']) {
                                                $url = 'http://www.youtube.com/watch?v=' . $video['id'];
                                            } else if ('vimeo' == $video['type']) {
                                                $url = 'https://vimeo.com/' . $video['id'];
                                            }

                                            printf('<a class="kss-icon kss-icon-play" href="%s"><span class="fa fa-play"></span></a>', $url);
                                        }
                                    }
                                    ?>         

                                    <img src="<?php echo $image_croped; ?>" alt="<?php echo $post_title; ?>">
                                    <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>                                                                       
                                </div>
                                <?php
                            endif;
                        endwhile;
                        ?>
                    </div>
                </div>

                <div class="owl-slider-col-right pull-left">
                    <div class="owl-carousel">
                        <?php
                        $is_first = true;
                        while ($posts->have_posts()):
                            $posts->the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            $post_url = get_permalink();
                            $post_format = get_post_format();

                            if (has_post_thumbnail()):
                                $classes = array('owl-slider-single-slide-detail');
                                if ($is_first) {
                                    $classes[] = 'first';
                                    $classes[] = 'synced';
                                    $is_first = false;
                                }
                                ?>
                                <div class="<?php echo implode(' ', $classes); ?>">

                                    <span class="kopa-icon-post-format"><?php echo KopaIcon::getIconPostFormat($post_format, 'span'); ?></span>

                                    <?php if ('true' != $instance['is_hide_created_date']): ?>
                                        <span class="kopa-date"><?php echo get_the_date('M, j'); ?><br/><?php echo get_the_date('Y'); ?></span>                                                    
                                    <?php endif; ?>


                                    <?php
                                    if ('true' != $instance['is_hide_views'] || 'true' != $instance['is_hide_comments'] || 'true' != $instance['is_hide_views']):
                                        ?>
                                        <ul class="kopa-metadata">                                               
                                            <?php if ('true' != $instance['is_hide_comments']): ?>
                                                <li class="metadata-first"><i class="fa fa-comment"></i><span><?php echo KopaUtil::get_comments($post_id, true); ?></span></li>                                            
                                            <?php endif; ?>

                                            <?php if ('true' != $instance['is_hide_views']): ?>
                                                <li><?php echo KopaIcon::getIconView(); ?><span><?php echo KopaUtil::get_views($post_id, false); ?></span></li>
                                            <?php endif; ?>

                                            <?php if ('true' != $instance['is_hide_likes']): ?>
                                                <li class="metadata-last"><?php echo KopaIcon::getIconLike(); ?><span><?php echo KopaUtil::get_likes($post_id, false); ?></span></li>
                                                    <?php endif; ?>
                                        </ul>      
                                    <?php endif; ?>

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
