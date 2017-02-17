<?php
/*
* Template Name: Login Page
*/
?>
<?php get_header(); ?>

<div id="main">
	<div id="login-page">
<?php $args = array(
        'echo'           => true,
        'redirect'       => site_url( $_SERVER['REQUEST_URI'] ), 
        'form_id'        => 'loginform',
        'label_username' => 'Username',
        'label_password' => 'Password',
        'label_remember' => 'Remember Me',
        'label_log_in'   => 'Log In',
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => NULL,
        'value_remember' => false
);  wp_login_form($args); ?>
	</div>
</div>
<?php get_footer(); ?>