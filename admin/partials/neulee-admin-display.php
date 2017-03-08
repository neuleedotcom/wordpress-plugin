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
    <div class="nlpanel">
        <h2 class="nav-tab-wrapper"><?php _e('Your neulee accounts', $this->plugin_name); ?></h2>
        <div class="rTable">
            <div class="rTableRow">
                <div class="rTableHead"><strong>User</strong></div>
                <div class="rTableHead">&nbsp;</div>
            </div>
            <?php
            if (!empty($loginList)) {
                foreach ($loginList as $login) {
                    ?>
                    <div class="rTableRow">

                        <div class="rTableHead"><?php echo $login->email; ?></div>
                        <div class="rTableHead">
                            <form method="post" name="generate" action="options.php">
                                <?php settings_fields($this->plugin_name.'userDelete'); ?>
                                <input type="hidden" class="<?php echo $this->plugin_name; ?>-user_id"
                                       id="<?php echo $this->plugin_name; ?>-user_id"
                                       name="<?php echo 'userDelete'; ?>[user_id]"
                                       value="<?php echo $login->id; ?>"/>
                                <?php submit_button(__('Delete', $this->plugin_name), 'secondary', 'submit', true); ?>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="rTableRow">
                    <div class="rTableHead">
                        You don't have any account saved. Login or register now to start using neulee without any limit
                    </div>
                    <div class="rTableHead">

                    </div>
                </div>
                <?php
            }

            ?>
        </div>
    </div>


    <div class="rTable">
        <div class="rTableRow" style="width: 50%">
            <div class="nlpanel" style="margin-top: 20px;">
                <h2 class="nav-tab-wrapper"><?php _e('Neulee login', $this->plugin_name); ?></h2>

                <form method="post" name="login" action="options.php">
                    <?php settings_fields($this->plugin_name.'login'); ?>

                    <?php
                    //Grab all options
                    $options = get_option($this->plugin_name.'login');

                    // Cleanup
                    $email = $options['email'];
                    $password = $options['password'];
                    ?>
                    <p><?php _e(
                            'Add a Neulee account for avoiding the 5 packages limit per solutions',
                            $this->plugin_name
                        ); ?></p>

                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e('email', $this->plugin_name); ?></span>
                        </legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_background_color">
                            <span><?php esc_attr_e('Email', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-email"
                                   id="<?php echo $this->plugin_name; ?>-email" name="<?php echo 'login'; ?>[email]"
                                   value="<?php echo $email; ?>"/>
                        </label>
                    </fieldset>

                    <!-- login buttons and links primary color-->
                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e('password', $this->plugin_name); ?></span>
                        </legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_button_primary_color">
                            <span><?php esc_attr_e('Password', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-password"
                                   id="<?php echo $this->plugin_name; ?>-password"
                                   name="<?php echo 'login'; ?>[password]" value="<?php echo $password; ?>"/>
                        </label>
                    </fieldset>

                    <?php submit_button(__('Login', $this->plugin_name), 'primary', 'submit', true); ?>

                </form>
            </div>
        </div>
        <div class="rTableRow" style="width: 50%">
            <div class="nlpanel" style="margin-top: 20px;">
                <h2 class="nav-tab-wrapper"><?php _e('Neulee Register', $this->plugin_name); ?></h2>

                <form method="post" name="login" action="options.php">
                    <?php settings_fields($this->plugin_name.'register'); ?>

                    <?php
                    //Grab all options
                    $options = get_option($this->plugin_name.'register');

                    // Cleanup
                    $firstname = $options['firstname'];
                    $lastname = $options['lastname'];
                    $email = $options['email'];
                    $password = $options['password'];
                    $repeatpassword = $options['repeatpassword'];

                    ?>
                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e('firstname', $this->plugin_name); ?></span>
                        </legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_background_color">
                            <span><?php esc_attr_e('firstname', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-firstname"
                                   id="<?php echo $this->plugin_name; ?>-email"
                                   name="<?php echo 'register'; ?>[firstname]"
                                   value="<?php echo $firstname; ?>"/>
                        </label>
                    </fieldset>
                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e('firstname', $this->plugin_name); ?></span>
                        </legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_background_color">
                            <span><?php esc_attr_e('lastname', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-lastname"
                                   id="<?php echo $this->plugin_name; ?>-email"
                                   name="<?php echo 'register'; ?>[lastname]"
                                   value="<?php echo $lastname; ?>"/>
                        </label>
                    </fieldset>
                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e('firstname', $this->plugin_name); ?></span>
                        </legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_background_color">
                            <span><?php esc_attr_e('email', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-email"
                                   id="<?php echo $this->plugin_name; ?>-email" name="<?php echo 'register'; ?>[email]"
                                   value="<?php echo $email; ?>"/>
                        </label>
                    </fieldset>
                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e('password', $this->plugin_name); ?></span>
                        </legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_button_primary_color">
                            <span><?php esc_attr_e('Password', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-password"
                                   id="<?php echo $this->plugin_name; ?>-password"
                                   name="<?php echo 'register'; ?>[password]" value="<?php echo $password; ?>"/>
                        </label>
                    </fieldset>
                    <fieldset class="wp_cbf-admin-colors">
                        <legend class="screen-reader-text"><span><?php _e(
                                    'repeat password',
                                    $this->plugin_name
                                ); ?></span></legend>
                        <label for="<?php echo $this->plugin_name; ?>-login_button_primary_color">
                            <span><?php esc_attr_e('Retype password', $this->plugin_name); ?></span>
                            <input type="text" class="<?php echo $this->plugin_name; ?>-repeatpassword"
                                   id="<?php echo $this->plugin_name; ?>-repeatpassword"
                                   name="<?php echo 'register'; ?>[repeatpassword]"
                                   value="<?php echo $repeatpassword; ?>"/>
                        </label>
                    </fieldset>


                    <?php submit_button(__('Register', $this->plugin_name), 'primary', 'submit', true); ?>

                </form>
            </div>
        </div>
    </div>
</div>