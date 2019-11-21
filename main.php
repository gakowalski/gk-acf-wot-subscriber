<?php
/*
Plugin Name: GK ACF Subscriber
Plugin URI: https://grzegorzkowalski.pl/
Description: Wtyczka modyfikuj¹ca wyœwietlanie widoku profilu subskrybenta pod k¹tem obs³ugi pól specjalnych ACF
Author: Grzegorz Kowalski
Version: 1.0.0
Author URI: https://grzegorzkowalski.pl/
License:
*/

function gk_add_is_subscriber_class( $classes ) {
	return array_merge( $classes, array( current_user_can('subscriber')? 'subscriber' : 'not-subscriber' ) );
}

function gk_add_is_admin_subscriber_class( $classes ) {
        $classes .= current_user_can('subscriber')? 'subscriber' : 'not-subscriber';
	return $classes;
}

add_filter( 'admin_body_class', 'gk_add_is_admin_subscriber_class' );
add_filter( 'body_class', 'gk_add_is_subscriber_class' );

function gk_add_acf() {
	if (
		! function_exists( 'acf_form_head' )
	) {
		return;
	}
	acf_form_head();
}

add_action( 'wp_head', 'gk_add_acf' );