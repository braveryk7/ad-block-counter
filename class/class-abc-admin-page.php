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

		wp_enqueue_style(
			'abc-style',
			WP_PLUGIN_URL . '/ad-block-counter/build/index.css',
			[ 'wp-components' ],
			$assets['version'],
		);

		wp_enqueue_script(
			'abc_script',
			WP_PLUGIN_URL . '/ad-block-counter/build/index.js',
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
			'ad-block-counter-settings',
			'abc_rinker',
			[
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => get_option( 'abc_rinker', false ),
			],
		);

		$array_item = [
			'type' => 'string',
		];

		register_setting(
			'ad-block-counter-settings',
			'abc_rinker_classes',
			[
				'show_in_rest' => [
					'schema' => [
						'type'       => 'object',
						'properties' => [
							'rinkerid'                    => $array_item,
							'yyi-rinker-contents'         => $array_item,
							'yyi-rinker-postid'           => $array_item,
							'yyi-rinker-thumbnails'       => $array_item,
							'yyi-rinker-design-thumb-img' => $array_item,
							'yyi-rinker-img-s'            => $array_item,
							'yyi-rinker-img-m'            => $array_item,
							'yyi-rinker-img-l'            => $array_item,
							'yyi-rinker-catid-1'          => $array_item,
							'yyi-rinker-box'              => $array_item,
							'yyi-rinker-image'            => $array_item,
							'yyi-rinker-main-img'         => $array_item,
							'yyi-rinker-info'             => $array_item,
							'yyi-rinker-title'            => $array_item,
							'yyi-rinker-detail'           => $array_item,
							'credit-box'                  => $array_item,
							'price-box'                   => $array_item,
							'yyi-rinker-links'            => $array_item,
							'freelink1'                   => $array_item,
							'yyi-rinker-link'             => $array_item,
							'amazonlink'                  => $array_item,
							'rakutenlink'                 => $array_item,
							'yahoolink'                   => $array_item,
							'yyi_rinker-gutenberg'        => $array_item,
							'rinkerg-richtext'            => $array_item,
							'yyi-rinker-design-tate'      => $array_item,
							'yyi-rinker-design-slim'      => $array_item,
							'yyi-rinker-design-mini'      => $array_item,
						],
					],
				],
			]
		);

		register_setting(
			'ad-block-counter-settings',
			'abc_add_css',
			[
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => get_option( 'abc_add_css' ),
			],
		);

		register_setting(
			'ad-block-counter-settings',
			'abc_logged_in_user',
			[
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => get_option( 'abc_logged_in_user' ),
			],
		);

		register_setting(
			'ad-block-counter-settings',
			'abc_rinker_status',
			[
				'type'         => 'number',
				'show_in_rest' => true,
				'default'      => get_option( 'abc_rinker_status' ),
			],
		);
	}

	/**
	 * Settings page.
	 */
	public function abc_settings_page() {
		echo '<div id="ad-block-counter-settings"></div>';
	}
}
