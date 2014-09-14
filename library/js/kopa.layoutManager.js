jQuery(document).ready(function() {
    toggles = jQuery('.ckb_is_use_custom_layout_toggle');
    if (toggles.length > 0) {
        jQuery.each(toggles, function() {
            KopaLayout.isUseCustomLayoutToggle(null, jQuery(this));
        });
    }
    if (jQuery('form#frm-kopa-layout-manage').length > 0) {
        jQuery('form#frm-kopa-layout-manage').ajaxForm({
            url: kopa_variable.AjaxUrl,
            dataType: 'json',
            clearForm: false,
            resetForm: false,
            type: 'post',
            beforeSerialize: function($form, options) {
            },
            beforeSubmit: function(formData, jqForm, options) {
                jQuery('#kopa-cpanel-wrapper').css('opacity', 0.3);
                jQuery('#kopa-loading-gif').show();
            },
            success: function(responseText, statusText, xhr, $form) {
                jQuery('#kopa-cpanel-wrapper').css('opacity', 1);
                jQuery('#kopa-loading-gif').hide();
            }
        });
    }
});
var KopaLayout = {
    onChange: function(event, obj) {
        var value = obj.find(":selected").val();
        var wrap = obj.parents('.layout-manage-wrap');
        var current_sidebars_wrap = wrap.find('.row-sidebars-active');
        var current_thumb = wrap.find('.layout-thumb-active');
        var new_sidebars_wrap = wrap.find('.row-sidebars-for-layout-' + value);
        var new_thumb = wrap.find('.thumb-for-layout-' + value);
        if (!current_sidebars_wrap.hasClass('row-sidebars-for-layout-' + value)) {
            current_sidebars_wrap.removeClass('row-sidebars-active').addClass('row-sidebars-deactive');
            new_sidebars_wrap.addClass('row-sidebars-active').removeClass('row-sidebars-deactive');
            current_thumb.removeClass('layout-thumb-active').addClass('layout-thumb-deactive');
            new_thumb.addClass('layout-thumb-active').removeClass('layout-thumb-deactive');
        }
    },
    isUseCustomLayoutToggle: function(event, obj) {
        var obj_wrap = obj.parents('.kopa-metabox-wrap');
        if (0 === obj_wrap.length) {
            obj_wrap = obj.parents('tr.form-field');
        }
        if (obj_wrap) {
            var next_wrap = obj_wrap.next();
            if (obj.is(':checked')) {
                next_wrap.show();
            } else {
                next_wrap.hide();
            }
        }
    }
};