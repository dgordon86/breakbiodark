<?php
get_header(kopa_get_header_style());
global $kopaCurrentSidebars;
?>
<div id="content" class="clearfix">
    <?php KopaLayout::get_breadcrumb(); ?>
    <div id="kopa-static-page-1-outter" class="container">
        <?php
        if (have_posts()):
            while (have_posts()) : the_post();
                ?>
                <div <?php post_class(); ?>>

                    <?php the_content(); ?>    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links pull-right"><span class="page-links-title">' . __('Parts', kopa_get_domain()) . '</span>',
                        'after' => '</div>',
                        'next_or_number' => 'number',
                        'pagelink' => '%',
                        'echo' => 1
                    ));
                    ?>                            
                </div>             

                <div class="">
                    <?php comments_template(); ?>       
                </div>

                <?php
            endwhile;
        else:
            printf('<blockquote>%1$s</blockquote>', __('Nothing Found...', kopa_get_domain()));
        endif;
        ?>    
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
