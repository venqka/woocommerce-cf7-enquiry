<?php

function wpcf7_product_url( $tag ) {

	$html = '<input type="hidden" name="product-url"  value="' . get_the_permalink() . '" />';
	return $html;

}
wpcf7_add_shortcode( 'product_url', 'wpcf7_product_url', true );

function wpcf7_product_title( $tag ) {

	$html = '<input type="hidden" name="product-title"  value="' . get_the_title() . '" />';
	return $html;

}
wpcf7_add_shortcode( 'product_title', 'wpcf7_product_title', true );





