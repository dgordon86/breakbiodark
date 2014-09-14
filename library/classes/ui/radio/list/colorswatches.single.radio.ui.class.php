<?php

class KopaUIRadioColorSwatchesSingle extends KopaUIRadioList {

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
            $tmp['value'] = $color['primary'];

            if ('customize' == $tmp['value']) {
                $tmp['control_begin'] = sprintf('<label onclick="KopaUI.select_colorSwatchesSingle(event, jQuery(this));" data-primary="customize" for="%s" class="color-swatches-item color-swatches-single-customize">', "{$this->name}-{$tmp['value']}");
                $tmp['control_begin'].= sprintf('<span class="color-swatches-primary">%1$s</span>', $color['label']);
            } else {
                $tmp['control_begin'] = sprintf('<label onclick="KopaUI.select_colorSwatchesSingle(event, jQuery(this));" data-primary="%1$s" for="%2$s" class="color-swatches-item" style="border-color: %1$s !important;">', $color['primary'], "{$this->name}-{$tmp['value']}");
                $tmp['control_begin'].= sprintf('<span class="color-swatches-primary %3$s" style="background-color: %1$s;">%2$s</span>', $color['primary'], $color['label'], implode(' ', $color['classes']));
            }

            $tmp['control_end'] = '</label>';

            $this->options[] = $tmp;
        }

        $this->control_begin = $this->control_begin . '<div class="row row_space15 clearfix">';
        $this->control_end = '</div>' . $this->control_end;
        
        $this->option_args['wrap_begin'] = '<div class="col-xs-4 col-md-1 color-swatches-outer color-swatches-single-outer">';
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