<?php

class KopaUITaxonomy extends KopaUISelect {

    public $taxonomy;

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
        $this->taxonomy = isset($args['taxonomy']) ? $args['taxonomy'] : 'category';
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
        $this->classes[] = 'kopa-ui-taxonomy';

        $terms = get_terms($this->taxonomy);
        $this->options[''] = __('-- Select --', kopa_get_domain());
        foreach ($terms as $term) {
            $this->options[$term->term_id] = $term->name;
        }

        return parent::get_control();
    }

}