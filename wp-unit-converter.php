<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              centangle.com
 * @since             1.0.1
 * @package           Wp_Unit_Converter
 *
 * @wordpress-plugin
 * Plugin Name:       WP Unit Converter
 * Plugin URI:        https://github.com/centangle/wp-unit-converter
 * Description:       WP Unit Converter let's you convert into different units of six different metrics.
 * Version:           1.0.5
 * Author:            Centangle Interactive
 * Author URI:        centangle.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpuc
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
define( 'WP_UNIT_CONVERTER_VERSION', '1.0.5' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-unit-converter-activator.php
 */
function activate_wp_unit_converter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-unit-converter-activator.php';
	Wp_Unit_Converter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-unit-converter-deactivator.php
 */
function deactivate_wp_unit_converter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-unit-converter-deactivator.php';
	Wp_Unit_Converter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_unit_converter' );
register_deactivation_hook( __FILE__, 'deactivate_wp_unit_converter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-unit-converter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_unit_converter() {

	$plugin = new Wp_Unit_Converter();
	$plugin->run();

}
run_wp_unit_converter();
