<?php
/**
 * === Plugin functions - Enqueue Scripts, Admin Page, Plugin Dependency Check, Admin Notice.
 *
 * @package Customizer_Block_CF7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * ==== Enqueue Plugin Scripts
 *
 * == https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 *
 * @param string $hook_suffix Current admin page hook suffix.
 * @return void
 */
function cfcf7_plugin_assets( $hook_suffix ) {

	$version = defined( 'CFCF7_VERSION' ) ? CFCF7_VERSION : '1.0.0';

	// Load small menu icon CSS globally in admin
	wp_enqueue_style(
		'cfcf7-admin-menu-style',
		CFCF7_PLUGIN_URL . '/admin/css/cfcf7-admin-menu.css',
		array(),
		$version
	);

	// Only load full admin page CSS on your plugin page
	if ( 'toplevel_page_cfcf7_admin_page' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		'cfcf7-admin-style',
		CFCF7_PLUGIN_URL . '/admin/css/cfcf7-admin.css',
		array(),
		$version
	);
}
add_action( 'admin_enqueue_scripts', 'cfcf7_plugin_assets' );

/**
 * ==== Admin Page
 *
 * == https://developer.wordpress.org/reference/functions/add_menu_page/
 *
 * @return void
 */
function cfcf7_admin_page() {
	add_menu_page(
		__( 'Style CF7', 'customizer-block-cf7' ),
		__( 'Style CF7', 'customizer-block-cf7' ),
		'manage_options',
		'cfcf7_admin_page',
		'cfcf7_render_settings_page',
		'',
		30
	);
}
add_action( 'admin_menu', 'cfcf7_admin_page' );

/**
 * Render plugin admin page.
 *
 * @return void
 */
function cfcf7_render_settings_page() {
	include dirname( __FILE__, 2 ) . '/admin/cfcf7-admin.php';
}