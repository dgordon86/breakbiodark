var kopaContainerType = 'tab';
var KopaShortcode = {
    load_shortcode_template: function(id, param) {
        var TMPL = jQuery('#' + id);
        if (TMPL.length > 0) {
            KopaShortcode.open_shortcode_lightbox(TMPL);
        } else {
            TMPL = jQuery("<div>", {id: id});
            TMPL.hide();
            jQuery('body').append(TMPL);
            jQuery.get(kopa_variable.ajax.shortcode_template + param, function(data) {
                TMPL.html(data);
                KopaShortcode.open_shortcode_lightbox(TMPL);
            });
        }
    },
    open_shortcode_lightbox: function(obj) {
        jQuery.colorbox({
            inline: true,
            innerWidth: '50%',
            innerHeight: 500,
            top: 50,
            maxWidth: '100%',
            overlayClose: false,
            href: '#' + obj.attr('id'),
            onLoad: function() {
                if ('tab' === kopaContainerType) {
                    jQuery('#' + obj.attr('id')).find('.kopa_shortcode_field_private').show();
                }
                obj.show();
            },
            onClosed: function() {
                obj.hide();
                if ('tab' === kopaContainerType) {
                    jQuery('#' + obj.attr('id')).find('.kopa_shortcode_field_private').hide();
                }
            }
        });
    },
    select_icon: function(event, obj, icon) {
        event.preventDefault();
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[icon class="' + icon + '"/]');
        jQuery.colorbox.close();
    },
    add_container_element: function(event, wrap) {
        event.preventDefault();
        var last_item = wrap.find('.kopa_shortcode_container_element').last();
        var clone = last_item.clone();
        clone.find('textarea').text('');
        clone.insertAfter(last_item);
        jQuery.colorbox.resize();
    },
    remove_container_element: function(event, obj) {
        event.preventDefault();
        var items = obj.parents('.kopa_shortcode_inline').find('.kopa_shortcode_container_element');
        if (items.length > 1) {
            obj.parents('.kopa_shortcode_container_element').remove();
        } else {
            items.find('textarea').val('');
        }
        jQuery.colorbox.resize();
    },
    create_button: function(event, type) {
        event.preventDefault();
        if ('button' === type) {
            var text = jQuery('.ks_button_text').val();
            var link = jQuery('.ks_button_link').val();
            var link_target = jQuery('.ks_button_link_target option:selected').val();
            var type = jQuery('.ks_button_type:checked').val();
            if ('' !== jQuery.trim(text)) {
                var shortcode = '[button class="' + type + '" link="' + link + '" target="' + link_target + '"]' + text + '[/button]';
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                jQuery.colorbox.close();
                jQuery('.ks_button_text').val('');
                jQuery('.ks_button_link').val('');
                jQuery('.ks_button_link_target option').first().attr('selected', 'selected');
                jQuery('.ks_button_type').first().attr('checked', 'checked');
            } else {
                alert('Please enter button text.');
            }
        } else if ('container' === type) {
            kopaContainerType = ('' !== kopaContainerType) ? kopaContainerType : 'tab';
            var elements = jQuery('.kopa_shortcode_container_element');
            var shortcode = '';
            var parent = '';
            var children = '';
            if ('tab' === kopaContainerType) {
                style = jQuery('.kopa_shortcode_tab_style option:selected').val();
                width = '';
                if ('vertical' === style) {
                    width = parseInt(jQuery('.kopa_shortcode_tab_title_width').val());
                    if (width > 0) {
                        width = 'width=' + width;
                    } else {
                        width = '';
                    }
                }
                parent += '[' + kopaContainerType + 's style=' + style + ' ' + width + ']<br/>';
            } else {
                parent += '[' + kopaContainerType + 's]<br/>';
            }
            jQuery.each(elements, function() {
                title = jQuery(this).find('.kopa_container_element_title').val();
                content = jQuery(this).find('.kopa_container_element_content').val();
                if ('' !== title && '' !== content) {
                    children += '[' + kopaContainerType + ' title="' + title + '"]<br/>';
                    children += content + '<br/>';
                    children += '[/' + kopaContainerType + ']<br/>';
                }
            });
            if ('' !== children) {
                shortcode += parent;
                shortcode += children;
                shortcode += '[/' + kopaContainerType + 's]<br/>';
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            }
            jQuery.colorbox.close();
        } else if ('testimonial' === type) {
            var id = jQuery('.ks_select_testimonial option:selected').val();
            if ('' !== id) {
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[testimonial id=' + id + '/]');
            }
            jQuery.colorbox.close();
        } else if ('testimonials' === type) {
            var number_of_testimonials = jQuery('.ks_text_number_of_testimonials').val();
            var jobs = jQuery('.ks_select_testimonial_jobs').val();
            var shortcode = '[testimonials';
            if ('' !== number_of_testimonials) {
                number_of_testimonials = parseInt(number_of_testimonials);
            } else {
                number_of_testimonials = -1;
            }
            if (jobs.length > 0) {
                jobs = jQuery.grep(jobs, function(n, i) {
                    return (n !== '' && n !== null);
                });
                if (jobs.length > 0) {
                    jobs = jobs.join(',');
                    shortcode += ' jobs="' + jobs + '" ';
                }
            }
            shortcode += ' limit=' + number_of_testimonials + '/]';
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            jQuery.colorbox.close();
        }
    }
};
