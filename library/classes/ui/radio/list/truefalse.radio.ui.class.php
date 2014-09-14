<?php

class KopaUIRadioTrueFalse extends KopaUIRadioList {

    public $true, $false;

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
        $this->options = array(
            array(
                'value' => 'true',
                'label' => isset($args['true']) ? $args['true'] : __('True', kopa_get_domain()),
            ),
            array(
                'value' => 'false',
                'label' => isset($args['false']) ? $args['false'] : __('False', kopa_get_domain())
            )
        );

        $this->control_begin = $this->control_begin . '<div class="row clearfix">';
        $this->control_end = '</div>' . $this->control_end;

        $this->option_args['wrap_begin'] = '<div class="col-xs-4 col-sm-4 col-md-2">';
        $this->option_args['wrap_end'] = '</div>';
        $this->option_args['label_begin'] = '';
        $this->option_args['label_end'] = '';
        $this->option_args['control_begin'] = '';
        $this->option_args['control_end'] = '';
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
        $this->classes[] = 'kopa-ui-radio-true-false';
        return parent::get_control();
    }

}