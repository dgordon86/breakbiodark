<?php

class KopaUI {

    protected $type;
    public $id;
    public $name;
    public $classes;
    public $value;
    public $default;
    public $attributes;
    public $is_append_label_before_control;
    public $wrap_begin;
    public $wrap_end;
    public $control_begin;
    public $control_end;
    public $help;
    public $help_begin;
    public $help_end;
    public $help_classes;
    public $label;
    public $label_begin;
    public $label_end;
    public $label_classes;
    public $sub_fields;

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
        $this->type = isset($args['type']) ? $args['type'] : '';
        $this->id = isset($args['id']) ? $args['id'] : '';
        $this->name = isset($args['name']) ? $args['name'] : '';
        $this->classes = isset($args['classes']) ? $args['classes'] : array();
        $this->value = isset($args['value']) ? $args['value'] : '';
        $this->default = isset($args['default']) ? $args['default'] : '';
        $this->attributes = isset($args['attributes']) ? $args['attributes'] : array();
        $this->wrap_begin = isset($args['wrap_begin']) ? $args['wrap_begin'] : '';
        $this->wrap_end = isset($args['wrap_end']) ? $args['wrap_end'] : '';
        $this->control = isset($args['control']) ? $args['control'] : '';
        $this->control_begin = isset($args['control_begin']) ? $args['control_begin'] : '';
        $this->control_end = isset($args['control_end']) ? $args['control_end'] : '';
        $this->help = isset($args['help']) ? $args['help'] : '';
        $this->help_begin = isset($args['help_begin']) ? $args['help_begin'] : '';
        $this->help_end = isset($args['help_end']) ? $args['help_end'] : '';
        $this->help_classes = isset($args['help_classes']) ? $args['help_classes'] : array();
        $this->label = isset($args['label']) ? $args['label'] : '';
        $this->label_begin = isset($args['label_begin']) ? $args['label_begin'] : '';
        $this->label_end = isset($args['label_end']) ? $args['label_end'] : '';
        $this->is_append_label_before_control = isset($args['is_append_label_before_control']) ? $args['is_append_label_before_control'] : true;
        $this->label_classes = isset($args['label_classes']) ? $args['label_classes'] : array();
        $this->sub_fields = isset($args['sub_fields']) ? $args['sub_fields'] : array();
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
    public function get_html() {
        $label = $this->get_label();
        $help = $this->get_help();

        $sub_controls = '';
        if (!empty($this->sub_fields)) {
            foreach ($this->sub_fields as $field) {
                $sub_controls .= KopaControl::get_html($field);
            }
        }

        $pattern = ($this->is_append_label_before_control) ? '%1$s %2$s' : '%2$s %1$s';
        $control = $this->control_begin . $this->get_control() . $sub_controls . $this->control_end;

        return $this->wrap_begin . sprintf($pattern, $label, $control) . $help . $this->wrap_end;
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
    public function set_attribute($key = '', $value = '') {
        $this->attributes[$key] = $value;
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
        return __('<blockquote class="kopa-ui-alert">This is abstract class</blockquote>', kopa_get_domain());
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
    protected function get_label() {
        $this->label_classes[] = 'kopa-ui-label';
        $this->label_classes[] = sprintf('kopa-ui-%1$s-label', $this->type);
        $this->label_classes[] = $this->is_append_label_before_control ? 'label_before_control' : 'label_after_control';
        return !empty($this->label) ? sprintf('%1$s<label class="%2$s" for="%3$s">%4$s</label>%5$s', $this->label_begin, implode(' ', $this->label_classes), $this->id, $this->label, $this->label_end) : '';
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
    protected function get_help() {
        $this->help_classes[] = 'kopa-ui-help';
        $this->help_classes[] = sprintf('kopa-ui-%1$s-help', $this->type);
        return !empty($this->help) ? sprintf('%1$s<div class="%2$s">%3$s</div>%4$s', $this->help_begin, implode(' ', $this->help_classes), $this->help, $this->help_end) : '';
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
    protected function unserialize_attributes() {
        $attributes = array();
        if (!empty($this->attributes)) {
            foreach ($this->attributes as $key => $value) {
                $attributes[] = sprintf('%1$s="%2$s"', $key, $value);
            }
        }
        return implode(' ', $attributes);
    }

}