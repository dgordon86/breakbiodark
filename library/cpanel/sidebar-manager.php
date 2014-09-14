<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
$theme_options_args = array();
$theme_options_args['wrap_begin'] = '<div class="kopa-opt-fields clearfix"><div class="row clearfix">';
$theme_options_args['wrap_end'] = '</div></div>';
$theme_options_args['label_begin'] = '<div class="col-xs-3 kopa-opt-field-label">';
$theme_options_args['label_end'] = '</div>';
$theme_options_args['control_begin'] = '<div class="col-xs-9">';
$theme_options_args['control_end'] = '</div>';
$theme_options_args['help_classes'] = array();
$theme_options_args['help_begin'] = '';
$theme_options_args['help_end'] = '';
$tabs = array(
    'sidebars' => array(
        'icon' => 'dashicons dashicons-admin-settings',
        'title' => __('Sidebars', kopa_get_domain()),
        'fields' => array(
            array(
                'type' => 'sidebar-manage',
                'id' => 'sidebars',
                'name' => 'sidebars',
                'default' => get_option(KOPA_OPT_PREFIX . 'sidebars')
            )
        )
    )    
);
?>
<img id="kopa-loading-gif" src="<?php echo get_template_directory_uri() . '/library/images/loading.gif'; ?>">
<div id="kopa-cpanel-wrapper" class="clearfix">
    <div class="col-left pull-left">
        <ul class="kopa-cpanel-nav">
            <?php
            $is_first = true;
            foreach ($tabs as $slug => $tab):
                if ($is_first) {
                    printf('<li><a class="kopa-tab-link active" href="#tab-%s"><i class="%s"></i><span>%s</span></a></li>', $slug, $tab['icon'], $tab['title']);
                    $is_first = false;
                } else {
                    printf('<li><a class="kopa-tab-link" href="#tab-%s">%s</a></li>', $slug, $tab['icon'], $tab['title']);
                }
                ?>                
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-right pull-right">
        <div class="kopa-panel-title clearfix">
            <h3>
                <?php _e('Sidebar Manage', kopa_get_domain()); ?>
                <span class="pull-right"><?php _e('Visit author URL:', kopa_get_domain()); ?>&nbsp;<a href="<?php echo constant('KOPA_THEME_URL'); ?>"><?php echo constant('KOPA_THEME_URL'); ?></a></span>
            </h3>                 
        </div>
        <div class="frm-list-controls">                
            <?php
            $is_first = true;
            foreach ($tabs as $slug => $tab) {
                $tab_classes = array('kopa-tab');
                if ($is_first) {
                    $tab_classes[] = 'tab_active';
                    $is_first = false;
                } else {
                    $tab_classes[] = 'tab_deactive';
                }
                ?>
                <div class="<?php echo implode(' ', $tab_classes); ?>" id="<?php printf('tab-%s', $slug); ?>">
                    <p class="kopa-tab-title"><?php echo $tab['title']; ?></p>
                    <div class="kopa-tab-body">
                        <?php
                        foreach ($tab['fields'] as $field) {
                            $field['value'] = get_option(KOPA_OPT_PREFIX . $field['name']);
                            if (empty($field['label']) || !isset($field['label'])) {
                                $theme_options_args['control_begin'] = '<div class="col-xs-12">';
                            } else {
                                $theme_options_args['control_begin'] = '<div class="col-xs-9">';
                            }
                            echo KopaControl::get_html(array_merge($theme_options_args, $field));
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>           
    </div>
</div>
<?php wp_nonce_field("kopa_add_sidebar", "kopa_add_sidebar_ajax_nonce", false); ?>            
<?php wp_nonce_field("kopa_remove_sidebar", "kopa_remove_sidebar_ajax_nonce"); ?>            
<?php wp_nonce_field("kopa_rename_sidebar", "kopa_rename_sidebar_ajax_nonce"); ?>            