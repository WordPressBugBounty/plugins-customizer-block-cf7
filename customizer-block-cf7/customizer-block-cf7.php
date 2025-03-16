<?php
/**
 * Plugin Name:       Style Contact Form 7
 * Plugin URI:        https://stylecontactform7.com
 * Description:       This Contact Form 7 compatible Gutenberg Block automates CSS style generation allowing you to quickly design visually appealing contact forms with minimal setup.
 * Version:           1.2
 * Requires Plugins:  contact-form-7
 * Author:            Mofistudio
 * Author URI:        https://mofistudio.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       customizer-block-cf7
 * Domain Path:       /languages
 *
 * @package           Customizer_Block_CF7
 * @since             1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


 // define some constants.
 define( 'CFCF7_VERSION', '1.2' );

 define( 'CFCF7_PLUGIN', __FILE__ );

 define( 'CFCF7_PLUGIN_DIR', untrailingslashit( dirname( CFCF7_PLUGIN ) ) );

 define( 'CFCF7_PLUGIN_URL', untrailingslashit( plugins_url( '', CFCF7_PLUGIN ) ) );

 define( 'CFCF7_PLUGIN_BASENAME', plugin_basename( CFCF7_PLUGIN ) );
 


// include plugin functions.
include CFCF7_PLUGIN_DIR . '/includes/cfcf7-functions.php';


// Redirect to Customizer Block CF7 Admin Page on plugin activation.

 register_activation_hook(__FILE__, 'cfcf7_activate');

 add_action('admin_init', 'cfcf7_redirect');
 
 function cfcf7_activate() {

	 add_option('cfcf7_do_activation_redirect', true);
 }
 
 function cfcf7_redirect() {
 
	 if ( get_option('cfcf7_do_activation_redirect', false ) ) {
 
		delete_option('cfcf7_do_activation_redirect');

		$redirect_url = admin_url( 'admin.php?page=cfcf7_admin_page' );

			wp_safe_redirect(

				esc_url( $redirect_url )
			);

		exit;

	 }
 }
 

// Gutenberg block
function cfcf7__block_init() {

    //---- Register the block using metadata from block.json.
    register_block_type(__DIR__ . '/gutenberg-block/build', array(
        'render_callback' => 'cfcf7_render_callback',
    ));

	//---- Load translations files for PHP
	load_plugin_textdomain( 'customizer-block-cf7', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	$script_handle = generate_block_asset_handle( 'mofistudio/customizer-block-cf7', 'editorScript' );
	

	//---- Load translations files for Javascript
	wp_set_script_translations( $script_handle, 'customizer-block-cf7', plugin_dir_path( __FILE__ ) . 'languages' );


	$args = array(
		'post_type'      => 'wpcf7_contact_form',
		'posts_per_page' => 20,
		'post_status'    => 'publish',
		'orderby'        => 'modified',
		'order'          => 'DESC',
	);
	
	// Get posts directly
	$contact_forms_posts = get_posts($args);
	
	$contact_forms = [];

		foreach ($contact_forms_posts as $post) {
			$contact_ID = $post->ID;

			// Escape the output
			$contact_forms[] = [
				'id' => esc_attr($contact_ID), // Escaping attribute
				'title' => esc_html($post->post_title), // Escaping HTML output
				'modified' => esc_html($post->post_modified), // Escaping HTML output
			];
		}

		
	wp_add_inline_script(
		'wp-blocks',
		sprintf(
			'window.cfcf7 = { contactForms: %s };',
			wp_json_encode($contact_forms)
		),
		'before'
	);
	

}
add_action('init', 'cfcf7__block_init');


//-- Block Callback
function cfcf7_render_callback( $atts, $content, $block ) {

    // Start output buffering
    ob_start();
	
    // No contact form selected or empty case
    if (!isset($atts['contact_form']) || $atts['contact_form'] === 'unselected' || $atts['contact_form'] === 'empty') {
		$message = (isset($atts['contact_form']) && $atts['contact_form'] === 'empty') ?
			__('Please add a contact form.', 'customizer-block-cf7') :
			__('No form selected.', 'customizer-block-cf7');
	
		// Escape the message before output
		echo '<div class="no-form-message">' . esc_html($message) . '</div>';
		return ob_get_clean(); // Get buffered output and return it
	}
	

    // Include block container style settings
    include CFCF7_PLUGIN_DIR . '/gutenberg-block/block-settings.php';

    // Include styles related to form fields and submit button
    include CFCF7_PLUGIN_DIR . '/gutenberg-block/field-settings.php';
    include CFCF7_PLUGIN_DIR . '/gutenberg-block/submit-settings.php';

    // Merge setting arrays and generate styles
    $style_settings_array = array_merge($field_settings_array, $submit_settings_array);
	$settings_string = implode(" ", $style_settings_array);

    // Add class and styles to block container
    $wrapper_attributes = get_block_wrapper_attributes([
        'class' => 'cfcf7-block',
        'style' => $styles,
    ]);

    // Process the contact form if selected
    if (!empty($atts['contact_form'])) {
        $form_ID = 'id="' . $atts['contact_form'] . '"';
        $shortcode_string = sprintf('[contact-form-7 %s]', $form_ID);

        // Start final output string
		echo '<style>' . wp_kses_post($settings_string) . '</style>';
        echo '<div class="cfcf7-block-container">';
		echo '<div ' . wp_kses_post( $wrapper_attributes ) . '>';
        echo do_shortcode($shortcode_string);
        echo '</div></div>';

        return ob_get_clean(); // Get the buffered output and return it
    }

    return ob_get_clean(); // Return buffered content even if nothing matches
}
