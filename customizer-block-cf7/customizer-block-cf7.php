<?php
/**
 * Plugin Name:       Style Contact Form 7
 * Plugin URI:        https://stylecontactform7.com
 * Description:       This Contact Form 7 compatible Gutenberg Block automates CSS style generation allowing you to quickly design visually appealing contact forms with minimal setup.
 * Version:           1.4
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Requires Plugins:  contact-form-7
 * Author:            Mofistudio
 * Author URI:        https://mofistudio.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       customizer-block-cf7
 * Domain Path:       /languages
 *
 * @package           Customizer_Block_CF7
 * @since             1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define plugin constants.
define( 'CFCF7_VERSION', '1.4' );
define( 'CFCF7_PLUGIN', __FILE__ );
define( 'CFCF7_PLUGIN_DIR', untrailingslashit( dirname( CFCF7_PLUGIN ) ) );
define( 'CFCF7_PLUGIN_URL', untrailingslashit( plugins_url( '', CFCF7_PLUGIN ) ) );
define( 'CFCF7_PLUGIN_BASENAME', plugin_basename( CFCF7_PLUGIN ) );

// Include plugin functions.
include CFCF7_PLUGIN_DIR . '/includes/cfcf7-functions.php';

// Redirect to Customizer Block CF7 admin page once after first activation.
register_activation_hook( __FILE__, 'cfcf7_activate' );
add_action( 'admin_init', 'cfcf7_redirect' );
add_action( 'init', 'cfcf7_load_textdomain' );
add_action( 'init', 'cfcf7__block_init' );

/**
 * Set one-time redirect flag on first activation only.
 *
 * @param bool $network_wide Whether the plugin is being activated network-wide.
 * @return void
 */
function cfcf7_activate( $network_wide ) {
	// Do not redirect after network activation.
	if ( is_multisite() && $network_wide ) {
		return;
	}

	// Only set the redirect the first time the plugin is ever activated.
	if ( false === get_option( 'cfcf7_welcome_redirect_done', false ) ) {
		add_option( 'cfcf7_do_activation_redirect', 1 );
	}
}

/**
 * Redirect to plugin admin page after first activation.
 *
 * @return void
 */
