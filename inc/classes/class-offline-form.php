<?php
/**
 * Offline form submission class.
 *
 * @package rt-pwa-extensions
 */

namespace RT\PWA\Inc;

use \RT\PWA\Inc\Traits\Singleton;

/**
 * Class Offline_Form
 */
class Offline_Form {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * Setup actions/filters
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		add_action( 'wp_front_service_worker', array( $this, 'offline_form_service_worker' ), 11 );

	}

	/**
	 * Register service worker script for offline form submit.
	 *
	 * @param $scripts
	 */
	public function offline_form_service_worker( $scripts ) {

		$scripts->register(
			'offline-form-submit', // Handle.
			array(
				'src'  => array( $this, 'get_offline_form_script' ),
				'deps' => array(), // Dependency.
			)
		);

	}

	/**
	 * Get offline-form script.
	 *
	 * @return string
	 */
	public function get_offline_form_script() {
		$sw_script = file_get_contents( RT_PWA_EXTENSIONS_PATH . '/js/offline-form.js' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$sw_script = preg_replace( '#/\*\s*global.+?\*/#', '', $sw_script );

		$form_urls_regex = $this->get_form_urls();
		// Replace with offline|error template URLs.
		$sw_script = str_replace(
			array(
				'ERROR_OFFLINE_URL',
				'ERROR_500_URL',
				'FORM_URLS',
			),
			array(
				wp_service_worker_json_encode( add_query_arg( 'wp_error_template', 'offline', home_url( '/' ) ) ),
				wp_service_worker_json_encode( add_query_arg( 'wp_error_template', '500', home_url( '/' ) ) ),
				$form_urls_regex,
			),
			$sw_script
		);

		return $sw_script;
	}

	/**
	 * Get all form url regex string.
	 *
	 * @return string
	 */
	private function get_form_urls() {
		$string    = '';
		$form_urls = get_option( 'pwa_extension_form_urls' );
		if ( empty( $form_urls ) ) {
			// Generate random string if no URLs specified.
			// Random string ensures that no URL match.
			$string = wp_generate_password( '30', false, false );
		} else {
			$urls = explode( ',', $form_urls );

			// Create regex string like ( `contact|form|test` ).
			foreach ( $urls as $url ) {
				$url     = str_replace( '/', '\/', $url );
				$string .= trim( $url ) . '|';
			}
			// Remove `|` from end.
			$string = rtrim( $string, '|' );
		}

		return $string;
	}

}
