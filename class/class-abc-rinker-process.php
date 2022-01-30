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
		$css            = '
.yyi-rinker-images {
	display: flex;
	justify-content: center;
	align-items: center;
	position: relative;

}
div.yyi-rinker-image img.yyi-rinker-main-img.hidden {
	display: none;
}

.yyi-rinker-images-arrow {
	cursor: pointer;
	position: absolute;
	top: 50%;
	display: block;
	margin-top: -11px;
	opacity: 0.6;
	width: 22px;
}

.yyi-rinker-images-arrow-left{
	left: -10px;
}
.yyi-rinker-images-arrow-right{
	right: -10px;
}

.yyi-rinker-images-arrow-left.hidden {
	display: none;
}

.yyi-rinker-images-arrow-right.hidden {
	display: none;
}
div.yyi-rinker-contents.yyi-rinker-design-tate  div.yyi-rinker-box{
	flex-direction: column;
}

div.yyi-rinker-contents.yyi-rinker-design-slim div.yyi-rinker-box .yyi-rinker-links {
	flex-direction: column;
}

div.yyi-rinker-contents.yyi-rinker-design-slim div.yyi-rinker-info {
	width: 100%;
}

div.yyi-rinker-contents.yyi-rinker-design-slim .yyi-rinker-title {
	text-align: center;
}

div.yyi-rinker-contents.yyi-rinker-design-slim .yyi-rinker-links {
	text-align: center;
}
div.yyi-rinker-contents.yyi-rinker-design-slim .yyi-rinker-image {
	margin: auto;
}

div.yyi-rinker-contents.yyi-rinker-design-slim div.yyi-rinker-info ul.yyi-rinker-links li {
	align-self: stretch;
}
div.yyi-rinker-contents.yyi-rinker-design-slim div.yyi-rinker-box div.yyi-rinker-info {
	padding: 0;
}
div.yyi-rinker-contents.yyi-rinker-design-slim div.yyi-rinker-box {
	flex-direction: column;
	padding: 14px 5px 0;
}

.yyi-rinker-design-slim div.yyi-rinker-box div.yyi-rinker-info {
	text-align: center;
}

.yyi-rinker-design-slim div.price-box span.price {
	display: block;
}

div.yyi-rinker-contents.yyi-rinker-design-slim div.yyi-rinker-info div.yyi-rinker-title a{
	font-size:16px;
}

div.yyi-rinker-contents.yyi-rinker-design-slim ul.yyi-rinker-links li.amazonkindlelink:before,  div.yyi-rinker-contents.yyi-rinker-design-slim ul.yyi-rinker-links li.amazonlink:before,  div.yyi-rinker-contents.yyi-rinker-design-slim ul.yyi-rinker-links li.rakutenlink:before,  div.yyi-rinker-contents.yyi-rinker-design-slim ul.yyi-rinker-links li.yahoolink:before {
	font-size:12px;
}

div.yyi-rinker-contents.yyi-rinker-design-slim ul.yyi-rinker-links li a {
	font-size: 13px;
}
.entry-content ul.yyi-rinker-links li {
	padding: 0;
}';
		$css_not_normal = '
.yyi-rinker-design-slim div.yyi-rinker-info ul.yyi-rinker-links li {
	width: 100%;
	margin-bottom: 10px;
}
	.yyi-rinker-design-slim ul.yyi-rinker-links a.yyi-rinker-link {
	padding: 10px 24px;
}
/** ver1.9.2 以降追加 **/
.yyi-rinker-contents .yyi-rinker-info {
	padding-left: 10px;
}
.yyi-rinker-img-s .yyi-rinker-image .yyi-rinker-images img{
	max-height: 75px;
}
.yyi-rinker-img-m .yyi-rinker-image .yyi-rinker-images img{
	max-height: 175px;
}
.yyi-rinker-img-l .yyi-rinker-image .yyi-rinker-images img{
	max-height: 200px;
}
div.yyi-rinker-contents div.yyi-rinker-image {
	flex-direction: column;
	align-items: center;
}
div.yyi-rinker-contents ul.yyi-rinker-thumbnails {
	display: flex;
	flex-direction: row;
	flex-wrap : wrap;
	list-style: none;
	border:none;
	padding: 0;
	margin: 5px 0;
}
div.yyi-rinker-contents ul.yyi-rinker-thumbnails li{
	cursor: pointer;
	height: 32px;
	text-align: center;
	vertical-align: middle;
	width: 32px;
	border:none;
	padding: 0;
	margin: 0;
	box-sizing: content-box;
}
div.yyi-rinker-contents ul.yyi-rinker-thumbnails li img {
	vertical-align: middle;
}

