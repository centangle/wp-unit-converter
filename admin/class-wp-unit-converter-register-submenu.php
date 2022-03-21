<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter/admin
 * @subpackage Wpuc_Register_Submenu
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Registers the submenu page for plugin under Options Menu.
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/admin
 * @author     Centangle Interactive <hello@centangle.com>
 */
class Wp_Unit_Converter_Register_Submenu {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Registers Page in Options Menu.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_options_page() {

		add_options_page(
			'WP Unit Converter',
			'WP Unit Converter',
			'manage_options',
			'wpuc_options_submenu_page',
			array( $this, 'wpuc_options_submenu_page_callback' )
		);

	}

	/**
	 * Callback function for add_options_page function.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_options_submenu_page_callback() {

		// check if user is allowed access.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		};

		?>
		<form action='options.php' method='post'>

		<div id="wpuc_submenu_page">
		<h1>WP Unit Converter</h1>

		<hr class="wpuc_shortcode_hr">

		<br />

		<?php
		settings_fields( 'wpuc_options_submenu_page_reg_settings' );
		do_settings_sections( 'wpuc_options_submenu_page' );
		submit_button();
		?>

		</div> <!-- wpuc_submenu_page -->

		</form>
		<?php

	}

}
