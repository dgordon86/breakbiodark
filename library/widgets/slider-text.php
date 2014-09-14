<?php

class KopaSliderText extends KopaWidget {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_slider_text';
        $name = __('Kopa Slider Text', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_slider_text widget-feature-images', 'description' => __('Display simple slider (4 lines per slide)', kopa_get_domain()));
        $control_options = array('width' => 'auto', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        $col = array(
            'size' => 12,
            'fields' => array()
        );
        $col['fields']['title'] = array(
            'type' => 'hidden',
            'id' => 'title',
            'name' => 'title',
            'default' => '',
            'label' => '',
            'classes' => array(),
            'help' => NULL
        );
        $col['fields']['number_of_slides'] = array(
            'type' => 'number',
            'id' => 'number_of_slides',
            'name' => 'number_of_slides',
            'default' => 2,
            'label' => __('Number of slides', kopa_get_domain()),
            'classes' => array(),
            'help' => NULL
        );
        $this->groups['col'] = $col;
    }

    public function update($new_instance, $old_instance) {
        $this->update_fields($new_instance);
        return parent::update($new_instance, $old_instance);
    }

    public function form($instance) {
        $this->update_fields($instance);
        parent::form($instance);
    }

    public function widget($args, $instance) {
        extract($args);

        echo $before_widget;

        $number_of_slides = isset($instance['number_of_slides']) ? (int) $instance['number_of_slides'] : 2;

        if ($number_of_slides > 0) {
            ?>
            <div class="widget-content">
                <div class="owl-carousel">
                    <?php
                    for ($i = 0; $i < $number_of_slides; $i++) {
                        $slide_id = "slide_{$i}";
                        $line_1 = "{$slide_id}_line_0";
                        $line_2 = "{$slide_id}_line_1";
                        $line_3 = "{$slide_id}_line_2";
                        $line_4 = "{$slide_id}_line_3";
                        $url = "{$slide_id}_line_4";
                        ?>
                        <div class="item">
                            <div class="kp-caption">
                                <?php
                                echo isset($instance[$line_1]) ? sprintf('<h2>%s</h2>', $instance[$line_1]) : '';

                                echo isset($instance[$line_2]) ? sprintf('<h3 class="page-title">%s</h3>', $instance[$line_2]) : '';

                                if (isset($instance[$line_3])) {
                                    if (isset($instance[$url])) {
                                        printf('<h4 class="post-title"><a href="%s">%s</a></h4>', $instance[$url], $instance[$line_3]);
                                    } else {
                                        
                                    }
                                }

                                echo isset($instance[$line_1]) ? sprintf('<p>%s</p>', $instance[$line_4]) : '';
                                ?>                                                                
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>    
            <?php
        }
        echo $after_widget;
    }

    public function update_fields($instance) {
        $number_of_slides = isset($instance['number_of_slides']) ? (int) $instance['number_of_slides'] : 2;
        if ($number_of_slides > 0) {
            for ($i = 0; $i < $number_of_slides; $i++) {
                $slide_id = "slide_{$i}";
                for ($j = 0; $j < 5; $j++) {
                    $label = (0 == $j) ? sprintf(__("Slide no.%s", kopa_get_domain()), $i + 1) : NULL;
                    $placeholder = sprintf(__('Line %s', kopa_get_domain()), $j + 1);
                    if (4 == $j) {
                        $placeholder = __('URL', kopa_get_domain());
                    }

                    $line_id = "{$slide_id}_line_{$j}";
                    $this->groups['col']['fields'][$line_id] = array(
                        'type' => 'text',
                        'id' => $line_id,
                        'name' => $line_id,
                        'default' => '',
                        'label' => $label,
                        'classes' => array(),
                        'help' => NULL,
                        'attributes' => array(
                            'placeholder' => $placeholder
                        )
                    );
                }
            }
        }
    }

}
