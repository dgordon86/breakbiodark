<?php
/**
 * 
 * @package Kopa
 * @subpackage Core
 * @author thethangtran <tranthethang@gmail.com>
 * @since 1.0.0
 *      
 */
function kopa_options_seo() {
    /*
     * SEO
     * **************************** */

    $groups['seo'] = array(
        'icon' => '',
        'title' => __('SEO - Search engine optimization', kopa_get_domain()),
        'fields' => array()
    );

    $groups['seo']['fields'][] = array(
        'type' => 'radio-truefalse',
        'id' => 'seo_status',
        'name' => 'seo_status',
        'value' => 'true',
        'default' => 'true',
        'label' => __('Status', kopa_get_domain()),
        'help' => __('If you using any SEO Plugin, please disable this option.', kopa_get_domain()),
        'true' => __('Enable', kopa_get_domain()),
        'false' => __('Disable', kopa_get_domain()),
        'attributes' => array(
            'onclick' => 'KopaThemeOptions.onClickSEOStatus(event, jQuery(this));'
        ),
        'option_args' => array(
            'classes' => array('rdo_seo_status')
        )
    );

    $seo_keys = array();
    $seo_keys['site_name'] = __('Your site name', kopa_get_domain());
    $seo_keys['site_desc'] = __('Your site description', kopa_get_domain());
    $seo_keys['term_type'] = __('Type of term. E.g. category, post_tag', kopa_get_domain());
    $seo_keys['term_name'] = __('Name of category or tag', kopa_get_domain());
    $seo_keys['pagination_paged'] = __('Number of current page', kopa_get_domain());
    $seo_keys['page_name'] = __('Name of current page', kopa_get_domain());
    $seo_keys['post_name'] = __('Name of current post', kopa_get_domain());
    $seo_keys['post_author_name'] = __('Author of current post(page)', kopa_get_domain());
    $seo_keys['post_cats'] = __('Categories of current post', kopa_get_domain());
    $seo_keys['post_tags'] = __('Tags of current post', kopa_get_domain());
    $seo_keys['author_name'] = __('Name of current author (author page)', kopa_get_domain());
    $seo_keys['search_phrase'] = __('Search keyword', kopa_get_domain());
    $seo_keys['search_result_count'] = __('Number of search results', kopa_get_domain());

    $seo_keys_help = array();
    foreach ($seo_keys as $key => $desc) {
        $seo_keys_help[] = sprintf('<span class="kopa_seo_title_key"><code>[%s]</code></span>%s', $key, $desc);
    }

    $groups['seo']['fields'][] = array(
        'type' => 'group',
        'id' => 'seo_titles',
        'name' => 'seo_titles',
        'label' => __('Title', kopa_get_domain()),
        'default' => '',
        'help' => implode('<br/>', $seo_keys_help),
        'sub_fields' => array(
            array(
                'type' => 'text',
                'id' => 'seo_title_front_page',
                'name' => 'seo_title_front_page',
                'value' => KopaOptions::get_option('seo_title_front_page', '[site_name] - [site_desc]'),
                'default' => '[site_name] - [site_desc]',
                'label' => __('<code>HOME</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Front Page (it\'s static page)', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_home_page',
                'name' => 'seo_title_home_page',
                'value' => KopaOptions::get_option('seo_title_home_page', 'Latest News - [pagination_paged] - [site_name] - [site_desc]'),
                'default' => 'Latest News - [pagination_paged] - [site_name] - [site_desc]',
                'label' => __('<code>HOME</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Blog posts (display latest posts with pagination)', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_taxonomy',
                'name' => 'seo_title_taxonomy',
                'value' => KopaOptions::get_option('seo_title_taxonomy', '[term_type] - [term_name] - [pagination_paged] - [site_name]- [site_desc]'),
                'default' => '[term_type] - [term_name] - [pagination_paged] - [site_name] - [site_desc]',
                'label' => __('<code>TAXONOMY</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Category or Tag (taxonomy - display post lists with pagination)', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_page',
                'name' => 'seo_title_page',
                'value' => KopaOptions::get_option('seo_title_page', '[page_name] - [site_name] - [site_desc]'),
                'default' => '[page_name] - [site_name] - [site_desc]',
                'label' => __('<code>PAGE</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Static Page', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_post',
                'name' => 'seo_title_post',
                'value' => KopaOptions::get_option('seo_title_post', '[post_name] - Created by [post_author_name] - In category: [post_cats] - Tagged with: [post_tags] - [site_name] - [site_desc]'),
                'default' => '[post_name] - Created by [post_author_name] - In category: [post_cats] - Tagged with: [post_tags] - [site_name] - [site_desc]',
                'label' => __('<code>POST</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Single Post (article)', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_author',
                'name' => 'seo_title_author',
                'value' => KopaOptions::get_option('seo_title_author', 'Posts created by [author_name] - [site_name] - [site_desc]'),
                'default' => 'Posts created by [author_name] - [site_name] - [site_desc]',
                'label' => __('<code>AUTHOR</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Author Page (display all posts created by an author)', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_search',
                'name' => 'seo_title_search',
                'value' => KopaOptions::get_option('seo_title_search', 'Search pages: You searched for [search_phrase] return [search_result_count] results - [site_name] - [site_desc]'),
                'default' => 'Search pages: You searched for [search_phrase] return [search_result_count] results - [site_name] - [site_desc]',
                'label' => __('<code>SEARCH</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Search Page', kopa_get_domain()),
            ),
            array(
                'type' => 'text',
                'id' => 'seo_title_404',
                'name' => 'seo_title_404',
                'value' => KopaOptions::get_option('seo_title_404', 'Oops! 404 Page not found - [site_name] - [site_desc]'),
                'default' => 'Oops! 404 Page not found - [site_name] - [site_desc]',
                'label' => __('<code>404</code>', kopa_get_domain()),
                'classes' => array('kopa_sub_field_control'),
                'wrap_begin' => '<div class="kopa_sub_field_wrap">',
                'wrap_end' => '</div>',
                'help' => __('Page not found', kopa_get_domain()),
            )
        )
    );

    $groups['seo']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'seo_keywords',
        'name' => 'seo_keywords',
        'label' => __('Keywords', kopa_get_domain()),
        'help' => __('Enter your website keyword(s), separated by comma.<br/>This is global keywords, for each post, page, category, tag,.. you can manual append other keyword.', kopa_get_domain()),
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 4
        ),
        'default' => ''
    );

    $groups['seo']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'seo_descriptions',
        'name' => 'seo_descriptions',
        'label' => __('Description', kopa_get_domain()),
        'help' => __('Enter your website description.<br/>This is global description, It will be replace by manual description from post, page, category, tag,..', kopa_get_domain()),
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 4
        ),
        'default' => ''
    );
    
    $groups['seo']['fields'][] = array(
        'type' => 'media',
        'id' => 'seo_facebook_og_image',
        'name' => 'seo_facebook_og_image',
        'label' => __('Facebook Open Graph Image', kopa_get_domain()),
        'help' => '&lt;meta property="og:image" content="<code>YOUR IMAGE URL</code>"&gt;.'. __('<br/>It\'s default value for "og:image."', kopa_get_domain()),
        'default' => ''
    );

    $groups['seo']['fields'][] = array(
        'type' => 'text',
        'id' => 'seo_facebook_og_type',
        'name' => 'seo_facebook_og_type',
        'label' => __('Facebook Open Graph Type', kopa_get_domain()),
        'help' => '&lt;meta property="og:type" content="<code>website</code>"&gt;.'. __('<br/>Enter your custom object type OR set default value is "website"."', kopa_get_domain()),
        'default' => 'website'
    );
    
    $groups['seo']['fields'][] = array(
        'type' => 'text',
        'id' => 'seo_facebook_page_id',
        'name' => 'seo_facebook_page_id',
        'label' => __('Facebook Page ID', kopa_get_domain()),
        'help' => '&lt;meta property="fb:page_id" content="<code>1234567890</code>"&gt;',
        'default' => ''
    );

    $groups['seo']['fields'][] = array(
        'type' => 'text',
        'id' => 'seo_facebook_app_id',
        'name' => 'seo_facebook_app_id',
        'label' => __('Facebook App ID', kopa_get_domain()),
        'help' => '&lt;meta property="fb:app_id" content="<code>1234567890</code>"&gt;',
        'default' => ''
    );

    $groups['seo']['fields'][] = array(
        'type' => 'text',
        'id' => 'seo_facebook_admins',
        'name' => 'seo_facebook_admins',
        'label' => __('Facebook Admins', kopa_get_domain()),
        'help' => '&lt;meta property="fb:admins" content="<code>123,456,789</code>"&gt;',
        'default' => ''
    );

    $groups['seo']['fields'][] = array(
        'type' => 'text',
        'id' => 'seo_google_profile_url',
        'name' => 'seo_google_profile_url',
        'label' => __('Google profile', kopa_get_domain()),
        'help' => '&lt;link rel="author" href="<code>https://plus.google.com/1234567890</code>"&gt;<br/>' . sprintf(__('<a href="%s" target="_blank">Link to your Google+ profile using rel="author"</a>.', kopa_get_domain()), 'https://plus.google.com/authorship'),
        'default' => ''
    );

    $groups['seo']['fields'][] = array(
        'type' => 'text',
        'id' => 'seo_twitter_name',
        'name' => 'seo_twitter_name',
        'label' => __('Twitter cards', kopa_get_domain()),
        'help' => __('Please enter your twitter name with format <code>@your_name</code>', kopa_get_domain()),
        'default' => ''
    );

    /*
     * GOOGLE ANALYTICS
     * **************************** */

    $groups['analytics'] = array(
        'icon' => '',
        'title' => __('Google analytics', kopa_get_domain()),
        'fields' => array()
    );

    $groups['analytics']['fields'][] = array(
        'type' => 'textarea',
        'id' => 'tracking_code',
        'name' => 'tracking_code',
        'label' => NULL,
        'help' => __('Enter <a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a> code. This should be something like: <code>&ltscript type="text/javascript"&gt;  ...  &lt;/script&gt;</code>', kopa_get_domain()),
        'default' => '',
        'classes' => array('linedtextarea'),
        'attributes' => array(
            'rows' => 10
        ),
        'control_begin' => '<div class="col-md-12">',
        'control_end' => '</div>',
        'help_begin' => '<div class="col-md-12">',
        'help_end' => '</div>',
    );

    /*
     * WEBSITE VERIFICATION SERVICES
     * **************************** */

    $groups['verification-services'] = array(
        'icon' => '',
        'title' => __('Website Verification Services', kopa_get_domain()),
        'fields' => array()
    );
    $groups['verification-services']['fields'][] = array(
        'type' => 'text',
        'id' => 'google_verify_meta',
        'name' => 'google_verify_meta',
        'label' => __('Google Webmaster Tools', kopa_get_domain()),
        'default' => '',
        'help' => sprintf(__('Enter your meta key "content" value to verify your website with <a target="_blank" href="https://www.google.com/webmasters/tools/">Google Webmaster Tools</a>.<br/>Example:<br/>%s', kopa_get_domain()), '&lt;meta name="google-site-verification" content="<code>dBw5CvburAxi537Rp9qi5uG2174Vb6JwHwIRwPSLIK8</code>"&gt;')
    );

    $groups['verification-services']['fields'][] = array(
        'type' => 'text',
        'id' => 'bing_verify_meta',
        'name' => 'bing_verify_meta',
        'label' => __('Bing Webmaster Center', kopa_get_domain()),
        'default' => '',
        'help' => sprintf(__('Enter your meta key "content" value to verify your website with <a target="_blank" href="http://www.bing.com/webmaster/">Bing Webmaster Center</a>.<br/>Example:<br/>%s', kopa_get_domain()), '&lt;meta name="msvalidate.01" content="<code>12C1203B5086AECE94EB3A3D9830B2E</code>"&gt;')
    );

    $groups['verification-services']['fields'][] = array(
        'type' => 'text',
        'id' => 'pinterest_verify_meta',
        'name' => 'pinterest_verify_meta',
        'label' => __('Pinterest Site Verification', kopa_get_domain()),
        'default' => '',
        'help' => sprintf(__('Enter your meta key "content" value to verify your website with <a target="_blank" href="https://pinterest.com/website/verify/">Pinterest Site Verification</a>.<br/>Example:<br/>%s', kopa_get_domain()), '&lt;meta name="p:domain_verify" content="<code>f100679e6048d45e4a0b0b92dce1efce</code>"&gt;')
    );

    $groups['verification-services']['fields'][] = array(
        'type' => 'text',
        'id' => 'yandex_verify_meta',
        'name' => 'yandex_verify_meta',
        'label' => __('Yandex Webmaster', kopa_get_domain()),
        'default' => '',
        'help' => sprintf(__('Enter your meta key "content" value to verify your website with <a target="_blank" href="https://webmaster.yandex.com/sites/">Yandex Webmaster</a>.<br/>Example:<br/>%s', kopa_get_domain()), '&lt;meta name="yandex-verification" content="<code>44d68e1216009f40</code>"&gt;')
    );

    return apply_filters('kopa_options_seo', $groups);
}
