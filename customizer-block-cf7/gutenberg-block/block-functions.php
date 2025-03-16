<?php 
/**
 * 
 * ==== Block initialization and callback functions.
 * 
 * @package Customizer_Block_CF7
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * 
 * ==== Block init
 * 
 * == initialize block and name both the callback function and the build directory.
 */

 //add_action( 'init', 'cfcf7__block_init' );

 function cfcf7__block_init() {
     register_block_type(
       dirname(__DIR__) . '/gutenberg-block/build',
         array(
             'render_callback' => 'cfcf7_render_callback',
         )
     );

 }
 


 /**
  * 
  * ==== Block Callback
  * 
  * == Here the chosen attributes are applied to create block output. 
  */

 function cfcf7_render_callback( $atts, $content, $block) {
 
 
     //---- Include block container style settings
     include CFCF7_PLUGIN_DIR . '/gutenberg-block/block-settings.php';
 
     //---- Include styles related to form fields
     include CFCF7_PLUGIN_DIR . '/gutenberg-block/field-settings.php';
 
     //---- Include styles related to form submit button
     include CFCF7_PLUGIN_DIR . '/gutenberg-block/submit-settings.php';
 
     //----  Merge setting arrays 
     $style_settings_array = array_merge( $field_settings_array, $submit_settings_array );
 
     //----  Parse setting array to string.
     $settings_string = implode(" ", $style_settings_array);
     
     /**
      * 
      * Add Class and Styles to block container.
      */ 
     $wrapper_attributes = get_block_wrapper_attributes(
         [
             'class' => 'cfcf7-block'
,
             'style' => $styles,
         ]
     );
 
 
     /**
      * 
      * Show Message if no Contact form Selected.
      */
 
     if ( ! empty( $atts['contact_form'] ) ) {
 
         if ( $atts['contact_form'] === 'unselected' ) {
 
             $output = '<div class="no-form-message">'. __( 'No form selected.', 'customizer-block-cf7'
 ) . '</div>';
 
             return $output; 
 
         }
     }
 
     /**
      * 
      * Show Message if no Contact forms Exists.
      */
 
      if ( ! empty( $atts['contact_form'] ) ) {
 
         if ( $atts['contact_form'] === 'empty' ) {
 
             $output = '<div class="no-form-message">'. __( 'Please add a contact form.', 'customizer-block-cf7'
 ) . '</div>';
 
             return $output; 
 
         }
     }
 
     /**
      * 
      * Show Message if no Contact form ID in post.
      */
 
     if ( empty( $atts['contact_form'] ) ) {
         
         $output = '<div class="no-form-message">'. __( 'No form selected.', 'customizer-block-cf7'
 ) . '</div>';
 
         return $output;  
 
     }
 
     
     /**
      * 
      * Once Contact form Selected get Contact Form ID and process shortcode.
      */
     
     if ( ! empty( $atts['contact_form'] ) ) {
 
         // Get selected Contact form ID.
         $form_ID = 'id="' . $atts['contact_form'] . '"';
 
         // Insert Contact form ID into Shortcode and Store in Array.
         $shortcode[] = sprintf( '[contact-form-7 %s]', $form_ID );
 
         // Turn Shortcode Array into String.
         $shortcode_string = implode( '', $shortcode );
 
         // Start Output String.
         $output = '';
 
         // Insert Block CSS.
         $output .= '<style>' . $settings_string . '</style>';
 
         // Insert Block Div Container.
         $output .= '<div class="cfcf7-block-container">';
 
         // Insert Block Div with Wrapper Attributes.
         $output .= '<div ' . $wrapper_attributes . '>';
 
         // Insert Wrapper Attributes.
         $output .= do_shortcode( $shortcode_string );
 
         // End Block Div.
         $output .= '</div>';
 
         // End Block Container.
         $output .= '</div>';
 
         // Return Block Output.
         return $output;
 
     }
 
 }
 