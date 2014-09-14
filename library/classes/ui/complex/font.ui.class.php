<?php

class KopaUIFont extends KopaUI {

    public $is_show_caption;

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
        $this->is_show_caption = isset($args['is_show_caption']) ? $args['is_show_caption'] : false;
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
        global $google_font, $font_opts;
        $font_opts = array_merge(array('off' => __('-- None (turn off this feature) --', kopa_get_domain())), $font_opts);
        $styles = '';
        $weight_opts = array('400' => 'regular');

        if ('off' != $this->value['family']) {
            $current_font = $google_font['items'][$this->value['family']];

            foreach ($current_font['variants'] as $weight) {
                $tmp_value = $weight;
                if ('regular' == $weight) {
                    $tmp_value = '400';
                } else if ('italic' == $weight) {
                    $tmp_value = '400italic';
                }
                $weight_opts[$tmp_value] = $weight;
            }

            $font_family = str_replace(' ', '+', $google_font['items'][$this->value['family']]['family']);
            $styles = sprintf('font-family:\'%s\'; font-size:%spx; font-weight:%s; line-height:%spx; text-transform: %s;', $font_family, $this->value['size'], $this->value['weight'], $this->value['line-height'], $this->value['text-transform']);

            if (strlen($this->value['weight']) > 3) {
                $styles .= "font-style:italic;";
            } else {
                $styles .= "font-style:normal;";
            }
            $cbos_opacity = 'opacity: 1;';
        } else {
            $styles = 'display:none;';
            $cbos_opacity = 'opacity: 0.3;';
        }

        $html = '';

        if ($this->is_show_caption) {
            #HEADER
            $html.= '<div class="kopa-font-ui-caption row clearfix">';
            $html.= '<div class="col-xs-4"><span>';
            $html.= sprintf('Font family', kopa_get_domain());
            $html.= '</span></div>';
            $html.= '<div class="col-xs-2"><span>';
            $html.= sprintf('Font size', kopa_get_domain());
            $html.= '</span></div>';
            $html.= '<div class="col-xs-2"><span>';
            $html.= sprintf('Font weight', kopa_get_domain());
            $html.= '</span></div>';
            $html.= '<div class="col-xs-2"><span>';
            $html.= sprintf('Line height', kopa_get_domain());
            $html.= '</span></div>';
            $html.= '<div class="col-xs-2"><span>';
            $html.= sprintf('Text Transform', kopa_get_domain());
            $html.= '</span></div>';
            $html.= '</div>';
        }


        #BODY
        $html.= '<div class="row clearfix">';

        $html.= '<div class="col-xs-4">';
        $html.= KopaControl::get_html(array(
                    'type' => 'select',
                    'id' => sprintf('%s-family', $this->name),
                    'name' => sprintf('%s[family]', $this->name),
                    'options' => $font_opts,
                    'value' => $this->value['family'],
                    'attributes' => array(
                        'onchange' => sprintf('KopaThemeOptions.onChangeFontFamily(event, jQuery(this), jQuery(\'#%s-preview\'));', $this->name)
                    ),
                    'classes' => array('kopa-font-family', 'percent100')));
        $html.= '</div>';

        $html.= '<div class="col-xs-2">';
        $html.= KopaControl::get_html(array(
                    'type' => 'select-number',
                    'id' => sprintf('%s-size', $this->name),
                    'name' => sprintf('%s[size]', $this->name),
                    'min' => 1,
                    'max' => 70,
                    'step' => 1,
                    'suffix' => ' px',
                    'attributes' => array(
                        'style' => $cbos_opacity,
                        'onchange' => sprintf('KopaThemeOptions.onChangeFontSize(event, jQuery(this), jQuery(\'#%s-preview\'));', $this->name)
                    ),
                    'value' => (int) $this->value['size'],
                    'classes' => array('kopa-font-size', 'percent100')));
        $html.= '</div>';

        $html.= '<div class="col-xs-2">';
        $html.= KopaControl::get_html(array(
                    'type' => 'select',
                    'id' => sprintf('%s-weight', $this->name),
                    'name' => sprintf('%s[weight]', $this->name),
                    'options' => $weight_opts,
                    'attributes' => array(
                        'style' => $cbos_opacity,
                        'onchange' => sprintf('KopaThemeOptions.onChangeFontWeight(event, jQuery(this), jQuery(\'#%s-preview\'));', $this->name)
                    ),
                    'value' => $this->value['weight'],
                    'classes' => array('kopa-font-weight', 'percent100')));
        $html.= '</div>';

        $html.= '<div class="col-xs-2">';
        $html.= KopaControl::get_html(array(
                    'type' => 'select-number',
                    'id' => sprintf('%s-line-height', $this->name),
                    'name' => sprintf('%s[line-height]', $this->name),
                    'min' => 1,
                    'max' => 70,
                    'step' => 1,
                    'suffix' => ' px',
                    'attributes' => array(
                        'style' => $cbos_opacity,
                        'onchange' => sprintf('KopaThemeOptions.onChangeLineHeight(event, jQuery(this), jQuery(\'#%s-preview\'));', $this->name)
                    ),
                    'value' => (int) $this->value['line-height'],
                    'classes' => array('kopa-line-height', 'percent100')));
        $html.= '</div>';

        $html.= '<div class="col-xs-2">';
        $html.= KopaControl::get_html(array(
                    'type' => 'select',
                    'id' => sprintf('%s-text-transform', $this->name),
                    'name' => sprintf('%s[text-transform]', $this->name),
                    'attributes' => array(
                        'style' => $cbos_opacity,
                        'onchange' => sprintf('KopaThemeOptions.onChangeTextTransform(event, jQuery(this), jQuery(\'#%s-preview\'));', $this->name)
                    ),
                    'value' => $this->value['text-transform'],
                    'classes' => array('kopa-text-transform', 'percent100'),
                    'options' => array(
                        'none' => __('--None--', kopa_get_domain()),
                        'capitalize' => __('Capitalize', kopa_get_domain()),
                        'lowercase' => __('Lower Case', kopa_get_domain()),
                        'uppercase' => __('Upper Case', kopa_get_domain()))));
        $html.= '</div>';
        $html.= '</div>';

        $html.= '<div class="row clearfix">';
        $html.= '<div class="col-xs-12">';
        $html.= '<p style="' . $styles . '" id="' . $this->name . '-preview" class="kopa-font-ui-preview"><span>' . __('Grumpy wizards make toxic brew for the evil Queen and Jack', kopa_get_domain()) . '</span></p>';
        $html.= '</div>';
        $html.= '</div>';



        return $html;
    }

}