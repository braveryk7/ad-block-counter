<?php
/**
 * Admin settings page.
 *
 * @author     Ken-chan
 * @package    WordPress
 * @subpackage Ad Block Counter
 * @since      0.1.0
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'You do not have access rights.' );
}

/**
 * Admin settings page.
 */
class Abc_Settings_Page {
	/**
	 * WordPress Hook.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
	}

	/**
	 * Add Ad Block Counter to admin bar.
	 */
	public function add_menu() {
		add_options_page(
			__( 'Ad Block Counter', 'ad-block-counter' ),
			__( 'Ad Block Counter', 'ad-block-counter' ),
			'administrator',
			'ad-block-counter',
			[ $this, 'abc_settings_page' ]
		);
	}

	/**
	 * Settings page.
	 */
	public function abc_settings_page() {
		echo '<div id="ad-block-counter-settings"></div>';
	}
}
