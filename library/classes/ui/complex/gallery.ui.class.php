<?php

class KopaUIGallery extends KopaUI {

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
        $this->classes[] = 'kopa-ui-gallery';
        $this->set_attribute('autocomplete', 'off');
        $this->set_attribute('readonly', 'readonly');

        $html = '<div class="kopa-ui-gallery-wrap">';
        $html.= '<div class="row row_space15 clearfix">';
        $html.= '<div class="col-xs-6 col-sm-10 col-md-10">';
        $html.= sprintf('<input type="text" id="%s" name="%s" class="%s" value="%s" %s/>', $this->id, $this->name, implode(' ', $this->classes), $this->value, $this->unserialize_attributes());
        $html.= '</div>';
        $html.= '<div class="col-xs-6 col-sm-2 col-md-2">';
        $html.= sprintf('<span class="btn btn-primary btn-ssm width_full" onclick="KopaUI.config_gallery(event, jQuery(this));">%s</span>', __('Config gallery', kopa_get_domain()));
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }

}
