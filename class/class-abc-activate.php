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
class Abc_Activate {
	/**
	 * WordPress hook.
	 *
	 * @param string $path Plugin base file path.
	 */
	public function __construct( $path ) {
		register_activation_hook( $path, [ $this, 'create_options' ] );
	}

	/**
	 * Create wp_options column.
	 */
	public function create_options() {
		$abc_rinker_classes = get_option( 'abc_rinker_classes' );
		if ( empty( $abc_rinker_classes ) ) {
			$abc_rinker_classes_value = [
				'yyi-rinker-contents'    => $this->random_class_name(),
				'yyi-rinker-postid-2248' => $this->random_class_name(),
				'yyi-rinker-img-m'       => $this->random_class_name(),
				'yyi-rinker-catid-1'     => $this->random_class_name(),
				'yyi-rinker-box'         => $this->random_class_name(),
				'yyi-rinker-image'       => $this->random_class_name(),
				'yyi-rinker-main-img'    => $this->random_class_name(),
				'yyi-rinker-info'        => $this->random_class_name(),
				'yyi-rinker-title'       => $this->random_class_name(),
				'yyi-rinker-detail'      => $this->random_class_name(),
				'credit-box'             => $this->random_class_name(),
				'price-box'              => $this->random_class_name(),
				'yyi-rinker-links'       => $this->random_class_name(),
				'freelink1'              => $this->random_class_name(),
				'yyi-rinker-link'        => $this->random_class_name(),
				'amazonlink'             => $this->random_class_name(),
				'rakutenlink'            => $this->random_class_name(),
				'yahoolink'              => $this->random_class_name(),
			];
			add_option( 'abc_rinker_classes', $abc_rinker_classes_value );
		}
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
