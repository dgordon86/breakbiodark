<?php

class KopaUICheckbox extends KopaUI {

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
        $this->classes[] = sprintf('kopa-ui-%1$s', $this->type);
        if ('true' == $this->value) {
            $this->set_attribute('checked', 'checked');
        }
        $this->set_attribute('autocomplete', 'off');        
        return sprintf('<input type="checkbox" id="%1$s" name="%2$s" class="%3$s" value="%4$s" %5$s/>', $this->id, $this->name, implode(' ', $this->classes), 'true', $this->unserialize_attributes());
    }

}