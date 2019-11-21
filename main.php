<?php
/*
Plugin Name: GK ACF Subscriber
Plugin URI: https://grzegorzkowalski.pl/
Description: Wtyczka modyfikuj¹ca wyœwietlanie widoku profilu subskrybenta pod k¹tem obs³ugi pól specjalnych ACF
Author: Grzegorz Kowalski
Version: 2.0.0
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

function gk_add_custom_admin_css() {
  echo '
  <style>
    body.subscriber #adminmenumain,
	body.subscriber #screen-meta,
	body.subscriber #screen-meta-links,
	body.subscriber .update-nag,
	body.subscriber .wp-heading-inline,
	body.subscriber .wp-header-end,
	body.subscriber #your-profile > h2,
	body.subscriber #your-profile > h3,
	body.subscriber #your-profile > table,
	body.subscriber #your-profile > span,
	body.subscriber #wpfooter {
		display: none;
	}
	
	body.subscriber #acf-form-data + h2 {
		display: block;
	}
	body.subscriber #acf-form-data + h2 + table.form-table {
		display: table;
	}
  </style>';
}

function gk_add_custom_admin_js() {
  echo "
  <script>
	$(function() {
		if ($('body.subscriber #acf-form-data + h2 + table.form-table').length) {
	  		$('#submit').val('Zapisz');
		}
		
		var checkbox_limit = 24;
		
		$('.acf-checkbox-list input').on('change', function(e) { 
			if ($('.acf-checkbox-list input:checked').length > checkbox_limit) { 
				alert('Nie mo¿esz umówiæ wiêcej spotkañ ni¿ ' + checkbox_limit); 
				this.checked = false; 
			} 
		});
	});
  </script>";
}

add_action('admin_head', 'gk_add_custom_admin_css');
add_action('admin_head', 'gk_add_custom_admin_js');