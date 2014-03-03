=== Wordpress Default Text ===
Contributors: jkalawe
Donate link: http://www.bgca.org
Tags: template, default, editorial, multisite
Requires at least: 3.0.1
Tested up to: 3.8.1
Stable tag: 1.04
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Insert configureable text defaults for new content title and body fields.

== Description ==

Default Text is a a helpful workflow tool:
* Enforce editorial standards for title and body styles
* A quick reference for content editors that aren't regular contributors

= Variables =
Variables are available to customize your default text strings. You can create your own custom variables also! Consult the FAQ for more details.

= Multisite =
Default Text is also multisite compatible as it has been designed for a multisite environment.

== Installation ==

1. Upload `default-text.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= I want a page/post to have a blank body, i.e. no text =

Simply add a space or other invisible character. One is enough.


= I'd like to include my own custom variables =

Default Text checks for the existance of a function named `default_text_gemini` before outputting title or body text.

Either inclue this function in your themes `functions.php` file or in a custom plugin.

Make sure that the function outputs an associative array in the following format:
`array('$variable'=>'value');`

== Screenshots ==

1. Animated demo of functionality including use of custom variables.

2. Settings view in it's entirety.

== Changelog ==

= 1.04 =
* Cleaned-up readme and added screenshot of settings

= 1.03 =
* Created function `default_text_string` to fix other conditions with bug found by yoramzara.

= 1.02 =
* Default argument values included with `default_text_title` and `default_text_body` functions. Bug found by yoramzara.

= 1.01 =
* Animated GIF screenshot provided

= 1.0 =
* Initial version

== Upgrade Notice ==

= 1.04 =
* Documentation more user-friendly with exanded FAQ and screenshot of settings. No code/bug fixes.

= 1.03 =
* Created function `default_text_string` to fix other conditions with bug found by yoramzara.

= 1.02 =
* Fix issue where error thrown on certain php installations if default argument for a function is not defined.

= 1.01 =
* Animated GIF screenshot provided

= 1.0 =
* Initial version