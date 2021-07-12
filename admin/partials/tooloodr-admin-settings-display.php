<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2 class="tooloo-heading"><span class="dashicons dashicons-edit"></span>TooLooDR Settings</h2>
    <?php settings_errors(); ?>

    <?php
        if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = $_GET[ 'tab' ];
        }
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings';
    ?>

    <form method="POST" action="options.php">
        <h2 class="nav-tab-wrapper">
            <a href="?page=tooloodr&tab=general_settings"
                class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-admin-tools"></span> General</a>
            <a href="?page=tooloodr&tab=buttons_settings"
                class="nav-tab <?php echo $active_tab == 'buttons_settings' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-button"></span> Buttons</a>
            <a href="?page=tooloodr&tab=reading_settings"
                class="nav-tab <?php echo $active_tab == 'reading_settings' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-clock"></span> Reading
                Times</a>
            <a href="?page=tooloodr&tab=levels_settings"
                class="nav-tab <?php echo $active_tab == 'levels_settings' ? 'nav-tab-active' : ''; ?>"><span class="dashicons dashicons-chart-bar"></span> TooLoo
                Levels</a>
        </h2>
        <?php 
                if ('general_settings' == $active_tab) {
                    settings_fields('tooloodr_general_settings');
                    do_settings_sections('tooloodr_general_settings');
                } else if ('buttons_settings' == $active_tab) {
                    settings_fields('tooloodr_buttons_settings');
                    do_settings_sections('tooloodr_buttons_settings'); 
                } else if ('reading_settings' == $active_tab) {
                    settings_fields('tooloodr_reading_settings');
                    do_settings_sections('tooloodr_reading_settings');
                } else if ('levels_settings') {
                    settings_fields('tooloodr_levels_settings');
                    do_settings_sections('tooloodr_levels_settings'); 
                }
		?>
        <?php submit_button(); ?>
    </form>
</div>