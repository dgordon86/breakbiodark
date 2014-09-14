<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
$kopa_template_hierarchy = KopaInit::get_template_hierarchy();
$tmp_kopaSettings = get_option(KOPA_OPT_PREFIX . 'layout_settings');
?>
<img id="kopa-loading-gif" src="<?php echo get_template_directory_uri() . '/library/images/loading.gif'; ?>">
<div id="kopa-cpanel-wrapper" class="clearfix">
    <div class="col-left pull-left">
        <ul class="kopa-cpanel-nav">
<?php
$is_first = true;
foreach ($kopa_template_hierarchy as $slug => $tab):
    if ($is_first) {
        printf('<li><a class="kopa-tab-link active" href="#tab-%s"><i class="%s"></i> <span>%s</span></a></li>', $slug, $tab['icon'], $tab['title']);
        $is_first = false;
    } else {
        printf('<li><a class="kopa-tab-link" href="#tab-%s"><i class="%s"></i><span>%s</span></a></li>', $slug, $tab['icon'], $tab['title']);
    }
    ?>                
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-right pull-right">
        <div class="kopa-panel-title clearfix">
            <h3>
<?php _e('Layout & Sidebar Manager', kopa_get_domain()); ?>
                <span class="pull-right"><?php _e('Visit author URL:', kopa_get_domain()); ?>&nbsp;<a href="<?php echo constant('KOPA_THEME_URL'); ?>"><?php echo constant('KOPA_THEME_URL'); ?></a></span>
            </h3>                 
        </div>
        <form id="frm-kopa-layout-manage" name="frm-kopa-layout-manage" class="kopa-cpanel-form"  autocomplete="off" method="post" action="#">
            <p class="frm-submit-block">
                <button type="submit" class="btn btn-primary"><i class="dashicons dashicons-yes"></i>&nbsp;<?php _e('Save', kopa_get_domain()); ?></button>
            </p>
            <div class="frm-list-controls">                
<?php
$is_first = true;
foreach ($kopa_template_hierarchy as $slug => $tab) {
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
    $args = array(
        'type' => 'layout',
        'id' => $slug,
        'name' => $slug,
        'value' => $tmp_kopaSettings[$slug],
        'template_hierarchy' => $slug
    );
    echo KopaControl::get_html($args);
    ?>
                        </div>
                    </div>
    <?php
}
?>
            </div>
            <p class="frm-submit-block frm-submit-bottom-block">
                <button type="submit" class="btn btn-primary"><i class="dashicons dashicons-yes"></i>&nbsp;<?php _e('Save', kopa_get_domain()); ?></button>
            </p>
<?php wp_nonce_field("kopa_save_layout_setting", "ajax_nonce"); ?>
            <input type="hidden" name="action" value="kopa_save_layout_setting">
        </form>
    </div>
</div>