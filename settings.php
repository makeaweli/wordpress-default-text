<?php

/* ------------------------------------------------------------------------ *
 * Create page in menu for settings page
 * ------------------------------------------------------------------------ */

function default_text_plugin_menu() {
 
    add_options_page(
        'Default Text Plugin',           // The title to be displayed in the browser window for this page.
        'Default Text',           // The text to be displayed for this menu item
        'administrator',            // Which type of users can see this menu item
        'options-default-text',   // The unique ID - that is, the slug - for this menu item
        'default_text_page_callback'    // The name of the function to call when rendering the page for this menu
    );
 
} // default_text_plugin_menu
add_action('admin_menu', 'default_text_plugin_menu');

 
/**
 * Initializes the options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action('admin_init', 'default_text_initialize_options');
function default_text_initialize_options() {
 
    // First, we register a section. This is necessary since all future options must belong to one.
    add_settings_section(
        'default_text_section',         // ID used to identify this section and with which to register options
        'Default Text Options',                  // Title to be displayed on the administration page
        'default_text_page_section_callback', // Callback used to render the description of the section
        'options-default-text'                           // Page on which to add this section of options
    );

    add_settings_section(
        'default_text_variables_section',         // ID used to identify this section and with which to register options
        'Default Text Variables',                  // Title to be displayed on the administration page
        'default_text_page_section_variables_callback', // Callback used to render the description of the section
        'options-default-text'                           // Page on which to add this section of options
    );

    // Next, we will introduce the fields for toggling the visibility of content elements.
    add_settings_field( 
        'default_text_title',                      // ID used to identify the field throughout the theme
        'Title',                           // The label to the left of the option interface element
        'default_text_title_callback',   // The name of the function responsible for rendering the option interface
        'options-default-text',                          // The page on which this option will be displayed
        'default_text_section',         // The name of the section to which this field belongs
        array(                              // The array of arguments to pass to the callback. In this case, just a description.
            'Activate this setting to display the header.'
        )
    );

    add_settings_field( 
        'default_text_body',                      // ID used to identify the field throughout the theme
        'Body',                           // The label to the left of the option interface element
        'default_text_body_callback',   // The name of the function responsible for rendering the option interface
        'options-default-text',                          // The page on which this option will be displayed
        'default_text_section',         // The name of the section to which this field belongs
        array(                              // The array of arguments to pass to the callback. In this case, just a description.
            'Activate this setting to display the header.'
        )
    );

    // Finally, we register the fields with WordPress
    register_setting(
        'options-default-text',
        'default_text_title'
    );

    register_setting(
        'options-default-text',
        'default_text_body'
    );

} 

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */
 
/*
 * HTML render section description
 */
function default_text_page_section_callback() {
  echo 'This plugin auto-populates the text and body fields of a new post.';
} 

function default_text_page_callback() {
  ?>
  <form method="POST" action="options.php">
  <?php settings_fields( 'options-default-text' ); //pass slug name of page, also referred
                                          //to in Settings API as option group name
  do_settings_sections( 'options-default-text' );  //pass slug name of page
  submit_button();
  ?>
  </form>
<?php
}

/*
 * Output section for variables
 */
function default_text_page_section_variables_callback() {
  // Get array of variables
  $variables = default_text_variables();
?>
  <p>Use the variables to customize your title and body text. For example using <code>$username</code> would list the current users' username <code><?php echo $variables['$username'];?></code>.</p>
  <table class="form-table">
    <tr>
      <th>Variable</th>
      <th>Value</th>
    </tr>
<?php
  foreach($variables as $k=>$v) {
echo <<<HEREDOC
    <tr><th>$k</th><td>$v</td></tr>
HEREDOC;
  }
  ?>
  </table>
  <?php
}

/*
 * Output textarea for title
 */
function default_text_title_callback($args) {
     
  $html = '<textarea cols="72" rows="2" name="default_text_title" >' . get_option('default_text_title') . '</textarea><br /><code>' . default_text_string('title') . '</code>'; 
  echo $html;
     
}

/*
 * Output textarea for body
 */
function default_text_body_callback($args) {
     
  $html = '<textarea cols="72" rows="2" name="default_text_body" >' . get_option('default_text_body') . '</textarea><br /><code>' . default_text_string('body') . '</code>'; 
  echo $html;
     
}



?>