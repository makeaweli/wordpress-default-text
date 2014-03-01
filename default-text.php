<?php
/**
 * @package default
 * @version 1.2
 */
/*
Plugin Name: Default Text
Plugin URI: http://wordpress.org/plugins/default-text/
Description: Insert text defaults for new post title and body
Author: Jason M. Kalawe
Version: 1.0
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
 * Create the default text title string
 */
function default_text_title($content)
{
  if (empty($content))
    //GN (Night Tel|Night Obs|Day SOS|DA|Inst PoC) Shift Change Notes 2014Feb28 Jason Kalawe
    //echo $site." (Night Tel|Night Obs|Day SOS|DA|Inst PoC) Shift Change Notes ".gmdate('YMd')." ".$profiledata->user_firstname." ".$profiledata->user_lastname;

    $content = strtr(get_option('default_text_title'), default_text_variables() );

  return $content;
    
}

/*
 * Create the default text body string
 */
function default_text_body($content)
{
  if (empty($content))
    //(Please remember to edit title and select categories.)
    $content = strtr(get_option('default_text_body'), default_text_variables() );
  return $content;
    
}

/* 
 * Return array of variables
 */
function default_text_variables() {
  // Get current user information
  $user = wp_get_current_user();

  return array(
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
    '$site'=>'GN'
  );

}

add_filter('default_title', 'default_text_title');
add_filter('the_editor_content', 'default_text_body');


?>
