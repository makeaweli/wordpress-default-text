<?php
/**
 * @package default
 * @version 1.04
 */
/*
Plugin Name: Default Text
Plugin URI: http://wordpress.org/plugins/default-text/
Description: Insert text defaults for new post title and body
Author: Jason M. Kalawe
Version: 1.04
Author URI: http://makea.kalawe.com

*/

include_once dirname( __FILE__ ) . '/settings.php';

if (!defined('MYPLUGIN_PLUGIN_NAME'))
    define('MYPLUGIN_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('MYPLUGIN_PLUGIN_DIR'))
    define('MYPLUGIN_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYPLUGIN_PLUGIN_NAME);

if (!defined('MYPLUGIN_PLUGIN_URL'))
    define('MYPLUGIN_PLUGIN_URL', WP_PLUGIN_URL . '/' . MYPLUGIN_PLUGIN_NAME);

/*
 * Return text string
 * $type string Either 'title' or 'body'
 */
function default_text_string($type) {
  if($type) {
    return strtr(get_option('default_text_'. $type), default_text_variables() );
  }

  return '';
}
 
/*
 * Create the default text title string
 */
function default_text_title($content)
{
  if (empty($content))
    $content = default_text_string('title');

  return $content;
    
}

/*
 * Create the default text body string
 */
function default_text_body($content)
{
  if (empty($content))
    $content = default_text_string('body');

  return $content;
    
}

/* 
 * Return array of variables
 */
function default_text_variables() {
  // Get current user information
  $user = wp_get_current_user();

  $variables =  array(
    // Current User
    '$username'=>$user->user_login,
    '$user_email'=>$user->user_email,
    '$user_firstname'=>$user->user_firstname,
    '$user_lastname'=>$user->user_lastname,
    '$user_display_name'=>$user->display_name,
    '$user_id'=>$user->ID,
    // Date
    '$Y'=>date('Y'),
    '$M'=>date('M'),
    '$d'=>date('d'),
  );

  // Check if the Default Text Gemini plugin is installed
  if(function_exists(default_text_gemini)) {
    $variables = array_merge($variables, default_text_gemini());
  }
  return $variables;

}

add_filter('default_title', 'default_text_title');
add_filter('the_editor_content', 'default_text_body');


?>
