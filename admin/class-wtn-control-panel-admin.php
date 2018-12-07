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
		add_menu_page( $this->plugin_name, 
					   esc_html__( 'WTN Control Panel', 'wtn-control-panel' ), 
					   'manage_options', 
					   $this->plugin_name . '-menu', 
					   'wtn_menu_func', 
					   plugin_dir_url( __FILE__ ) . 'images/WTNlogo_virag_24x24_wp.png',  //'dashicons-groups', 
					   11 );
		
		//Submenu page
		//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

		//videos
		// add_submenu_page(
		// 	$this->plugin_name . '-menu',
		// 	$this->plugin_name . ' - Videok',
		// 	'Videok',
		// 	'manage_options',
		// 	$this->plugin_name . '-submenu-videos'//,
		// 	// new_wtn_video()
		// );

		//GYIK
		add_submenu_page(
			$this->plugin_name . '-menu',
			$this->plugin_name . ' - Gyakran Ismételt Kérdések',
			'Gyakran Ismételt Kérdések',
			'manage_options',
			$this->plugin_name . '-submenu-faq',
			'wtn-submenu-faq-func'
		);

		// add_submenu_page(
		// 	'edit.php?post_type=job',
		// 	apply_filters($this->plugin_name . '-settings-page-title', esc_html__( 'WTN Control Panel Settings', 'wtn-control-panel' )),
		// 	apply_filters($this->plugin_name . '-settings-menu-title', esc_html__('Settings', 'wtn-control-panel')),
		// 	'manage_options',
		// 	$this->plugin_name . '-settings',
		// 	array( $this, 'page_options')
		// );

		// add_submenu_page(
		// 	'edit.php?post_type=job',
		// 	apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'WTN Control Panel Help', 'wtn-control-panel')),
		// 	apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Help', 'wtn-control-panel')),
		// 	'manage_options',
		// 	$this->plugin_name . 'help',
		// 	array($this, 'page_help')
		// );
	} //add_menu()	
	
	// public static function new_wtn_video() {
		
	// } //new_wtn_video
	public function cpt_wtn_video() {

		register_post_type('wtn_videok',
				array(
						'labels' 				=> array(              
						'name'               	=> __('Videok', 'wtn-videok'),
						'singular_name'      	=> __('Video', 'wtn-videok'),
						),
						'supports' 				=> array('title', 'editor', 'thumbnail'),
						'show_ui' 				=> true,
						'show_in_nav_menus' 	=> false,
						'show_in_menu' 			=> $this->plugin_name . '-menu',
				)
			);
	}

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

	/**
	* 	Displays admin notices
	* 
	* @return			string				Admin notices
	*/
	public function display_admin_notices() {
		$notices = get_option('wtn-control-panel-deferred-admin-notices');

		if	( empty( $notices ) ) { return; }

		foreach ($$notices as $notice) {
			echo '<div class="' . esc_attr( $notice['class'] ) . '"><p>' . $notice['notice'] . '</p></div>';
		}

		delete_option( 'wtn-control-panel-deferred-admin-notices');
	} //display_admin_notices



	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wtn-control-panel-admin.css', array(), $this->version, 'all' );
	} //enqueue styles

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

		 /*
		 * TODO: add enqueue script section, localization and fileuploader and anything that might be needed. 
		 * Hooks needs to be here in the cp plugin
		 * */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wtn-control-panel-admin.js', array( 'jquery' ), $this->version, false );

	} //enqueue_scripts

	/**
	 * Creates a checkbox field
	 * 
	 * @param		array		$args		The arguments for the field
	 * @return		string					The HTML field
	 */

	public function field_checkbox( $args ) {
		$defaults['class']							= '';
		$defaults['description']					= '';
		$defaults['label']							= '';
		$defaults['name']							= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['value']							= 0;

		apply_filters($this->plugin_name . '-field-checkbox-options-defaults', $defaults);

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}

		// TODO: Write admin-field-checkbox.php
		include( plugin_dir_path(__FILE__) . 'partials/' . $this->plugin_name - '-admin-field-checkbox.php');
	} //field_checkbox

	/**
	 * Crates an editor field
	 *
	 * NOTE: ID must only be lowercase, no space, no dashes, no underscores.
	 *
	 * @param		array		$args		The arguments for the field
	 * @return		string					The HTML field
	*/

	public function field_editor ( $args ) {
		$defaults['description']				= '';
		$defaults['settings']					= array( 'textarea_name' => $this->plugin_name . '-options[' . $args['id'] . ']' );
		$defaults['value']						= '';

		apply_filters( $this->plugin_name . '-field-editor-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}

		include( plugin_dir_path(__FILE__) . 'partials/' . $this->plugin_name . '-admin-field-editor.php' );

	} //field_editor

	/**
	 * Creates a set of radios field
	 * 
	 * @param		array		$args		The arguments of the field
	 * @return	string					The HTML field
	*/

	public function field_radios( $args ) {
	   	$defaults['class']					= '';
		$defaults['description']			= '';
		$defaults['label']					= '';
		$defaults['name']					= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['value']					= 0;

		apply_filters( $this->plugin_name . '-field-radios-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}

		include( plugin_dir_path(__FILE__) . 'partials/' . $this->plugin_name . '-admin-field-radios.php');

	} //field_radios

	public function field_repeater( $args ) {
		$defaults['class'] 			= 'repeater';
		$defaults['fields'] 		= array();
		$defaults['id'] 			= '';
		$defaults['label-add'] 		= 'Add Item';
		$defaults['label-edit'] 	= 'Edit Item';
		$defaults['label-header'] 	= 'Item Name';
		$defaults['label-remove'] 	= 'Remove Item';
		$defaults['title-field'] 	= '';
	/*
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
	*/

		apply_filters( $this->plugin_name . '-field-repeater-options-defaults', $defaults );
		$setatts 	= wp_parse_args( $args, $defaults );
		$count 		= 1;
		$repeater 	= array();
		if ( ! empty( $this->options[$setatts['id']] ) ) {
			$repeater = maybe_unserialize( $this->options[$setatts['id']][0] );
		}

		if ( ! empty( $repeater ) ) {
			$count = count( $repeater );
		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-repeater.php' );
	} // field_repeater()

	/**
	 * Creates a select field
	 *
	 * Note: label is blank since its created in the Settings API
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	*/
		 
	public function field_select( $args ) {
		$defaults['aria'] 			= '';
		$defaults['blank'] 			= '';
		$defaults['class'] 			= 'widefat';
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['selections'] 	= array();
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-select-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}

		if ( empty( $atts['aria'] ) && ! empty( $atts['description'] ) ) {
			$atts['aria'] = $atts['description'];
		} elseif ( empty( $atts['aria'] ) && ! empty( $atts['label'] ) ) {
			$atts['aria'] = $atts['label'];
		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-select.php' );

	} // field_select()

	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_text( $args ) {
		$defaults['class'] 			= 'text widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-text.php' );

	} // field_text()

	/**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_textarea( $args ) {
		$defaults['class'] 			= 'large-text';
		$defaults['cols'] 			= 50;
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['rows'] 			= 10;
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-textarea-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-textarea.php' );
	} // field_textarea()

	/**
	 * Returns an array of options names, fields types, and default values
	 * 
	 * @return	array						An array of options
	*/

	public static function get_options_list() {
		$options = array();

		/**
		* TODO: Write code here for options list. Example lines below.
		*
		* $options[] = array( 'message-no-openings', 'text', 'Thank you for your interest! There are no job openings at this time.' );
		* $options[] = array( 'howtoapply', 'editor', '' );
		* $options[] = array( 'repeat-test', 'repeater', array( array( 'test1', 'text' ), array( 'test2', 'text' ), array( 'test3', 'text' ) ) );
		*/ 

		return $options;

	} // get_options_list()

	/**
	 * Adds links to the plugin links row
	 * 
	 * @since		1.0.0
	 * @param		array		$links		The current array of row links
	 * @param		string		$file		The name of the file
	 * @return		array					The modified array of row links
	 */
	public function link_row( $links, $file) {
		/**
		 * TODO: write
		 * 
		 */

		return $links;
	} // links-row
}
