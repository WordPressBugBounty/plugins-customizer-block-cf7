<?php
/**
 * === Plugin functions - Enqueue Scripts, Admin Page, Plugin Dependency Check, Admin Notice.
 *
 * @package Customizer_Block_CF7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
 
/**
 * 
 * ==== Enqueue Plugin Scripts
 * 
 * == https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */

 function cfcf7_plugin_assets() {
    // Use the static plugin version for versioning
    $version = defined( 'CFCF7_VERSION' ) ? CFCF7_VERSION : '1.0.0'; // Fallback to '1.0.0' if not defined

    // Register and enqueue the admin stylesheet with static versioning
    wp_register_style( 'cfcf7-admin-style', CFCF7_PLUGIN_URL . '/admin/css/cfcf7-admin.css', [], $version );
    wp_enqueue_style( 'cfcf7-admin-style' );
}

add_action( 'admin_enqueue_scripts', 'cfcf7_plugin_assets' );



 
/**
 * 
 * ==== Admin Page
 * 
 * == https://developer.wordpress.org/reference/functions/add_menu_page/
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

function cfcf7_render_settings_page() {
    include( dirname( __FILE__, 2 ) . '/admin/cfcf7-admin.php'); 
}



/**
 * 
 * ==== Plugin Dependency Check
 * 
 * If Contact Form 7 plugin is not activated show admin notice.
 * 
 */
 

 add_action( 'admin_init', 'cfcf7_check_if_contact_form_7_installed' );
 
 function cfcf7_check_if_contact_form_7_installed() {
 
     if ( is_admin() && current_user_can( 'activate_plugins') && !is_plugin_active( 'contact-form-7/wp-contact-form-7.php') ) {
 
         if (is_multisite()){
             add_action( 'network_admin_notices', 'cfcf7_check_notice' );
         }
         add_action( 'admin_notices', 'cfcf7_check_notice' );
 
     }
 
 }
 
 // == Admin notice
 
 function cfcf7_check_notice() {
      ?>
 
     <div class="error alert alert-danger notice is-dismissible">
         <p><?php esc_html_e( 'Customizer Block for Contact Form 7 plugin requires Contact Form 7 in order to work, So please ensure that Contact Form 7 is installed and activated!', 'customizer-block-cf7'
 ); ?></p>
     </div>
 
     <?php
 }





 function cfcf7_admin_enqueue_fonts() {
    wp_enqueue_style(
        'cfcf7-google-fonts-site-editor', 
        'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Ubuntu:wght@300;400;700&display=swap',     
        array(), 
        '1.0.0' // Set a version number
    );
}
add_action('admin_enqueue_scripts', 'cfcf7_admin_enqueue_fonts');


