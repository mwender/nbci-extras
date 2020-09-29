<?php
/**
 * Plugin Name:     NBCI Extras
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Site modifications for the NBCI Elementor-powered website.
 * Author:          Michael Wender
 * Author URI:      https://mwender.com
 * Text Domain:     nbci-extras
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Nbci_Extras
 */

// Define some helpful constants
define( 'NBCI_DIR', plugin_dir_path( __FILE__ ) );
define( 'NBCI_URL', plugin_dir_url( __FILE__ ) );

require_once( 'lib/fns/site-container.php' );

/**
 * Enhanced logging.
 *
 * @param      string  $message  The log message
 */
function uber_log( $message = null ){
  static $counter = 1;

  $bt = debug_backtrace();
  $caller = array_shift( $bt );

  if( 1 == $counter )
    error_log( "\n\n" . str_repeat('-', 25 ) . ' STARTING DEBUG [' . date('h:i:sa', current_time('timestamp') ) . '] ' . str_repeat('-', 25 ) . "\n\n" );
  error_log( "\n" . $counter . '. ' . basename( $caller['file'] ) . '::' . $caller['line'] . "\n" . $message . "\n---\n" );
  $counter++;
}