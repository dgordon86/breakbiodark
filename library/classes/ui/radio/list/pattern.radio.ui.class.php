<?php

class KopaUIRadioPattern extends KopaUIRadioList {

    public $dir_abs;
    public $dir_rel;

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

        $this->dir_abs = isset($args['dir_abs']) ? $args['dir_abs'] : false;
        $this->dir_rel = isset($args['dir_rel']) ? $args['dir_rel'] : false;

        if ($this->dir_abs && $this->dir_rel) {
            $this->options = array();
            $path = $this->dir_abs . '*.png';
            $files = glob($path);

            if ($files) {
                foreach ($files as $file) {
                    $file_name = basename($file);

                    $label_class = ($this->value == $file_name) ? 'active' : '';

                    $tmp = array();
                    $tmp['value'] = $file_name;
                    $tmp['control_begin'] = sprintf('<label onclick="kopa_pattern_change(event, jQuery(this));" style="background-image: url(%1$s);" for="%2$s" class="radio-pattern-item %3$s">', $this->dir_rel . '/' . $file_name, "{$this->name}-{$tmp['value']}", $label_class);
                    $tmp['control_end'] = '</label>';

                    $this->options[] = $tmp;
                }
            }

            $this->option_args['wrap_begin'] = '<div class="col-xs-4 col-md-2 radio-pattern-outer">';
            $this->option_args['wrap_end'] = '</div>';
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
        $this->classes[] = 'kopa-ui-radio-pattern';
        return parent::get_control();
    }

}