<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://neulee.com
 * @since      1.0.0
 *
 * @package    Neulee
 * @subpackage Neulee/admin/partials
 */
?>

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <h2 class="nav-tab-wrapper"><?php _e('Your neulee solutions', $this->plugin_name); ?></h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
        <tr>
            <td>Detail</td>
            <td>Provider url</td>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!empty($solutionList)) {
            foreach ($solutionList as $solution) {
                ?>
                <tr>
                    <td><?php echo $solution->solution_url; ?></td>
                    <td><?php echo $solution->provider_url; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="2">
                    You don't have any solution.
                </td>
            </tr>
            <?php
        }

        ?>
        </tbody>
    </table>

    <h2 class="nav-tab-wrapper"><?php _e('Search packages', $this->plugin_name.'packages'); ?></h2>
    <form method="post" name="login" action="options.php">
        <?php settings_fields($this->plugin_name.'search'); ?>
        <?php
        //Grab all options
        $options = get_option($this->plugin_name.'search');

        // Cleanup
        $term = $options['term'];
        ?>
        <fieldset class="wp_cbf-admin-colors">
            <legend class="screen-reader-text"><span><?php _e('term', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-term">
                <span><?php esc_attr_e('Term', $this->plugin_name); ?></span>
                <input type="text" class="<?php echo $this->plugin_name; ?>-term"
                       id="<?php echo $this->plugin_name; ?>-term" name="<?php echo 'search'; ?>[term]"
                       value="<?php echo $term; ?>"/>
            </label>
        </fieldset>
        <?php submit_button(__('Search', $this->plugin_name), 'primary', 'submit', true); ?>
    </form>
    <?php
    if (!empty($packageList)) {
        foreach ($packageList as $package) {
            ?>
            <div class="resultbox">
                <form method="post" name="login" action="options.php" id="packageform">
                    <?php settings_fields($this->plugin_name.'package'); ?>
                    <fieldset class="wp_cbf-admin-colors">
                        <label>
                            <span>Package</span><b>&nbsp;<?php echo $package->package_name; ?></b>
                        </label>
                    </fieldset>
                    <fieldset class="wp_cbf-admin-colors">
                        <label>
                            <span>Repository</span><b>&nbsp;<?php echo $package->package; ?></b>
                        </label>
                    </fieldset>
                    <fieldset class="wp_cbf-admin-colors">
                        <label>
                            <span>Version</span><b>&nbsp;<?php echo $package->version; ?></b>
                        </label>
                    </fieldset>
                    <?php submit_button(__('Add to solution', $this->plugin_name), 'primary', 'submit', true); ?>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>