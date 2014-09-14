<?php
get_header(kopa_get_header_style());
global $kopaCurrentSidebars;
?>

<div id="content" class="clearfix">

    <?php KopaLayout::get_breadcrumb(); ?>   
    
    <div class="container">
        
        <section class="error-404 clearfix">            
            <div class="left-col">
                <p><?php _e('404', kopa_get_domain()); ?></p>
            </div>
            <div class="right-col">
                <h1><?php _e('Page not found...', kopa_get_domain()); ?></h1>
                <p><?php _e("We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:", kopa_get_domain()); ?></p>
                <ul class="arrow-list">
                    <li><a href="javascript: history.go(-1);"><?php _e('Go back to previous page', kopa_get_domain()); ?></a></li>
                    <li><a href="<?php echo home_url(); ?>"><?php _e('Go to homepage', kopa_get_domain()); ?></a></li>
                </ul>
            </div>
        </section>        
    </div>   
</div>

<div class="bottom-sidebar clearfix">
    <div class="widget-area-4">
        <div class="container">
            <div class="row ">                
                <?php
                #WIDGET AREA {9}
                if (is_active_sidebar($kopaCurrentSidebars[0])):
                    echo '<div id="widget-area-9" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[0]);
                    echo '</div>';
                endif;
                ?> 

                <?php
                #WIDGET AREA {10}
                if (is_active_sidebar($kopaCurrentSidebars[1])):
                    echo '<div id="widget-area-10" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[1]);
                    echo '</div>';
                endif;
                ?> 

                <?php
                #WIDGET AREA {11}
                if (is_active_sidebar($kopaCurrentSidebars[2])):
                    echo '<div id="widget-area-11" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[2]);
                    echo '</div>';
                endif;
                ?> 

                <?php
                #WIDGET AREA {12}
                if (is_active_sidebar($kopaCurrentSidebars[3])):
                    echo '<div id="widget-area-12" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[3]);
                    echo '</div>';
                endif;
                ?>                                 
            </div>            
        </div>        
    </div>    
</div>



<?php
get_footer();
