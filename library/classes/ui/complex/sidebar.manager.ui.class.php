<?php

class KopaUISidebarManager extends KopaUI {

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
        $this->classes[] = 'kopa-ui-sidebar-manager';
        $this->classes[] = 'clearfix';

        $this->set_attribute('autocomplete', 'off');

        $html = sprintf('<div class="%s">', implode(' ', $this->classes));
        $html.= sprintf('<p class="kopa-sidebar-sub-caption">%s</p>', __('Add your sidebars below and then you can assign one of these sidebars from the individual posts, pages or archive, ..', kopa_get_domain()));

        $html.= '<p>';
        $html.= '<input type="text" class="form-control txt_sidebar_name" name="txt_sidebar_name" id="txt_sidebar_name" autocomplete="off">';
        $html.= sprintf('<a href="#" class="btn btn-primary btn-add-sidebar" onclick="KopaSidebar.add(event, jQuery(this), jQuery(\'#txt_sidebar_name\'));"><span>%s</span></a>', __('Add sidebar', kopa_get_domain()));
        $html.= '</p>';

        $html.= '<table class="table table-responsive table-hover table-list-sidebar">';
        $html.= '<thead>';
        $html.= '<tr>';
        $html.= sprintf('<th class="col-xs-10">%s</th>', __('Sidebar name', kopa_get_domain()));
        $html.= sprintf('<th class="col-xs-1">%s</th>', __('Rename', kopa_get_domain()));
        $html.= sprintf('<th class="col-xs-1">%s</th>', __('Remove', kopa_get_domain()));
        $html.= '</tr>';
        $html.= '</thead>';

        $html.= '<tbody>';
        foreach ($this->value as $slug => $title) {
            if ('sidebar_hide' != $slug) {
                $html.= '<tr>';
                $html.= sprintf('<td><span>%s<span></td>', $title);
                $html.= sprintf('<td><a href="#" onclick="KopaSidebar.rename(event, jQuery(this),\'%s\');" class="btn btn-success btn-sm"><i class="dashicons dashicons-edit"></i></a></td>', $slug);
                $html.= sprintf('<td><a href="#" onclick="KopaSidebar.remove(event, jQuery(this),\'%s\',\'%s\');" class="btn btn-danger btn-sm"><i class="dashicons dashicons-no-alt"></i></a></td>', $slug, $title);
                $html.= '</tr>';
            }
        }
        $html.= '</tbody>';
        $html.= '</table>';

        $html.= '</div>';
        return $html;
    }

}