<?php

/**
 * Fired during plugin activation
 *
 * @link       https://markozivanovic.com
 * @since      1.0.0
 *
 * @package    Tooloodr
 * @subpackage Tooloodr/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tooloodr
 * @subpackage Tooloodr/includes
 * @author     Marko Zivanovic <marko@markozivanovic.com>
 */
class Tooloodr_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('tooloodr_defaultTooLooLevel', '2');
		add_option('tooloodr_textHighlighting', '1');

		add_option('tooloodr_buttonLabelsShow', '1');
		add_option('tooloodr_buttonLabelsTooLoo1', 'tldr1');
		add_option('tooloodr_buttonLabelsTooLoo2', 'tldr2');
		add_option('tooloodr_buttonLabelsTooLoo3', 'tldr3');

		add_option('tooloodr_buttonColorsTooLoo1Text', '#000');
		add_option('tooloodr_buttonColorsTooLoo2Text', '#000');
		add_option('tooloodr_buttonColorsTooLoo3Text', '#000');

		add_option('tooloodr_buttonColorsTooLoo1Background', '#ffaaa7');
		add_option('tooloodr_buttonColorsTooLoo2Background', '#ffd3b4');
		add_option('tooloodr_buttonColorsTooLoo3Background', '#d5ecc2');

		add_option('tooloodr_buttonColorsActiveBorderColor', '#f00');

		add_option('tooloodr_readingTimeShow', '1');
		add_option('tooloodr_readingWordsPerMin', '200');
		add_option('tooloodr_readingLabelSeparator', ' • ');
		add_option('tooloodr_readingShowPercentage', '1');
		add_option('tooloodr_readingPercentageSeparator', ' • ');

		add_option('tooloodr_levelColorsTooLoo1Text', '#000');
		add_option('tooloodr_levelColorsTooLoo2Text', '#000');
		add_option('tooloodr_levelColorsTooLoo3Text', '#000');

		add_option('tooloodr_levelColorsTooLoo1Background', '#ffaaa7');
		add_option('tooloodr_levelColorsTooLoo2Background', '#ffd3b4');
		add_option('tooloodr_levelColorsTooLoo3Background', '#d5ecc2');

	}

}
