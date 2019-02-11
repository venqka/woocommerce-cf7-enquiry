<?php

function wcfe_add_settings_tab( $settings_tabs ) {

	$settings_tabs['wcfe'] = __( 'Enquiry', 'wcfe' );
	return $settings_tabs;

}        
add_filter( 'woocommerce_settings_tabs_array', 'wcfe_add_settings_tab', 50 );

function wcfe_settings_tab() {
?>
	<div>
<?php
		woocommerce_admin_fields( wcfe_settings() );
?>
	</div>
	<div>
		<p><?php _e( 'Use the following fields in your contact form:', 'wcfe' ); ?></p>
		<ul>
			<li>[product_url] - <?php _e( 'Outputs the url of the product', 'wcfe' ); ?></li>
			<li>[product_title] - <?php _e( 'Outputs the title of the product', 'wcfe' ); ?></li>
		</ul>
	</div>
<?php
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

//Product settings

function wcfe_add_product_settings() {

?>
	<div class="options_group">
<?php
		$disable_wcfe_args = array(
			'id'      		=> 'wcfe_disabled',
			'value'   		=> get_post_meta( get_the_ID(), 'wcfe_disabled', true ),
			'label'   		=> __( 'Disable contact form 7 enquiry', 'wcfe' ),
			'desc_tip' 		=> true,
			'description' 	=> __( 'Check this to disable contact form 7 enquiry for this product', 'wcfe' ),
		);
		woocommerce_wp_checkbox( $disable_wcfe_args );

?>
	</div>
<?php
}
add_action( 'woocommerce_product_options_general_product_data', 'wcfe_add_product_settings' );

function wcfe_save_product_meta( $id, $post ){
	
	update_post_meta( $id, 'wcfe_disabled', $_POST['wcfe_disabled'] );
	
}
add_action( 'woocommerce_process_product_meta', 'wcfe_save_product_meta', 10, 2 );

