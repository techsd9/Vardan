<?php
/*
Plugin Name: Custom User Login Form
Description: A simple plugin that creates a custom user login form.
Version: 1.0
Author: OpenAI
*/

// Creating the login form
function custom_login_form() {
    echo '
    <form action="' . esc_url(admin_url('admin-post.php')) . '" method="post">
    <input type="hidden" name="action" value="custom_login">
    <div>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"/>
    </div>
    <div>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"/>
    </div>
    <input type="submit" name="submit" value="Login"/>
    </form>
    ';
}

// Authenticating the user
function custom_login() {
    if (isset($_POST['submit'])) {
        $username = sanitize_text_field($_POST['username']);
        $password = sanitize_text_field($_POST['password']);
        $user = wp_authenticate($username, $password);
        if (is_wp_error($user)) {
            echo 'Invalid username or password. Please try again.';
        } else {
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            wp_redirect(home_url());
            exit;
        }
    }
}

add_action('admin_post_custom_login', 'custom_login');

// Displaying the login form on the front-end
function custom_login_shortcode() {
    ob_start();
    custom_login_form();
    return ob_get_clean();
}

add_shortcode('custom_login', 'custom_login_shortcode');

