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
		register_activation_hook( $path, [ $this, 'register_options' ] );
		register_activation_hook( $path, [ $this, 'create_options' ] );
	}

	/**
	 * Register wp_options column.
	 */
	public function register_options() {
		$add_css_init_message = '// Rinkerに追加したいCSSを入力してください\n// 入力されたid/class名は自動で変換されます';

		$this->option_exists( 'abc_rinker', false );
		$this->option_exists( 'abc_rinker_classes', $this->create_options() );
		$this->option_exists( 'abc_rinker_css_version', time() );
		$this->option_exists( 'abc_add_css', $add_css_init_message );
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
		$rinker_classes     = [
			'rinkerid',
			'yyi-rinker-contents',
			'yyi-rinker-postid',
			'yyi-rinker-thumbnails',
			'yyi-rinker-design-thumb-img',
			'yyi-rinker-img-s',
			'yyi-rinker-img-m',
			'yyi-rinker-img-l',
			'yyi-rinker-catid-1',
			'yyi-rinker-box',
			'yyi-rinker-image',
			'yyi-rinker-main-img',
			'yyi-rinker-info',
			'yyi-rinker-title',
			'yyi-rinker-detail',
			'credit-box',
			'price-box',
			'yyi-rinker-links',
			'freelink1',
			'yyi-rinker-link',
			'amazonlink',
			'rakutenlink',
			'yahoolink',
			'yyi_rinker-gutenberg',
			'rinkerg-richtext',
			'yyi-rinker-design-tate',
			'yyi-rinker-design-slim',
			'yyi-rinker-design-mini',
		];
		$abc_rinker_classes = [];

		foreach ( $rinker_classes as $rinker_class ) {
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
