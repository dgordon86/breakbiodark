<?php

define('KOPA_THEME_URL', 'http://kopatheme.com');
define('KOPA_THEME_NAME', 'Breakbio');
define('KOPA_DOMAIN', 'breakbio');
define('KOPA_OPT_PREFIX', 'breakbio_');
define('KOPA_UPDATE_TIMEOUT', 21600);
define('KOPA_UPDATE_URL', 'http://kopatheme.com/notifier/novelty.xml');
define('KOPA_INIT_VERSION', KOPA_DOMAIN . '-layout-setting-v2');


$kopaOptions = array();
$kopaDirs = array();
$kopaDirs[] = '/library/addon/';
$kopaDirs[] = '/library/classes/';
$kopaDirs[] = '/library/shortcodes/';
$kopaDirs[] = '/library/shortcodes/system/';
if (is_admin()) {
    $kopaDirs[] = '/library/classes/ui/';
    $kopaDirs[] = '/library/classes/ui/radio/';
    $kopaDirs[] = '/library/classes/ui/radio/list/';
    $kopaDirs[] = '/library/classes/ui/select/';
    $kopaDirs[] = '/library/classes/ui/text/';
    $kopaDirs[] = '/library/classes/ui/complex/';
    $kopaDirs[] = '/library/cpanel/theme-options/';
}
$kopaDirs[] = '/library/classes/widget/';
$kopaDirs[] = '/library/metaboxes/';
$kopaDirs[] = '/library/posttypes/';
$kopaDirs[] = '/library/widgets/';

require_once trailingslashit(get_template_directory()) . '/library/backend.php';
require_once trailingslashit(get_template_directory()) . '/library/ini.php';
require_once trailingslashit(get_template_directory()) . '/library/ajax.php';

foreach ($kopaDirs as $directory) {
    $path = get_template_directory() . $directory . '*.php';
    $files = glob($path);

    if ($files) {
        foreach ($files as $file) {
            require_once $file;
        }
    }
}

require_once trailingslashit(get_template_directory()) . '/library/shortcode.php';
require_once trailingslashit(get_template_directory()) . '/library/widget.php';
require_once trailingslashit(get_template_directory()) . '/library/frontend.php';
require_once trailingslashit(get_template_directory()) . '/library/customize.php';
