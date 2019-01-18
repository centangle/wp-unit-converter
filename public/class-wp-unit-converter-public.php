<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/public
 * @author     Centangle Interactive <hello@centangle.com>
 */
class Wp_Unit_Converter_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->wpuc_add_shortcode();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Unit_Converter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Unit_Converter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-unit-converter-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Unit_Converter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Unit_Converter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( 'wpuc-ajax-script', plugin_dir_url( __FILE__ ) . 'js/wp-unit-converter-public.js', array( 'jquery' ), $this->version, false );

		$wpuc_ajax_nonce = wp_create_nonce( 'wpuc_ajax_nonce_text' );
		wp_localize_script( 'wpuc-ajax-script', 'wpuc_ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => $wpuc_ajax_nonce ) );
	}

	/**
	 * Register shortcode of metrics for public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_add_shortcode() {
		add_shortcode('wpuc_unit_converter', array($this, 'wpuc_unit_converter_shortcode'));
	}

	/**
	 * Retrieves metrics mesurement values in JSON.
	 *
	 * @since    1.0.0
	 */
	public static function wpuc_import_json() {

		$metrics_array = json_decode(file_get_contents(plugins_url('../includes/js/wpuc-metrics.json', __FILE__)), 'true');

		return $metrics_array;

	}

	/**
	 * Callback function for wpuc_add_shortcode, which will display the the metrics option for public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_unit_converter_shortcode() {

		$wpuc_metrics_array = self::wpuc_import_json();

/* 		extract(shortcode_atts(array(

			'converter' => '',

		), $atts)); */

		$wpuc_metrics = $wpuc_metrics_array['metrics'];

		$show .= '<div id="wpuc-converter-box">';

		if ($converter == '') {

			$wpuc_options = '';

			$i = 0;

			foreach ($wpuc_metrics as $key => $value) {

				if ($i == 0) {

					$converter = $key;

				}

				$i++;

				$wpuc_options .= '<option value="' . $key . '">' . ucfirst($key) . '</option>';

			}

			$show .= '<div id="converter-selection"><select class="wpuc-select">' . $wpuc_options . '</select></div>';

		}

		$wpuc_converter_data = ($wpuc_metrics[$converter]);

		$wpuc_convert_options_array = $wpuc_converter_data['select_box'];

		foreach ($wpuc_convert_options_array as $key => $value) {

			$wpuc_convert_options .= '<option value="' . $key . '">' . $value . '</option>';

		}

		$show .= '<div id="wpuc-converter-type"><div>' . $wpuc_converter_data['title'] . '</div>';

		$show .= '<div class="wpuc-converter-description">' . $wpuc_converter_data['description'] . '</div>';

		$show .= '<div class="wpuc-converter-form">
		
				<input type="hidden" name="wpuc_converter_type" value="' . $converter . '" id="wpuc_converter_type"/>

				<table cellspacing="3" class="wpuc-form-table">

				<tr><td>Value</td><td>	<input  class="wpuc-input"  type="text" name="wpuc_value" value="" id="wpuc_value" />

				</td></tr>

				<tr><td width="40%">From</td><td>

				<select class="wpuc-select" id="wpuc_from">' . $wpuc_convert_options . '</select>

				</td></tr>';

		$show .= '<tr><td  width="40%">To</td><td>

				<select class="wpuc-select" id="wpuc_to">' . $wpuc_convert_options . '</select></td></tr>

				<tr><td><input type="button" name="convert" value="Convert" id="wpuc_convert"></td></tr></table>

				<div id="wpuc_convert_result" class="wpuc-convert-result"></div>';

		$show .= '</div><div>';

		return $show;
	}

}
