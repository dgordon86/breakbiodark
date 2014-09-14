<?php
get_header(kopa_get_header_style());
global $kopaCurrentSidebars;
?>
<div id="content" class="clearfix">
    <?php KopaLayout::get_breadcrumb(); ?>   
    <div class="container">
        <div id="main-content" class="pull-left">

            <div class="kopa-timeline-wrapper">
                <?php
                //GET CURRENT MONTH
                $current_month = (int)date('n');                

                //GET A LATEST POST
                $latest_post = NULL;

                $args = array(
                    'numberposts' => 1,
                    'orderby' => 'post_date',
                    'post_type' => 'post',
                    'post_status' => 'publish');
                $recent_posts = wp_get_recent_posts($args, OBJECT);
                wp_reset_query();

                if (!empty($recent_posts)) {
                    $latest_post = $recent_posts[0];
                }

                // Explore month & year of latest post
                $time = strtotime($latest_post->post_date);
                $month = (int) date('m', $time);
                $year = (int) date('Y', $time);

                $month_arr = array(
                    __('Jan', kopa_get_domain()),
                    __('Feb', kopa_get_domain()),
                    __('Mar', kopa_get_domain()),
                    __('Apr', kopa_get_domain()),
                    __('May', kopa_get_domain()),
                    __('Jun', kopa_get_domain()),
                    __('Jul', kopa_get_domain()),
                    __('Aug', kopa_get_domain()),
                    __('Sep', kopa_get_domain()),
                    __('Oct', kopa_get_domain()),
                    __('Nov', kopa_get_domain()),
                    __('Dec', kopa_get_domain())
                );

                echo '<div class="filter-isotope clearfix">';
                for ($i = 0; $i < 3; $i++) {
                    $tmp_year = $year - $i;
                    echo (0 == $i) ? '<div class="kp-year show">' : '<div class="kp-year">';
                    ?>        
                    <span onclick="KopaTimeline.change_year(event, jQuery(this));"><?php echo $tmp_year; ?></span>
                    <?php
                    echo (0 == $i) ? '<ul class="clearfix show">' : '<ul class="clearfix hidden">';
                    for ($j = 0; $j < 12; $j++) {
                        $tmp_month = $j + 1;
                        $isotope_id = sprintf("#kopa-timeline-year-%s-month-%s", $tmp_year, $tmp_month);

                        $month_link_classes = array('kopa-timeline-month');
                        if (0 == $i && $current_month == $j + 1) {
                            $month_link_classes[] = 'active';
                        }
                        ?>
                        <li class="<?php echo implode(' ', $month_link_classes); ?>">
                            <span class="kp-month" onclick="KopaTimeline.change_month(event, jQuery(this), '<?php echo $isotope_id; ?>');"><?php echo $month_arr[$j]; ?></span>                            
                            <a href="<?php echo $isotope_id; ?>" onclick="KopaTimeline.change_month(event, jQuery(this), '<?php echo $isotope_id; ?>');"></a>
                        </li>
                        <?php
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                echo '</div>';

                wp_nonce_field('kopa_load_timeline_posts', 'kopa_load_timeline_posts_ajax_nonce');
                ?>

                <?php
                for ($i = 0; $i < 3; $i++) {
                    $tmp_year = $year - $i;

                    for ($j = 0; $j < 12; $j++) {
                        $tmp_month = $j + 1;

                        $isotope_classes = (0 == $i && $current_month == $j + 1) ? 'kp-isotope show' : 'kp-isotope hidden';
                        $isotope_id = sprintf("kopa-timeline-year-%s-month-%s", $tmp_year, $tmp_month);
                        $paged = (0 == $i && $current_month == $j + 1) ? 1 : 0;
                        $load_button_style = (0 == $i && $current_month == $j + 1) ? "display: block;" : 'display: none;';
                        ?>
                        <div id="<?php echo $isotope_id; ?>" class="<?php echo $isotope_classes; ?>">
                            <div class="isotope-content">
                                <div class="time-line"></div>
                                <?php
                                if (0 == $i && $current_month == $j + 1) {
                                    kopa_load_timeline_posts_fn($month, $year, false);
                                }
                                ?>                            
                            </div>
                            <div class="load-more" style="<?php echo $load_button_style; ?>"><span onclick="KopaTimeline.load(event, jQuery(this));" data-year="<?php echo $tmp_year; ?>" data-month="<?php echo $tmp_month; ?>" data-paged="<?php echo $paged; ?>"><i class="fa fa-spinner"></i></span></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

        </div>

        <?php
        #WIDGET AREA {7}
        if (is_active_sidebar($kopaCurrentSidebars[0])):
            echo '<div id="sidebar" class="pull-left">';
            dynamic_sidebar($kopaCurrentSidebars[0]);
            echo '</div>';
            echo '<div class="clearfix"></div>';
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
                if (is_active_sidebar($kopaCurrentSidebars[1])):
                    echo '<div id="widget-area-9" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[1]);
                    echo '</div>';
                endif;
                ?> 
                <?php
                #WIDGET AREA {10}
                if (is_active_sidebar($kopaCurrentSidebars[2])):
                    echo '<div id="widget-area-10" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[2]);
                    echo '</div>';
                endif;
                ?> 
                <?php
                #WIDGET AREA {11}
                if (is_active_sidebar($kopaCurrentSidebars[3])):
                    echo '<div id="widget-area-11" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[3]);
                    echo '</div>';
                endif;
                ?> 
                <?php
                #WIDGET AREA {12}
                if (is_active_sidebar($kopaCurrentSidebars[4])):
                    echo '<div id="widget-area-12" class="col-md-3 col-sm-12 col-xs-12">';
                    dynamic_sidebar($kopaCurrentSidebars[4]);
                    echo '</div>';
                endif;
                ?>                                 
            </div>                        
        </div>        
    </div>    
</div>
<?php
get_footer();
