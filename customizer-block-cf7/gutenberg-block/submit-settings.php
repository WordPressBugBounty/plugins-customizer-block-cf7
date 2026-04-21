<?php
/**
 * === Submit Settings Section
 *
 * @package Customizer_Block_CF7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Normalize submit width values.
 */
if ( ! function_exists( 'cfcf7_normalize_submit_width' ) ) {
	/**
	 * Normalize submit width values.
	 *
	 * @param mixed  $value    Raw width value.
	 * @param string $fallback Fallback width.
	 * @return string
	 */
	function cfcf7_normalize_submit_width( $value, $fallback = 'auto' ) {
		if ( '' === $value || null === $value ) {
			return $fallback;
		}

		$value = (string) $value;

		if ( '100' === $value || '100%' === $value ) {
			return '100%';
		}

		if ( '50' === $value || 'auto' === $value ) {
			return 'auto';
		}

		return $fallback;
	}
}

/**
 * Map submit width to container width.
 * Button uses auto/100%.
 * Parent <p> uses fit-content/100%.
 */
if ( ! function_exists( 'cfcf7_get_submit_container_width' ) ) {
	/**
	 * Convert button width to container width.
	 *
	 * @param mixed  $value    Raw width value.
	 * @param string $fallback Fallback width.
	 * @return string
	 */
	function cfcf7_get_submit_container_width( $value, $fallback = 'fit-content' ) {
		$cfcf7_normalized = cfcf7_normalize_submit_width( $value, 'auto' );

		if ( '100%' === $cfcf7_normalized ) {
			return '100%';
		}

		if ( 'auto' === $cfcf7_normalized ) {
			return 'fit-content';
		}

		return $fallback;
	}
}

