<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://neulee.com
 * @since             1.0.0
 * @package           Neulee
 *
 * @wordpress-plugin
 * Plugin Name:       Neulee
 * Plugin URI:        http://neulee.com
 * Description: Neulee offer a large scale of most popular client side Javascript and CSS libraries and plugins and an simple way to manage them. Browse wide collection of CSS and JS libraries, select your favourites and create your personal solution. Your chosen libraries will be packed in one compact solution, that will be available through a unique link that you can easily add to your website.
 * Version:           1.0.0
 * Author:            luca
 * Author URI:        http://neulee.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       neulee
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-neulee-activator.php
 */
function activate_neulee() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neulee-activator.php';
	Neulee_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-neulee-deactivator.php
 */
function deactivate_neulee() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neulee-deactivator.php';
	Neulee_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_neulee' );
register_deactivation_hook( __FILE__, 'deactivate_neulee' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-neulee.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_neulee() {

	$plugin = new Neulee();
	$plugin->run();

}
run_neulee();
