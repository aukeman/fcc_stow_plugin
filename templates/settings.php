<div class="wrap">
    <h2>Sermon Archive</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('fcc_stow_sermon_setting-group'); ?>
        <?php @do_settings_fields('fcc_stow_sermon_setting-group'); ?>

        <?php do_settings_sections('fcc_stow_sermon_setting'); ?>

        <?php @submit_button(); ?>
    </form>
</div>