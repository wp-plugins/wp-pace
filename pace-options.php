<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'pace_add_defaults');
register_uninstall_hook(__FILE__, 'pace_delete_plugin_options');
add_action('admin_init', 'pace_init' );
add_action('admin_menu', 'pace_add_options_page');
//add_filter( 'plugin_action_links', 'pace_plugin_action_links', 10, 2 );

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'pace_delete_plugin_options')
// --------------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE USER DEACTIVATES AND DELETES THE PLUGIN. IT SIMPLY DELETES
// THE PLUGIN OPTIONS DB ENTRY (WHICH IS AN ARRAY STORING ALL THE PLUGIN OPTIONS).
// --------------------------------------------------------------------------------------

// Delete options table entries ONLY when plugin deactivated AND deleted
function pace_delete_plugin_options() {
	delete_option('pace_options');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_activation_hook(__FILE__, 'pace_add_defaults')
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE PLUGIN IS ACTIVATED. IF THERE ARE NO THEME OPTIONS
// CURRENTLY SET, OR THE USER HAS SELECTED THE CHECKBOX TO RESET OPTIONS TO THEIR
// DEFAULTS THEN THE OPTIONS ARE SET/RESET.
//
// OTHERWISE, THE PLUGIN OPTIONS REMAIN UNCHANGED.
// ------------------------------------------------------------------------------

// Define default option settings
function pace_add_defaults() {
	$tmp = get_option('pace_options');
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('pace_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		$arr = array( "pace-color" => "#0d77b6" );
		update_option('pace_options', $arr);
	}
}

// Enqueue Color Picker
add_action( 'admin_enqueue_scripts', 'pace_enqueue_color_picker' );
function pace_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'pace_init' )
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_init' HOOK FIRES, AND REGISTERS YOUR PLUGIN
// SETTING WITH THE WORDPRESS SETTINGS API. YOU WON'T BE ABLE TO USE THE SETTINGS
// API UNTIL YOU DO.
// ------------------------------------------------------------------------------

// Init plugin options to white list our options
function pace_init(){

    // Argument one of register_setting is a settings group name. This must match the group name in settings_fields()
    // Argument two is the name of an option whose value gets sanitized and saved, or, if the values are saved as an array, the name of the options group.
    // Normally there would be a register_setting called for each add_settings_field, with the second argument being the name that the setting is saved under in the database.
    // In this case, because all the settings will be stored as an array under one name, there is only one register_setting. The second argument is the name that the array is stored under in the database.
	register_setting( 'pace_plugin_options', 'pace_options', 'pace_validate_options' );
    
    // Argument three of add_settings_section is the callback function that generates the html that creates an options section on the options page. The callback function should echo the html.
    add_settings_section( 'pace_plugin_display_options', 'Customize Pace', 'pace_plugin_display_options_section', 'pace_plugin_display_options_section' );
    
    // Argument four of add_settings_field is the name of the callback function that will generate the html for the options page.   
    // Argument five is the name of the section you want the option to fall under on the options page.   
add_settings_field( 'pace-color', 'Color', 'pace_plugin_setting_color', 'pace_plugin_display_options_section', 'pace_plugin_display_options' );
add_settings_field( 'pace_dropdown', 'Theme', 'pace_plugin_setting_dropdown', 'pace_plugin_display_options_section', 'pace_plugin_display_options' );
add_settings_field( 'pace_sitewide', 'Sitewide', 'pace_plugin_setting_sitewide', 'pace_plugin_display_options_section', 'pace_plugin_display_options' );


}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Add menu page
function pace_add_options_page() {
	add_options_page('Pace Settings Page', 'Pace Settings', 'manage_options', __FILE__, 'pace_render_form');
}


// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Render the Plugin options form
function pace_render_form() {
?>
	<div class="wrap">
		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Pace Options</h2>
        
<?php    
    if (! current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    else {
?>
		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('pace_plugin_options'); ?>
            <?php do_settings_sections('pace_plugin_display_options_section'); ?>


			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
<script> jQuery(document).ready(function($){ $('.pace-color').wpColorPicker(); }); </script>
<style>.form-table td {line-height: 30px !important;</style>

<?php
    }
?>
	</div>
<?php	
}

// ************************************************************************************************************

// Callback functions for generating the html for the options sections and for each option.

// Section HTML displayed before the options.
function pace_plugin_display_options_section() {
    echo '<div id="display_options"><strong>These settings let you customize the color, and style of the loading animation.</strong></div>';
}

function pace_plugin_setting_color() {
    $options = get_option('pace_options');
    $pacecolor = $options['pace-color'];
echo '<input class="pace-color" data-default-color="#0d77b6" type="text" name="pace_options[pace-color]" value="'. $pacecolor .'"  />';
}

function pace_plugin_setting_dropdown() {
    $options = get_option('pace_options');
    ?><select name='pace_options[pace_dropdown]'><option value='one' <?php selected('one', $options['pace_dropdown']); ?>>Minimal</option><option value='two' <?php selected('two', $options['pace_dropdown']); ?>>Flash</option><option value='three' <?php selected('three', $options['pace_dropdown']); ?>>Barber Shop</option><option value='four' <?php selected('four', $options['pace_dropdown']); ?>>Mac OSX</option><option value='five' <?php selected('five', $options['pace_dropdown']); ?>>Fill Left</option><option value='six' <?php selected('six', $options['pace_dropdown']); ?>>Flat Top</option><option value='seven' <?php selected('seven', $options['pace_dropdown']); ?>>Corner Indicator</option><option value='eight' <?php selected('eight', $options['pace_dropdown']); ?>>Bounce</option><option value='nine' <?php selected('nine', $options['pace_dropdown']); ?>>Big Counter</option><option value='ten' <?php selected('ten', $options['pace_dropdown']); ?>>Center Circle</option></select> <?php
}

function pace_plugin_setting_sitewide() {
    $options = get_option('pace_options');
    if (isset($options['pace_sitewide'])) { $checked = checked('1', $options['pace_sitewide'], false); }else{$checked = 0;}
    echo '<input name="pace_options[pace_sitewide]" type="checkbox" value="1"' . $checked . ' />';
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function pace_validate_options($input) {
	// strip html from textboxes
	$input['pace-color'] =  wp_filter_nohtml_kses($input['pace-color']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input; 
} 