<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://smartsoftfirm.com
 * @since             1.0.0
 * @package           Smart_Disable_Right_Click_On_Website
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Disable Right Click On Website
 * Plugin URI:        
 * Description:       How do I make my website right-click disabled?
This plugin can do that easy way to enable/Disable the right-click menu on your webpage by using a simple one-click button.
 * Version:           1.0.0
 * Author:            SmartSoftFirm
 * Author URI:        https://smartsoftfirm.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart-disable-right-click-on-website
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SMART_DISABLE_RIGHT_CLICK_ON_WEBSITE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smart-disable-right-click-on-website-activator.php
 */
function activate_smart_disable_right_click_on_website() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-disable-right-click-on-website-activator.php';
	Smart_Disable_Right_Click_On_Website_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smart-disable-right-click-on-website-deactivator.php
 */
function deactivate_smart_disable_right_click_on_website() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-disable-right-click-on-website-deactivator.php';
	Smart_Disable_Right_Click_On_Website_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smart_disable_right_click_on_website' );
register_deactivation_hook( __FILE__, 'deactivate_smart_disable_right_click_on_website' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smart-disable-right-click-on-website.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_smart_disable_right_click_on_website() {

	$plugin = new Smart_Disable_Right_Click_On_Website();
	$plugin->run();

}
run_smart_disable_right_click_on_website();

// Register the options
function sdrc_register_options() {
    register_setting('sdrc_options', 'sdrc_enable');
}
add_action('admin_init', 'sdrc_register_options');

// Add the options page
function sdrc_options_page() {
    add_options_page('Smart Disable Right Click', 'Smart Disable Right Click', 'manage_options', 'sdrc', 'sdrc_options_page_html');
}
add_action('admin_menu', 'sdrc_options_page');

// Options page HTML
function drc_options_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('sdrc_options'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="sdrc_enable">Disable/Enable Right-Click on Your Webpage</label>
                    </th>
                    <td>
                        <input type="checkbox" name="sdrc_enable" id="sdrc_enable" value="1" <?php checked(1, get_option('sdrc_enable'), false); ?>>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Enqueue the JavaScript file
function sdrc_enqueue_scripts() {
    if (get_option('sdrc_enable')) {
        wp_enqueue_script('sdrc_script', plugin_dir_url(__FILE__) . 'admin/js/drc.js', array(), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'sdrc_enqueue_scripts');