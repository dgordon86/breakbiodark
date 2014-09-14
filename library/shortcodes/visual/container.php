<div id="kopa_container_builder" class="kopa_visual_shortcode">
    <div class="kopa_shortcode_field row clearfix">       
        <div class="col-sm-12">
            <h3 class="kopa_shortcode_caption"><?php _e('Container Builder', kopa_get_domain()); ?></h3>
        </div>
    </div>                
    <div class="kopa_shortcode_inline">
        <div class="kopa_shortcode_field_private kopa_shortcode_field row clearfix" style="display: none;">       
            <div class="col-sm-3 kopa_shortcode_field_title"><?php _e('Tab style', kopa_get_domain()); ?></div>           
            <div class="col-xs-9">                
                <select class="kopa_shortcode_tab_style" autocomplete="off">
                    <option value="horizontal" selected="selected"><?php _e('Horizontal', kopa_get_domain()); ?></option>
                    <option value="vertical"><?php _e('Vertical', kopa_get_domain()); ?></option>
                </select>       
            </div>
        </div>

        <div class="kopa_shortcode_field_private kopa_shortcode_field row clearfix" style="display: none;">       
            <div class="col-sm-3 kopa_shortcode_field_title"><?php _e('Width of tab title (only vertical)', kopa_get_domain()); ?></div>           
            <div class="col-xs-9">                
                <input type="number" value="200" class="kopa_shortcode_tab_title_width" autocomplete="off">
            </div>
        </div>

        <div class="kopa_shortcode_field kopa_shortcode_container_element row clearfix">            
            <div class="col-xs-9">
                <input type="text" placeholder="<?php _e('Title', kopa_get_domain()); ?>" class="kopa_container_element_title kopa_control_width_100percent" autocomplete="off">
                <br/><br/>
                <textarea placeholder="<?php _e('Enter your content', kopa_get_domain()); ?>" class="kopa_container_element_content kopa_control_width_100percent" rows="5" autocomplete="off"></textarea>                
            </div>
            <div class="col-xs-3">                                            
                <a href="#" class="button button-secondary pull-right" onclick="KopaShortcode.remove_container_element(event, jQuery(this));"><?php _e('remove', kopa_get_domain()); ?></a>
            </div>
        </div>

        <div class="kopa_shortcode_field row clearfix">       
            <div class="col-sm-12">
                <a href="#" class="button button-secondary pull-left" onclick="KopaShortcode.add_container_element(event, jQuery('#kopa_container_builder'));"><?php _e('Add new element', kopa_get_domain()); ?></a>
                <a href="#" class="button button-primary pull-right" onclick="KopaShortcode.create_button(event, 'container');"><?php _e('Insert', kopa_get_domain()); ?></a>                        
            </div>
        </div>   

    </div>
</div>