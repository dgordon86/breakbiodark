<?php

class KopaNewsletter extends KopaWidget {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_newsletter';
        $name = __('Kopa Newsletter', kopa_get_domain());
        $widget_options = array('classname' => 'widget-newsletter', 'description' => __('Display email subscriptions form (by http://feedburner.google.com)', kopa_get_domain()));
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

        $col['fields']['uri'] = array(
            'type' => 'text',
            'id' => 'uri',
            'name' => 'uri',
            'default' => 'KopaTheme',
            'classes' => array(),
            'label' => __('URI', kopa_get_domain())
        );

        $col['fields']['description'] = array(
            'type' => 'textarea',
            'id' => 'description',
            'name' => 'description',
            'default' => '',
            'classes' => array(),
            'label' => __('Description', kopa_get_domain())
        );

        $this->groups['col'] = $col;
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $uri = $instance['uri'];
        $description = $instance['description'];

        echo $before_widget;
        
        $social_links = KopaInit::get_social_icons();
        echo '<div class="like-box clearfix">';
        foreach ($social_links as $slug => $info) {
            $href = KopaOptions::get_option("social_link_{$slug}");

            if ('rss' == $slug) {
                if (empty($href)) {
                    $href = get_bloginfo_rss('rss2_url');
                } elseif ('HIDE' == $href) {
                    $href = '';
                }
            }
           
            if (!empty($href)) {
                printf('<a class="kopa-social-link" href="%1$s" target="_blank" title="%2$s" rel="nofollow"><i class="%3$s"></i></a>', $href, $info['title'], $info['icon']);
            }
        }
        echo '</div>';
        
        
        
        if ($uri) {
            ?>

            <div class="kp-newsletter">
                <?php
                if (!empty($title)) {
                    echo $before_title . $title . $after_title;
                }

                echo ($description) ? "<p>{$description}</p>" : '';
                ?>

                <form class="newsletter-form clearfix" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $uri; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                        return true;">                                  
                    <p class="input-email clearfix">
                        <input type="text" name="email" value="" placeholder="<?php _e('Your Email', kopa_get_domain()); ?>" class="form-control email">                
                        <input type="hidden" value="<?php echo $uri; ?>" name="uri"/>
                        <input type="hidden" name="loc" value="en_US"/>                
                        <input type="submit" value="<?php _e('Subscribe', kopa_get_domain()); ?>" class="submit">
                    </p>                    
                </form>

                <div class="newsletter-response"></div>
            </div>


            <?php
        }
        echo $after_widget;
    }

}
