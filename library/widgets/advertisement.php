<?php

class KopaAdvertisement extends KopaWidget {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_advertisement';
        $name = __('Kopa Advertisement', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_advertisement widget-adv', 'description' => __('Display banner image', kopa_get_domain()));
        $control_options = array('width' => 'auto', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);


        $col = array(
            'size' => 12,
            'fields' => array()
        );

        $col['fields']['title'] = array(
            'type' => 'text',
            'id' => 'title',
            'name' => 'title',
            'default' => '',
            'classes' => array(),
            'label' => __('Title', kopa_get_domain()),
            'help' => NULL
        );

        $col['fields']['image'] = array(
            'type' => 'media',
            'id' => 'image',
            'name' => 'image',
            'default' => '',
            'classes' => array(),
            'label' => __('Upload Image', kopa_get_domain()),
            'help' => NULL
        );

        $col['fields']['size'] = array(
            'type' => 'select',
            'id' => 'size',
            'name' => 'size',
            'default' => '000x000',
            'classes' => array(),
            'label' => NULl,
            'help' => NULL,
            'options' => array(
                '000x000' => __('Select size of image', kopa_get_domain()),
                '120x240' => __('120 x 240', kopa_get_domain()),
                '120x600' => __('120 x 600', kopa_get_domain()),
                '125x125' => __('125 x 125', kopa_get_domain()),
                '160x600' => __('160 x 600', kopa_get_domain()),
                '180x150' => __('180 x 150', kopa_get_domain()),
                '200x200' => __('200 x 200', kopa_get_domain()),
                '234x60' => __('234 x 60', kopa_get_domain()),
                '250x250' => __('250 x 250', kopa_get_domain()),
                '300x250' => __('300 x 250', kopa_get_domain()),
                '336x280' => __('336 x 280', kopa_get_domain()),
                '468x60' => __('468 x 60', kopa_get_domain()),
                '728x90' => __('728 x 90', kopa_get_domain()),
            )
        );

        $col['fields']['href'] = array(
            'type' => 'url',
            'id' => 'href',
            'name' => 'href',
            'default' => '',
            'classes' => array(),
            'label' => __('Link to', kopa_get_domain()),
            'help' => NULL
        );

        $col['fields']['target'] = array(
            'type' => 'checkbox',
            'id' => 'target',
            'name' => 'target',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Open link in new tab', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );
              
        $this->groups['col'] = $col;
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $image = $instance['image'];
        $href = $instance['href'];
        $size = $instance['size'];
        $target = ('true' == $instance['target']) ? '_blank' : '';

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }

        if ($image) {
            printf('<div class="kopa-adv-block"><a href="%s" target="%s"><img class="kopa-adv-%s kopa-adv-block img-responsive" src="%s"></a></div>', $href, $target, $size, do_shortcode($image));
        }

        echo $after_widget;
    }

}