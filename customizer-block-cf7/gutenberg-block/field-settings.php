<?php
/**
 * === Form Field Settings Section
 *
 * @package Customizer_Block_CF7
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
 }


// Initialize field Settings Array
$field_settings_array = [];


// Target Field Types
$form_field_string =
    ".cfcf7-block .wpcf7-text, .cfcf7-block .wpcf7-textarea, .cfcf7-block input[type='number'], .cfcf7-block .wpcf7-select, .cfcf7-block .wpcf7-date";

    // Target Field Types upon focus
$form_field_string_focus =
".cfcf7-block .wpcf7-text:focus, .cfcf7-block .wpcf7-textarea:focus, .cfcf7-block input[type='number']:focus, .cfcf7-block .wpcf7-select:focus, .cfcf7-block .wpcf7-date:focus";
    
/**
 * Combine Field Background Color and Border Radius
 */
if (!empty($atts["field_bg_color"]) || isset($atts["field_border_radius"])) {
    $field_bg_color = !empty($atts["field_bg_color"]) ? $atts["field_bg_color"] : 'inherit'; // Use 'inherit' if no background color
    $field_border_radius = !empty($atts["field_border_radius"]) ? $atts["field_border_radius"] . "em" : "0"; // Default to 0 if empty

    // Combine the background color and border-radius into one CSS rule
    $field_settings_array[] = "$form_field_string { background-color: $field_bg_color; border-radius: $field_border_radius;  line-height:1.4em!important; }";

}




/**
 * Field Border
 */
if (
    !empty($atts["show_field_border"]) &&
    $atts["show_field_border"] !== false
) {
    if (
        !empty($atts["field_border_sides"]) &&
        $atts["field_border_sides"] === "bottom"
    ) {
        $field_settings_array[] = "$form_field_string { border-left: none; border-right: none; border-top: none; }";
        $border = "border-bottom";
    } else {
        $border = "border";
    }

    if (empty($atts["field_border_width"])) {
        $field_border_width = "0";
        $field_settings_array[] = "$form_field_string { $border-width: $field_border_width; }";
    }

    if (!empty($atts["field_border_width"])) {
        $field_border_width =
            $atts["field_border_width"] . "px";
        $field_border_width_string = "$form_field_string { $border-width: $field_border_width; }";
        $field_settings_array[] = $field_border_width_string;
    }

    if (!empty($atts["field_border_color"])) {
        $field_border_color = $atts["field_border_color"];
        $field_border_color_string = "$form_field_string { $border-color: $field_border_color; }";
        $field_settings_array[] = $field_border_color_string;
    }

    if (!empty($atts["field_border_style"])) {
        $field_border_style = $atts["field_border_style"];
        $field_border_style_string = "$form_field_string { $border-style: $field_border_style; }";
        $field_settings_array[] = $field_border_style_string;
    }
} else {
    $field_settings_array[] = "$form_field_string { border: none; }";
}


/**
 * Field Focus Outline
 */
if (
    !empty($atts["show_field_focus"]) &&
    $atts["show_field_focus"] !== false
) {

    if (!empty($atts["field_focus_outline_width"])) {
        $field_outline_width = $atts["field_focus_outline_width"] . "px";
        $field_settings_array[] = "$form_field_string_focus { outline-width: $field_outline_width; }";
    }

    if (!empty($atts["field_focus_outline_offset"])) {
        $field_outline_offset = $atts["field_focus_outline_offset"] . "px";
        $field_outline_offset_string = "$form_field_string_focus { outline-offset: $field_outline_offset; }";
        $field_settings_array[] = $field_outline_offset_string;
    }

    if (!empty($atts["field_focus_outline_color"])) {
        $field_outline_color = $atts["field_focus_outline_color"];
        $field_outline_color_string = "$form_field_string_focus { outline-color: $field_outline_color; }";
        $field_settings_array[] = $field_outline_color_string;
    }

}




/**
 * Field Shadow
 */
