<?php
/**
 * Ad Block Counter base class.
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
 * Ad Block Counter base class.
 */
class Abc_Base {
	protected const PREFIX      = 'abc';
	protected const PLUGIN_NAME = 'ad-block-counter';

	/**
	 * Add prefix.
	 *
	 * @param string $value After prefix value.
	 */
	protected function add_prefix( $value ) {
		return self::PREFIX . '_' . $value;
	}

	/**
	 * Return plugin url.
	 * e.g. https://expamle.com/wp-content/plugins/ad-block-counter
	 *
	 * @param string $plugin_name self::PLUGIN_NAME.
	 */
	protected function create_plugin_url( string $plugin_name ): string {
		return WP_PLUGIN_URL . '/' . $plugin_name;
	}
}