function cfcf7_redirect() {
	if ( ! is_admin() ) {
		return;
	}

	// Never redirect inside network admin.
	if ( is_network_admin() ) {
		return;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading activate-multi only to avoid redirecting during bulk activation; no user action is being processed here.
	$activate_multi = isset( $_GET['activate-multi'] ) ? sanitize_text_field( wp_unslash( $_GET['activate-multi'] ) ) : '';

	// Do not interrupt bulk activation flows.
	if ( '' !== $activate_multi ) {
		return;
	}

	if ( ! get_option( 'cfcf7_do_activation_redirect', false ) ) {
		return;
	}

	delete_option( 'cfcf7_do_activation_redirect' );
	update_option( 'cfcf7_welcome_redirect_done', 1 );

	wp_safe_redirect( admin_url( 'admin.php?page=cfcf7_admin_page' ) );
	exit;
}

/**
 * Load bundled translations as a fallback.
 *
 * WordPress.org language packs are loaded automatically first.
 * This loads plugin /languages files when no external translation exists.
 *
 * @return void
 */
function cfcf7_load_textdomain() {
	/**
	 * Load bundled translations as fallback.
	 *
	 * Note: WordPress.org translations are loaded automatically,
	 * but this is required to ensure plugin /languages/ files load
	 * when no external translation exists (tested on multisite).
	 */
	load_plugin_textdomain(
		'customizer-block-cf7',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages'
	);
}

// Gutenberg block.
function cfcf7__block_init() {

	// Register the block using metadata from block.json.
	register_block_type(
		__DIR__ . '/gutenberg-block/build',
		array(
			'render_callback' => 'cfcf7_render_callback',
		)
	);

	$script_handle = generate_block_asset_handle( 'mofistudio/customizer-block-cf7', 'editorScript' );

	// Load translation files for JavaScript.
	wp_set_script_translations(
		$script_handle,
		'customizer-block-cf7',
		plugin_dir_path( __FILE__ ) . 'languages'
	);

	$args = array(
		'post_type'      => 'wpcf7_contact_form',
		'posts_per_page' => 50,
		'post_status'    => 'publish',
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);

	$contact_forms_posts = get_posts( $args );
	$contact_forms       = array();

	foreach ( $contact_forms_posts as $post ) {
		$contact_id = $post->ID;

		$contact_forms[] = array(
			'id'       => absint( $contact_id ),
			'title'    => esc_html( $post->post_title ),
			'modified' => esc_html( $post->post_modified ),
		);
	}

	wp_add_inline_script(
		$script_handle,
		sprintf(
			'globalThis.cfcf7 = { contactForms: %s };',
			wp_json_encode( $contact_forms )
		),
		'before'
	);
}

// Block callback.
function cfcf7_render_callback( $atts, $content, $block ) {

	$contact_form = isset( $atts['contact_form'] ) ? (string) $atts['contact_form'] : '';

	if ( '' === $contact_form || 'unselected' === $contact_form ) {
		return '<div class="cfcf7-block-container"><div class="cfcf7-block cfcf7-placeholder-message">' . esc_html__( 'No form selected.', 'customizer-block-cf7' ) . '</div></div>';
	}

	if ( 'empty' === $contact_form ) {
		return '<div class="cfcf7-block-container"><div class="cfcf7-block cfcf7-placeholder-message">' . esc_html__( 'Please add a contact form.', 'customizer-block-cf7' ) . '</div></div>';
	}

	$form_id = absint( $contact_form );

	// Bail with a friendly placeholder if the value is not a valid numeric CF7 form ID.
	if ( ! $form_id ) {
		return '<div class="cfcf7-block-container"><div class="cfcf7-block cfcf7-placeholder-message">' . esc_html__( 'No form selected.', 'customizer-block-cf7' ) . '</div></div>';
	}

	// Bail with a friendly placeholder if the form post no longer exists.
	if ( ! get_post( $form_id ) ) {
		return '<div class="cfcf7-block-container"><div class="cfcf7-block cfcf7-placeholder-message">' . esc_html__( 'Please add a contact form.', 'customizer-block-cf7' ) . '</div></div>';
	}

	ob_start();

	$instance_class = 'cfcf7-instance-' . wp_unique_id();
	$block_scope    = '.' . $instance_class;

	// More reliable editor preview detection for block renderer requests.
	$request_context   = filter_input( INPUT_GET, 'context', FILTER_SANITIZE_SPECIAL_CHARS );
	$is_editor_preview = (
		defined( 'REST_REQUEST' ) &&
		REST_REQUEST &&
		'edit' === $request_context
	);

	include CFCF7_PLUGIN_DIR . '/gutenberg-block/block-settings.php';
	include CFCF7_PLUGIN_DIR . '/gutenberg-block/field-settings.php';
	include CFCF7_PLUGIN_DIR . '/gutenberg-block/submit-settings.php';

	$style_settings_array = array_merge(
		$cfcf7_block_settings_array ?? array(),
		$cfcf7_field_settings_array ?? array(),
		$cfcf7_submit_settings_array ?? array()
	);

	$settings_string = trim( implode( ' ', $style_settings_array ) );

	$wrapper_args = array(
		'class' => 'cfcf7-block ' . $instance_class,
	);

	if ( ! $is_editor_preview ) {
		$wrapper_args['style'] = $cfcf7_block_styles ?? '';
	}

	$wrapper_attributes = get_block_wrapper_attributes( $wrapper_args );
	$shortcode_string   = sprintf( '[contact-form-7 id="%d"]', $form_id );

	echo '<div class="cfcf7-block-container">';

	// Editor preview relies on editor styles plus generated scoped CSS from PHP.
	if ( is_admin() && ! empty( $settings_string ) ) {
		echo wp_kses(
			'<style>' . $settings_string . '</style>',
			array(
				'style' => array(),
			)
		);
	}

	if ( ! is_admin() && ! empty( $settings_string ) ) {
		wp_add_inline_style( 'mofistudio-customizer-block-cf7-style', $settings_string );
	}

	echo '<div ' . wp_kses_post( $wrapper_attributes ) . '>';
	echo do_shortcode( $shortcode_string );
	echo '</div></div>';

	return ob_get_clean();
}