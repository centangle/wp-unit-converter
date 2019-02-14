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
		
		wp_enqueue_script( 'wpuc_math_js', plugin_dir_url( __FILE__ ) . 'js/math.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'wpuc_ajax_script', plugin_dir_url( __FILE__ ) . 'js/wp-unit-converter-public.js', array( 'jquery', 'wpuc_math_js' ), $this->version, false );

		$wpuc_options = get_option( 'wpuc_options' );

		wp_localize_script( 'wpuc_ajax_script', 'wpuc_js_obj', array( 'wpuc_metrics_json' => plugins_url( 'wp-unit-converter/includes/js/wpuc-metrics.json' ), 'wpuc_plugin_active' => class_exists( 'wp_unit_converter' ), 'wpuc_orientation' => $wpuc_options['wpuc_orientation'] ) );
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
	public function wpuc_unit_converter_shortcode($atts) {

		$wpuc_metrics_array = Wp_Unit_Converter_Public::wpuc_import_json();

		$wpuc_metrics = $wpuc_metrics_array['metrics'];

		$show = '';

		$show .= '<div id="wpuc-converter-box">';

		$args = shortcode_atts( 
			array(
				'converter' => '',
			), $atts);	

		$converter = $args['converter'];

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

		$wpuc_convert_options = '';

		foreach ($wpuc_convert_options_array as $key => $value) {

			$wpuc_convert_options .= '<option value="' . $key . '">' . $value . '</option>';

		}

		$show .= '<div id="wpuc-converter-type">';

		$show .= '<div class="wpuc-converter-form">
		
				<input type="hidden" name="wpuc_converter_type" value="' . $converter . '" id="wpuc_converter_type"/>

				<div class="wpuc-main-form">

				<div class="wpuc-field">
				<input  class="wpuc-field-value wpuc-input" maxlength="16" type="text" name="wpuc_value" value="" id="wpuc_from_value" />
				<select class="wpuc-field-value wpuc-select" id="wpuc_from">' . $wpuc_convert_options . '</select>
				</div>';

		$show .= '<div class="wpuc-equalizer"> = </div>';

		$show .= '<div class="wpuc-field">				
				<input  class="wpuc-field-value wpuc-input" maxlength="16" type="text" name="wpuc_value" value="" id="wpuc_to_value" />
				<select class="wpuc-field-value wpuc-select" id="wpuc_to">' . $wpuc_convert_options . '</select>				
				</div>
				
				</div>';


		$show .= '</div></div>';

		return $show;
	}

}
