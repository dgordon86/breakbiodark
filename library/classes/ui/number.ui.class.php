<?php

class KopaUINumber extends KopaUI {

    public $prefix, $suffix;

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

        $this->prefix = isset($args['prefix']) ? $args['prefix'] : '';
        $this->suffix = isset($args['suffix']) ? $args['suffix'] : '';
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
        $this->classes[] = 'kopa-ui-number';
        $this->classes[] = 'form-control';

        $this->set_attribute('autocomplete', 'off');
        return sprintf('%s<input type="number" id="%s" name="%s" class="%s" value="%s" %s/>%s', $this->prefix, $this->id, $this->name, implode(' ', $this->classes), $this->value, $this->unserialize_attributes(), $this->suffix);
    }

}