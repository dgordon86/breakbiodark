<?php

class KopaContactInformation extends KopaWidget {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa-contact-information';
        $name = __('Kopa Contact Information', kopa_get_domain());
        $widget_options = array('classname' => 'kopa-contact-information widget_text', 'description' => __('Display your contact information', kopa_get_domain()));
        $control_options = array('width' => 'auto', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        $col_1 = array(
            'size' => 12,
            'fields' => array()
        );

        $col_1['fields']['title'] = array(
            'type' => 'text',
            'id' => 'title',
            'name' => 'title',
            'default' => '',
            'classes' => array(),
            'label' => __('Title', kopa_get_domain()),
            'help' => NULL
        );

        $col_1['fields']['description'] = array(
            'type' => 'textarea',
            'id' => 'description',
            'name' => 'description',
            'default' => '',
            'classes' => array(),
            'label' => __('Description', kopa_get_domain()),
            'help' => NULL
        );

        $this->groups['col-1'] = $col_1;
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }


        echo '<div class="textwidget">';

        echo empty($instance['description']) ? '' : "<p class='first'>{$instance['description']}</p>";

        $address = KopaOptions::get_option('contact_address', false);
        echo !$address ? '' : '<p><span>' . __('Add:', kopa_get_domain()) . '</span>&nbsp;' . $address . '</p>';

        $fax = KopaOptions::get_option('contact_fax', false);
        echo !$fax ? '' : '<p><span>' . __('Fax:', kopa_get_domain()) . '</span>&nbsp;' . $fax . '</p>';

        $mobile = KopaOptions::get_option('contact_phone', false);
        echo !$mobile ? '' : '<p><span>' . __('Mobile:', kopa_get_domain()) . '</span>&nbsp;' . $mobile . '</p>';

        $email = KopaOptions::get_option('contact_email', false);
        echo !$email ? '' : '<p><span>' . __('Email:', kopa_get_domain()) . '</span>&nbsp;' . $email . '</p>';

        echo '</div>';

        echo $after_widget;
    }

}