if (
    !empty($atts["show_field_box_shadow"]) &&
    $atts["show_field_box_shadow"] !== false
) {
    $field_box_shadow = "";
    $field_h_offset = 0;
    $field_v_offset = 0;
    $field_blur = 0;
    $field_spread = 0;
    $field_shadow_color = "";

    if (!empty($atts["field_h_offset"])) {
        $field_h_offset = $atts["field_h_offset"];
    }

    if (!empty($atts["field_v_offset"])) {
        $field_v_offset = $atts["field_v_offset"];
    }

    if (!empty($atts["field_blur"])) {
        $field_blur = $atts["field_blur"];
    }

    if (!empty($atts["field_spread"])) {
        $field_spread = $atts["field_spread"];
    }

    if (!empty($atts["field_shadow_color"])) {
        $field_shadow_color = $atts["field_shadow_color"];
    }

    if (
        !empty($atts["field_shadow_position"]) &&
        $atts["field_shadow_position"] === "inset"
    ) {
        $field_shadow_position = "inset";
    } elseif (
        !empty($atts["field_shadow_position"]) &&
        $atts["field_shadow_position"] !== "inset"
    ) {
        $field_shadow_position = "";
    }

    $field_box_shadow =
        $field_h_offset .
        "em " .
        $field_v_offset .
        "em " .
        $field_blur .
        "em " .
        $field_spread .
        "em " .
        $field_shadow_color .
        " " .
        $field_shadow_position;

        $field_settings_array[] = "$form_field_string{ box-shadow: {$field_box_shadow};}";
        
}



if (isset($atts['show_field_box_shadow']) && $atts['show_field_box_shadow'] === false) {
    $field_settings_array[] = "$form_field_string{ box-shadow:none!important; }";
}

/**
 * Field Labels
 */

//-- Label Font Size
if (isset($atts["label_font_size"])) {
    $field_settings_array[] =
        ".wpcf7 label{ font-size:" .
        $atts["label_font_size"].
        "em" .
        "!important;} ";
}



//-- Label Font Weight
if (isset($atts["label_font_weight"])) {
    $field_settings_array[] =
    ".wpcf7 label{ font-weight:" .
        $atts["label_font_weight"] .
        "!important;} ";
}

//-- Label Line Height
if (isset($atts["label_line_height"])) {
    $field_settings_array[] =
        ".wpcf7 label{ line-height:" .
        $atts["label_line_height"] .
        "em" .
        "!important;} ";
}


/**
 * Field Label Color
 */
if (!empty($atts["label_color"])) {
    $label_color = $atts["label_color"];
    $label_color_string = " .wpcf7 label, .wpcf7 form p a, .wpcf7 form p{ color: $label_color!important; }";
    $field_settings_array[] = $label_color_string;
}

//$akismet_string =".wpcf7 form p a, .wpcf7 form p{ font-size: 0.7em!important; }";

//$field_settings_array[] = $akismet_string;

/**
 * Field Label Line Height
 */
if (!empty($atts["label_line_height"])) {
    $label_line_height = $atts["label_line_height"] . "em";
    $label_line_height_string = ".wpcf7 label{ line-height: $label_line_height;}";
    $field_settings_array[] = $label_line_height_string;
}

/**
 * Field Label Case
 */
if (!empty($atts["label_case"])) {
    $label_case = $atts["label_case"];
    $label_case_string = " .wpcf7 label{ text-transform: $label_case; }";
    $field_settings_array[] = $label_case_string;
}

/**
 * Field Font Size
 */
if (!empty($atts["field_font_size"])) {
    $field_settings_array[] =
        $form_field_string .
        "{font-size:" .
        $atts["field_font_size"] .
        "em".
        "!important;} ";
}

/**
 * Field Text Line Height
 */
if (!empty($atts["field_line_height"])) {
    $field_line_height = $atts["field_line_height"] . "em";
    $field_line_height_string = "$form_field_string{ line-height: $field_line_height;}";
    $field_settings_array[] = $field_line_height_string;
}


/**
 * Field Text Color
 */
if (!empty($atts["field_text_color"])) {
    $field_text_color = $atts["field_text_color"];
    $field_text_color_string = "$form_field_string{ color: $field_text_color;}";
    $field_settings_array[] = $field_text_color_string;
}

/**
 * Placeholder Text Color
 */
if (!empty($atts["placeholder_text_color"])) {
    $placeholder_text_color = $atts["placeholder_text_color"];
    $placeholder_text_color_string = ".wpcf7 ::placeholder{ color: $placeholder_text_color}";
    $field_settings_array[] = $placeholder_text_color_string;
}

/**
 * Field Padding
 */
// Check for both padding top-bottom and left-right values
if (!empty($atts["field_padding_top_bottom"]) || isset($atts["field_padding_left_right"])) {
    $padding_top_bottom = !empty($atts["field_padding_top_bottom"]) ? $atts["field_padding_top_bottom"] . "em" : "0"; 
    $padding_left_right = isset($atts["field_padding_left_right"]) ? $atts["field_padding_left_right"] . "em" : "0";

    // Combine all padding values into a single padding rule
    $field_padding_string = "$form_field_string{ padding: $padding_top_bottom $padding_left_right; }";
    
    // Add the compressed padding rule to the settings array
    $field_settings_array[] = $field_padding_string;
}
