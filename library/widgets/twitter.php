<?php

class KopaTwitter extends KopaWidget {

    public function __construct($id_base = '', $name = '', $widget_options = array(), $control_options = array()) {
        $id_base = 'kopa_twitter';
        $name = __('Kopa Twitter', kopa_get_domain());
        $widget_options = array('classname' => 'widget-twitters', 'description' => __('Display list tweets from twitter.com', kopa_get_domain()));
        $control_options = array('width' => 500, 'height' => 'auto');
        parent::__construct($id_base, $name, $widget_options, $control_options);

        $col_1 = array(
            'size' => 4,
            'fields' => array()
        );
        $col_2 = array(
            'size' => 8,
            'fields' => array()
        );
        $col_1['fields']['title'] = array(
            'type' => 'text',
            'id' => 'title',
            'name' => 'title',
            'default' => '',
            'classes' => array(),
            'label' => __('Title', kopa_get_domain()),
            'help' => NULL
        );

        $col_1['fields']['id'] = array(
            'type' => 'text',
            'id' => 'id',
            'name' => 'id',
            'default' => 'YOUR-NAME',
            'label' => __('Username', kopa_get_domain()),
            'classes' => array(),
            'help' => NULL
        );

        $col_1['fields']['limit'] = array(
            'type' => 'number',
            'id' => 'limit',
            'name' => 'limit',
            'default' => '2',
            'classes' => array(),
            'label' => __('Number of tweets', kopa_get_domain()),
            'help' => NULL
        );

        //consumer_key
        $col_2['fields']['consumer_key'] = array(
            'type' => 'text',
            'id' => 'consumer_key',
            'name' => 'consumer_key',
            'default' => '',
            'label' => __('API key', kopa_get_domain()),
            'classes' => array(),
            'help' => NULL
        );

        //consumer_secret
        $col_2['fields']['consumer_secret'] = array(
            'type' => 'text',
            'id' => 'consumer_secret',
            'name' => 'consumer_secret',
            'default' => '',
            'label' => __('API secret', kopa_get_domain()),
            'classes' => array(),
            'help' => NULL
        );

        //oauth_access_token
        $col_2['fields']['oauth_access_token'] = array(
            'type' => 'text',
            'id' => 'oauth_access_token',
            'name' => 'oauth_access_token',
            'default' => '',
            'label' => __('Access token', kopa_get_domain()),
            'classes' => array(),
            'help' => NULL
        );

        //oauth_access_token_secret
        $col_2['fields']['oauth_access_token_secret'] = array(
            'type' => 'text',
            'id' => 'oauth_access_token_secret',
            'name' => 'oauth_access_token_secret',
            'default' => '',
            'label' => __('Access token secret', kopa_get_domain()),
            'classes' => array(),
            'help' => NULL
        );



        $this->groups['col-1'] = $col_1;
        $this->groups['col-2'] = $col_2;
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $id = $instance['id'];
        $limit = empty($instance['limit']) ? 2 : (int) $instance['limit'];

        $consumer_key = $instance['consumer_key'];
        $consumer_secret = $instance['consumer_secret'];
        $oauth_access_token = $instance['oauth_access_token'];
        $oauth_access_token_secret = $instance['oauth_access_token_secret'];

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }

        if ($id && $consumer_key && $consumer_secret && $oauth_access_token && $oauth_access_token_secret) {
            require_once trailingslashit(get_template_directory()) . '/library/addon/api/twitter-api-exchange.php';

            $settings = array(
                'oauth_access_token' => $oauth_access_token,
                'oauth_access_token_secret' => $oauth_access_token_secret,
                'consumer_key' => $consumer_key,
                'consumer_secret' => $consumer_secret
            );

            $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
            $requestMethod = "GET";
            $getfield = "?screen_name=$id&count=$limit";
            $twitter = new TwitterAPIExchange($settings);
            $data = json_decode($twitter->setGetfield($getfield)
                            ->buildOauth($url, $requestMethod)
                            ->performRequest(), TRUE);
            ?>
            <div class="widget-content">
                <div id="tweets" class="tweets" data-username="<?php echo $id; ?>" data-limit="<?php echo $limit; ?>">
                    <?php
                    if (isset($data["errors"][0]["message"]) && $data["errors"][0]["message"] != '') {
                        _e("Sorry, there was a problem when load", kopa_get_domain());
                    } else {
                        ?>                        
                        <ul class="tweetList">
                            <?php if (!empty($data)) : ?>
                                <?php foreach ($data as $items): ?>
                                    <?php
                                    preg_match('!https?://[\S]+!', $items['text'], $matches);
                                    $url = '';
                                    if (isset($matches) && !empty($matches))
                                        $url = $matches[0];

                                    $pattern = '~http://[^\s]*~i';
                                    $title = preg_replace($pattern, '', $items['text']);
                                    ?>
                                    <li class="tweet_content_0">
                                        <p class="tweet_link_0"><?php echo $title; ?>
                                            <?php if (!empty($url)) : ?>
                                                <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
                                            <?php endif; ?>                                
                                        <p class="timestamp">
                                            <?php
                                            $date = date_create($items['created_at']);                                            
                                            if (version_compare(PHP_VERSION, '5.3') >= 0) {
                                                $created_at = $date->getTimestamp();
                                                echo KopaUtil::human_time_diff($created_at);
                                            } else {
                                                echo date_format($date, "Y/m/d H:iP");
                                            }
                                            ?>
                                        </p>
                                        </p>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>                        
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }

        echo $after_widget;
    }

}
