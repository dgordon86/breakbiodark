<?php
add_action('widgets_init', 'kopa_widgets_init');
/**
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0         
 */
function kopa_widgets_init() {
    $widgets = array(
        'KopaPostsList_BigIMG',
        'KopaPostsList_MediumIMG',
        'KopaPostsList_WithoutIMG',
        'KopaPostsList_AjaxFilter',
        'KopaPostsList_SmallThumb',        
        'KopaPostsList_CarouselTwoCols',
        'KopaPostsList_CarouselThumb',
        'KopaPostsList_CarouselSingle',
        'KopaPostsList_CarouselScroll',        
        'KopaPostsList_MostReviews',
        'KopaRecentComments',
    );
    #SLIDER
    $widgets[] = 'KopaSliderText';   
    $widgets[] = 'KopaSliderSteel';   
    $widgets[] = 'KopaSliderFluid';   
    
    #SOCIALS
    $widgets[] = 'KopaFlickr';
    $widgets[] = 'KopaTwitter';
    #OTHER
    $widgets[] = 'KopaAdvertisement';
    $widgets[] = 'KopaNewsletter'; 
    $widgets[] = 'KopaContactInformation'; 
        
    $widgets = apply_filters('kopa_widgets_init', $widgets);
    if (!empty($widgets)) {
        foreach ($widgets as $widget) {
            register_widget($widget);
        }
    }
}
