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
 
function default_post_title($content)
{
  if (empty($content))
    //GN (Night Tel|Night Obs|Day SOS|DA|Inst PoC) Shift Change Notes 2014Feb28 Jason Kalawe
    //echo $site." (Night Tel|Night Obs|Day SOS|DA|Inst PoC) Shift Change Notes ".gmdate('YMd')." ".$profiledata->user_firstname." ".$profiledata->user_lastname;
    $content = "Jason Was Here!";
    /*$content = default_post_formattemplater('$site (Night Tel|Night Obs|Day SOS|Inst PoC) Shift Change Notes $Y$M$d $user_firstname $user_lastname', 
        array(
          'site'=>'GN', 
          'Y'=>date('Y'),
          'M'=>date('M'),
          'd'=>date('d'),
          'user_firstname'=>'Jason',
          'user_lastname'=>'Kalawe',
          'quark'=>'express'
      ));*/
    $content = default_post_formattemplater(get_option('default_text_title'), 
        array(
          'site'=>'GN', 
          'Y'=>date('Y'),
          'M'=>date('M'),
          'd'=>date('d'),
          'user_firstname'=>'Jason',
          'user_lastname'=>'Kalawe',
          'quark'=>'express'
      ));
  return $content;
}

function default_post_content($content)
{
  if (empty($content))
    //(Please remember to edit title and select categories.)
    $content = "Jason Was Here!";
  return $content;
}

// http://stackoverflow.com/a/13237640/2892308 
function default_post_formattemplater($string, $params) {
    // Determine largest string
    $largest = 0;
    foreach(array_keys($params) as $k) {
        if(($l=strlen($k)) > $largest) $largest=$l;
    }

    $buff   = '';

    $cp     = false;    // Conditional parenthesis
    $ip     = false;    // Inside parameter
    $isp    = false;    // Is set parameter

    $bl     = 1;    // buffer length
    $param  = '';   // current parameter

    $out    = '';  // output string
    $string .= '!';

    for($sc=0,$c=$oc='';isset($string{$sc});++$sc,++$bl) {
        $c = $string{$sc};

        if($ip) {
            $a = ord($c);

            if(!($a == 95 || (                  // underscore
                    ($a >= 48 && $a <= 57)      // 0-9
                    || ($a >= 65 && $a <= 90)   // A-Z
                    || ($a >= 97 && $a <= 122)  // a-z
                )
            )) {

                $isp = isset($params[$buff]);

                if(!$cp && !$isp) {
                    trigger_error(
                            sprintf(
                                    __FUNCTION__.': the parameter "%s" is not defined'
                                    , $buff
                            )
                            , E_USER_ERROR
                    );
                } elseif(!$cp || $isp) {
                    $out    .= $params[$buff];
                }

                $isp    = $isp && !empty($params[$buff]);
                $oc     = $buff = '';
                $bl     = 0;
                $ip     = false;
            }
        }

        if($cp && $c === ')') {
            $out .= $buff;

            $cp = $isp = false;
            $c  = $buff = '';
            $bl = 0;
        }

        if(($cp && $isp) || $ip)
            $buff .= $c;

        if($c === '$' && $oc !== '\\') {
            if($oc === '(')  $cp = true;
            else $out .= $oc;

            $ip   = true;
            $buff = $c = $oc = '';
            $bl   = 0;
        }

        if(!$cp && $bl > $largest) {
            $buff   = substr($buff, - $largest);
            $bl     = $largest;
        }

        if(!$ip && ( !$cp || ($cp && $isp))) {
            $out .= $oc;
            if(!$cp) $oc = $c;
        }
    }

    return $out;
}

add_filter('default_title', 'default_post_title');
add_filter('the_editor_content', 'default_post_content');


?>
