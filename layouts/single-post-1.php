<?php
get_header(kopa_get_header_style());
global $kopaCurrentSidebars;
?>

<div id="content" class="clearfix">
    <?php KopaLayout::get_breadcrumb(); ?>
    <div class="container">
        <div id="main-content" class="pull-left">
            <?php
            if (have_posts()):
                $metadata = array();

                $metadata['cats'] = KopaOptions::get_option('is_display_post_category', true, 'Boolean');
                $metadata['date'] = KopaOptions::get_option('is_display_post_datetime', true, 'Boolean');
                $metadata['comments'] = KopaOptions::get_option('is_display_post_comments', true, 'Boolean');
                $metadata['views'] = KopaOptions::get_option('is_display_post_views', true, 'Boolean');
                $metadata['likes'] = KopaOptions::get_option('is_display_post_likes', true, 'Boolean');
                $metadata['shares'] = KopaOptions::get_option('is_display_post_shares', true, 'Boolean');
                $metadata['tags'] = KopaOptions::get_option('is_display_post_tag', true, 'Boolean');
                $metadata['thumb'] = KopaOptions::get_option('is_display_post_thumbnail_standard', true, 'Boolean');
                $metadata['thumb_other'] = KopaOptions::get_option('is_display_post_thumbnail_other', true, 'Boolean');

                while (have_posts()) : the_post();
                    $post_id = get_the_ID();
                    $post_url = get_permalink();
                    $post_title = get_the_title();
                    $post_format = get_post_format();
                    ?>
                    <article <?php post_class(array('post-content')); ?>>                   
                        <header class="clearfix">
                            <h1 class="title-post entry-title"><?php echo $post_title; ?></h1>                            
                            <div class="header-bottom bb-single-page-header">
                                <ul class="kp-meta-post list-inline">         
                                    <?php
                                    $is_first = true;
                                    foreach ($metadata as $key => $val) {
                                        if ($val) {
                                            $class = $is_first ? 'metadata-first' : '';
                                            $is_first = false;
                                            switch ($key) {
                                                case 'cats':
                                                    if (has_category()) {
                                                        ?>
                                                        <li class="singular-categories <?php echo $class; ?>">
                                                            <?php echo KopaIcon::getIcon('fa fa-book'); ?>
                                                            <?php the_category(', '); ?>                            
                                                        </li>
                                                        <?php
                                                    }
                                                    break;
                                                case 'date':
                                                    printf('<li class="%s">%s<span>%s</span></li>', $class, KopaIcon::getIconDatetime(), get_the_date());
                                                    break;
                                                case 'comments':
                                                    ?>
                                                    <li class="<?php echo $class; ?>"><?php echo KopaIcon::getIconComment(); ?><span><?php comments_popup_link(__('No Comment', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain()), '', __('0 Comment', kopa_get_domain())); ?></span></li>                                            
                                                    <?php
                                                    break;
                                                case 'views':
                                                    printf('<li class="singular-view-count %s">%s<span>%s</span></li>', $class, KopaIcon::getIconView(), KopaUtil::get_views($post_id, true));
                                                    break;
                                                case 'likes':
                                                    printf('<li class="%s">%s</li>', $class, KopaUtil::kopa_get_like_button($post_id, true));
                                                    break;
                                                case 'shares':
                                                    printf('<li class="singular-shares %s"><a class="addthis_button_compact" addthis:url="%s" href="#" rel="nofollow">%s&nbsp;%s</a></li>', $class, $post_url, KopaIcon::getIconShare(), __('Share', kopa_get_domain()));                                          
                                                    break;
                                            }
                                        }
                                    }
                                    ?>                                  
                                </ul>
                            </div>
                        </header>
                        
                            <?php
                        if (has_post_thumbnail()) {
                            $exp1 = empty($post_format) && $metadata['thumb'];
                            $exp2 = $post_format && $metadata['thumb_other'];

                            if ($exp1 || $exp2) {
                                $image_croped = KopaImage::get_post_image_src($post_id, 'size_06');
                                ?>
                                <div class="kp-thumb pull-right">
                                    <img src="<?php echo $image_croped; ?>" alt="" />                        
                                </div>
                                <?php
                            }
                        }
                        ?> 
                        <div class="clearfix entrycontent">
                            <?php the_content(); ?>
                        </div>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . __('Parts', kopa_get_domain()) . '</span>',
                            'after' => '</div>',
                            'next_or_number' => 'number',
                            'pagelink' => '<span>%</span>',
                            'echo' => 1
                        ));
                        ?>

                        <?php if ($metadata['tags'] && has_tag()): ?>
                            <p class="kp-tags">                            
                                <?php the_tags('', ' '); ?>                        
                            </p>
                        <?php endif; ?>

                        <div class="clearfix"></div>

                        <?php
                        $prev_and_next = KopaLayout::get_pre_next_post();

                        if ($prev_and_next):
                            ?>
                            <ul class="pager-page list-unstyled clearfix">
                                <?php if (isset($prev_and_next['prev'])): ?>
                                    <li class="prev pull-left"> 
                                        <a class="prev" href="<?php echo $prev_and_next['prev']['url']; ?>">&nbsp;&nbsp;&nbsp;<?php _e('Previous article', kopa_get_domain()); ?></a>                            
                                        <h4 class="post-title"><a href="<?php echo $prev_and_next['prev']['url']; ?>"><?php echo $prev_and_next['prev']['title']; ?></a></h4>                                                                                                  
                                        <span class="kp-meta-post"><?php echo $prev_and_next['prev']['date']; ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($prev_and_next['next'])): ?>
                                    <li class="next pull-right">
                                        <a class="next" href="<?php echo $prev_and_next['next']['url']; ?>"><?php _e('Next article', kopa_get_domain()); ?>&nbsp;&nbsp;&nbsp;</a>                            
                                        <h4 class="post-title"><a href="<?php echo $prev_and_next['next']['url']; ?>"><?php echo $prev_and_next['next']['title']; ?></a></h4>                                                                                                  
                                        <span class="kp-meta-post"><?php echo $prev_and_next['next']['date']; ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                        <?php kopa_get_about_author(); ?>

                    </article>

                    <?php kopa_get_related_posts(); ?>

                    <?php comments_template(); ?>               
                    <?php
                endwhile;
            else:
                printf('<blockquote>%1$s</blockquote>', __('Nothing Found...', kopa_get_domain()));
            endif;
            ?>
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
