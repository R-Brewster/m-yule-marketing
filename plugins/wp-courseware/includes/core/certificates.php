<?php
/**
 * WP Courseware Certificates.
 *
 * @package WPCW
 * @subpackage Core
 * @since 4.6.3
 */

namespace WPCW\Core;

// Exit if accessed directly
defined( 'ABSPATH' ) || die;

/**
 * Class Certificates.
 *
 * @since 4.63
 */
class Certificates {

	/**
	 * Load Certificates.
	 *
	 * @since 4.3.0
	 */
	public function load() {
		add_filter( 'wpcw_api_endoints', array( $this, 'register_api_endpoints' ), 10, 2 );
	}

	/**
	 * Get Certificate Settings Fields.
	 *
	 * @since 4.3.0
	 *
	 * @return array The certificates settings fields.
	 */
	public function get_settings_fields() {
		return apply_filters( 'wpcw_certificate_settings_feilds', array(
			array(
				'type'    => 'hidden',
				'key'     => 'cert_signature_type',
				'default' => 'text',
			),
			array(
				'type'    => 'hidden',
				'key'     => 'cert_sig_text',
				'default' => esc_attr( get_bloginfo( 'name' ) ),
			),
			array(
				'type'    => 'hidden',
				'key'     => 'cert_sig_image_url',
				'default' => '',
			),
			array(
				'type'    => 'hidden',
				'key'     => 'cert_logo_enabled',
				'default' => 'no_cert_logo',
			),
			array(
				'type'    => 'hidden',
				'key'     => 'cert_logo_url',
				'default' => '',
			),
			array(
				'type'    => 'hidden',
				'key'     => 'cert_background_type',
				'default' => 'use_default',
			),
			array(
				'type'    => 'hidden',
				'key'     => 'cert_background_custom_url',
				'default' => '',
			),
			array(
				'type'    => 'hidden',
				'key'     => 'certificate_encoding',
				'default' => 'ISO-8859-1',
			),
		) );
	}

	/**
	 * Register Settings Api Endpoints.
	 *
	 * @since 4.6.4
	 *
	 * @param array $endpoints The endpoints to filter.
	 * @param Api The api endpoints.
	 *
	 * @return array $endpoints The modified array of endpoints.
	 */
	public function register_api_endpoints( $endpoints, Api $api ) {
		$endpoints[] = array( 'endpoint' => 'certificate-image-url', 'method' => 'POST', 'callback' => array( $this, 'api_get_certificate_image_url' ) );

		return $endpoints;
	}

	/**
	 * Api Get Certificate Image Url.
	 *
	 * @since 4.6.4
	 *
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function api_get_certificate_image_url( \WP_REST_Request $request ) {
		$attachment_id = $request->get_param( 'id' );

		$original_image_url = function_exists( 'wp_get_original_image_url' )
			? wp_get_original_image_url( $attachment_id )
			: wp_get_attachment_url( $attachment_id );

		return rest_ensure_response( array( 'url' => $original_image_url ) );
	}
}
