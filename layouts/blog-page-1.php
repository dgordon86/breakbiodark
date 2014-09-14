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
                global $post;

                $exceprt_type = KopaOptions::get_option('exceprt_type', 'limit');
                $excerpt_limit = KopaOptions::get_option('excerpt_limit', 200, 'Int');

                $metadata = array();
                $metadata['date'] = KopaOptions::get_option('is_display_created_date', true, 'Boolean');
                $metadata['comments'] = KopaOptions::get_option('is_display_comments', true, 'Boolean');
                $metadata['views'] = KopaOptions::get_option('is_display_views', true, 'Boolean');
                $metadata['likes'] = KopaOptions::get_option('is_display_likes', true, 'Boolean');
                $metadata['readmore'] = KopaOptions::get_option('is_display_readmore', true, 'Boolean');
                $metadata['formatted'] = apply_filters('kopa_blog_is_display_blog_post_format', KopaOptions::get_option('is_display_blog_post_format', true, 'Boolean'));
                ?>
                <div class="list-post-cat">
                    <ul class="list-post-cat-item list-unstyled">
                        <?php
                        $loop_index = 0;

                        while (have_posts()) : the_post();
                            $post_id = get_the_ID();
                            $post_url = get_permalink();
                            $post_title = get_the_title();
                            $post_format = get_post_format();
                            $post_classes = (0 == $loop_index) ? array('blog-page-1-first-post') : array();
                            
                            
                            ?>               
                            <li <?php post_class($post_classes); ?>>
                                <div class="item clearfix">
                                    <?php
                                    if ('full' != $exceprt_type && !is_search()) {
                                        if ($metadata['formatted']) {
                                            $shortcode = NULL;

                                            switch ($post_format) {
                                                case 'video':
                                                    $shortcode = KopaUtil::get_shortcode($post->post_content, false, array('vimeo', 'youtube', 'video'));
                                                    break;
                                                case 'audio':
                                                    $shortcode = KopaUtil::get_shortcode($post->post_content, false, array('audio', 'soundcloud'));
                                                    break;
                                                case 'gallery':
                                                    $shortcode = KopaUtil::get_shortcode($post->post_content, false, array('gallery'));
                                                    break;
                                            }

                                            if (!empty($shortcode)) {
                                                ?>
                                                <div class="kopa-post-content-formated pull-left">
                                                    <?php echo do_shortcode($shortcode[0]['shortcode']); ?>
                                                </div>
                                                <?php
                                            } else {
                                                if (has_post_thumbnail()):
                                                    $size = (0 == $loop_index)? 'size_09' : 'size_13';
                                                    $image = KopaImage::get_post_image_src($post_id, $size);
                                                    ?>
                                                    <div class="kopa-post-content-formated pull-left">
                                                        <a href="<?php echo $post_url; ?>">
                                                            <img class="img-responsive" src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>">
                                                        </a>
                                                    </div>
                                                    <?php
                                                endif;
                                            }
                                        } else {
                                            if (has_post_thumbnail()):
                                                $size = (0 == $loop_index)? 'size_09' : 'size_13';
                                                $image = KopaImage::get_post_image_src($post_id, $size);
                                                ?>
                                                <div class="kopa-post-content-formated pull-left">
                                                    <a href="<?php echo $post_url; ?>">
                                                        <img class="img-responsive" src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>">
                                                    </a>
                                                </div>
                                                <?php
                                            endif;
                                        }
                                    }
                                    ?>
                                    <div class="item-right">
                                        <div class="kp-caption ">
                                            <h4 class="post-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h4>
                                            <ul class="kp-meta-post list-inline">       
                                                <?php
                                                $is_first = true;
                                                foreach ($metadata as $key => $val) {
                                                    if ($val) {
                                                        $class = $is_first ? 'metadata-first' : '';
                                                        $is_first = false;
                                                        switch ($key) {
                                                            case 'date':
                                                                printf('<li class="%s">%s<span>%s</span></li>', $class, KopaIcon::getIconDatetime(), get_the_date());
                                                                break;
                                                            case 'comments':
                                                                ?>
                                                                <li class="<?php echo $class; ?>"><?php echo KopaIcon::getIconComment(); ?><span><?php comments_popup_link(__('No Comment', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain()), '', __('0 Comment', kopa_get_domain())); ?></span></li>                                            
                                                                <?php
                                                                break;
                                                            case 'views':
                                                                printf('<li class="%s">%s<span>%s</span></li>', $class, KopaIcon::getIconView(), KopaUtil::get_views($post_id, true));
                                                                break;
                                                            case 'likes':
                                                                printf('<li class="%s">%s</li>', $class, KopaUtil::kopa_get_like_button($post_id, true));
                                                                break;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul> 
                                            <?php
                                            if ('excerpt' == $exceprt_type) {
                                                if (has_excerpt()) {
                                                    printf('<p>%s</p>', get_the_excerpt());
                                                } else {
                                                    global $post;
                                                    if (strpos($post->post_content, '<!--more-->')) {
                                                        the_content(' ');
                                                    } else {
                                                        printf('<p>%s</p>', get_the_excerpt());
                                                    }
                                                }
                                            } elseif ('full' == $exceprt_type) {
                                                global $more;
                                                $more = true;
                                                the_content();
                                            } else {
                                                if ($excerpt_limit) {
                                                    $excerpt = KopaUtil::substr($post->post_content, $excerpt_limit);
                                                    echo ($excerpt) ? sprintf('<p>%s</p>', $excerpt) : '';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php if ($metadata['readmore'] && 'full' != $exceprt_type): ?>
                                            <a href="<?php echo $post_url; ?>" class="read-more"><?php _e('Read more', kopa_get_domain()); ?></a>
                                        <?php endif; ?>
                                    </div>                                    
                                </div>
                            </li>
                            <?php
                            $loop_index++;
                        endwhile;
                        ?>
                    </ul>
                    <?php get_template_part('pagination'); ?>  
                </div>            
                <?php
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
