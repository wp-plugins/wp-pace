<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: WP Pace
Plugin URI: http://jamesdbruner.com
Description: Create an automatic page load progress bar. Based on <a href="http://github.hubspot.com/pace/docs/welcome/">Pace - Automatic page load progress bar</a>. Credits to <a href="http://dev.hubspot.com/">Hubspot</a>, Javascript by <a href="https://twitter.com/zackbloom">Zack Bloom</a>, CSS by <a href="https://twitter.com/adamfschwartz">Adam Schwartz</a>. Themes inspired by <a href="http://tympanus.net/codrops/2013/09/18/creative-loading-effects/">Mary Lou</a>
Version: 2.0
Author: James Bruner
Author URI: http://jamesdbruner.com
*/

class pace{

    // Constructor for the class.
    public function __construct() {

        // Load options page, Add Shortcode, Custom Settings Link, Hook into the 'wp enqueue scripts' action
       add_action( 'init', array( $this, 'pace_options_page' ));
       add_shortcode( 'pace', array( $this, 'pace_shortcode' ) );
	$plugin = plugin_basename(__FILE__);
	add_filter( 'plugin_action_links_$plugin', array( $this, 'pace_add_settings_link') );
	add_action('wp_enqueue_scripts', array( $this, 'pace_sitewide' ) );

	}

	//Add options page
	public function pace_options_page(){
		require_once(dirname(__FILE__).'/pace-options.php');
	}

	public function pace_add_settings_link($links) {
		$settings_link = '<a href="options-general.php?page=wp-pace/pace-options.php">Settings</a>';
		$help_link = '<a href="http://jamesdbruner.com/topics/wp-pace/">Help</a>';
	
  		array_push( $links, $settings_link, $help_link );
  		return $links;
	}

	//Pace Sitewide | Add Enqueue Scripts
	public function pace_sitewide(){
		include_once('methods/pace_sitewide.php');
	}

	//Pace Shortcode
	public function pace_shortcode($atts){
		include_once('methods/pace_shortcode.php');
	}

}
// Instantiate the class.
$pace = new pace();