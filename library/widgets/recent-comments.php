<?php

class KopaRecentComments extends KopaWidget {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_recent_comments';
        $name = __('Kopa Recent Comments', kopa_get_domain());
        $widget_options = array('classname' => 'kopa_recent_comments widget-recent-comment', 'description' => __("Your site's most recent Posts", kopa_get_domain()));
        $control_options = array('width' => 'auto', 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        $col = array(
            'size' => 12,
            'fields' => array()
        );

        $col['fields']['title'] = array(
            'type' => 'text',
            'id' => 'title',
            'name' => 'title',
            'default' => '',
            'classes' => array(),
            'label' => __('Title', kopa_get_domain()),
            'help' => NULL
        );

        $col['fields']['limit'] = array(
            'type' => 'number',
            'id' => 'limit',
            'name' => 'limit',
            'default' => 4,
            'classes' => array(),
            'label' => __('Number of comments', kopa_get_domain())
        );

        $col['fields']['comment_character_limit'] = array(
            'type' => 'number',
            'id' => 'comment_character_limit',
            'name' => 'comment_character_limit',
            'default' => 60,
            'classes' => array(),
            'label' => __('Comment character limit', kopa_get_domain()),
            'help' => NULL
        );

        $col['fields']['is_hide_author'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_author',
            'name' => 'is_hide_author',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide author name', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $col['fields']['is_hide_gravatar'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_gravatar',
            'name' => 'is_hide_gravatar',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide gravatar', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $col['fields']['is_hide_created_date'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_created_date',
            'name' => 'is_hide_created_date',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide created date', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $col['fields']['is_hide_comment'] = array(
            'type' => 'checkbox',
            'id' => 'is_hide_comment',
            'name' => 'is_hide_comment',
            'default' => 'false',
            'classes' => array(),
            'label' => __('Is hide comment content', kopa_get_domain()),
            'help' => NULL,
            'is_append_label_before_control' => false
        );

        $this->groups['col'] = $col;
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $limit = empty($instance['limit']) ? 4 : absint($instance['limit']);

        echo $before_widget;

        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }

        $comments = get_comments(array('number' => $limit, 'status' => 'approve', 'post_status' => 'publish'));


        if ($comments):
            ?>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <?php
                    foreach ((array) $comments as $comment) {
                        $date = get_comment_date('U', $comment->comment_ID);
                        $post_url = get_permalink($comment->comment_post_ID);
                        ?>
                        <li class="clearfix">
                            <?php if ('true' != $instance['is_hide_gravatar'] && '' != $comment->comment_author_email): ?>
                                <a href="<?php echo $post_url;?>" class="pull-left">
                                    <?php
                                    echo get_avatar($comment->comment_author_email, 80);
                                    ?>
                                </a>
                            <?php endif; ?>
                            <div class="item-right">
                                <?php if ('true' != $instance['is_hide_author']): ?>
                                    <h4><a href="<?php echo $post_url;?>"><?php echo get_comment_author_link($comment->comment_ID); ?></a></h4>
                                <?php endif; ?>

                                <?php
                                $comment_content = get_comment_text($comment->comment_ID);
                                if ('true' != $instance['is_hide_comment'] && !empty($comment_content)):
                                    ?>
                                    <?php
                                    $character_limit = absint($instance['comment_character_limit']);

                                    if ($character_limit > 0) {
                                        $comment_content = KopaUtil::substr($comment_content, $character_limit);
                                    }
                                    printf('<p>%s</p>', $comment_content);
                                    ?>
                                    <?php
                                endif;
                                ?>

                                <?php if ('true' != $instance['is_hide_created_date']): ?>
                                    <span class="kp-meta-post"><?php echo KopaUtil::human_time_diff($date); ?></span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        endif;

        echo $after_widget;
    }

}
