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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register and Load the Widget.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_options_page() {

		add_options_page(
			'WP Unit Converter', 
			'WP Unit Converter', 
			'manage_options', 
			__FILE__, 
			array($this, 'wpuc_submenu_options')
		);

	}

	/**
	 * Callback function for add_options_page function.
	 *
	 * @since    1.0.0
	 */

	public function wpuc_submenu_options() {

		$wpuc_metrics_array = Wp_Unit_Converter_Public::wpuc_import_json();

		$wpuc_metrics = $wpuc_metrics_array['metrics'];

		?>

		<div>
		<h1>WP Unit Converter</h1>
		</div>

		<hr class="wpuc_shortcode_hr">
		
		<br />

		<div>
		<h2 class="wpuc_shortcode_heading">WP Unit Converter Multiple Metrics</h2>
		<pre class="wpuc_shortcode">[wpuc_unit_converter]</pre>
		</div>

		<?php

		foreach ($wpuc_metrics as $key => $value) {

		?>

		<div>
		<h2 class="wpuc_shortcode_heading"><?php echo $value['title']; ?></h2>
		<pre class="wpuc_shortcode">[wpuc_unit_converter converter=<?php echo $key ?>]</pre>
		</div>

		<?php
		
		}

	}
	
}
