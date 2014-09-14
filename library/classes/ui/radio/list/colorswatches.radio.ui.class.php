<?php

class KopaUIRadioColorSwatches extends KopaUIRadioList {

    public $colors;

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
        $this->options = array();

        $this->colors = isset($args['colors']) ? $args['colors'] : array();
        foreach ($this->colors as $color) {
            $tmp = array();
            $tmp['attributes']['data-primary'] = $color['primary'];
            $tmp['attributes']['data-primary'] = $color['secondary'];
            $tmp['value'] = "{$color['primary']}_{$color['secondary']}";

            $tmp['control_begin'] = sprintf('<label onclick="KopaUI.change_swatches(event, jQuery(this));" data-primary="%1$s" data-secondary="%2$s" for="%3$s" class="color-swatches-item" style="border-color: %1$s !important;">', $color['primary'], $color['secondary'], "{$this->name}-{$tmp['value']}");
            $tmp['control_begin'].= sprintf('<span class="color-swatches-primary" style="background-color: %s;"></span>', $color['primary']);
            $tmp['control_begin'].= sprintf('<span class="color-swatches-secondary" style="background-color: %s;"></span>', $color['secondary']);

            $tmp['control_end'] = '</label>';

            $this->options[] = $tmp;
        }

        $this->option_args['wrap_begin'] = '<div class="col-xs-4 col-md-2 color-swatches-outer">';
        $this->option_args['wrap_end'] = '</div>';
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
        $this->classes[] = 'kopa-ui-radio-color-swatches';
        return parent::get_control();
    }

}