<?php

/**
 *
 * @link              https://markozivanovic.com
 * @since             1.0.2
 * @package           Tooloodr
 *
 * @wordpress-plugin
 * Plugin Name:       TooLooDR
 * Plugin URI:        https://tooloodr.com
 * Description:       TooLooDR is a writing and reading concept that aims to present one article in several forms and lengths by separating the content into multiple levels of detail. Its structure guides the author to think in terms of complexity, lengthiness, and targeted audience for each level they create.
 * Version:           1.0.0
 * Author:            Marko Zivanovic
 * Author URI:        https://markozivanovic.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tooloodr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TOOLOODR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tooloodr-activator.php
 */
function activate_tooloodr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tooloodr-activator.php';
	Tooloodr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tooloodr-deactivator.php
 */
function deactivate_tooloodr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tooloodr-deactivator.php';
	Tooloodr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tooloodr' );
register_deactivation_hook( __FILE__, 'deactivate_tooloodr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tooloodr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tooloodr() {

	$plugin = new Tooloodr();
	$plugin->run();

}

run_tooloodr();


