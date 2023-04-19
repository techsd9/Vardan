<?php /* Template Name: custom login Template */ ?>
<?php

# require(dirname(__FILE__) . '/wp-load.php');
require(dirname("C:\xampp\htdocs\vardan") . '/wp-load.php');


function custom_login_template()
{
	if ( ! is_user_logged_in() ) { 
    $args = array(
        'redirect' => admin_url(), //redirect to admin panel/dashboard.
        'form_id' => 'custom_loginform',
        'label_username' => __( 'Username:' ),
        'label_password' => __( 'Password:' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In custom text' ),
        'remember' => true
    );
    wp_login_form( $args );
	}
}
add_action('init', 'custom_login_template');

?>

