<?php

class KopaUIColor extends KopaUIText {

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
        $this->classes[] = 'kopa-ui-color';
        $this->classes[] = 'form-control';
        $this->attributes['data-default-color'] = $this->default;
        return parent::get_control();
    }

}