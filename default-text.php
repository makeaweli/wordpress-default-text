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



if (!defined('MYPLUGIN_PLUGIN_NAME'))
    define('MYPLUGIN_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('MYPLUGIN_PLUGIN_DIR'))
    define('MYPLUGIN_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYPLUGIN_PLUGIN_NAME);

if (!defined('MYPLUGIN_PLUGIN_URL'))
    define('MYPLUGIN_PLUGIN_URL', WP_PLUGIN_URL . '/' . MYPLUGIN_PLUGIN_NAME);
 
function my_default_post($content)
{
  if (empty($content))
    $content = "Your default text";
  return $content;
}

add_filter('the_editor_content', 'my_default_post');



?>