if ( ! function_exists( 'cfcf7_build_submit_settings_array' ) ) {
	/**
	 * Build submit CSS rules for the rendered form block.
	 *
	 * @param array  $cfcf7_atts        Block attributes.
	 * @param string $cfcf7_block_scope Block scope selector.
	 * @return array
	 */
	function cfcf7_build_submit_settings_array( $cfcf7_atts, $cfcf7_block_scope ) {
		$cfcf7_submit_settings_array = array();

		// Safety: render callback should provide $cfcf7_block_scope like ".cfcf7-instance-xxxx".
		if ( empty( $cfcf7_block_scope ) ) {
			$cfcf7_block_scope = '.cfcf7-block';
		}

		$cfcf7_submit_field_string     = $cfcf7_block_scope . ' .wpcf7-submit';
		$cfcf7_submit_wrapper_string   = $cfcf7_block_scope . ' .wpcf7-submit-wrapper';
		$cfcf7_submit_container_string = $cfcf7_block_scope . ' .wpcf7 form p:has(.wpcf7-submit)';
		$cfcf7_submit_bg_targets       = $cfcf7_submit_field_string . ', ' . $cfcf7_submit_wrapper_string;

		/**
		 * Build CSS variable declarations on the block wrapper.
		 */
		$cfcf7_submit_vars = array();

		/**
		 * Submit background / gradient.
		 * block.json defaults:
		 * - submit_bg_color: #403b40
		 * - show_gradient_picker: false
		 * - submit_bg_gradient: linear-gradient(...)
		 */
		$cfcf7_submit_bg_value = isset( $cfcf7_atts['submit_bg_color'] ) && '' !== $cfcf7_atts['submit_bg_color']
			? $cfcf7_atts['submit_bg_color']
			: '#403b40';

		if (
			! empty( $cfcf7_atts['show_gradient_picker'] ) &&
			true === $cfcf7_atts['show_gradient_picker'] &&
			! empty( $cfcf7_atts['submit_bg_gradient'] )
		) {
			$cfcf7_submit_bg_value = $cfcf7_atts['submit_bg_gradient'];
		}

		$cfcf7_submit_vars[] = '--cfcf7-submit-bg:' . esc_attr( $cfcf7_submit_bg_value );
		$cfcf7_submit_vars[] = '--cfcf7-submit-line-height:1.5em';

		/**
		 * Typography.
		 * block.json defaults:
		 * - submit_font_size: 1
		 * - submit_font_case: capitalize
		 * - submit_font_weight: 400
		 * - submit_text_color: white
		 */
		$cfcf7_submit_vars[] = '--cfcf7-submit-font-size:' . ( isset( $cfcf7_atts['submit_font_size'] ) ? floatval( $cfcf7_atts['submit_font_size'] ) . 'em' : '1em' );
		$cfcf7_submit_vars[] = '--cfcf7-submit-font-case:' . ( ! empty( $cfcf7_atts['submit_font_case'] ) ? esc_attr( $cfcf7_atts['submit_font_case'] ) : 'capitalize' );
		$cfcf7_submit_vars[] = '--cfcf7-submit-font-weight:' . ( isset( $cfcf7_atts['submit_font_weight'] ) ? esc_attr( $cfcf7_atts['submit_font_weight'] ) : '400' );
		$cfcf7_submit_vars[] = '--cfcf7-submit-text:' . ( ! empty( $cfcf7_atts['submit_text_color'] ) ? esc_attr( $cfcf7_atts['submit_text_color'] ) : 'white' );

		/**
		 * Padding.
		 * block.json defaults:
		 * - submit_padding_top_bottom: 0.9
		 * - submit_padding_left_right: 4
		 */
		$cfcf7_submit_padding_y = isset( $cfcf7_atts['submit_padding_top_bottom'] ) ? floatval( $cfcf7_atts['submit_padding_top_bottom'] ) . 'em' : '0.9em';
		$cfcf7_submit_padding_x = isset( $cfcf7_atts['submit_padding_left_right'] ) ? floatval( $cfcf7_atts['submit_padding_left_right'] ) . 'em' : '4em';

		$cfcf7_submit_vars[] = '--cfcf7-submit-padding-y:' . $cfcf7_submit_padding_y;
		$cfcf7_submit_vars[] = '--cfcf7-submit-padding-x:' . $cfcf7_submit_padding_x;

		/**
		 * Width.
		 * block.json defaults:
		 * - submit_width: auto
		 */
		$cfcf7_submit_width = cfcf7_normalize_submit_width(
			isset( $cfcf7_atts['submit_width'] ) ? $cfcf7_atts['submit_width'] : '',
			'auto'
		);

		$cfcf7_submit_container_width = cfcf7_get_submit_container_width(
			isset( $cfcf7_atts['submit_width'] ) ? $cfcf7_atts['submit_width'] : '',
			'fit-content'
		);

		$cfcf7_submit_vars[] = '--cfcf7-submit-width:' . $cfcf7_submit_width;
		$cfcf7_submit_vars[] = '--cfcf7-submit-container-width:' . $cfcf7_submit_container_width;

		/**
		 * Border radius.
		 * block.json default:
		 * - submit_border_radius: 0.5
		 */
		$cfcf7_submit_vars[] = '--cfcf7-submit-radius:' . (
			isset( $cfcf7_atts['submit_border_radius'] ) && '' !== $cfcf7_atts['submit_border_radius']
				? floatval( $cfcf7_atts['submit_border_radius'] ) . 'em'
				: '0.5em'
		);

		/**
		 * Border.
		 * block.json defaults:
		 * - show_submit_border: false
		 * - submit_border_width: 1
		 * - submit_border_color: red
		 */
		$cfcf7_submit_border_enabled = ! empty( $cfcf7_atts['show_submit_border'] ) && false !== $cfcf7_atts['show_submit_border'];

		$cfcf7_submit_vars[] = '--cfcf7-submit-border-width:' . ( isset( $cfcf7_atts['submit_border_width'] ) ? floatval( $cfcf7_atts['submit_border_width'] ) . 'px' : '1px' );
		$cfcf7_submit_vars[] = '--cfcf7-submit-border-color:' . ( ! empty( $cfcf7_atts['submit_border_color'] ) ? esc_attr( $cfcf7_atts['submit_border_color'] ) : 'red' );
		$cfcf7_submit_vars[] = '--cfcf7-submit-border-style:' . ( $cfcf7_submit_border_enabled ? 'solid' : 'none' );

		/**
		 * Shadow.
		 * block.json defaults:
		 * - show_submit_shadow: true
		 * - submit_h_offset: 0
		 * - submit_v_offset: 0.3
		 * - submit_blur: 1
		 * - submit_spread: -0.6
		 * - submit_shadow_color: grey
		 */
		$cfcf7_submit_shadow_enabled = isset( $cfcf7_atts['show_submit_shadow'] ) ? ( false !== $cfcf7_atts['show_submit_shadow'] ) : true;

		$cfcf7_submit_h_offset     = isset( $cfcf7_atts['submit_h_offset'] ) ? floatval( $cfcf7_atts['submit_h_offset'] ) : 0;
		$cfcf7_submit_v_offset     = isset( $cfcf7_atts['submit_v_offset'] ) ? floatval( $cfcf7_atts['submit_v_offset'] ) : 0.3;
		$cfcf7_submit_blur         = isset( $cfcf7_atts['submit_blur'] ) ? floatval( $cfcf7_atts['submit_blur'] ) : 1;
		$cfcf7_submit_spread       = isset( $cfcf7_atts['submit_spread'] ) ? floatval( $cfcf7_atts['submit_spread'] ) : -0.6;
		$cfcf7_submit_shadow_color = ! empty( $cfcf7_atts['submit_shadow_color'] ) ? esc_attr( $cfcf7_atts['submit_shadow_color'] ) : 'grey';

		$cfcf7_submit_box_shadow =
			$cfcf7_submit_h_offset . 'em ' .
			$cfcf7_submit_v_offset . 'em ' .
			$cfcf7_submit_blur . 'em ' .
			$cfcf7_submit_spread . 'em ' .
			$cfcf7_submit_shadow_color;

		$cfcf7_submit_vars[] = '--cfcf7-submit-shadow:' . ( $cfcf7_submit_shadow_enabled ? $cfcf7_submit_box_shadow : 'none' );
		$cfcf7_submit_vars[] = '--cfcf7-submit-hover-shadow:none';

		/**
		 * Apply all variables to the block wrapper scope.
		 */
		$cfcf7_submit_settings_array[] = $cfcf7_block_scope . ' { ' . implode( '; ', $cfcf7_submit_vars ) . '; }';

		/**
		 * Base submit rules.
		 */
		$cfcf7_submit_settings_array[] = $cfcf7_submit_bg_targets . ' {
			background: var(--cfcf7-submit-bg) !important;
		}';

		$cfcf7_submit_settings_array[] = $cfcf7_submit_container_string . ' {
			position: relative;
			width: var(--cfcf7-submit-container-width) !important;
			max-width: 100%;
		}';

		$cfcf7_submit_settings_array[] = $cfcf7_submit_field_string . ' {
			font-size: var(--cfcf7-submit-font-size) !important;
			text-transform: var(--cfcf7-submit-font-case) !important;
			font-weight: var(--cfcf7-submit-font-weight) !important;
			color: var(--cfcf7-submit-text) !important;
			padding-top: var(--cfcf7-submit-padding-y) !important;
			padding-bottom: var(--cfcf7-submit-padding-y) !important;
			padding-left: var(--cfcf7-submit-padding-x);
			padding-right: var(--cfcf7-submit-padding-x);
			width: var(--cfcf7-submit-width) !important;
			border-radius: var(--cfcf7-submit-radius) !important;
			border-width: var(--cfcf7-submit-border-width);
			border-color: var(--cfcf7-submit-border-color);
			border-style: var(--cfcf7-submit-border-style);
			box-shadow: var(--cfcf7-submit-shadow);
			line-height: var(--cfcf7-submit-line-height) !important;
			position: relative;
		}';

		/**
		 * Hover.
		 */
		$cfcf7_submit_settings_array[] = $cfcf7_submit_field_string . ':hover {
			box-shadow: var(--cfcf7-submit-hover-shadow) !important;
		}';

		/**
		 * Responsive styles for Tablet screens.
		 * block.json defaults:
		 * - base_font_size_tablet: 16
		 * - margin_top_tablet: 0
		 * - margin_sides_tablet: 0
		 * - margin_bottom_tablet: 0
		 * - padding_top_tablet: 1.6
		 * - padding_sides_tablet: 2.2
		 * - padding_bottom_tablet: 1.6
		 * - submit_width_tablet: auto
		 */
		$cfcf7_base_font_size_tablet = isset( $cfcf7_atts['base_font_size_tablet'] ) ? $cfcf7_atts['base_font_size_tablet'] : '16';

		$cfcf7_margin_top_tablet    = isset( $cfcf7_atts['margin_top_tablet'] ) ? $cfcf7_atts['margin_top_tablet'] : '0';
		$cfcf7_margin_sides_tablet  = isset( $cfcf7_atts['margin_sides_tablet'] ) ? $cfcf7_atts['margin_sides_tablet'] : '0';
		$cfcf7_margin_bottom_tablet = isset( $cfcf7_atts['margin_bottom_tablet'] ) ? $cfcf7_atts['margin_bottom_tablet'] : '0';

		$cfcf7_padding_top_tablet    = isset( $cfcf7_atts['padding_top_tablet'] ) ? $cfcf7_atts['padding_top_tablet'] : '1.6';
		$cfcf7_padding_sides_tablet  = isset( $cfcf7_atts['padding_sides_tablet'] ) ? $cfcf7_atts['padding_sides_tablet'] : '2.2';
		$cfcf7_padding_bottom_tablet = isset( $cfcf7_atts['padding_bottom_tablet'] ) ? $cfcf7_atts['padding_bottom_tablet'] : '1.6';

		$cfcf7_submit_width_tablet = cfcf7_normalize_submit_width(
			isset( $cfcf7_atts['submit_width_tablet'] ) ? $cfcf7_atts['submit_width_tablet'] : '',
			'auto'
		);

		$cfcf7_submit_container_width_tablet = cfcf7_get_submit_container_width(
			isset( $cfcf7_atts['submit_width_tablet'] ) ? $cfcf7_atts['submit_width_tablet'] : '',
			'fit-content'
		);

		$cfcf7_submit_settings_array[] = "
