<?php

class KopaUISelect extends KopaUI {

    public $options;

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
        $this->classes[] = 'kopa-ui-select';
        $this->classes[] = 'form-control';
                
        $this->set_attribute('autocomplete', 'off');
        if (isset($this->attributes['multiple'])) {
            $this->name = "{$this->name}[]";

            if (!isset($this->attributes['size'])) {
                $this->set_attribute('size', 5);
            }
        }

        $out = sprintf('<select id="%s" name="%s" class="%s" %s>', $this->id, $this->name, implode(' ', $this->classes), $this->unserialize_attributes());

        $is_selected = false;

        if ($this->options) {
            foreach ($this->options as $_value => $_label) {
                if (isset($this->attributes['multiple']) && is_array($this->value)) {
                    $_selected = in_array($_value, $this->value) ? 'selected="selected"' : '';
                } else {

                    if ($_value == $this->value) {
                        if (!$is_selected) {                            
                            $_selected = 'selected="selected"';
                            $is_selected = true;
                        }else{
                            $_selected = '';
                        }
                    } else {
                        $_selected = '';
                    }
                }

                $out .= sprintf('<option value="%1$s" %3$s>%2$s</option>', $_value, $_label, $_selected);
            }
        }
        $out .= '</select>';
        return $out;
    }

}