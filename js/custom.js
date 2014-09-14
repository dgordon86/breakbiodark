/*!
 * Kopa Custom for Novelty WP Theme
 * http://kopatheme.com/demo/novelty
 *
 * Copyright 2014, KopaTheme
 * Released under the MIT License.
 */

"use strict";
var map;
var addthis_config = {
    data_track_addressbar: false,
    data_track_clickback: false
};

jQuery(document).ready(function() {
    /*
     * ------------------------------------------------------------
     * OPEN VIDEO IN LIGHTBOX
     * ------------------------------------------------------------
     */
    var videos = jQuery('a.kss-icon-play');
    if (videos.length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery.magnific-popup.js',
                complete: function() {
                    videos.magnificPopup({
                        type: 'iframe',
                        showCloseBtn: true,
                        closeOnContentClick: false,
                        closeOnBgClick: false,
                        enableEscapeKey: false
                    });
                }
            }
        ]);
    }


    /*
     * ------------------------------------------------------------
     * REMOVE IMG (MISSING SRC PROPERTY)
     * ------------------------------------------------------------
     */
    jQuery('img').error(function() {
        var parent = jQuery(this).parent().prop("tagName");
        if ('A' === parent || a === parent) {
            parent.remove();
        } else {
            jQuery(this).remove();
        }
    });
    /*
     * ------------------------------------------------------------
     * SET VIEWS COUNT
     * ------------------------------------------------------------
     */
    if (kopa_variable.template.post_id > 0) {
        var element = jQuery('.singular-view-count');
        var icon = jQuery('.singular-view-count i').first();
        var icon_class = icon.attr('class');
        jQuery.ajax({
            type: 'POST',
            url: kopa_variable.url.ajax,
            dataType: 'json',
            async: true,
            timeout: 5000,
            data: {
                action: 'kopa_set_view_count',
                ajax_nonce: jQuery('#kopa_set_view_count_ajax_nonce').val(),
                post_id: kopa_variable.template.post_id
            },
            beforeSend: function(XMLHttpRequest, settings) {
                icon.attr('class', 'fa fa-refresh fa-spin');
            },
            complete: function(XMLHttpRequest, textStatus) {
                icon.attr('class', icon_class);
            },
            success: function(data) {
                var count = parseInt(data.count);
                if (count > 0) {
                    element.find('span').text(count + ' ' + data.suffix);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
    /*
     * ------------------------------------------------------------
     * ADD THIS
     * ------------------------------------------------------------
     */
    if (jQuery('.addthis_button_compact').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/addthis_widget.js',
                complete: function() {
                    addthis.layers();
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     *  MENU SUPERFISH
     * ------------------------------------------------------------
     */
    Modernizr.load([
        {
            load: kopa_variable.url.template_directory_uri + '/js/superfish.js',
            complete: function() {
                // menu second
                jQuery('.menu-second.sf-menu').superfish({
                    cssArrows: false
                });
                // menu primary
                jQuery('.primary-menu.sf-menu').superfish({});
            }
        }
    ]);
    /*
     * ------------------------------------------------------------
     * MOBILE MENU
     * ------------------------------------------------------------
     */
    Modernizr.load([
        {
            load: kopa_variable.url.template_directory_uri + '/js/jquery.navgoco.js',
            complete: function() {
                // menu second
                jQuery('.menu-second.nav').navgoco({accordion: true});
                jQuery("#page-header .header-top .container > span").click(function() {
                    jQuery(".menu-second.nav").slideToggle("slow");
                });
                // menu primary
                jQuery('.menu-primary-mobile.nav').navgoco({accordion: true});
                jQuery(".primary-menu-mobile-button").click(function() {
                    jQuery(".menu-primary-mobile").slideToggle("slow");
                });
            }
        }
    ]);
    /*
     * ------------------------------------------------------------
     * GOOGLE MAP
     * ------------------------------------------------------------
     */
    var gmap = null;
    var maps = jQuery('.kp-map');
    if (maps.length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/gmaps.js',
                complete: function() {
                    jQuery.each(maps, function(index, item) {
                        var map = jQuery(this);
                        var lat = parseFloat(map.attr('data-latitude'));
                        var lng = parseFloat(map.attr('data-longitude'));
                        gmap = new GMaps({
                            el: '#kp-map',
                            lat: lat,
                            lng: lng,
                            zoomControl: true,
                            zoomControlOpt: {
                                style: 'SMALL',
                                position: 'TOP_LEFT'
                            },
                            panControl: true,
                            streetViewControl: true,
                            mapTypeControl: true,
                            overviewMapControl: true
                        });
                        var marker_info = {
                            lat: lat,
                            lng: lng
                        };
                        if ('' !== kopa_variable.contact.marker) {
                            marker_info.icon = kopa_variable.contact.marker;
                        }
                        gmap.addMarker(marker_info);
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * CONTACT FORM
     * ------------------------------------------------------------
     */
    if (jQuery(".contact-form").length > 0) {
        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + '/js/jquery.validate.js'],
                complete: function() {
                    if (jQuery("#contact-form").length > 0) {
                        var i18n = kopa_variable.i18n.validate;
                        jQuery('#contact-form').validate({
                            rules: {
                                contact_name: {
                                    required: true,
                                    minlength: 2
                                },
                                contact_email: {
                                    required: true,
                                    email: true
                                },
                                contact_message: {
                                    required: true,
                                    minlength: 10
                                }
                            },
                            messages: {
                                contact_name: {
                                    required: i18n.name.REQUIRED,
                                    minlength: jQuery.format(i18n.name.MINLENGTH)
                                },
                                contact_email: {
                                    required: i18n.email.REQUIRED,
                                    email: i18n.email.EMAIL
                                },
                                contact_message: {
                                    required: i18n.message.REQUIRED,
                                    minlength: jQuery.format(i18n.message.MINLENGTH)
                                }
                            },
                            submitHandler: function(form) {
                                var recaptcha_response = jQuery('#contact-form').find("[name=recaptcha_response_field]");
                                if (kopa_variable.recaptcha.status) {
                                    if (undefined !== recaptcha_response && '' !== jQuery.trim(recaptcha_response.val())) {
                                        var recaptcha_challenge = jQuery('#contact-form').find("[name=recaptcha_challenge_field]");
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: kopa_variable.url.ajax,
                                            dataType: 'json',
                                            async: true,
                                            data: {
                                                action: 'kopa_check_recaptcha',
                                                ajax_nonce_recaptcha: jQuery('#ajax_nonce_recaptcha').val(),
                                                recaptcha_challenge: recaptcha_challenge.val(),
                                                recaptcha_response: recaptcha_response.val()
                                            },
                                            beforeSend: function(XMLHttpRequest, settings) {
                                                jQuery('#contact_response').html('');
                                                jQuery("#submit-contact").attr("value", i18n.form.CHECKING).attr('disabled', 'disabled');
                                            },
                                            complete: function(XMLHttpRequest, textStatus) {
                                            },
                                            success: function(data) {
                                                if (data.is_valid) {
                                                    jQuery(form).ajaxSubmit({
                                                        beforeSubmit: function(arr, $form, options) {
                                                            jQuery("#submit-contact").attr("value", i18n.form.SENDING);
                                                            jQuery('#contact_response').html('');
                                                        },
                                                        success: function(responseText, statusText, xhr, $form) {
                                                            jQuery("#contact_response").html(responseText).hide().slideDown("fast");
                                                            jQuery(form).find('[name=contact_name]').val('');
                                                            jQuery(form).find('[name=contact_email]').val('');
                                                            jQuery(form).find('[name=contact_message]').val('');
                                                            jQuery("#submit-contact").val(i18n.form.SUBMIT).removeAttr('disabled');
                                                        }
                                                    });
                                                }
                                                else {
                                                    jQuery('#contact_response').html('<p class="failure">' + i18n.recaptcha.INVALID + '</p>');
                                                    jQuery("#submit-contact").val(i18n.form.SUBMIT).removeAttr('disabled');
                                                }
                                                Recaptcha.reload();
                                                recaptcha_response.val('');
                                            },
                                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            }
                                        });
                                    } else {
                                        jQuery('#contact_response').html('<p class="failure">' + i18n.recaptcha.REQUIRED + '</p>');
                                    }
                                } else {
                                    jQuery(form).ajaxSubmit({
                                        success: function(responseText, statusText, xhr, $form) {
                                            jQuery("#submit-contact").attr("value", i18n.form.SENDING).attr('disabled', 'disabled');
                                            jQuery("#contact_response").html(responseText).hide().slideDown("fast");
                                            jQuery("#submit-contact").attr("value", i18n.form.SUBMIT);
                                            jQuery(form).find('[name=contact_name]').val('');
                                            jQuery(form).find('[name=contact_email]').val('');
                                            jQuery(form).find('[name=contact_url]').val('');
                                            jQuery(form).find('[name=contact_message]').val('');
                                            jQuery("#submit-contact").val(i18n.form.SUBMIT).removeAttr('disabled');
                                        }
                                    });
                                }
                                return false;
                            }
                        });
                    }
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * VIDEO WRAPPER
     * ------------------------------------------------------------
     */
    if (jQuery(".video-wrapper").length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery.fitvids.js',
                complete: function() {
                    jQuery(".video-wrapper").fitVids();
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * ACCORDION
     * ------------------------------------------------------------
     */
    if (jQuery('.kp-accordion').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery-ui.js',
                complete: function() {
                    jQuery(".kp-accordion").accordion({
                        collapsible: true,
                        heightStyle: "content",
                        icons: false,
                        resize: function() {
                            jQuery("kp-accordion").accordion("refresh");
                        }
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * TOOLTIP
     * ------------------------------------------------------------
     */
    if (jQuery('.share-link').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery-ui.js',
                complete: function() {
                    jQuery('.share-link').tooltip({
                        tooltipClass: "kp-tooltip"
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * TABS
     * ------------------------------------------------------------
     */
    if (jQuery('.tab-horizontal').length > 0 || jQuery('.tab-vertical').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery-ui.js',
                complete: function() {
                    jQuery(".tab-horizontal").tabs();
                    jQuery(".tab-vertical").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
                    jQuery(".tab-vertical").removeClass("ui-corner-top").addClass("ui-corner-left");
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * BREAKING NEWS
     * ------------------------------------------------------------
     */
    if (jQuery('.breaking-news').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery.caroufredsel.js',
                complete: function() {
                    var _scroll = {
                        delay: 1000,
                        easing: 'linear',
                        items: 1,
                        duration: 0.07,
                        timeoutDuration: 0,
                        pauseOnHover: 'immediate'
                    };
                    jQuery('.caroufredsel_wrapper .ticker').carouFredSel({
                        width: 1000,
                        align: false,
                        items: {
                            width: 'variable',
                            height: 40,
                            visible: 1
                        },
                        scroll: _scroll
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * WIDGET : FEATURE SLIDER
     * ------------------------------------------------------------
     */
    if (jQuery(".widget-feature-slider").length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery(".widget-feature-slider .owl-carousel").owlCarousel({
                        singleItem: true,
                        pagination: false,
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span><i class="fa fa-angle-left"></i></span>', '<span><i class="fa fa-angle-right"></i></span>']
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * WIDGET :  FEATURE NEWS SLIDER
     * ------------------------------------------------------------
     */
    if (jQuery(".widget-feature-news-slider").length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery(".widget-feature-news-slider .owl-carousel").owlCarousel({
                        singleItem: true,
                        pagination: false,
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span><i class="fa fa-angle-left"></i></span>', '<span><i class="fa fa-angle-right"></i></span>']
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * WIDGET LIST VIDEO
     * ------------------------------------------------------------
     */
    if (jQuery(".widget-list-video").length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery(".widget-list-video .owl-carousel").owlCarousel({
                        pagination: false,
                        items: 3,
                        itemsDesktopSmall: [1023, 3],
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                    });
                    var check_width = jQuery('body').width();
                    if (check_width >= 1024) {
                        // hover caption
                        jQuery('.widget-list-video .item').hover(function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                bottom: '0'
                            }, 400);
                            jQuery(this).find('.mask').fadeOut('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '1'
                            }, 400);
                        }, function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                bottom: '-100%'
                            }, 400);
                            jQuery(this).find('.mask').fadeIn('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '0'
                            }, 400);
                        });
                    }
                    ;
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * FEATURE POST
     * ------------------------------------------------------------
     */
    if (jQuery('.feature-post').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery('.feature-post .owl-carousel').owlCarousel({
                        pagination: false,
                        items: 4,
                        itemsTablet: [799, 3],
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                    });
                    var check_width = jQuery('body').width();
                    if (check_width >= 1024) {
                        // hover caption
                        jQuery('.feature-post-owl .item').hover(function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                top: '0'
                            }, 400);
                            jQuery(this).find('.mask').fadeOut('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '1'
                            }, 400);
                        }, function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                top: '135px'
                            }, 400);
                            jQuery(this).find('.mask').fadeIn('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '0'
                            }, 400);
                        });
                    }
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * OWL SERVICES
     * ------------------------------------------------------------
     */
    if (jQuery(".owl-service").length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery(".owl-service .owl-carousel").owlCarousel({
                        pagination: false,
                        items: 3,
                        itemsDesktopSmall: [1080, 3],
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * LATEST POST REVIEW
     * ------------------------------------------------------------
     */
    if (jQuery('.last-post-review').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery(".last-post-review .owl-carousel").owlCarousel({
                        pagination: false,
                        items: 3,
                        itemsDesktopSmall: [1080, 3],
                        itemsTablet: [799, 3],
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                    });
                    var check_width = jQuery('body').width();
                    if (check_width >= 1024) {
                        // hover caption
                        jQuery('.last-post-review .item').hover(function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                top: '0'
                            }, 400);
                            jQuery(this).find('.mask').fadeOut('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '1'
                            }, 400);
                        }, function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                top: '115px'
                            }, 400);
                            jQuery(this).find('.mask').fadeIn('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '0'
                            }, 400);
                        });
                    }
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * RELATED ARTICLE
     * ------------------------------------------------------------
     */
    if (jQuery('.sub-page.site-1').length > 0) {
        if (jQuery(".related-article").length > 0) {
            Modernizr.load([
                {
                    load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                    complete: function() {
                        jQuery(".related-article .owl-carousel").owlCarousel({
                            pagination: false,
                            items: 3,
                            itemsDesktopSmall: [1080, 3],
                            itemsTablet: [799, 3],
                            itemsMobile: [599, 2],
                            navigation: true,
                            slideSpeed: 700,
                            navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                        });
                    }
                }
            ]);
        }
    } else {
        if (jQuery(".related-article").length > 0) {
            Modernizr.load([
                {
                    load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                    complete: function() {
                        jQuery(".related-article .owl-carousel").owlCarousel({
                            pagination: false,
                            items: 2,
                            itemsDesktopSmall: [1080, 2],
                            navigation: true,
                            slideSpeed: 700,
                            navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                        });
                    }
                }
            ]);
        }
    }
    /*
     * ------------------------------------------------------------
     * WIDGET : FEATURE IMAGES
     * ------------------------------------------------------------
     */
    if (jQuery(".widget-feature-images").length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery(".widget-feature-images .owl-carousel").owlCarousel({
                        pagination: true,
                        singleItem: true,
                        slideSpeed: 700
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * GALERY MINI
     * ------------------------------------------------------------
     */
    if (jQuery('.kopa-minimal-gallery').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    jQuery('.kopa-minimal-gallery').owlCarousel({
                        pagination: false,
                        singleItem: true,
                        slideSpeed: 700,
                        navigation: true,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>']
                    });
                }
            }
        ]);
    }
    // parallax
    /*
     * ------------------------------------------------------------
     * 
     * ------------------------------------------------------------
     */
    if (jQuery('.parallax').length > 0) {
        var $window = jQuery(window);
        var check_width = jQuery('body').width();
        if (check_width >= 1024) {
            jQuery('.parallax').each(function() {
                var $bgobj = jQuery(this);
                $window.scroll(function() {
                    var yPos = -($window.scrollTop() / $bgobj.data('speed'));
                    var coords = '50% ' + yPos + 'px';
                    $bgobj.css({
                        backgroundPosition: coords
                    });
                });
            });
        }
        if (check_width <= 1023) {
            jQuery('.parallax').removeClass('parallax');
        }
    }
    /*
     * ------------------------------------------------------------
     * GET LASTEST PHOTOS FROM FLICKR.COM BY USER-ID
     * ------------------------------------------------------------
     */
    var flickrs = jQuery('.flickr-wrap');
    if (flickrs.length > 0) {
        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + '/js/jflickrfeed.js',
                    kopa_variable.url.template_directory_uri + '/js/imgliquid.js'],
                complete: function() {
                    jQuery.each(flickrs, function(index, item) {
                        var limit = parseInt(jQuery(this).attr('data-limit'))
                        jQuery(this).find('ul').jflickrfeed({
                            qstrings: {
                                id: jQuery(this).attr('data-id')
                            },
                            limit: (limit > 0) ? limit : 20,
                            itemTemplate:
                                    '<li class="flickr-badge-image">' +
                                    '<a target="_blank" href="{{link}}" class="kopa-tool-tip imgLiquid" title="{{title}}">' +
                                    '<img src="{{image_m}}" class="img-responsive">' +
                                    '</a>' +
                                    '</li>'
                        }, function(data) {
                            jQuery(this).find('.imgLiquid').imgLiquid();
                        });
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * GET LATEST TWEETS
     * ------------------------------------------------------------
     */


    /*
     * ------------------------------------------------------------
     * POSTS AJAX FILTER + LOAD MORE
     * ------------------------------------------------------------
     */
    if (jQuery('.widget-latest-article').length > 0) {
        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + '/js/imagesloaded.js'],
                complete: function() {
                    var containers = jQuery('.widget-latest-article .section-content');
                    jQuery.each(containers, function(index, item) {
                        if (jQuery(item).is(":visible")) {
                            jQuery(item).find('.kp-isotope').imagesLoaded(function() {
                                jQuery(item).find('.kp-isotope').masonry({
                                    itemSelector: '.item'
                                });
                            });
                        }
                    });
                    jQuery('.kplaf_filter_name').on('click', function(event) {
                        event.preventDefault();
                        var caption = jQuery(this);
                        var li = caption.parents('li');
                        if (!li.hasClass('active')) {
                            var section = jQuery(jQuery(this).attr('href'));
                            var widget = jQuery(this).parents('.widget.kopa_posts_list_ajax_filter');
                            var type = section.attr('data-type');
                            caption.parents('.filter-isotope').find('li.active').removeClass('active');
                            li.addClass('active');
                            section.parents('.widget-content').find('.section-content').hide();
                            section.show();
                            section.find('.kp-isotope').masonry({
                                itemSelector: '.item'
                            });
                        }
                    });
                    jQuery('.kplaf_load_more').on('click', function(event) {
                        var button = jQuery(this);
                        var widget = button.parents('.widget.kopa_posts_list_ajax_filter');
                        var section = widget.find('.section-content:visible').first();
                        var current_paged = parseInt(section.attr('data-paged'));
                        var type = section.attr('data-type');
                        if (!button.hasClass('ajax_processing')) {
                            jQuery.ajax({
                                type: 'POST',
                                url: kopa_variable.url.ajax,
                                dataType: 'html',
                                data: {
                                    action: "kplaf_load_contents",
                                    ajax_nonce: jQuery('#kplaf_load_contents').val(),
                                    widget_id: widget.attr('id'),
                                    paged: current_paged + 1,
                                    type: type
                                },
                                beforeSend: function() {
                                    button.addClass('ajax_processing');
                                    button.find('span').html('<i class="fa fa-spinner fa-spin"></i>' + kopa_variable.i18n.LOADING);
                                },
                                success: function(data) {
                                    if (data) {
                                        var newItems = jQuery(data);
                                        newItems.imagesLoaded(function() {
                                            section.find('.kp-isotope').append(newItems).masonry('appended', newItems, true);
                                        });
                                        section.attr('data-paged', current_paged + 1);
                                    }
                                },
                                complete: function(data) {
                                    button.removeClass('ajax_processing');
                                    button.find('span').html('<i class="fa fa-spinner"></i>' + kopa_variable.i18n.LOAD_MORE);
                                },
                                error: function(errorThrown) {
                                }
                            });
                        }
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * POSTS BLOG 2
     * ------------------------------------------------------------
     */
    var blog2_items = jQuery('body.kopa-layout-blog-page-2 #main-content .list-post-cat-item');
    if (blog2_items.length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/imagesloaded.js',
                complete: function() {
                    blog2_items.imagesLoaded(function() {
                        blog2_items.masonry({
                            itemSelector: '.post'
                        });
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * CSS HACK
     * ------------------------------------------------------------
     */
    if (jQuery('.widget-most-review').length > 0) {
        jQuery('.widget-most-review li').each(function(index) {
            jQuery(this).addClass('index' + index);
        });
    }
    /*
     * ------------------------------------------------------------
     * MENU STICKY
     * ------------------------------------------------------------
     */
    if (jQuery('.index-4 .main-menu').length > 0) {
        var check_width = jQuery('body').width();
        if (check_width >= 900) {
            var stickyHeaderTop = jQuery('.index-4 .main-menu').offset().top;
            jQuery(window).scroll(function() {
                if (jQuery(window).scrollTop() > stickyHeaderTop) {
                    jQuery('.index-4 .main-menu').css({
                        position: 'fixed',
                        top: '0px'
                    });
                } else {
                    jQuery('.index-4 .main-menu').css({
                        position: 'static',
                        top: '0px'
                    });
                }
            });
        }
    }
    /*
     * ------------------------------------------------------------
     * SCROLL BAR - WIDGET RANDOM
     * ------------------------------------------------------------
     */
    if (jQuery('.widget-random').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/perfect-scrollbar.js',
                complete: function() {
                    var $this = jQuery('.widget-random .container li')
                    var num_item = $this.length;
                    var total_width = num_item * ($this.width() + 20);
                    jQuery('.widget-random .container ul').css('width', total_width + 'px');
                    var check_width = jQuery('body').width();
                    if (check_width >= 1024) {
                        // hover caption
                        jQuery('.widget-random .item').hover(function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                top: '0'
                            }, 400);
                            jQuery(this).find('.mask').fadeOut('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '1'
                            }, 400);
                        }, function() {
                            jQuery(this).find('.kp-caption').stop(true).animate({
                                top: '102px'
                            }, 400);
                            jQuery(this).find('.mask').fadeIn('500');
                            jQuery(this).find('.mask-2').animate({
                                opacity: '0'
                            }, 400);
                        });
                    }
                    if (jQuery('.widget-random .container > ul').width() > jQuery('.widget-random .container').width()) {
                        jQuery('.widget-random .container').perfectScrollbar({
                            wheelSpeed: 20,
                            wheelPropagation: false,
                            suppressScrollY: true
                        });
                    }
                    ;
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * SYNCED OWLS
     * ------------------------------------------------------------
     */
    var sync1 = jQuery(".sync1");
    var sync2 = jQuery(".sync2");
    if (jQuery('.widget-testi-1').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    sync1.owlCarousel({
                        singleItem: true,
                        slideSpeed: 700,
                        navigation: true,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
                        pagination: false,
                        afterAction: syncPosition,
                        responsiveRefreshRate: 200,
                    });
                    sync2.owlCarousel({
                        items: 7,
                        itemsDesktop: [1199, 7],
                        itemsDesktopSmall: [979, 7],
                        itemsTablet: [799, 6],
                        itemsMobile: [599, 3],
                        slideSpeed: 700,
                        pagination: false,
                        responsiveRefreshRate: 100,
                        afterInit: function(el) {
                            el.find(".owl-item").eq(3).addClass("synced");
                        }
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * GALLERY SHORTCODE
     * ------------------------------------------------------------
     */
    if (jQuery('.widget-gallery').length > 0) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/owl.carousel.js',
                complete: function() {
                    sync1.owlCarousel({
                        singleItem: true,
                        slideSpeed: 700,
                        navigation: true,
                        navigationText: ['<span ><i class="fa fa-angle-left"></i></span>', '<span><i class="fa fa-angle-right"></i></span>'],
                        pagination: false,
                        afterAction: syncPosition,
                        responsiveRefreshRate: 200,
                    });
                    sync2.owlCarousel({
                        items: 4,
                        itemsDesktop: [1199, 4],
                        itemsDesktopSmall: [979, 4],
                        itemsTablet: [768, 4],
                        itemsMobile: [599, 2],
                        pagination: false,
                        slideSpeed: 700,
                        responsiveRefreshRate: 100,
                        afterInit: function(el) {
                            el.find(".owl-item").eq(0).addClass("synced");
                        }
                    });
                }
            }
        ]);
    }
    function syncPosition(el) {
        var current = this.currentItem;
        sync2.find(".owl-item").removeClass("synced").eq(current).addClass("synced")
        if (sync2.data("owlCarousel") !== undefined) {
            center(current)
        }
    }
    sync2.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = jQuery(this).data("owlItem");
        sync1.trigger("owl.goTo", number);
    });
    function center(number) {
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for (var i in sync2visible) {
            if (num === sync2visible[i]) {
                var found = true;
            }
        }
        if (found === false) {
            if (num > sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", num - sync2visible.length + 2)
            } else {
                if (num - 1 === -1) {
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if (num === sync2visible[sync2visible.length - 1]) {
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if (num === sync2visible[0]) {
            sync2.trigger("owl.goTo", num - 1)
        }
    }
    /*
     * ------------------------------------------------------------
     * WIDGET OWL SLIDER
     * ------------------------------------------------------------
     */
    if (jQuery('.kopa_owl_slider').length > 0) {
        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + '/js/owl.carousel.js'],
                complete: function() {
                    var obj = jQuery('.kopa_owl_slider .owl-slider-col-center .owl-carousel');
                    obj.owlCarousel({
                        singleItem: true,
                        pagination: false,
                        navigation: true,
                        paginationSpeed: 200,
                        slideSpeed: 1000,
                        transitionStyle: obj.attr('data-transition'),
                        navigationText: [
                            '<span class="fa fa-angle-left"></span>',
                            '<span class="fa fa-angle-right"></span>'
                        ],
                        afterAction: function(el) {
                            var current = this.currentItem;
                            var obj_sync = el.parents('.widget-content').find('.owl-slider-col-right .owl-carousel');
                            var pagination_sync = el.parents('.widget-content').find('.owl-slider-col-left');
                            obj_sync.find(".owl-item").removeClass("synced").eq(current).addClass("synced");
                            pagination_sync.find(".owl-slider-navigation-post-title").removeClass("active").eq(current).addClass("active");
                            if (obj_sync.data("owlCarousel") !== undefined) {
                                window.setTimeout(function() {
                                    obj_sync.trigger("owl.goTo", current);
                                }, 500);
                            }
                        }
                    });
                    jQuery('.kopa_owl_slider .owl-slider-col-right .owl-carousel').owlCarousel({
                        singleItem: true,
                        pagination: false,
                        navigation: false,
                        mouseDrag: false,
                        touchDrag: false,
                        slideSpeed: 500
                    });
                    jQuery('.kopa_owl_slider .owl-slider-col-left .owl-slider-navigation-post-title').click(function() {
                        if (!jQuery(this).hasClass('active')) {
                            jQuery(this).parent().find('.owl-slider-navigation-post-title').removeClass('active');
                            var current = parseInt(jQuery(this).attr('data-index'));
                            var obj_sync = jQuery(this).parents('.widget-content').find('.owl-slider-col-center .owl-carousel');
                            obj_sync.find(".owl-item").removeClass("synced").eq(current).addClass("synced");
                            if (obj_sync.data("owlCarousel") !== undefined) {
                                obj_sync.trigger("owl.goTo", current);
                            }
                        }
                    });
                }
            }
        ]);
    }
    /*
     * ------------------------------------------------------------
     * WIDGET FLUID SLIDER
     * ------------------------------------------------------------
     */
    if (jQuery(".widget-big-carousel").length > 0) {
        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + '/js/owl.carousel.js'],
                complete: function() {
                    var first_el = jQuery(".widget-big-carousel .owl-carousel .item").first().clone();
                    var last_el = jQuery(".widget-big-carousel .owl-carousel .item").last().clone();
                    jQuery(".widget-big-carousel .owl-carousel").prepend(last_el).append(first_el);
                    jQuery(".widget-big-carousel .owl-carousel").owlCarousel({
                        pagination: false,
                        items: 3,
                        itemsDesktop: [1180, 3],
                        itemsDesktopSmall: [979, 3],
                        itemsTablet: [799, 3],
                        itemsTabletSmall: [767, 1],
                        addClassActive: true,
                        navigation: true,
                        slideSpeed: 700,
                        navigationText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
                        afterInit: function() {
                            jQuery(".widget-big-carousel .owl-carousel .owl-item.active:eq(1)").addClass('second');
                        },
                        afterAction: function() {
                            jQuery(".widget-big-carousel .owl-carousel .owl-item").removeClass('second');
                            jQuery(".widget-big-carousel .owl-carousel .owl-item.active:eq(1)").addClass('second');
                        }
                    });
                }
            }
        ]);
    }
    ;
});
/*
 * ------------------------------------------------------------
 * CLICK LIKE BUTTON
 * ------------------------------------------------------------
 */
var KopaFrontend = {
    click_likes_button: function(event, obj, post_id, include_text) {
        event.preventDefault();
        if (!obj.hasClass('inprocess')) {
            var icon = obj.find('i').first();
            var icon_class = icon.attr('class');
            jQuery.ajax({
                type: 'POST',
                url: kopa_variable.url.ajax,
                dataType: 'json',
                async: true,
                timeout: 5000,
                data: {
                    action: 'kopa_click_like_button',
                    ajax_nonce: jQuery('#kopa_click_like_button_ajax_nonce').val(),
                    post_id: post_id,
                    include_text: include_text,
                    status: obj.hasClass('kopa-button-likes-enable') ? 'enable' : 'disable'
                },
                beforeSend: function(XMLHttpRequest, settings) {
                    obj.addClass('inprocess');
                    icon.attr('class', 'fa fa-refresh fa-spin');
                },
                complete: function(XMLHttpRequest, textStatus) {
                    icon.attr('class', icon_class);
                    obj.removeClass('inprocess');
                },
                success: function(data) {
                    obj.find('span').first().text(data.total);
                    obj.attr('class', data.class);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    }
};
/*
 * ------------------------------------------------------------
 * TIMELINE
 * ------------------------------------------------------------
 */
var KopaTimeline = {
    load: function(event, obj) {
        event.preventDefault();
        if (!obj.hasClass('inprocess')) {
            var year = obj.attr('data-year');
            var month = obj.attr('data-month');
            var paged = parseInt(obj.attr('data-paged')) + 1;
            var container = obj.parents('.kp-isotope');
            jQuery.ajax({
                type: 'POST',
                url: kopa_variable.url.ajax,
                dataType: 'html',
                async: true,
                timeout: 5000,
                data: {
                    action: 'kopa_load_timeline_posts',
                    ajax_nonce: jQuery('#kopa_load_timeline_posts_ajax_nonce').val(),
                    year: year,
                    month: month,
                    paged: paged
                },
                beforeSend: function(XMLHttpRequest, settings) {
                    obj.addClass('inprocess');
                    obj.find('i').attr('class', 'fa fa-spinner fa-spin');
                    jQuery('#kopa_overlay_loader').show();
                },
                complete: function(XMLHttpRequest, textStatus) {
                    obj.removeClass('inprocess');
                    obj.find('i').attr('class', 'fa fa-spinner');
                    jQuery('#kopa_overlay_loader').hide();
                },
                success: function(data) {
                    if ('' !== jQuery.trim(data)) {
                        obj.attr('data-paged', paged);
                        container.find('.isotope-content').append(data);
                        obj.parent().show();
                    } else {
                        obj.parent().remove();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    },
    change_month: function(event, obj, container) {
        event.preventDefault();

        jQuery('.kopa-timeline-month').removeClass('active');
        obj.parents('li').addClass('active');

        jQuery('.kp-isotope.show').removeClass('show').addClass('hidden');
        jQuery(container).addClass('show').removeClass('hidden');
        if (0 === jQuery(container).find('.isotope-content .item').length) {
            var load_button = jQuery(container).find('.load-more > span');
            if (load_button.length > 0) {
                load_button.click();
            }
        }

    },
    change_year: function(event, obj) {
        event.preventDefault();


        var wrap = obj.parents('.filter-isotope');
        var current_year = wrap.find('.kp-year.show');
        //collapse current year block
        current_year.removeClass('show');
        //hide month of current year
        current_year.find('ul').removeClass('show').addClass('hidden');
        //show new year                        
        obj.parent().addClass('show').one('transitionend webkitTransitionEnd oTransitionEnd otransitionend', function() {
            obj.next().removeClass('hidden').addClass('show');
            obj.next().find('li > a').first().click();
        });

    }
};
/*
 * ------------------------------------------------------------
 * IMAGE LIGHTBOX
 * ------------------------------------------------------------
 */
var KopaLightbox = {
    open_image: function(image_src) {
        Modernizr.load([
            {
                load: kopa_variable.url.template_directory_uri + '/js/jquery.magnific-popup.js',
                complete: function() {
                    jQuery.magnificPopup.open({
                        items: {
                            src: image_src
                        },
                        type: 'image'
                    });
                }
            }
        ]);
    }
};