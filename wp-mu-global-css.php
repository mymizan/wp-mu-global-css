<?php
/**
 * Plugin Name: WP MU Global CSS
 * Plugin URI: https://developerhero.net
 * Description: A simple plugin that will apply a CSS stylesheet globally across all sites of a WordPress multi-site installation.
 * Author: M Yakub Mizan
 * Version: 1.0.0
 * Author URI: https://yakub.xyz
 * network: true
 **/


define( 'WP_MU_GLOBAL_CSS_NAME', 'WP MU Global CSS' );
define( 'WP_MU_GLOBAL_CSS_VERSION', '1.0.0' );

class WP_MU_GLOBAL_CSS_PLUGIN {

	/**
	 * All our action hooks and filters here
	 * so that they are regiestered when the
	 * plugin is initiated.
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'print_inline_css' ), PHP_INT_MAX, 0 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_external_css' ), PHP_INT_MAX, 0 );
	}

	/**
	 * Takes the CSS in inline.css and
	 * adds that as inline styles
	 **/
	public function print_inline_css() {

		if ( ! file_exists( plugin_dir_path( __FILE__ ) . 'inline.css' ) ) {
			return;
		}

		echo '<style>';
		echo file_get_contents( plugin_dir_path( __FILE__ ) . 'inline.css' );
		echo '</style>';
	}

	/**
	 * Enqueue stylesheets, external.css
	 **/
	public function enqueue_external_css() {
		wp_register_style( 'wp_mu_global_css_styles', plugins_url( '/external.css', __FILE__ ), array(), WP_MU_GLOBAL_CSS_VERSION );
		wp_enqueue_style( 'wp_mu_global_css_styles' );
	}

}


new WP_MU_GLOBAL_CSS_PLUGIN();
