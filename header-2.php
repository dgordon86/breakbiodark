<!DOCTYPE html>
<html <?php language_attributes(); ?>>              
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />                   
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo KopaSEO::get_title(); ?></title>                
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />               
        <?php wp_head(); ?>
    </head>    
    <body <?php body_class(); ?>>  
        <header id="page-header" class="clearfix">
            <div class="header-top">
                <div class="container">

                    <?php
                    #TOP MENU
                    if (has_nav_menu('top-nav')) {
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'top-nav',
                                    'container' => false,
                                    'menu_id' => 'menu-second',
                                    'menu_class' => 'sf-menu menu-second'
                                )
                        );
                    }
                    ?>

                    <span class="icon-list4"><?php _e('Top Menu', kopa_get_domain()); ?></span>

                    <?php
                    #TOP MENU MOBILE
                    if (has_nav_menu('top-nav')) {
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'top-nav',
                                    'container' => false,
                                    'menu_id' => 'menu-second-mobile',
                                    'menu_class' => 'nav menu-second'
                                )
                        );
                    }
                    ?>   

                    <?php kopa_get_social_links(); ?>
                </div>                
            </div>    

            <?php
            $logo = KopaOptions::get_option('logo');
            $top_banner_image = KopaOptions::get_option('top_banner_image');
            $top_banner_code = KopaOptions::get_option('top_banner_code');

            if (!empty($logo) || $top_banner_image || $top_banner_code):
                ?>

                <div class="header-middle">
                    <div class="container clearfix">
                        <?php
                        if (!empty($logo)):
                            ?>
                            <div id="logo-image" class="pull-left">
                                <a href="<?php echo home_url(); ?>"><img src="<?php echo do_shortcode($logo); ?>" alt="<?php bloginfo('name'); ?>"/></a>
                            </div>                        
                        <?php endif; ?>

                        <?php
                        #PRIMARY MENU
                        if (has_nav_menu('primary-nav')) {
                            wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary-nav',
                                        'container' => 'nav',
                                        'container_id' => 'primary-nav',
                                        'menu_id' => 'primary-menu',
                                        'menu_class' => 'sf-menu primary-menu'
                                    )
                            );
                        }
                        ?> 

                        <span class="primary-menu-mobile-button"><span class="fa fa-bars"></span></span>

                        <?php
                        #TOP MENU MOBILE
                        if (has_nav_menu('primary-nav')) {
                            wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary-nav',
                                        'container' => false,
                                        'menu_id' => 'menu-primary-mobile',
                                        'menu_class' => 'nav menu-primary-mobile'
                                    )
                            );
                        }
                        ?>

                        <?php
                        #SEARCH FORM
                        if ('true' == KopaOptions::get_option('is_display_search_form', 'true')) {
                            ?>
                            <div class="search-box pull-right">
                                <?php get_search_form(); ?>                                                  
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php
            global $kopaCurrentSidebars, $kopaCurrentLayout;

            if (in_array($kopaCurrentLayout, array('front-page-1', 'front-page-2', 'front-page-3'))) {
                #WIDGET AREA {1}
                if (is_active_sidebar($kopaCurrentSidebars[0])):
                    echo '<div id="widget-area-1" class="widget-area-1 clearfix">';
                    dynamic_sidebar($kopaCurrentSidebars[0]);
                    echo '</div>';
                endif;
            }
            ?>

            <div class="header-bottom">
                <div class="container">
                    <?php kopa_get_headline(); ?>                  
                </div>                
            </div>            
        </header>        