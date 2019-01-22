<?php

/**
 * The ajax handler for change in Metrics type of the plugin.
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/public
 */

/**
 * The ajax handler for change in Metrics type of the plugin.
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/public
 * @author     Centangle Interactive <hello@centangle.com>
 */
class Wp_Unit_Converter_Do_Change {

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

	public function wpuc_do_change() {

		$wpuc_metrics_array = Wp_Unit_Converter_Public::wpuc_import_json();

		$wpuc_metrics = $wpuc_metrics_array['metrics'];

   		$converter = $_POST['converter_type'];

	    $wpuc_converter_data = ($wpuc_metrics[$converter]);

    	$wpuc_convert_options_array = $wpuc_converter_data['select_box'];

    	foreach ($wpuc_convert_options_array as $key => $value) {

        	$wpuc_convert_options .= '<option value="' . $key . '">' . $value . '</option>';

    	}

		$show .= '<div id="wpuc-converter-type">';

		$show .= '<div class="wpuc-converter-form">

				<input type="hidden" name="wpuc_converter_type" value="' . $converter . '" id="wpuc_converter_type"/>

				<div class="wpuc-form-table">

				<div class="wpuc-field">
				<div class="wpuc-field-key">Conversion value:</div>				
				<input  class="wpuc-field-value wpuc-input"  type="text" name="wpuc_value" value="" id="wpuc_value" />
				</div>

				<div class="wpuc-field">
				<div class="wpuc-field-key">Convert from:</div>
				<select class="wpuc-field-value wpuc-select" id="wpuc_from">' . $wpuc_convert_options . '</select>
				</div>';

		$show .= '<div class="wpuc-field">
				<div class="wpuc-field-key">Convert to:</div>
				<select class="wpuc-field-value wpuc-select" id="wpuc_to">' . $wpuc_convert_options . '</select>
				</div>';

		$show .= '<input type="button" name="convert" value="Convert" id="wpuc_convert">

				<div id="wpuc_convert_result" class="wpuc-convert-result"></div>';

    	$show .= '';

    	echo $show;

		die();
	}
}