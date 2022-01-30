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
}