@media only screen and (min-width: 481px) and (max-width: 782px) {
	{$cfcf7_block_scope} {
		font-size: {$cfcf7_base_font_size_tablet}px !important;
		margin-top: {$cfcf7_margin_top_tablet}em !important;
		margin-left: {$cfcf7_margin_sides_tablet}em !important;
		margin-right: {$cfcf7_margin_sides_tablet}em !important;
		margin-bottom: {$cfcf7_margin_bottom_tablet}em !important;
		padding-top: {$cfcf7_padding_top_tablet}em !important;
		padding-left: {$cfcf7_padding_sides_tablet}em !important;
		padding-right: {$cfcf7_padding_sides_tablet}em !important;
		padding-bottom: {$cfcf7_padding_bottom_tablet}em !important;
	}
	{$cfcf7_submit_container_string} {
		width: {$cfcf7_submit_container_width_tablet} !important;
		max-width: 100%;
	}
	{$cfcf7_submit_field_string} {
		width: {$cfcf7_submit_width_tablet} !important;
	}
}";

		/**
		 * Responsive styles for Mobile screens.
		 * block.json defaults:
		 * - base_font_size_mobile: 16
		 * - margin_top_mobile: 1
		 * - margin_sides_mobile: -0.5
		 * - margin_bottom_mobile: 1
		 * - padding_top_mobile: 2
		 * - padding_sides_mobile: 1.5
		 * - padding_bottom_mobile: 2
		 * - submit_width_mobile: 100
		 */
		$cfcf7_base_font_size_mobile = isset( $cfcf7_atts['base_font_size_mobile'] ) ? $cfcf7_atts['base_font_size_mobile'] : '16';

		$cfcf7_margin_top_mobile    = isset( $cfcf7_atts['margin_top_mobile'] ) ? $cfcf7_atts['margin_top_mobile'] : '1';
		$cfcf7_margin_sides_mobile  = isset( $cfcf7_atts['margin_sides_mobile'] ) ? $cfcf7_atts['margin_sides_mobile'] : '-0.5';
		$cfcf7_margin_bottom_mobile = isset( $cfcf7_atts['margin_bottom_mobile'] ) ? $cfcf7_atts['margin_bottom_mobile'] : '1';

		$cfcf7_padding_top_mobile    = isset( $cfcf7_atts['padding_top_mobile'] ) ? $cfcf7_atts['padding_top_mobile'] : '2';
		$cfcf7_padding_sides_mobile  = isset( $cfcf7_atts['padding_sides_mobile'] ) ? $cfcf7_atts['padding_sides_mobile'] : '1.5';
		$cfcf7_padding_bottom_mobile = isset( $cfcf7_atts['padding_bottom_mobile'] ) ? $cfcf7_atts['padding_bottom_mobile'] : '2';

		$cfcf7_submit_width_mobile = cfcf7_normalize_submit_width(
			isset( $cfcf7_atts['submit_width_mobile'] ) ? $cfcf7_atts['submit_width_mobile'] : '',
			'100%'
		);

		$cfcf7_submit_container_width_mobile = cfcf7_get_submit_container_width(
			isset( $cfcf7_atts['submit_width_mobile'] ) ? $cfcf7_atts['submit_width_mobile'] : '',
			'100%'
		);

		$cfcf7_submit_settings_array[] = "
@media only screen and (max-width: 480px) {
	{$cfcf7_block_scope} {
		font-size: {$cfcf7_base_font_size_mobile}px !important;
		margin-top: {$cfcf7_margin_top_mobile}em !important;
		margin-left: {$cfcf7_margin_sides_mobile}em !important;
		margin-right: {$cfcf7_margin_sides_mobile}em !important;
		margin-bottom: {$cfcf7_margin_bottom_mobile}em !important;
		padding-top: {$cfcf7_padding_top_mobile}em !important;
		padding-left: {$cfcf7_padding_sides_mobile}em !important;
		padding-right: {$cfcf7_padding_sides_mobile}em !important;
		padding-bottom: {$cfcf7_padding_bottom_mobile}em !important;
	}
	{$cfcf7_submit_container_string} {
		width: {$cfcf7_submit_container_width_mobile} !important;
		max-width: 100%;
	}
	{$cfcf7_submit_field_string} {
		width: {$cfcf7_submit_width_mobile} !important;
	}
}";

		return $cfcf7_submit_settings_array;
	}
}

/**
 * Final submit rules array for the parent render callback.
 */
$cfcf7_submit_settings_array = cfcf7_build_submit_settings_array( $atts, $block_scope );