<?php
get_header(kopa_get_header_style());
global $kopaCurrentSidebars;
?>

<div id="content" class="clearfix">

    <div class="container clearfix">
        <?php if (is_active_sidebar($kopaCurrentSidebars[1]) || is_active_sidebar($kopaCurrentSidebars[2])): ?>
            <div id="main-content" class="pull-left">

                <?php
                #WIDGET AREA {3}
                if (is_active_sidebar($kopaCurrentSidebars[1])):
                    echo '<div id="widget-area-3" class="widget-area-2 pull-left">';
                    dynamic_sidebar($kopaCurrentSidebars[1]);
                    echo '</div>';
                endif;
                ?>

                <?php
                #WIDGET AREA {4}
                if (is_active_sidebar($kopaCurrentSidebars[2])):
                    echo '<div id="widget-area-4" class="widget-area-3 pull-right">';
                    dynamic_sidebar($kopaCurrentSidebars[2]);
                    echo '</div>';
                endif;
                ?>
            </div>            
        <?php endif; ?>

        <?php
        #WIDGET AREA {7}
        if (is_active_sidebar($kopaCurrentSidebars[3])):
            echo '<div id="sidebar" class="pull-left">';
            dynamic_sidebar($kopaCurrentSidebars[3]);
            echo '</div>';
            echo '<div class="clearfix"></div>';
        endif;
        ?> 

    </div>    
</div>

<div class="bottom-sidebar clearfix">

    <?php
    #WIDGET AREA {8}
    if (is_active_sidebar($kopaCurrentSidebars[4])):
        echo '<div id="widget-area-8" class="top-bottom-sidebar">';
        dynamic_sidebar($kopaCurrentSidebars[4]);
        echo '</div>';
        echo '<div class="clearfix"></div>';
        echo '<div class="footer-divider container clearfix"></div>';
    endif;
    ?> 
    
    <div class="widget-area-4">
        <div class="container">
            <div class="row ">                
                <?php
                #WIDGET AREA {9}
                if (is_active_sidebar($kopaCurrentSidebars[5])):
                    echo '<div id="widget-area-9" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[5]);
                    echo '</div>';
                endif;
                ?> 

                <?php
                #WIDGET AREA {10}
                if (is_active_sidebar($kopaCurrentSidebars[6])):
                    echo '<div id="widget-area-10" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[6]);
                    echo '</div>';
                endif;
                ?> 

                <?php
                #WIDGET AREA {11}
                if (is_active_sidebar($kopaCurrentSidebars[7])):
                    echo '<div id="widget-area-11" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[7]);
                    echo '</div>';
                endif;
                ?> 

                <?php
                #WIDGET AREA {12}
                if (is_active_sidebar($kopaCurrentSidebars[8])):
                    echo '<div id="widget-area-12" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[8]);
                    echo '</div>';
                endif;
                ?>                                 
            </div>                        
        </div>        
    </div>    
</div>

<?php
get_footer();
