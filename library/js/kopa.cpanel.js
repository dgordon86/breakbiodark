jQuery(document).ready(function() {
    jQuery("a.kopa-tab-link").click(function(event) {
        event.preventDefault();
        if (!jQuery(this).hasClass('active')) {
            jQuery('.kopa-tab.tab_active').removeClass('tab_active').addClass('tab_deactive');
            jQuery(jQuery(this).attr('href')).removeClass('tab_deactive').addClass('tab_active');
            jQuery('a.kopa-tab-link.active').removeClass('active');
            jQuery(this).addClass('active');
        }
    });
});
