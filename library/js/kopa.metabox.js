jQuery(document).ready(function($) {
    toggles = jQuery('.ckb_is_use_custom_thumbnail_toggle');
    if (toggles.length > 0) {
        jQuery.each(toggles, function() {
            KopaMetabox.isUseCustomThumbnailToggle(null, jQuery(this));
        });
    }
});
var KopaMetabox = {
    isUseCustomThumbnailToggle: function(event, obj) {
        var obj_wrap = obj.parents('.kopa-metabox-wrap');
        if (obj_wrap) {
            var custom_thumbs = obj_wrap.parent().find('.kopa-metabox-wrap').not(obj_wrap);
            if (obj.is(':checked')) {
                custom_thumbs.show();
            } else {
                custom_thumbs.hide();
            }
        }
    }
};