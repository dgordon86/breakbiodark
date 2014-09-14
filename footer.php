<?php
$footer_infor = KopaOptions::get_option('copyright');
?>

<?php if ($footer_infor || has_nav_menu('bottom-nav')): ?>
    <div id="page-footer" >
        <div class="container">
            <?php if ($footer_infor): ?>
                <p class="copy-right pull-left"><?php echo $footer_infor; ?></p>
            <?php endif; ?>

            <?php
            #BOTTOM MENU
            if (has_nav_menu('bottom-nav')) {
                wp_nav_menu(
                        array(
                            'theme_location' => 'bottom-nav',
                            'container' => false,
                            'menu_id' => 'bottom-menu',
                            'menu_class' => 'list-inline pull-right bottom-menu'
                        )
                );
            }
            ?>
        </div>
    </div>
<?php endif; ?>

<div id="kopa_overlay_loader">
    <img src="<?php echo get_template_directory_uri().'/library/images/loading.gif';?>">
</div>

<?php wp_footer(); ?>
</body>
</html>