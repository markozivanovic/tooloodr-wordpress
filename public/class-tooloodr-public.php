<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://markozivanovic.com
 * @since      1.0.0
 *
 * @package    Tooloodr
 * @subpackage Tooloodr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tooloodr
 * @subpackage Tooloodr/public
 * @author     Marko Zivanovic <marko@markozivanovic.com>
 */
class Tooloodr_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tooloodr    The ID of this plugin.
	 */
	private $tooloodr;

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
	 * @param      string    $tooloodr       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tooloodr, $version ) {

		$this->tooloodr = $tooloodr;
		$this->version = $version;

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
		 * defined in Tooloodr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tooloodr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->tooloodr, plugin_dir_url( __FILE__ ) . 'css/tooloodr-public.css', array(), $this->version, 'all' );

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
		 * defined in Tooloodr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tooloodr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->tooloodr, plugin_dir_url( __FILE__ ) . 'js/TooLooDR.js', array( 'jquery' ), $this->version, false );

	}

	public function register_shortcodes() {
		add_shortcode( 'tooloodr', array( $this, 'tooloodr_shortcode_function') );
	}

	public function tooloodr_shortcode_function($atts = [], $content = null) {

		$tooloodr_defaultTooLooLevel = get_option('tooloodr_defaultTooLooLevel');
		$tooloodr_textHighlighting = get_option('tooloodr_textHighlighting') == 1 ? 'true' : 'false';
		$tooloodr_buttonContainerDiv = get_option('tooloodr_buttonContainerDiv');

		$tooloodr_buttonLabelsShow = get_option('tooloodr_buttonLabelsShow') == 1 ? 'true' : 'false';
		$tooloodr_buttonLabelsTooLoo1 = get_option('tooloodr_buttonLabelsTooLoo1');
		$tooloodr_buttonLabelsTooLoo2 = get_option('tooloodr_buttonLabelsTooLoo2');
		$tooloodr_buttonLabelsTooLoo3 = get_option('tooloodr_buttonLabelsTooLoo3');

		$tooloodr_buttonColorsTooLoo1Text = get_option('tooloodr_buttonColorsTooLoo1Text');
		$tooloodr_buttonColorsTooLoo2Text = get_option('tooloodr_buttonColorsTooLoo2Text');
		$tooloodr_buttonColorsTooLoo3Text = get_option('tooloodr_buttonColorsTooLoo3Text');

		$tooloodr_buttonColorsTooLoo1Background = get_option('tooloodr_buttonColorsTooLoo1Background');
		$tooloodr_buttonColorsTooLoo2Background = get_option('tooloodr_buttonColorsTooLoo2Background');
		$tooloodr_buttonColorsTooLoo3Background = get_option('tooloodr_buttonColorsTooLoo3Background');

		$tooloodr_buttonColorsActiveBorderColor = get_option('tooloodr_buttonColorsActiveBorderColor');

		$tooloodr_readingTimeShow = get_option('tooloodr_readingTimeShow') == 1 ? 'true' : 'false';
		$tooloodr_readingWordsPerMin = get_option('tooloodr_readingWordsPerMin');
		$tooloodr_readingLabelSeparator = get_option('tooloodr_readingLabelSeparator');
		$tooloodr_readingShowPercentage = get_option('tooloodr_readingShowPercentage') == 1 ? 'true' : 'false';
		$tooloodr_readingPercentageSeparator = get_option('tooloodr_readingPercentageSeparator');

		$tooloodr_levelColorsTooLoo1Text = get_option('tooloodr_levelColorsTooLoo1Text');
		$tooloodr_levelColorsTooLoo2Text = get_option('tooloodr_levelColorsTooLoo2Text');
		$tooloodr_levelColorsTooLoo3Text = get_option('tooloodr_levelColorsTooLoo3Text');

		$tooloodr_levelColorsTooLoo1Background = get_option('tooloodr_levelColorsTooLoo1Background');
		$tooloodr_levelColorsTooLoo2Background = get_option('tooloodr_levelColorsTooLoo2Background');
		$tooloodr_levelColorsTooLoo3Background = get_option('tooloodr_levelColorsTooLoo3Background');

		$postDiv = '#post-' . get_the_id();
		
		$tooloodr = '';
		$tooloodr .='<script>';
		$tooloodr .= 'var myTooLooDR = new TooLooDR("' . $postDiv . '>div", {';
		$tooloodr .= 'defaultTooLooLevel:' . $tooloodr_defaultTooLooLevel  . ',';
		$tooloodr .= 'textHighlighting:' .  $tooloodr_textHighlighting . ',';
		$tooloodr .= 'buttonContainerDiv: "' .  $tooloodr_buttonContainerDiv . '",';
		$tooloodr .= 'buttonLabels: {';
		$tooloodr .= 'show:' .  $tooloodr_buttonLabelsShow . ',';
		$tooloodr .= 'tooLoo1: "' .  $tooloodr_buttonLabelsTooLoo1 . '",';
		$tooloodr .= 'tooLoo2: "' .  $tooloodr_buttonLabelsTooLoo2 . '",';
		$tooloodr .= 'tooLoo3: "' .  $tooloodr_buttonLabelsTooLoo3 . '",';
		$tooloodr .= '},';
		$tooloodr .= 'buttonColors: {';
		$tooloodr .= 'tooLoo1Text: "' .  $tooloodr_buttonColorsTooLoo1Text . '",';
		$tooloodr .= 'tooLoo2Text: "' .  $tooloodr_buttonColorsTooLoo2Text . '",';
		$tooloodr .= 'tooLoo3Text: "' .  $tooloodr_buttonColorsTooLoo3Text . '",';
		$tooloodr .= 'tooLoo1Background: "' .  $tooloodr_buttonColorsTooLoo1Background . '",';
		$tooloodr .= 'tooLoo2Background: "' .  $tooloodr_buttonColorsTooLoo2Background . '",';
		$tooloodr .= 'tooLoo3Background: "' .  $tooloodr_buttonColorsTooLoo3Background . '",';
		$tooloodr .= 'activeBorderColor: "' .  $tooloodr_buttonColorsActiveBorderColor . '",';
		$tooloodr .= '},';
		$tooloodr .= 'readingTime: {';
		$tooloodr .= 'show:' .  $tooloodr_readingTimeShow . ',';
		$tooloodr .= 'wordsPerMin:' .  $tooloodr_readingWordsPerMin . ',';
		$tooloodr .= 'labelSeparator: "' .  $tooloodr_readingLabelSeparator . '",';
		$tooloodr .= 'showPercentage:' .  $tooloodr_readingShowPercentage . ',';
		$tooloodr .= 'percentageSeparator: "' .  $tooloodr_readingPercentageSeparator . '",';
		$tooloodr .= '},';
		$tooloodr .= 'levelColors: {';
		$tooloodr .= 'tooLoo1Text: "' .  $tooloodr_levelColorsTooLoo1Text . '",';
		$tooloodr .= 'tooLoo2Text: "' .  $tooloodr_levelColorsTooLoo2Text . '",';
		$tooloodr .= 'tooLoo3Text: "' .  $tooloodr_levelColorsTooLoo3Text . '",';
		$tooloodr .= 'tooLoo1Background: "' .  $tooloodr_levelColorsTooLoo1Background . '",';
		$tooloodr .= 'tooLoo2Background: "' .  $tooloodr_levelColorsTooLoo2Background . '",';
		$tooloodr .= 'tooLoo3Background: "' .  $tooloodr_levelColorsTooLoo3Background . '",';
		$tooloodr .= '},';
		$tooloodr .= '});';
		$tooloodr .= '</script>';
		return $tooloodr;
	}
}
