<?php

if (!class_exists('KopaPosttype')) {

    class KopaPosttype {

        public $post_type_name;
        public $post_type_slug;
        public $post_type_plural;
        public $post_type_args;
        public $post_type_labels;
        public $post_meta_boxes;
        public $post_columns;
        public $taxonomy_fields;
        public $taxonomy;
        public $media;

        /**
         * 
         *
         * @package Kopa
         * @subpackage Core
         * @author thethangtran <tranthethang@gmail.com>
         * @since 1.0.0
         *      
         */
        public function __construct($name, $slug, $plural = '', $args = array(), $labels = array(), $columns = array(), $taxonomy = array(), $media = array()) {
            // Set some important variables
            $this->post_type_name = $this->beautify($name);
            $this->post_type_slug = $this->uglify($slug);
            $this->post_type_plural = $plural;
            $this->post_type_args = $args;
            $this->post_type_labels = $labels;
            $this->post_columns = $columns;
            $this->taxonomy = $taxonomy;
            $this->media = $media;

            // Add action to register the post type, if the post type doesnt exist
            if (!post_type_exists($this->post_type_slug)) {
                $this->register_post_type();
            }

            add_action('admin_init', array(&$this, 'admin_init_custom_post_type'));
            add_action('init', array(&$this, 'register_taxonomy'));
            add_action('admin_enqueue_scripts', array(&$this, 'enqueue_scripts'));
            add_filter('post_updated_messages', array(&$this, 'updated_messages'));
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
        public function updated_messages($messages) {
            global $post, $post_ID;

            if ($this->post_type_slug == $post->post_type) {
                $capability_type = 'post';
                $public = true;

                if (isset($this->post_type_args['capability_type'])) {
                    $capability_type = ('post' == $this->post_type_args['capability_type']) ? 'post' : 'page';
                }
                if (isset($this->post_type_args['public'])) {
                    $public = $this->post_type_args['public'];
                }


                $messages[$capability_type] = array(
                    0 => '',
                    1 => sprintf(__('%s updated. <a href="%s">View %s</a>', kopa_get_domain()), $this->post_type_name, esc_url(get_permalink($post_ID)), $this->post_type_name),
                    2 => __('Custom field updated.', kopa_get_domain()),
                    3 => __('Custom field deleted.', kopa_get_domain()),
                    4 => sprintf(__('%s updated.', kopa_get_domain()), $this->post_type_name),
                    5 => isset($_GET['revision']) ? sprintf(__('%s restored to revision from %s', kopa_get_domain()), $this->post_type_name, wp_post_revision_title((int) $_GET['revision'], false)) : false,
                    6 => sprintf(__('%s updated. <a href="%s">View %s</a>', kopa_get_domain()), $this->post_type_name, esc_url(get_permalink($post_ID)), $this->post_type_name),
                    7 => sprintf(__('%s saved.', kopa_get_domain()), $this->post_type_name),
                    8 => sprintf(__('%s submitted. <a target="_blank" href="%s">Preview %s</a>', kopa_get_domain()), $this->post_type_name, esc_url(add_query_arg('preview', 'true', get_permalink($post_ID))), $this->post_type_name),
                    9 => sprintf(__('%s scheduled for: <strong>%s</strong>. <a target="_blank" href="%s">Preview %s</a>', kopa_get_domain()), $this->post_type_name, date_i18n(__('M j, Y @ G:i', kopa_get_domain()), strtotime($post->post_date)), esc_url(get_permalink($post_ID)), $this->post_type_name),
                    10 => sprintf(__('%s draft updated. <a target="_blank" href="%s">Preview %s</a>', kopa_get_domain()), $this->post_type_name, esc_url(add_query_arg('preview', 'true', get_permalink($post_ID))), $this->post_type_name),
                );
                
                if (!$public) {
                    $messages[$capability_type][1] = sprintf(__('%s updated.', kopa_get_domain()), $this->post_type_name);
                    $messages[$capability_type][6] = sprintf(__('%s updated.', kopa_get_domain()), $this->post_type_name);
                }
            }

            return $messages;
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
        public function enqueue_scripts() {
            $screen = get_current_screen();

            if (in_array($screen->base, array('post', 'page', 'edit-tags'))) {
                if ($this->post_type_slug != $screen->post_type)
                    return;

                if (isset($this->media['styles'])) {
                    foreach ($this->media['styles'] as $style) {
                        wp_enqueue_style($style);
                    }
                }

                if (isset($this->media['scripts'])) {
                    foreach ($this->media['scripts']as $script) {
                        wp_enqueue_script($script);
                    }
                }
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
        public function add_columns($columns) {
            $this->post_columns = $columns;

            add_filter("manage_edit-{$this->post_type_slug}_columns", array($this, 'manage_edit_columns'));
            add_action("manage_{$this->post_type_slug}_posts_custom_column", array($this, 'manage_posts_custom_column'));
            add_filter("manage_edit-{$this->post_type_slug}_sortable_columns", array($this, 'manage_edit_sortable_columns'));
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
        public function manage_edit_columns($columns) {
            $_columns = array();
            foreach ($this->post_columns as $k => $v) {
                $_columns[$k] = $v[0];
            }
            $columns = $_columns;
            return $columns;
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
        public function manage_posts_custom_column($column) {
            global $post;
            $column_info = $this->post_columns[$column];
            $column_type = $column_info[1];
            switch ($column_type) {
                case 'thumbnail' :
                    $image = KopaUtil::get_image_src($post->ID, 'full');
                    if ($image) {
                        printf('<a target="_blank" href="%s"><img src="%s"></a>', $image, bfi_thumb($image, array('width' => 60, 'height' => 60, 'crop' => true)));
                    }
                    break;
                case 'image':
                    $image = KopaUtil::get_post_meta($post->ID, $column, true, 'String', '');
                    if ($image) {
                        $image = do_shortcode($image);
                        printf('<a target="_blank" href="%s"><img src="%s"></a>', $image, bfi_thumb($image, array('width' => 60, 'height' => 60, 'crop' => true)));
                    }
                    break;
                case 'text':
                    echo KopaUtil::get_post_meta($post->ID, $column, true, 'String', '');
                    break;
                case 'link':
                    $url = KopaUtil::get_post_meta($post->ID, $column, true, 'String', '');
                    if ($url)
                        printf('<a href="%1$s">%1$s</a>', $url);
                    break;
                case 'id':
                    echo $post->ID;
                    break;
                case 'int':
                    echo KopaUtil::get_post_meta($post->ID, $column, true, 'Int', 0);
                    break;
                case 'float':
                    echo KopaUtil::get_post_meta($post->ID, $column, true, 'Float', 0);
                    break;
                case 'term':
                    the_terms($post->ID, $column);
                    break;
                case 'features':
                    $features = KopaUtil::get_post_meta($post->ID, $column, true);
                    if ($features && is_array($features)) {
                        $items = $features['feature'];
                        echo '<ul>';
                        foreach ($items as $item) {
                            printf('<li>%s</li>', $item);
                        }
                        echo '</ul>';
                    }
                    break;
                default :
                    break;
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
        public function manage_edit_sortable_columns($columns) {
            foreach ($this->post_columns as $k => $v) {
                if ('sort' == $v[2]) {
                    $columns[$k] = $k;
                }
            }
            return $columns;
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
        public function add_taxonomy_fields($taxonomy_fields, $taxonomy) {
            $this->taxonomy_fields = $taxonomy_fields;
            add_action("{$taxonomy}_edit_form_fields", array($this, 'taxonomy_edit_form_fields'));
            add_action("edited_{$taxonomy}", array($this, 'edited_taxonomy'));
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
        function taxonomy_edit_form_fields($term) {
            foreach ($this->taxonomy_fields as $field) {
                $key = "{$field['name']}_{$term->term_id}";
                $field['value'] = get_option($key, $field['default']);

                $field['label'] = isset($field['label']) && !empty($field['label']) ? $field['label'] : '&nbsp;';

                if (isset($field['is_append_label_before_control']) && !$field['is_append_label_before_control']) {
                    $field['wrap_begin'] = '<tr class="kopa-tax-form-field form-field"><th></th><td><div class="kopa-tax-form-field-inner">';
                    $field['wrap_end'] = '</div></td></tr>';
                } else {
                    $field['wrap_begin'] = '<tr class="kopa-tax-form-field form-field">';
                    $field['wrap_end'] = '</tr>';

                    $field['label_begin'] = '<th>' . (isset($field['label_begin']) ? $field['label_begin'] : '');
                    $field['label_end'] = (isset($field['label_end']) ? $field['label_end'] : '') . '</th>';

                    $field['control_begin'] = '<td><div class="kopa-tax-form-field-inner">' . (isset($field['control_begin']) ? $field['control_begin'] : '');
                    $field['control_end'] = (isset($field['control_end']) ? $field['control_end'] : '') . '</div></td>';
                }

                echo KopaControl::get_html($field);
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
        function edited_taxonomy($term_id) {
            foreach ($this->taxonomy_fields as $field) {
                $key = "{$field['name']}_{$term_id}";
                if (!empty($_POST[$field['name']])) {
                    update_option($key, $_POST[$field['name']]);
                } else {
                    delete_option($key);
                }
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
        public function register_post_type() {
            //Capitilize the words and make it plural
            $name = $this->post_type_name;
            if ($this->post_type_plural == '')
                $plural = $this->pluralize($name);
            else
                $plural = $this->post_type_plural;
            // We set the default labels based on the post type name and plural. We overwrite them with the given labels.
            $labels = array_merge(
                    // Default
                    array(
                'name' => _x($plural, 'post type general name'),
                'singular_name' => _x($name, 'post type singular name'),
                'add_new' => __('Add New', kopa_get_domain()),
                'add_new_item' => __('Add New', kopa_get_domain()) . ' ' . $name,
                'edit_item' => __('Edit', kopa_get_domain()) . ' ' . $name,
                'new_item' => __('New', kopa_get_domain()) . ' ' . $name,
                'all_items' => __('All', kopa_get_domain()) . ' ' . $plural,
                'view_item' => __('View', kopa_get_domain()) . ' ' . $name,
                'search_items' => __('Search', kopa_get_domain()) . ' ' . $plural,
                'not_found' => __('No', kopa_get_domain()) . ' ' . strtolower($plural) . ' ' . __('found', kopa_get_domain()),
                'not_found_in_trash' => __('No', kopa_get_domain()) . ' ' . strtolower($plural) . ' ' . __('found in Trash', kopa_get_domain()),
                'parent_item_colon' => '',
                'menu_name' => $plural
                    ),
                    // Given labels
                    $this->post_type_labels
            );
            // Same principle as the labels. We set some default and overwite them with the given arguments.
            $args = array_merge(
                    // Default
                    array(
                'label' => $plural,
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'query_var' => true,
                'rewrite' => true,
                'has_archive' => true,
                'capability_type' => 'post',
                'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'post-formats')
                    ),
                    // Given args
                    $this->post_type_args
            );
            // Register the post type
            register_post_type($this->post_type_slug, $args);
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
        public function register_taxonomy() {
            if (!empty($this->taxonomy)) {
                foreach ($this->taxonomy as $tax) {
                    $name = $tax['name'];
                    $menu_name = $tax['menu_name'];

                    $hierarchical = isset($tax['hierarchical']) ? (bool) $tax['hierarchical'] : true;
                    $args = isset($tax['args']) ? $tax['args'] : array();
                    $labels = isset($tax['labels']) ? $tax['labels'] : array();

                    $this->add_taxonomy($name, $menu_name, $hierarchical, $args, $labels);
                }
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
        public function add_taxonomy($name, $menu_name, $hierarchical = true, $args = array(), $labels = array()) {
            if (!empty($name)) {
                $post_type_name = $this->post_type_slug;
                $taxonomy_name = $this->uglify($name);
                $taxonomy_labels = $labels;
                $taxonomy_args = $args;
                if (!taxonomy_exists($taxonomy_name)) {
                    $name = $this->beautify($name);
                    $plural = $this->pluralize($name);
                    $labels = array_merge(
                            array(
                        'name' => _x($plural, 'taxonomy general name'),
                        'singular_name' => _x($name, 'taxonomy singular name'),
                        'search_items' => __('Search', kopa_get_domain()) . ' ' . $plural,
                        'all_items' => __('All', kopa_get_domain()) . ' ' . $plural,
                        'parent_item' => __('Parent', kopa_get_domain()) . ' ' . $name,
                        'parent_item_colon' => __('Parent', kopa_get_domain()) . ' ' . $name,
                        'edit_item' => __('Edit', kopa_get_domain()) . ' ' . $name,
                        'update_item' => __('Update', kopa_get_domain()) . ' ' . $name,
                        'add_new_item' => __('Add New', kopa_get_domain()) . ' ' . $name,
                        'new_item_name' => __('New', kopa_get_domain()) . ' ' . $name . ' ' . __('Name', kopa_get_domain()),
                        'menu_name' => $menu_name,
                            ), $taxonomy_labels
                    );
                    $args = array_merge(array(
                        'label' => $plural,
                        'labels' => $labels,
                        'public' => true,
                        'show_ui' => true,
                        'rewrite' => true,
                        'hierarchical' => $hierarchical,
                        'show_in_nav_menus' => true,
                        '_builtin' => false
                            ), $taxonomy_args
                    );
                    register_taxonomy($taxonomy_name, $post_type_name, $args);
                } else {
                    register_taxonomy_for_object_type($taxonomy_name, $post_type_name);
                }
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
        public function add_meta_box($title, $meta_name = '', $fields = array(), $args = array()) {
            if (!empty($title)) {
                $box_id = $this->uglify($title);
                $box_args = array_merge(array(
                    'post_type_name' => $this->post_type_slug,
                    'id' => $box_id,
                    'title' => $this->beautify($title),
                    'meta_name' => $meta_name,
                    'fields' => $fields,
                    'context' => 'normal',
                    'priority' => 'default',
                    'build_tabs' => true
                        ), $args
                );
                $this->post_meta_boxes[$box_id] = $box_args;
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
        function admin_init_custom_post_type() {
            if (empty($this->post_meta_boxes))
                return;
            add_action('save_post', array(&$this, 'save_post_custom_post_type'));
            foreach ($this->post_meta_boxes as $box) {
                add_meta_box($box['id'], $box['title'], array($this, 'display_box'), $box['post_type_name'], $box['context'], $box['priority']);
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
        function display_box($post, $args) {
            $id = $args['id'];
            $box_args = $args['callback'][0]->post_meta_boxes[$id];
            $fields = $box_args['fields'];
            $meta_name = $box_args['meta_name'];
            $settings = get_post_custom($post->ID);
            $new_settings = array();
            if (empty($settings))
                $settings = array();
            else {
                foreach ($settings as $k => $v)
                    $new_settings[$k] = $v[0];
            }
            wp_nonce_field('kopa_custom_post', 'security', false);
            echo '<input type="hidden" name="kopa_metabox[]" value="' . $id . '" />';
            $obj_metabox_ui = new KopaMetabox($fields, $meta_name, $new_settings);
            echo $obj_metabox_ui->init();
        }

        /* Listens for when the post type being saved */

        /**
         * 
         *
         * @package Kopa
         * @subpackage Core
         * @author thethangtran <tranthethang@gmail.com>
         * @since 1.0.0
         *      
         */
        function save_post_custom_post_type($post_id) {
            // Deny the wordpress autosave function
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if (isset($_POST['security'])) {
                if (!wp_verify_nonce($_POST['security'], 'kopa_custom_post'))
                    return;
            }else {
                return;
            }
            // Need the post type name again
            $post_type_name = $this->post_type_slug;
            if (isset($_POST) && isset($post_id) && get_post_type($post_id) == $post_type_name) {
                $metaboxes = $_POST['kopa_metabox'];
                foreach ($metaboxes as $box_id) {
                    $settings = $this->pre_save($this->post_meta_boxes[$box_id]['fields']);
                    if (!empty($settings))
                        foreach ($settings as $k => $v) {
                            if ('' != $v) {
                                update_post_meta($post_id, $k, $v);
                            } else {
                                delete_post_meta($post_id, $k);
                            }
                        }
                }
            }
            
            do_action('kopa_after_save_post_custom_post_type');
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
        private function pre_save($fields) {
            $elements = $fields['fields'];
            $data = array();
            foreach ($elements as $element) {
                $key = $element['id'];
                $value = isset($_POST[$key]) ? $this->filter_post_data($_POST[$key], $element) : (isset($element['default']) ? $element['default'] : '');
                $data[$key] = $value;
            }
            return $data;
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
        private function filter_post_data($data, $field) {
            return KopaControl::filter_post_data($field, $data);
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
        public function beautify($string) {
            return KopaUtil::str_beautify($string);
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
        public function uglify($string) {
            return KopaUtil::str_uglify($string);
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
        public function pluralize($string) {
            $last = $string[strlen($string) - 1];
            if ($last == 'y') {
                $cut = substr($string, 0, -1);
                //convert y to ies
                $plural = $cut . 'ies';
            } else if ($last == 's') {
                $cut = substr($string, 0, -1);
                //convert y to ies
                $plural = $cut . 'es';
            } else {
                // just attach an s
                $plural = $string . 's';
            }
            return $plural;
        }

    }

}