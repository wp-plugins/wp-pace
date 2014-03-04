<?php
/*
Plugin Name: WP Pace
Plugin URI: http://jamesdbruner.com
Description: Create an automatic page load progress bar. Based on <a href="http://github.hubspot.com/pace/docs/welcome/">Pace - Automatic page load progress bar</a>. Credits to <a href="http://dev.hubspot.com/">Hubspot</a>, Javascript by <a href="https://twitter.com/zackbloom">Zack Bloom</a>, CSS by <a href="https://twitter.com/adamfschwartz">Adam Schwartz</a>. Themes inspired by <a href="http://tympanus.net/codrops/2013/09/18/creative-loading-effects/">Mary Lou</a>
Version: 1.0
Author: James Bruner
Author URI: http://jamesdbruner.com
*/

require_once(dirname(__FILE__).'/pace-options.php');

if ( ! function_exists( 'pace_add_settings_link' ) ) {

  function pace_add_settings_link($links) {
	$settings_link = '<a href="options-general.php?page=wp-pace/pace-options.php">Settings</a>';
	$help_link = '<a href="http://jamesdbruner.com/topics/wp-pace/">Help</a>';
	
  	array_push( $links, $settings_link, $help_link );
  	return $links;
  }
  $plugin = plugin_basename(__FILE__);
  add_filter( "plugin_action_links_$plugin", 'pace_add_settings_link' );
}

//Add Enqueue Scripts
if ( ! function_exists( 'pace_sitewide' ) ) {
	function pace_sitewide(){

		$options = get_option('pace_options');
		if( !isset($pace_sitewide) && array_key_exists('pace_sitewide', $options) ){ $pace_sitewide = $options['pace_sitewide']; } 
		if( isset($pace_sitewide) && $pace_sitewide == 1){

		wp_enqueue_script( 'pace' , plugins_url('/js/pace.js', __FILE__) );
		$pace_dropdown = $options['pace_dropdown'];

		//dont know a better or simpler way to output this
		$pace_color = $options['pace-color'];
		if ( is_user_logged_in() ) { $loggedin = '.pace .pace-progress {margin-top: 28px}'; }else{ $loggedin = ''; }
		echo '<style>.pace .pace-progress, .pace .pace-activity{background:'. $pace_color .' !important}'. $loggedin .'</style>';


		if($pace_dropdown === 'one'){
		wp_register_style( 'minimal', plugins_url('/themes/minimal.css', __FILE__) );
		wp_enqueue_style( 'minimal' );
		}

		if($pace_dropdown === 'two'){
		wp_register_style( 'flash', plugins_url('/themes/flash.css', __FILE__) );
		wp_enqueue_style( 'flash' );
		}

		if($pace_dropdown === 'three'){
		wp_register_style( 'barbershop', plugins_url('/themes/barbershop.css', __FILE__) );
		wp_enqueue_style( 'barbershop' );
		}

		if($pace_dropdown === 'four'){
		wp_register_style( 'macosx', plugins_url('/themes/macosx.css', __FILE__) );
		wp_enqueue_style( 'macosx' );
		}

		if($pace_dropdown === 'five'){
		wp_register_style( 'fill-left', plugins_url('/themes/fill-left.css', __FILE__) );
		wp_enqueue_style( 'fill-left' );
		}

		if($pace_dropdown === 'six'){
		wp_register_style( 'flat-top', plugins_url('/themes/flat-top.css', __FILE__) );
		wp_enqueue_style( 'flat-top' );
		}

		if($pace_dropdown === 'seven'){
		wp_register_style( 'cornerindicator', plugins_url('/themes/cornerindicator.css', __FILE__) );
		wp_enqueue_style( 'cornerindicator' );
		}

		if($pace_dropdown === 'eight'){
		wp_register_style( 'bounce', plugins_url('/themes/bounce.css', __FILE__) );
		wp_enqueue_style( 'bounce' );
		}

		}
	}
}
// Hook into the 'wp enqueue scripts' action
add_action('wp_enqueue_scripts', 'pace_sitewide');

//Pace Shortcode
if ( ! function_exists( 'pace_shortcode' ) ) {

	function pace_shortcode($atts){

		$options = get_option('pace_options');
		if( !isset($pace_sitewide) && array_key_exists('pace_sitewide', $options) ){ $pace_sitewide = $options['pace_sitewide']; } 
		if( !isset($pace_sitewide) || $pace_sitewide == 0){

		//Enqueue pace.js
		extract( shortcode_atts(array('color', 'theme'), $atts) );
		wp_enqueue_script( 'pace' , plugins_url('/js/pace.js', __FILE__) );

		//Setting defaults
		if( !isset($atts['color']) ){$atts['color'] = '#29d';}
		if( !isset($atts['theme']) ){$atts['theme'] = 'minimal';}

		//dont know a better or simpler way to output this
       
		if ( is_user_logged_in() ) { $loggedin = '.pace .pace-progress {margin-top: 28px;}'; }else{ $loggedin = ''; }
		echo "<style>.pace .pace-progress, .pace .pace-activity{background:". $atts['color'] ." !important;}". $loggedin ."</style>";


		if($atts['theme'] === 'minimal'){
		wp_register_style( 'minimal', plugins_url('/themes/minimal.css', __FILE__) );
		wp_enqueue_style( 'minimal' );
		}

		if($atts['theme'] === 'flash'){
		wp_register_style( 'flash', plugins_url('/themes/flash.css', __FILE__) );
		wp_enqueue_style( 'flash' );
		}

		if($atts['theme'] === 'barbershop'){
		wp_register_style( 'barbershop', plugins_url('/themes/barbershop.css', __FILE__) );
		wp_enqueue_style( 'barbershop' );
		}

		if($atts['theme'] === 'macosx'){
		wp_register_style( 'macosx', plugins_url('/themes/macosx.css', __FILE__) );
		wp_enqueue_style( 'macosx' );
		}

		if($atts['theme'] === 'fill-left'){
		wp_register_style( 'fill-left', plugins_url('/themes/fill-left.css', __FILE__) );
		wp_enqueue_style( 'fill-left' );
		}

		if($atts['theme'] === 'flat-top'){
		wp_register_style( 'flat-top', plugins_url('/themes/flat-top.css', __FILE__) );
		wp_enqueue_style( 'flat-top' );
		}

		if($atts['theme'] === 'cornerindicator'){
		wp_register_style( 'cornerindicator', plugins_url('/themes/cornerindicator.css', __FILE__) );
		wp_enqueue_style( 'cornerindicator' );
		}

		if($atts['theme'] === 'bounce'){
		wp_register_style( 'bounce', plugins_url('/themes/bounce.css', __FILE__) );
		wp_enqueue_style( 'bounce' );
		}
		
		}
	}
add_shortcode('pace', 'pace_shortcode');
}