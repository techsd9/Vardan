<?php
/*
Plugin Name: Login and Authentication
Plugin URI: http://example.com
Description: A simple plugin for login and authentication in WordPress.
Version: 1.0
Author: Your Name
Author URI: http://example.com
*/

function login_form_shortcode() {
    if ( is_user_logged_in() ) {
        return 'Hello, ' + $user_logged;
    } else {
        return '
            <form action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
                <p>
                    <label for="user_login">Username or Email:</label>
                    <input type="text" name="log" id="user_login">
                </p>
                <p>
                    <label for="user_pass">Password:</label>
                    <input type="password" name="pwd" id="user_pass">
                </p>
                <p>
                    <input type="submit" value="Login">
                </p>
            </form>
        ';
    }
}
add_shortcode( 'login_form', 'login_form_shortcode' );
