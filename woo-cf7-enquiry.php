<?php
/*
Plugin Name: WooCommerce Contact Form 7 Enquiry
Plugin URI: devnecks.com
Description: This plugin adds Contact Form 7 enquiry to WooCommerce products
Author: venqka
Author URI: devnecks.com
Version: 1.0
*/

function wcfe_load_text_domain() {

	load_plugin_textdomain( 'wcfe', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}
add_action( 'init', 'wcfe_load_text_domain' );
