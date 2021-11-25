<?php
/**
 * Admin settings page.
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
 * Admin settings page.
 */
class Abc_Admin_Page {
	/**
	 * WordPress Hook.
	 *
	 * @param string $path ad-block-counter.php path.
	 */
	public function __construct( string $path ) {
		$this->path = $path;
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'add_scripts' ] );
		add_filter( 'plugin_action_links_' . plugin_basename( $path ), [ $this, 'add_settings_links' ] );
	}

	/**
	 * Add Ad Block Counter to admin bar.
	 */
	public function add_menu() {
		add_options_page(
			__( 'Ad Block Counter', 'ad-block-counter' ),
			__( 'Ad Block Counter', 'ad-block-counter' ),
			'administrator',
			'ad-block-counter',
			[ $this, 'abc_settings_page' ]
		);
	}

	/**
	 * Add configuration link to plugin page.
	 *
	 * @param array|string $links plugin page setting links.
	 */
	public function add_settings_links( array $links ): array {
		$add_link = '<a href="options-general.php?page=ad-block-counter">' . __( 'Settings', 'ad-block-counter' ) . '</a>';
		array_unshift( $links, $add_link );
		return $links;
	}

	/**
	 * Enqueue scripts.
	 *
	 * @param string $hook_shuffix WordPress hook_shuffix.
	 */
	public function add_scripts( string $hook_shuffix ) {
		if ( 'settings_page_ad-block-counter' !== $hook_shuffix ) {
			return;
		}

		$assets = require_once dirname( $this->path ) . '/build/index.asset.php';

		wp_enqueue_script(
			'abc_script',
			WP_PLUGIN_URL . '/ad-block-counter/build/index.js',
			$assets['dependencies'],
			$assets['version'],
			true
		);
	}

	/**
	 * Settings page.
	 */
	public function abc_settings_page() {
		echo '<div id="ad-block-counter-settings"></div>';
	}
}
