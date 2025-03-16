<?php
/**
 * === Submit Settings Section
 *
 * @package Customizer_Block_CF7
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
 }
 

 // Initialize field Settings Array
 $submit_settings_array = array();

/**
 * Submit Background Color
 *
 */

if (!empty($atts['show_gradient_picker']) && $atts['show_gradient_picker'] === true && !empty($atts['submit_bg_gradient'])) {
    $submit_bg_gradient = $atts['submit_bg_gradient'];
    $submitBgGradientString = ".wpcf7-submit, .wpcf7-submit-wrapper{ background: $submit_bg_gradient!important; }";
    $submit_settings_array[] = $submitBgGradientString;
} elseif (!empty($atts['submit_bg_color'])) {
    // Apply solid color if gradient is not selected or no gradient value is provided
    $submit_bg_color = $atts['submit_bg_color'];
    $submitBgColorString = ".wpcf7-submit, .wpcf7-submit-wrapper{ background: $submit_bg_color!important; line-height:1.5em!important;}";
    $submit_settings_array[] = $submitBgColorString;
}


/**
 * Submit Font Size
 *
 */

    if (!empty($atts["submit_font_size"])) {
        $submitText =
            "font-size:" .
            $atts["submit_font_size"] .
            "em" .
            "!important; ";
        $submit_settings_array[] =
            ".cfcf7-block .wpcf7-submit{" . $submitText . "} ";
    }


/**
 * Submit Font Case
 *
 */
if (!empty($atts["submit_font_case"])) {
    $submit_font_case = $atts["submit_font_case"];
    $submitCaseString = ".cfcf7-block .wpcf7-submit{ text-transform: $submit_font_case!important; }";
    $submit_settings_array[] = $submitCaseString;
}

/**
 * Submit Font Weight
 *
 */

if (isset($atts["submit_font_weight"])) {
    $submit_settings_array[] =
    ".cfcf7-block .wpcf7-submit{ font-weight:" .
        $atts["submit_font_weight"] .
        "!important;} ";
}


/**
 * Submit Text Color
 *
 */
if (!empty($atts["submit_text_color"])) {
    $submitText = "color: " . $atts["submit_text_color"] . "!important;";
    $submit_settings_array[] = ".cfcf7-block .wpcf7-submit{" . $submitText . "} ";
}


/**
 * Submit Padding
 *
 */

    if (!empty($atts["submit_padding_top_bottom"])) {
        $submit_padding_top_bottom =
            "padding-top:" .
            $atts["submit_padding_top_bottom"] .
            "em" .
            "!important; ";
        $submit_padding_top_bottom .=
            "padding-bottom:" .
            $atts["submit_padding_top_bottom"] .
            "em" .
            "!important; ";
        $submit_settings_array[] =
            ".cfcf7-block .wpcf7-submit{" .
            $submit_padding_top_bottom .
            "} ";
    }

    if (isset($atts["submit_padding_left_right"])) {
        $submit_padding_left_right =
            "padding-left:" .
            $atts["submit_padding_left_right"] .
            "em" .
            "; ";
        $submit_padding_left_right .=
            "padding-right:" .
            $atts["submit_padding_left_right"] .
            "em" .
            " ; ";
        $submit_settings_array[] =
            ".cfcf7-block .wpcf7-submit{" .
            $submit_padding_left_right .
            "} ";
    }


/**
 * Submit Width
 *
 */
if (!empty($atts["submit_width"])) {
    if ($atts["submit_width"] === "100") {
        $submit_width = $atts["submit_width"] . "%";
        $submitWidthString = ".cfcf7-block
 .wpcf7-submit{ width: $submit_width; }";
        $submit_settings_array[] = $submitWidthString;
    } elseif ($atts["submit_width"] === "50") {
        $submitWidthString =
            ".cfcf7-block .wpcf7-submit{ width: auto; }";
        $submit_settings_array[] = $submitWidthString;
    }
}

/**
 * Submit Border Radius
 *
 */

$submitFieldString = ".cfcf7-block .wpcf7-submit";

if (empty($atts["submit_border_radius"])) {
    $submit_border_radius = "0";
    $submitBorderRadiusString = "$submitFieldString{ border-radius: $submit_border_radius!important;}";
    $submit_settings_array[] = $submitBorderRadiusString;
}

if (!empty($atts["submit_border_radius"])) {
    $submit_border_radius = $atts["submit_border_radius"] . "em";
    $submitBorderRadiusString = "$submitFieldString{ border-radius: $submit_border_radius!important;}";
    $submit_settings_array[] = $submitBorderRadiusString;
}

