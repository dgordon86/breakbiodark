<?php
if (!class_exists('KopaWidget')) {

    class KopaWidget extends WP_Widget {

        public $groups;

        /**
         * 
         *
         * @package Kopa
         * @subpackage Core
         * @author thethangtran <tranthethang@gmail.com>
         * @since 1.0.0
         *      
         */
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            if (!empty($this->groups)) {
                foreach ($this->groups as $group) {
                    $fields = $group['fields'];
                    foreach ($fields as $field) {
                        if (isset($new_instance[$field['name']])) {
                            $instance[$field['name']] = KopaControl::filter_post_data($field, $new_instance[$field['name']]);
                        } else {
                            $instance[$field['name']] = $field['default'];
                        }
                    }
                }
            }

            return $instance;
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
        public function form($instance) {
            $defaults = array();
            // INIT DEFAULTS
            if (!empty($this->groups)) {
                foreach ($this->groups as $group) {
                    $fields = $group['fields'];
                    foreach ($fields as $field) {
                        $slug = empty($field['name']) ? NULL : $field['name'];
                        $default = empty($field['default']) ? NULL : $field['default'];
                        if (!empty($slug))
                            $defaults[$slug] = $default;
                    }
                }
            }
            $instance = wp_parse_args((array) $instance, $defaults);

            // INIT CONTROLS
            ?>
            <div class="kopa-widget-wrap">
                <div class="row clearfix">
                    <?php
                    if (!empty($this->groups)) {
                        foreach ($this->groups as $group) {
                            $fields = $group['fields'];
                            $size = isset($group['size']) ? (int) $group['size'] : 12;
                            ?>
                            <div class="<?php printf('col-sm-%s', $size); ?>">
                                <?php
                                $i = 0;
                                foreach ($fields as $field) {
                                    $field['value'] = $instance[$field['name']];

                                    $wrap_classes = array('kopa-widget-control-wrap', 'clearfix');
                                    $wrap_classes[] = (0 == $i % 2) ? 'even' : 'odd';

                                    $field['wrap_begin'] = sprintf('<div class="%1$s">', implode(' ', $wrap_classes));
                                    $field['wrap_end'] = '</div>';

                                    $field['id'] = $this->get_field_id($field['id']);
                                    $field['name'] = $this->get_field_name($field['name']);

                                    $i++;
                                    echo KopaControl::get_html($field);
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }

    }

}