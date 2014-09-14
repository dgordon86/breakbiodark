<?php

class KopaUISelectNumber extends KopaUISelect {

    public $min, $max, $step, $prefix, $suffix;

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

        $this->min = isset($args['min']) ? (int) $args['min'] : 0;
        $this->max = isset($args['max']) ? (int) $args['max'] : 12;
        $this->step = isset($args['step']) ? (int) $args['step'] : 1;
        $this->suffix = isset($args['suffix']) ? $args['suffix'] : '';
        $this->prefix = isset($args['prefix']) ? $args['prefix'] : '';

        if ($this->min < $this->max) {
            for ($i = $this->min; $i <= $this->max; $i = $i + $this->step) {
                $this->options[$i] = $this->prefix . $i . $this->suffix;
            }
        }
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
        $this->classes[] = 'kopa-ui-select-number';
        return parent::get_control();
    }

}