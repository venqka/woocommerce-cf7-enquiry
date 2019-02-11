<?php

function wcfe_add_settings_tab( $settings_tabs ) {

	$settings_tabs['wcfe'] = __( 'Enquiry', 'wcfe' );
	return $settings_tabs;

}        
add_filter( 'woocommerce_settings_tabs_array', 'wcfe_add_settings_tab', 50 );

function wcfe_settings_tab() {

	woocommerce_admin_fields( wcfe_settings() );

}
add_action( 'woocommerce_settings_tabs_wcfe', 'wcfe_settings_tab' );

function wcfe_settings() {

	$settings = array(
		'wcfe_disabled' => array(
			'name'     => __( 'Disabled', 'wcfe' ),
			'type'     => 'checkbox',
			'desc'     => 'If checked, the enquiry must be set manualy for each product',
			'id'       => 'wcfe_disabled'
		),
		'wcfe_cf7' => array(
			'name'     => __( 'Contact form 7 ID', 'wcfe' ),
			'type'     => 'number',
			'desc'     => 'Enter contact form 7 ID',
			'id'       => 'wcfe_cf7'
		),
    );
    return apply_filters( 'wc_settings_wcfe', $settings );
}

function wcfe_update_settings() {

	woocommerce_update_options( wcfe_settings() );

}
add_action( 'woocommerce_update_options_wcfe', 'wcfe_update_settings' );
