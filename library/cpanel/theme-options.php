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
$theme_options_args['help_begin'] = '<div class="col-xs-9 col-xs-offset-3">';
$theme_options_args['help_end'] = '</div>';
$tabs = KopaInit::get_theme_option_fields();
?>
<img id="kopa-loading-gif" src="<?php echo get_template_directory_uri() . '/library/images/loading.gif'; ?>">
<div id="kopa-cpanel-wrapper" class="clearfix">
    <div class="col-left pull-left">
        <ul class="kopa-cpanel-nav">
            <?php
            $is_first = true;
            foreach ($tabs as $slug => $tab):
                $icon = isset($tab['icon']) ? sprintf('<i class="%1$s"></i>', $tab['icon']) : '';
                if ($is_first) {
                    printf('<li><a class="kopa-tab-link active" href="#tab-%s">%s <span>%s</span></a></li>', $slug, $icon, $tab['title']);
                    $is_first = false;
                } else {
                    printf('<li><a class="kopa-tab-link" href="#tab-%s">%s <span>%s</span></a></li>', $slug, $icon, $tab['title']);
                }
                ?>                
            <?php endforeach; ?>
        </ul>
        <a href="#" class="btn-reset-default btn btn-danger pull-left" onclick="KopaThemeOptions.reset(event, '<?php echo wp_create_nonce('kopa_reset_theme_options'); ?>');" ><i class="dashicons dashicons-sos"></i>&nbsp;<span><?php _e('Reset', kopa_get_domain()); ?></span></a>
    </div>
    <div class="col-right pull-right">
        <div class="kopa-panel-title clearfix">
            <h3>
                <?php _e('Theme Options', kopa_get_domain()); ?>
                <span class="pull-right"><?php _e('Visit author URL:', kopa_get_domain()); ?>&nbsp;<a href="<?php echo constant('KOPA_THEME_URL'); ?>"><?php echo constant('KOPA_THEME_URL'); ?></a></span>
            </h3>                 
        </div>
        <form id="frm-kopa-theme-options" name="frm-kopa-theme-options" class="kopa-cpanel-form"  autocomplete="off" method="post" action="#">
            <p class="frm-submit-block">
                <button type="submit" class="btn btn-primary"><i class="dashicons dashicons-yes"></i>&nbsp;<?php _e('Save', kopa_get_domain()); ?></button>
            </p>
            <div class="frm-list-controls">                
                <?php
                $sub_tab_icon = 'dashicons-plus';
                $sub_tab_display = 'none';

                $sub_tab_icon = '';
                $sub_tab_display = 'block';

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
                        <?php
                        foreach ($tab['groups'] as $groups) {
                            ?>
                            <div id="<?php printf('kopa-group-%s', KopaUtil::str_uglify($groups['title'])); ?>">                        
                                <p class="kopa-tab-title clearfix"><span class="kopa-tab-title-left pull-left"><?php echo $groups['title']; ?></span></p>
                                <div class="kopa-tab-body" style="display: <?php echo $sub_tab_display; ?>;">
                                    <?php
                                    foreach ($groups['fields'] as $field) {
                                        $field['value'] = KopaOptions::get_option($field['name'], $field['default']);
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
                    <?php
                }
                ?>
            </div>
            <p class="frm-submit-block frm-submit-bottom-block clearfix">                                
                <button type="submit" class="btn btn-primary"><i class="dashicons dashicons-yes"></i>&nbsp;<?php _e('Save', kopa_get_domain()); ?></button>
            </p>
            <?php wp_nonce_field("kopa_save_theme_options", "ajax_nonce"); ?>            
            <input type="hidden" name="action" value="kopa_save_theme_options">
        </form>
    </div>
</div>