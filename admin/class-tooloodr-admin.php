<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @see       https://markozivanovic.com
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Marko Zivanovic <marko@markozivanovic.com>
 */
class Tooloodr_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string the ID of this plugin
     */
    private $tooloodr;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string the current version of this plugin
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $tooloodr the name of this plugin
     * @param string $version  the version of this plugin
     */
    public function __construct($tooloodr, $version)
    {
        $this->tooloodr = $tooloodr;
        $this->version = $version;

        add_action('admin_menu', [$this, 'addPluginAdminMenu'], 9);
        add_action('admin_init', [$this, 'registerAndBuildFields']);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->tooloodr, plugin_dir_url(__FILE__).'css/tooloodr-admin.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->tooloodr, plugin_dir_url(__FILE__).'js/tooloodr-admin.js', ['jquery'], $this->version, false);
    }

    public function addPluginAdminMenu()
    {
        add_menu_page($this->tooloodr, 'TooLooDR', 'administrator', $this->tooloodr, [$this, 'displayPluginAdminSettings'], 'dashicons-edit', 26);
    }

    public function displayPluginAdminSettings()
    {
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
        if (isset($_GET['error_message'])) {
            add_action('admin_notices', [$this, 'tooloodrSettingsMessages']);
            do_action('admin_notices', $_GET['error_message']);
        }

        require_once 'partials/'.$this->tooloodr.'-admin-settings-display.php';
    }

    public function tooloodrSettingsMessages($error_message)
    {
        switch ($error_message) {
                case '1':
                        $message = __('There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain'); $err_code = esc_attr('tooloodr_defaultTooLooLevel'); 
                        $setting_field = 'tooloodr_defaultTooLooLevel';
                        break;
        }
        $type = 'error';
        add_settings_error(
            $setting_field,
            $err_code,
            $message,
            $type
        );
    }

    public function registerAndBuildFields()
    {
        add_settings_section('tooloodr_general_section', 'General Settings', [$this, 'tooloodr_display_general_section'], 'tooloodr_general_settings');
        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'number',
            'min' => 1,
            'max' => 3,
            'id' => 'tooloodr_defaultTooLooLevel',
            'name' => 'tooloodr_defaultTooLooLevel',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_defaultTooLooLevel', 'Default TooLooDR Level', [$this, 'tooloodr_render_settings_field'], 'tooloodr_general_settings', 'tooloodr_general_section', $args);

        register_setting(
            'tooloodr_general_settings',
            'tooloodr_defaultTooLooLevel'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'checkbox',
            'id' => 'tooloodr_textHighlighting',
            'name' => 'tooloodr_textHighlighting',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_textHighlighting', 'Text Highlighting', [$this, 'tooloodr_render_settings_field'], 'tooloodr_general_settings', 'tooloodr_general_section', $args);

        register_setting(
            'tooloodr_general_settings',
            'tooloodr_textHighlighting'
        );

        add_settings_section('tooloodr_button_section', 'Button Settings', [$this, 'tooloodr_display_buttons_section'], 'tooloodr_buttons_settings');
    
        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'checkbox',
            'id' => 'tooloodr_buttonLabelsShow',
            'name' => 'tooloodr_buttonLabelsShow',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonLabelsShow', 'Show button labels', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonLabelsShow'
        );


        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonLabelsTooLoo1',
            'name' => 'tooloodr_buttonLabelsTooLoo1',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonLabelsTooLoo1', 'TooLoo1 button label', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonLabelsTooLoo1'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonLabelsTooLoo2',
            'name' => 'tooloodr_buttonLabelsTooLoo2',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonLabelsTooLoo2', 'TooLoo2 button label', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonLabelsTooLoo2'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonLabelsTooLoo3',
            'name' => 'tooloodr_buttonLabelsTooLoo3',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonLabelsTooLoo3', 'TooLoo3 button label', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonLabelsTooLoo3'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsTooLoo1Text',
            'name' => 'tooloodr_buttonColorsTooLoo1Text',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsTooLoo1Text', 'TooLoo1 button label color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsTooLoo1Text'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsTooLoo2Text',
            'name' => 'tooloodr_buttonColorsTooLoo2Text',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsTooLoo2Text', 'TooLoo2 button label color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsTooLoo2Text'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsTooLoo3Text',
            'name' => 'tooloodr_buttonColorsTooLoo3Text',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsTooLoo3Text', 'TooLoo3 button label color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsTooLoo3Text'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsTooLoo1Background',
            'name' => 'tooloodr_buttonColorsTooLoo1Background',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsTooLoo1Background', 'TooLoo1 button background', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsTooLoo1Background'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsTooLoo2Background',
            'name' => 'tooloodr_buttonColorsTooLoo2Background',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsTooLoo2Background', 'TooLoo2 button background', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsTooLoo2Background'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsTooLoo3Background',
            'name' => 'tooloodr_buttonColorsTooLoo3Background',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsTooLoo3Background', 'TooLoo3 button background', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsTooLoo3Background'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_buttonColorsActiveBorderColor',
            'name' => 'tooloodr_buttonColorsActiveBorderColor',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_buttonColorsActiveBorderColor', 'Button active border color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_buttons_settings', 'tooloodr_button_section', $args);

        register_setting(
            'tooloodr_buttons_settings',
            'tooloodr_buttonColorsActiveBorderColor'
        );

        add_settings_section('tooloodr_reading_section', 'Reading Time Settings', [$this, 'tooloodr_display_reading_section'], 'tooloodr_reading_settings');

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'checkbox',
            'id' => 'tooloodr_readingTimeShow',
            'name' => 'tooloodr_readingTimeShow',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_readingTimeShow', 'Show reading times', [$this, 'tooloodr_render_settings_field'], 'tooloodr_reading_settings', 'tooloodr_reading_section', $args);

        register_setting(
            'tooloodr_reading_settings',
            'tooloodr_readingTimeShow'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'number',
            'id' => 'tooloodr_readingWordsPerMin',
            'name' => 'tooloodr_readingWordsPerMin',
            'min' => 0,
            'max' => 999,
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_readingWordsPerMin', 'Words per minute', [$this, 'tooloodr_render_settings_field'], 'tooloodr_reading_settings', 'tooloodr_reading_section', $args);

        register_setting(
            'tooloodr_reading_settings',
            'tooloodr_readingWordsPerMin'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_readingLabelSeparator',
            'name' => 'tooloodr_readingLabelSeparator',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_readingLabelSeparator', 'Separator from label text', [$this, 'tooloodr_render_settings_field'], 'tooloodr_reading_settings', 'tooloodr_reading_section', $args);

        register_setting(
            'tooloodr_reading_settings',
            'tooloodr_readingLabelSeparator'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'checkbox',
            'id' => 'tooloodr_readingShowPercentage',
            'name' => 'tooloodr_readingShowPercentage',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_readingShowPercentage', 'Show percentage of text', [$this, 'tooloodr_render_settings_field'], 'tooloodr_reading_settings', 'tooloodr_reading_section', $args);

        register_setting(
            'tooloodr_reading_settings',
            'tooloodr_readingShowPercentage'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_readingPercentageSeparator',
            'name' => 'tooloodr_readingPercentageSeparator',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_readingPercentageSeparator', 'Separator from time', [$this, 'tooloodr_render_settings_field'], 'tooloodr_reading_settings', 'tooloodr_reading_section', $args);

        register_setting(
            'tooloodr_reading_settings',
            'tooloodr_readingPercentageSeparator'
        );

        add_settings_section('tooloodr_level_section', 'TooLoo Levels Settings', [$this, 'tooloodr_display_level_section'], 'tooloodr_levels_settings');

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_levelColorsTooLoo1Text',
            'name' => 'tooloodr_levelColorsTooLoo1Text',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_levelColorsTooLoo1Text', 'TooLoo1 level text color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_levels_settings', 'tooloodr_level_section', $args);

        register_setting(
            'tooloodr_levels_settings',
            'tooloodr_levelColorsTooLoo1Text'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_levelColorsTooLoo2Text',
            'name' => 'tooloodr_levelColorsTooLoo2Text',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_levelColorsTooLoo2Text', 'TooLoo2 level text color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_levels_settings', 'tooloodr_level_section', $args);

        register_setting(
            'tooloodr_levels_settings',
            'tooloodr_levelColorsTooLoo2Text'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_levelColorsTooLoo3Text',
            'name' => 'tooloodr_levelColorsTooLoo3Text',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_levelColorsTooLoo3Text', 'TooLoo3 level text color', [$this, 'tooloodr_render_settings_field'], 'tooloodr_levels_settings', 'tooloodr_level_section', $args);

        register_setting(
            'tooloodr_levels_settings',
            'tooloodr_levelColorsTooLoo3Text'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_levelColorsTooLoo1Background',
            'name' => 'tooloodr_levelColorsTooLoo1Background',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_levelColorsTooLoo1Background', 'TooLoo1 level background', [$this, 'tooloodr_render_settings_field'], 'tooloodr_levels_settings', 'tooloodr_level_section', $args);

        register_setting(
            'tooloodr_levels_settings',
            'tooloodr_levelColorsTooLoo1Background'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_levelColorsTooLoo2Background',
            'name' => 'tooloodr_levelColorsTooLoo2Background',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_levelColorsTooLoo2Background', 'TooLoo2 level background', [$this, 'tooloodr_render_settings_field'], 'tooloodr_levels_settings', 'tooloodr_level_section', $args);

        register_setting(
            'tooloodr_levels_settings',
            'tooloodr_levelColorsTooLoo2Background'
        );

        unset($args);
        $args = [
            'type' => 'input',
            'subtype' => 'text',
            'id' => 'tooloodr_levelColorsTooLoo3Background',
            'name' => 'tooloodr_levelColorsTooLoo3Background',
            'required' => 'true',
            'get_options_list' => '',
            'value_type' => 'normal',
            'wp_data' => 'option',
        ];
        add_settings_field('tooloodr_levelColorsTooLoo3Background', 'TooLoo3 level background', [$this, 'tooloodr_render_settings_field'], 'tooloodr_levels_settings', 'tooloodr_level_section', $args);

        register_setting(
            'tooloodr_levels_settings',
            'tooloodr_levelColorsTooLoo3Background'
        );

    }

    public function tooloodr_display_general_section()
    {
        echo '<p>TooLooDR is built in a way that almost everything is configurable. If that might not be enough, you can style particular elements of TooLooDR through your theme\'s style.css.</p>';
        echo '<p>You can find a detailed explanation of all options <a href="https://www.tooloodr.com/documentation/index.html#configuration">here</a>.</p>';
    }

    public function tooloodr_display_buttons_section()
    {
        echo '<p>Check the detailed information about each setting <a href="https://www.tooloodr.com/documentation/index.html#buttons">here</a>.</p>';
    }

    public function tooloodr_display_reading_section()
    {
        echo '<p>Check the detailed information about each setting <a href="https://www.tooloodr.com/documentation/index.html#reading-time">here</a>.</p>';
    }

    public function tooloodr_display_level_section()
    {
        echo '<p>Check the detailed information about each setting <a href="https://www.tooloodr.com/documentation/index.html#levels">here</a>.</p>';
        echo '<p>Note: If you don\'t want the levels to have a background color (you want to use the background of your WordPress theme), you can set it to "transparent".</p>';
    }

    public function tooloodr_render_settings_field($args)
    {
        if ('option' == $args['wp_data']) {
            $wp_data_value = get_option($args['name']);
        } elseif ('post_meta' == $args['wp_data']) {
            $wp_data_value = get_post_meta($args['post_id'], $args['name'], true);
        }

        if ($args['type'] == 'input') {
            $value = ('serialized' == $args['value_type']) ? serialize($wp_data_value) : $wp_data_value;
            if ('checkbox' != $args['subtype']) {
                $prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
                $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
                $step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
                $min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
                $max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
                if (isset($args['disabled'])) {
                    echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="'.esc_attr($value).'" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="'.esc_attr($value).'" />'.$prependEnd;
                } else {
                    echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="'.esc_attr($value).'" />'.$prependEnd;
                }
            } else {
                $checked = ($value) ? 'checked' : '';
                echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
            }
        }
    }
}