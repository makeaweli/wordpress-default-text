<?php

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */
 
/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action('admin_init', 'sandbox_initialize_theme_options');
function sandbox_initialize_theme_options() {
 
    // First, we register a section. This is necessary since all future options must belong to one.
    add_settings_section(
        'general_settings_section',         // ID used to identify this section and with which to register options
        'Sandbox Options',                  // Title to be displayed on the administration page
        'sandbox_general_options_callback', // Callback used to render the description of the section
        'general'                           // Page on which to add this section of options
    );

    // Next, we will introduce the fields for toggling the visibility of content elements.
    add_settings_field( 
        'default_text_title',                      // ID used to identify the field throughout the theme
        'Title',                           // The label to the left of the option interface element
        'default_text_title_callback',   // The name of the function responsible for rendering the option interface
        'general',                          // The page on which this option will be displayed
        'general_settings_section',         // The name of the section to which this field belongs
        array(                              // The array of arguments to pass to the callback. In this case, just a description.
            'Activate this setting to display the header.'
        )
    );

    // Finally, we register the fields with WordPress
    register_setting(
        'general',
        'default_text_title'
    );

    register_setting(
        'general',
        'default_text_body'
    );

} // end sandbox_initialize_theme_options



/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */
 
/**
 * This function provides a simple description for the General Options page. 
 *
 * It is called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function default_text_plugin_options() {
    echo '<p>Select which areas of content you wish to display.</p>';
} // end sandbox_general_options_callback

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 * 
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function default_text_title_callback($args) {
     // Create a header in the default WordPress 'wrap' container
         $html = '<div class="wrap">';
             $html .= '<h2>Default Text Options</h2>';
             $html .= '<p class="description">This plugin auto-populates the text and body fields of a new post.</p>';
             $html .= '<table class="form-table">
                <tbody>
                  <tr>
                    <th><label>Title</label></th>
                    <td>
                      <textarea cols="72" rows="2" name="default_text_title" >' . get_option('default_text_title') . '</textarea><br /><code>' . default_post_title() . '</code></td>

                  </tr>

                  <tr>
                    <th><label>Body</label></th>
                    <td>
                      <textarea cols="72" rows="2" name="default_text_body" >' . get_option('default_text_body') . '</textarea><br /><code>' . default_post_title() . '</code></td>

                  </tr>
                </tbody>
              </table>';

              $html .= '<h3>Variables</h3>';
              $html .= '<p>Use the variables to customize your title and body text. For example using <code>$username</code> would list the current users\' username.';

         $html .= '</div>';
    // Note the ID and the name attribute of the element should match that of the ID in the call to add_settings_field
    $html .= '<input type="text" id="default_text_title" name="default_text_title" value="' .get_option('default_text_title') . '" />';
     
    // Here, we will take the first argument of the array and add it to a label next to the checkbox
    $html .= '<label for="default_text"> Select which areas of content you wish to display.</label>';
     
    echo $html;
     
} // end sandbox_toggle_header_callback

function default_text_plugin_menu() {
 
    add_options_page(
        'Default Text Plugin',           // The title to be displayed in the browser window for this page.
        'Default Text',           // The text to be displayed for this menu item
        'administrator',            // Which type of users can see this menu item
        'default_text_plugin_options',   // The unique ID - that is, the slug - for this menu item
        'default_text_title_callback'    // The name of the function to call when rendering the page for this menu
    );
 
} // end sandbox_example_plugin_menu
add_action('admin_menu', 'default_text_plugin_menu');

?>