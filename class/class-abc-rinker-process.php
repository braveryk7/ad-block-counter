<?php
/**
 * Change Rinker class name.
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
 * Rinker class name process.
 */
class Abc_Rinker_Process {
	/**
	 * Constructer.
	 */
	public function __construct() {
		if ( get_option( 'abc_rinker' ) ) {
			add_action( 'the_content', [ $this, 'change_rinker_class_name' ] );
			add_action( 'wp_print_styles', [ $this, 'dequeue_rinker_style' ], 100 );
			add_action( 'wp_loaded', [ $this, 'remove_rinker_inline_css' ] );
		}
	}

	/**
	 * Change class name.
	 *
	 * @param string $the_content WordPress post content.
	 */
	public function change_rinker_class_name( $the_content ) {
		$rinker_classes = get_option( 'abc_rinker_classes' );
		if ( strpos( $the_content, 'yyi-rinker-contents' ) ) {
			foreach ( $rinker_classes as $key => $value ) {
				$the_content = str_replace( $key, $value, $the_content );
			}
		}
		$this->rinker_css( $rinker_classes );
		return $the_content;
	}

	/**
	 * Read defaul Rinker CSS.
	 * Output random selector CSS.
	 *
	 * @param array $replace_class_name Rinker class name.
	 */
	private function rinker_css( $replace_class_name ) {
		if ( function_exists( 'yyi_rinker_style_up_design' ) ) {
			$rinker_css_file = file_get_contents( WP_PLUGIN_DIR . '/yyi-rinker/css/style.css' );
			$rinker_css      = $rinker_css_file;
			foreach ( $replace_class_name as $key => $value ) {
				$rinker_css = str_replace( $key, $value, $rinker_css );
			}
			wp_register_style( 'abc_rinker_style', false, [], get_option( 'abc_rinker_css_version' ) );
			wp_enqueue_style( 'abc_rinker_style' );
			wp_add_inline_style( 'abc_rinker_style', $rinker_css );
		}
	}

	/**
	 * Dequeue WordPress output Rinker style.
	 */
	public function dequeue_rinker_style() {
		wp_dequeue_style( 'yyi_rinker_stylesheet' );
	}

	/**
	 * Remove Rinker inline css.
	 */
	public function remove_rinker_inline_css() {
		if ( class_exists( 'Yyi_Rinker_Plugin' ) ) {
			remove_action( 'wp_head', array( Yyi_Rinker_Plugin::get_object(), 'base_desing_set' ) );
		}
	}
}
