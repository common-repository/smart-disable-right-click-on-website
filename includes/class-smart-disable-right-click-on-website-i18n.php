<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://smartsoftfirm.com
 * @since      1.0.0
 *
 * @package    Smart_Disable_Right_Click_On_Website
 * @subpackage Smart_Disable_Right_Click_On_Website/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Smart_Disable_Right_Click_On_Website
 * @subpackage Smart_Disable_Right_Click_On_Website/includes
 * @author     SmartSoftFirm <smartsoftfirm@gmail.com>
 */
class Smart_Disable_Right_Click_On_Website_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'smart-disable-right-click-on-website',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
