<form method="get" id="<?php echo "search-form-" . rand(0, 9999); ?>" class="search-form clearfix" action="<?php echo trailingslashit(home_url()); ?>">
    <div class="form-group pull-left">
        <input type="text"  name="s" class="form-control" onBlur="if ('' === this.value)
                    this.value = this.defaultValue;" onFocus="if (this.value === this.defaultValue)
                                this.value = '';" value="<?php _e('Search...', kopa_get_domain()); ?>" >
    </div>
    <button type="submit" class="search-submit"><?php echo KopaIcon::getIcon('fa fa-search'); ?></button>
</form>