/**
 * Submit Border
 *
 */
if (
    !empty($atts["show_submit_border"]) &&
    $atts["show_submit_border"] !== false
) {
    
        if (empty($atts["submit_border_width"])) {
            $submit_border_width = "0";
            $submitBorderWidthString = "$submitFieldString{ border-width: $submit_border_width;}";
            $submit_settings_array[] = $submitBorderWidthString;
        }

        if (!empty($atts["submit_border_width"])) {
            $submit_border_width = $atts["submit_border_width"] . "px";
            $submitBorderWidthString = "$submitFieldString{ border-width: $submit_border_width;}";
            $submit_settings_array[] = $submitBorderWidthString;
        }
    

    if (!empty($atts["submit_border_color"])) {
        $submit_border_color = $atts["submit_border_color"];
        $submitBorderColorString = "$submitFieldString{ border-color: $submit_border_color;}";
        $submit_settings_array[] = $submitBorderColorString;
    }

    if (!empty($atts["submitBorderColorHover"])) {
        $submitBorderColorHover = $atts["submitBorderColorHover"];
        $submitBorderColorHoverString = "$submitFieldString:hover{ border-color: $submitBorderColorHover;}";
        $submit_settings_array[] = $submitBorderColorHoverString;
    }

    $submitBorderStyleString = "$submitFieldString{ border-style: solid;}";
    $submit_settings_array[] = $submitBorderStyleString;
} else {
    $submit_settings_array[] = "$submitFieldString{ border: none;}";
}

/**
 * Submit Shadow
 *
 */
if (
    !empty($atts["show_submit_shadow"]) &&
    $atts["show_submit_shadow"] !== false
) {
    $boxShadow = "";
    $block_h_offset = 0;
    $block_v_offset = 0;
    $block_blur = 0;
    $block_spread = 0;
    $block_shadow_color = "";

    if (!empty($atts["submit_h_offset"])) {
        $block_h_offset = $atts["submit_h_offset"];
    }

    if (!empty($atts["submit_v_offset"])) {
        $block_v_offset = $atts["submit_v_offset"];
    }
    if (!empty($atts["submit_blur"])) {
        $block_blur = $atts["submit_blur"];
    }
    if (!empty($atts["submit_spread"])) {
        $block_spread = $atts["submit_spread"];
    }
    if (!empty($atts["submit_shadow_color"])) {
        $block_shadow_color = $atts["submit_shadow_color"];
    }

    $boxShadow =
        $block_h_offset .
        "em " .
        $block_v_offset .
        "em " .
        $block_blur .
        "em " .
        $block_spread .
        "em " .
        $block_shadow_color;

    $submit_settings_array[] = "$submitFieldString{box-shadow:{$boxShadow};}";
}


if (isset($atts['show_submit_shadow']) && $atts['show_submit_shadow'] === false) {
    $submit_settings_array[] = "$submitFieldString{box-shadow:none!important;}";
}

/**
 * Hide Submit Shadow on hover
 *
 */
$submit_settings_array[] = "$submitFieldString:hover{box-shadow:none!important;}";


/**
 * Some responsive styles for Tablet screens,
 *  
 */

// Base Font Size
if ( ! empty( $atts['base_font_size_tablet'] ) ) {
    $base_font_size_tablet = $atts['base_font_size_tablet'];
}

// Block Margin
$margin_top_tablet = 0;
$margin_sides_tablet = 0;
$margin_bottom_tablet = 0;

 if (!empty($atts["margin_top_tablet"])) {
    $margin_top_tablet = $atts["margin_top_tablet"];
 }
 if (!empty($atts["margin_sides_tablet"])) {
    $margin_sides_tablet = $atts["margin_sides_tablet"];
 }
 if (!empty($atts["margin_bottom_tablet"])) {
    $margin_bottom_tablet = $atts["margin_bottom_tablet"];
 }

// Block Padding
 if (!empty($atts["padding_top_tablet"])) {
    $padding_top_tablet = $atts["padding_top_tablet"];
 }
 if (!empty($atts["padding_sides_tablet"])) {
    $padding_sides_tablet = $atts["padding_sides_tablet"];
 }
 if (!empty($atts["padding_bottom_tablet"])) {
    $padding_bottom_tablet = $atts["padding_bottom_tablet"];
 }


// Submit Button Width
if ( !empty($atts["submit_width_tablet"])) {

    if ($atts["submit_width_tablet"] === "100") {
        $submit_width_tablet = "100%";
    } else {
        $submit_width_tablet = "auto";
    }

}

