<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://neulee.com
 * @since      1.0.0
 *
 * @package    Neulee
 * @subpackage Neulee/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Neulee
 * @subpackage Neulee/admin
 * @author     luca <luca@neulee.com>
 */
class Neulee_Admin
{

    const neulee_login_url    = 'http://neulee.com/api/login';
    const neulee_search_url   = 'http://neulee.com/api/search';
    const neulee_generate_url = 'http://neulee.com/api/generate';

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Neulee_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Neulee_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'css/neulee-admin.css',
            array(),
            $this->version,
            'all'
        );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Neulee_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Neulee_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'js/neulee-admin.js',
            array('jquery'),
            $this->version,
            false
        );

    }


    /**
     *
     * admin/class-wp-cbf-admin.php - Don't add this
     *
     **/

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */


        add_options_page(
            'Neulee Account',
            'Neulee Account',
            'manage_options',
            $this->plugin_name.'/account',
            array($this, 'display_plugin_setup_page')
        );

        add_options_page(
            'Neulee Solution manager',
            'Neulee Solution',
            'manage_options',
            $this->plugin_name.'/solution',
            array($this, 'display_plugin_solution_page')
        );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links($links)
    {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */

        return $links;

    }

    /**
     * Render the solution manager page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_solution_page()
    {

        global $wpdb;


        $solutionTableName = $wpdb->prefix."neulee_solutions";

        $solutionList = $wpdb->get_results(
            "SELECT * FROM $solutionTableName"

        );

        $packageTableName = $wpdb->prefix."neulee_search";

        $packageList = $wpdb->get_results(
            "SELECT * FROM $packageTableName"

        );

        include_once('partials/neulee-admin-solution.php');
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page()
    {
        global $wpdb;


        $loginTableName = $wpdb->prefix."neulee_login";

        $loginList = $wpdb->get_results(
            "SELECT * FROM $loginTableName"

        );


        include_once('partials/neulee-admin-display.php');
    }

    /**
     * @param $input
     *
     * @return array
     */
    public function search($input)
    {
        global $wpdb;


        $valid = [];

        $valid['term'] = sanitize_text_field($input['term']);


        if (empty($valid['term'])) { // if user insert a HEX color with #
            add_settings_error(
                'search_empty_field',                     // Setting title
                'search_empty_field_error',            // Error ID
                'Please insert a valid search term',     // Error message
                'error'                         // Type of message
            );

            return $valid;
        }

        $searchTable = $wpdb->prefix.'neulee_search';
        $delete = $wpdb->query("TRUNCATE TABLE $searchTable");

        if (!$delete) { // if user insert a HEX color with #
            add_settings_error(
                'search_empty_field',                     // Setting title
                'search_empty_field_error',            // Error ID
                'Could not empty search database table...',     // Error message
                'error'                         // Type of message
            );

            return $valid;
        }

        $postBody = [
            'term' => $valid['term'],
        ];

        $response = wp_remote_post(
            self::neulee_search_url,
            array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
                'body' => json_encode($postBody),
                'cookies' => array(),
            )
        );


        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();

            add_settings_error(
                'search_neulee_error',                     // Setting title
                'search_neulee_error',            // Error ID
                $error_message,     // Error message
                'error'                         // Type of message
            );

            return $valid;
        }
        $response = wp_remote_retrieve_body($response);

        $data = json_decode($response, true);

        if ($data['status'] != 'success') {
            add_settings_error(
                'search_neulee_error',                     // Setting title
                'search_neulee_error',            // Error ID
                $data['reason'],     // Error message
                'error'                         // Type of message
            );

            return $valid;

        }

        $result = $data['results'];

        if (!empty($result)) {
            foreach ($result as $package) {
                if (!empty($package['versions'])) {
                    $versions = $package['versions'];

                    foreach ($versions as $version) {
                        $wpdb->insert(
                            $searchTable,
                            array(
                                'package_name' => $package['name'],
                                'package' => $package['fullname'],
                                'version' => $version,
                            ),
                            array(
                                '%s',
                                '%s',
                                '%s',
                            )
                        );
                    }
                } else {
                    $wpdb->insert(
                        $searchTable,
                        array(
                            'package_name' => $package['name'],
                            'package' => $package['fullname'],
                            'version' => '',
                        ),
                        array(
                            '%s',
                            '%s',
                            '%s',
                        )
                    );
                }
            }
        }

        return $valid;
    }

    /**
     * @param $input
     *
     * @return array
     */
    public function loginValidate($input)
    {
        $valid = [];

        $valid['email'] = sanitize_text_field($input['email']);
        $valid['password'] = sanitize_text_field($input['password']);


        if (empty($valid['email']) || empty($valid['password'])) { // if user insert a HEX color with #
            add_settings_error(
                'login_empty_field',                     // Setting title
                'login_empty_field_error',            // Error ID
                'Please fill all the fields',     // Error message
                'error'                         // Type of message
            );

            return $valid;
        }
        $postBody = [
            'email' => $valid['email'],
            'password' => $valid['password'],
        ];

        $response = wp_remote_post(
            self::neulee_login_url,
            array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
                'body' => json_encode($postBody),
                'cookies' => array(),
            )
        );


        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();

            add_settings_error(
                'login_neulee_error',                     // Setting title
                'login_neulee_error',            // Error ID
                $error_message,     // Error message
                'error'                         // Type of message
            );

            return $valid;
        }
        $response = wp_remote_retrieve_body($response);

        $data = json_decode($response, true);

        if ($data['status'] != 'success') {
            add_settings_error(
                'login_neulee_error',                     // Setting title
                'login_neulee_error',            // Error ID
                $data['reason'],     // Error message
                'error'                         // Type of message
            );

            return $valid;

        }
        global $wpdb;


        $loginTableName = $wpdb->prefix."neulee_login";

        $alreadyExistingUser = $wpdb->get_results(
            "SELECT * FROM $loginTableName WHERE email = '".$valid['email']."'"
        );

        if (empty($alreadyExistingUser)) {

            $wpdb->insert(
                $loginTableName,
                array(
                    'email' => $valid['email'],
                    'password' => $valid['password'],
                ),
                array(
                    '%s',
                    '%s',
                )
            );

            return $valid;
        }

        if ($alreadyExistingUser->password != $valid['password']) {
            $wpdb->update(
                $loginTableName,
                array(
                    'email' => $valid['email'],
                    'password' => $valid['password'],
                ),
                array('email' => $valid['email']),
                array(
                    '%s',    // value1
                    '%s'    // value2
                ),
                array('%s')
            );
        }

        return $valid;
    }

    /**
     *
     */
    public function neulee_form_processor()
    {
        register_setting($this->plugin_name.'login', 'login', array($this, 'loginValidate'));
        register_setting($this->plugin_name.'search', 'search', array($this, 'search'));
    }
}