div.yyi-rinker-contents ul.yyi-rinker-thumbnails li {
	border: 1px solid #fff;
}
div.yyi-rinker-contents ul.yyi-rinker-thumbnails li.thumb-active {
	border: 1px solid #eee;
}

/* ここから　mini */
div.yyi-rinker-contents.yyi-rinker-design-mini {
	border: none;
	box-shadow: none;
	background-color: transparent;
}

/* ボタン非表示 */
.yyi-rinker-design-mini div.yyi-rinker-info ul.yyi-rinker-links,
.yyi-rinker-design-mini div.yyi-rinker-info .brand,
.yyi-rinker-design-mini div.yyi-rinker-info .price-box {
	display: none;
}

div.yyi-rinker-contents.yyi-rinker-design-mini .credit-box{
	text-align: right;
}

div.yyi-rinker-contents.yyi-rinker-design-mini div.yyi-rinker-info {
	width:100%;
}
.yyi-rinker-design-mini div.yyi-rinker-info div.yyi-rinker-title {
	line-height: 1.2;
	min-height: 2.4em;
	margin-bottom: 0;
}
.yyi-rinker-design-mini div.yyi-rinker-info div.yyi-rinker-title a {
	font-size: 12px;
	text-decoration: none;
	text-decoration: underline;
}
div.yyi-rinker-contents.yyi-rinker-design-mini {
	position: relative;
	max-width: 100%;
	border: none;
	border-radius: 12px;
	box-shadow: 0 1px 6px rgb(0 0 0 / 12%);
	background-color: #fff;
}

div.yyi-rinker-contents.yyi-rinker-design-mini div.yyi-rinker-box {
	border: none;
}

.yyi-rinker-design-mini div.yyi-rinker-image {
	width: 60px;
	min-width: 60px;

}
div.yyi-rinker-design-mini div.yyi-rinker-image img.yyi-rinker-main-img{
	max-height: 3.6em;
}
.yyi-rinker-design-mini div.yyi-rinker-detail div.credit-box {
	font-size: 10px;
}
.yyi-rinker-design-mini div.yyi-rinker-detail div.brand,
.yyi-rinker-design-mini div.yyi-rinker-detail div.price-box {
	font-size: 10px;
}
.yyi-rinker-design-mini div.yyi-rinker-info div.yyi-rinker-detail {
	padding: 0;
}
.yyi-rinker-design-mini div.yyi-rinker-detail div:not(:last-child) {
	padding-bottom: 0;
}
.yyi-rinker-design-mini div.yyi-rinker-box div.yyi-rinker-image a {
	margin-bottom: 16px;
}
@media (min-width: 768px){
	div.yyi-rinker-contents.yyi-rinker-design-mini div.yyi-rinker-box {
		padding: 12px;
	}
	.yyi-rinker-design-mini div.yyi-rinker-box div.yyi-rinker-info {
		justify-content: center;
		padding-left: 24px;
	}
}
@media (max-width: 767px){
	div.yyi-rinker-contents.yyi-rinker-design-mini {
		max-width:100%;
	}
	div.yyi-rinker-contents.yyi-rinker-design-mini div.yyi-rinker-box {
		flex-direction: row;
		padding: 12px;
	}
	.yyi-rinker-design-mini div.yyi-rinker-box div.yyi-rinker-info {
		justify-content: center;
		margin-bottom: 16px;
		padding-left: 16px;
		text-align: left;
	}
}';

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
