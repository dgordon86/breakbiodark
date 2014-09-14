<?php

class KopaUIRadioList extends KopaUI {

    public $options;
    public $option_args;

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
        $this->options = isset($args['options']) ? $args['options'] : array();
        $this->option_args = isset($args['option_args']) ? $args['option_args'] : array();
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
        $out = '';
        
        $this->option_args['classes'][] = 'kopa-ui-radio-list';
        $this->option_args['classes'] = array_merge($this->classes, $this->option_args['classes']);

        $this->set_attribute('autocomplete', 'off');
        $this->option_args['type'] = 'radio';
        $this->option_args['is_append_label_before_control'] = FALSE;
        $this->option_args['name'] = $this->name;

        if ($this->options) {
            foreach ($this->options as $option) {
                $option['id'] = "{$this->name}-{$option['value']}";

                $option['classes'] = $this->option_args['classes'];
                
                if (isset($option['attributes']) && isset($this->attributes)) {
                    $option['attributes'] = array_merge($this->attributes, $option['attributes']);
                } else {
                    $option['attributes'] = $this->attributes;
                }

                if ($option['value'] == $this->value) {
                    $option['attributes']['checked'] = 'checked';
                    $option['classes'][] = 'radio-item-selected';
                }

                $control = new KopaControl();
                $out .= $control->get_html(array_merge($this->option_args, $option));
            }
        }


        return $out;
    }

}