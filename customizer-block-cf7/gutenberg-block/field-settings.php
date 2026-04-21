<?php
/**
 * === Form Field Settings Section
 *
 * @package Customizer_Block_CF7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'cfcf7_is_enabled_attr' ) ) {
	/**
	 * Normalize block toggle values to a strict boolean.
	 *
	 * @param mixed $value Attribute value.
	 * @return bool
	 */
	function cfcf7_is_enabled_attr( $value ) {
		if ( is_bool( $value ) ) {
			return $value;
		}

		if ( is_string( $value ) ) {
			$value = strtolower( trim( $value ) );

			if ( in_array( $value, array( 'false', '0', '', 'no', 'off' ), true ) ) {
				return false;
			}

			if ( in_array( $value, array( 'true', '1', 'yes', 'on' ), true ) ) {
				return true;
			}
		}

		return ! empty( $value );
	}
}

if ( ! function_exists( 'cfcf7_build_field_settings_array' ) ) {
	/**
	 * Build field CSS rules for the rendered form block.
	 *
	 * @param array  $cfcf7_atts        Block attributes.
	 * @param string $cfcf7_block_scope Block scope selector.
	 * @return array
	 */
	function cfcf7_build_field_settings_array( $cfcf7_atts, $cfcf7_block_scope ) {
		$cfcf7_field_settings_array = array();

		// Safety fallback.
		if ( empty( $cfcf7_block_scope ) ) {
			$cfcf7_block_scope = '.cfcf7-block';
		}

		/**
		 * Scoped selectors.
		 */
		$cfcf7_form_field_string =
			$cfcf7_block_scope . " .wpcf7-text, " .
			$cfcf7_block_scope . " .wpcf7-textarea, " .
			$cfcf7_block_scope . " .wpcf7-select, " .
			$cfcf7_block_scope . " .wpcf7-date, " .
			$cfcf7_block_scope . " input[type='text'], " .
			$cfcf7_block_scope . " input[type='email'], " .
			$cfcf7_block_scope . " input[type='tel'], " .
			$cfcf7_block_scope . " input[type='url'], " .
			$cfcf7_block_scope . " input[type='number'], " .
			$cfcf7_block_scope . " input[type='date'], " .
			$cfcf7_block_scope . " textarea, " .
			$cfcf7_block_scope . " select";

		$cfcf7_form_field_string_focus =
			$cfcf7_block_scope . " .wpcf7-text:focus, " .
			$cfcf7_block_scope . " .wpcf7-textarea:focus, " .
			$cfcf7_block_scope . " .wpcf7-select:focus, " .
			$cfcf7_block_scope . " .wpcf7-date:focus, " .
			$cfcf7_block_scope . " input[type='text']:focus, " .
			$cfcf7_block_scope . " input[type='email']:focus, " .
			$cfcf7_block_scope . " input[type='tel']:focus, " .
			$cfcf7_block_scope . " input[type='url']:focus, " .
			$cfcf7_block_scope . " input[type='number']:focus, " .
			$cfcf7_block_scope . " input[type='date']:focus, " .
			$cfcf7_block_scope . " textarea:focus, " .
			$cfcf7_block_scope . " select:focus";

		$cfcf7_label_string = $cfcf7_block_scope . ' .wpcf7 label';

		$cfcf7_label_color_targets =
			$cfcf7_block_scope . " .wpcf7 label, " .
			$cfcf7_block_scope . " .wpcf7 form p a, " .
			$cfcf7_block_scope . " .wpcf7 form p";

		$cfcf7_placeholder_string =
			$cfcf7_block_scope . ' .wpcf7 ::placeholder';

		/**
		 * ============================
		 * CSS VARIABLES (Single Source)
		 * ============================
		 */
		$cfcf7_field_vars = array();

		$cfcf7_allowed_border_styles = array( 'none', 'solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset' );
		$cfcf7_allowed_font_weights  = array( '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'bold' );
		$cfcf7_allowed_label_cases   = array( 'none', 'uppercase', 'lowercase', 'capitalize' );

		$cfcf7_field_border_style = ! empty( $cfcf7_atts['field_border_style'] ) ? strtolower( trim( (string) $cfcf7_atts['field_border_style'] ) ) : 'solid';
		if ( ! in_array( $cfcf7_field_border_style, $cfcf7_allowed_border_styles, true ) ) {
			$cfcf7_field_border_style = 'solid';
		}

		$cfcf7_label_font_weight = isset( $cfcf7_atts['label_font_weight'] ) ? trim( (string) $cfcf7_atts['label_font_weight'] ) : '400';
		if ( ! in_array( $cfcf7_label_font_weight, $cfcf7_allowed_font_weights, true ) ) {
			$cfcf7_label_font_weight = '400';
		}

		$cfcf7_label_case = ! empty( $cfcf7_atts['label_case'] ) ? strtolower( trim( (string) $cfcf7_atts['label_case'] ) ) : 'none';
		if ( ! in_array( $cfcf7_label_case, $cfcf7_allowed_label_cases, true ) ) {
			$cfcf7_label_case = 'none';
		}

		// Core.
		$cfcf7_field_vars[] = '--cfcf7-field-bg:' . ( ! empty( $cfcf7_atts['field_bg_color'] ) ? esc_attr( $cfcf7_atts['field_bg_color'] ) : '#f4f4f4' );
		$cfcf7_field_vars[] = '--cfcf7-field-radius:' . ( isset( $cfcf7_atts['field_border_radius'] ) ? floatval( $cfcf7_atts['field_border_radius'] ) . 'em' : '0.5em' );
		$cfcf7_field_vars[] = '--cfcf7-field-font-size:' . ( isset( $cfcf7_atts['field_font_size'] ) ? floatval( $cfcf7_atts['field_font_size'] ) . 'em' : '1em' );
		$cfcf7_field_vars[] = '--cfcf7-field-text:' . ( ! empty( $cfcf7_atts['field_text_color'] ) ? esc_attr( $cfcf7_atts['field_text_color'] ) : '#545054' );
		$cfcf7_field_vars[] = '--cfcf7-placeholder:' . ( ! empty( $cfcf7_atts['placeholder_text_color'] ) ? esc_attr( $cfcf7_atts['placeholder_text_color'] ) : '#C9C9C9' );

		// Padding.
		$cfcf7_field_vars[] = '--cfcf7-field-padding-y:' . ( isset( $cfcf7_atts['field_padding_top_bottom'] ) ? floatval( $cfcf7_atts['field_padding_top_bottom'] ) . 'em' : '0.6em' );
		$cfcf7_field_vars[] = '--cfcf7-field-padding-x:' . ( isset( $cfcf7_atts['field_padding_left_right'] ) ? floatval( $cfcf7_atts['field_padding_left_right'] ) . 'em' : '0.6em' );

		// Border.
		$cfcf7_field_border_enabled = isset( $cfcf7_atts['show_field_border'] ) ? cfcf7_is_enabled_attr( $cfcf7_atts['show_field_border'] ) : false;

		$cfcf7_field_vars[] = '--cfcf7-field-border-width:' . ( isset( $cfcf7_atts['field_border_width'] ) ? floatval( $cfcf7_atts['field_border_width'] ) . 'px' : '1px' );
		$cfcf7_field_vars[] = '--cfcf7-field-border-style:' . $cfcf7_field_border_style;
		$cfcf7_field_vars[] = '--cfcf7-field-border-color:' . ( ! empty( $cfcf7_atts['field_border_color'] ) ? esc_attr( $cfcf7_atts['field_border_color'] ) : '#dcdcdc' );

		// Focus.
		$cfcf7_field_focus_enabled = isset( $cfcf7_atts['show_field_focus'] ) ? cfcf7_is_enabled_attr( $cfcf7_atts['show_field_focus'] ) : false;

		$cfcf7_field_vars[] = '--cfcf7-field-focus-width:' . ( isset( $cfcf7_atts['field_focus_outline_width'] ) ? floatval( $cfcf7_atts['field_focus_outline_width'] ) . 'px' : '1px' );
		$cfcf7_field_vars[] = '--cfcf7-field-focus-offset:' . ( isset( $cfcf7_atts['field_focus_outline_offset'] ) ? floatval( $cfcf7_atts['field_focus_outline_offset'] ) . 'px' : '2px' );
		$cfcf7_field_vars[] = '--cfcf7-field-focus-color:' . ( ! empty( $cfcf7_atts['field_focus_outline_color'] ) ? esc_attr( $cfcf7_atts['field_focus_outline_color'] ) : '#403B40' );

		// Shadow.
		$cfcf7_field_shadow_enabled = isset( $cfcf7_atts['show_field_box_shadow'] ) ? cfcf7_is_enabled_attr( $cfcf7_atts['show_field_box_shadow'] ) : false;

		$cfcf7_field_box_shadow =
			( isset( $cfcf7_atts['field_h_offset'] ) ? floatval( $cfcf7_atts['field_h_offset'] ) : 0 ) . 'em ' .
			( isset( $cfcf7_atts['field_v_offset'] ) ? floatval( $cfcf7_atts['field_v_offset'] ) : 0.1 ) . 'em ' .
			( isset( $cfcf7_atts['field_blur'] ) ? floatval( $cfcf7_atts['field_blur'] ) : 1 ) . 'em ' .
			( isset( $cfcf7_atts['field_spread'] ) ? floatval( $cfcf7_atts['field_spread'] ) : -0.9 ) . 'em ' .
			( ! empty( $cfcf7_atts['field_shadow_color'] ) ? esc_attr( $cfcf7_atts['field_shadow_color'] ) : '#403b40' ) .
			(
				! empty( $cfcf7_atts['field_shadow_position'] ) && 'inset' === $cfcf7_atts['field_shadow_position']
				? ' inset'
				: ''
			);

		$cfcf7_field_vars[] = '--cfcf7-field-shadow:' . ( $cfcf7_field_shadow_enabled ? $cfcf7_field_box_shadow : 'none' );

		// Labels.
		$cfcf7_field_vars[] = '--cfcf7-label-font-size:' . ( isset( $cfcf7_atts['label_font_size'] ) ? floatval( $cfcf7_atts['label_font_size'] ) . 'em' : '1.1em' );
		$cfcf7_field_vars[] = '--cfcf7-label-font-weight:' . $cfcf7_label_font_weight;
		$cfcf7_field_vars[] = '--cfcf7-label-line-height:' . ( isset( $cfcf7_atts['label_line_height'] ) ? floatval( $cfcf7_atts['label_line_height'] ) . 'em' : '1.4em' );
		$cfcf7_field_vars[] = '--cfcf7-label-color:' . ( ! empty( $cfcf7_atts['label_color'] ) ? esc_attr( $cfcf7_atts['label_color'] ) : '#8C8E98' );
		$cfcf7_field_vars[] = '--cfcf7-label-case:' . $cfcf7_label_case;

		/**
		 * Apply variables.
		 */
		$cfcf7_field_settings_array[] = $cfcf7_block_scope . ' { ' . implode( '; ', $cfcf7_field_vars ) . '; }';

		/**
		 * Base field rule.
		 */
		$cfcf7_field_settings_array[] = $cfcf7_form_field_string . ' {
			background-color: var(--cfcf7-field-bg);
			border-radius: var(--cfcf7-field-radius);
			line-height: var(--cfcf7-field-line-height) !important;
			font-size: var(--cfcf7-field-font-size) !important;
			color: var(--cfcf7-field-text);
			padding: var(--cfcf7-field-padding-y) var(--cfcf7-field-padding-x);
			box-shadow: var(--cfcf7-field-shadow);
		}';

		/**
		 * Border handling.
		 */
		if ( $cfcf7_field_border_enabled ) {
			if ( ! empty( $cfcf7_atts['field_border_sides'] ) && 'bottom' === $cfcf7_atts['field_border_sides'] ) {
				$cfcf7_field_settings_array[] = $cfcf7_form_field_string . ' {
					border-left: none;
					border-right: none;
					border-top: none;
					border-bottom-width: var(--cfcf7-field-border-width);
					border-bottom-style: var(--cfcf7-field-border-style);
					border-bottom-color: var(--cfcf7-field-border-color);
				}';
			} else {
				$cfcf7_field_settings_array[] = $cfcf7_form_field_string . ' {
					border-width: var(--cfcf7-field-border-width);
					border-style: var(--cfcf7-field-border-style);
					border-color: var(--cfcf7-field-border-color);
				}';
			}
		} else {
			$cfcf7_field_settings_array[] = $cfcf7_form_field_string . ' { border: none; }';
		}

		/**
		 * Focus.
		 */
		if ( $cfcf7_field_focus_enabled ) {
			$cfcf7_field_settings_array[] = $cfcf7_form_field_string_focus . ' {
				outline-style: solid;
				outline-width: var(--cfcf7-field-focus-width);
				outline-offset: var(--cfcf7-field-focus-offset);
				outline-color: var(--cfcf7-field-focus-color);
			}';
		}

		/**
		 * Labels.
		 */
		$cfcf7_field_settings_array[] = $cfcf7_label_string . ' {
			font-size: var(--cfcf7-label-font-size) !important;
			font-weight: var(--cfcf7-label-font-weight) !important;
			line-height: var(--cfcf7-label-line-height) !important;
			text-transform: var(--cfcf7-label-case);
		}';

		$cfcf7_field_settings_array[] = $cfcf7_label_color_targets . ' {
			color: var(--cfcf7-label-color) !important;
		}';

		/**
		 * Placeholder.
		 */
		$cfcf7_field_settings_array[] = $cfcf7_placeholder_string . ' {
			color: var(--cfcf7-placeholder);
		}';

		return $cfcf7_field_settings_array;
	}
}

/**
 * Final field rules array.
 */
$cfcf7_field_settings_array = cfcf7_build_field_settings_array( $atts, $block_scope );