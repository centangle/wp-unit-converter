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
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-unit-converter-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the Ajax URL required for public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_ajax_url() {
    	?>

		<script type="text/javascript">
		var wpuc_ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>

		<?php
	}

	/**
	 * Retrieves metrics mesurement values in JSON.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_import_json() {

		$metrics_array = json_decode(file_get_contents(plugins_url('../includes/js/wpuc-metrics.json', __FILE__)), 'true');

		return $metrics_array;

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
	 * Callback function for add_shortcode, which will display the the metrics option for public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function wpuc_unit_converter_shortcode($atts) {

		$metrics_array = $this->wpuc_import_json();

		extract(shortcode_atts(array(

			'converter' => '',

		), $atts));

		$metrics = $metrics_array['metrics'];
        ob_start();
        echo '<pre>';
        print_r($metrics_array);
        echo '</pre>';
        $objectdata = ob_get_contents();
        ob_end_clean();
        error_log($objectdata);

		/* $show .= '<div id="oppso-converter-box">';

		if ($converter == '') {

			$options = '';

			$i = 0;

			foreach ($metrics as $key => $value) {

				if ($i == 0) {

					$converter = $key;

				}

				$i++;

				$options .= '<option value="' . $key . '">' . ucfirst($key) . '</option>';

			}

			$show .= '<div id="converter-selection"><select class="oppso-select">' . $options . '</select></div>';

		}

		$converter_data = ($formulae[$converter]);

		$convert_options_arr = $converter_data['select_box'];

		foreach ($convert_options_arr as $key => $value) {

			$convert_options .= '<option value="' . $key . '">' . $value . '</option>';

		}

		$show .= '<div id="oppso-converter-type"><div>' . $converter_data['title'] . '</div>';

		$show .= '<div class="oppso-converter-description">' . $converter_data['description'] . '</div>';

		$show .= '<div class="oppso-converter-form">



			<input type="hidden" name="oppso_converter_type" value="' . $converter . '" id="oppso_converter_type"/>

			<table cellspacing="3" class="oppso-form-table">

					<tr><td>Value</td><td>	<input  class="oppso-input"  type="text" name="oppso_value" value="" id="oppso_value" />

					</td></tr>

							<tr><td width="40%">From</td><td>

			<select class="oppso-select" id="oppso_from">' . $convert_options . '</select>

			</td></tr>';

		$show .= '<tr><td  width="40%">To</td><td>

				<select class="oppso-select" id="oppso_to">' . $convert_options . '</select></td></tr>



			<tr><td><input type="button" name="convert" value="Convert" id="oppso_convert"></td></tr></table>

			<div id="oppso_convert_result" class="oppso-convert-result"></div>





			';

		$show .= '</div><div>';

		return $show; */
		echo 'centangle 2019';

	}

}
