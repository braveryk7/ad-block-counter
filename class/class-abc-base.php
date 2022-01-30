<?php
/**
 * Ad Block Counter base class.
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
 * Ad Block Counter base class.
 */
class Abc_Base {
	protected const PREFIX      = 'abc';
	protected const PLUGIN_SLUG = 'ad-block-counter';

	protected const RINKER_CLASSES = [
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
		'yyi-rinker-images',
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

	/**
	 * Add prefix.
	 *
	 * @param string $value After prefix value.
	 */
	protected function add_prefix( $value ) {
		return self::PREFIX . '_' . $value;
	}

	/**
	 * Return plugin url.
	 * e.g. https://expamle.com/wp-content/plugins/ad-block-counter
	 *
	 * @param string $plugin_name self::PLUGIN_SLUG.
	 */
	protected function create_plugin_url( string $plugin_name ): string {
		return WP_PLUGIN_URL . '/' . $plugin_name;
	}

	/**
	 * Return plugin directory.
	 * e.g.
	 *
	 * @param string $plugin_name Plugin name.
	 */
	protected function create_plugin_dir( string $plugin_name ): string {
		return WP_PLUGIN_DIR . '/' . $plugin_name;
	}

	/**
	 * Return option group.
	 * Use register_setting.
	 * e.g. ad-block-counter-settings
	 */
	protected function create_option_group(): string {
		return self::PLUGIN_SLUG . '-settings';
	}

	/**
	 * Return register_settings Rinker properties.
	 */
	protected function create_rinker_properties() {
		$rinker_properties = [];
		foreach ( self::RINKER_CLASSES as $value ) {
			$rinker_properties[ $value ] = [
				'type' => 'string',
			];
		}
		return $rinker_properties;
	}

	/**
	 * Output browser console.
	 * WARNING: Use debag only!
	 *
	 * @param string|int|float|boolean|array|object $value Output data.
	 */
	protected function console( $value ): void {
		echo '<script>console.log(' . wp_json_encode( $value ) . ');</script>';
	}
}
