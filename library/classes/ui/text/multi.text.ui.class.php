<?php

class KopaUIMultiText extends KopaUI {

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
        $this->classes[] = 'kopa-ui-multi-text';
        $out = sprintf('<ul id="%1$s" class="%2$s">', $this->id, implode(' ', $this->classes));

        if ($this->value && is_array($this->value)) {
            foreach ($this->value as $item) {
                $out .= $this->_clone($item['id'], $item['value']);
            }
        } else {
            $out .= $this->_clone();
        }

        $out .= '</ul>';

        return $out;
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
    private function _clone($id = '', $value = '') {
        $id = empty($id) ? 'multi-text-index-' . wp_generate_password(10, false, false) : $id;

        $out = '<li class="multi-text-element clearfix">';
        $out .= sprintf('<i class="btn btn-xs btn-primary multi-text-drag kopa-sortable-handle">%s</i>', __('drag', kopa_get_domain()));
        $out .= sprintf('<span class="btn btn-primary multi-text-add btn-xs" onclick="KopaUI.add_multitext(event, jQuery(this));">%1$s</span>', __('add', kopa_get_domain()));
        $out .= sprintf('<span class="btn btn-danger multi-text-del btn-xs" onclick="KopaUI.del_multitext(event, jQuery(this));">%1$s</span>', __('del', kopa_get_domain()));

        $out .= '<div class="clearfix"></div>';

        $out .= sprintf('<input type="hidden" class="id" name="%1$s[id][]" value="%2$s" autocomplete="off"/>', $this->name, $id);
        $out .= sprintf('<input type="text" class="form-control multi-text-value" name="%1$s[value][]" value="%2$s" autocomplete="off"/>', $this->name, $value);
        $out .= '</li>';

        return $out;
    }

}
