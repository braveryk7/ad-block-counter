<?php
/**
 * Plugin activate.
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
 * Activate process.
 */
class Abc_Activate extends Abc_Base {
	/**
	 * WordPress hook.
	 *
	 * @param string $path Plugin base file path.
	 */
	public function __construct( $path ) {
		register_activation_hook( $path, [ $this, 'register_options' ] );
		register_activation_hook( $path, [ $this, 'create_options' ] );
	}

	/**
	 * Register wp_options column.
	 */
	public function register_options() {
		foreach ( self::OPTIONS_COLUMN as $option_name ) {
			switch ( $option_name ) {
				case 'rinker_classes':
					$option_value = $this->create_options();
					break;
				case 'rinker_css_version':
					$option_value = time();
					break;
				case 'add_css':
					$option_value =
						"/*\n  * " .
						__( 'Enter the CSS you want to add to Rinker', 'ad-block-counter' ) . "\n  * " .
						__( 'Entered id/class names will be automatically converted', 'ad-block-counter' ) . "\n  */\n";
					break;
				default:
					$option_value = false;
			}
			$this->option_exists( $this->add_prefix( $option_name ), $option_value );
		}
	}

	/**
	 * Uninstall wp_options column.
	 */
	public static function uninstall_options() {
		foreach ( self::OPTIONS_COLUMN as $option_name ) {
			delete_option( self::add_prefix( $option_name ) );
		}
	}

	/**
	 * Search & create wp_option column.
	 *
	 * @param string                $column wp_option column name.
	 * @param string|int|bool|array $value wp_option value.
	 */
	public function option_exists( string $column, $value ) {
		if ( empty( get_option( $column ) ) ) {
			add_option( $column, $value );
		}
	}

	/**
	 * Create wp_options column.
	 */
	public function create_options() {
		$abc_rinker_classes = [];

		foreach ( self::RINKER_CLASSES as $rinker_class ) {
			$abc_rinker_classes[ $rinker_class ] = $this->random_class_name();
		}

		return $abc_rinker_classes;
	}

	/**
	 * Create random strings.
	 *
	 * @param int $length Length.
	 */
	public function random_class_name( $length = 12 ) {
		$random_class_name = substr( bin2hex( random_bytes( $length ) ), 0, $length );
		if ( is_numeric( $random_class_name[0] ) ) {
			$str               = [ 'a', 'b', 'c', 'd', 'e', 'f' ];
			$rand              = wp_rand( 0, 5 );
			$random_class_name = str_replace( $random_class_name[0], $str[ $rand ], $random_class_name );
		}
		return $random_class_name;
	}
}
