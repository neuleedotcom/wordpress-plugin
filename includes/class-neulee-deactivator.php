<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://neulee.com
 * @since      1.0.0
 *
 * @package    Neulee
 * @subpackage Neulee/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Neulee
 * @subpackage Neulee/includes
 * @author     luca <luca.magistrelli@neulee.com>
 */
class Neulee_Deactivator
{

    /**
     * Deactivate function
     */
    public static function deactivate()
    {

        global $wpdb;

        $packageTableName = $wpdb->prefix.'neulee_packages';
        $searchTable = $wpdb->prefix.'neulee_search';

        //we do not remove the other two tables, maybe the user want to reactivate the plugin and get
        // the old info stored
        $wpdb->query("TRUNCATE TABLE $searchTable");
        $wpdb->query("TRUNCATE TABLE $packageTableName");
    }

}
