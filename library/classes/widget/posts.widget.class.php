<?php

class KopaWidgetPosts extends KopaWidget {

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public function __construct($id_base, $name, $widget_options = array(), $control_options = array()) {
        parent::__construct($id_base, $name, $widget_options, $control_options);


        $g_style = array(
            'size' => 4,
            'fields' => array()
        );

        $g_style['fields']['title'] = array(
            'type' => 'text',
            'id' => 'title',
            'name' => 'title',
            'default' => '',
            'classes' => array(),
            'label' => __('Title', kopa_get_domain()),
            'help' => NULL
        );

        $g_style['fields']['posts_per_page'] = array(
            'type' => 'number',
            'id' => 'posts_per_page',
            'name' => 'posts_per_page',
            'default' => 4,
            'classes' => array(),
            'label' => __('Number of posts', kopa_get_domain()),
            'help' => NULL
        );

        $g_style['fields']['excerpt_character_limit'] = array(
            'type' => 'number',
            'id' => 'excerpt_character_limit',
            'name' => 'excerpt_character_limit',
            'default' => 100,
            'classes' => array(),
            'label' => __('Excerpt character limit', kopa_get_domain()),
            'help' => NULL
        );

        $g_style['fields']['is_hide_title'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_title',
            'name' => 'is_hide_title',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide title', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_style['fields']['is_hide_excerpt'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_excerpt',
            'name' => 'is_hide_excerpt',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide excerpt', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_style['fields']['is_hide_created_date'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_created_date',
            'name' => 'is_hide_created_date',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide created date', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_style['fields']['is_hide_comments'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_comments',
            'name' => 'is_hide_comments',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide comments', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_style['fields']['is_hide_views'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_views',
            'name' => 'is_hide_views',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide views', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_style['fields']['is_hide_likes'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_likes',
            'name' => 'is_hide_likes',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide likes', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_style['fields']['is_hide_readmore'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_readmore',
            'name' => 'is_hide_readmore',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide readmore', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_query = array(
            'size' => 8,
            'fields' => array()
        );


        $g_query['fields']['category'] = array(
            'type' => 'taxonomy',
            'id' => 'category',
            'name' => 'category',
            'default' => '',
            'classes' => array(),
            'label' => __('Categories', kopa_get_domain()),
            'help' => NULL,
            'taxonomy' => 'category',
            'attributes' => array(
                'multiple' => 'multiple'
            )
        );

        $g_query['fields']['post_tag'] = array(
            'type' => 'taxonomy',
            'id' => 'post_tag',
            'name' => 'post_tag',
            'default' => '',
            'classes' => array(),
            'label' => __('Tags', kopa_get_domain()),
            'help' => NULL,
            'taxonomy' => 'post_tag',
            'attributes' => array(
                'multiple' => 'multiple'
            )
        );

        $g_query['fields']['post_tag'] = array(
            'type' => 'taxonomy',
            'id' => 'post_tag',
            'name' => 'post_tag',
            'default' => '',
            'classes' => array(),
            'label' => __('Tags', kopa_get_domain()),
            'help' => NULL,
            'taxonomy' => 'post_tag',
            'attributes' => array(
                'multiple' => 'multiple'
            )
        );

        $g_query['fields']['post_format'] = array(
            'type' => 'taxonomy',
            'id' => 'post_format',
            'name' => 'post_format',
            'default' => '',
            'classes' => array(),
            'label' => __('Post Format', kopa_get_domain()),
            'help' => NULL,
            'taxonomy' => 'post_format',
            'attributes' => array(
                'multiple' => 'multiple'
            )
        );

        $g_query['fields']['orderby'] = array(
            'type' => 'select',
            'id' => 'orderby',
            'name' => 'orderby',
            'default' => 'date',
            'classes' => array(),
            'label' => __('Order by', kopa_get_domain()),
            'help' => NULL,
            'options' => array(
                'date' => __('Latest news', kopa_get_domain()),
                'popular' => __('Popular by view count', kopa_get_domain()),
                'comment_count' => __('Most comments', kopa_get_domain()),
                'rand' => __('Random', kopa_get_domain())
            )
        );

        $g_query['fields']['relation'] = array(
            'type' => 'checkbox',
            'id' => 'relation',
            'name' => 'relation',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is combine condition by <i>Tags</i>, <i>Categories</i>, <i>Format</i>', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $g_query['fields']['timestamp'] = array(
            'type' => 'select',
            'id' => 'timestamp',
            'name' => 'timestamp',
            'default' => '',
            'classes' => array(),
            'label' => __('Timestamp (ago)', kopa_get_domain()),
            'help' => NULL,
            'options' => array(
                '' => __('-- Select --', kopa_get_domain()),
                '-1 week' => __('1 week', kopa_get_domain()),
                '-2 week' => __('2 weeks', kopa_get_domain()),
                '-3 week' => __('3 weeks', kopa_get_domain()),
                '-1 month' => __('1 months', kopa_get_domain()),
                '-2 month' => __('2 months', kopa_get_domain()),
                '-3 month' => __('3 months', kopa_get_domain()),
                '-4 month' => __('4 months', kopa_get_domain()),
                '-5 month' => __('5 months', kopa_get_domain()),
                '-6 month' => __('6 months', kopa_get_domain()),
                '-7 month' => __('7 months', kopa_get_domain()),
                '-8 month' => __('8 months', kopa_get_domain()),
                '-9 month' => __('9 months', kopa_get_domain()),
                '-10 month' => __('10 months', kopa_get_domain()),
                '-11 month' => __('11 months', kopa_get_domain()),
                '-1 year' => __('1 year', kopa_get_domain()),
                '-2 year' => __('2 years', kopa_get_domain()),
                '-3 year' => __('3 years', kopa_get_domain()),
                '-4 year' => __('4 years', kopa_get_domain()),
                '-5 year' => __('5 years', kopa_get_domain()),
                '-6 year' => __('6 years', kopa_get_domain()),
                '-7 year' => __('7 years', kopa_get_domain()),
                '-8 year' => __('8 years', kopa_get_domain()),
                '-9 year' => __('9 years', kopa_get_domain()),
                '-10 year' => __('10 years', kopa_get_domain()),
            )
        );

        $this->groups['col-1'] = $g_style;
        $this->groups['col-2'] = $g_query;
    }

