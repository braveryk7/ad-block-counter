<?php
/**
 * Plugin Name:       Ad Block Counter
 * Description:       Ad Block Counter is a WordPress plugin for blocking ads.
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

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'You do not have access rights.' );
}

require_once dirname( __FILE__ ) . '/class/class-abc-base.php';
require_once dirname( __FILE__ ) . '/class/class-abc-admin-page.php';
require_once dirname( __FILE__ ) . '/class/class-abc-rinker-process.php';
require_once dirname( __FILE__ ) . '/class/class-abc-activate.php';

/**
 * Start admin page.
 */
new Abc_Admin_Page( __FILE__ );

/**
 * Change Rinker class name.
 */
new Abc_Rinker_Process();

/**
 * Plugin activate.
 */
new Abc_Activate( __FILE__ );

/**
 * Plugin uninstall hook.
 * Delete wp_options column.
 */
register_uninstall_hook( __FILE__, 'Abc_Activate::uninstall_options' );
