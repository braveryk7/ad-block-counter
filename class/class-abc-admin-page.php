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
class Abc_Admin_Page extends Abc_Base {
	/**
	 * WordPress Hook.
	 *
	 * @param string $path ad-block-counter.php path.
	 */
	public function __construct( string $path ) {
		$this->path = $path;
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'add_scripts' ] );
		add_action( 'rest_api_init', [ $this, 'register' ] );
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
			self::PLUGIN_NAME,
			[ $this, $this->add_prefix( 'settings_page' ) ]
		);
	}

	/**
	 * Add configuration link to plugin page.
	 *
	 * @param array|string $links plugin page setting links.
	 */
	public function add_settings_links( array $links ): array {
		$add_link = '<a href="options-general.php?page=' . self::PLUGIN_NAME . '">' . __( 'Settings', 'ad-block-counter' ) . '</a>';
		array_unshift( $links, $add_link );
		return $links;
	}

	/**
	 * Enqueue scripts.
	 *
	 * @param string $hook_shuffix WordPress hook_shuffix.
	 */
	public function add_scripts( string $hook_shuffix ) {
		if ( 'settings_page_' . self::PLUGIN_NAME !== $hook_shuffix ) {
			return;
		}

		$assets = require_once dirname( $this->path ) . '/build/index.asset.php';

		wp_enqueue_style(
			$this->add_prefix( 'style' ),
			$this->create_plugin_url( self::PLUGIN_NAME ) . '/build/index.css',
			[ 'wp-components' ],
			$assets['version'],
		);

		wp_enqueue_script(
			$this->add_prefix( 'script' ),
			$this->create_plugin_url( self::PLUGIN_NAME ) . '/build/index.js',
			$assets['dependencies'],
			$assets['version'],
			true
		);
	}

	/**
	 * Set register.
	 */
	public function register() {
		register_setting(
			$this->create_option_group(),
			$this->add_prefix( 'rinker' ),
			[
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => get_option( $this->add_prefix( 'rinker' ), false ),
			],
		);

		register_setting(
			$this->create_option_group(),
			$this->add_prefix( 'rinker_classes' ),
			[
				'show_in_rest' => [
					'schema' => [
						'type'       => 'object',
						'properties' => $this->create_rinker_properties(),
					],
				],
			]
		);

		register_setting(
			$this->create_option_group(),
			$this->add_prefix( 'add_css' ),
			[
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => get_option( $this->add_prefix( 'add_css' ) ),
			],
		);

		register_setting(
			$this->create_option_group(),
			$this->add_prefix( 'logged_in_user' ),
			[
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => get_option( $this->add_prefix( 'logged_in_user' ) ),
			],
		);

		register_setting(
			$this->create_option_group(),
			$this->add_prefix( 'rinker_status' ),
			[
				'type'         => 'number',
				'show_in_rest' => true,
				'default'      => get_option( $this->add_prefix( 'rinker_status' ) ),
			],
		);
	}

	/**
	 * Settings page.
	 */
	public function abc_settings_page() {
		echo '<div id="' . esc_attr( $this->create_option_group() ) . '"></div>';
	}
}
