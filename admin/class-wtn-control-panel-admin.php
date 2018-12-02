<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.terrastormsolutions.com
 * @since      1.0.0
 *
 * @package    Wtn_Control_Panel
 * @subpackage Wtn_Control_Panel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wtn_Control_Panel
 * @subpackage Wtn_Control_Panel/admin
 * @author     TerraStorm Solutions <info@terrastormsolutions.com>
 */
class Wtn_Control_Panel_Admin {

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    			The plugin options.
	 */
	private $options;
	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 			The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 				The current version of this plugin.
	 */
	private $version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$wtn-control-panel 		The name of this plugin.
	 * @param 		string 			$version 				The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */

	public static function add_admin_notices() {
		$notices		=	get_option( 'wtn_control_panel_deferred_admin_notices', array() );

		apply_filters('wtn_control_panel_admin_notices', $notices);
		update_option('wtn_control_panel_deferred_admin_notices', $notices);
	} //add_admin_notices

	public function add_menu() {
		//Top level page
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

		//Submenu page
		//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

		add_submenu_page(
			'edit.php?post_type=job',
			apply_filters($this->plugin_name . '-settings-page-title', esc_html__( 'WTN Control Panel Settings', 'wtn-control-panel' )),
			apply_filters($this->plugin_name . '-settings-menu-title', esc_html__('Settings', 'wtn-control-panel')),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options')
		);

		add_submenu_page(
			'edit.php?post_type=job',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'WTN Control Panel Help', 'wtn-control-panel')),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Help', 'wtn-control-panel')),
			'manage_options',
			$this->plugin_name . 'help',
			array($this, 'page_help')
		);
	} //add_menu()	

		/**
		*	Manages any updates or upgrades needed before displaying notices.
		*	Checks the plugin version against version required for displaying notices.
		*/

		public function admin_notices_init() {
			$current_version = '1.0.0';

			if ($this->version !== $current_version) {
					//Upgrades needed, code goes here
					update_option('my_plugin_version', $current_version);

					$this->add_notice();
			}
		} //admin_notices_init


	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wtn_Control_Panel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wtn_Control_Panel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wtn-control-panel-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wtn_Control_Panel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wtn_Control_Panel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wtn-control-panel-admin.js', array( 'jquery' ), $this->version, false );

	}



}
