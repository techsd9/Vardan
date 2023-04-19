<?php
/*
Plugin Name: Custom User Registration Form
Description: A simple plugin that creates a custom user registration form and writes the data to a database.
Version: 1.0
Author: OpenAI
*/

// Creating the registration form
function custom_registration_form() {
    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <div>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"/>
    </div>
    <div>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"/>
    </div>
    <div>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"/>
    </div>
    <input type="submit" name="submit" value="Sign Up"/>
    </form>
    ';
}

// Writing the data to the database
function store_registration_data() {
    global $wpdb;
    if (isset($_POST['submit'])) {
        $username = sanitize_text_field($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $table_name = $wpdb->prefix . "custom_registration_data";
        $wpdb->insert(
            $table_name,
            array(
                'username' => $username,
                'email' => $email,
                'password' => $password
            )
        );
    }
}

// Displaying the registration form on the front-end
function custom_registration_shortcode() {
    ob_start();
    custom_registration_form();
    store_registration_data();
    return ob_get_clean();
}

add_shortcode('custom_registration', 'custom_registration_shortcode');

// Creating the custom database table
function custom_registration_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "custom_registration_data";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    username varchar(55) NOT NULL,
    email varchar(55) NOT NULL,
    password varchar(55) NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'custom_registration_table');

