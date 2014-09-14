<?php
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die(__('Please do not load this page directly. Thanks!', kopa_get_domain()));

if (post_password_required())
    return;

if (is_single() && 'true' != KopaOptions::get_option('is_display_post_comments_system', 'true'))
    return;

global $kopaCurrentLayout;
?>
<div id="comments">    
        <?php
        if (have_comments()) :
            global $post;
            ?>     
            <h3 class="comments-title"><span><span><span><?php echo KopaUtil::get_comments($post->ID); ?></span></span></span></h3>        

            <ul class="comment-list clearfix">
                <?php
                wp_list_comments(array(
                    'walker' => null,
                    'style' => 'ul',
                    'short_ping' => true,
                    'callback' => 'kopa_list_comments',
                    'type' => 'all'
                ));
                ?>
            </ul>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>           
                <div class="pagination kopa-comment-pagination">  
                    <?php
                    paginate_comments_links(array(
                        'prev_text' => __('<span>&laquo;</span> Previous', kopa_get_domain()),
                        'next_text' => __('Next <span>&raquo;</span>', kopa_get_domain())
                    ));
                    ?>
                </div>
            <?php endif; ?>

            <?php if (!comments_open() && get_comments_number()) : ?>
                <p class="no-comments"><?php _e('Comments are closed.', kopa_get_domain()); ?></p>
            <?php endif; ?>    
            <?php
        endif;
        kopa_comment_form();
        ?>
</div>
<?php

function kopa_comment_form($args = array(), $post_id = null) {
    if (null === $post_id)
        $post_id = get_the_ID();

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args($args);
    if (!isset($args['format']))
        $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5 = 'html5' === $args['format'];

    $fields = array();


    $fields['author'] = '<div class="form-group row">';
    $fields['author'].= '<div class="col-md-3">';
    $fields['author'].= sprintf('<label for="comment_name" class="required">%s</label>', __('Name <span>(*)</span>', kopa_get_domain()));
    $fields['author'].= '</div>';
    $fields['author'].= '<div class="col-md-7">';
    $fields['author'].= sprintf('<input type="text" class="form-control" value="%s" id="comment_name" name="author" size="30" placeholder="%s" %s>', esc_attr($commenter['comment_author']), '', $aria_req);
    $fields['author'].= '</div>';
    $fields['author'].= '</div>';

    $fields['email'] = '<div class="form-group row">';
    $fields['email'].= '<div class="col-md-3">';
    $fields['email'].= sprintf('<label for="comment_email" class="required">%s</label>', __('Email <span>(*)</span>', kopa_get_domain()));
    $fields['email'].= '</div>';
    $fields['email'].= '<div class="col-md-7">';
    $fields['email'].= sprintf('<input type="%s" class="form-control" value="%s" id="comment_email" name="email" size="30" placeholder="%s" %s>', ( $html5 ? 'email' : 'text'), esc_attr($commenter['comment_author_email']), '', $aria_req);
    $fields['email'].= '</div>';
    $fields['email'].= '</div>';

    $fields['url'] = '<div class="form-group row">';
    $fields['url'].= '<div class="col-md-3">';
    $fields['url'].= sprintf('<label for="comment_url" class="required">%s</label>', __('Website', kopa_get_domain()));
    $fields['url'].= '</div>';
    $fields['url'].= '<div class="col-md-7">';
    $fields['url'].= sprintf('<input type="%s" class="form-control" value="%s" id="comment_url" name="url" size="30" placeholder="%s" %s>', ( $html5 ? 'url' : 'text'), esc_attr($commenter['comment_author_url']), '', $aria_req);
    $fields['url'].= '</div>';
    $fields['url'].= '</div>';

    $comment_field = '<div class="form-group row">';
    $comment_field.= '<div class="col-md-3">';
    $comment_field.= sprintf('<label for="comment_message" class="required">%s</label>', __('Your comments <span>(*)</span>', kopa_get_domain()));
    $comment_field.= '</div>';
    $comment_field.= '<div class="col-md-9">';
    $comment_field.= sprintf('<textarea name="comment" class="form-control" id="comment_message" rows="6" placeholder="%s" %s></textarea>', '', $aria_req);
    $comment_field.= '</div>';
    $comment_field.= '</div>';

    $fields = apply_filters('comment_form_default_fields', $fields);
    $defaults = array(
        'fields' => $fields,
        'comment_field' => $comment_field,
        'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', kopa_get_domain()), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', kopa_get_domain()), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'comment_notes_before' => __('Your email address will not be published. Required fields are marked <span>(*)</span>', kopa_get_domain()),
        'comment_notes_after' => '',
        'id_form' => 'comments-form',
        'id_submit' => 'submit-comment',
        'title_reply' => __('Leave a Reply', kopa_get_domain()),
        'title_reply_to' => __('Leave a Reply to %s', kopa_get_domain()),
        'cancel_reply_link' => __('X', kopa_get_domain()),
        'label_submit' => __('Post Comment', kopa_get_domain()),
        'format' => 'xhtml',
    );

    $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
    ?>
    <?php if (comments_open($post_id)) : ?>
        <?php
        do_action('comment_form_before');
        ?>
        <div id="respond">
            <h3 id="reply-title" class="comment-reply-title"><span><span><span><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?></span></span></span></h3>            


            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <?php echo $args['must_log_in']; ?>
                <?php
                do_action('comment_form_must_log_in_after');
                ?>
            <?php else : ?>            
                <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <p class="comment-notes"><?php echo $args['comment_notes_before']; ?></p>

                    <?php
                    do_action('comment_form_top');
                    ?>
                    <?php if (is_user_logged_in()) : ?>
                        <?php
                        echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
                        ?>
                        <?php
                        do_action('comment_form_logged_in_after', $commenter, $user_identity);
                        ?>
                    <?php else : ?>                        
                        <?php
                        do_action('comment_form_before_fields');
                        foreach ((array) $args['fields'] as $name => $field) {
                            echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                        }
                        do_action('comment_form_after_fields');
                        ?>
                    <?php endif; ?>
                    <?php
                    echo apply_filters('comment_form_field_comment', $args['comment_field']);
                    ?>
                    <?php echo $args['comment_notes_after']; ?>

                    <div class="row clearfix">
                        <div class="comment-button col-md-9 col-md-offset-3">                                       
                            <input class="btn style-5" name="submit" type="submit" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />
                            <?php cancel_comment_reply_link($args['cancel_reply_link']); ?>                        
                            <?php comment_id_fields($post_id); ?>                                                    
                        </div>
                    </div>
                    <?php
                    do_action('comment_form', $post_id);
                    ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond -->
        <?php
        do_action('comment_form_after');
    else :
        do_action('comment_form_comments_closed');
    endif;
}

function kopa_list_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>

    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

        <article class="comment-body">
            <figure class="pull-left">
                <?php echo get_avatar($comment->comment_author_email, 70); ?> 
            </figure>
            <div class="comment-content item-right">
                <header class="clearfix">
                    <h4><?php comment_author_link(); ?></h4>
                    <p class="kp-metadata">
                        <?php comment_time(get_option('date_format') . ' - ' . get_option('time_format')); ?>
                        <?php edit_comment_link(__('Edit', kopa_get_domain()), '<span>&nbsp;-&nbsp;</span>', ''); ?>
                        <span>&nbsp;-&nbsp;</span><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>                                                            
                    </p>
                </header>
                <div class="entry-content">
                    <?php comment_text(true); ?>                   
                </div>                
            </div>            
        </article>                                                                                
    </li>

    <?php
}
