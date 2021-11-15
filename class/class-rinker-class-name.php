<?php
/**
 * Rewrite the ClassName of Rinker.
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
 * Rewrite the ClassName of Rinker class.
 */
class Rinker_Class_Name {

	/**
	 * WordPress Hooks.
	 */
	public function __construct() {
		add_filter( 'the_content', [ $this, 'check_rinker_element' ] );
	}

	/**
	 * Check if there is a Rinker element.
	 * If there is a rinker element, rewrite it with a random class name.
	 *
	 * @param string $the_content WordPress contents.
	 *
	 * @return string
	 */
	public function check_rinker_element( string $the_content ): string {
		if ( strpos( $the_content, 'yyi-rinker-contents' ) !== false ) {

			$rinker_class_name = [
				'yyi-rinker-contents',
				'yyi-rinker-img-m',
				'yyi-rinker-box',
				'yyi-rinker-image',
				'yyi-rinker-main-img',
				'yyi-rinker-info',
				'yyi-rinker-title',
				'yyi-rinker-detail',
				'yyi-rinker-link',
			];

			$replace_class_name = [
				'ken-rinker-contents',
				'ken-rinker-img-m',
				'ken-rinker-box',
				'ken-rinker-image',
				'ken-rinker-main-img',
				'ken-rinker-info',
				'ken-rinker-title',
				'ken-rinker-detail',
				'ken-rinker-link',
			];

			$replace = str_replace( $rinker_class_name, $replace_class_name, $the_content );
			return $replace;
		} else {
			return $the_content;
		}
	}
}
