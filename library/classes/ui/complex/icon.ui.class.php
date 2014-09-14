<?php

class KopaUIIcon extends KopaUI {

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
        $this->classes[] = 'kopa-ui-icon';
        $this->classes[] = 'form-control';
        $this->set_attribute('autocomplete', 'off');

        $html = sprintf('<input type="hidden" id="%s" name="%s" class="%s" value="%s" %s/>', $this->id, $this->name, implode(' ', $this->classes), $this->value, $this->unserialize_attributes());

        if ($this->value) {
            $html.= sprintf('<i class="kopa-ui-icon-preview %s"></i>', $this->value);
        }

        $html.= sprintf('<a class="btn btn-sm btn-warning kopa-ui-icon-remove" onclick="KopaUI.remove_icon(event, jQuery(this));" style="display: %s;">%s</a>', $this->value ? 'inline-block' : 'none;', __('Remove', kopa_get_domain()));
        $html.= sprintf('<a href="#" class="btn btn-sm btn-primary kopa-ui-icon-select" onclick="KopaUI.open_iconList(event, jQuery(this));" style="display: %s;">%s</a>', $this->value ? 'none' : 'inline-block;', __('Select', kopa_get_domain()));

        return $html;
    }

}
