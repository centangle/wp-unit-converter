<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter/admin
 * @subpackage Wpuc_Register_Settings
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Registers Field settings for the option submenu page for plugin under Options Menu
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/admin
 * @author     Centangle Interactive <hello@centangle.com>
 */
class Wp_Unit_Converter_Register_Settings {

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
	 * Registers Fields and save values in db.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_options_submenu_page_fields() {

		register_setting( 
			'wpuc_options_submenu_page_reg_settings',
			'wpuc_options'
		);

		add_settings_section(
			'wpuc_options_submenu_page_section',
			'',
			'',
			'wpuc_options_submenu_page'
		);
	
		add_settings_field(
			'wpuc_options_submenu_page_field_shortcode',
			'',
			array($this, 'wpuc_options_submenu_page_field_shortcode_render_callback'),
			'wpuc_options_submenu_page',
			'wpuc_options_submenu_page_section'
		);
	
		add_settings_field(
			'wpuc_options_submenu_page_field_orientation',
			'',
			'wpuc_options_submenu_page_field_orientation_render_callback',
			'wpuc_options_submenu_page',
			'wpuc_options_submenu_page_section'
		);

	}

	public function wpuc_options_submenu_page_field_shortcode_render_callback() {

		echo '<h1> It is Working! </h1>';

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

	public function wpuc_options_submenu_page_field_orientation_render_callback() {
		return;
	}
	
}
