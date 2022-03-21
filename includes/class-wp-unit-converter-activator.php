<?php

/**
 * Fired during plugin activation
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Unit_Converter
 * @subpackage Wp_Unit_Converter/includes
 * @author     Centangle Interactive <hello@centangle.com>
 */
class Wp_Unit_Converter_Activator {

	/**
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$wpuc_default_orientation = array( 'wpuc_orientation' => 'horizontal' );

		update_option( 'wpuc_options', $wpuc_default_orientation );

	}

}
