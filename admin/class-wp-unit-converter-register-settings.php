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
			array($this, 'wpuc_options_submenu_page_field_orientation_render_callback'),
			'wpuc_options_submenu_page',
			'wpuc_options_submenu_page_section'
		);

	}

	public function wpuc_options_submenu_page_field_shortcode_render_callback() {

		$wpuc_metrics_array = Wp_Unit_Converter_Public::wpuc_import_json();

		$wpuc_metrics = $wpuc_metrics_array['metrics'];

		?>

		<h3 class="wpuc_shortcode_heading">WP Unit Converter Shorcodes</h3>
		<h3 class="wpuc_shortcode_subheading">Choose any Metrics by shortcode to Display</h3>

			<div class="wpuc_shortcode_general">
					<h4 class="wpuc_shortcode_general_heading">WP Unit Converter Multiple Metrics</h4>
					<pre class="wpuc_shortcode_general_shortcode">[wpuc_unit_converter]</pre>
			</div>

			<div class="wpuc_shortcode_specifics">

		<?php

		foreach ($wpuc_metrics as $key => $value) {

		?>

			<div class="wpuc_shortcode_specific">
					<h4 class="wpuc_shortcode_specific_heading"><?php echo $value['title']; ?></h4>
					<pre class="wpuc_shortcode_specific_shortcode">[wpuc_unit_converter converter=<?php echo $key ?>]</pre>
			</div>

		<?php
		
		}

		?>

				</div>


		<?php
	}

	public function wpuc_options_submenu_page_field_orientation_render_callback() {
		$wpuc_options = get_option( 'wpuc_options' );

		?>
		<div>
			<h3 class="wpuc_orientation_heading">WP Unit Converter Orientation</h3>
			<h3 class="wpuc_orientation_subheading">Choose between Horizontal or Vertical Display</h3>

			<div class="wpuc_orientation_options">

				<div class="wpuc_orientation_option">
					<input type="radio" name='wpuc_options[wpuc_orientation]' <?php checked( 'vertical', $wpuc_options['wpuc_orientation'], true ); ?> Value="vertical" />
					<div class="wpuc_orientation_vertical"></div>
				</div> <!-- wpuc_orientation_option -->

				<div class="wpuc_orientation_option">
					<input type="radio" name='wpuc_options[wpuc_orientation]' <?php checked( 'horizontal', $wpuc_options['wpuc_orientation'], true ); echo ( ( get_option( 'wpuc_options' ) ) ? '' : 'checked'); ?> Value="horizontal" />
					<div class="wpuc_orientation_horizontal"></div>
				</div> <!-- wpuc_orientation_option -->

			</div> <!-- wpuc_orientation_options -->

		<div>
		
		<?php		
	}
	
}
