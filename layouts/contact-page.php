<?php
require_once trailingslashit(get_template_directory()) . '/library/addon/api/recaptchalib.php';

get_header(kopa_get_header_style());
global $kopaCurrentSidebars;
?>
<div id="content" class="clearfix">
    <?php KopaLayout::get_breadcrumb(); ?>
    <div>         
        <?php echo do_shortcode('[contact_form]'); ?>
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
