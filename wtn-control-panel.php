<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.terrastormsolutions.com
 * @since             1.0.0
 * @package           Wtn_Control_Panel
 *
 * @wordpress-plugin
 * Plugin Name:       WTN Control Panel
 * Plugin URI:        http://www.wisetreenaturals.hu
 * Description:       A WTN által használt összes WP plugin egy helyen A menüből elérhető az összes bővítmény.
 * Version:           0.0.1
 * Author:            TerraStorm Solutions
 * Author URI:        http://www.terrastormsolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wtn-control-panel
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wtn-control-panel-activator.php
 */
function activate_wtn_control_panel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wtn-control-panel-activator.php';
	Wtn_Control_Panel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wtn-control-panel-deactivator.php
 */
function deactivate_wtn_control_panel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wtn-control-panel-deactivator.php';
	Wtn_Control_Panel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wtn_control_panel' );
register_deactivation_hook( __FILE__, 'deactivate_wtn_control_panel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wtn-control-panel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wtn_control_panel() {

	$plugin = new Wtn_Control_Panel();
	$plugin->run();

}
run_wtn_control_panel();
