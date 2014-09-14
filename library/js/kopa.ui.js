var kopa_uploader;
var kopa_icon;
jQuery(function($) {
    // UPLOADER
    kopaUploaderInit();
    //COLOR PICKER     
    kopaColorInit();
    // MULTI-TEXT
    kopaMultiTextInit();
    jQuery('.color-swatches-item input:checked').parent().click();
});
var KopaUI = {
    select_colorSwatchesSingle: function(event, obj) {
        var primary = obj.attr('data-primary');
        if ('customize' !== primary) {
            jQuery('#kopa-group-custom_colors').hide();
            jQuery('#primary_color').iris('color', primary);
            jQuery('#link_color_hover').iris('color', primary);
            jQuery('#nav_link_hover_color').iris('color', primary);
        } else {
            jQuery('#kopa-group-custom_colors').show();
        }
    },
    open_iconList: function(event, obj) {
        event.preventDefault();
        KopaShortcode.load_shortcode_template('tmpl-kopa-icon-list', '&shortcode=icons');
        kopa_icon = obj.parent().find('.kopa-ui-icon');
    },
    select_icon: function(event, obj, icon) {
        event.preventDefault();
        if ('' !== icon) {
            kopa_icon.val(icon);
            kopa_icon.parent().find('.kopa-ui-icon-select').hide();
            kopa_icon.parent().find('.kopa-ui-icon-remove').show();
            preview = kopa_icon.parent().find('.kopa-ui-icon-preview');
            if (preview.length > 0) {
                preview.attr('class', '');
                preview.addClass('kopa-ui-icon-preview').addClass(icon);
            } else {
                var PREVIEW = jQuery("<i>", {class: "kopa-ui-icon-preview"});
                PREVIEW.addClass(icon);
                kopa_icon.parent().prepend(PREVIEW);
            }
        }
        jQuery.colorbox.close();
        jQuery('.kopa-ui-icon-list-wrap input').val('').keyup();
    },
    remove_icon: function(event, obj) {
        event.preventDefault();
        obj.hide();
        obj.parent().find('.kopa-ui-icon-preview').remove();
        obj.parent().find('.kopa-ui-icon').val('');
        obj.parent().find('.kopa-ui-icon-select').show();
    },
    filter_icon: function(event, obj) {
        var filter = obj.val();
        if (!filter) {
            jQuery(".kopa-ui-icon-item").show();
            return;
        }
        var regex = new RegExp(filter, "i");
        jQuery(".kopa-ui-icon-list-wrap .kopa-ui-icon-item span").each(function() {
            if (jQuery(this).text().search(regex) < 0) {
                jQuery(this).parents('.kopa-ui-icon-item').hide();
            } else {
                jQuery(this).parents('.kopa-ui-icon-item').show();
            }
        });
    },
    add_multitext: function(event, obj) {
        event.preventDefault();
        var li = obj.parents('li');
        var ul = obj.parents('ul');
        if (obj.hasClass('multi-text-add')) {
            clone = li.clone();
            clone.find("input[type=text]").val("").end();
            clone.find("input[type=hidden]").val(new KopaUtil().getRandomID('multi-text-index-')).end();
            li.after(clone);
        }
    },
    del_multitext: function(event, obj) {
        event.preventDefault();
        var answer = confirm(kopa_variable.i18n.theme_options.do_you_want_to_remove_this_custom_info);
        if (answer === true) {
            var li = obj.parents('li');
            var ul = obj.parents('ul');
            if (obj.hasClass('multi-text-del')) {
                if (ul.find('li').length > 1) {
                    li.remove();
                } else {
                    li.find("input[type=text]").val("").end();
                }
            }
        }
    },
    change_swatches: function(event, obj) {
        var primary = obj.attr('data-primary');
        var secondary = obj.attr('data-secondary');
        jQuery('#primary_color').iris('color', primary);
        jQuery('#link_color').iris('color', primary);
        jQuery('#secondary_color').iris('color', secondary);
        jQuery('#link_color_hover').iris('color', secondary);
    },
    config_gallery: function(event, button) {
        event.preventDefault();
        if (kopa_uploader) {
            kopa_uploader.open();
            return;
        }
        kopa_uploader = wp.media.frames.kopa_uploader = wp.media({
            title: kopa_variable.i18n.uploader.media_center,
            button: {
                text: kopa_variable.i18n.uploader.choose_image
            },
            library: {type: 'image'},
            multiple: true
        });
        kopa_uploader.on('open', function() {
            var ids = button.parents('.kopa-ui-gallery-wrap').find('input.kopa-ui-gallery').val();
            if ('' !== ids) {
                var selection = kopa_uploader.state().get('selection');
                ids = ids.split(',');
                ids.forEach(function(id) {
                    attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add(attachment ? [attachment] : []);
                });
            }
        });
        kopa_uploader.on('select', function() {
            var result = [];
            var selection = kopa_uploader.state().get('selection');
            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                result.push(attachment.id);
                console.log(attachment);
            });
            if (result.length > 0) {
                result = result.join(',');
                button.parents('.kopa-ui-gallery-wrap').find('.kopa-ui-gallery').val(result);
            }
        });
        kopa_uploader.open();
    }
};
function KopaUtil() {
    this.getRandomID = function getRandomID(prefix) {
        return prefix + Math.random().toString(36).substr(2);
    };
}
function kopaUploaderInit() {
    jQuery('.kopa-ui-media-wrap').on('click', '.kopa-ui-media-upload', function(event) {
        event.preventDefault();
        button = jQuery(this);
        if (kopa_uploader) {
            kopa_uploader.open();
            return;
        }
        kopa_uploader = wp.media.frames.kopa_uploader = wp.media({
            title: kopa_variable.i18n.uploader.media_center,
            button: {
                text: kopa_variable.i18n.uploader.choose_image
            },
            library: {type: 'image'},
            multiple: false
        });
        kopa_uploader.on('select', function() {
            attachment = kopa_uploader.state().get('selection').first().toJSON();
            button.addClass('ui-hide');
            button.parent().find('.kopa-ui-media').val(attachment.url);
            button.parent().find('img').attr('src', attachment.url).removeClass('ui-hide');
            button.parent().find('.kopa-ui-media-remove').removeClass('ui-hide');
            button.parent().addClass('has-image');
        });
        kopa_uploader.open();
    });
    jQuery('.kopa-ui-media-wrap').on('click', '.kopa-ui-media-remove', function(event) {
        event.preventDefault();
        button = jQuery(this);
        button.addClass('ui-hide');
        button.parent().find('.kopa-ui-media').val('');
        button.parent().find('img').attr('src', '').addClass('ui-hide');
        button.parent().removeClass('has-image');
        button.parent().find('.kopa-ui-media-upload').removeClass('ui-hide');
    });
}
function kopaColorInit() {
    var colours = jQuery('.kopa-ui-color');
    if (colours.length > 0) {
        jQuery.each(colours, function(index, item) {
            if (!jQuery(this).parents('#available-widgets').length > 0) {
                if (!jQuery(this).hasClass('wp-color-picker')) {
                    jQuery(this).wpColorPicker({
                        defaultColor: false,
                        change: function(event, ui) {
                        },
                        clear: function() {
                        },
                        hide: true,
                        palettes: true
                    });
                }
            }
        });
    }
}
function kopaMultiTextInit() {
    var kopaUIMultiText = jQuery(".kopa-ui-multi-text");
    if (kopaUIMultiText.length > 0) {
        kopaUIMultiText.sortable({
            handle: '.multi-text-drag',
            placeholder: 'multi-text-placeholder',
            tolerance: 'pointer'
        });
    }
}