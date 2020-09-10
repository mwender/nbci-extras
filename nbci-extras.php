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
