<?php
/**
 * ==== Block Settings Section.
 *
 * @package Customizer_Block_CF7
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
 }


	// Initialize Container Styles Array.
	$styles = [];

	/**
	 * Block Background color
	 *
	 */

	if ( ! empty( $atts['block_bg_color'] ) ) {
		$styles[] = "background-color:{$atts['block_bg_color']}; line-height: 1.4em!important;";
	}

 
	/**
	 * Base Font Size
	 */
	if ( ! empty( $atts['base_font_size'] ) ) {
		$styles[] = 'font-size:' . $atts['base_font_size'] . 'px; ';
	}



	/**
	 * Block Padding
	 *
	 */

	if ( isset( $atts['padding_top'] ) ) {
		$styles[] = 'padding-top:' . $atts['padding_top'] . 'em;';
	}
	
	if ( isset( $atts['padding_sides'] ) ) {
		$styles[] = 'padding-left:' . $atts['padding_sides'] . 'em;';
		$styles[] = 'padding-right:' . $atts['padding_sides'] . 'em;';

	}
	
	if ( isset( $atts['padding_bottom'] ) ) {
		$styles[] = 'padding-bottom:' . $atts['padding_bottom'] . 'em;';
	}

			
	/**
	 * Block Margin
	 *
	 */

	if ( isset( $atts['margin_top'] ) ) {
		$styles[] = 'margin-top:' . $atts['margin_top'] . 'em;';
	}

	if ( isset( $atts['margin_sides']) ) {
		$styles[] = 'margin-left:' . $atts['margin_sides'] . 'em;';
		$styles[] = 'margin-right:' . $atts['margin_sides'] .'em;';
	}

	if ( isset( $atts['margin_bottom'] ) ) {
		$styles[] = 'margin-bottom:' . $atts['margin_bottom'] . 'em;';
	}

	/**
	 * Block Rounded Corners
	 *
	 */
	
	// Check if the 'block_border_radius' is set, if so, apply it to all corners
	if (  isset( $atts['block_border_radius'] ) ) {
		$styles[] = 'border-radius: ' . $atts['block_border_radius'] . 'em;';
	} else {
		// Apply individual corner styles if 'block_border_radius' is not set
		if ( empty( $atts['top_left_corner'] ) ) {
			$styles[] = 'border-top-left-radius: 0; ';
		} else {
			$styles[] = 'border-top-left-radius:' . $atts['top_left_corner'] . 'em;';
		}

		if ( empty( $atts['top_right_corner'] ) ) {
			$styles[] = 'border-top-right-radius: 0; ';
		} else {
			$styles[] = 'border-top-right-radius:' . $atts['top_right_corner'] . 'em;';
		}

		if ( empty( $atts['bottom_left_corner'] ) ) {
			$styles[] = 'border-bottom-left-radius: 0; ';
		} else {
			$styles[] = 'border-bottom-left-radius:' . $atts['bottom_left_corner'] . 'em;';
		}

		if ( empty( $atts['bottom_right_corner'] ) ) {
			$styles[] = 'border-bottom-right-radius: 0; ';
		} else {
			$styles[] = 'border-bottom-right-radius:' . $atts['bottom_right_corner'] . 'em;';
		}
	}

	/**
	 * Block Box Shadow
	 *
	 */

	if ( ! empty( $atts['show_box_shadow'] ) && $atts['show_box_shadow'] !== false ) {

		$boxShadow = '';
		$block_h_offset = 0;
		$block_v_offset = 0;
		$block_blur = 0;
		$block_spread = 0;
		$block_shadow_color = '';


		if ( ! empty( $atts['block_h_offset'] ) ){
			$block_h_offset = $atts['block_h_offset'];
		} 

		if ( ! empty( $atts['block_v_offset'] ) ){
			$block_v_offset = $atts['block_v_offset'];
		}
		if ( ! empty( $atts['block_blur'] ) ){
			$block_blur = $atts['block_blur'];
		}
		if ( ! empty( $atts['block_spread'] ) ){
			$block_spread = $atts['block_spread'];
		}
		if ( ! empty( $atts['block_shadow_color'] ) ){
			$block_shadow_color = $atts['block_shadow_color'];
		}

		$boxShadow = 
		$block_h_offset .
		'em ' .
		$block_v_offset .
		'em ' . 
		$block_blur .
		'em ' . 
		$block_spread .
		'em ' .
		$block_shadow_color;

        $styles[] = "box-shadow:{$boxShadow};";
	
    } else {
		$styles[] = "box-shadow:none!important;";
	}

	
	/**
	 * Block Border
	 *
	 */

	if ( ! empty( $atts['show_block_border'] ) && $atts['show_block_border'] !== false ) {

		$styles[] = 'border-style: solid;';

		if ( ! empty( $atts['block_border_width'] ) ) {
			$block_border_width = $atts['block_border_width'] . "em";
			$styles[] = 'border-width:' . $block_border_width . '; ';
			
		}
		if ( empty( $atts['block_border_width'] ) ) {
			$block_border_width = '0';
			$styles[] = 'border-width:'. $block_border_width .'; ';
			}
		}
		if ( ! empty( $atts['block_border_color'] ) ) {
			$styles[] = 'border-color:'. $atts['block_border_color'] .'; ';
		}
	
		
			
	/**
	 *  == Parse Styles Array to String...
	 *
	 */

	$styles = implode(' ', $styles);