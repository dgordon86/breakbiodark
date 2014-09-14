<div id="kopa_button_builder" class="kopa_visual_shortcode">
    <div class="kopa_shortcode_field row clearfix">       
        <div class="col-sm-12">
            <h3 class="kopa_shortcode_caption"><?php _e('Button builder', kopa_get_domain()); ?></h3>
        </div>
    </div>                
    <div class="kopa_shortcode_inline">
        <div class="kopa_shortcode_field row clearfix">
            <div class="col-sm-3 kopa_shortcode_field_title"><?php _e('Button Text', kopa_get_domain()); ?></div>
            <div class="col-sm-9"><input class="ks_button_text kopa_control_width_100percent" type="text" autocomplete="off"></div>
        </div>

        <div class="kopa_shortcode_field row clearfix">
            <div class="col-sm-3 kopa_shortcode_field_title"><?php _e('Button Link', kopa_get_domain()); ?></div>
            <div class="col-sm-9"><input class="ks_button_link kopa_control_width_100percent" type="text" autocomplete="off"></div>
        </div>

        <div class="kopa_shortcode_field row clearfix">
            <div class="col-sm-3 kopa_shortcode_field_title"><?php _e('Open link on new tab', kopa_get_domain()); ?></div>
            <div class="col-sm-9">                                          
                <select class="ks_button_link_target kopa_control_width_50percent" autocomplete="off">
                    <option value="_blank" selected="selected"><?php _e('Yes', kopa_get_domain()); ?></option>
                    <option value=""><?php _e('No', kopa_get_domain()); ?></option>
                </select>                                            
            </div>
        </div>

        <div class="kopa_shortcode_field row clearfix">
            <div class="col-sm-3 kopa_shortcode_field_title"><?php _e('Button Style', kopa_get_domain()); ?></div>
            <div class="col-sm-9">
                <div class="kopa_shortcode_field  row clearfix">
                    <div class="col-xs-1">
                        <input id="ks_button_type_1" class="ks_button_type" name="ks_button_type" value="btn btn-sm" type="radio" checked="checked" autocomplete="off">
                    </div>
                    <div class="col-xs-5">
                        <label for="ks_button_type_1" class="kp-button"><?php _e('Small', kopa_get_domain()); ?></label>
                    </div>

                    <div class="col-xs-1">
                        <input id="ks_button_type_2" class="ks_button_type" name="ks_button_type" value="btn btn-sm style-2" type="radio" checked="checked" autocomplete="off">
                    </div>
                    <div class="col-xs-5">
                        <label for="ks_button_type_2" class="kp-bline-button"><?php _e('Small', kopa_get_domain()); ?></label>
                    </div>
                </div>

                <div class="kopa_shortcode_field  row clearfix">
                    <div class="col-xs-1">
                        <input id="ks_button_type_3" class="ks_button_type" name="ks_button_type" value="btn" type="radio" checked="checked" autocomplete="off">
                    </div>
                    <div class="col-xs-5">
                        <label for="ks_button_type_3" class="kp-button medium-button"><?php _e('Medium', kopa_get_domain()); ?></label>
                    </div>

                    <div class="col-xs-1">
                        <input id="ks_button_type_4" class="ks_button_type" name="ks_button_type" value="btn style-2" type="radio" checked="checked" autocomplete="off">
                    </div>
                    <div class="col-xs-5">
                        <label for="ks_button_type_4" class="kp-bline-button medium-button"><?php _e('Medium', kopa_get_domain()); ?></label>
                    </div>
                </div>

                <div class="kopa_shortcode_field  row clearfix">
                    <div class="col-xs-1">
                        <input id="ks_button_type_5" class="ks_button_type" name="ks_button_type" value="btn btn-lg" type="radio" checked="checked" autocomplete="off">
                    </div>
                    <div class="col-xs-5">
                        <label for="ks_button_type_5" class="kp-button big-button"><?php _e('Big', kopa_get_domain()); ?></label>
                    </div>

                    <div class="col-xs-1">
                        <input id="ks_button_type_6" class="ks_button_type" name="ks_button_type" value="btn btn-lg style-2" type="radio" checked="checked" autocomplete="off">
                    </div>
                    <div class="col-xs-5">
                        <label for="ks_button_type_6" class="kp-bline-button big-button"><?php _e('Big', kopa_get_domain()); ?></label>
                    </div>
                </div>


            </div>                                        
        </div>

        <div class="kopa_shortcode_field row clearfix">       
            <div class="col-sm-12">                
                <a href="#" class="button button-primary pull-right" onclick="KopaShortcode.create_button(event, 'button');"><?php _e('Insert', kopa_get_domain()); ?></a>                        
            </div>
        </div>   
    </div>
</div>    