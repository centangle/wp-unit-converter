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

		<div class="wpuc_shortcode_display">
			<select class="wpuc_shortcode_select">
			<option value="[wpuc_unit_converter]">WP Unit Converter All Metrics</option>
			<?php
				foreach ($wpuc_metrics as $wpuc_key => $wpuc_value) {
				?>

				<option value="<?php echo ($wpuc_value['shortcode']); ?>"><?php echo ($wpuc_value['title']); ?></option>

				<?php
				}
				?>
			</select>

			<input  type="text" name="wpuc_shortcode_value" value="[wpuc_unit_converter]" id="wpuc_shortcode_selected" readonly />
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
					<input type="radio" name="wpuc_options[wpuc_orientation]" <?php checked( 'vertical', $wpuc_options['wpuc_orientation'], true ); ?> Value="vertical" />
					<div class="wpuc_orientation_vertical">
						<img src=" <?php echo (plugins_url( '/wp-unit-converter/admin/images/wpuc_vertical_orientation.png')) ?> " alt="WP Unit Converter Vertical Orientation" width="300px" >
					</div>
				</div> <!-- wpuc_orientation_option -->

				<div class="wpuc_orientation_option">
					<input type="radio" name="wpuc_options[wpuc_orientation]" <?php checked( 'horizontal', $wpuc_options['wpuc_orientation'], true ); echo ( ( get_option( 'wpuc_options' ) ) ? '' : 'checked'); ?> Value="horizontal" />
					<div class="wpuc_orientation_horizontal">
						<img src="<?php echo (plugins_url( '/wp-unit-converter/admin/images/wpuc_horizontal_orientation.png' )) ?>" alt="WP Unit Converter Horizontal Orientation" width="300px" >
					</div>
				</div> <!-- wpuc_orientation_option -->

			</div> <!-- wpuc_orientation_options -->

		<div>
		
		<?php		
	}
	
}
