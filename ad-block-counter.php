<?php
/**
 * Plugin Name:       Ad Block Counter
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8.2
 * Requires PHP:      7.3
 * Version:           0.1.0
 * Author:            Ken-chan
 * Author URI:        https://twitter.com/braveryk7
 * Plugin URI:        https://www.braveryk7.com/
 * Text Domain:       ad-block-counter
 * Domain Path:       /languages
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @author            Ken-chan
 * @package           WordPress
 * @subpackage        Ad Block Counter
 * @since             0.1.0
 */

declare(strict_types = 1);

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'You do not have access rights.' );
}

require_once dirname( __FILE__ ) . '/class/class-abc-admin-page.php';

/**
 * Start admin page.
 */
new Abc_Admin_Page( __FILE__ );
