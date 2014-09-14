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

                    <a href="<?php echo home_url(); ?>" alt="<?php bloginfo('name'); ?>" class="bb-logo">Home</a>
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
                    <div class="header-right">
                        <?php kopa_get_social_links(); ?>
                        <br/>
                        <div class="search-box">
                            <?php get_search_form(); ?>                                                  
                        </div>
                    </div>
                </div>                
            </div>    

                     
        </header>        

        <?php
        global $kopaCurrentSidebars, $kopaCurrentLayout;
        
        if(in_array($kopaCurrentLayout, array('front-page-1', 'front-page-2', 'front-page-3'))){            
            #WIDGET AREA {1}
            if (is_active_sidebar($kopaCurrentSidebars[0])):
                echo '<div id="widget-area-1" class="widget-area-1 clearfix">';
                dynamic_sidebar($kopaCurrentSidebars[0]);
                echo '</div>';
            endif;
        }        