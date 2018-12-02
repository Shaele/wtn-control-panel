<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.terrastormsolutions.com
 * @since      1.0.0
 *
 * @package    Wtn_Control_Panel
 * @subpackage Wtn_Control_Panel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wtn_Control_Panel
 * @subpackage Wtn_Control_Panel/includes
 * @author     TerraStorm Solutions <info@terrastormsolutions.com>
 */
class Wtn_Control_Panel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wtn-control-panel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