// Provide default values using the null coalescing operator `??`
$base_font_size_tablet = $base_font_size_tablet ?? '16'; // Example default value
$margin_top_tablet = $margin_top_tablet ?? '0';
$margin_sides_tablet = $margin_sides_tablet ?? '2';
$margin_bottom_tablet = $margin_bottom_tablet ?? '0';
$padding_top_tablet = $padding_top_tablet ?? '1.6';
$padding_sides_tablet = $padding_sides_tablet ?? '2.2';
$padding_bottom_tablet = $padding_bottom_tablet ?? '1.6';
$submit_width_tablet = $submit_width_tablet ?? '50';

// Now it's safe to use the variables
$submit_settings_array[] = "
        @media only screen and (min-width: 361px) and (max-width: 780px) {
            .cfcf7-block
            { 
                font-size: {$base_font_size_tablet}px!important; 
                margin-top: {$margin_top_tablet}em!important; 
                margin-left: {$margin_sides_tablet}em!important; 
                margin-right: {$margin_sides_tablet}em!important; 
                margin-bottom: {$margin_bottom_tablet}em!important;
                padding-top: {$padding_top_tablet}em!important; 
                padding-left: {$padding_sides_tablet}em!important; 
                padding-right: {$padding_sides_tablet}em!important; 
                padding-bottom: {$padding_bottom_tablet}em!important; 
            } 
            .cfcf7-block .wpcf7-submit{ width: {$submit_width_tablet}!important; 
        }}";


/**
 * Some responsive styles for Mobile screens,
 *  Block Sizing, Margin, Padding & Submit Button width.
 */

 // Base Font Size
if ( ! empty( $atts['base_font_size_mobile'] ) ) {
    $base_font_size_mobile = $atts['base_font_size_mobile'];
}

// Block Margin
$margin_top_mobile = 0;
$margin_sides_mobile = 0;
$margin_bottom_mobile = 0;

 if (!empty($atts["margin_top_mobile"])) {
    $margin_top_mobile = $atts["margin_top_mobile"];
 }
 if (!empty($atts["margin_sides_mobile"])) {
    $margin_sides_mobile = $atts["margin_sides_mobile"];
 }
 if (!empty($atts["margin_bottom_mobile"])) {
    $margin_bottom_mobile = $atts["margin_bottom_mobile"];
 }

// Block Padding
 if (!empty($atts["padding_top_mobile"])) {
    $padding_top_mobile = $atts["padding_top_mobile"];
 }
 if (!empty($atts["padding_sides_mobile"])) {
    $padding_sides_mobile = $atts["padding_sides_mobile"];
 }
 if (!empty($atts["padding_bottom_mobile"])) {
    $padding_bottom_mobile = $atts["padding_bottom_mobile"];
 }


// Submit Button Width
if ( !empty($atts["submit_width_mobile"])) {

    if ($atts["submit_width_mobile"] === "100") {
        $submit_width_mobile = "100%";
    } else {
        $submit_width_mobile = "auto";
    }

}

// Provide default values using the null coalescing operator `??`
$base_font_size_mobile = $base_font_size_mobile ?? '16'; // Example default value
$margin_top_mobile = $margin_top_mobile ?? '1';
$margin_sides_mobile = $margin_sides_mobile ?? '0';
$margin_bottom_mobile = $margin_bottom_mobile ?? '1';
$padding_top_mobile = $padding_top_mobile ?? '1.25';
$padding_sides_mobile = $padding_sides_mobile ?? '1.2';
$padding_bottom_mobile = $padding_bottom_mobile ?? '1.25';
$submit_width_mobile = $submit_width_mobile ?? '100';

// Now it's safe to use the variables
$submit_settings_array[] = "
@media only screen and (max-width: 360px) {
    .cfcf7-block
{ 
                font-size: {$base_font_size_mobile}px!important; 
                margin-top: {$margin_top_mobile}em!important; 
                margin-left: {$margin_sides_mobile}em!important; 
                margin-right: {$margin_sides_mobile}em!important; 
                margin-bottom: {$margin_bottom_mobile}em!important;
                padding-top: {$padding_top_mobile}em!important; 
                padding-left: {$padding_sides_mobile}em!important; 
                padding-right: {$padding_sides_mobile}em!important; 
                padding-bottom: {$padding_bottom_mobile}em!important; 
            } 
            .cfcf7-block .wpcf7-submit{ width: {$submit_width_mobile}!important; 
        }}";