    /**
     * 
     *
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public function build_query($instance, $args_extra = array()) {
        $args = array(
            'post_type' => array('post'),
            'posts_per_page' => (int) $instance['posts_per_page'],
            'post_status' => array('publish'),
            'ignore_sticky_posts' => true
        );

        if (!empty($instance['category'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $instance['category']
            );
        }

        if (!empty($instance['post_tag'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field' => 'id',
                'terms' => $instance['post_tag']
            );
        }

        if (!empty($instance['post_format'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'post_format',
                'field' => 'id',
                'terms' => $instance['post_format']
            );
        }

        if (isset($args['tax_query']) && (count($args['tax_query']) >= 2)) {
            $args['tax_query']['relation'] = ('true' == $instance['relation']) ? 'AND' : 'OR';
        }

        if (isset($instance['orderby'])) {
            switch ($instance['orderby']) {
                case 'popular':
                    $args['meta_key'] = KOPA_OPT_PREFIX . 'total_view';
                    $args['orderby'] = 'meta_value_num';
                    break;
                case 'comment_count':
                    $args['orderby'] = 'comment_count';
                    break;
                case 'rand':
                    $args['orderby'] = 'rand';
                    break;
                default:
                    $args['orderby'] = 'date';
                    break;
            }
        }else{
            $args['orderby'] = 'date';                    
        }


        global $wp_version;

        if (version_compare($wp_version, '3.7', '>=')) {
            if (isset($instance['timestamp']) && !empty($instance['timestamp'])) {
                $timestamp = $instance['timestamp'];
                $y = date('Y', strtotime($timestamp));
                $m = date('m', strtotime($timestamp));
                $d = date('d', strtotime($timestamp));

                $args['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }

        if (!empty($args_extra)) {
            return array_merge($args, $args_extra);
        } else {
            return $args;
        }
    }

}
