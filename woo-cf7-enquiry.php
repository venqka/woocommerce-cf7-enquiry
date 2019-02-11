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

include( 'wcfe-settings.php' );
include( 'wcfe-cf7-fields.php' );

function disable_wcfe_product_purchase( $purchasable, $product ) {

	$wcfe_global_state = get_option( 'wcfe_disabled' );
	$product_id = $product->get_id();
	$product_wcfe = get_post_meta( $product_id, 'wcfe_disabled', true );

	if( $wcfe_global_state == 'no' && $product_wcfe !== 'yes' ) { 

		$purchasable = false;
	
	} else {

		$purchasable = true;
	}	
	
	return $purchasable;

}
add_filter( 'woocommerce_is_purchasable', 'disable_wcfe_product_purchase', 10, 2 );

function wcfe_after_single_product_summary() {

	$wcfe_global_state = get_option( 'wcfe_disabled' );
	$product_wcfe = get_post_meta( get_the_ID(), 'wcfe_disabled', true );
	$cf_id = get_option( 'wcfe_cf7' );

	if( $wcfe_global_state == 'no' && $product_wcfe !== 'yes' ) { 

		echo do_shortcode( '[contact-form-7 id="' . $cf_id . '"]' );

	}
	
}
add_action( 'woocommerce_after_single_product_summary', 'wcfe_after_single_product_summary', 20 );