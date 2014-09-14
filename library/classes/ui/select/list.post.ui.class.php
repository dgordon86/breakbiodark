<?php

class KopaUIListPost extends KopaUISelect {

    public $post_type;
    public $posts_per_page;
    public $args_extra;

    /**
     * 
     * 
     * @package Kopa
     * @subpackage Core
     * @author thethangtran <tranthethang@gmail.com>
     * @since 1.0.0
     *      
     */
    public function __construct($args = array()) {
        parent::__construct($args);
        $this->post_type = isset($args['post_type']) ? $args['post_type'] : array('post');
        $this->posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : -1;
        $this->args_extra = isset($args['args_extra']) ? $args['args_extra'] : array();

        $this->options = array();
        $this->options[0] = __('-- Select --', kopa_get_domain());

        $args = array(
            'post_type' => $this->post_type,
            'posts_per_page' => $this->posts_per_page,
            'post_status' => array('publish'),
            'ignore_sticky_posts' => true
        );

        if (!empty($this->args_extra)) {
            $args = array_merge($args, $this->args_extra);
        }

        $posts = new WP_Query($args);
        if ($posts->have_posts()) {
            while ($posts->have_posts()) {
                $posts->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();

                $this->options[$post_id] = $post_title;
            }
        }

        wp_reset_postdata();
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
    protected function get_control() {
        $this->classes[] = 'kopa-ui-list-post';
        return parent::get_control();
    }

}
