<?php

/**
 * The ajax handler for Metrics conversion of the plugin.
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/public
 */

/**
 * The ajax handler for Metrics conversion of the plugin.
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/public
 * @author     Centangle Interactive <hello@centangle.com>
 */
class Wp_Unit_Converter_Do_Convert {

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
	 *
	 */
	public function __construct( ) {

	}

	function wpuc_do_convert() {

		check_ajax_referer( 'wpuc_ajax_nonce_text' );

		$wpuc_metrics_array = Wp_Unit_Converter_Public::wpuc_import_json();

		$wpuc_metrics = $wpuc_metrics_array['metrics'];

		$from = $_POST['from'];

		$to = $_POST['to'];

		$value = $_POST['wpuc_value'];

		$wpuc_converter_type = $_POST['converter_type'];

		$wpuc_converter_data = ($wpuc_metrics[$wpuc_converter_type]);

		$wpuc_converter_base_unit = $wpuc_converter_data['base_unit'];

		$wpuc_converter_to = $wpuc_converter_data['convert_to'];

		if ($wpuc_converter_type != 'temperature') {

			$wpuc_converted_value = $value * $wpuc_converter_to[$from] * $wpuc_converter_to[$wpuc_converter_base_unit] / $wpuc_converter_to[$to];

		} else {

			$wpuc_converted_value = (($value - $wpuc_converter_to[$from]['base']) / $wpuc_converter_to[$from]['ratio']) * $wpuc_converter_to[$to]['ratio'] + $wpuc_converter_to[$to]['base'];

		}

		echo json_encode(round($wpuc_converted_value, 5));

		die();

	}

}