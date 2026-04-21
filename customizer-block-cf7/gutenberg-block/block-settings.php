<?php
/**
 * ==== Block Settings Section.
 *
 * @package Customizer_Block_CF7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Initialize container styles array.
$cfcf7_block_styles = array();

/**
 * Block background color.
 */
$cfcf7_block_styles[] = '--cfcf7-block-bg:' . ( ! empty( $atts['block_bg_color'] ) ? esc_attr( $atts['block_bg_color'] ) : 'transparent' );
$cfcf7_block_styles[] = '--cfcf7-block-line-height:1.4em';


/**
 * Base font size.
 */
$cfcf7_block_styles[] = '--cfcf7-block-font-size:' . ( ! empty( $atts['base_font_size'] ) ? floatval( $atts['base_font_size'] ) . 'px' : '16px' );

/**
 * Block padding.
 */
$cfcf7_block_styles[] = '--cfcf7-block-padding-top:' . ( isset( $atts['padding_top'] ) ? floatval( $atts['padding_top'] ) . 'em' : '0' );
$cfcf7_block_styles[] = '--cfcf7-block-padding-sides:' . ( isset( $atts['padding_sides'] ) ? floatval( $atts['padding_sides'] ) . 'em' : '0' );
$cfcf7_block_styles[] = '--cfcf7-block-padding-bottom:' . ( isset( $atts['padding_bottom'] ) ? floatval( $atts['padding_bottom'] ) . 'em' : '0' );

/**
 * Block margin.
 */
$cfcf7_block_styles[] = '--cfcf7-block-margin-top:' . ( isset( $atts['margin_top'] ) ? floatval( $atts['margin_top'] ) . 'em' : '0' );
$cfcf7_block_styles[] = '--cfcf7-block-margin-sides:' . ( isset( $atts['margin_sides'] ) ? floatval( $atts['margin_sides'] ) . 'em' : '0' );
$cfcf7_block_styles[] = '--cfcf7-block-margin-bottom:' . ( isset( $atts['margin_bottom'] ) ? floatval( $atts['margin_bottom'] ) . 'em' : '0' );

/**
 * Block rounded corners.
 *
 * Individual corner controls are no longer used.
 * All corners should follow the same radius value.
 */
$cfcf7_radius = isset( $atts['block_border_radius'] ) ? floatval( $atts['block_border_radius'] ) . 'em' : '0';

$cfcf7_block_styles[] = '--cfcf7-block-radius:' . $cfcf7_radius;
$cfcf7_block_styles[] = '--cfcf7-block-radius-top-left:' . $cfcf7_radius;
$cfcf7_block_styles[] = '--cfcf7-block-radius-top-right:' . $cfcf7_radius;
$cfcf7_block_styles[] = '--cfcf7-block-radius-bottom-left:' . $cfcf7_radius;
$cfcf7_block_styles[] = '--cfcf7-block-radius-bottom-right:' . $cfcf7_radius;

/**
 * Block box shadow.
 */
if ( ! empty( $atts['show_box_shadow'] ) && false !== $atts['show_box_shadow'] ) {
	$cfcf7_block_h_offset     = ! empty( $atts['block_h_offset'] ) ? floatval( $atts['block_h_offset'] ) : 0;
	$cfcf7_block_v_offset     = ! empty( $atts['block_v_offset'] ) ? floatval( $atts['block_v_offset'] ) : 0;
	$cfcf7_block_blur         = ! empty( $atts['block_blur'] ) ? floatval( $atts['block_blur'] ) : 0;
	$cfcf7_block_spread       = ! empty( $atts['block_spread'] ) ? floatval( $atts['block_spread'] ) : 0;
	$cfcf7_block_shadow_color = ! empty( $atts['block_shadow_color'] ) ? esc_attr( $atts['block_shadow_color'] ) : 'transparent';

	$cfcf7_box_shadow =
		$cfcf7_block_h_offset . 'em ' .
		$cfcf7_block_v_offset . 'em ' .
		$cfcf7_block_blur . 'em ' .
		$cfcf7_block_spread . 'em ' .
		$cfcf7_block_shadow_color;

	$cfcf7_block_styles[] = '--cfcf7-block-shadow:' . $cfcf7_box_shadow;
} else {
	$cfcf7_block_styles[] = '--cfcf7-block-shadow:none';
}

/**
 * Block border.
 */
if ( ! empty( $atts['show_block_border'] ) && false !== $atts['show_block_border'] ) {
	$cfcf7_block_styles[] = '--cfcf7-block-border-style:solid';
	$cfcf7_block_styles[] = '--cfcf7-block-border-width:' . ( ! empty( $atts['block_border_width'] ) ? floatval( $atts['block_border_width'] ) . 'em' : '0' );
} else {
	$cfcf7_block_styles[] = '--cfcf7-block-border-style:none';
	$cfcf7_block_styles[] = '--cfcf7-block-border-width:0';
}

$cfcf7_block_styles[] = '--cfcf7-block-border-color:' . ( ! empty( $atts['block_border_color'] ) ? esc_attr( $atts['block_border_color'] ) : 'transparent' );

/**
 * Also expose actual wrapper properties so front end still works
 * even before editor.scss or style-index.css consumes variables.
 */
$cfcf7_block_styles[] = 'background-color:var(--cfcf7-block-bg)';
$cfcf7_block_styles[] = 'line-height:var(--cfcf7-block-line-height) !important';
$cfcf7_block_styles[] = 'font-size:var(--cfcf7-block-font-size)';
$cfcf7_block_styles[] = 'padding-top:var(--cfcf7-block-padding-top)';
$cfcf7_block_styles[] = 'padding-left:var(--cfcf7-block-padding-sides)';
$cfcf7_block_styles[] = 'padding-right:var(--cfcf7-block-padding-sides)';
$cfcf7_block_styles[] = 'padding-bottom:var(--cfcf7-block-padding-bottom)';
$cfcf7_block_styles[] = 'margin-top:var(--cfcf7-block-margin-top)';
$cfcf7_block_styles[] = 'margin-left:var(--cfcf7-block-margin-sides)';
$cfcf7_block_styles[] = 'margin-right:var(--cfcf7-block-margin-sides)';
$cfcf7_block_styles[] = 'margin-bottom:var(--cfcf7-block-margin-bottom)';
$cfcf7_block_styles[] = 'border-top-left-radius:var(--cfcf7-block-radius-top-left, var(--cfcf7-block-radius, 0))';
$cfcf7_block_styles[] = 'border-top-right-radius:var(--cfcf7-block-radius-top-right, var(--cfcf7-block-radius, 0))';
$cfcf7_block_styles[] = 'border-bottom-left-radius:var(--cfcf7-block-radius-bottom-left, var(--cfcf7-block-radius, 0))';
$cfcf7_block_styles[] = 'border-bottom-right-radius:var(--cfcf7-block-radius-bottom-right, var(--cfcf7-block-radius, 0))';
$cfcf7_block_styles[] = 'box-shadow:var(--cfcf7-block-shadow)';
$cfcf7_block_styles[] = 'border-style:var(--cfcf7-block-border-style)';
$cfcf7_block_styles[] = 'border-width:var(--cfcf7-block-border-width)';
$cfcf7_block_styles[] = 'border-color:var(--cfcf7-block-border-color)';

/**
 * == Parse styles array to string.
 */
$cfcf7_block_styles = implode( '; ', $cfcf7_block_styles ) . ';';