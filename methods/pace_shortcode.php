<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		$options = get_option('pace_options');
		if( !isset($pace_sitewide) && is_array($options) && array_key_exists('pace_sitewide', $options) ){ $pace_sitewide = $options['pace_sitewide']; } 
		if( !isset($pace_sitewide) || $pace_sitewide == 0){

		//Enqueue pace.js
		extract( shortcode_atts(array('color', 'theme'), $atts) );
		wp_enqueue_script( 'pace' , plugins_url('../js/pace.js', __FILE__) );

		//Setting defaults
		if( !isset($atts['color']) ){$atts['color'] = '#29d';}
		if( !isset($atts['theme']) ){$atts['theme'] = 'minimal';}

		//dont know a better or simpler way to output this
       
		if ( is_user_logged_in() ) { $loggedin = '.pace .pace-progress {margin-top: 32px;}'; }else{ $loggedin = ''; }
		echo "<style>.pace .pace-progress, .pace .pace-activity{background:". $atts['color'] ." !important;  border:". $atts['color'] ." !important;}". $loggedin ."</style>";


		if($atts['theme'] === 'minimal'){
		wp_register_style( 'minimal', plugins_url('../themes/minimal.css', __FILE__) );
		wp_enqueue_style( 'minimal' );
		}

		if($atts['theme'] === 'flash'){
		wp_register_style( 'flash', plugins_url('../themes/flash.css', __FILE__) );
		wp_enqueue_style( 'flash' );
		}

		if($atts['theme'] === 'barbershop'){
		wp_register_style( 'barbershop', plugins_url('../themes/barbershop.css', __FILE__) );
		wp_enqueue_style( 'barbershop' );
		}

		if($atts['theme'] === 'macosx'){
		wp_register_style( 'macosx', plugins_url('../themes/macosx.css', __FILE__) );
		wp_enqueue_style( 'macosx' );
		}

		if($atts['theme'] === 'fill-left'){
		wp_register_style( 'fill-left', plugins_url('../themes/fill-left.css', __FILE__) );
		wp_enqueue_style( 'fill-left' );
		}

		if($atts['theme'] === 'flat-top'){
		wp_register_style( 'flat-top', plugins_url('../themes/flat-top.css', __FILE__) );
		wp_enqueue_style( 'flat-top' );
		}

		if($atts['theme'] === 'cornerindicator'){
		wp_register_style( 'cornerindicator', plugins_url('../themes/cornerindicator.css', __FILE__) );
		wp_enqueue_style( 'cornerindicator' );
		}

		if($atts['theme'] === 'bounce'){
		wp_register_style( 'bounce', plugins_url('../themes/bounce.css', __FILE__) );
		wp_enqueue_style( 'bounce' );
		}
	
		if($atts['theme'] === 'bigcounter'){
		wp_register_style( 'bigcounter', plugins_url('../themes/bigcounter.css', __FILE__) );
		wp_enqueue_style( 'bigcounter' );
		}

		if($atts['theme'] === 'centercircle'){
		wp_register_style( 'centercircle', plugins_url('../themes/centercircle.css', __FILE__) );
		wp_enqueue_style( 'centercircle' );
		}

		}	