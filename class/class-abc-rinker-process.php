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
		add_action( 'init', [ $this, 'check_user_logged_in' ] );
		$this->check_rinker_installed_active();
	}

	/**
	 * Check Rinker installed, active status.
	 */
	private function check_rinker_installed_active() {
		$rinker_file_path = 'yyi-rinker/yyi-rinker.php';
		$active_plugins   = get_option( 'active_plugins' );

		file_exists( WP_PLUGIN_DIR . '/' . $rinker_file_path ) ? $rinker_installed = 1 : $rinker_installed = 0;
		array_search( $rinker_file_path, $active_plugins, true ) ? $rinker_active  = 1 : $rinker_active = 0;

		switch ( $rinker_installed + $rinker_active ) {
			case 1:
				update_option( 'abc_rinker_status', 1 );
				break;
			case 2:
				update_option( 'abc_rinker_status', 2 );
				break;
			default:
				update_option( 'abc_rinker_status', 0 );
		}
	}

	/**
	 * Check user logged in use WordPress action hook.
	 */
	public function check_user_logged_in() {
		if ( get_option( 'abc_rinker' ) ) {
			if ( ! is_user_logged_in() || ( is_user_logged_in() && ! get_option( 'abc_logged_in_user' ) ) ) {
				add_action( 'the_content', [ $this, 'change_rinker_class_name' ] );
				add_action( 'wp_print_styles', [ $this, 'dequeue_rinker_style' ], 100 );
				add_action( 'wp_loaded', [ $this, 'remove_rinker_inline_css' ] );
			} elseif ( is_user_logged_in() && get_option( 'abc_logged_in_user' ) ) {
				$this->rinker_css();
			}
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
	private function rinker_css( array $replace_class_name = null ) {
		$rinker_css_file = file_get_contents( WP_PLUGIN_DIR . '/yyi-rinker/css/style.css' );
		$rinker_css      = get_option( 'abc_add_css' ) . $rinker_css_file;
		if ( function_exists( 'yyi_rinker_style_up_design' ) && ! is_null( $replace_class_name ) ) {
			foreach ( $replace_class_name as $key => $value ) {
				$rinker_css = str_replace( $key, $value, $rinker_css );
			}
		}
		wp_register_style( 'abc_rinker_style', false, [], get_option( 'abc_rinker_css_version' ) );
		wp_enqueue_style( 'abc_rinker_style' );
		wp_add_inline_style( 'abc_rinker_style', $rinker_css );
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
