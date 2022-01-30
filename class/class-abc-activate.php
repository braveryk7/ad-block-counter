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
		$add_css_init_message = "// Rinkerに追加したいCSSを入力してください\n// 入力されたid/class名は自動で変換されます\n";

		$this->option_exists( $this->add_prefix( 'rinker' ), false );
		$this->option_exists( $this->add_prefix( 'rinker_classes' ), $this->create_options() );
		$this->option_exists( $this->add_prefix( 'rinker_css_version' ), time() );
		$this->option_exists( $this->add_prefix( 'add_css' ), $add_css_init_message );
		$this->option_exists( $this->add_prefix( 'logged_in_user' ), false );
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
