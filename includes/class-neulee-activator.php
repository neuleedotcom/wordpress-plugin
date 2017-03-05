<?php

/**
 * Fired during plugin activation
 *
 * @link       http://neulee.com
 * @since      1.0.0
 *
 * @package    Neulee
 * @subpackage Neulee/includes
 */

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Neulee
 * @subpackage Neulee/includes
 * @author     luca <luca@neulee.com>
 */
class Neulee_Activator {


	/**
	 * activation function
	 *
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        global $wpdb;

        $loginTableName = $wpdb->prefix . "neulee_login";
        $solutionTableName = $wpdb->prefix . "neulee_solutions";
        $packageTableName = $wpdb->prefix . 'neulee_packages';
        $seachTableName = $wpdb->prefix . 'neulee_search';

        $charset_collate = $wpdb->get_charset_collate();

        $loginTable = "CREATE TABLE $loginTableName (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          email varchar(55) NOT NULL,
                          password varchar(55) NOT NULL,
                          PRIMARY KEY  (id)
                        ) $charset_collate;";

        $solutionTable = "CREATE TABLE $solutionTableName (
                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                          solution_url varchar(100) NOT NULL,
                          provider_url varchar(100) NOT NULL,
                          solution_active CHAR(1) NOT NULL DEFAULT 'N',
                          PRIMARY KEY  (id)
                        ) $charset_collate;";

        $packageTable = "CREATE TABLE $packageTableName (
                          package varchar(100) NOT NULL,
                          version varchar(100)          
                        ) $charset_collate;";

        $searchTable = "CREATE TABLE $seachTableName (
                          package_name varchar(100) NOT NULL,
                          package varchar(100) NOT NULL,
                          version varchar(100)          
                        ) $charset_collate;";

        dbDelta( $loginTable );
        dbDelta( $solutionTable );
        dbDelta( $packageTable );
        dbDelta( $searchTable );
	}
}
