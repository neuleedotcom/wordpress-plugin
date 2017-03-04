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

    <h2 class="nav-tab-wrapper"><?php _e('Neulee login', $this->plugin_name); ?></h2>

    <form method="post" name="login" action="options.php">
        <?php settings_fields($this->plugin_name); ?>

        <?php
            //Grab all options
            $options = get_option($this->plugin_name);

            // Cleanup
            $email = $options['email'];
            $password = $options['password'];
        ?>
        <p><?php _e('Add a Neulee account for avoind the 5 packages limit per solutions', $this->plugin_name); ?></p>

        <fieldset class="wp_cbf-admin-colors">
            <legend class="screen-reader-text"><span><?php _e('email', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-login_background_color">
                <span><?php esc_attr_e('Email', $this->plugin_name); ?></span>
                <input type="text" class="<?php echo $this->plugin_name; ?>-email"
                       id="<?php echo $this->plugin_name; ?>-email" name="<?php echo $this->plugin_name; ?>[email]"
                       value="<?php echo $email; ?>"/>
            </label>
        </fieldset>

        <!-- login buttons and links primary color-->
        <fieldset class="wp_cbf-admin-colors">
            <legend class="screen-reader-text"><span><?php _e('password', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-login_button_primary_color">
                <span><?php esc_attr_e('Password', $this->plugin_name); ?></span>
                <input type="text" class="<?php echo $this->plugin_name; ?>-password"
                       id="<?php echo $this->plugin_name; ?>-password"
                       name="<?php echo $this->plugin_name; ?>[password]" value="<?php echo $password; ?>"/>
            </label>
        </fieldset>

        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary', 'submit', true); ?>

    </form>
</div>
