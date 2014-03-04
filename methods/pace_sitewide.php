<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		$options = get_option('pace_options');
		if( !isset($pace_sitewide) && is_array($options) && array_key_exists('pace_sitewide', $options) ){ $pace_sitewide = $options['pace_sitewide']; } 
		if( isset($pace_sitewide) && $pace_sitewide == 1){

		wp_enqueue_script( 'pace' , plugins_url('../js/pace.js', __FILE__) );
		$pace_dropdown = $options['pace_dropdown'];

		//dont know a better or simpler way to output this
		$pace_color = $options['pace-color'];
		if ( is_user_logged_in() ) { $loggedin = '.pace .pace-progress {margin-top: 32px}'; }else{ $loggedin = ''; }
		echo '<style>.pace .pace-progress, .pace .pace-activity{background:'. $pace_color .' !important}'. $loggedin .'</style>';


		if($pace_dropdown === 'one'){
		wp_register_style( 'minimal', plugins_url('../themes/minimal.css', __FILE__) );
		wp_enqueue_style( 'minimal' );
		}

		if($pace_dropdown === 'two'){
		wp_register_style( 'flash', plugins_url('../themes/flash.css', __FILE__) );
		wp_enqueue_style( 'flash' );
		}

		if($pace_dropdown === 'three'){
		wp_register_style( 'barbershop', plugins_url('../themes/barbershop.css', __FILE__) );
		wp_enqueue_style( 'barbershop' );
		}

		if($pace_dropdown === 'four'){
		wp_register_style( 'macosx', plugins_url('../themes/macosx.css', __FILE__) );
		wp_enqueue_style( 'macosx' );
		}

		if($pace_dropdown === 'five'){
		wp_register_style( 'fill-left', plugins_url('../themes/fill-left.css', __FILE__) );
		wp_enqueue_style( 'fill-left' );
		}

		if($pace_dropdown === 'six'){
		wp_register_style( 'flat-top', plugins_url('../themes/flat-top.css', __FILE__) );
		wp_enqueue_style( 'flat-top' );
		}

		if($pace_dropdown === 'seven'){
		wp_register_style( 'cornerindicator', plugins_url('../themes/cornerindicator.css', __FILE__) );
		wp_enqueue_style( 'cornerindicator' );
		}

		if($pace_dropdown === 'eight'){
		wp_register_style( 'bounce', plugins_url('../themes/bounce.css', __FILE__) );
		wp_enqueue_style( 'bounce' );
		}
	
		if($pace_dropdown === 'nine'){
		wp_register_style( 'bigcounter', plugins_url('../themes/bigcounter.css', __FILE__) );
		wp_enqueue_style( 'bigcounter' );
		}

		if($pace_dropdown === 'ten'){
		wp_register_style( 'centercircle', plugins_url('../themes/centercircle.css', __FILE__) );
		wp_enqueue_style( 'centercircle' );
		}

		}