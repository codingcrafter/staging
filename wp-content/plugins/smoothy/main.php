<?php
/**
 * Plugin Name:         Smoothy
 * Plugin URI:          https://evandrews.me/smoothy
 * Description:         A simple & lightweight smooth scrolling JS library. 
 * Version:             0.0.1
 * Requires at least:   Wordpress 5.0
 * Requires PHP:        7.0
 * Author:              Evan Drews
 * Author URI:          https://evandrews.me
 **/

function enqueue_smoothy () {
	wp_enqueue_script( 'init', 'smoothy', get_theme_file_uri('https://evandrews.me/wp-content/plugins/smoothy/js/src/index.js'), array(), true );
}

add_action( 'wp_enqueue_scripts', 'enqueue_smoothy' );

?>