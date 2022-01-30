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
			}
			add_action( 'wp_print_styles', [ $this, 'dequeue_rinker_style' ], 100 );
			add_action( 'wp_loaded', [ $this, 'remove_rinker_inline_css' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'rinker_css' ] );
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
		return $the_content;
	}

	/**
	 * Read defaul Rinker CSS.
	 * Output random selector CSS.
	 */
	public function rinker_css() {
		$rinker_css_file_path = WP_PLUGIN_DIR . '/yyi-rinker/css/style.css';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		if ( WP_Filesystem() ) {
			global $wp_filesystem;
			$rinker_css_file = file_exists( $rinker_css_file_path ) ? $wp_filesystem->get_contents( $rinker_css_file_path ) : '';
		}

		$rinker_css     = get_option( 'abc_add_css' );
		$css            = '';
		$css_not_normal = '';

		// Current theme is THE SONIC or THE SONIC Child.
		if ( 'thesonic' === get_stylesheet() || 'the-sonic-child' === get_stylesheet() ) {
			$the_sonic_base_design = tsnc_rinker_base_design();
		}

		switch ( get_option( 'yyi_rinker_design_type' ) ) {
			// Normal.
			case 0:
				$rinker_css .= $css . $rinker_css_file;
				break;
			// Style up.
			case 10:
				$rinker_css .= $css . $css_not_normal;
				$rinker_css .= function_exists( 'yyi_rinker_style_up_design' ) ? yyi_rinker_style_up_design() : '';
				break;
			// Flat（THE SONIC）.
			case 100:
				$rinker_css .= $css . $css_not_normal;
				$rinker_css .= function_exists( 'tsnc_rinker_design_flat' ) ? tsnc_rinker_design_flat() : '';
				break;
			// Material（THE SONIC）.
			case 110:
				$rinker_css .= $css . $css_not_normal;
				$rinker_css .= function_exists( 'tsnc_rinker_design_material' ) ? tsnc_rinker_design_material() : '';
				break;
			// Round（THE SONIC）.
			case 120:
				$rinker_css .= $css . $css_not_normal;
				$rinker_css .= function_exists( 'tsnc_rinker_design_round' ) ? tsnc_rinker_design_round() : '';
				break;
			// One color（THE SONIC）.
			case 130:
				$rinker_css .= $css . $css_not_normal;
				$rinker_css .= function_exists( 'tsnc_rinker_onecolor' ) ? tsnc_rinker_onecolor() : '';
				break;
			// Non design.
			default:
				$rinker_css;
		}

		if ( ! get_option( 'abc_logged_in_user' ) ) {
			foreach ( get_option( 'abc_rinker_classes' ) as $key => $value ) {
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
			remove_action( 'wp_enqueue_scripts', array( Yyi_Rinker_Plugin::get_object(), 'delete_styles' ), 11 );
		}
	}
}
